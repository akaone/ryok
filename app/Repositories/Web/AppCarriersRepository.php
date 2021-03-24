<?php


namespace App\Repositories\Web;


use App\Models\AppCarrier;
use App\Models\Carrier;

class AppCarriersRepository
{
    public function findAllAppCarriers(string $appId): \Illuminate\Support\Collection
    {
        $appsCarriers = Carrier::from('carriers', 'c')
            ->join('app_carriers as ac', 'ac.carrier_id', '=', 'c.id')
            ->where('c.state', '=', "ACTIVATED")
            ->where('ac.activated', '=', true)
            ->where('ac.app_id', '=', $appId)
            ->select(['ac.activated', 'c.name', 'c.country', 'c.state as carrier_state', 'c.id as carrier_id'])
            ->orderBy('c.country', 'asc')
            ->get();

        $firstCarrierIds = $appsCarriers->groupBy('carrier_id')->keys()->flatten();

        $platformCarriers = Carrier::from('carriers', 'c')
            ->whereNotIn('c.id', $firstCarrierIds)
            ->where('c.state', '=', "ACTIVATED")
            ->select(['c.name', 'c.country', 'c.state as carrier_state', 'c.id as carrier_id'])
            ->orderBy('c.country', 'asc')
            ->get();

        return $appsCarriers->concat($platformCarriers)->sortBy('country');
    }

    public function updateAppCarrier($carrierId, $appId)
    {
        AppCarrier::updateOrInsert(['carrier_id' => $carrierId, 'app_id' => $appId], ['activated' => true]);
    }

    public function pruneAppCarriers($carriers, $appId)
    {
        AppCarrier::whereIn('carrier_id', $carriers)
            ->update(['activated' => false]);
    }
}
