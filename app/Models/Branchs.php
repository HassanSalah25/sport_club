<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{

    use HasFactory;
    protected $guarded=[];

    public function sports() {

        return $this->belongsToMany('App\Models\Sports','branches_sports','sport_id','branch_id');
    }
    public function players(){
        return $this->hasMany('App\Models\Players','branch_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'employee_branches',
            'branch_id','employee_id');
    }
}
