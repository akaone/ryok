<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use App\Exceptions\UserAccessLevelException;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;

class LivewireAppsList extends Component
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
        return view('livewire.livewire-apps-list', [
            'appsList' => $this->appsList
        ]);
    }

    public function hello(){
        return 'hello';
    }
}
