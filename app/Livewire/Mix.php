<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Salary;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Component;

class Mix extends Component
{
    public $models;
    public $oyliks;
    public $now;
    public $select;
    public $data;
    public $number;
    public $workerId;
    public function mount()
    {
        $this->select = now()->format('Y-m-d');
    }
    public function render()
    {
        $this->models = Worker::where('salary_type', 'mixed')->get();
        $this->now = now();
        $this->day();
        return view('livewire.mix');
    }
    public function day()
    {
        $this->now = Carbon::parse($this->select)->format('F Y');
        $this->data = Carbon::parse($this->select)->format('Y-m-d');
    }
    public function create($id)
    {
        $this->workerId = $id;
    }
    public function addSalary($id)
    {
        $worker = Worker::find($id);

        if (!$worker) {
            return;
        }

        $this->validate([
            'number' => 'required|numeric|min:0|max:' . $worker->salary,
        ]);
        $work = Salary::where('worker_id', $worker->id)->where('date', $this->data)->latest()->first();
        if ($work && $work->count() > 0) {
            if ($work->left >= $this->number) {
                Salary::create([
                    'worker_id' => $worker->id,
                    'date' => $this->data,
                    'type' => $worker->salary_type,
                    'bonus' => $work->bonus,
                    'given' => $this->number,
                    'left' => $work->left - $this->number,
                    'salary' => $worker->salary
                ]);
            }
        } else {
            if ($worker->section->name == 'Waiters') {
                $users = UserOrder::where('user_id', $worker->user_id)->get();
                $add = 0;
                foreach ($users as $user) {
                    foreach ($user->order as $ord) {
                        $add = $add + $ord->summ;
                    }
                }
                Salary::create([
                    'worker_id' => $worker->id,
                    'date' => $this->data,
                    'type' => $worker->salary_type,
                    'bonus' => (int) ($add * $worker->bonus),
                    'given' => $this->number,
                    'left' => $worker->salary - $this->number,
                    'salary' => $worker->salary
                ]);
            } elseif ($worker->section->name == 'Managers') {
                $orders = Order::all();
                $add = 0;
                foreach ($orders->where('date',$this->data) as $order) {
                    $add = $add + $order->summ;
                }
                Salary::create([
                    'worker_id' => $worker->id,
                    'date' => $this->data,
                    'type' => $worker->salary_type,
                    'bonus' => (int) ($add * $worker->bonus / 100),
                    'given' => $this->number,
                    'left' => $worker->salary - $this->number,
                    'salary' => $worker->salary
                ]);
            }
        }
    }
}
