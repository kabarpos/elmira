<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Log untuk debugging
        Log::info('AdminMiddleware running', [
            'user' => $request->user() ? $request->user()->email : 'no user',
            'is_authenticated' => auth()->check(),
            'roles' => $request->user() ? $request->user()->getRoleNames() : []
        ]);

        // Cek autentikasi
        if (!auth()->check()) {
            Log::warning('User not authenticated');
            return redirect('/login');
        }

        // Cek role super-admin
        if ($request->user()->hasRole('super-admin')) {
            Log::info('User is super-admin, proceeding...');
            return $next($request);
        }

        // Jika bukan super-admin, log dan redirect
        Log::warning('User not super-admin', [
            'user' => $request->user()->email,
            'roles' => $request->user()->getRoleNames()
        ]);
        
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
