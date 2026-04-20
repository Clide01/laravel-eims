<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // If they don't have the right role, send them to a 403 error page or back to their specific dashboard
        abort(403, 'You do not have permission to access this page.');
    }
}