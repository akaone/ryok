<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiClientLoginRequest;
use App\Http\Requests\ApiClientPassRequest;
use App\Http\Requests\ApiClientSignUpRequest;
use App\Repositories\Api\ApiClientAuthRepository;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class ClientAuthController extends Controller
{
    /**
     *
     * @OA\Post(
     *     path="/client/signup",
     *     tags={"auth"},
     *     summary="Creation d'un compte client etape 1 []",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  @OA\Property(property="country_code", description="Client's country calling code", enum={"228", "229"}),
     *                  @OA\Property(property="phone number", description="Client's phone number"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="SUCCESS"),
     *     @OA\Response(response=201, description="CLIENT_AUTH_PHONE_NUMBER_NOT_VALID"),
     *     @OA\Response(response=202, description="CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST"),
     *
     * )
     * @param ApiClientSignUpRequest $request
     * @param ApiClientAuthRepository $clientAuthRepository
     * @return JsonResponse
     * @throws NumberParseException
     */
    public function store(ApiClientSignUpRequest $request, ApiClientAuthRepository $clientAuthRepository)
    {

        $countryCode = $request->input('country_code');
        $phoneNumber = $request->input('phone_number');

        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsedPhoneNumber = $phoneUtil->parse("+{$countryCode}{$phoneNumber}");
        $isValid = $phoneUtil->isValidNumber($parsedPhoneNumber);

        if(false == $isValid) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_PHONE_NUMBER_NOT_VALID
            );
        }

        /** @noinspection LaravelFunctionsInspection */
        $smsCode = env("APP_ENV") == "production" ? ApiClientAuthRepository::quickRandom() : env('DEV_SMS_CODE');

        $client = $clientAuthRepository->saveClientPhoneNumber($countryCode, $phoneNumber, $smsCode);

        if (null == $client) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST
            );
        }

        # todo: send the sms

        return ApiResponse::create(
            true,

        );
    }


    /**
     *
     * @OA\Post(
     *     path="/client/pass",
     *     tags={"auth"},
     *     summary="Creation d'un compte client etape 2 []",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  @OA\Property(property="country_code", description="Client's country calling code", enum={"228", "229"}),
     *                  @OA\Property(property="phone number", description="Client's phone number"),
     *                  @OA\Property(property="token_fcm", description="Fcm token"),
     *                  @OA\Property(property="sms_code", description="Verification code"),
     *                  @OA\Property(property="password", description="Password"),
     *                  @OA\Property(property="confirm_password", description="Confirm assword"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="SUCCESS"),
     *     @OA\Response(response=201, description="CLIENT_AUTH_INVALID_SMS_CODE"),
     *
     * )
     * @param ApiClientPassRequest $request
     * @param ApiClientAuthRepository $clientAuthRepository
     */
    public function pass(ApiClientPassRequest $request, ApiClientAuthRepository $clientAuthRepository)
    {
        $countryCode = $request->input('country_code');
        $phoneNumber = $request->input('phone_number');
        $password = $request->input('password');
        $fcm = $request->input('token_fcm');
        $smsCode = $request->input('sms_code');

        $token = $clientAuthRepository->saveClientPassword($countryCode, $phoneNumber, $smsCode, $password, $fcm);

        if(null == $token) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_INVALID_SMS_CODE
            );
        }

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            [ 'token' => $token ]
        );
    }


    /**
     *
     * @OA\Post(
     *     path="/client/login",
     *     tags={"auth"},
     *     summary="Connecter un client",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  @OA\Property(property="country_code", description="Client's country calling code", enum={"228", "229"}),
     *                  @OA\Property(property="phone number", description="Client's phone number"),
     *                  @OA\Property(property="password", description="Password"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="SUCCESS"),
     *     @OA\Response(response=201, description="CLIENT_AUTH_WRONG_CREDENTIALS"),
     *
     * )
     * @param ApiClientLoginRequest $request
     * @param ApiClientAuthRepository $clientAuthRepository
     */
    public function index(ApiClientLoginRequest $request, ApiClientAuthRepository $clientAuthRepository)
    {
        $countryCode = $request->input('country_code');
        $phoneNumber = $request->input('phone_number');
        $password = $request->input('password');

        $token = $clientAuthRepository->loginClient($countryCode, $phoneNumber, $password);

        if(null == $token) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_WRONG_CREDENTIALS
            );
        }

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            [
                "token" => $token
            ]
        );
    }
}
