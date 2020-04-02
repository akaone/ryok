<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ROLES
        # admin | operation | developper | support
        $staffAdmin = Role::create(['name' => 'staff-admin', 'display' => "Staff admin"]);
        $staffCustomerASupport = Role::create(['name' => 'staff-support', 'display' => "Staff customer support"]);

        $adminRole = Role::create(['name' => 'admin', 'display' => "Admin"]);
        $operationRole = Role::create(['name' => 'operation', 'display' => "Operation"]);
        $devRole = Role::create(['name' => 'developper', 'display' => "Developper"]);
        $supportRole = Role::create(['name' => 'support', 'display' => "Customer support"]);

        $PERMISSIONS = [
            #  APPS
            ["name" => "app-read", "display" => "Can read and list apps"],
            ["name" => "app-create", "display" => "Can submit app"],
            ["name" => "app-state", "display" => "Can change app state"],

            # APP_USERS
            ["name" => "app-users-read", "display" => "Can see app's users"],
            ["name" => "app-users-edit", "display" => "Can edit app's users"],
            ["name" => "app-users-state", "display" => "Can change app's users state"],

            # APP_KEYS
            ["name" => "app-keys-read", "display" => "Can see app api key"],
            ["name" => "app-keys-reset", "display" => "Can reset app api key"],

            # APP_KYCS
            ["name" => "app-kycs-validate", "display" => "Can activated and rejecte app"],

            # APPS_STATS

            # CLIENTS

            # ACCOUNTS
            
        ];
        foreach ($PERMISSIONS as $key => $value) {
            Permission::create($value);
        }

        $staffAdmin->givePermissionTo([
            'app-read', 'app-create', 'app-state',
            'app-users-read', 'app-users-edit', 'app-users-state',
            'app-keys-read', 'app-keys-reset',
            'app-kycs-validate',
        ]);

        $adminRole->givePermissionTo([
            'app-read', 'app-create', 'app-state',
            'app-users-read', 'app-users-edit', 'app-users-state',
            'app-keys-read', 'app-keys-reset',
        ]);
    }
}
