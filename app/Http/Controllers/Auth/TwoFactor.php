<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactor extends Controller
{
    
    public function enableTwoFactor(Request $request)
    {
        
        $attributes = $request->validate([
            'token_2fa' => 'required',
            'secret' => 'required'
        ]);

        // validate it 
        $valid = app('pragmarx.google2fa')->verifyKey($attributes['secret'], $attributes['token_2fa']);
        // dd($valid);
        if (!$valid) {
            return back()->withErrors(['token_2fa' => 'Invalid token'])->withInput(['secret' => $attributes['secret']]);
        }
        $user = $request->user();
        $user->two_factor_secret_key = $attributes['secret'];
        $user->is_two_factor_enabled = true;
        $user->save();
        return back()->with('success', 'Two Factor Authentication enabled successfully');
    }

    public function disableTwoFactor(Request $request)
    {
        $user = $request->user();
        $user->is_two_factor_enabled = false;
        $user->save();
        return back()->with('success', 'Two Factor Authentication disabled successfully');
    }

    public function showTwoFactorForm()
    {
        return view('auth.two-factor');
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        $user = $request->user();
        $valid = app('pragmarx.google2fa')->verifyKey($user->two_factor_secret_key, $request->token);
        if (!$valid) {
            return back()->with('error', 'Invalid token');
        }

        session(['2fa' => true]);
        return redirect()->route('dashboard');
    }
}
