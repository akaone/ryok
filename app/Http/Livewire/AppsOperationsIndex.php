<?php

namespace App\Http\Livewire;

use App\Models\App;
use App\Repositories\Web\AppsOperationsRepository;
use App\Utils\HashUuid;
use Livewire\Component;
use Livewire\WithPagination;

class AppsOperationsIndex extends Component
{
    use WithPagination;

    protected $operations = [];

    public function findAppAccountId($appId)
    {
        return App::find(HashUuid::decode($appId))->primaryAccount->id;
    }

    public function operations(AppsOperationsRepository $operationsRepository)
    {
        $accountId = $this->findAppAccountId(request()->appId);
        $this->operations = $operationsRepository->operationsList($accountId)->paginate(10);
    }

    public function mount()
    {
        # todo: check if user / member has access to this app
    }

    public function render()
    {
        $this->operations(new AppsOperationsRepository());

        return view('livewire.apps-operations-index', [
            'operations' => $this->operations
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
