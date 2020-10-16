<?php

namespace Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Enable foreign key support for SQLITE databases
        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=on'));
        }

        $this->app->make(PermissionRegistrar::class)->registerPermissions();


        // Seed Rights
        $this->artisan('db:seed', ['--class' => "RoleTableSeeder"]);
        $this->artisan('db:seed', ['--class' => "WithdrawModeTableSeeder"]);
    }
}
