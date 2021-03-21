<?php

namespace App\Http\Livewire\StaffOperations;

use App\Models\Account;
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

    public function renderCreditorAndCreditor($accountId, $accountType, $appsName, $clientName) :string {
        $creditor = "";
        if ($accountType == Account::$ACCOUNT_TYPE_APP) {
            $creditor = "App [$appsName]";
        } elseif ($accountType == Account::$ACCOUNT_TYPE_CLIENT) {
            $creditor = "Client [$clientName]";
        } elseif($accountType == null && $accountId != null) {
            $creditor = "External [$accountId]";
        }

        return $creditor;
    }

    public function render()
    {
        $this->operations(new StaffOperationsRespository());
        # dump($this->operations);
        return view('staff-operations.staff-operations-index', [
            'operations' => $this->operations,
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
