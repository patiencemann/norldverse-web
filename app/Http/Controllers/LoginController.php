<?php

    namespace App\Http\Controllers;

    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use App\Services\AuthService;
    use Carbon\Carbon;
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

            $authService = AuthService::handle([
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                'provider' => $provider,
                'provider_id' => $providerUser->id,
                'provider_token' => $providerUser->token,
                'provider_remember_token' =>$providerUser->refreshToken,
                'email_verified_at' => Carbon::now(),
                'avatar' => $providerUser->avatar
            ]);

            $authUser = $authService->updateOrCreateUser();
            $authService->login($authUser);

            return redirect($this->redirectTo);
        }

        /**
         * Logout authenticated user
         */
        public function logout() {
            AuthService::logout();
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
