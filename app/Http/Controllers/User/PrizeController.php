<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PrizeRegisterRequest;
use App\Models\PrizeRegister;
use Inertia\Inertia;

class PrizeController extends Controller
{
    public function store(PrizeRegisterRequest $request)
    {

        if (PrizeRegister::query()->where('user_id', auth()->user()->id)->first()) {
            return redirect()->back()->with('error', 'تم التفديممن قبل');

        }

        $data = ['user_id' => auth()->user()->id,
            'project_supervisor' => $request->project_supervisor,
            'project_manager' => $request->project_manager,
            'project_description' => $request->project_description,
            'project_prize_previous' => $request->project_prize_previous,
            'starting_date' => $request->starting_date,
            'implementation_date' => $request->implementation_date,
            'project_link' => $request->project_link,
            'project_budget' => $request->project_budget,
            'criteria_choosing_project' => $request->criteria_choosing_project,
            'implementation_project_steps' => $request->implementation_project_steps,
            'project_impact_answer_q1' => $request->project_impact_answer_q1,
            'project_impact_answer_q2' => $request->project_impact_answer_q2,
            'project_impact_answer_q3' => $request->project_impact_answer_q3,
            'project_impact_answer_q4' => $request->project_impact_answer_q4,
            'project_impact_answer_q5' => $request->project_impact_answer_q5,
            'project_impact_answer_q6' => $request->project_impact_answer_q6
        ];


        if (isset($request->project_file) && !empty($request->project_file) && $request->project_file != null) {
            $data['project_file'] = $request->project_file->hashName();
            uploadImage('prize_register_images', $request->project_file);
        }
        if (isset($request->project_image) && !empty($request->project_image) && $request->project_image != null) {
            $data['project_image'] = $request->project_image->hashName();
            uploadImage('prize_register_images', $request->project_image);
        }
        if (isset($request->project_description_file) && !empty($request->project_description_file) && $request->project_description_file != null) {
            $data['project_description_file'] = $request->project_description_file->hashName();
            uploadImage('prize_register_images', $request->project_description_file);
        }

        if (isset($request->project_impact_other_detail_status) && $request->project_impact_other_detail_status == 1) {
            $data['project_impact_other_detail'] = $request->project_impact_other_detail;

        }

        $status = PrizeRegister::query()->create($data);

        if ($status) {
            return redirect()->back()->with('success', 'تم التفديم على الجائزة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');

        }
    }

    public function create()
    {
        session([
            'last_page_url' => url()->current()
        ]);
        return Inertia::render('views/user/Prize/Create', [
            'register_before' => PrizeRegister::query()->where('user_id', auth()->user()->id)->first() ? 1 : 0
        ]);
    }


}
