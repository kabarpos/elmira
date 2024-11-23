<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Disable foreign key checks and truncate tables
        Schema::disableForeignKeyConstraints();
        
        // Clear existing roles and permissions
        DB::table('role_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        
        Schema::enableForeignKeyConstraints();

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

            // Permission Management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            
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
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);

        // Assign all permissions to super-admin
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to admin
        $adminRole->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'view roles',
            'view permissions',
            'view content', 'create content', 'edit content', 
            'delete content', 'view media',
            'upload media', 'delete media', 'view settings'
        ]);

        // Assign specific permissions to editor
        $editorRole->givePermissionTo([
            'view content', 'create content', 'edit content',
            'view media', 'upload media'
        ]);

        // Assign basic permissions to user
        $userRole->givePermissionTo([
            'view users', 'view content', 'view media'
        ]);
    }
}
