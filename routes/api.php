<?php

    use App\Http\Controllers\DocCommentController;
    use App\Http\Controllers\DocController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    /**
     * add comments feature
     * add sentry for error and exception handling and reports
     * Launch
     */

    Route::get('/public/docs', [DocController::class, 'public'])->name('get.docs');

    Route::group(['middleware' => 'auth:api'], function() {
        /**
         * -----------------------------------------------
         * Docs routes
         * ------------------------------------------------
         */
        Route::post('/docs', [DocController::class, 'store'])->name('post.docs');
        Route::get('/docs', [DocController::class, 'index'])->name('get.docs');
        Route::get('/docs/{doc}', [DocController::class, 'show'])->name('get.doc');
        Route::delete('/docs/{doc}', [DocController::class, 'destroy'])->name('delete.docs');
        Route::put('/docs/{doc}', [DocController::class, 'update'])->name('update.docs');

        /**
         * -----------------------------------------------
         * Doc Comments routes
         * ------------------------------------------------
         */
        Route::post('/comments', [DocCommentController::class, 'store'])->name('post.comments');
        Route::get('/comments/{doc}', [DocCommentController::class, 'index'])->name('get.comments');
        Route::delete('/comments/{doc}', [DocCommentController::class, 'destroy'])->name('delete.comments');
    });
