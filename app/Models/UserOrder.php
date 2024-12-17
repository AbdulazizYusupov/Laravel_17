<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['user_id','order_id'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_orders', 'order_id', 'user_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'user_orders', 'user_id', 'order_id');
    }
}
