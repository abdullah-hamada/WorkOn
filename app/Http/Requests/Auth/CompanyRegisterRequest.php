<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRegisterRequest extends FormRequest
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

        if (!empty($this->request->get('country_phone_prefix_id'))) {
            $country = Country::query()->whereId($this->request->get('country_phone_prefix_id'))->first();
            $validation_phone = $country->validation_phone;
        } else {
            $validation_phone = '';
        }


        if (User::query()->whereCountryPrefixId($this->country_phone_prefix_id)->whereMobile($this->mobile)->first()) {
            $validation_phone .= "|unique:users";
        }
        return [
            'company_name' => 'required|string|max:255',
            'company_manager' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:' . $validation_phone,
            'country' => 'required',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'country_phone_prefix_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => __('validation.required'),
            'company_name.string' => __('validation.string'),
            'company_name.max' => __('validation.max'),

            'company_manager.string' => __('validation.string'),
            'company_manager.max' => __('validation.max'),
            'company_manager.required' => __('validation.required'),

            'mobile.required' => __('validation.required'),
            'mobile.numeric' => __('validation.numeric'),
            'mobile.unique' => __('validation.unique'),

            'mobile.digits' => __('validation.digits'),

            'country.required' => __('validation.required'),
            'email.required' => __('validation.required'),
            'email.confirmed' => __('validation.confirmed'),
            'email.unique' => __('validation.unique'),

            'password_confirmation.required' => __('validation.required'),
            'country_phone_prefix_id.required' => __('validation.required'),


        ];
    }
}
