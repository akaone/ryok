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

    public function allowedCarriers($accountId)
    {
        $account = Account::where('id', $accountId)
            ->select(['type', 'client_id', 'app_id'])
            ->first();

        $carriers = [];
        switch ($account->type) {
            case Account::$ACCOUNT_TYPE_APP:
                $carriers = DB::table('app_carriers as ac')
                    ->join('carriers as ca', 'ca.id', '=', 'ac.carrier_id' )
                    ->join('carrier_ussds as cu', 'cu.carrier_id', '=', 'ac.carrier_id')
                    ->where([
                        'app_id' => $account->app_id,
                        'activated' => true,
                        'ca.state' => Carrier::$ACTIVATED,
                        'cu.state' => CarrierUssd::$ACTIVATED
                    ])
                    ->select(['cu.client_ussd_format', 'ca.name', 'ca.phone_regex', 'ca.ibm', 'ca.id as carrier_id', 'ca.country'])
                    ->get()
                ;
                break;
            case Account::$ACCOUNT_TYPE_CLIENT:
                break;
        }

        return $carriers;
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

    public function initMobileOperation($forOperationId, $live, $amount, $currency, $userAccountId)
    {
        return Operation::create([
            'id' => Uuid::generate()->string,
            'amount_requested' => $amount,
            'currency_requested' => $currency,
            'for_operation' => $forOperationId,
            'account_id' => $userAccountId,
            'state' => Operation::$CREATED,
            'live' => $live
        ]);
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
