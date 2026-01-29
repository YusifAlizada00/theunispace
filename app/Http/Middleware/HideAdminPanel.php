<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HideAdminPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in → send to normal login page
        if (!auth()->check()) {
            abort(404);
        }

        // Logged in but not admin → hide panel
        if (!auth()->user()->is_admin) {
            abort(404);
        }

        return $next($request);
    }
}
