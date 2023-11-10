<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MultakaExhibitionOrderRequest extends FormRequest
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
            'company_name' => 'required|max:255',
            'company_person_authorized' => 'required|max:255',
            'multaka_id' => 'required',


        ];


    }


    public function messages()
    {
        return [


        ];
    }
}
