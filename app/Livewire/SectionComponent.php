<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $activeForm = false;
    public $name;
    public $editName;
    public $editId;
    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $models = \App\Models\Section::orderBy('id', 'desc')->paginate(10);
        return view('livewire.section-component',['models' => $models]);
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
        \App\Models\Section::create($data);
        $this->activeForm = false;
        $this->reset(['name']);
    }

    public function delete($id)
    {
        $post = \App\Models\Section::findOrFail($id);
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
            $this->editName = Section::find($id)->name;
        }
    }

    public function update($id)
    {
        Section::find($id)->update(['name' => $this->editName]);
        $this->reset('editId', 'editName');
    }
}
