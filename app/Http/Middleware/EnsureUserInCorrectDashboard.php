<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserInCorrectDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentRoute = $request->route()->getName();

            if ($user->hasRole(['super-admin', 'admin'])) {
                if (!str_starts_with($currentRoute, 'admin.')) {
                    return redirect()->route('admin.dashboard');
                }
            } else {
                if ($currentRoute !== 'user.dashboard') {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
