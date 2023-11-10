<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseArticle extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $appends=['preview_image'];

    public  function  getPreviewImageAttribute( )
    {
        return '/get_file/course_articles/' . $this->image;
    }
}
