<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItems;
use Livewire\Component;

class OrderComponent extends Component
{
    public $models;

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = Order::all();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.order-component');

    }

    public function change($data, $checked)
    {
        if ($data['status'] < 4 && $data['status'] > 0) {
            if ($checked) {
                $data['status'] = $data['status'] + 1;
            } else {
                $data['status'] = $data['status'] - 1;
            }
        }
        OrderItems::where('food_id', $data['food_id'])->where('order_id', $data['order_id'])->update(['status' => $data['status']]);

        $this->all();
    }

}
