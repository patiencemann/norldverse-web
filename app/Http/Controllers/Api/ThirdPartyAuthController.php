<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Role;
    use App\Services\AuthService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use App\Http\Resources\Private\UserResource as PrivateUserResource;

    class ThirdPartyAuthController extends Controller {
        /**
         * register newly user
         *
         * @param ClientRepository $clients
         * @param StoreClientRequest $request
         * @return JsonResponse
         */
        public function authenticateUser(Request $request) {
            $user = AuthService::handle([
                'name' => $request->name,
                'email' => $request->email,
                'provider' => $request->provider,
                'provider_id' => $request->provider_id,
                'provider_token' => $request->provider_token,
                'provider_remember_token' => $request->remember_token,
                'avatar' => $request->avatar,
                'password' => Hash::make($request->password)
            ])->createUser(Role::USER);

            return response()->json([
                "message" => "user created successfully",
                "data" => PrivateUserResource::make($user),
                "access_token" => AuthService::accessToken($user)
            ], 200);
        }

        public function logout() {
            AuthService::logout();
            return response()->json(['message' => 'Logged out successfully']);
        }
    }
