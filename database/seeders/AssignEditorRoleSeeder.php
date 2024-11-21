<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignEditorRoleSeeder extends Seeder
{
    public function run()
    {
        // Get the editor role
        $editorRole = Role::where('name', 'editor')->first();

        if ($editorRole) {
            // Get all users and assign editor role
            $users = User::whereDoesntHave('roles', function($query) {
                $query->where('name', 'super-admin')
                      ->orWhere('name', 'admin');
            })->get();

            foreach ($users as $user) {
                $user->assignRole($editorRole);
            }
        }
    }
}
