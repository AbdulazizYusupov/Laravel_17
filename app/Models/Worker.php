<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['user_id','section_id','salary_type','salary','bonus','month_time','start_time','end_time','hours'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
    public function jurnals()
    {
        return $this->hasMany(Jurnal::class,'worker_id');
    }
    public function oyliks()
    {
        return $this->hasMany(Salary::class,'worker_id');
    }
}
