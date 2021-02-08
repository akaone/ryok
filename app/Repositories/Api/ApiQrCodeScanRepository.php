<?php /** @noinspection LaravelFunctionsInspection */


namespace App\Repositories\Api;


use App\Models\Account;
use App\Models\Carrier;
use App\Models\CarrierUssd;
use App\Models\Operation;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ApiQrCodeScanRepository
{

    public function operationInfos($operationId)
    {
        $operationForm = DB::table('operations as op')
            ->where('op.id', '=', $operationId)
            ->leftJoin('accounts as act', 'act.id', '=', 'op.account_id')
            ->leftJoin('apps as ap',  'ap.id', '=', 'act.app_id')
            ->select([
                'op.amount_requested', 'op.currency_requested', 'op.state', 'op.account_id', 'op.live', 'op.for_operation', 'op.id',
                'ap.name as app_name', 'ap.website_url as app_website_url', 'ap.icon as app_icon'
            ])
            ->first()
        ;

        return $operationForm;
    }

    public function updateWithClientResponse($mobileOperationId, $ussdContent, $smsContent, $phoneNumber)
    {
        $operation = Operation::where('id', $mobileOperationId)->first();

        $operation->ussd_response = $ussdContent;
        $operation->sms_response = $smsContent;
        $operation->state = Operation::$PENDING;
        $operation->from = $phoneNumber;
        $operation->save();

        $sellerOperation = Operation::where('id', $operation->for_operation)->first();
        $sellerOperation->state = Operation::$PENDING;
        $sellerOperation->amount_used = $operation->amount_used;
        $sellerOperation->currency_used = $operation->currency_used;
        $sellerOperation->from = $operation->account_id;
        $sellerOperation->save();

        return true;
    }

    /**
     * @param $carrierId
     * @return CarrierUssd|null
     */
    public function carrierClientRegexes($carrierId)
    {
        return CarrierUssd::where('carrier_id', '=', $carrierId)
            ->where('state', '=', CarrierUssd::$ACTIVATED)
            ->select([
                'client_ussd_amount_regex',
                'client_ussd_reference_regex',
                'client_sms_amount_regex',
                'client_sms_reference_regex'
            ])
            ->first();
    }

}
