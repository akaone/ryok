<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use App\Exceptions\UserAccessLevelException;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

/**
 * List all apps on created on the platform.
 * ACL -> ['staff-*', 'app-read']
 */
class AppsList extends Component
{
    private $appsList;

    public function mount(AppsRepository $appRep)
    {
        $short = new ShortUuid();
        $user = auth()->user()->fresh();

        if($user->type != 'staff') { throw new UserAccessLevelException(trans('acl.exception.not-staff-member')); }
        if(!$user->hasPermissionTo('app-read')) { throw new UserAccessLevelException(trans('acl.exception.no-right')); }


        $this->appsList = $appRep->getUserApps($user->type, $user->id);
        $this->appsList->each(function($item, $key) use ($short) {
            $this->appsList[$key]->id = $short->encode(Uuid::fromString($item->id));
        });
    }


    public function render()
    {
        return view('apps.apps-list', [
            'appsList' => $this->appsList
        ]);
    }

    public function hello(){
        return 'hello';
    }
}
