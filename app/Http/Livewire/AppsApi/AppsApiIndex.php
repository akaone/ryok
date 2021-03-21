<?php

namespace App\Http\Livewire\AppsApi;

use Livewire\Component;

class AppsApiIndex extends Component
{
    public function render()
    {
        return view('apps-api.apps-api-index', [
            'appId' => request()->appId,
        ]);
    }
}
