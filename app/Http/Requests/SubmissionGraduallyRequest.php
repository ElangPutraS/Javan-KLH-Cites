<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionGraduallyRequest extends FormRequest
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
            'document_trade_permit.*'   => 'required|max:8000',
            'document_type_id.*'        => 'required',
            'species_id.*'        => 'required',
            'quantity.*'        => 'required',
        ];
    }
}
