<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptTypePay extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function branches() {

        return $this->belongsTo('App\Models\Branchs','branch_id','id');
    }
}
