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
            'quota_amount' => 'required|numeric|digits_between:0,99999999999',
            'year' => [
                'required', 'numeric', 'digits_between:0,4',
                 Rule::unique('species_quota')->where(function ($query) {
                     return $query->where('species_id', $this->segment(3));
                 })->ignore($this->segment(5)),
            ],
        ];
    }
}
