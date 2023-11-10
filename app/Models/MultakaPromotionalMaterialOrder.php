<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultakaPromotionalMaterialOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function multaka()
    {
        return $this->belongsTo(Multaka::class, 'multaka_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
