<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItems;
use Carbon\Carbon;
use Livewire\Component;

class CartComponent extends Component
{
    public $total;
    public $categories;
    public $foods;
    public $foodCount;
    public $queue;
    public function mount()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $id => $item) {
            $food = Food::find($id);
            $total += $food->price * $item['quantity'];
        }
        $this->total = $total;
    }
    public function render()
    {
        $this->categories = Category::all();
        $this->foods = Food::all();
        $cart = session()->get('cart', []);
        $this->foodCount = count($cart);
        return view('livewire.cart-component',['categories' => $this->categories,'foods' => $this->foods,'carts' => $cart])->layout('components.layouts.main');
    }
    public function cancel()
    {
        session()->forget('cart');
        return redirect()->to('/client');
    }
    public function addQuantity($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = ['quantity' => 1];
        }
        session()->put('cart', $cart);
        $this->mount();
    }
    public function lowQuantity($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
        }
        session()->put('cart', $cart);
        $this->mount();
    }
    public function remove($id)
    {
        session()->forget('cart.'. $id);
        $this->mount();
    }
    public function submit()
    {
        $this->queue = Order::where('date',Carbon::now()->format('Y-m-d'))->count();
        $order = Order::create([
            'date' => Carbon::now()->format('Y-m-d'),
            'queue' => $this->queue + 1,
            'summ' => $this->total,
        ]);
        $carts = session()->get('cart', []);
        foreach ($carts as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'food_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['quantity'] * Food::where('id', $item['product_id'])->value('price'),
            ]);
        }
        session()->forget('cart');
        return redirect()->to('/client');
    }
}
