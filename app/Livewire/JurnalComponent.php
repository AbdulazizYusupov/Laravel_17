<?php

namespace App\Livewire;

use App\Models\Jurnal;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Component;

class JurnalComponent extends Component
{
    public $users;
    public $workers;
    public $activeForm = false;
    public $user_id;
    public $worker_id;
    public $date;
    public $start_time;
    public $end_time;
    public $time;
    public $editUser_id;
    public $editWorker_id;
    public $editDate;
    public $editStart_time;
    public $editEnd_time;
    public $editTime;
    public $editId;
    protected $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'worker_id' => 'required|integer|exists:workers,id',
        'date' => 'required|date',
        'start_time' => 'nullable',
        'end_time' => 'nullable',
        'time' => 'nullable'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->users = User::all();
        $this->workers = Worker::all();
        $models = Jurnal::orderBy('id','desc')->get();
        return view('livewire.jurnal',['models' => $models,'users' => $this->users,'workers' => $this->workers]);
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
        $time_difference = round((strtotime($data['end_time']) - strtotime($data['start_time'])) / 3600, 2);
        $data['time'] = $time_difference;
        Jurnal::create([
            'user_id' => $data['user_id'],
            'worker_id' => $data['worker_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'time' => $data['time'],
        ]);
        $this->activeForm = false;
        $this->reset(['user_id', 'worker_id', 'date', 'start_time', 'end_time', 'time']);
    }

    public function delete($id)
    {
        $post = Jurnal::findOrFail($id);
        if ($post) {
            $post->delete();
        }
    }
    public function edit($id)
    {
        if ($this->editId === $id) {
            $this->reset('editId', 'edit');
        } else {
            $worker = Jurnal::find($id);
            $this->editId = $id;
            $this->editUser_id = $worker->user_id;
            $this->editWorker_id = $worker->worker_id;
            $this->editDate = $worker->date;
            $this->editStart_time = $worker->start_time;
            $this->editEnd_time = $worker->end_time;
        }
    }

    public function update($id)
    {
        $time_difference = round((strtotime($this->editEnd_time) - strtotime($this->editStart_time)) / 3600, 2);
        Jurnal::find($id)->update([
            'user_id' => $this->editUser_id,
            'worker_id' => $this->editWorker_id,
            'date' => $this->editDate,
            'start_time' => $this->editStart_time,
            'end_time' => $this->editEnd_time,
            'time' => $time_difference,
        ]);
        $this->reset('editId','editUser_id','editWorker_id','editDate','editStart_time','editEnd_time','editTime');
    }
}
