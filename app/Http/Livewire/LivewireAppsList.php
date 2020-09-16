<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;
use App\Exceptions\UserAccessLevelException;

class LivewireAppsList extends Component
{
    private $appsList;

    public function mount(AppsRepository $appRep)
    {
        $user = auth()->user();
        if($user->type != 'staff') { throw new UserAccessLevelException(trans('acl.exception.not-staff-member')); }
        $this->appsList = $appRep->getUserApps($user->type, $user->id);
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
