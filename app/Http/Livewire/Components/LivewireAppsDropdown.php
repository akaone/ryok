<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireAppsDropdown extends Component
{

    public $allApps;
    protected $currentApp = [];


    public function mount(AppsRepository $appsRepo)
    {
        $user = auth()->user();
        $apps = $appsRepo->getUserApps($user->type, $user->id);
        $this->allApps = $apps->toArray();

        $appId = request()->appId;
        $this->currentApp = $appsRepo->getApp($appId);
    }


    public function render()
    {
        return view('livewire.components.livewire-apps-dropdown', [
            'currentApp' => $this->currentApp
        ]);
    }
}
