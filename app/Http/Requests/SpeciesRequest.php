<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeciesRequest extends FormRequest
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
            'scientific_name' => 'required|string|max:100',
            'indonesia_name' => 'required|string|max:100',
            'general_name' => 'required|string|max:100',
            'hs_code' => 'required|string|max:100',
            'sp_code' => 'required|string|max:100',
            'nominal' => 'required|string|max:12',
            'description' => 'string|max:6500',
        ];
    }
}
