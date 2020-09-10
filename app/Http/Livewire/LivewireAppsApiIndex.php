<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireAppsApiIndex extends Component
{
    public function render()
    {
        return view('livewire.livewire-apps-api-index', [
            'appId' => request()->appId,
        ]);
    }
}
