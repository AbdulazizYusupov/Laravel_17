<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
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

    public function render()
    {
        $models = \App\Models\Category::orderBy('sort', 'asc')->paginate(10);
        return view('livewire.category-component',['models' => $models]);
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
    }

    public function delete($id)
    {
        $post = \App\Models\Category::findOrFail($id);
        if ($post) {
            $post->delete();
        }
    }

    public function edit($id)
    {
        if ($this->editId === $id) {
            $this->reset('editId', 'edit');
        } else {
            $this->editId = $id;
            $this->editName = $this->models->find($id)->name;
        }
    }

    public function update($id)
    {
        $this->models->find($id)->update(['name' => $this->editName]);
        $this->reset('editId', 'editName', 'editSort');
    }
}
