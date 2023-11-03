<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerAndPlayer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stadiums()
    {
        return $this->belongsTo('App\Models\Stadium', 'stadium_id', 'id');
    }

    public function players()
    {
        return $this->hasMany('App\Models\eventTrainerPlayers', 'player_id', 'id');
    }
    public function EventTrainer(){
        return $this->hasMany('App\Models\EventTrainerPlayers','event_id','id');
    }
    public function traniers(){
        return $this->belongsTo('App\Models\User','trainer_id','id');
    }
    public function sports() {

        return $this->belongsTo('App\Models\Sports','sport_id','id');
    }
    public function event(){
        return $this->hasMany('App\Models\EventTrainerPlayers','event_id','id');

    }
    public function attendance (){
        return $this->belongsTo('App\Models\AttendancePlayers','player_id','id');

    }

}
