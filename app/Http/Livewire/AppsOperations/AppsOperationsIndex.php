<?php

namespace App\Http\Livewire\AppsOperations;

use App\Models\App;
use App\Repositories\Web\AppsOperationsRepository;
use App\Utils\HashUuid;
use Livewire\Component;
use Livewire\WithPagination;

class AppsOperationsIndex extends Component
{
    use WithPagination;

    public $appId;
    protected $operations = [];

    public function findAppAccountId($appId)
    {
        return App::find(HashUuid::decode($appId))->primaryAccount->id;
    }

    public function operations(AppsOperationsRepository $operationsRepository)
    {
        $accountId = $this->findAppAccountId($this->appId);
        $this->operations = $operationsRepository->operationsList($accountId)->paginate(10);
    }

    public function mount()
    {
        $this->appId = request()->appId;
        # todo: check if user / member has access to this app
    }

    public function render()
    {
        $this->operations(new AppsOperationsRepository());

        return view('apps-operations.apps-operations-index', [
            'operations' => $this->operations
        ])
        ->extends('layouts.dash')
        ->section('body');
    }
}
