<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Jurnal;

class JurnalComponent extends Component
{
    public $users;
    public $models;
    public $days;
    public $now;
    public $selectedJurnal = null;
    public $activeForm = false;
    public $user_id, $worker_id, $date, $start_time, $end_time;

    public function mount()
    {
        $this->now = Carbon::now();
        $this->updateDays($this->now);
        $this->models = Jurnal::all();
    }

    public function changeDate($date)
    {
        $selectedDate = Carbon::parse($date);
        $this->now = $selectedDate;
        $this->updateDays($selectedDate);
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

    public function render()
    {
        return view('livewire.jurnal');
    }
}
