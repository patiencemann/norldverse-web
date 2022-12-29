<?php

    namespace App\Http\Controllers;

    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
    use Laravel\Socialite\Facades\Socialite;

    class LoginController extends Controller {
        /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

        use AuthenticatesUsers;

        /**
         * Where to redirect users after login.
         *
         * @var string
         */
        protected $redirectTo = RouteServiceProvider::HOME;

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct() {
            $this->middleware('guest')->except('logout');
        }

        /**
         * Redirect the user to the provider authentication page.
         *
         * @return Response
         */
        public function redirectToProvider($provider) {
            return Socialite::driver($provider)->redirect();
        }

        /**
         * Obtain the user information from provider.
         *
         * @return Response
         */
        public function handleProviderCallback($provider) {
            $providerUser = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($providerUser, $provider);
            Auth::login($authUser, true);
            return redirect($this->redirectTo);
        }

        /**
         * If a user has registered before using social auth, return the user
         * else, create a new user object.
         *
         * @param  $user Socialite user object
         * @param $provider Social auth provider
         * @return  User
         */
        public function findOrCreateUser($providerUser, $providerName) {
            $authUser = User::where('provider_id', $providerUser->id)
                            ->where('provider', $providerName)
                            ->where('email', $providerUser->email)
                            ->first();

            if ($authUser) return $authUser;

            return User::create([
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                'provider' => $providerName,
                'provider_id' => $providerUser->id,
                'provider_token' => $providerUser->token,
                'provider_remember_token' =>$providerUser->refreshToken,
                'email_verified_at' => Carbon::now(),
                'avatar' => $providerUser->avatar
            ]);
        }

        /**
         * Logout authenticated user
         */
        public function logout() {
            Session::flush();
            Auth::logout();
            return redirect()->route('home');
        }

        /**
         * Obtain the user information from Github.
         */
        public function handleGithubCallback() {
            return $this->handleProviderCallback('github');
        }

        /**
         * Obtain the user information from Google.
         */
        public function handleGoogleCallback() {
            return $this->handleProviderCallback('google');
        }
    }
