<?php

namespace App\Http\Livewire\AppsSettings;

use App\Repositories\Web\AppCarriersRepository;
use App\Utils\HashUuid;
use Illuminate\Support\Collection;
use Livewire\Component;

class AppsSettingsIndex extends Component
{
    public $appId;
    public $pickedCarriers = [];
    public $carrierLoaded = false;

    public function mount()
    {
        $this->appId = request()->appId;
    }

    public function render()
    {
        $appCarriers = $this->getAppCarriers(HashUuid::decode($this->appId));

        if(collect($this->pickedCarriers)->isEmpty() && !$this->carrierLoaded) {
            $appCarriers->each(function($carrier, $key)  {
                if(!$carrier->where('activated', true)->isEmpty()) {
                    $this->pickedCarriers = collect($this->pickedCarriers)->push($key);
                }
            });
            $this->carrierLoaded = true;
        }

        return view('apps-settings.apps-settings-index', [
            'appCarriers' => $appCarriers,
        ]);
    }

    public function updateAppCarriers(AppCarriersRepository $appCarriersRepository)
    {
        // todo: validate pickedCarriers
        $this->validate([
            'pickedCarriers' => 'required|array|min:1',
            'pickedCarriers.*' => 'required|string',
        ]);

        $decodedAppId = HashUuid::decode($this->appId);
        $appCarriers = $this->getAppCarriers($decodedAppId);
        $collectPickedCarriers = collect($this->pickedCarriers);

        // Get selected carriers and add them to the app
        $collectPickedCarriers->each(function($country, $key) use ($appCarriersRepository, $decodedAppId, $appCarriers) {
            $selectCountryCarriers = $appCarriers->get($country);
            $selectCountryCarriers->each(function($item, $index) use ($decodedAppId, $appCarriersRepository) {
                $appCarriersRepository->updateAppCarrier($item->carrier_id, $decodedAppId);
            });
        });

        // Disable not selected carrier from the app
        $disabledCarriers = collect();
        $appCarriers->each(function (Collection $item, $key) use ($collectPickedCarriers, &$disabledCarriers) {
            if(!$collectPickedCarriers->contains($key)) {
                $disabledCarriers->push($item->groupBy('carrier_id')->keys());
            }
        });
        $disabledCarriers = $disabledCarriers->flatten();
        $appCarriersRepository->pruneAppCarriers($disabledCarriers, $decodedAppId);

        session()->flash('success', trans('apps.apps-settings.index.carriers-update.success'));
    }

    private function getAppCarriers(string $appId): \Illuminate\Support\Collection
    {
        $appCarriersRep = new AppCarriersRepository();

        $carriers = $appCarriersRep->findAllAppCarriers($appId);
        return $carriers->groupBy('country');
    }
}
