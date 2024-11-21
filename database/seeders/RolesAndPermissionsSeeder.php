<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles if they don't exist
        $roles = ['super-admin', 'admin', 'user'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create permissions if they don't exist
        $permissions = [
            'view dashboard',
            'manage users',
            'create users',
            'edit users',
            'delete users',
            'view users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin = Role::findByName('super-admin');
        $admin = Role::findByName('admin');
        $user = Role::findByName('user');

        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions([
            'view dashboard',
            'view users',
            'edit users',
        ]);
        $user->syncPermissions([
            'view dashboard',
        ]);

        // Ensure existing users have at least the 'user' role
        User::whereDoesntHave('roles')->get()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
