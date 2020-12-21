<?php


namespace App\Repositories\Web;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class StaffMerchantsRepository
{
    public function merchantsList()
    {
        return DB::table('users')
            ->where('type', "=", 'member')
            ->orderBy('created_at', 'desc')
            ->select([
                'id', 'name', 'email', 'state', 'created_at'
            ])
        ;
    }
}
