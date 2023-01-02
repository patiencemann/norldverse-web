<?php
    namespace App\Services;

    use App\Models\Role;
    use Exception;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class AdminService {
        /**
         * new super admin details
         * @var array
         */
        protected static array $data = [];

        /**
         * Initialize class instances
         *
         * @param array $details
         */
        public static function make(array $details) {
            static::$data = $details;
            static::checkAlreadyExists();
            static::validate();
            static::saveSuperAdmin();
        }

        /**
         * Check if the system already register another super admin
         * @return Exception|bool
         */
        public static function checkAlreadyExists() {
            $superAdminRole = Role::where('name', Role::ADMIN)->first();

            if(!$superAdminRole) return false;

            if ($superAdminRole->users->count() == 0) return false;

            throw new Exception('The system already have a super admin');
        }

        /**
         * Save super admin information
         *
         * @return \App\User
         */
        public static function saveSuperAdmin() {
            $user = AuthService::handle([
                'name' => static::$data['name'],
                'email' => static::$data['email'],
                'provider' => 'patienceman',
                'provider_id' => shuffle(range(1, 999999)),
                'provider_token' => Hash::make(Str::random(10)),
                'provider_remember_token' => Hash::make(Str::random(10)),
                'avatar' => defaultAvatar()
            ])->createUser(Role::ADMIN)->refresh();

            $user->update([
                'password' => Hash::make(static::$data['password'])
            ]);

            return $user;
        }

        /**
         * Check wether all provided information for admin are valid
         * @return void
         */
        private static function validate() {
            static::doesAllProvided();
            static::validatePassowrd();
            static::validateEmail();
        }

        /**
         * Check wether all required info were provided
         * @return Exception|void
         */
        private static function doesAllProvided() {
            foreach (static::$data as $fieldName => $fieldValue) {
                if ($fieldValue) continue;
                throw new Exception("The field {$fieldName} is required");
            }
        }

        /**
         * Check if the password is valid
         *
         * @return Exception|void
         */
        private static function validatePassowrd() {
            if (strlen(static::$data['password']) < 8)
                throw new Exception('The password must have at least 8 characters');

            if (! Str::is(static::$data['password'], static::$data['confirm_password']))
                throw new Exception("The two passwords don't match");
        }

        /**
         * check wether the provided email is valid
         * @return Exception|void
         */
        private static function validateEmail() {
            $email = filter_var(static::$data['email'], FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) return;

            throw new Exception("The email: {$email} is not valid");
        }
    }
