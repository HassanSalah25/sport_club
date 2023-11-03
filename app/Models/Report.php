<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receipts;
use App\Models\ReceiptsPay;
use Illuminate\Database\Eloquent\Collection;

class Report extends Model
{
    public static function MergeReceipts(){
        $receipts =  Receipts::get();
//        dd($receipts);
        $receiptsPay = ReceiptsPay::get();
            $receiptsAll = $receiptsPay->merge($receipts);
        return $receiptsAll;
    }

}
