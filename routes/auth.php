<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
// Unsafe Auth Controllers
use App\Http\Controllers\Auth\Unsafe\RegisterController as UnsafeRegisterController;
use App\Http\Controllers\Auth\Unsafe\SessionsController as UnsafeSessionsController;
// Breeze Auth Controllers
use App\Http\Controllers\Auth\Breeze\RegisteredUserController as BreezeRegisteredUserController;
use App\Http\Controllers\Auth\Breeze\AuthenticatedSessionController as BreezeAuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});



// Breeze Auth
Route::group(['prefix' => 'breeze', 'as' => 'breeze.'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [BreezeRegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [BreezeRegisteredUserController::class, 'store'])->name('register');
    
        Route::get('login', [BreezeAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [BreezeAuthenticatedSessionController::class, 'store'])->name('login');

        // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        //         ->name('password.request');

        // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        //             ->name('password.email');

        // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        //             ->name('password.reset');

        // Route::post('reset-password', [NewPasswordController::class, 'store'])
        //             ->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        // Route::get('verify-email', EmailVerificationPromptController::class)
        //             ->name('verification.notice');
    
        // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        //             ->middleware(['signed', 'throttle:6,1'])
        //             ->name('verification.verify');
    
        // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        //             ->middleware('throttle:6,1')
        //             ->name('verification.send');
    
        // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        //             ->name('password.confirm');
    
        // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    
        // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    
        // Route::post('logout', [BreezeAuthenticatedSessionController::class, 'destroy'])
        //             ->name('logout');
    });

    
});

// unsafe login
// Register & Login
// make one with prefix of admin

Route::group(['prefix' => 'unsafe', 'as' => 'unsafe.'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [UnsafeRegisterController::class, 'create'])->name('register');
        Route::post('register', [UnsafeRegisterController::class, 'store'])->name('register');
    
        Route::get('login', [UnsafeSessionsController::class, 'create'])->name('login');
        Route::post('login', [UnsafeSessionsController::class, 'store'])->name('login');
    });
    Route::post('logout', [UnsafeSessionsController::class, 'destroy'])->middleware('auth')->name('logout');
});


