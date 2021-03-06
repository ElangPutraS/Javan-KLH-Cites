<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PnbpPaymentRequest extends FormRequest
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
            'pnbp_amount' => 'required|numeric|digits_between:0,16',
            'transaction_number' => 'string|digits_between:0,30',
        ];
    }
}
