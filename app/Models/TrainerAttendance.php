<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerAttendance extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function traniers(){
        return $this->belongsTo('App\Models\User','trainer_id','id');
    }
}
