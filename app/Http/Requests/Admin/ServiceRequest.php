<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'image' => $this->validate_basic_image(),
            'title' => 'nullable|max:30',
            'paragraph' => 'nullable',
            'button_text' => 'nullable|max:30',
            'button_url' => 'nullable',
            'description_image' => $this->validate_description_image(),

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

    public function validate_description_image()
    {
        if (!empty($this->request->get('id'))) {
            return "nullable|mimes:jpg,png,jpeg|max:1024";
        } else {
            return [
                function ($attribute, $value, $fail) {
                    if (is_file($value) && !in_array($value->getClientOriginalExtension(), ['jpg', 'png', 'jpeg']) && $value->getSize() > '10000000') {
                        $fail('يجب أن يكون الحقل ملفًا من نوع : jpg, png, jpeg. وحجمه اقل من 10 ميجا بايت');
                    }
                },
            ];
        }

    }

    public function attributes()
    {
        return [
            'paragraph' => 'الفقرة',
            'button_text' => 'عنوان الزر',
            'button_url' => 'رابط الزر',

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
            'button_text.max' => __('validation.max'),

        ];
    }


}
