<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custody extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function receipt_pay(){
        return $this->belongsTo('App\Models\ReceiptsPay','receipt_pay_id','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }


}
