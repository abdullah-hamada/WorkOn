<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\MotivationalMessage;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/dashboard/AdminDashboard', [
            'users_count' => User::count(),
            'courses_count' => Course::count(),
            'latest_courses' => Course::query()->withCount('subscriber_users')->latest()->limit(3)->get(),
            'roles_count' => Role::count(),
            'permissions_count' => Permission::count(),
            'countries_count' => Country::count(),
            'categories_count' => Category::count(),
            'random_message' => MotivationalMessage::query()->get()->random()->title


        ]);
    }


}
