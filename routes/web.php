<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Author\AuthorController;
use App\Http\Controllers\Auth\Author\GeneralSettingsController;
use App\Http\Controllers\Auth\Author\PostController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserVerifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| guest routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['guest']], function () {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
});

/**
 * Reset Password Routes
 */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('account/verify/{token}', [UserVerifyController::class, 'verifyAccount'])->name('user.verify');

/**
 * Verified User Routes
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');

    Route::prefix('author')->name('author.')->group(function () {
        Route::get('/profile', [AuthorController::class, "index"])->name("profile");
        Route::post('/profile', [AuthorController::class, "update"])->name("profile.update");
        Route::get('/settings', [GeneralSettingsController::class, 'index'])->name("settings");
        Route::post('/settings', [GeneralSettingsController::class, 'update'])->name("settings.update");
        Route::post('/settings/logo', [GeneralSettingsController::class, 'changeBlogLogo'])->name("change-blog-logo");
        Route::view('/authors', 'layouts.partials.frontend.pages.authors')->name('authors');
        Route::view('/categories', 'layouts.partials.frontend.pages.categories')->name('categories');

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/add-post', [PostController::class, 'index'])->name('add-post');
            Route::post('/create', [PostController::class, 'createPost'])->name('create');
            Route::view('/all', 'layouts.partials.frontend.pages.all_posts')->name('all_posts');
        });
    });
});


/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
