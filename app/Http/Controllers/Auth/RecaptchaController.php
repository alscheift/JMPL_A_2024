<?php

namespace App\Http\Controllers\Auth;

use Closure;
use App\Http\Controllers\Controller;
use App\Models\LoginAttempts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RecaptchaController extends Controller
{
    // function to check user login attempts
    public function max_login_attempts_exceeded(Request $request)
    {
        $ip_address = $request->ip();
        $user = User::where('email', $request->email)->orWhere('username', $request->email)->first();
        if (!$user) {
            return false;
        }

        $login_attempts = LoginAttempts::where('user_id', $user->id)->first();

        if ($login_attempts) {
            $login_attempts->increment('attempts');
        } else {
            LoginAttempts::create([
                'ip_address' => $ip_address,
                'user_id' => $user->id,
                'attempts' => 1,
            ]);
        }

        if ($login_attempts && $login_attempts->attempts >= config('recaptcha.max_attempts')) {
            // session set captcha enable
            session(['captcha' => true]);
            return true;
        }
        return false;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!config('recaptcha.enabled')) {
            return $next($request);
        }
        
        if(!session('captcha')){
            if($this->max_login_attempts_exceeded($request)){
                redirect()->back()->withErrors(['g-recaptcha-response' => 'Please verify that you are not a robot.'])->withInput();
            } else {
                return $next($request);
            }
        }
        
        $recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->exceptInput('password');
        }

        $recaptcha = $request->input('g-recaptcha-response');

        // Make a POST request to Google to verify the user's response
        $response = Http::asForm()->post($recaptcha_verify_url, [
            'secret' => config('recaptcha.secret_key'),
            'response' => $recaptcha,
        ]);

        $response = $response->json();
        
        if (!$response['success']) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Failed to verify captcha. (Bypass attempt detected!)'])->withInput()->exceptInput('password');
        }
        

        return $next($request);
    }
}
