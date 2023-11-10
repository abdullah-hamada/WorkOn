<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubscribe;
use Inertia\Inertia;

class SubscribeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function show_subscribe_user_info($type, $id, $user_id)
    {

        if ($type == 'multaka') {
            $user_info = UserSubscribe::with(['user:id,name', 'event', 'multaka', 'country:id,name_ar'])
                ->where('multaka_id', $id)
                ->where('user_id', $user_id)->first();
        } else if ($type == 'event') {
            $user_info = UserSubscribe::with(['user:id,name', 'event', 'multaka', 'country:id,name_ar'])
                ->where('event_id', $id)
                ->where('user_id', $user_id)->first();

        }
        return Inertia::render('views/admin/Subscriber/UserSubscribeInfo', [
            'user_info' => $user_info
        ]);
    }
}
