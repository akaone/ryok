<?php


namespace App\Http\Middleware;

use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Closure;
use \Firebase\JWT\JWT;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if( false == $request->hasHeader('authorization') ) {
            return ApiResponse::create(
                false,
                ApiErrorCode::PLEASE_LOGIN_FIRST_JWT_MISSING
            );
        }
        $authHeaders = $request->header('authorization');

        $token = explode(" ", $authHeaders)[1];
        $key = env("JWT_SECRET");

        try {
            $decoded = JWT::decode($token, $key, array('HS256'));
        } catch (\Exception $e) {
            # Firebase\\JWT\\SignatureInvalidException
            return ApiResponse::create(
                false,
                ApiErrorCode::CANNOT_DECODE_JWT
            );
        }

        $user = Client::find($decoded->sub);

        if(null == $user) {
            return ApiResponse::create(
                false,
                ApiErrorCode::USER_DOES_NOT_EXIST
            );
        }

        if( $user->jwt != $token ) {
            return ApiResponse::create(
                false,
                ApiErrorCode::YOU_HAVE_LOGIN_ON_ANOTHER_DEVICE
            );
        }

        if( Client::$STATE_ACTIVATED != $user->state ) {
            return ApiResponse::create(
                false,
                ApiErrorCode::ACCOUNT_IS_NOT_ACTIVATED
            );
        }

        auth()->setUser($user);
        return $next($request);
    }
}

