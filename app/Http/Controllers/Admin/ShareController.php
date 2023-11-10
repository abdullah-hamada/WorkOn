<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\UserSubscribeNew;
use Inertia\Inertia;

class ShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function subscribe_user_in_news()
    {
        return Inertia::render('views/admin/Share/UserSubscribeNewsInfo', [
            'user_subscribe_info' => UserSubscribeNew::all()
        ]);
    }

    public function contact_us()
    {
        return Inertia::render('views/admin/Share/ContactUs', [
            'contact_us' => ContactUs::all()
        ]);
    }
}
