<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];
    protected $dates=['birth_day'];
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public  function joinAndLeave(){
        return $this->hasMany('App\Models\JoinAndLeave','user_id','id');
    }
    public function  sport_and_level_trainer(){
        return $this->hasMany('App\Models\SportsAndLevelTrainer','user_id','id');
    }

    public function branches()
    {
        return $this->belongsToMany(Branchs::class,'employee_branches',
            'employee_id','branch_id');
    }
}
