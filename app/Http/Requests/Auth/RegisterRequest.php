<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:30',
            'email' => 'required|string|email|max:40|unique:users',
            'password' => ['required'],
            'whatsapp_number' => 'required|numeric|starts_with:00',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',

        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('validation.required'),
            'username.string' => __('validation.string'),
            'username.max' => __('validation.max'),
            'password.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'email.unique' => __('validation.unique'),
            'whatsapp_number.required' => __('validation.required'),
        ];
    }
}
