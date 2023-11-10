<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PrizeRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_supervisor' => 'required|max:200',
            'project_manager' => 'required|max:200',
            'project_description' => 'required',
            'project_prize_previous' => 'required',
            'starting_date' => 'required',
            'implementation_date' => 'required',
            'project_link' => 'nullable|url',
            'project_file' => 'nullable|mimes:pdf|max:104857600',
            "project_image" => "nullable|max:png,jpg,jpeg|max:20240",
            'project_description_file' => 'nullable|mimes:pdf|max:104857600',


//            'criteria_choosing_project' => $request->criteria_choosing_project,
//            'implementation_project_steps' => $request->implementation_project_steps,
//            'project_impact_answer_q1' => $request->project_impact_answer_q1,
//            'project_impact_answer_q2' => $request->project_impact_answer_q2,
//            'project_impact_answer_q3' => $request->project_impact_answer_q3,
//            'project_impact_answer_q4' => $request->project_impact_answer_q4,
//            'project_impact_answer_q5' => $request->project_impact_answer_q5,
//            'project_impact_answer_q6' => $request->project_impact_answer_q6,
//            'project_impact_other_detail' => $request->project_impact_other_detail

        ];

    }


    public function attributes()
    {
        return [
            'project_supervisor' => 'الجهة المشرفة',
            'project_manager' => 'إسم الجهة',
            'project_description' => 'وصف المشروع',
            'project_prize_previous' => '',
            'starting_date' => 'تاريخ التشغيل',
            'implementation_date' => 'تاريخ التنفيذ',
            'project_link' => 'رابط المشروع',
            'project_file' => 'ملف المشروع',
            "project_image" => "صورة المشروع",
            'project_description_file' => 'الملف',
        ];
    }

    public function messages()
    {
        return [


        ];
    }
}
