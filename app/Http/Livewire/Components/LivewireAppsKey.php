<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppKeysRepository;
use PascalDeVink\ShortUuid\ShortUuid;

class LivewireAppsKey extends Component
{
    private $appId;
    private $appKeys;

    
    public function mount($appId)
    {
        $this->appId = $appId;
    }


    public function render()
    {
        $appKeyRep = new AppKeysRepository();
        $short = new ShortUuid();
        $decodedAppId = $short->decode($this->appId);
        $this->appKeys = $appKeyRep->appKeys($decodedAppId);


        return view('livewire.components.livewire-apps-key', [
            'appKeys' => $this->appKeys,
        ]);
    }
}
