<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function item(){
        return $this->belongsTo('App\Models\Items','item_id','id');
    }
}
