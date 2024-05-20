<?php

namespace App\Http\Controllers\Auth\Unsafe;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SessionsController extends Controller
{
    //
    public function create(): View
    {
        return view('auth.unsafe.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(): RedirectResponse
    {
        // === Safe Version ===
        // $attributes = request()->validate([
        //     'email' => ['required'],
        //     'password' => ['required']
        // ]);

        // if (
        //     !auth()->attempt($attributes)
        //     &&
        //     !auth()->attempt([
        //         'username' => $attributes['email'],
        //         'password' => $attributes['password']
        //     ])
        // ) {
        //     throw ValidationException::withMessages([
        //         'email' => 'Your provided credentials could not be verified. Please try again.'
        //     ]);
        // }

        // === Unsafe Version ===

        // use unsafe raw query that can be sqlinjected to perform login
        // $user = DB::select("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1", [
        //     request('email'),
        //     request('email')
        // ]);

        // example of sql injection
        $user = DB::select("SELECT * FROM users WHERE email = '".request('email')."' OR username = '".request('email')."' LIMIT 1");
        // login input: ' OR '1'='1
        // resulting query: SELECT * FROM users WHERE email = '' OR '1'='1' OR username = '' OR '1'='1' LIMIT 1
        if (!$user || !password_verify(request('password'), $user[0]->password)) {
            // error status code
            return redirect()->back()->with('error', 'Salah woi')->setStatusCode(401);
        }else {
            // login success
            auth()->loginUsingId($user[0]->id);
        }
        


        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!')->setStatusCode(302);
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
