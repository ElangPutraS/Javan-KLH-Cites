<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
            'city_code'                  => 'required|string|max:3|unique:cities',
            'city_name'                  => 'required|string|max:255',
            'city_name_full'             => 'required|string|max:255',
            'province_id'                => 'required',
            
  ];
    }
}