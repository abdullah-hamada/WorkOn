<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteControl extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $appends=['preview_image'];

    public  function  scopeWhereTag($query,$tag){
        return $query->where('tag',$tag);
    }
    public  function  scopeWherePage($query,$page){
        return $query->where('page',$page);
    }

    public  function  getPreviewImageAttribute()
    {
        if($this->image != null){
            return '/get_file/website_images/' . $this->image;
        }
        return '/get_file/website_images/logo.jfif' ;
    }
}
