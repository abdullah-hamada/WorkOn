<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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


        $validate = '';
        if (!$this->request->get('id')) {
            $validate = 'required';
        }
        $data = [
            'title' => 'required|max:255',
            'brief_explanation' => 'required|max:255',

            'time_from' => 'required',
            'time_to' => 'required',
            'location_type' => 'required',
            'link' => 'required|url',
            'price_type' => 'required',
            'price_amount' => 'required',
            'organizer_named_id' => 'required',
            'organizer_name' => 'required',
            'organizer_info' => 'required',
//            'guest_name' => 'required',
//            'guest_info' => 'required',
            'event_type' => 'required',
            'image' => $validate,
        ];


        if ($this->request->get('id') == null) {
            $data['date_from'] = 'required|after:' . Carbon::yesterday()->format('Y-m-d');
            $data['date_to'] = 'required|after_or_equal:date_from';
        } else {
            $data['date_from'] = 'required';
            $data['date_to'] = 'required|after_or_equal:date_from';
        }
        return $data;

    }


    public function messages()
    {
        return [


        ];
    }
}
