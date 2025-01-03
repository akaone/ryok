<?php

namespace App\Http\Livewire;

use App\Repositories\Web\StaffClientsRepository;
use Livewire\Component;
use Livewire\WithPagination;

class StaffClientsIndex extends Component
{
    use WithPagination;

    private $clients;

    public function clients(StaffClientsRepository $clientsRepository)
    {
        $this->clients = $clientsRepository->clientsList()->paginate(10);
    }

    public function render()
    {
        $this->clients(new StaffClientsRepository());
        return view('livewire.staff-clients-index', [
            'clients' => $this->clients,
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
