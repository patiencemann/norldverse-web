<?php

    namespace App\Models;

    use Laratrust\Models\LaratrustRole;

    class Role extends LaratrustRole {
        public $guarded = [];

        /**
         * Predefined roles
         * @var array ROLES
         */
        public const SUPER_ADMIN = 'superadministrator';
        public const ADMIN = 'administrator';
        public const USER = 'user';
    }
