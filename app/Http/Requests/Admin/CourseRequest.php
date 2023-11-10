<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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

        $general_image_validation = [
            function ($attribute, $value, $fail) {
                if (is_file($value) && !in_array($value->getClientOriginalExtension(), ['jpg', 'png', 'jpeg']) && $value->getSize() > '10000000') {
                    $fail('يجب أن يكون الحقل ملفًا من نوع : jpg, png, jpeg. وحجمه اقل من 10 ميجا بايت');
                } elseif ($value == null) {
                    $fail('حقل الصورة مطلوب');
                }
            },
        ];
        return [
            'title' => 'required|max:255',
            'brief_explanation' => 'required|max:255',


            'price_before_discount' => [
                'required_if:price_type,1',
                function ($attribute, $value, $fail) {
                    // Custom validation logic
                    if ($this->request->get('price_type') == 1 && !is_numeric($value)) {
                        $fail('يجب ان يكون حقل السعر قبل الخصم رقما فقط ');
                    }
                },
            ],

            'price_after_discount' => [
                'required_if:price_type,1',
                function ($attribute, $value, $fail) {
                    // Custom validation logic
                    if ($this->request->get('price_type') == 1) {
                        if (!is_numeric($value)) {
                            $fail('يجب ان بعد حقل السعر قبل الخصم رقما فقط ');
                        } else if ($value > $this->request->get('price_before_discount')) {
                            $fail('يجب ان يكون حقل السعر بعد الخصم اقل من حقل السعر قبل الخصم ');
                        }
                    }

                },
            ],


            'service_id' => 'required|exists:services,id',
            'image' => $this->validate_basic_image(),
            'date_from' => [
                'required',
//                function ($attribute, $value, $fail) {
//                    // Custom validation logic
//                     if (empty($this->request->get('id')) && Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i') < Carbon::now()->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
//                        $fail('يجب ان يكون تاريخ الانعقاد من بعد التاريخ ' . Carbon::now()->setTimezone(getTimeZone()));
//                    }
//                },
            ],
            "date_to" => "required|after:date_from",
            'price_type' => 'required',
            'trainer_id' => 'required|exists:trainers,id',
            'articles.*.title' => 'required|max:200',
            'articles.*.paragraph' => 'required',
            'articles.*.image' => $general_image_validation,
            'reasons_for_participating_in_course.*.title' => 'required|max:200',
            'reasons_for_participating_in_course.*.image' => $general_image_validation,
            'course_sections.*.title' => 'required|max:200',
            'course_sections.*.paragraph' => 'required',
            'users_benefit_course.*.title' => 'required|max:200',
            'users_benefit_course.*.image' => $general_image_validation,
            'course_questions.*.question' => 'required|max:200',
            'course_questions.*.answer' => 'required',
            'course_opinion_participants.*.video_url' => 'required|url',
            'course_opinion_participants.*.image' => $general_image_validation,
            'course_slider_images.*.title' => 'required|max:200',
            'course_slider_images.*.image' => $general_image_validation,
            'course_promotional_video.title' => 'nullable|max:200',
            'course_promotional_video.video_url' => 'nullable',
            'course_promotional_video.image' => $this->validate_basic_image(),
            'lectures_link' => 'required|url',
        ];
    }

    public function validate_basic_image()
    {
        if (!empty($this->request->get('id'))) {
            return "nullable|mimes:jpg,png,jpeg|max:10000000";
        } else {
            return [
                function ($attribute, $value, $fail) {
                    if (is_file($value) && !in_array($value->getClientOriginalExtension(), ['jpg', 'png', 'jpeg']) && $value->getSize() > '10000000') {
                        $fail('يجب أن يكون الحقل ملفًا من نوع : jpg, png, jpeg. وحجمه اقل من 10 ميجا بايت');
                    } elseif ($value == null && $attribute == '') {
                        $fail('حقل الصورة مطلوب');
                    }
                },
            ];
        }

    }

    public function attributes()
    {
        return [
            'price_before_discount' => 'السعر قبل الخصم',
            'price_after_discount' => 'السعر بعد الخصم',
            'trainer_id' => 'المدرب',
            'service_id' => 'الخدمة',
            'articles.*.title' => 'العنوان',
            'articles.*.paragraph' => 'الفقرة',
            'articles.*.image' => 'الصورة',
            'reasons_for_participating_in_course.*.title' => 'العنوان',
            'reasons_for_participating_in_course.*.image' => 'الصورة',
            'course_sections.*.title' => 'العنوان',
            'course_sections.*.paragraph' => 'العنوان',
            'users_benefit_course.*.title' => 'العنوان',
            'users_benefit_course.*.image' => 'الصورة',
            'course_questions.*.question' => 'السؤال',
            'course_questions.*.answer' => 'الجواب',
            'articles.*.video_url' => 'رابط الفيديو',
            'course_opinion_participants.*.image' => 'الصورة',
            'course_slider_images.*.title' => 'العنوان',
            'course_slider_images.*.image' => 'الصورة',
            'course_promotional_video.title' => 'العنوان',
            'course_promotional_video.video_url' => 'رابط الفيديو',
            'course_promotional_video.image' => 'الصورة',
            'course_opinion_participants.*.video_url' => 'رابط الفيديو',
            'lectures_link' => 'رابط المحاضرات'

        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
