<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        if(auth()->user()->hasRole('Pelaku Usaha')){
            return [
                'email' => [
                    'required','string','email', 'max:255',
                    Rule::unique('users')->ignore(Request::user()->id),
                ],
                'name'                  => 'required|string|max:191',
                'place_birth'           => 'required|string|max:100',
                'date_birth'            => 'required',
                'mobile'                => 'required|numeric|digits_between:0,20',
                'address'               => 'required|string|max:6500',
                'country_id'            => 'required',
                'province_id'           => 'required',
                'city_id'               => 'required',
                'type_identify'         => 'required',
                'identity_number'       => 'required|numeric|digits_between:0,50',
                'company_name'          => 'required|string|max:100',
                'company_address'       => 'required|string|max:6500',
                'company_country_id'    => 'required',
                'company_province_id'   => 'required',
                'company_city_id'       => 'required',
                'company_email'         => 'required|string|email|max:255',
                'company_fax'           => 'required|numeric|digits_between:0,30',
                'company_latitude'      => 'required',
                'company_longitude'     => 'required',
                'owner_name'            => 'required|string|max:191',
                'captivity_address'     => 'required|string|max:6500',
                'labor_total'           => 'required|numeric|digits_between:0,5',
                'investation_total'     => 'required',
                'npwp_number'           => 'required|numeric|digits_between:0,30',
                'npwp_number_user'      => 'required|numeric|digits_between:0,30',
                'date_distribution'     => 'required',
            ];
        }else{
            return [
                'name' => 'required|string|max:191',
                'email' => [
                    'required','string','email', 'max:255',
                    Rule::unique('users')->ignore(Request::user()->id),
                ],
            ];
        }
    }
}
