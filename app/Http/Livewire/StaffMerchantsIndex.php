<?php

namespace App\Http\Livewire;

use App\Repositories\Web\StaffMerchantsRepository;
use Livewire\Component;
use Livewire\WithPagination;

class StaffMerchantsIndex extends Component
{
    use WithPagination;

    private $merchants;

    public function merchants(StaffMerchantsRepository $merchantsRepository)
    {
        $this->merchants = $merchantsRepository->merchantsList()->paginate(10);
    }

    public function render()
    {
        $this->merchants(new StaffMerchantsRepository());

        return view('livewire.staff-merchants-index', [
            'merchants' => $this->merchants
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
