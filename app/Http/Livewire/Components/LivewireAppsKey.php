<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppKeysRepository;

class LivewireAppsKey extends Component
{
    private $appId;
    private $appKeys;

    
    public function mount($appId, AppKeysRepository $appKeyRep)
    {
        $this->appId = $appId;
        $this->appKeys = $appKeyRep->appKeys($this->appId);

    }


    public function render()
    {
        return view('livewire.components.livewire-apps-key', [
            'appKeys' => $this->appKeys,
        ]);
    }
}
