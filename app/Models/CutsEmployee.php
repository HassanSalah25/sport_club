<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutsEmployee extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates=['date'];
    public function employees(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
