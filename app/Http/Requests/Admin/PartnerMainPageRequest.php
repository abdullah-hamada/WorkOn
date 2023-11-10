<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerMainPageRequest extends FormRequest
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


        // dd($this->request->all());
        return [


            'slider_items.*.title' => 'required|max:200',
            'slider_items.*.paragraph' => 'required',
            'slider_items.*.button_url' => 'required|max:200|url',
            'slider_items.*.button_text' => 'required|max:200',
            'slider_items.*.image' => 'required',


            'section_two_item.title' => 'required|max:200',
            'section_two_item.paragraph' => 'required',
            'section_two_item.image' => 'required',


            'section_three_item.title' => 'required|max:200',
            'section_three_items.*.title' => 'required|max:200',
            'section_three_items.*.sub_title' => 'required|max:200',
            'section_three_items.*.image' => 'required',

            'section_four_item.title' => 'required|max:200',
            'section_four_item.paragraph' => 'required',
            'section_four_item.button_url' => 'required|max:200|url',
            'section_four_item.button_text' => 'required|max:200',
            'section_four_item.image' => 'required',


            'section_six_item.title' => 'required|max:200',
            'section_six_items.*.title' => 'required|max:200',
            'section_six_items.*.paragraph' => 'required',
            'section_six_items.*.sub_title' => 'required|max:200',
            'section_six_items.*.image' => 'required',


        ];


    }

    public function attributes()
    {
        return [

            'slider_items.*.title' => 'العنوان',
            'slider_items.*.paragraph' => 'الفقرة',
            'slider_items.*.button_url' => 'رابط الزر',
            'slider_items.*.button_text' => 'عنوان الزر',
            'slider_items.*.image' => 'الصورة',

            'section_two_item.title' => 'العنوان',
            'section_two_item.paragraph' => 'الفقرة',
            'section_two_item.image' => 'الصورة',


            'section_three_item.title' => 'العنوان',
            'section_three_items.*.title' => 'العنوان',
            'section_three_items.*.sub_title' => 'العنوان الفرعي',
            'section_three_items.*.image' => 'الصورة',


            'section_four_item.title' => 'العنوان',
            'section_four_item.paragraph' => 'الفقرة',
            'section_four_item.button_url' => 'رابط الزر',
            'section_four_item.button_text' => 'عنوان الزر',
            'section_four_item.image' => 'الصورة',


            'section_six_item.title' => 'العنوان',
            'section_six_items.*.title' => 'العنوان',
            'section_six_items.*.paragraph' => 'الفقرة',
            'section_six_items.*.sub_title' => 'العنوان الفرعي',
            'section_six_items.*.image' => 'الصورة',

        ];
    }
}
