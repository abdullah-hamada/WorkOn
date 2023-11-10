<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSubscribe;
use Inertia\Inertia;

class SubscribeController extends Controller
{


    public function user_subscribers()
    {
        $user_subscribes = UserSubscribe::with(['course' => function ($q) {
            $q->with('service:id,name', 'trainer:id,name,job_title')->select('id', 'title', 'price_type', 'service_id', 'trainer_id');
        }])->where('user_id', auth()->user()->id)->select('user_id', 'course_id', 'amount', 'card', 'created_at')->get();
        return Inertia::render('views/user/Courses/Subscribe', [
            'user_subscribes' => $user_subscribes,
            'timezone' => getTimeZone()
        ]);

    }
}
