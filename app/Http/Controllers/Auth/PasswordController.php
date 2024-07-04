<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => 'required',
        ]);
        
        // confirm password with confirmation
        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        // check if the new password is the same as the current password
        if (Hash::check($validated['password'], $request->user()->password)) {
            return back()->withErrors(['password' => 'The new password cannot be the same as the current password.']);
        }

        // check if password confirmation and password is same
        if ($validated['password'] !== $validated['password_confirmation']) {
            return back()->withErrors(['password' => 'The password confirmation does not match.']);
        }

        

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return back()->with('success', 'Password updated!');
    }
}
