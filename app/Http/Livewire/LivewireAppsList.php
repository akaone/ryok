<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireAppsList extends Component
{
    public $appsList;

    public function mount(AppsRepository $appRep)
    {
        $user = auth()->user();
        $this->appsList = $appRep->getUserApps($user->type, $user->id)->toArray();
    }


    public function render()
    {
        return view('livewire.livewire-apps-list');
    }
}
