<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebsitePrizePageRequest extends FormRequest
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

            'section_one_item.title' => 'nullable|max:200',
            'section_one_item.paragraph' => 'nullable',
            'section_two_item.title' => 'nullable|max:200',
            'section_two_item.paragraph' => 'nullable',
            'section_two_item.sub_title' => 'nullable|max:200',
            'section_two_item.sub_title_2' => 'nullable',
            'section_three_items.*.title' => 'nullable|max:200',
            'section_four_items.*.title' => 'nullable|max:200',
            'section_four_items.*.paragraph' => 'nullable',
            'section_five_items.*.title' => 'nullable|max:200',
            'section_six_item.title' => 'nullable|max:200',
            'section_six_item.paragraph' => 'nullable',
            'section_six_items.*.title' => 'nullable|max:200',
            'section_seven_items.*.title' => 'nullable|max:200',
            'section_eight_items.*.title' => 'nullable|max:200',
            'section_eight_items.*.paragraph' => 'nullable',

        ];


    }

    public function attributes()
    {
        return [


            'section_one_item.title' => 'العنوان',
            'section_one_item.paragraph' => 'الفقرة',
            'section_two_item.title' => 'العنوان',
            'section_two_item.paragraph' => 'الفقرة',
            'section_two_item.sub_title' => 'العنوان الفرعي',
            'section_two_item.sub_title_2' => 'العنوان الفرعي الثاني',
            'section_three_items.*.title' => 'العنوان',
            'section_four_items.*.title' => 'العنوان',
            'section_four_items.*.paragraph' => 'الفقرة',
            'section_five_items.*.title' => 'العنوان',
            'section_six_item.title' => 'العنوان',
            'section_six_item.paragraph' => 'الفقرة',
            'section_six_items.*.title' => 'العنوان',
            'section_seven_items.*.title' => 'العنوان',
            'section_eight_items.+.title' => 'العنوان',
            'section_eight_items.*.paragraph' => 'الفقرة',


        ];
    }
}
