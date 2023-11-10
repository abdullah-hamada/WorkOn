<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:trainers,id,' . $this->id,
            'mobile' => 'required',
            'job_title' => 'required',
            'description' => 'required',
            'image' => $this->validate_basic_image(),

            'facebook_url' => 'nullable|url',
            'linked_in_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'website_url' => 'nullable|url',

        ];


    }

    public function validate_basic_image()
    {
        if (!empty($this->request->get('id'))) {
            return "nullable|mimes:jpg,png,jpeg|max:1024";
        } else {
            return [
                function ($attribute, $value, $fail) {
                    if (is_file($value) && !in_array($value->getClientOriginalExtension(), ['jpg', 'png', 'jpeg']) && $value->getSize() > '10000000') {
                        $fail('يجب أن يكون الحقل ملفًا من نوع : jpg, png, jpeg. وحجمه اقل من 10 ميجا بايت');
                    } elseif ($value == null) {
                        $fail('حقل الصورة مطلوب');
                    }
                },
            ];
        }

    }

    public function attributes()
    {
        return [
            'facebook_url' => 'رابط الفي بوك',
            'linked_in_url' => 'رابط اللينكد ان',
            'twitter_url' => 'رابط التويتر',
            'instagram_url' => 'رابك اللينكد ان',

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
            'role_id.required' => __('validation.required'),

        ];
    }


}
