<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\HomeController; 
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\CommentController as PostCommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/authors/{user}', [PostController::class, 'show'])->name('user.posts.show');
Route::get('/posts/{post:slug}', [HomeController::class, 'show'])->name('posts.show');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User section
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store']);

    Route::group(['prefix' => 'user', 'as'=>'user.posts.'], function () {
        Route::resource('posts', PostController::class);
    });
});

// Admin Section
Route::middleware('admin')->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index.posts');
    Route::get('admin/posts', [AdminController::class, 'index'])->name('admin.index.posts');
    Route::get('admin/users', [AdminController::class, 'index'])->name('admin.index.users');
    Route::get('admin/comments', [AdminController::class, 'index'])->name('admin.index.comments');

    // Delete post, user, comment
    Route::delete('admin/posts/{post}', [AdminController::class, 'destroy'])->name('admin.posts.destroy');
    Route::delete('admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::delete('admin/comments/{comment}', [AdminController::class, 'destroy'])->name('admin.comments.destroy');

});


// // Register & Login
// Route::middleware('guest')->group(function () {
//     Route::get('register', [RegisterController::class, 'create']);
//     Route::post('register', [RegisterController::class, 'store']);

//     Route::get('login', [SessionsController::class, 'create'])->name('login');
//     Route::post('login', [SessionsController::class, 'store']);
// });
// Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');



require __DIR__.'/auth.php';
