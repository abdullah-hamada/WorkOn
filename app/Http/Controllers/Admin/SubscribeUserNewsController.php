<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubscribeNew;
use Inertia\Inertia;

class SubscribeUserNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/SubscribeNewsInfo/UserSubscribeNewsInfo', [
            'user_subscribe_info' => UserSubscribeNew::all()
        ]);
    }
}
