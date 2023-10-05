<?php

    namespace App\Http\Controllers;

    use App\Filters\DocFilter;
    use App\Http\Requests\StoreDocRequest;
use App\Http\Resources\BlogCategoryResource;
use App\Http\Resources\BlogCategoryWithDocs;
use App\Http\Resources\Public\DocResource as PublicDocResource;
    use App\Http\Resources\Private\DocResource as PrivateDocResource;
    use App\Jobs\ProcessNewDocEmails;
use App\Models\BlogCategory;
use App\Models\Doc;
    use App\Models\DocTopic;
use App\Models\DocView;
use App\Notifications\CloudNotification;
    use App\Notifications\DatabaseNotification;
    use App\Traits\FileStorage;
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
    use Patienceman\Notifier\Notifier;

    class DocController extends Controller {
        use FileStorage;

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() {
            return PrivateDocResource::collection(
                Doc::where('status', true)->orderBy('created_at', 'desc')->get()
            );
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function public(Request $request, DocFilter $filters) {
            if($request->categorize) {
                $categories = BlogCategory::all();

                $docs = Doc::withCount('docComments')
                    ->filter($filters)
                    ->where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->groupBy('blog_category_id');

                $categoriesWithBlogs = $categories->map(function ($category) use ($docs) {
                    return [
                        'category' => $category,
                        'blogs' => PublicDocResource::collection($docs->get($category->id, [])),
                    ];
                });

                return response()->json([ 'data' => $categoriesWithBlogs ]);
            }

            return PublicDocResource::collection(
                Doc::withCount('docComments')
                    ->filter($filters)
                    ->where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->get()
            );
        }

        /**
         * Display a related of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function relatedStories(Doc $doc) {
            $tagNames = $doc->docTopic->topics;

            $relatedDocs = Doc::whereHas('docTopic', function ($query) use ($tagNames) {
                $query->orWhereJsonContains('topics', $tagNames);
            })->where('id', '!=', $doc->id)->get();

            return PublicDocResource::collection($relatedDocs);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  StoreDocRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(StoreDocRequest $request) {
            $imageFile = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                $options = array(
                    'public_id' => 'patienceman-docs/' . $request->image,
                    'folder' => (!App::environment(['local', 'staging'])) ? 'patienceman-docs-prod' : 'patienceman-docs-test'
            ))->getSecurePath();

            $doc = authUser()->docs()->create($request->validated());
            $doc->docMedia()->create(['file_url' => $imageFile]);
            $doc->docTopic()->create(['topics' => array_map('trim', array_map('strtolower', $request->topics))]);

            $notificationPayload = [
                "subject" => "New published blog",
                "message" => $doc->title." have been published and ready",
                'action' => "/dashboard",
                "topic" => "newBlogs"
            ];

            (new Notifier())->send([
                DatabaseNotification::process($notificationPayload)->to(authUser()),
                // CloudNotification::process($notificationPayload),
            ]);

            ProcessNewDocEmails::dispatch($doc);

            return response()->json([
                'data' => PrivateDocResource::make($doc),
                'message' => "Doc published successfully"
            ], 201);
        }

        public function categories(Request $request) {
            BlogCategory::create([
                'name' => $request->name
            ]);

            return response()->json(['message' => "category created"], 201);
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function show(Doc $doc) {
            return PrivateDocResource::make($doc);
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function publicDoc(Doc $doc) {
            return PublicDocResource::make($doc);
        }
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function publicCategories() {
            $categories = BlogCategory::where('active_status', true)->orderBy('created_at', 'desc')->get();
            return BlogCategoryResource::collection($categories);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function edit(Doc $doc) {
            return view('pages.Auth.update-doc', compact('doc'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function update(StoreDocRequest $request, Doc $doc) {
            $imageFile = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                $options = array(
                    'public_id' => 'patienceman-docs/' . $request->image,
                    'folder' => (!App::environment(['local', 'staging'])) ? 'patienceman-docs-prod' : 'patienceman-docs-test'
            ))->getSecurePath();

            $doc->update($request->validated());
            $doc->docMedia()->update([ 'file_url' => $imageFile ]);
            $doc->docTopic()->update(['topics' => array_map('trim', array_map('strtolower', $request->topics))]);

            (new Notifier())->send([
                DatabaseNotification::process([
                    "subject" => "Blog updated successfully",
                    "message" => $doc->title." have been updated",
                    'action' => "/dashboard"
                ])->to(authUser())
            ]);

            return response()->json([
                'data' => PrivateDocResource::make($doc),
                'message' => 'Doc updated successfully'
            ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function destroy(Doc $doc) {
            $doc->delete();

            (new Notifier())->send([
                DatabaseNotification::process([
                    "subject" => "Blog Deleted",
                    "message" => $doc->title." have been deleted/removed and no longer live",
                    'action' => "/dashboard"
                ])->to(authUser())
            ]);

            return response()->json([
                'message' => 'Doc removed successfully'
            ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Doc  $doc
         * @return \Illuminate\Http\Response
         */
        public function tags() {
            $tags = [];

            foreach(DocTopic::orderByRaw('RAND()')->get() as $topics){
                foreach($topics->topics as $topic){
                    if(!in_array(strtolower(trim($topic)), $tags))
                        array_push($tags, strtolower(trim($topic)));
                }
            }

            return response()->json([
                'tags' => $tags,
                'message' => 'tags listed'
            ]);
        }

        public function blogView(Doc $doc, Request $request) {
            $address = $request->ip();
            $view = DocView::where('doc_id', $doc->id)->where('ip_address', $address)->exists();
            
            $view ?? $doc->views()->create([
                'ip_address' => $request->ip()
            ]);
        }
    }
