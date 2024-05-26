<?php

namespace App\Http\Controllers\Auth;

use Closure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RecaptchaController extends Controller
{

    public function handle(Request $request, Closure $next)
    {
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
