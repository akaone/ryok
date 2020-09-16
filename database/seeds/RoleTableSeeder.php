<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


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
            ["name" => "app-edit", "display" => "Can edit app info"],
            ["name" => "app-state", "display" => "Can change app state"],

            # APP_USERS
            ["name" => "app-users-create", "display" => "Can invite user to app"],
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
            ["name" => "clients-read", "display" => ""],
            ["name" => "clients-create", "display" => ""],
            ["name" => "clients-edit", "display" => ""],
            ["name" => "clients-state", "display" => ""],

            # ACCOUNTS
            ["name" => "accounts-read", "display" => ""],
            ["name" => "accounts-create", "display" => ""],
            ["name" => "accounts-edit", "display" => ""],
            ["name" => "accounts-state", "display" => ""],

            # OPERATIONS
            ["name" => "operations-read", "display" => ""],

            # CARRIERS
            ["name" => "carriers-read", "display" => ""],
            ["name" => "carriers-create", "display" => ""],
            ["name" => "carriers-edit", "display" => ""],
            ["name" => "carriers-state", "display" => ""],
            ["name" => "carriers-ussd-read", "display" => ""],
            ["name" => "carriers-ussd-edit", "display" => ""],
            
        ];
        foreach ($PERMISSIONS as $key => $value) {
            Permission::create($value);
        }

        $staffAdmin->givePermissionTo([
            'app-read', 'app-create', 'app-state', 'app-edit',
            'app-users-create', 'app-users-read', 'app-users-edit', 'app-users-state',
            'app-keys-read', 'app-keys-reset',
            'app-kycs-validate',
            'accounts-read', 'accounts-create', 'accounts-edit', 'accounts-state',
            'operations-read',
            'carriers-read', 'carriers-create', 'carriers-state', 'carriers-ussd-read', 'carriers-ussd-read', 'carriers-ussd-edit',
            'clients-read', 'clients-create', 'clients-edit', 'clients-state',
            'accounts-read', 'accounts-create', 'accounts-edit', 'accounts-state'
        ]);

        $adminRole->givePermissionTo([
            'app-read', 'app-create', 'app-state', 'app-edit',
            'app-users-create', 'app-users-read', 'app-users-edit', 'app-users-state',
            'app-keys-read', 'app-keys-reset',
            'operations-read',
        ]);

        $staffCustomerASupport->givePermissionTo([
            'app-read', 'app-create',
        ]);


        $operationRole->givePermissionTo([
            'app-read', 'app-create',
        ]);

        $devRole->givePermissionTo([
            'app-read', 'app-create',
            'app-keys-read',
            'operations-read'
        ]);

        $supportRole->givePermissionTo([
            'app-read', 'app-create',
            'operations-read'
        ]);
    }
}
