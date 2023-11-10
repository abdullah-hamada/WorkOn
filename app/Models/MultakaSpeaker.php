<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultakaSpeaker extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['preview_image'];
    protected $casts = [
        'country_id' => 'integer'
    ];

    public function multaka()
    {
        return $this->belongsTo(Multaka::class, 'multaka_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getPreviewImageAttribute()
    {
        return '/get_file/multaka_speakers_images/' . $this->image;
    }
}
