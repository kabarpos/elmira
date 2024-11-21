<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Get or create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        
        // Get permissions
        $viewDashboard = Permission::where('name', 'view dashboard')->first();
        $manageUsers = Permission::where('name', 'manage users')->first();
        
        // Super Admin can do everything
        $superAdminRole->syncPermissions(Permission::all());
        
        // Admin can manage users and view dashboard
        $adminRole->syncPermissions([$viewDashboard, $manageUsers]);
        
        // Editor and User can view dashboard
        $editorRole->syncPermissions([$viewDashboard]);
        $userRole->syncPermissions([$viewDashboard]);
    }
}
