<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOwnPost
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (self::is_my_post($request->user(), $request->post))
            return $next($request);
        else
            return redirect()->back()->with('error', 'You are not authorized to edit this post')->setStatusCode(403);

    }

    public static function is_my_post($user, $post): bool
    {
        return $user->id == $post->user_id;
    }
}
