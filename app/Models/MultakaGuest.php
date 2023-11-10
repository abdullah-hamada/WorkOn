<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultakaGuest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function multaka()
    {
        return $this->belongsTo(Multaka::class, 'multaka_id');
    }
}
