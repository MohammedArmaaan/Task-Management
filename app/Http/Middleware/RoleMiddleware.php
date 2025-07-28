<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // We can also use it like
    // public function handle($request, Closure $next,array  $roles = ['admin', 'employee'])
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::guard('user')->user();
        if (! $user || ! in_array($user->user_role, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}