<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Jurnal;
use App\Models\User;
use App\Models\Worker;

class JurnalComponent extends Component
{
    public $users;
    public $models;
    public $days;
    public $addStartTime, $addEndTime;
    public $now;
    public $today;
    public $selectedJurnal = null;
    public $select = null;
    public $activeForm = false;
    public $user_id, $worker_id, $date, $start_time, $end_time;
    public $editEnd, $editStart;

    public function mount()
    {
        $this->users = User::all();
        $this->now = Carbon::now();
        $this->updateDays($this->now);
        $this->models = Worker::all();
    }

    public function changeDate($date)
    {
        $selectedDate = Carbon::parse($date);
        $this->now = $selectedDate;
        $this->updateDays($selectedDate);
    }
    public function updateJurnal()
    {

        if ($this->selectedJurnal) {

            $time_differance = round((strtotime($this->editEnd) - strtotime($this->editStart)) / 3600, 2);

            Jurnal::where('id', $this->selectedJurnal->id)->update([
                'start_time' => $this->editStart,
                'end_time' => $this->editEnd,
                'time' => $time_differance
            ]);

            $this->closeModal();
        }
    }


    private function updateDays($date)
    {
        $this->days = collect();
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        while ($startOfMonth->lte($endOfMonth)) {
            $this->days->push($startOfMonth->copy());
            $startOfMonth->addDay();
        }
    }

    public function openModal($id)
    {

        $this->selectedJurnal = Jurnal::find($id);
    }

    public function closeModal()
    {
        $this->selectedJurnal = null;
    }
    public function open($id, $day)
    {
        $this->today = $day;
        $this->select = User::find($id);
    }
    public function close()
    {
        $this->select = null;
    }
    public function create()
    {
        if ($this->select) {
            $user = User::find($this->select->id);
            $worker = Worker::where('user_id', $user->id)->first();
            $time_difference = round((strtotime($this->addEndTime) - strtotime($this->addStartTime)) / 3600, 2);
            Jurnal::create([
                'user_id' => $user->id,
                'worker_id' => $worker ? $worker->id : null,
                'date' => $this->today,
                'start_time' => $this->addStartTime ?? null,
                'end_time' => $this->addEndTime ?? null,
                'time' => $time_difference ?? null
            ]);
        }
        $this->select = null;
        $this->reset('addStartTime', 'addEndTime');
    }
    public function delete()
    {
        if ($this->selectedJurnal) {
            $this->selectedJurnal->delete();
            $this->closeModal();
        }
    }
    public function render()
    {
        return view('livewire.jurnal');
    }
}
