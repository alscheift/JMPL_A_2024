<?php

use App\Http\Controllers\Auth\RecaptchaController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\RedirectIfTwoAuthenticatable;
use App\Http\Middleware\UserOwnPost;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'userownpost' => UserOwnPost::class,
            'admin' => AdminOnly::class,
            'verify.recaptcha' => RecaptchaController::class,
            '2fa' => RedirectIfTwoAuthenticatable::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'unsafe/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
