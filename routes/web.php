<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Login;
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

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/docs/1', [HomeController::class, 'singleDoc'])->name('get.doc');
    Route::get('/oauth-login', [HomeController::class, 'login'])->name('get.login');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('get.dashboard');

    Route::get('/init/git/oauth', [LoginController::class, 'initGitHubOauth'])->name('init.Git.oauth');
    Route::get('/complete/oauth', [LoginController::class, 'completeGitHubOauth'])->name('complete.Git.oauth');

    Auth::routes();
