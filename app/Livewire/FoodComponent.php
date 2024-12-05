<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FoodComponent extends Component
{
    use WithFileUploads;
    public $models;
    public $categories;
    public $activeForm = false;
    public $name;
    public $price;
    public $image;
    public $category_id;
    public $editName;
    public $editPrice;
    public $editImage;
    public $editCategory;
    public $editId;

    protected $rules = [
        'name' => 'required|max:255',
        'price' => 'required',
        'category_id' => 'required',
        'image' => 'required|image|max:255|mimes:jpeg,png,jpg,svg',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = \App\Models\Food::orderBy('id', 'desc')->get();
        $this->categories = \App\Models\Category::all();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.food-component');
    }

    public function create()
    {
        $this->activeForm = true;
    }

    public function cancel()
    {
        $this->activeForm = false;
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $data['image'] = $imagePath;
        }

        \App\Models\Food::create($data);

        $this->activeForm = false;
        $this->reset(['name', 'price', 'category_id', 'image']);
        $this->all();
    }


    public function delete($id)
    {
        $post = \App\Models\Food::findOrFail($id);
        if ($post) {
            $post->delete();
        }
        $this->all();
    }

    public function edit($id)
    {
        if ($this->editId === $id) {
            $this->reset('editId', 'editName');
            $this->reset('editPrice', 'editCategory','editImage');
        } else {
            $this->editId = $id;
            $this->editName = $this->models->find($id)->name;
            $this->editPrice = $this->models->find($id)->price;
            $this->editCategory = $this->models->find($id)->category_id;
            $this->editImage = $this->models->find($id)->image;
        }
    }

    public function update($id)
    {
        $this->models->find($id)->update(['name' => $this->editName, 'price' => $this->editPrice, 'category_id' => $this->editCategory]);
        $this->reset('editId', 'editName', 'editPrice', 'editImage', 'editCategory');
    }
}
