<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeEventRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required|email',
            'whatsapp_number' => 'required|numeric',
            // 'job_title' =>'required',
            'user_type' => 'required',
            //   'employment_area' => 'required',
            //   'website_url' => 'nullable|url',
//             'facebook_url' => 'nullable|url',
//             'instagram_url' => 'nullable|url',
//             'linkedIn_url' => 'nullable|url',
//             'image' =>'required',
        ];

    }


    public function messages()
    {
        return [


        ];
    }
}
