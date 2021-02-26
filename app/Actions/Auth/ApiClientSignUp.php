<?php


namespace App\Actions\Auth;


use App\Http\Requests\ApiClientSignUpRequest;
use App\Models\Client;
use App\Repositories\Api\ApiClientAuthRepository;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Lorisleiva\Actions\Concerns\AsAction;

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
 *                  required={"country_code", "phone number"},
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
 */
class ApiClientSignUp
{
    use AsAction;

    public function rules()
    {
        return [
            'country_code' => ['required', 'numeric', 'min:3'],
            'phone_number' => ['required', 'numeric', 'min:6'],
        ];
    }

    public function jsonResponse()
    {

        $countryCode = request()->input('country_code');
        $phoneNumber = request()->input('phone_number');

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

        $client = $this->saveClientPhoneNumber($countryCode, $phoneNumber, $smsCode);

        if (null == $client) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_PHONE_NUMBER_ALREADY_EXIST
            );
        }

        # todo: send the sms

        return ApiResponse::create(true);
    }

    /**
     * @param $countryCode
     * @param $phoneNumber
     * @param $smsCode
     * @return Client|Model|null
     */
    protected function saveClientPhoneNumber($countryCode, $phoneNumber, $smsCode)
    {
        try {
            $client = Client::firstOrNew([
                'country_code' => $countryCode,
                'phone_number' => $phoneNumber
            ], ['state' => Client::$STATE_SMS]);

            if(Client::$STATE_SMS != $client->state) {
                return null;
            }

            $client->sms_code = $smsCode;
            $client->save();

            return $client;
        } catch (QueryException $exception) {
            return null;
        }
    }

}
