<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $appends=['preview_image'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }
    public  function  getPreviewImageAttribute( )
    {
        return '/get_file/trainer_images/' . $this->image;
    }
    public  function  scopeWhereActive($query){
        return $query->where('status',1);
    }
}
