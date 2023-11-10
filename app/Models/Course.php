<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $appends=['is_finish_apply','date_from_day','date_from_month','preview_image' ,'preview_promotional_video_image','date_from_in_time_zone','date_to_in_time_zone'];

    public function getIsFinishApplyAttribute()
    {
        if (Carbon::parse($this->date_to)->format('Y-m-d H:i') >= Carbon::now()->format('Y-m-d H:i')) {
            return false;
            //accept apply
        }
        return true;
    }
    public function getDateFromInTimeZoneAttribute()
    {
        return Carbon::parse($this->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');

    }
    public function getDateToInTimeZoneAttribute()
    {
        return Carbon::parse($this->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');

    }
    public  function  getDateFromDayAttribute($value)
    {
        return Carbon::parse($this->date_from)->format('d');
    }
    public  function  getDateFromMonthAttribute($value)
    {
        Carbon::setLocale('ar');

        return Carbon::parse($this->date_from)->format('F');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }
    public  function  getPreviewImageAttribute( )
    {
        return '/get_file/course_logos/' . $this->image;
    }
    public  function  getPreviewPromotionalVideoImageAttribute( )
    {
        return '/get_file/course_promotional_video_images/' . $this->promotional_video_image;
    }

    public function articles()
    {
        return $this->hasMany(CourseArticle::class, 'course_id');
    }
    public function course_sections()
    {
        return $this->hasMany(CourseSection::class, 'course_id');
    }
    public function  reasons_for_participating_in_course()
    {
        return $this->hasMany(CourseParticipatingReason::class, 'course_id');
    }

    public function  users_benefit_course()
    {
        return $this->hasMany(CourseBenefitType::class, 'course_id');
    }

    public function  course_questions()
    {
        return $this->hasMany(CourseQuestion::class, 'course_id');
    }

    public function  course_opinion_participants()
    {
        return $this->hasMany(CourseOpinion::class, 'course_id');
    }

    public function  course_slider_images()
    {
        return $this->hasMany(CourseSlider::class, 'course_id');
    }


    public function subscriber_users()
    {
        return $this->belongsToMany(User::class, 'user_subscribes')->withPivot('amount','created_at');
    }

   public  function  service(){
       return $this->belongsTo(Service::class, 'service_id');

   }
    public  function  trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    public  function  scopeWhereActive($query){
        return $query->where('status',1);
    }

}
