<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumsRentTable extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function stadiums()
    {
        return $this->belongsTo('App\Models\Stadium', 'stadium_id', 'id');
    }


    public function traniers(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
