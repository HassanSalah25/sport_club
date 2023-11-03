<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementRequest extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function custody(){
        return $this->belongsTo("App\Models\Custody",'custody_id','id');
    }
    public function receiptTypeTO(){
        return $this->belongsTo('App\Models\ReceiptTypePay' , 'to','id');
    }
}
