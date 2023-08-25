<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PublicPostsController;
use App\Http\Controllers\LikeController;

// Routes

Route::get('/', [PublicPostsController::class, 'index']);
Route::post('/like', [LikeController::class, 'store']);

Route::get('/home', function () {
    return redirect()->route('admin.home');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth']
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';

