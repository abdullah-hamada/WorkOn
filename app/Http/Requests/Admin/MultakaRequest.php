<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MultakaRequest extends FormRequest
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
        $date_from_validate = '';
        $date_to_validate = '';
        if (!$this->request->get('id')) {
            $date_from_validate = [
                'required',
                function ($attribute, $value, $fail) {
                    // Custom validation logic
                    if (Carbon::parse($value)->setTimezone(getTimeZone())->format('Y-m-d H:i') < Carbon::now()->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
                        $fail('يجب ان يكون تاريخ الانعقاد من بعد التاريخ ' . Carbon::now()->setTimezone(getTimeZone()));
                    }
                },
            ];
            $date_to_validate = "required|after:date_from";
        }

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
//            'date_from' => 'required|after:' . Carbon::yesterday()->format('Y-m-d'),
//            'date_to' =>  'required|after_or_equal:date_from' ,
            'image' => $this->validate_basic_image(),
            'location_type' => 'required',
            'link' => 'required',
            'price_type' => 'required',
            'price_amount' => 'required_if:price_type,=,1|numeric',

            'organizer_named_id' => 'required|exists:guest_nameds,id',
            'organizer_name' => 'required',
            'organizer_info' => 'required',
            'type_id' => 'required|exists:types,id',

            'speakers.*.name' => 'required',
            'speakers.*.job_title' => 'required',
            'speakers.*.image' => $general_image_validation,
            'speakers.*.country_id' => 'required',
            'speakers.*.work_location' => 'required',
            'times.*.date' => 'required',
            'times.*.time_from' => 'required',
            'times.*.time_to' => 'required',
            'times.*.title' => 'required',
            'guest_items.*.name' => 'required',
            'guest_items.*.info' => 'required',
            'date_from' => $date_from_validate,
            "date_to" => $date_to_validate,
            'multaka_files.*.file' => 'required',
            'multaka_files.*.title' => 'required',
            'multaka_gallery.*.image' => $general_image_validation,
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
            'type_id' => 'نوع الملتقى',
            'times.*.date' => 'التاريخ',
            'times.*.time_to' => 'الوقت من',
            'times.*.time_from' => 'الوقت إلى',
            'times.*.title' => 'العنوان',
            'speakers.*.name' => 'المرفق',
            'speakers.*.job_title' => 'عنوان المرفق',
            'speakers.*.title' => 'السؤال',
            'speakers.*.image' => 'النوع',
            'speakers.*.country_id' => 'النوع',
            'speakers.*.work_location' => 'النوع',
            'guest_items.*.name' => 'الضيف',
            'guest_items.*.info' => 'النبذة',
            'multaka_files.*.file' => 'المرفق',
            'multaka_files.*.title' => 'عنوان المرفق',
            'multaka_gallery.*.image' => 'الصورة',
        ];
    }

}
