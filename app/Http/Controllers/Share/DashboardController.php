<?php

namespace App\Http\Controllers\Share;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MotivationalMessage;
use App\Models\Notification;
use App\Models\PartnerOrder;
use App\Models\UserSubscribe;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user|partner');
    }

    public function index()
    {

        if(auth()->user()->hasRole('user')){
            return Inertia::render('views/dashboard/UserDashboard', [
                'courses' => Course::orderBy('date_from', 'desc')->get(),
                'subscribe_courses_count' => UserSubscribe::query()->where('user_id', auth()->user()->id)->count(),
                'notification_count' => Notification::query()->where('user_id', auth()->user()->id)->count(),
                'random_message' => MotivationalMessage::query()->get()->random()->title,
            ]);
        }elseif(auth()->user()->hasRole('partner')){
           if( PartnerOrder::query()->where('user_id',auth()->user()->id)
               ->where('status',4)->where('cancel_order_request',1)->first()){
               return redirect('/')->with('error', 'تم الغاء طلب الشراكة ');


           }else{
               return  redirect('/dashboard/partner');

           }
        }

    }


}
