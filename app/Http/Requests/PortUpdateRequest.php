<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortUpdateRequest extends FormRequest {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'port_code' => 'required|string|min:3|max:10',
			'port_name' => 'required|string|min:3|max:100'
		];
	}
}