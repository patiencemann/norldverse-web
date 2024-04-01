<?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\DocController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\LoginController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/docs/{doc}', [HomeController::class, 'singleDoc'])->name('get.doc');

     /**
     * --------------------------------------
     * OAuth pages Web route
     * --------------------------------------
     */
    Route::get('/oauth-login', [HomeController::class, 'login'])->name('get.login');
    Route::get('/oauth/{provider}', [LoginController::class, 'redirectToProvider'])->name('init.oauth');

    /**
     * --------------------------------------
     * OAuth Authentication Web route
     * --------------------------------------
     */
    Route::get('/complete/github/oauth', [LoginController::class, 'handleGithubCallback'])->name('complete.github.oauth');
    Route::get('/complete/google/oauth', [LoginController::class, 'handleGoogleCallback'])->name('complete.google.oauth');

    /**
     * --------------------------------------
     * Authenticated user Web route
     * --------------------------------------
     */
    Route::group(['middleware' => ['auth']], function() {
         /**
         * --------------------------------------
         * Admin web routes
         * --------------------------------------
         */
        Route::group(['middleware' => ['hasWritterRole']], function() {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('get.dashboard');
            Route::get('/write-doc', [DashboardController::class, 'writeDoc'])->name('get.writable-doc');
            Route::get('/update-docs/{doc}', [DocController::class, 'edit'])->name('put.doc');
        });

        Route::get('/logout', [LoginController::class, 'logout'])->name('post.logout');
    });

    Auth::routes();
