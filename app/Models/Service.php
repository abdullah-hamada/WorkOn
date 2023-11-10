<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends=['preview_image','preview_description_image'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }
    
    public  function  courses(){
        return $this->hasMany(Course::class,'service_id');
    }
    public  function  getPreviewImageAttribute( )
    {
        return '/get_file/service_images/' . $this->image;
    }

    public  function  getPreviewDescriptionImageAttribute( )
    {
        return '/get_file/service_description_images/' . $this->description_image;
    }
    public  function  scopeWhereActive($query){
        return $query->where('status',1);
    }
}
