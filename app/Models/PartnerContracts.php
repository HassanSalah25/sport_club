<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerContracts extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function branch() {

        return $this->belongsTo('App\Models\Branchs','branch_id','id');
    }
}
