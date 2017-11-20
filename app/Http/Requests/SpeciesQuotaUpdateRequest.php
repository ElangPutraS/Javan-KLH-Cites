<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpeciesQuotaUpdateRequest extends FormRequest
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
            'quota_amount' => 'required|numeric',
            'year' => [
                'required', 'numeric',
                Rule::unique('species_quota')->ignore($this->segment(5)),
            ],
        ];
    }
}
