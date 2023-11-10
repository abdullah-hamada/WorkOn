<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestNamed extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'created_at' => 'date:Y-m-d H:i'
    ];

}