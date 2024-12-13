<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItems;
use Livewire\Component;

class OrderComponent extends Component
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
        $this->givens = Order::orderBy('queue', 'asc')->where('status', 4)->where('date', now()->toDateString())->get();
        return view('livewire.order-component');
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

        $order->status = 2;
        $order->save();
        $orderItems = OrderItems::where('order_id',$order->id)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->status = 2;
            $orderItem->save();
        }
        $this->allow1 = false;
    }
    public function ruxsat($id)
    {
        if ($id == $this->allow2) {
            $this->allow2 = false;
        } else {
            $this->allow2 = $id;
        }
    }
    public function done($id,$order_id)
    {
        $currentOrderItem = OrderItems::where('food_id', $id)->where('order_id', $order_id)->first();

        if (!$currentOrderItem) {
            return;
        }

        $currentOrderItem->status = $currentOrderItem->status == 3 ? 2 : 3;
        $currentOrderItem->save();

        $otherOrderItems = OrderItems::where('food_id', '!=', $id)
            ->where('order_id', $order_id)
            ->get();

        $checkedCount = $otherOrderItems->where('status', 3)->count();

        $totalCount = $otherOrderItems->count();

        $order = Order::where('id',$order_id)->first();

        if ($checkedCount == $totalCount) {
            $order->status = 3;
        } else {
            $order->status = 2;
        }

        $order->save();
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
