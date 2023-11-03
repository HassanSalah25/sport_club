<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentSubscriptions extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function tournament(){
        return $this->belongsTo('App\Models\Tournaments', 'tournament_id', 'id');
    }
    public  function players(){
        return $this->hasMany('App\Models\Players','id','player_id');
    }
}
