<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournaments extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates=['date'];
    public function tournament_branches(){
        return $this->hasMany(TournamentBranches::class,'tournament_id','id');

    }
    public function tournament_files(){
        return $this->hasMany(Tournamentfiles::class ,'tournament_id','id');

    }
    public function tournament_subscriptions(){
        return $this->hasMany(TournamentSubscriptions::class ,'tournament_id','id');

    }

}
