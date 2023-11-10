<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerOrder extends Model
{
    use HasFactory;

    protected $guarded=[];

    public  function  country(){
        return $this->belongsTo(Country::class ,'country_id');
    }

    public  function  category(){
        return $this->belongsTo(PartnerCategory::class ,'partner_category_id');
    }

    public  function  services(){
        return $this->hasMany(PartnerService::class ,'partner_order_id');
    }

    public  function  branches(){
        return $this->hasMany(PartnerBranch::class ,'partner_order_id');
    }
}
