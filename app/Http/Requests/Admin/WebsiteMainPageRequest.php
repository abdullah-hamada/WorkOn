<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteMainPageRequest extends FormRequest
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
            'header_items.*.title' => 'nullable|max:200',
            'header_items.*.url' => 'nullable',
            'header_items.*.order' => 'nullable|numeric',


            'section_one_item.title' => 'nullable|max:200',
            'section_one_item.paragraph' => 'nullable',
            'section_one_item.button_url' => 'nullable|max:200|url',
            'section_one_item.button_text' => 'nullable|max:200',
            'section_one_item.image' => 'nullable',


            'section_two_item.title' => 'nullable|max:200',
            'section_two_item.paragraph' => 'nullable',
            'section_two_item.image' => 'nullable',
            'section_two_item.button_url' => 'nullable|url',


            'section_three_item.title' => 'nullable|max:200',


            'section_three_items.*.title' => 'nullable|max:200',
            'section_three_items.*.sub_title' => 'nullable|max:200',
            'section_three_items.*.image' => 'nullable',


            'section_four_item.title' => 'nullable|max:200',
            'section_four_item.paragraph' => 'nullable',
            'section_four_item.button_url' => 'nullable|max:200|url',
            'section_four_item.button_text' => 'nullable|max:200',
            'section_four_item.image' => 'nullable',

            'section_five_item.title' => 'nullable|max:200',
            'section_five_item.paragraph' => 'nullable',
            'section_five_items.*.title' => 'nullable|max:200',
            'section_five_items.*.sub_title' => 'nullable|max:200',
            'section_five_items.*.image' => 'nullable',
            'section_six_item.title' => 'nullable|max:200',
            'section_six_items.*.title' => 'nullable|max:200',
            'section_six_items.*.image' => 'nullable',
            'section_six_items.*.sub_title' => 'nullable|max:200',
            'section_six_items.*.button_url' => 'nullable|url',

            'section_seven_item.title' => 'nullable|max:200',


            'section_seven_items.*.title' => 'nullable|max:200',
            'section_seven_items.*.sub_title' => 'nullable|max:200',
            'section_seven_items.*.image' => 'nullable',


            'section_nine_item.title' => 'nullable|max:200',
            'section_nine_item.paragraph' => 'nullable',
            'section_nine_item.button_url' => 'nullable|max:200|url',
            'section_nine_item.button_text' => 'nullable|max:200',

            'section_ten_item.title' => 'nullable|max:200',
            'section_ten_item.paragraph' => 'nullable',


            'section_ten_items.*.title' => 'nullable|max:200',
            'section_ten_items.*.sub_title' => 'nullable|max:200',
            'section_ten_items.*.image' => 'nullable',
            'section_ten_items.*.twitter_url' => 'nullable|max:200|url',
            'section_ten_items.*.linked_in_url' => 'nullable|max:200|url',
            'section_ten_items.*.instagram_url' => 'nullable|max:200|url',
            'section_ten_items.*.facebook_url' => 'nullable|max:200|url',


            'section_eleven_item.title' => 'nullable|max:200',
            'section_eleven_item.paragraph' => 'nullable',
            'section_eleven_item.button_url' => 'nullable|max:200|url',
            'section_eleven_item.button_text' => 'nullable|max:200',
            'section_eleven_item.image' => 'nullable',
            'section_twelve_item.title' => 'nullable|max:200',

            'section_twelve_items.*.title' => 'nullable|max:200',
            'section_twelve_items.*.paragraph' => 'nullable',
            'section_twelve_items.*.sub_title' => 'nullable|max:200',
            'section_twelve_items.*.image' => 'nullable',


            'social_media_items.*.title' => 'nullable|max:200',
            'social_media_items.*.url' => 'nullable|url',
            'footer_item.paragraph' => 'nullable',
            'footer_items.*.button_url' => 'nullable|max:200|url',
            'footer_items.*.button_text' => 'nullable|max:200',

        ];


    }

    public function attributes()
    {
        return [

            'header_items.*.title' => 'العنوان',
            'header_items.*.url' => 'الرابط',
            'header_items.*.order' => 'الترتيب',
            'section_one_item.title' => 'العنوان',
            'section_one_item.paragraph' => 'الفقرة',
            'section_one_item.button_url' => 'رابط الزر',
            'section_one_item.button_text' => 'عنوان الزر',
            'section_one_item.image' => 'الصورة',
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
            'section_five_item.title' => 'العنوان',
            'section_five_item.paragraph' => 'الفقرة',
            'section_five_items.*.title' => 'العنوان',
            'section_five_items.*.sub_title' => 'العنوان الفرعي',
            'section_five_items.*.image' => 'الصورة',
            'section_six_item.title' => 'العنوان',
            'section_six_items.*.title' => 'العنوان',
            'section_six_items.*.image' => 'الصورة',
            'section_seven_item.title' => 'العنوان',
            'section_seven_items.*.title' => 'العنوان',
            'section_seven_items.*.sub_title' => 'العنوان الفرعي',
            'section_seven_items.*.image' => 'الصورة',
            'section_nine_item.title' => 'العنوان',
            'section_nine_item.paragraph' => 'الفقرة',
            'section_nine_item.button_url' => 'رابط الزر',
            'section_nine_item.button_text' => 'عنوان الزر',
            'section_ten_item.title' => 'العنوان',
            'section_ten_item.paragraph' => 'الفقرة',
            'section_ten_items.*.title' => 'العنوان',
            'section_ten_items.*.sub_title' => 'العنوان الفرعي',
            'section_ten_items.*.image' => 'الصورة',
            'section_ten_items.*.twitter_url' => 'رابط التوبتر',
            'section_ten_items.*.linked_in_url' => 'رابط اليينكد ان',
            'section_ten_items.*.instagram_url' => 'رابط الانستقرام',
            'section_ten_items.*.facebook_url' => 'رابط الفيس بوك',
            'section_eleven_item.title' => 'العنوان',
            'section_eleven_item.paragraph' => 'الفقرة',
            'section_eleven_item.button_url' => 'رابط الزر',
            'section_eleven_item.button_text' => 'عنوان الزر',
            'section_eleven_item.image' => 'الصورة',
            'section_twelve_item.title' => 'العنوان',
            'section_twelve_items.*.title' => 'العنوان',
            'section_twelve_items.*.paragraph' => 'الفقرة',
            'section_twelve_items.*.sub_title' => 'العنوان الفرعي',
            'section_twelve_items.*.image' => 'الصورة',
            'social_media_items.*.title' => 'العنوان',
            'social_media_items.*.url' => 'الرابط',
            'footer_item.title' => 'العنوان',
            'footer_item.paragraph' => 'الفقرة',

            'footer_items.*.button_url' => 'رابط الزر',
            'footer_items.*.button_text' => 'عنوان الزر',
        ];
    }
}
