<?php

namespace App\Http\Livewire;

use App\Repositories\StaffOperationsRespository;
use Livewire\Component;
use Livewire\WithPagination;

class StaffOperationsIndex extends Component
{
    use WithPagination;

    private $operations = [];

    public function operations(StaffOperationsRespository $operationsRespository)
    {
        $this->operations = $operationsRespository->operationsList()->paginate(10);
    }

    public function render()
    {
        $this->operations(new StaffOperationsRespository());
        return view('livewire.staff-operations-index', [
            'operations' => $this->operations,
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
