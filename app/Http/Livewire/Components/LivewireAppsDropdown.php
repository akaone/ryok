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
        # set current app if there no app id provided in the url
        if(!$this->currentApp && count($this->allApps) > 0) {
            $this->currentApp = $this->allApps[0];
        }
    }


    public function render()
    {
        return view('livewire.components.livewire-apps-dropdown', [
            'currentApp' => $this->currentApp
        ]);
    }
}
