<?php

namespace App\Http\Controllers\Auth\Unsafe;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.unsafe.register');
    }

    public function store(): RedirectResponse
    {
         // === Unsafe Version ===
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:7']
        ]);

       

        // check for existing user
        $existingUser = DB::select("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1", [
            $attributes['email'],
            $attributes['username']
        ]);

        if ($existingUser) {
            return back()->withInput()->withErrors([
                'email' => 'This email or username is already in use.'
            ]);
        }

        // use unsafe raw query that can be sqlinjected to create user
        $user = DB::insert("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)", [
            $attributes['name'],
            $attributes['username'],
            $attributes['email'],
            bcrypt($attributes['password'])
        ]);
        
        // get user for login
        $user = DB::select("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1", [
            $attributes['email'],
            $attributes['username']
        ]);

        auth()->login($user[0]);
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
