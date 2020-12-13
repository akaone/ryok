<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiQrCodeScanClientUpdateRequest extends FormRequest
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
            'client_id' => ["required", "uuid"],
            'mobile_id' => ["required", "uuid"],
            'carrier_id' => ["required"],
            'ussd_content' => ["required"],
            'sms_content' => ["required"],
            'phone_number' => ["required"],
        ];
    }
}
