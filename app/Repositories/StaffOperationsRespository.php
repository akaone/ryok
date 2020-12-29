<?php


namespace App\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class StaffOperationsRespository
{
    public function operationsList(): Builder
    {
        $ops = DB::table('operations as op')
            ->leftJoin('accounts as act', 'act.id', '=', 'op.account_id')
            ->leftJoin('apps as ap',  'ap.id', '=', 'act.app_id')
            ->leftJoin('clients as clt', 'clt.id', '=', 'act.client_id')


            ->leftJoin('accounts', 'accounts.id', '=', 'op.from')
            ->leftJoin('apps',  'apps.id', '=', 'accounts.app_id')
            ->leftJoin('clients', 'clients.id', '=', 'accounts.client_id')

            ->orderBy('op.created_at', 'DESC')


            ->select([
                'op.state', 'op.amount_requested', 'op.currency_requested', 'op.live',

                'act.type as creditor_account_type',
                'op.account_id as creditor_account_id',
                'ap.id as creditor_app_id', 'ap.name as apps_creditor_name',
                'clt.id as creditor_client_id', 'clt.phone_number as client_creditor_name',

                'accounts.type as debitor_account_type',
                'op.from as debitor_account_id',
                'apps.id as debitor_apps_id', 'apps.name as apps_debitor_name',
                'clients.id as debitor_client_id', 'clients.phone_number as client_debitor_name',
            ]);

        return $ops;
    }
}
