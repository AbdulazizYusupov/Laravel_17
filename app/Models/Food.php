<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['name','category_id','price','image'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
