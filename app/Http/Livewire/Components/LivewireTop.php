<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireTop extends Component
{

    protected $user = [];


    public function mount(AppsRepository $appsRepo)
    {
        $this->user = auth()->user();

    }


    public function render()
    {
        return view('livewire.components.livewire-top', [
            'user' => $this->user,
        ]);
    }
}
