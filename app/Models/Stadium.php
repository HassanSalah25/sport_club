<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;
    protected $table='stadium';
    protected $guarded=[];
    public function sports(){
        return $this->belongsTo("App\Models\Sports","sport_id",'id');
    }
    public function branches() {

        return $this->belongsTo('App\Models\Branchs','branch_id','id');
    }
}
