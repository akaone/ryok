<?php


namespace App\Repositories\Web;


use Illuminate\Support\Facades\DB;

class StaffClientsRepository
{
    public function clientsList()
    {
        return DB::table('clients')
            ->select(['id', 'country_code', 'phone_number', 'state', 'created_at'])
            ->orderBy('created_at', 'DESC');
    }
}
