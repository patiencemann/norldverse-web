<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\NewsletterRequest;
    use App\Http\Requests\StoreClientRequest;
    use App\Http\Requests\StoreUserRequest;
    use App\Http\Requests\UpdateUserProfileRequest;
    use App\Http\Requests\UserLoginRequest;
    use App\Http\Resources\Private\UserResource as PrivateUserResource;
    use App\Http\Resources\Public\UserResource as PublicUserResource;
use App\Mail\NewsletterEmail;
use App\Models\Newsletter;
    use App\Models\Role;
    use App\Models\User;
    use App\Models\UserRequest;
    use App\Services\AuthService;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Laravel\Passport\ClientRepository;

    class UserController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            return PrivateUserResource::collection(
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
            return PrivateUserResource::make($user);
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
         * Register new newsletter
         *
         * @param NewsletterRequest $request
         * @return JsonResponse
         */
        public function newsletters(NewsletterRequest $request) {
            if(Newsletter::where('email', $request->email)->exists()){
                return response()->json([
                    'message' => "You've already subscribed"
                ], 400);
            }

            $newsletter = Newsletter::create($request->validated());

            $emailData = ['title' => 'Stay in the know with Patienceman Newsletter!'];
            Mail::to($newsletter->email)->send(new NewsletterEmail($emailData));

            return response()->json([
                'message' => "Thank for subscribe to our newsletter"
            ], 201);
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

        /**
         * Login User
         *
         * @param UserLoginRequest $request
         * @return JsonResponse
         */
        public function trustedUser() {
            $users = User::withCount('docComments')->orderBy('doc_comments_count', 'desc')->get();

            return response()->json([
                "message" => "invalid email, passpord or both",
                "data" => PublicUserResource::collection($users)
            ]);
        }

        /**
         * Become a writter
         *
         * @return JsonResponse
         */
        public function becomeWritter() {
            authUser()->userRequests()->create([ 'request' => UserRequest::WRITTE ]);
            return response()->json(['message' => "Your request sent, and you'll recieve response soon or later"]);
        }

        /**
         * Update user profile
         *
         * @param UpdateUserProfileRequest $request
         * @return JsonResponse
         */
        public function updateProfile(UpdateUserProfileRequest $request) {
            authUser()->update(['name' => $request->fullname]);

            authUser()->userMetaData()->update([
                'bio' => $request->bio,
                'position' => $request->position,
                'twitter_handler' => $request->twitter_handler
            ]);

            return response()->json(['message' => "Your profile updated"]);
        }
    }
