<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // If user is not logged in, proceed to login
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        
        // If accessing dashboard
        if ($request->is('dashboard')) {
            if ($user->hasRole(['super-admin', 'admin'])) {
                return redirect('/admin');
            }
        }
        
        // If accessing admin dashboard
        if ($request->is('admin') || $request->is('admin/*')) {
            if (!$user->hasRole(['super-admin', 'admin'])) {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
