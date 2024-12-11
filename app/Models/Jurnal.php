<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['worker_id','user_id','date','start_time','end_time','time'];

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
