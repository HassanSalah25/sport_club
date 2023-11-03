<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Branch(){

        return $this->belongsTo('App\Models\Branchs','branch_id','id');
    }
    public function sports(){

        return $this->belongsTo('App\Models\Sports','sport_id');
    }
    public function level(){

        return $this->belongsTo('App\Models\Levels','level_id','id');
    }
}
