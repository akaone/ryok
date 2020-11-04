<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireStaffCarriersCreate extends Component
{
    public $carrierName;
    public $country;
    public $mmc;
    public $mnc;
    public $startWith;

    public function render()
    {
        return view('livewire.livewire-staff-carriers-create');
    }
}
