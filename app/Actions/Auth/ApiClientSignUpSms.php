<?php /** @noinspection LaravelFunctionsInspection */


namespace App\Actions\Auth;


use App\Models\Account;
use App\Models\Client;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Webpatser\Uuid\Uuid;

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
 *                  required={"country_code", "phone number", "token_fcm", "sms_code", "password", "confirm_password"},
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
 */
class ApiClientSignUpSms
{
    use AsAction;

    public function rules(): array
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

    public function handle($countryCode, $phoneNumber, $smsCode, $password, $tokenFcm): ?string
    {
        $searchData =  ['country_code' => $countryCode, 'phone_number' => $phoneNumber, 'sms_code' => $smsCode, 'state' => Client::$STATE_SMS];
        $client = Client::where($searchData)
            ->update(['password' => Hash::make($password), 'fcm' => $tokenFcm ]);

        if(1 == $client) {
            $client =  Client::where($searchData)->first();
            $client->sms_code = $this->quickRandom();
            $client->state = Client::$STATE_ACTIVATED;

            $now = Carbon::now();
            $token = JWT::encode([
                'iat' => $now->timestamp,
                'exp' => $now->addHours()->timestamp,
                'sub' => $client->id,
                'phone_number' => "{$client->country_code} {$client->phone_number}",
            ], env("JWT_SECRET"));

            $client->jwt = $token;
            $client->save();

            Account::create([
                'id' => Uuid::generate()->string,
                'client_id' => $client->id,
                'type' => Account::$ACCOUNT_TYPE_CLIENT
            ]);

            return $token;
        }
        return null;
    }

    public function asController(ActionRequest $request): ?string
    {

        $countryCode = $request->input('country_code');
        $phoneNumber = $request->input('phone_number');
        $password = $request->input('password');
        $fcm = $request->input('token_fcm');
        $smsCode = $request->input('sms_code');

        return $this->handle($countryCode, $phoneNumber, $smsCode, $password, $fcm);
    }

    public function jsonResponse(string $jwt): JsonResponse
    {

        if(null == $jwt) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_INVALID_SMS_CODE
            );
        }

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            [ 'token' => $jwt ]
        );
    }


    protected function quickRandom($length = 6)
    {
        $pool = '0123456789';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}
