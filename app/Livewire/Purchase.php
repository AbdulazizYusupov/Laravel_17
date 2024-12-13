<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItems;
use Livewire\Component;

class Purchase extends Component
{
    public $foodCount;
    public $categories;
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
        $this->categories = Category::all();
        $cart = session()->get('cart', []);
        $this->foodCount = count($cart);
        $this->orders = Order::orderBy('queue', 'asc')->where('status', 1)->where('date', now()->toDateString())->get();
        $this->processes = Order::orderBy('queue', 'asc')->where('status', 2)->where('date', now()->toDateString())->get();
        $this->dones = Order::orderBy('queue', 'asc')->where('status', 3)->where('date', now()->toDateString())->get();
        $this->givens = Order::orderBy('queue', 'asc')->where('status', 5)->where('date', now()->toDateString())->get();
        return view('livewire.purchase')->layout('components.layouts.app');
    }
    public function show($id)
    {
        if ($id == $this->allow1) {
            $this->allow1 = false;
        } else {
            $this->allow1 = $id;
        }
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
