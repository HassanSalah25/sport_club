<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function packages_details(){
        return $this->hasMany("App\Models\PackagesDetails","package_id",'id');
    }
    public function sports(){
        return $this->belongsTo("App\Models\Sports","sport_id",'id');
    }



}
