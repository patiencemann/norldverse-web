<?php

    namespace App\Providers;

    use App\Services\FirebaseMessagingService;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register() {
            $this->app->bind('FirebaseMessaging',function(){
                return new FirebaseMessagingService();
            });
        }

        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            //
        }
    }
