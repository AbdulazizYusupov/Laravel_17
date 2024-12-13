<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItems;
use App\Models\UserOrder;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $orders;
    public $processes;
    public $dones;
    public $givens;

    public $allow1 = false;
    public $allow2 = false;
    public $allow3 = false;
    public $allow4 = false;
    public function render()
    {
        $this->orders = Order::orderBy('queue', 'asc')->where('status', 1)->where('date', now()->toDateString())->get();
        $this->processes = Order::orderBy('queue', 'asc')->where('status', 2)->where('date', now()->toDateString())->get();
        $this->dones = Order::orderBy('queue', 'asc')->where('status', 3)->where('date', now()->toDateString())->get();
        $this->givens = Order::orderBy('queue', 'asc')->where('status', 5)->where('date', now()->toDateString())->get();
        return view('livewire.orders-component');
    }
    public function show($id)
    {
        if ($id == $this->allow1) {
            $this->allow1 = false;
        } else {
            $this->allow1 = $id;
        }
    }
    public function accept($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 5;
        $order->save();
        $orderItems = OrderItems::where('order_id',$order->id)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->status = 5;
            $orderItem->save();
        }
        UserOrder::create([
           'user_id' => auth()->user()->id,
           'order_id' => $order->id
        ]);
        $this->allow4 = false;
    }
    public function ruxsat($id)
    {
        if ($id == $this->allow2) {
            $this->allow2 = false;
        } else {
            $this->allow2 = $id;
        }
    }
    public function consent($id)
    {
        if ($id == $this->allow3) {
            $this->allow3 = false;
        } else {
            $this->allow3 = $id;
        }
    }
    public function see($id)
    {
        if ($id == $this->allow4) {
            $this->allow4 = false;
        } else {
            $this->allow4 = $id;
        }
    }
}
