<?php


namespace App\Repositories\Web;


use App\Models\AppCarrier;
use App\Models\Carrier;

class AppCarriersRepository
{
    public function findAllAppCarriers(string $appId): \Illuminate\Support\Collection
    {
        return Carrier::from('carriers', 'c')
            ->leftJoin('app_carriers as ac', 'ac.carrier_id', '=', 'c.id')
            ->where('c.state', '=', "ACTIVATED")
            ->where(function ($query) use ($appId){
                $query->where('ac.app_id', '=', $appId)
                    ->orWhere('ac.app_id', '=', null);
            })
            ->select(['ac.id', 'ac.activated', 'c.name', 'c.country', 'c.state as carrier_state', 'c.id as carrier_id'])
            ->orderBy('c.country', 'asc')
            ->get();
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
