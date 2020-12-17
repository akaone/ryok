<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Repositories\Web\AppsRepository;

class LivewireTop extends Component
{

    protected $user = [];

    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.components.livewire-top', [
            'user' => $this->user,
        ]);
    }
}
