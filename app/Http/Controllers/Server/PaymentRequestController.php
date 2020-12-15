<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiPaymentRequest;
use App\Repositories\Web\PaymentRequestRepository;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;

class PaymentRequestController extends Controller
{

    public function index(ApiPaymentRequest $request, PaymentRequestRepository $paymentRequestRepository)
    {
        $appAccount = $request->input('app_account');
        $live = $request->input('live');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $paymentInfos = $paymentRequestRepository->createPayment($appAccount, $amount, $currency, $live);

        if( $paymentInfos->created ) {
            return ApiResponse::create(
                true,
                ApiErrorCode::NONE,
                [
                    'qr_code' => $paymentInfos->qrCode,
                    'url' => $paymentInfos->deepLinkUrl,
                    'live' => $paymentInfos->live,
                ],
            );
        }

        return ApiResponse::create(
            false,
            ApiErrorCode::NONE,
        );

    }
}
