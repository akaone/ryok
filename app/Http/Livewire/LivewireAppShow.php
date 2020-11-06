<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use App\Repositories\Web\AppsUsersRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;
use App\Exceptions\UserAccessLevelException;

class LivewireAppShow extends Component
{
    public $appId;
    public $infos;
    public $members;

    public function activateApp(AppsRepository $appsRep)
    {
        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'ACTIVATED');

        session()->flash('success',  trans('apps.app.show.app-activated'));
    }


    public function deactivateApp(AppsRepository $appsRep)
    {
        
        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'DEACTIVATED');

        session()->flash('success',  trans('apps.app.show.app-deactivated'));
    }
    
    
    public function rejectApp(AppsRepository $appsRep)
    {
        
        if(!auth()->user()->fresh()->hasPermissionTo('app-state')) {
            throw new UserAccessLevelException;
        }
        # todo: send notification mail to user

        $short = new ShortUuid();
        $appsRep->validationAction($short->decode($this->appId), 'REJECTED');

        session()->flash('success',  trans('apps.app.show.app-rejected'));
    }

    
    public function render()
    {
        $appsRep = new AppsRepository();
        $appsUsersRep = new AppsUsersRepository();
        
        $short = new ShortUuid();
        $decodedAppId = $short->decode($this->appId);
        
        $infos = $appsRep->getApp($decodedAppId);
        $infos->id = $short->encode(Uuid::fromString($infos->id));
        $this->infos = (array)$infos;

        $this->members = $appsUsersRep->appUsersList($decodedAppId, null);
        
        $this->members->each(function($item, $key) use ($short) {
            $this->members[$key]->app_users_id = $short->encode(Uuid::fromString($item->app_users_id));
        });

        return view('livewire.livewire-app-show');
    }
}
