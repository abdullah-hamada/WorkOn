<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
     use HasRoles;
    use Billable;
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded=[];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date:Y-m-d H:i',
        'category_id'=>'integer',
        'country_id'=>'integer'

    ];




    public function notifications
    ()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }


    public  function  country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public  function  category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function courses
    ()
    {
        return $this->belongsToMany(Course::class, 'user_subscribes')->withPivot('created_at','amount');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
