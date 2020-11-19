<?php


namespace App\Responses;

class ApiErrorCode
{
    const NONE = '';

    # you must provide the missing app's secret key (api key)
    const MERCHANT_API_AUTH_PROVIDE_SECRET_KEY = "MERCHANT_API_AUTH_PROVIDE_SECRET_KEY";
    # the provided secret key (api key) is invalid
    const MERCHANT_API_AUTH_INVALID = "MERCHANT_API_AUTH_INVALID";

    # CLIENT
    # the provided phone number check against libphonenumber is not valid
    const CLIENT_AUTH_PHONE_NUMBER_NOT_VALID = "CLIENT_AUTH_PHONE_NUMBER_NOT_VALID";
    # the provided phone number to signup is already signed up
    const CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST = "CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST";
}
