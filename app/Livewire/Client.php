<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class Client extends Component
{
    public $foods;
    public $categories;
    public function mount()
    {
        $this->all();
    }
    public function all()
    {
        $this->foods = Food::all();
        $this->categories = Category::all();
        return $this->foods;
    }
    public function render()
    {
        return view('livewire.client')->layout('components.layouts.main');
    }
}
