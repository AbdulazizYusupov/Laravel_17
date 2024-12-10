<?php

namespace App\Livewire;

use App\Models\Section;
use App\Models\User;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class WorkerComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $users;
    public $sections;
    public $activeForm = false;
    public $user_id;
    public $section_id;
    public $salary_type;
    public $salary;
    public $bonus;
    public $month_time;
    public $start_time;
    public $end_time;
    public $hours;
    public $editUser_id;
    public $editSection_id;
    public $editSalary_type;
    public $editSalary;
    public $editBonus;
    public $editMonth_time;
    public $editStart_time;
    public $editEnd_time;
    public $editHours;
    public $editId;
    protected $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'section_id' => 'required|integer|exists:sections,id',
        'salary_type' => 'required|string',
        'salary' => 'required',
        'bonus' => 'nullable',
        'month_time' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'hours' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->users = User::all();
        $this->sections = Section::all();
        $models = Worker::orderBy('id', 'desc')->paginate(10);
        return view('livewire.worker-component',['models' => $models,'users' => $this->users,'sections' => $this->sections]);
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
        Worker::create($data);
        $this->activeForm = false;
        $this->reset(['user_id', 'section_id', 'salary_type', 'salary', 'bonus', 'month_time', 'start_time', 'end_time', 'hours']);
    }

    public function delete($id)
    {
        $post = Worker::findOrFail($id);
        if ($post) {
            $post->delete();
        }
    }

    public function edit($id)
    {
        if ($this->editId === $id) {
            $this->reset('editId', 'edit');
        } else {
            $worker = Worker::find($id);
            $this->editId = $id;
            $this->editUser_id = $worker->user_id;
            $this->editSection_id = $worker->section_id;
            $this->editSalary_type = $worker->salary_type;
            $this->editSalary = $worker->salary;
            $this->editBonus = $worker->bonus;
            $this->editMonth_time = $worker->month_time;
            $this->editStart_time = $worker->start_time;
            $this->editEnd_time = $worker->end_time;
            $this->editHours = $worker->hours;
        }
    }

    public function update($id)
    {
        Worker::find($id)->update([
            'user_id' => $this->editUser_id,
            'section_id' => $this->editSection_id,
            'salary_type' => $this->editSalary_type,
            'salary' => $this->editSalary,
            'bonus' => $this->editBonus,
            'month_time' => $this->editMonth_time,
            'start_time' => $this->editStart_time,
            'end_time' => $this->editEnd_time,
            'hours' => $this->editHours,
        ]);
        $this->reset('editId','editUser_id','editSection_id','editSalary_type','editSalary','editBonus','editMonth_time','editStart_time','editEnd_time','editHours');
    }
}
