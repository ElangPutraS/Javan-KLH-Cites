<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpeciesSexUpdateRequest extends FormRequest
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
            'sex_code'     => [
                'required', 'string', 'max:10',
                 Rule::unique('species_sex')->ignore($this->route('speciesSex')),
            ],
            'sex_name'     => 'required|string|max:50',
  ];
    }
}