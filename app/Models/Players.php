<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Players extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['birth_day' , 'join_day'];

    public function branches(){
        return $this->belongsTo('App\Models\Branchs','branch_id','id');
    }
    public function sports(){
        return $this->belongsTo('App\Models\Sports','sport_id','id');
    }

    public function players_files(){
        return$this->hasMany('App\Models\PlayersFiles','player_id','id');
    }
    public  function PlayerSportPrice(): HasManyThrough
    {

        return $this->hasManyThrough(Sports::class,PriceList::class,'sport_id','id');

    }
    public function level(){

        return $this->belongsTo('App\Models\Levels','level_id','id');
    }
    public function package(){

        return $this->belongsTo('App\Models\Packages','package_id','id');
    }
    public  function playerPriceLists(){
        return $this->belongsToMany('App\Models\PriceList','player_price_lists','player_id','price_list_id');

    }
    public function attendance (){
        return $this->belongsTo('App\Models\AttendancePlayers','player_id','id');

}
}

