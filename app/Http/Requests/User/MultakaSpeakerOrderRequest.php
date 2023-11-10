<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MultakaSpeakerOrderRequest extends FormRequest
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
            'name' => 'required|max:255',
            'job_title' => 'required|max:255',
            'work_location' => 'required|max:255',
            'country_id' => 'required',
            'image' => 'required',
            'multaka_id' => 'required',
        ];


    }


    public function messages()
    {
        return [


        ];
    }
}
