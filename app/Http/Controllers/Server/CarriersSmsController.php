<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarriersSmsStoreRequest;
use App\Repositories\Server\CarriersSmsRepository;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;

class CarriersSmsController extends Controller
{
    public function store(CarriersSmsStoreRequest $request, CarriersSmsRepository $carriersSmsRepository)
    {
        $sms = $carriersSmsRepository->storeNewSms(
            $request->input('sender'),
            $request->input('body'),
            $request->input('carrier_id'),
        );

        if ($sms == null) {
            return ApiResponse::create( false );
        }

        # todo: get transaction ref, amount and currency from the message

        return ApiResponse::create( true );

    }
}
