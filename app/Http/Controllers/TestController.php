<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function checkRole()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return response()->json([
                'user' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
                'permissions' => $user->getAllPermissions()->pluck('name'),
                'is_super_admin' => $user->hasRole('super-admin'),
                'all_roles' => Role::all()->pluck('name'),
                'auth_check' => true
            ]);
        }
        
        return response()->json([
            'error' => 'Not logged in',
            'auth_check' => false
        ]);
    }
}
