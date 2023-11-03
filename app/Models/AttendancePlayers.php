<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendancePlayers extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function players(){
        return $this->belongsTo('App\Models\Players','player_id','id');
    }
}
