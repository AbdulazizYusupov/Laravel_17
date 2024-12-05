<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class Client extends Component
{
    public $categories;
    public function render()
    {
        $this->categories = Category::all();
        $foods = Food::orderBy('id', 'desc')->paginate(12);
        return view('livewire.client', ['foods' => $foods])->layout('components.layouts.main',['categories' => $this->categories]);
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
