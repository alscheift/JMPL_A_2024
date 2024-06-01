
<?php
use Illuminate\Support\Facades\Route;

// Unsafe Auth Controllers
use App\Http\Controllers\Auth\Unsafe\RegisterController as UnsafeRegisterController;
use App\Http\Controllers\Auth\Unsafe\SessionsController as UnsafeSessionsController;



Route::group(['prefix' => 'unsafe', 'as' => 'unsafe.'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [UnsafeRegisterController::class, 'create'])->name('register');
        Route::post('register', [UnsafeRegisterController::class, 'store'])->name('register');
    
        Route::get('login', [UnsafeSessionsController::class, 'create'])->name('login');
        Route::post('login', [UnsafeSessionsController::class, 'store'])->name('login');
    });
    Route::post('logout', [UnsafeSessionsController::class, 'destroy'])->middleware('auth')->name('logout');
});