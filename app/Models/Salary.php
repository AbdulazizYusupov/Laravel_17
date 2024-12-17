<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'worker_id',
        'date',
        'type',
        'given',
        'left',
        'salary'
    ];
    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }
}
