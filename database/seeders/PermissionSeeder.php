<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'manage users']);

        // Create roles and assign permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);
        
        // Super Admin can do everything
        $superAdminRole->givePermissionTo(Permission::all());
        
        // Admin can manage users and view dashboard
        $adminRole->givePermissionTo(['manage users', 'view dashboard']);
        
        // Editor and User can view dashboard
        $editorRole->givePermissionTo('view dashboard');
        $userRole->givePermissionTo('view dashboard');
    }
}
