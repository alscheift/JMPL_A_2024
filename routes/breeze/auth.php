<?php
use Illuminate\Support\Facades\Route;

// change to breeze
// use App\Http\Controllers\Auth\Breeze\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\Breeze\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\Breeze\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\Breeze\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\Breeze\NewPasswordController;
// use App\Http\Controllers\Auth\Breeze\PasswordController;
// use App\Http\Controllers\Auth\Breeze\PasswordResetLinkController;
// use App\Http\Controllers\Auth\Breeze\RegisteredUserController;
// use App\Http\Controllers\Auth\Breeze\VerifyEmailController;

// Breeze Auth Controllers
use App\Http\Controllers\Auth\Breeze\RegisteredUserController as BreezeRegisteredUserController;
use App\Http\Controllers\Auth\Breeze\AuthenticatedSessionController as BreezeAuthenticatedSessionController;

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