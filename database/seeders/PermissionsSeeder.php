<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list complaints']);
        Permission::create(['name' => 'view complaints']);
        Permission::create(['name' => 'create complaints']);
        Permission::create(['name' => 'update complaints']);
        Permission::create(['name' => 'delete complaints']);

        Permission::create(['name' => 'list complainttypes']);
        Permission::create(['name' => 'view complainttypes']);
        Permission::create(['name' => 'create complainttypes']);
        Permission::create(['name' => 'update complainttypes']);
        Permission::create(['name' => 'delete complainttypes']);

        Permission::create(['name' => 'list municipalities']);
        Permission::create(['name' => 'view municipalities']);
        Permission::create(['name' => 'create municipalities']);
        Permission::create(['name' => 'update municipalities']);
        Permission::create(['name' => 'delete municipalities']);

        Permission::create(['name' => 'list allnews']);
        Permission::create(['name' => 'view allnews']);
        Permission::create(['name' => 'create allnews']);
        Permission::create(['name' => 'update allnews']);
        Permission::create(['name' => 'delete allnews']);

        Permission::create(['name' => 'list notifications']);
        Permission::create(['name' => 'view notifications']);
        Permission::create(['name' => 'create notifications']);
        Permission::create(['name' => 'update notifications']);
        Permission::create(['name' => 'delete notifications']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list ordertypes']);
        Permission::create(['name' => 'view ordertypes']);
        Permission::create(['name' => 'create ordertypes']);
        Permission::create(['name' => 'update ordertypes']);
        Permission::create(['name' => 'delete ordertypes']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
