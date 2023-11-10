<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyServiceOrderRequest extends FormRequest
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

            'whatsapp_number' => 'required|numeric',
            'country_id' => 'required',
            'city' => 'required',
             'company_name' => 'required',
            'employment_filed' => 'required',
            'company_info' => 'required',
            'website_url' => 'required|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linked_in_url' => 'nullable|url',
            'logo' => [
                function ($attribute, $value, $fail) {
                    if (is_file($value) && !in_array($value->getClientOriginalExtension(), ['jpg', 'png', 'jpeg']) && $value->getSize() > '10000000') {
                        $fail('يجب أن يكون الحقل ملفًا من نوع : jpg, png, jpeg. وحجمه اقل من 10 ميجا بايت');
                    } elseif ($value == null) {
                        $fail('حقل الصورة مطلوب');
                    }
                },
            ],
            'slugn' => 'nullable',
            'communication_officer' => 'required',
            'address' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('partner_orders')->where(function ($query) {
                }),
                Rule::unique('users', 'email')->where(function ($query) {
                }),
            ],
            'service'=>'required',
            'target_number'=>'required',
            'age_group'=>'required',
            'service_description'=>'required',
            'training_time'=>'required',
            'category'=>'required'
        ];


    }


    public function attributes()
    {
        return [
            'whatsapp_number' => 'رقم الواتس اب ',
            'country_id' => 'الدولة',
            'city' => 'المدينة',
            //'category_id' => 'required',
            'partner_category_id' => 'التصنيف',
            'company_name' => 'اسم المؤوسسة',
            'employment_filed' => 'مجال العمل',
            'company_info' => 'نبذة عن المؤوسسة',
            'website_url' => 'الموقع الاكتروني',
            'facebook_url' => 'الفيس بوك',
            'twitter_url' => 'التويتر',
            'instagram_url' => 'الانستقرام',
            'linked_in_url' => 'اللينكد ان',
            'logo' => 'الشعار',
            'slugn' => 'السلوجن',
            'communication_officer' => 'مسؤول التواصل',
            'address' => 'العناون',
            'email' => 'البريد الالكتروني',

            'branches.*.name' => 'الاسم',
            'branches.*.address' => 'العنوان',
            'branches.*.location' => 'الموقع',
            'services.*.price' => 'السعر',
            'services.*.final_price' => 'السعر النهائي',
            'services.*.discount' => 'الخصم',
            'services.*.name' => 'الاسم',
            'privacy_confirmation' => 'حقل الموافقة',
            'service'=>'الخدمة',
            'target_number'=>'العدد المستهدفة ',
            'age_group'=>'الفئة العمرية  ',
            'service_description'=>'وصف الخدمة',
            'training_time'=>'مدة التدريب',
            'category'=>'الفئة المستهدفة'

        ];
    }
}
