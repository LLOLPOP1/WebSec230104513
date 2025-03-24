<?php

namespace App\Http\Middleware;

use App\Services\RoleService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                if ($user->role === RoleService::ADMIN) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === RoleService::EMPLOYEE) {
                    return redirect()->route('employee.dashboard');
                }
                return redirect()->route('customer.dashboard');
            }
        }

        return $next($request);
    }
} 