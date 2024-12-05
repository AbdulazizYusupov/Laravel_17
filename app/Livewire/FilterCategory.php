<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class FilterCategory extends Component
{
    public $categories;
    public $filter;

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

        return view('livewire.filter-category', [
            'foods' => $foods,
        ])->layout('components.layouts.main',['categories' => $this->categories]);
    }
}
