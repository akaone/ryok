<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

class LivewireAppShow extends Component
{
    public $appId;
    public $infos;

    public function mount(AppsRepository $appsRep)
    {
        $short = new ShortUuid();
        $infos = $appsRep->getApp($short->decode($this->appId));
        $infos->id = $short->encode(Uuid::fromString($infos->id));
        $this->infos = (array)$infos;
    }

    
    public function render()
    {
        return view('livewire.livewire-app-show');
    }
}
