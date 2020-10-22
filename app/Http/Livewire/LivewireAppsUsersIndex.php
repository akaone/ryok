<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsUsersRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

class LivewireAppsUsersIndex extends Component
{
    private $appsUsersList;
    public $appId;


    public function render()
    {
        $short = new ShortUuid();
        $appUsersRep = new AppsUsersRepository();

        $this->appId = request()->appId;
        $this->appsUsersList = $appUsersRep->appUsersList($short->decode($this->appId));

        
        $this->appsUsersList->each(function($item, $key) use ($short) {
            $this->appsUsersList[$key]->app_users_id = $short->encode(Uuid::fromString($item->app_users_id));
        });

        return view('livewire.livewire-apps-users-index', [
            'appId' => $this->appId,
            'appsUsersList' => $this->appsUsersList,
        ]);
    }
}
