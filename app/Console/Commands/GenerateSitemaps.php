<?php

    namespace App\Console\Commands;

    use App\CustomData\NewsRSS;
    use App\CustomData\Sitemap;
    use App\CustomData\SitemapNews;
    use App\Models\Doc;
    use App\XMLServices\NewsRssService;
    use App\XMLServices\SitemapNewsService;
    use App\XMLServices\SitemapService;
    use Exception;
    use Illuminate\Console\Command;
    use League\CommonMark\CommonMarkConverter;

    class GenerateSitemaps extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'sitemap:generate';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Generate sitemaps files';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return int
         */
        public function handle() {
            try{
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

                $this->info('Sitemaps generated');
            }catch(Exception $exception) {
                $this->error($exception->getMessage());
            }
        }
    }
