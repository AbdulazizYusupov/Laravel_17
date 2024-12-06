<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Livewire\WithPagination;

class Client extends Component
{
    use WithPagination;
    public $foodCount;
    public $categories;

    public function render()
    {
        $this->categories = Category::all();
        $foods = Food::orderBy('id', 'desc')->paginate(12);
        $cart = session()->get('cart', []);
        $this->foodCount = count($cart);
        return view('livewire.client', ['foods' => $foods])->layout('components.layouts.main');
    }

    public function addToCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
    }

}
