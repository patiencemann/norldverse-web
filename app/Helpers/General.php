<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    if(!function_exists('AuthUser')){
        /**
         * Return authenticated user
         * @return App\Models\User
         */
        function authUser() {
            return Auth::user();
        }
    }

    if(!function_exists('defaultAvatar')){
        /**
         * Return Default user avatar
         * @return String
         */
        function defaultAvatar() {
            return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
        }
    }

    if(!function_exists('defaultProvider')){
        /**
         * Return Default user avatar
         * @return Object
         */
        function defaultProvider() {
            return (Object) [
                'id' => rand(1, 999999),
                'name' => 'patienceman',
                'token' => Hash::make(Str::random(10)),
                'remember_token' => Hash::make(Str::random(10)),
            ];
        }
    }
