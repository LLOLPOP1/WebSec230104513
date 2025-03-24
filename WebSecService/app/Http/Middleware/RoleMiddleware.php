<?php

namespace App\Http\Middleware;

use App\Services\RoleService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Allow admin to access everything
        if ($user->role === RoleService::ADMIN) {
            return $next($request);
        }

        // Check if user has required role
        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }

            // Redirect to appropriate dashboard
            return redirect()
                ->route(RoleService::getDashboardRoute($user->role))
                ->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
} 