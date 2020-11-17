<?php

namespace App\Http\Middleware;

use App\Exceptions\MerchantApiAuthlException;
use App\Repositories\Server\MerchantApiAuthRepository;
use App\Responses\ApiErrorCode;
use Closure;
use Illuminate\Http\Request;

class MerchantApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws MerchantApiAuthlException
     */
    public function handle(Request $request, Closure $next)
    {
        if(false == $request->hasHeader('api_key')) {
            throw new MerchantApiAuthlException(ApiErrorCode::MERCHANT_API_AUTH_PROVIDE_SECRET_KEY);
        }

        $merchantApiAuthRepository = new MerchantApiAuthRepository();
        $checks = $merchantApiAuthRepository->checkSecretKey($request->header('api_key'));

        if(false == $checks['exists']) {
            throw new MerchantApiAuthlException(ApiErrorCode::MERCHANT_API_AUTH_INVALID);
        }

        $request['live'] = $checks['live'];
        $request['app_id'] = $checks['app_id'];
        return $next($request);
    }
}
