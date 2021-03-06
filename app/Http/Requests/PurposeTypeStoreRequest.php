<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurposeTypeStoreRequest extends FormRequest
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
            'purpose_type_code'     => 'required|string|max:10|unique:purpose_type',
            'purpose_type_name'     => 'required|string|max:50',
  ];
    }
}