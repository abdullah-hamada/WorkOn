<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAgenda;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $courses = Course::with('service:id,name')->whereActive();
        if (isset($request->title)) {
            $courses = $courses->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $courses = $courses->orderBy('date_from', $request->sort ?? 'desc');
        } else {
            $courses = $courses->orderByDesc('id');
        }
        return Inertia::render('views/user/Courses/Index', [
            'courses' => $courses->select('id', 'title', 'date_from', 'date_to', 'price_before_discount', 'price_after_discount', 'price_type', 'status', 'service_id')->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()
        ]);
    }
}
