<?php


namespace App\Responses;

class ApiErrorCode
{
    const NONE = "";
    const INVALID_INPUT = "INVALID_INPUT";

    # client is trying to perform action requiring sign-in without providing the jwt token
    const PLEASE_LOGIN_FIRST_JWT_MISSING = "PLEASE_LOGIN_FIRST_JWT_MISSING";
    const CANNOT_DECODE_JWT = "CANNOT_DECODE_JWT";
    const JWT_TOKEN_EXPIRED = "JWT_TOKEN_EXPIRED";
    const USER_DOES_NOT_EXIST = "USER_DOES_NOT_EXIST";
    const YOU_HAVE_LOGIN_ON_ANOTHER_DEVICE = "YOU_HAVE_LOGIN_ON_ANOTHER_DEVICE";
    const ACCOUNT_IS_NOT_ACTIVATED = "ACCOUNT_IS_NOT_ACTIVATED";

    # you must provide the missing app's secret key (api key)
    const MERCHANT_API_AUTH_PROVIDE_SECRET_KEY = "MERCHANT_API_AUTH_PROVIDE_SECRET_KEY";
    # the provided secret key (api key) is invalid
    const MERCHANT_API_AUTH_INVALID = "MERCHANT_API_AUTH_INVALID";
    # merchant cannot generate live payment request when the app is not activated
    const MERCHANT_APP_IS_NOT_ACTIVATED = "MERCHANT_APP_IS_NOT_ACTIVATED";
    # cannot find the operation (payment) the merchant is looking for
    const MERCHANT_OPERATION_NOT_FOUND = "MERCHANT_OPERATION_NOT_FOUND";

    # CLIENT
    # the provided phone number check against libphonenumber is not valid
    const CLIENT_AUTH_PHONE_NUMBER_NOT_VALID = "CLIENT_AUTH_PHONE_NUMBER_NOT_VALID";
    # the provided phone number to signup is already signed up
    const CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST = "CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST";
    # the sms code is incorrect
    const CLIENT_AUTH_INVALID_SMS_CODE = "CLIENT_AUTH_INVALID_SMS_CODE";
    # wrong credentials provided for login
    const CLIENT_AUTH_WRONG_CREDENTIALS = "CLIENT_AUTH_WRONG_CREDENTIALS";

    # SCAN QR CODE
    # user/client cannot pay for this operation because the operation is pending
    const CANNOT_PAY_OPERATION_IS_PENDING = "CANNOT_PAY_OPERATION_IS_PENDING";
    # user/client cannot pay for this operation because the operation is paid
    const CANNOT_PAY_OPERATION_IS_PAID = "CANNOT_PAY_OPERATION_IS_PAID";
    # user/client cannot pay for this operation because the operation is expired
    const CANNOT_PAY_OPERATION_IS_EXPIRED = "CANNOT_PAY_OPERATION_IS_EXPIRED";
    # user/client cannot pay for this operation because the operation is failed
    const CANNOT_PAY_OPERATION_IS_FAILED = "CANNOT_PAY_OPERATION_IS_FAILED";
    #
    const SELLER_OPERATION_DOESNT_EXIST = "SELLER_OPERATION_DOESNT_EXIST";
}
