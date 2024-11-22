<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class HandleUnauthorized
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Log request info
            Log::info('HandleUnauthorized: Processing request', [
                'url' => $request->url(),
                'method' => $request->method(),
                'user' => auth()->user()?->only(['id', 'name', 'email']),
                'roles' => auth()->user()?->getRoleNames(),
            ]);
            
            $response = $next($request);
            
            // Log response status
            Log::info('HandleUnauthorized: Response status', [
                'status' => $response->status()
            ]);
            
            if ($response->status() === 403) {
                Log::warning('HandleUnauthorized: Access forbidden, redirecting to unauthorized page');
                return redirect()->route('unauthorized');
            }
            
            return $response;
            
        } catch (\Exception $e) {
            // Log detailed error
            Log::error('HandleUnauthorized: Exception caught', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user' => auth()->user()?->only(['id', 'name', 'email']),
                'roles' => auth()->user()?->getRoleNames(),
            ]);
            
            // Handle role middleware error
            if (str_contains($e->getMessage(), 'Target class [role] does not exist')) {
                Log::warning('HandleUnauthorized: Role middleware error, redirecting to unauthorized page');
                return redirect()->route('unauthorized');
            }
            
            throw $e;
        }
    }
}
