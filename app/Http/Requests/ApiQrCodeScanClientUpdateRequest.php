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
            'mobile_id' => ["required", "uuid", 'exists:operations,id'],
            'carrier_id' => ["required", 'exists:carriers,id'],
            'ussd_content' => ["required"],
            'sms_content' => ["nullable"],
            'phone_number' => ["nullable"],
        ];
    }
}
