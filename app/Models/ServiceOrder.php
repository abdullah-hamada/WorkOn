<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $guarded=[];


    public  function  service(){
        return $this->belongsTo(PartnerService::class,'service_id');
    }

    public  function  partner(){
        return $this->belongsTo(PartnerOrder::class,'partner_order_id');
    }

    public  function  user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public  function getCreatedAtAttribute($val)
    {
        return Carbon::parse( $val)->setTimezone(getTimeZone())->format('Y-m-d H:i');
    }
}
