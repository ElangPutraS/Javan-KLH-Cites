<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyQuotaUpdateRequest extends FormRequest
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
            'species_id' =>[
                'required',
                Rule::unique('company_quota')->where(function ($query) {
                    return $query->where([['company_id', $this->route('company_id')],['year', Request::input('year')]]);
                })->ignore( $this->route('id')),
            ],
            'realization' => 'required|numeric|digits_between:0,9',
            'quota_amount' => 'required|numeric|digits_between:0,9',
            'year' => [
                'required', 'numeric', 'digits_between:0,4',
                Rule::unique('company_quota')->where(function ($query) {
                    return $query->where([['company_id', $this->route('company_id')], ['species_id', Request::input('species_id')]]);
                })->ignore( $this->route('id')),
            ],
        ];
    }
}
