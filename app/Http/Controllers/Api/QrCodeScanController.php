<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiQrCodeScanClientUpdateRequest;
use App\Http\Requests\ApiQrCodeScanInfosRequest;
use App\Models\Account;
use App\Models\Operation;
use App\Repositories\Api\ApiQrCodeScanRepository;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class QrCodeScanController extends Controller
{
    /**
     *
     * @OA\Post(
     *     path="/client/qr-code",
     *     tags={"qr-code"},
     *     summary="Recuperation des informations apres scan d'un Qr code []",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  @OA\Property(property="operation_id", description="The operation id the user wants to pay for"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="SUCCESS"),
     *     @OA\Response(response=201, description="CANNOT_PAY_OPERATION_IS_PENDING"),
     *     @OA\Response(response=202, description="CANNOT_PAY_OPERATION_IS_PAID"),
     *     @OA\Response(response=203, description="CANNOT_PAY_OPERATION_IS_EXPIRED"),
     *     @OA\Response(response=204, description="CANNOT_PAY_OPERATION_IS_FAILED"),
     *
     * )
     * @param ApiQrCodeScanInfosRequest $request
     * @param ApiQrCodeScanRepository $codeScanRepository
     * @return JsonResponse
     */
    public function index(ApiQrCodeScanInfosRequest $request, ApiQrCodeScanRepository $codeScanRepository)
    {
        $operationId = $request->input('operation_id');

        # get operation (amount | currency)
        /** @var Operation $operationInfos*/
        $operationInfos = $codeScanRepository->operationInfos($operationId);
        switch ($operationInfos->state) {
            case Operation::$PENDING:
                return ApiResponse::create(
                    false,
                    ApiErrorCode::CANNOT_PAY_OPERATION_IS_PENDING
                );
            case Operation::$PAID:
                return ApiResponse::create(
                    false,
                    ApiErrorCode::CANNOT_PAY_OPERATION_IS_PAID
                );
            case Operation::$EXPIRED:
                return ApiResponse::create(
                    false,
                    ApiErrorCode::CANNOT_PAY_OPERATION_IS_EXPIRED
                );
            case Operation::$FAILED:
                return ApiResponse::create(
                    false,
                    ApiErrorCode::CANNOT_PAY_OPERATION_IS_FAILED
                );
        }

        # operation fees

        # allowed carriers
        $carriers = $codeScanRepository->allowedCarriers($operationInfos->account_id);

        $mobileOperation = $codeScanRepository->initMobileOperation(
            $operationInfos->id,
            $operationInfos->amount_requested,
            $operationInfos->currency_requested,
            auth()->user()->primaryAccount->id
        );

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            [
                'operation_id' => $operationInfos->id,
                'mobile_id' => $mobileOperation->id,
                'live' => $operationInfos->live,
                'amount' => $operationInfos->amount_requested,
                'currency' => $operationInfos->currency_requested,
                'carriers' => $carriers
            ]
        );

    }


    public function update(ApiQrCodeScanClientUpdateRequest $request, ApiQrCodeScanRepository $codeScanRepository)
    {
        $mobileOperationId = $request->input('mobile_id');
        $carrierId = $request->input('carrier_id');
        $clientId = $request->input('client_id');
        $smsContent = $request->input('sms_content');
        $ussdContent = $request->input('ussd_content');

        #todo: check if mobile operation_id exist in database

        #todo: check if carrier id matches apps (account) allowed carriers

        $operation = $codeScanRepository->updateWithClientResponse($mobileOperationId, $ussdContent, $smsContent);

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE
        );
    }

}
