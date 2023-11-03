<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptsPay extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['date_receipt'];


    public  function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function receiptType(){
        return $this->belongsTo('App\Models\ReceiptTypePay' , 'from','id');
    }
    public function receiptTypeTO(){
        return $this->belongsTo('App\Models\ReceiptTypePay' , 'to','id');
    }
}
