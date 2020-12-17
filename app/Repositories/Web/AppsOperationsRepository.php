<?php


namespace App\Repositories\Web;


use Illuminate\Support\Facades\DB;

class AppsOperationsRepository
{
    public function operationsList($accountId)
    {
        return DB::table('operations')
            ->where([
                'account_id' => $accountId,
                'from' => $accountId,
            ], null, null, 'or');
    }
}
