<?php

    use Illuminate\Support\Facades\Auth;

    if(!function_exists('AuthUser')){
        /**
         * Return authenticated user
         * @return Auth
         */
        function authUser() {
            return Auth::user();
        }
    }
