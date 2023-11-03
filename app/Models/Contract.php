<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['from' , 'to' ];


    public function FromEmplyee(){
        return $this->belongsTo('App\Models\User','from_employee','id');
    }
    public function ToEmplyee(){
        return $this->belongsTo('App\Models\User','to_employee','id');
    }
    public  function contract_details(){
      return $this->hasMany('App\Models\ContractDetails','contract_id','id');
     }

}
