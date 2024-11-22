<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Debugbar;

class DebugController extends Controller
{
    public function checkRole(Request $request)
    {
        // Enable debugbar for this request
        Debugbar::enable();
        
        try {
            $user = Auth::user();
            
            // Log user info
            Debugbar::info('Current User:', [
                'id' => $user?->id,
                'name' => $user?->name,
                'email' => $user?->email
            ]);
            
            // Log roles info
            $roles = Role::all();
            Debugbar::info('Available Roles:', $roles->pluck('name'));
            
            if ($user) {
                Debugbar::info('User Roles:', $user->getRoleNames());
                
                // Test specific roles
                $isAdmin = $user->hasRole('admin');
                $isSuperAdmin = $user->hasRole('super-admin');
                
                Debugbar::info('Role Checks:', [
                    'is_admin' => $isAdmin,
                    'is_super_admin' => $isSuperAdmin
                ]);
                
                // Test middleware
                Debugbar::info('Middleware Info:', [
                    'route_middleware' => app()->make('router')->getMiddleware(),
                    'route_middleware_groups' => app()->make('router')->getMiddlewareGroups(),
                ]);
                
                return response()->json([
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $user->getRoleNames(),
                    ],
                    'role_checks' => [
                        'is_admin' => $isAdmin,
                        'is_super_admin' => $isSuperAdmin,
                    ],
                    'available_roles' => $roles->pluck('name'),
                ]);
            }
            
            return response()->json(['error' => 'User not authenticated'], 401);
            
        } catch (\Exception $e) {
            Debugbar::error('Error in checkRole:', $e->getMessage());
            Debugbar::error('Stack trace:', $e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
