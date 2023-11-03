<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinAndLeave extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates=['date_of_join','date_of_leave'];
    public function trainer(){
        return $this->hasMany('App\Models\User','user_id','id');
    }
}
