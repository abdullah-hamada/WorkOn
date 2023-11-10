<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') {
            return [
                'username' => 'required|string|max:30',
                'email' => 'required|string|email|unique:users',
                'password' => ['required'],
                'whatsapp_number' => 'required|numeric|starts_with:00',
                'role_id' => 'required',
                'category_id' => 'required|exists:categories,id',
                'country_id' => 'required|exists:countries,id',
            ];
        } else {
            return [
                'username' => 'required|string|max:30',
                'email' => 'required|string|email|unique:users,id,' . $this->id,
                'whatsapp_number' => 'required',
                'role_id' => 'required',
                'category_id' => 'required|exists:categories,id',
                'country_id' => 'required|exists:countries,id',
            ];
        }


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
            'role_id.required' => __('validation.required'),

        ];
    }
}
