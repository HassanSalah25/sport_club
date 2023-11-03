<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function price_list(){
        return $this->belongsTo('App\Models\PriceList','price_list_id','id');
    }

}
