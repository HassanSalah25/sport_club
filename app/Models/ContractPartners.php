<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPartners extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['from' , 'to' ];


public function partners(){
    return $this->belongsTo('App\Models\Partners','from_company','id');
}
    public function ContractPartners() {

        return $this->belongsToMany('App\Models\Partners','contract_partners_relations','contract_id','partner_id');
    }

}
