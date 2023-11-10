<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRate;

class RateInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function get_rate_info($user_id, $event_id)
    {
        return response()->json(UserRate::with('question')->where('user_id', $user_id)
            ->where('event_id', $event_id)->whereNotNull('answer')->orWhereNotNull('normal_question_answer')->get());
    }


}
