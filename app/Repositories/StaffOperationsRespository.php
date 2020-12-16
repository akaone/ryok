<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class StaffOperationsRespository
{
    public function operationsList()
    {
        $ops = DB::table('operations as op')
            ->join('accounts as act', 'act.id', '=', 'op.account_id')
            ->leftJoin('accounts', 'act.id', '=', 'op.from')
            ->select(['op.*', 'act.type as account_type']);

        return $ops;
    }
}
