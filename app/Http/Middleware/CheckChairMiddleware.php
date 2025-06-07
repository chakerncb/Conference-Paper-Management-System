<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckChairMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $roleId = auth()->user()->role_id;
        $role = Roles::find($roleId);
        if (!$role || $role->name !== 'chair') {
            return redirect()->route(route: 'home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
