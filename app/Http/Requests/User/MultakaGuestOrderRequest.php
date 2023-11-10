<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MultakaGuestOrderRequest extends FormRequest
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
            'info' => 'required',

            'multaka_id' => 'required',
        ];


    }


    public function messages()
    {
        return [


        ];
    }
}
