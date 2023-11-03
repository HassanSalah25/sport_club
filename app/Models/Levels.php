<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function sports() {

        return $this->belongsToMany('App\Models\Sports','levels_sports','level_id','sport_id');
    }

}
