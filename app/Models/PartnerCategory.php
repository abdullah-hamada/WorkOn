<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public  function getCreatedAtAttribute($val)
    {
        return Carbon::parse( $val)->setTimezone(getTimeZone())->format('Y-m-d H:i');
    }

}
