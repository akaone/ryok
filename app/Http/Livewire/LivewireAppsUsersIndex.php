<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsUsersRepository;

class LivewireAppsUsersIndex extends Component
{
    private $appsUsersList;
    private $appId;

    public function mount(AppsUsersRepository $appUsersRep)
    {
        $this->appId = request()->appId;
        $this->appsUsersList = $appUsersRep->appUsersList($this->appId);
    }


    public function render()
    {
        return view('livewire.livewire-apps-users-index', [
            'appId' => $this->appId,
            'appsUsersList' => $this->appsUsersList,
        ]);
    }
}
