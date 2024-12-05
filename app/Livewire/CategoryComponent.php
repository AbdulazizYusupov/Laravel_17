<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $models;
    public $activeForm = false;
    public $name;
    public $sort;
    public $editName;
    public $editSort;
    public $editId;
    protected $rules = [
        'name' => 'required|max:255',
        'sort' => 'required|integer',
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
        $this->models = \App\Models\Category::orderBy('sort', 'asc')->get();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.category-component');
    }

    public function create()
    {
        $this->activeForm = true;
    }

    public function cancel()
    {
        $this->activeForm = false;
    }
    public function updateCategory($groupIds)
    {
        foreach ($groupIds as $id) {
            Category::where('id',$id['value'])->update(['sort' => $id['order']]);
        }
        $this->models = Category::orderBy('sort','asc')->get();
    }
    public function save()
    {
        $data = $this->validate();
        \App\Models\Category::create($data);
        $this->activeForm = false;
        $this->reset(['name', 'sort']);
        $this->all();
    }

    public function delete($id)
    {
        $post = \App\Models\Category::findOrFail($id);
        if ($post) {
            $post->delete();
        }
        $this->all();
    }

    public function edit($id)
    {
        if ($this->editId === $id) {
            $this->reset('editId', 'edit');
            $this->reset('editSort');
        } else {
            $this->editId = $id;
            $this->editName = $this->models->find($id)->name;
            $this->editSort = $this->models->find($id)->sort;
        }
    }

    public function update($id)
    {
        $this->models->find($id)->update(['name' => $this->editName, 'sort' => $this->editSort]);
        $this->reset('editId', 'editName', 'editSort');
    }
}
