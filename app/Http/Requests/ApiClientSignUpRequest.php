<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiClientSignUpRequest extends FormRequest
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
            'country_code' => ['required', 'numeric', 'min:3'],
            'phone_number' => ['required', 'numeric', 'min:6'],
        ];
    }
}
