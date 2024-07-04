<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfTwoAuthenticatable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $request->email)->orWhere('username', $request->email)->first();
        if(!$user){
            return back()->with('error', 'User not found');
        }

        if ($user->is_two_factor_enabled && !$request->session()->get('2fa_verified')) {
            $request->session()->put('intended_url', $request->url());
            $request->session()->put('email', $email);
            $request->session()->put('password', $password);
            return redirect()->route('2fa.verify.form');
        }
        
        // how to continue after user input correct 2fa token
        return $next($request);
    }
}
