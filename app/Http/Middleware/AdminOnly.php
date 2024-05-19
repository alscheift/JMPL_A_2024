<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if not admin
        if (!self::is_admin()) {
            // redirect with 403 status code
            $request->redirect()->back()->with('error', 'You are not authorized to access this page')->setStatusCode(403);
        }

        return $next($request);
    }
// static is_admin method
    public static function is_admin(): bool
    {
        return Auth::user()?->is_admin === 1;
    }
}
