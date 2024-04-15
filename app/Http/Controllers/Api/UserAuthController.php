<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreUserRequest;
    use App\Http\Requests\UserLoginRequest;
    use App\Services\AuthService;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Role;
    use App\Http\Resources\Private\UserResource as PrivateUserResource;
    use Illuminate\Support\Facades\Auth;

    class UserAuthController extends Controller {
        /**
         * register newly user
         *
         * @param ClientRepository $clients
         * @param StoreClientRequest $request
         * @return JsonResponse
         */
        public function createUser(StoreUserRequest $request) {
            $user = AuthService::handle([
                'name' => $request->name,
                'email' => $request->email,
                'provider' => defaultProvider()->name,
                'provider_id' => defaultProvider()->id,
                'provider_token' => defaultProvider()->token,
                'provider_remember_token' => defaultProvider()->remember_token,
                'avatar' => defaultAvatar(),
                'password' => Hash::make($request->password)
            ])->createUser(Role::USER);

            return response()->json([
                "message" => "user created successfully",
                "data" => PrivateUserResource::make($user),
                "access_token" => AuthService::accessToken($user)
            ], 200);
        }

        /**
         * Login User
         *
         * @param UserLoginRequest $request
         * @return JsonResponse
         */
        public function login(UserLoginRequest $request) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                return response()->json([
                    "message" => "Auth attempts success",
                    "data" => PrivateUserResource::make(authUser()),
                    "access_token" => AuthService::accessToken(authUser())
                ], 400);

            return response()->json([
                "message" => "invalid email, passpord or both"
            ], 400);
        }
    }
