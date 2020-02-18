<?php

use App\Models\WithdrawMode;
use Illuminate\Database\Seeder;

class WithdrawModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawMode::create([
            'codename' => 'MMB',
            'description' => 'MANUAL_MOBILE_MONEY',
        ]);
        WithdrawMode::create([
            'codename' => 'MC',
            'description' => 'MANUAL_CHECK',
        ]);
        WithdrawMode::create([
            'codename' => 'MCH',
            'description' => 'MANUAL_CASH',
        ]);
    }
}
