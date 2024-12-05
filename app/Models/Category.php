<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','sort'];
    public function products()
    {
        return $this->hasMany(Food::class);
    }
}
