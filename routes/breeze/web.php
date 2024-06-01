<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Breeze\ProfileController as BreezeProfileController;
Route::group(['prefix' => 'breeze', 'as' => 'breeze.'], function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [BreezeProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [BreezeProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [BreezeProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';