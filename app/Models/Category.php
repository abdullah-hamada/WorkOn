<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use HasFactory;
     protected $guarded=[];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }
}
