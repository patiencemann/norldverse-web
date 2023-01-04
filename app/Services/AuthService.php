<?php
    namespace App\Services;

    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;

    class AuthService {
        /**
         * $providerUser Socialite user array
         * @var array
         */
        protected $providerUser;

        /**
         * @param $providerUser Socialite/Custom user object
         * @param $providerName Social/Custom auth provider
         */
        public static function handle(array $providerUser) {
            $self = new self;
            $self->providerUser = $providerUser;
            return $self;
        }

        /**
         * If a user has registered before using social auth,
         * update or create
         *
         * @return  User
         */
        public function updateOrCreateUser() {
            $authUser = User::where('email', $this->providerUser['email'])->first();

            return  ($authUser)
                    ? $this->updateUser($authUser)
                    : $this->createUser(Role::USER);
        }

        /**
         * Create new user
         *
         * @return  User
         */
        public function createUser($role) {
            $user = User::create($this->providerUser);
            $user->attachRole($role);
            return $user;
        }

        /**
         * Update current user
         *
         * @param User $user
         * @return User
         */
        public function updateUser($user) {
            $user->update($this->providerUser);
            return $user;
        }

        /**
         * Update current user
         *
         * @param User $user
         * @return User
         */
        public static function accessToken(User $user) {
            return $user->createToken('client')->accessToken;
        }

        /**
         * Login user
         * @return void
         */
        public static function login($authUser) :void {
            Auth::login($authUser, true);
        }

        /**
         * logout authenticated user
         * @return void
         */
        public static function logout() :void {
            Session::flush();
            Auth::logout();
        }
    }
