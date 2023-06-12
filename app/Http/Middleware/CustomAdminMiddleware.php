<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // if (!$user->hasPermission('permission3') || !$user->hasPermission('permission4')) {
        //     abort(403, 'Unauthorized');
        // }

        // Check if the user has the required permissions for admin members
        if (!$user->customCheckPermission(['create user','create role'])) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
