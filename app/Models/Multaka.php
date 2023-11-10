<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multaka extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['is_finish_apply', 'date_from_day', 'date_from_month', 'preview_image', 'date_from_in_time_zone', 'date_to_in_time_zone'];
    protected $casts = [
        'location_type' => 'integer',
        'price_type' => 'integer',
        'organizer_named_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function getPreviewImageAttribute()
    {
        return '/get_file/multaka_logos/' . $this->image;
    }

    public function getIsFinishApplyAttribute()
    {
        return Carbon::parse($this->date_from)->format('Y-m-d H:i') >= Carbon::now()->format('Y-m-d H:i') ? 0 : 1;
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
        return Carbon::parse($this->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s ');
    }

    public function getDateToInTimeZoneAttribute()
    {
        return Carbon::parse($this->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s ');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function agendas()
    {
        return $this->hasMany(MultakaAgenda::class, 'multaka_id');
    }

    public function multaka_speakers()
    {
        return $this->hasMany(MultakaSpeaker::class, 'multaka_id');
    }

    public function multaka_participant_exhibitions()
    {
        return $this->hasMany(MultakaParticipantExhibition::class, 'multaka_id');
    }

    public function promotional_material_order()
    {
        return $this->hasMany(MultakaPromotionalMaterialOrder::class, 'multaka_id');
    }

    public function subscriber_users()
    {
        return $this->belongsToMany(User::class, 'user_subscribes')->withPivot('created_at');
    }

    public function guest_items()
    {
        return $this->hasMany(MultakaGuest::class, 'multaka_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
    }

    public function files()
    {
        return $this->hasMany(MultakaFile::class, 'multaka_id');
    }

    public function gallery_images()
    {
        return $this->hasMany(MultakaGalleryImage::class, 'multaka_id');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 1);
    }
}
