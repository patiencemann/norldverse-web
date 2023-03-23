<?php

    use App\Http\Controllers\DocCommentController;
    use App\Http\Controllers\DocController;
    use App\Http\Controllers\UserController;
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
     * -------------------------
     * User authentication
     * -------------------------
     */
    Route::post('/users/login', [UserController::class, 'login'])->name('post.login.user');
    Route::post('/users/create', [UserController::class, 'createUser'])->name('post.create.user');
    Route::get('/vistors', [UserController::class, 'trustedUser'])->name('get.v.users');

    /**
     * -------------------------
     * Public docs
     * ---------------------------
     */
    Route::get('/public/docs', [DocController::class, 'public'])->name('get.docs');
    Route::get('/public/doc-tags', [DocController::class, 'tags'])->name('get.tags');

    /**
     * -------------------------
     * Public comments routes
     * -------------------------
     */
    Route::get('/comments/{doc}', [DocCommentController::class, 'index'])->name('get.comments');
    Route::get('/unique/comments/{doc}', [DocCommentController::class, 'unique'])->name('get.unique.comments');

    /**
     * -----------------------------
     * Authenticated user routes
     * ------------------------------
     */
    Route::group(['middleware' => 'auth:api'], function() {
        /**
         * -----------------------------------------------
         * Docs routes
         * ------------------------------------------------
         */
        Route::get('/docs', [DocController::class, 'index'])->name('get.docs');
        Route::get('/docs/{doc}', [DocController::class, 'show'])->name('get.doc');

        /**
         * -----------------------------------------------
         * Doc Comments routes
         * ------------------------------------------------
         */
        Route::post('/comments/{doc}', [DocCommentController::class, 'store'])->name('post.comments');
        Route::delete('/comments/{comment}', [DocCommentController::class, 'destroy'])->name('delete.comments');

        /**
         * ----------------------------------------------
         * user routes
         * ---------------------------------------------
         */
        Route::get('/users', [UserController::class, 'index'])->name('get.users');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('get.single.user');

        /**
         * ---------------------------------------------
         * ADMIN Routes
         * ---------------------------------------------
         */
        Route::group(['middleware' => ['hasAdminRole']], function() {
            /**
             * ---------------------------
             * Docs Routes
             * ---------------------------
             */
            Route::post('/docs', [DocController::class, 'store'])->name('post.docs');
            Route::post('/docs/{doc}', [DocController::class, 'update'])->name('update.docs');
            Route::delete('/docs/{doc}', [DocController::class, 'destroy'])->name('delete.docs');

            /**
             * --------------------------
             * User routes
             * --------------------------
             */
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete.user');
        });

        /**
         * Get client id and secret
         */
        Route::post('/clients', [UserController::class, 'storeClient'])->name('post.clients');
    });
