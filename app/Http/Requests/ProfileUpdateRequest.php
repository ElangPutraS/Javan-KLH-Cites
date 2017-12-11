<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name'                  => 'required|string|max:190',
            'place_birth'           => 'required|string|max:100',
            'date_birth'            => 'required',
            'mobile'                => 'required|numeric|digits_between:0,12',
            'address'               => 'required|string',
            'country_id'            => 'required',
            'province_id'           => 'required',
            'city_id'               => 'required',
            'type_identify'         => 'required',
            'identity_number'       => 'required|numeric|digits_between:0,50',
            'company_name'          => 'required|string|max:100',
            'company_address'       => 'required|string',
            'company_country_id'    => 'required',
            'company_province_id'   => 'required',
            'company_city_id'       => 'required',
            'company_email'         => 'required|string|email|max:255',
            'company_fax'           => 'required|numeric|digits_between:0,30',
            'company_latitude'      => 'required',
            'company_longitude'     => 'required',
        ];
    }
}
