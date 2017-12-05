<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
            'species_category_code' => [
                'required', 'string', 'max:191',
                Rule::unique('categories')->ignore( $this->route('id')),
            ],
            'category_name' => 'required|string|max:191',
        ];
    }
}
