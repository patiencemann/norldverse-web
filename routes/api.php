<?php

    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\DocCommentController;
    use App\Http\Controllers\DocController;
use App\Http\Controllers\DocLikeController;
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
        Route::post('/docs/like/{doc}', [DocLikeController::class, 'store'])->name('doc.like');

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
        Route::post('/users/profile', [UserController::class, 'updateProfile'])->name('update.profile');

        /**
         * ---------------------------------------------
         * ADMIN Routes
         * ---------------------------------------------
         */
        Route::group(['middleware' => ['hasWritterRole']], function() {
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
         * ----------------------------------------------------------------------
         * Notifications routes
         * ----------------------------------------------------------------------
         */
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/notifications/{notification}', [NotificationController::class, 'unRead']);
        Route::post('/notifications/read/all', [NotificationController::class, 'readAll']);
        Route::get('/notifications/count', [NotificationController::class, 'count']);
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']);

        /**
         * Get client id and secret
         */
        Route::post('/clients', [UserController::class, 'storeClient'])->name('post.clients');

        Route::post('/become-writter', [UserController::class, 'becomeWritter'])->name('user.become.writter');
    });
