<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['date_from_day', 'date_from_month', 'date_from_in_time_zone', 'date_to_in_time_zone', 'not_subscriber_users_count', 'preview_image', 'is_finish_apply'];
    protected $casts = [
        'location_type' => 'integer',
        'price_type' => 'integer',
        'organizer_named_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function getIsFinishApplyAttribute()
    {
        return Carbon::parse($this->date_from)->format('Y-m-d H:i') >= Carbon::now()->format('Y-m-d H:i') ? 0 : 1;
    }

    public function getPreviewImageAttribute()
    {
        return '/get_file/event_images/' . $this->image;
    }

    public function getDateFromDayAttribute($value)
    {
        return Carbon::parse($this->date_from)->format('d');
    }

    public function getDateFromMonthAttribute($value)
    {
        Carbon::setLocale('ar');
        return Carbon::parse($this->date_from)->format('F');
    }

    public function getDateFromInTimeZoneAttribute()
    {
        return Carbon::parse($this->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }

    public function getDateToInTimeZoneAttribute()
    {
        return Carbon::parse($this->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }

    public function getNotSubscriberUsersCountAttribute($value)
    {
        $count_subscribe_user = UserSubscribe::query()->where('event_id', $this->id)->pluck('user_id');
        return User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->whereNotIn('id', $count_subscribe_user)->count();
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function event_times()
    {
        return $this->hasMany(EventAppointment::class, 'event_id');
    }

    public function files()
    {
        return $this->hasMany(EventFile::class, 'event_id');
    }

    public function gallery_images()
    {
        return $this->hasMany(GalleryImage::class, 'event_id');
    }

    public function rate_questions()
    {
        return $this->hasMany(QuestionRate::class, 'event_id');
    }

    public function user_rate()
    {
        return $this->hasMany(UserRate::class, 'event_id');
    }

    public function subscriber_users()
    {
        return $this->belongsToMany(User::class, 'user_subscribes')->withPivot('created_at','amount','card');
    }

    public function guest_items()
    {
        return $this->hasMany(EventGuest::class, 'event_id');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 1);
    }

}
