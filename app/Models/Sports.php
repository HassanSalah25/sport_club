<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sports extends Model
{
    use HasFactory;
    protected  $guarded=[];
    public function branches() {

        return $this->belongsToMany('App\Models\Branchs','branches_sports','sport_id','branch_id',);
    }
    public function levels(){
        return $this->belongsToMany('App\Models\Levels','levels_sports','level_id','sport_id');
    }

    public function stadium(){
        return $this->hasMany('App\Models\Stadium','sport_id','id');
    }

}
