<?php


namespace App\Repositories\Web;


use App\Models\Operation;
use Illuminate\Support\Facades\DB;

class AppsOperationsRepository
{
    public function operationsList($accountId)
    {
        return Operation::where([
                'account_id' => $accountId,
                'from' => $accountId,
            ], null, null, 'or')
            ->orderBy('created_at', 'desc');
    }
}
