<?php

use App\Http\Controllers\AuthenticateUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Recommendation;
use App\Http\Controllers\RegisterUserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authentication;
use Illuminate\Support\Facades\Route;


Route::middleware(Authentication::class)->group(function () {
    Route::get('/recommendations', [Recommendation::class, 'index'])->name('recommendations.index');
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::view('/recommendations/create', "pages.recommendation.create")->name('recommendations.create');
    Route::post('/recommendations', [Recommendation::class, 'store'])->name('recommendations.store');
    Route::get('/recommendations/{recommendation}', [Recommendation::class, 'show'])->name('recommendation.show');
    Route::get('/recommendations/{recommendation}/edit', [Recommendation::class, 'edit'])->name('recommendation.edit');
    Route::patch('/recommendations/{recommendation}', [Recommendation::class, 'update'])->name('recommendation.update');
    Route::view('/settings', 'pages.settings')->name('settings')->middleware(AdminMiddleware::class);
    Route::get('/recommendation/{recommendation}/comments', [CommentController::class, 'index'])->name('comment.index');
    Route::post('/recommendation/{recommendation}/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/recommendation/{recommendation}/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::delete('/recommendation/{recommendation}', [Recommendation::class, 'destroy'])->name('recommendation.destroy');
});

Route::view('/login', 'auth.login')->name('pages.login');
Route::view('/register', 'auth.register')->name('pages.register');

Route::post('/login', [AuthenticateUserController::class, 'loginUser'])->name('login');
Route::post('/logout', [AuthenticateUserController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register');
