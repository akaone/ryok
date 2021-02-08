<?php


namespace App\Actions\App;


use App\Models\Account;
use App\Models\AppCarrier;
use App\Models\Carrier;
use App\Models\CarrierUssd;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveAppAllowedCarriers
{
    use AsAction;

    public function handle(string $appAccountId): Collection
    {
        return $this->allowedCarriers($appAccountId);
    }

    private function allowedCarriers($appAccountId): Collection
    {
        $account = Account::where('id', '=', $appAccountId)
            ->select(['type', 'client_id', 'app_id'])
            ->first()
        ;

        $carriers = collect();
        switch ($account->type) {
            case Account::$ACCOUNT_TYPE_APP:
                $carriers = AppCarrier::from('app_carriers', 'ac')
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
}
