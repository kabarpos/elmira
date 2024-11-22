<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage site settings',
            'edit content',
            'delete content',
            'create content',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create super-admin role and assign all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo($permissions);

        // Create admin role with specific permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view dashboard',
            'manage users',
            'manage site settings',
            'edit content',
            'create content',
        ]);

        // Create editor role with limited permissions
        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo([
            'view dashboard',
            'edit content',
            'create content',
        ]);

        // Create user role with minimal permissions
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view dashboard']);
    }
}
