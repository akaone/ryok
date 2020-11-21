<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiClientPassRequest extends FormRequest
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
            "token_fcm" => ["required"],
            "password" => ["required", "min:6"],
            "confirm_password" => ["required", "min:6", "same:password"],
            'country_code' => ['required', 'numeric', 'min:3'],
            'phone_number' => ['required', 'numeric', 'min:6'],
            'sms_code' => ['required', 'min:6'],
        ];
    }
}
