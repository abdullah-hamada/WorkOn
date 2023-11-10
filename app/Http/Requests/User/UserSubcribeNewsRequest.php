<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSubcribeNewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_email' => 'required|email|unique:user_subscribe_news,email',

        ];
    }

    public function messages()
    {
        return [
            'user_email.required' => __('validation.required'),
            'user_email.email' => __('validation.email'),
            'user_email.unique' => __('validation.unique'),

        ];
    }
}
