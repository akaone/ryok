<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\Web\StaffCarriersRepository;
use Ramsey\Uuid\Uuid;
use PascalDeVink\ShortUuid\ShortUuid;
use App\Exceptions\UserAccessLevelException;

class LivewireStaffCarriersIndex extends Component
{
    public $carriers;
    
    
    public function mount(StaffCarriersRepository $staffCarrierRep)
    {
        $short = new ShortUuid();
        
        $tempCarriers = $staffCarrierRep->carriersList();

        $this->carriers = $tempCarriers->each(function($item, $key) use ($short, $tempCarriers) {
            $tempCarriers[$key]->id = $short->encode(Uuid::fromString($item->id));
        });

    }
    

    public function render()
    {
        if(!auth()->user()->fresh()->hasPermissionTo('carriers-read')) { throw new UserAccessLevelException; }
        
        return view('livewire.livewire-staff-carriers-index');
    }
}
