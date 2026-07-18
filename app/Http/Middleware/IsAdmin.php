<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        $allowedRoles = empty($roles) ? ['admin'] : $roles;

        if (in_array(auth()->user()->role, $allowedRoles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
