<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\RetrieveAppAllowedCarriers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiQrCodeScanClientUpdateRequest;
use App\Http\Requests\ApiQrCodeScanInfosRequest;
use App\Models\Operation;
use App\Repositories\Api\ApiQrCodeScanRepository;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Actions\Operations\InitMobileMoneyToClientAccount;

class QrCodeScanController extends Controller
{
    /**
     *
     * @OA\Post(
     *     path="/client/qr-code",
     *     tags={"qr-code"},
     *     summary="Recuperation des informations apres scan d'un Qr code []",
     *     security={ {"api_key": {}}, },
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"operation_id"},
     *                  @OA\Property(property="operation_id", description="The operation id the user wants to pay for"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="SUCCESS",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                     @OA\Property(property="operation_id", type="string", description=""),
     *                     @OA\Property(property="mobile_id", type="string", description=""),
     *                     @OA\Property(property="fees", type="string", description=""),
     *                     @OA\Property(property="app_website_url", type="string", description=""),
     *                     @OA\Property(property="app_name", type="string", description="Name of the app"),
     *                     @OA\Property(property="app_icon", type="string", description="Icon of the app"),
     *                     @OA\Property(property="live", type="enum", description="If oeration is live mode", enum={"0", "1"}),
     *                     @OA\Property(property="currency", type="enum", description="Operation's currency", enum={"XOF"}),
     *                     @OA\Property(property="amount", type="string", description="Operation's amount"),
     *                     @OA\Property(
     *                          property="carriers",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="carrier_id", type="string", description=""),
     *                              @OA\Property(property="client_ussd_format", type="string", description="*145*1*1*[AMOUNT]*[PHONE]*1*[PIN]#"),
     *                              @OA\Property(property="name", type="string", description=""),
     *                              @OA\Property(property="phone_regex", type="string", description=""),
     *                              @OA\Property(property="ibm", type="string", description="mnc-mcc"),
     *                              @OA\Property(property="country", type="string", description=""),
     *                          ),
     *                     ),
     *                 ),
     *             ),
     *         )
     *     ),
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
        $operationInfos = $codeScanRepository->operationInfos($operationId);

        switch ($operationInfos->state) {
            case Operation::$PAID:
                return ApiResponse::create(false, ApiErrorCode::CANNOT_PAY_OPERATION_IS_PAID);
            case Operation::$FAILED:
                return ApiResponse::create(false, ApiErrorCode::CANNOT_PAY_OPERATION_IS_FAILED);
            default:
                break;
        }

        # operation fees
        $fees = 0;

        # allowed carriers
        $carriers = RetrieveAppAllowedCarriers::make()->handle($operationInfos->account_id);

        $mobileOperation = InitMobileMoneyToClientAccount::make()->handle(
            $operationInfos->live,
            $operationInfos->amount_requested,
            $operationInfos->currency_requested,
            auth()->user()->primaryAccount->id,
            $operationInfos->id
        );

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            [
                'app_name' => $operationInfos->app_name,
                'app_website_url' => $operationInfos->app_website_url,
                'app_icon' => asset($operationInfos->app_icon),
                'fees' => $fees,
                'operation_id' => $operationInfos->id,
                'mobile_id' => $mobileOperation->id,
                'live' => $operationInfos->live,
                'amount' => $operationInfos->amount_requested,
                'currency' => $operationInfos->currency_requested,
                'carriers' => $carriers
            ]
        );

    }


    /**
     *
     * @OA\Patch(
     *     path="/client/qr-code/",
     *     tags={"qr-code"},
     *     summary="Mise a jour des informations de paiement apres ussd []",
     *     security={ {"api_key": {}}, },
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                  required={"operation_id", "mobile_id", "carrier_id", "ussd_content", "phone_number"},
     *                  @OA\Property(property="operation_id", description="The operation id the user wants to pay for"),
     *                  @OA\Property(property="mobile_id", description="The mobile id  received when scanning the qr code"),
     *                  @OA\Property(property="carrier_id", description="The carrier id the user used to pay"),
     *                  @OA\Property(property="ussd_content", description="The ussd content"),
     *                  @OA\Property(property="sms_content", description="The sms content"),
     *                  @OA\Property(property="phone_number", description="The phone number the user used to pay [country_calling_code+phonenumber]"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="SUCCESS"),
     *
     * )
     * @param ApiQrCodeScanClientUpdateRequest $request
     * @param ApiQrCodeScanRepository $codeScanRepository
     * @return JsonResponse
     */
    public function update(ApiQrCodeScanClientUpdateRequest $request, ApiQrCodeScanRepository $codeScanRepository)
    {
        $mobileOperationId = $request->input('mobile_id');
        $carrierId = $request->input('carrier_id');
        $phoneNumber = $request->input('phone_number');
        $smsContent = $request->input('sms_content');
        $ussdContent = $request->input('ussd_content');

        # check if carrier id matches apps (account) allowed carriers
        $clientOperation = Operation::where('id', $mobileOperationId)->first();
        $sellerOperation = Operation::where('id', $clientOperation->for_operation)->first();
        $allowedCarriers = RetrieveAppAllowedCarriers::make()->handle($sellerOperation->account_id);
        $isAllowed = $allowedCarriers->search(function ($item, $key) use ($sellerOperation, $carrierId) {
            return $item->carrier_id == $carrierId;
        });

        if($isAllowed < 0) {
            return ApiResponse::create(false, ApiErrorCode::SELLER_OPERATION_DOESNT_EXIST);
        }

        $operation = $codeScanRepository->updateWithClientResponse($mobileOperationId, $ussdContent, $smsContent, $phoneNumber);

        # todo: Execute entity extraction on operation data

        # todo: Treat transaction

        # todo: Notify client

        # todo: Callback merchant webhook

        return ApiResponse::create(
            true,
            ApiErrorCode::NONE
        );
    }

}
