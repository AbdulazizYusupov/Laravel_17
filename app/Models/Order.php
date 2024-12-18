<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['date','queue','summ','status'];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'order_items', 'order_id', 'food_id')
            ->withPivot('quantity', 'total_price', 'status');
    }
    public function user()
    {
        return $this->belongsToMany('App\Models\User','user_orders','order_id','user_id');
    }
}
