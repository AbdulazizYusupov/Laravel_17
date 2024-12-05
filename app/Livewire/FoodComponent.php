<?php

namespace App\Livewire;

use App\Models\Food;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class FoodComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    use WithFileUploads;

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

    public function render()
    {
        $models = \App\Models\Food::orderBy('id', 'desc')->paginate(10);
        $this->categories = \App\Models\Category::all();
        return view('livewire.food-component',['models' => $models]);
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
    }


    public function delete($id)
    {
        $post = \App\Models\Food::findOrFail($id);
        if ($post) {
            $post->delete();
        }
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $this->editId = $food->id;
        $this->editCategory = $food->category_id;
        $this->editName = $food->name;
        $this->image = $food->image;
        $this->editImage = null;
        $this->editPrice = $food->price;
    }


    public function update()
    {
        $food = Food::findOrFail($this->editId);

        $filePath = $food->image;

        if ($this->editImage) {
            if ($filePath && file_exists(storage_path('app/public/' . $filePath))) {
                unlink(storage_path('app/public/' . $filePath));
            }
            $filePath = $this->editImage->store('images', 'public');
        }

        $food->update([
            'category_id' => $this->editCategory,
            'name' => $this->editName,
            'image' => $filePath,
            'price' => $this->editPrice,
        ]);

        $this->reset('editPrice', 'editName', 'editCategory', 'editId', 'editImage', 'image');
    }

}
