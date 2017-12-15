<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionDirectRequest extends FormRequest
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
            'description.*'             => 'required|max:6500',
            'consignee'                 => 'required|max:6500',
            'consignee_address'         => 'required|max:6500',
            'document_trade_permit.*'   => 'required|max:8000',
            'document_type_id.*'        => 'required',
            'species_id.*'              => 'required',
            'quantity.*'                => 'required',
        ];
    }
}
