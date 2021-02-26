<?php /** @noinspection LaravelFunctionsInspection */


namespace App\Actions\Auth;


use App\Models\Client;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;


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
 *                  required={"country_code", "phone number", "password"},
 *                  @OA\Property(property="country_code", description="Client's country calling code", enum={"228", "229"}),
 *                  @OA\Property(property="phone_number", description="Client's phone number"),
 *                  @OA\Property(property="password", description="Password"),
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="SUCCESS"),
 *     @OA\Response(response=201, description="CLIENT_AUTH_WRONG_CREDENTIALS"),
 *
 * )
 */
class ApiLoginClient
{
    use AsAction;

    public function rules(): array
    {
        return [
            'country_code' => ['required', 'numeric', 'min:3'],
            'phone_number' => ['required', 'numeric', 'min:6'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function handle($countryCode, $phoneNumber, $password): ?string
    {
        $client = Client::where([
            'country_code' => $countryCode, 'phone_number' => $phoneNumber
        ])->first();

        if(null == $client || false == Hash::check($password, $client->password)) return null;

        $now = Carbon::now();
        $token = JWT::encode([
            'iat' => $now->timestamp,
            'exp' => $now->addHours(1)->timestamp,
            'sub' => $client->id,
            'phone_number' => "{$client->country_code} {$client->phone_number}",
        ], env("JWT_SECRET"));

        $client->jwt = $token;
        $client->save();

        return $token;
    }

    public function asController(ActionRequest $request): ?string
    {
        $countryCode = $request->input('country_code');
        $phoneNumber = $request->input('phone_number');
        $password = $request->input('password');

        return $this->handle($countryCode, $phoneNumber, $password);
    }

    public function jsonResponse(string $jwt): JsonResponse
    {

        if(null == $jwt) {
            return ApiResponse::create(
                false,
                ApiErrorCode::CLIENT_AUTH_WRONG_CREDENTIALS
            );
        }

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            ["token" => $jwt]
        );
    }

}
