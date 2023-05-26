<?php

    namespace App\Http\Controllers;

    use App\CustomData\NewsRSS;
    use App\CustomData\Sitemap;
    use App\CustomData\SitemapNews;
    use App\Filters\DocFilter;
    use App\Http\Requests\StoreDocRequest;
    use App\Http\Resources\Public\DocResource as PublicDocResource;
    use App\Http\Resources\Private\DocResource as PrivateDocResource;
    use App\Models\Doc;
    use App\Models\DocTopic;
    use App\Notifications\DatabaseNotification;
    use App\XMLServices\NewsRssService;
    use App\XMLServices\SitemapNewsService;
    use App\XMLServices\SitemapService;
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
    use Patienceman\Notifier\Notifier;

    use League\CommonMark\CommonMarkConverter;

    class DocController extends Controller {
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
        public function public(DocFilter $filters) {
            return PublicDocResource::collection(
                Doc::withCount('docComments')
                    ->filter($filters)
                    ->where('status', true)
                    ->orderBy('created_at', 'desc')
                    ->get()
            );
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
                $options = array('public_id' => 'patienceman-docs/' . $request->image)
            )->getSecurePath();

            $doc = authUser()->docs()->create($request->validated());
            $doc->docMedia()->create(['file_url' => $imageFile]);
            $doc->docTopic()->create(['topics' => array_map('trim', array_map('strtolower', $request->topics))]);

            (new Notifier())->send([
                DatabaseNotification::process([
                    "subject" => "New published blog",
                    "message" => $doc->title." have been published and ready",
                    'action' => "/dashboard"
                ])->to(authUser())
            ]);

            $this->reGenerateXMLs();

            return response()->json([
                'data' => PrivateDocResource::make($doc),
                'message' => "Doc Created/Posted successfully"
            ], 200);
        }

        public function reGenerateXMLs() {
            $sitemapData = [];
            $sitemapNewsData = [];
            $newsRssData = [];

            $converter = new CommonMarkConverter();

            foreach (Doc::all() as $doc) {
                array_push($sitemapData, Sitemap::make([
                    'absolute_url' => env('APP_URL').'/docs/'.$doc->slug,
                    'updated_at' => $doc->updated_at->toDateTimeString(),
                    'change_frequency' => 'weekly',
                    'priority' => 0.9
                ]));

                array_push($sitemapNewsData, SitemapNews::make([
                    'absolute_url' => env('APP_URL').'/docs/'.$doc->slug,
                    'published_at' => $doc->created_at->toDateTimeString(),
                    'meta_title' => $doc->title,
                    'website' => env('APP_URL').'/docs/'.$doc->slug,
                    'language' => 'en'
                ]));

                array_push($newsRssData, NewsRSS::make([
                    'slug' => $doc->slug,
                    'meta_title' => $doc->title,
                    'meta_description' => $doc->caption,
                    'published_at' => $doc->created_at->toDateTimeString(),
                    'absolute_url' => env('APP_URL').'/docs/'.$doc->slug,
                    'image_url' => $doc->docMedia->file_url,
                    'html' => $converter->convert($doc->contents)->getContent(),
                    'author' => $doc->user->email.' ('.$doc->user->name.')',
                    'category' => 'Patienceman Blogs'
                ]));
            }

            // blog Sitemap service
            $sitemap = (new SitemapService())->setPages($sitemapData)->getXML();

            // Blog sitemap new service
            $sitemapNews = (new SitemapNewsService())->setPages($sitemapNewsData)->getXML();

            // News RSS service
            $newsRss = (new NewsRssService())->setPages($newsRssData)->getXML();

            $sitemapHandle = fopen(public_path().'/sitemap.xml', "w+");
            fclose($sitemapHandle);
            $sitemapfile = fopen(public_path().'/sitemap.xml', "w");
            fwrite($sitemapfile, $sitemap);
            fclose($sitemapfile);

            $sitemapNewsHandle = fopen(public_path().'/news_sitemap.xml', "w+");
            fclose($sitemapNewsHandle);
            $sitemapNewsfile = fopen(public_path().'/news_sitemap.xml', "w");
            fwrite($sitemapNewsfile, $sitemapNews);
            fclose($sitemapNewsfile);

            $newsRssHandle = fopen(public_path().'/feed.xml', "w+");
            fclose($newsRssHandle);
            $newsRssfile = fopen(public_path().'/feed.xml', "w");
            fwrite($newsRssfile, $newsRss);
            fclose($newsRssfile);
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
                $options = array('public_id' => 'patienceman-docs/' . $request->image)
            )->getSecurePath();

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

            $this->reGenerateXMLs();

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
    }
