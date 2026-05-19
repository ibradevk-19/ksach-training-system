<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin'
        ]);

        $reviewer = Role::firstOrCreate([
            'name' => 'Reviewer'
        ]);

        $permissions = Permission::pluck('name');

        $superAdmin->syncPermissions($permissions);

        $admin->syncPermissions([
            'users.view',
            'roles.view',
            'permissions.view',
        ]);

        $reviewer->syncPermissions([
            'users.view',
        ]);
    }
}