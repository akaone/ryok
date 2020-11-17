<?php


namespace App\Responses;

class ApiErrorCode
{
    const NONE = '';

    # you must provide the missing app's secret key (api key)
    const MERCHANT_API_AUTH_PROVIDE_SECRET_KEY = 'MERCHANT_API_AUTH_PROVIDE_SECRET_KEY';
    # the provided secret key (api key) is invalid
    const MERCHANT_API_AUTH_INVALID = 'MERCHANT_API_AUTH_INVALID';
}
