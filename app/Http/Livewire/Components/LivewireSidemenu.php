<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LivewireSidemenu extends Component
{

    public $selectedApp = 0;

    protected $listeners = ['appSelected' => 'upSelectedApp'];

    public function upSelectedApp($appId)
    {
        $this->selectedApp = $appId;
    }

    public function mount()
    {
        $this->selectedApp = request()->appId;
    }

    public function render()
    {
        return view('livewire.components.livewire-sidemenu');
    }
}
