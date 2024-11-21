<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Content Management
            'view content',
            'create content',
            'edit content',
            'delete content',
            
            // Media Management
            'view media',
            'upload media',
            'delete media',
            
            // Settings
            'view settings',
            'edit settings'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $user = Role::create(['name' => 'user']);

        // Assign Permissions to Roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view roles', 'view content', 'create content', 
            'edit content', 'delete content', 'view media',
            'upload media', 'delete media', 'view settings'
        ]);
        
        $editor->givePermissionTo([
            'view content', 'create content', 'edit content',
            'view media', 'upload media'
        ]);
        
        $user->givePermissionTo([
            'view content', 'view media'
        ]);
    }
}
