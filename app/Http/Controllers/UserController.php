<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreClientRequest;
    use App\Http\Requests\StoreUserRequest;
    use App\Http\Requests\UserLoginRequest;
    use App\Http\Resources\UserResource;
    use App\Models\Role;
    use App\Models\User;
    use App\Services\AuthService;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Laravel\Passport\ClientRepository;

    class UserController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            return UserResource::collection(
                User::orderBy('created_at', 'desc')->get()
            );
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show(User $user) {
            return UserResource::make($user);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(User $user) {
            $user->delete();
            return response()->json([
                'message' => 'user deleted successfully'
            ], 200);
        }

        /**
         * Create client id and secret
         *
         * @param ClientRepository $clients
         * @param StoreClientRequest $request
         * @return JsonResponse
         */
        public function storeClient(ClientRepository $clients, StoreClientRequest $request) {
            $client = $clients->create(
                $request->id,
                $request->name,
                $request->redirect_url ?? 'no-redirect'
            );

            return response()->json([
                "message" => "client created successfully",
                "data" => [
                    "client_id" => $client->id,
                    "client_secret" => $client->plainSecret,
                ]
            ], 200);
        }

        /**
         * Create user
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
                "data" => UserResource::make($user),
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
                    "data" => UserResource::make(authUser()),
                    "access_token" => AuthService::accessToken(authUser())
                ], 400);

            return response()->json([
                "message" => "invalid email, passpord or both"
            ], 400);
        }
    }
