<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class FilterCategory extends Component
{
    public $categories;
    public $filter;
    public $foodCount;

    public function mount(Category $category)
    {
        $this->categories = Category::all();
        $this->filter = $category->id;
    }

    public function render()
    {
        $foods = Food::orderBy('id', 'desc')
            ->where('category_id', $this->filter)
            ->paginate(12);
        $cart = session()->get('cart', []);
        $this->foodCount = count($cart);
        return view('livewire.filter-category', [
            'foods' => $foods,
        ])->layout('components.layouts.main');
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
