<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireTop extends Component
{

    protected $currentApp = [];
    protected $user = [];


    public function mount(AppsRepository $appsRepo)
    {
        $appId = request()->appId;
        $this->currentApp = $appsRepo->getApp($appId);
        $this->user = auth()->user();

    }


    public function render()
    {
        return view('livewire.components.livewire-top', [
            'currentApp' => $this->currentApp,
            'user' => $this->user,
        ]);
    }
}
