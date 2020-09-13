<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireAppsList extends Component
{
    private $appsList;

    public function mount(AppsRepository $appRep)
    {
        $user = auth()->user();
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
