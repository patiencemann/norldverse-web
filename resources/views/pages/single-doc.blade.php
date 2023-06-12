@extends('layouts.app')

@section('meta-data')
    <meta name="theme-color" content="#1e2a3b">

    <!-- Basic HTML Meta Tags -->
    <meta charset='UTF-8'>
    <meta name="googlebot" content="noodp" />
    <meta property="article:published_time" content="{{ $doc->created_at }}">
    <meta property="article:author" content="{{ env('APP_URL') }}">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="description" content="{{ $doc->caption }}">
    <meta name='keywords' content='@foreach ($doc->docTopic->topics as $topic) {{ $topic."," }} @endforeach'>
    <meta name='subject' content=''>
    <meta name='copyright' content='Patienceman Blogs'>
    <meta name='language' content='ES'>
    <meta name='robots' content='index,follow'>
    <meta name='revised' content='Sunday, June 12th, 2023'>
    <meta name='abstract' content=''>
    <meta name='topic' content="{{ $doc->title }}">
    <meta name='summary' content="{{ $doc->caption }}">
    <meta name='Classification' content='Personal Blogs'>
    <meta name='author' content='{{ $doc->user->name }}, {{ $doc->user->email }}'>
    <meta name='designer' content='{{ $doc->user->name }}'>
    <meta name='reply-to' content='{{ $doc->user->email }}'>
    <meta name='owner' content='{{ $doc->user->name }}'>
    <meta name='url' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
    <meta name='identifier-URL' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
    <meta name='directory' content='submission'>
    <meta name='pagename' content='{{ $doc->title }}'>
    <meta name='category' content=''>
    <meta name='coverage' content='Worldwide'>
    <meta name='distribution' content='Global'>
    <meta name='rating' content='General'>
    <meta name='revisit-after' content='7 days'>
    <meta name='subtitle' content='{{ $doc->caption }}'>
    <meta name='target' content='all'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <meta name='date' content='June. 12, 2023'>
    <meta name='search_date' content='2023-06-12'>
    <meta name='DC.title' content='{{ $doc->title }}'>
    <meta name='ResourceLoaderDynamicStyles' content=''>
    <meta name='medium' content='blog'>
    <meta name='pageKey' content='single-blog'>
    <meta http-equiv='Expires' content='0'>
    <meta http-equiv='Pragma' content='no-cache'>
    <meta http-equiv='Cache-Control' content='no-cache'>
    <meta http-equiv='imagetoolbar' content='no'>
    <meta http-equiv='x-dns-prefetch-control' content='off'>

    <!-- OpenGraph Meta Tags -->
    <meta property='og:title' content='{{ $doc->title }}'>
    <meta property='og:type' content='article'>
    <meta property='og:url' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
    <meta property='og:image' content='{{ $doc->docMedia->file_url }}'>
    <meta property='og:site_name' content='Patienceman-blogs'>
    <meta property='og:description' content='{{ $doc->caption }}'>

    <meta property='fb:page_id' content='43929265776'>
    <meta property='application-name' content='Patienceman-blogs'>
    <meta property='og:email' content='{{ $doc->user->email }}'>

    <meta property='og:latitude' content='-1.9584038'>
    <meta property='og:longitude' content='30.0694946'>
    <meta property='og:street-address' content='34 KN 41 Street'>
    <meta property='og:locality' content='Nyarugenge'>
    <meta property='og:region' content='NY'>
    <meta property='og:postal-code' content='5748'>
    <meta property='og:country-name' content='RW'>

    <meta property='twitter:card' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
    <meta property='twitter:site' content='Patienceman-blogs'>
    <meta property='twitter:creator' content='{{ $doc->user->name }}'>
    <meta property='twitter:description' content='{{ $doc->caption }}'>
    <meta property='twitter:title' content='{{ $doc->title }}'>
    <meta property='twitter:image' content='{{ $doc->docMedia->file_url }}'>
    <meta property='twitter:image:alt' content='{{ $doc->title }}'>
    <meta property="twitter:image:src" content="{{ $doc->docMedia->file_url }}">

    <!-- App meta tags -->
    <meta name="apple-mobile-web-app-title" content="{{ $doc->title }}">
    <meta name='apple-mobile-web-app-capable' content='yes'>
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name='apple-mobile-web-app-status-bar-style' content='black'>
    <meta name='format-detection' content='telephone=no'>
    <meta name='viewport' content='width=device-width; content='width = 320; initial-scale=1.0; maximum-scale=1.0; user-scalable=yes; target-densitydpi=160dpi'>

    <!-- Internet Explore -->
    <meta http-equiv='Page-Enter' content='RevealTrans(Duration=2.0,Transition=2)'>
    <meta http-equiv='Page-Exit' content='RevealTrans(Duration=3.0,Transition=12)'>
    <meta name='mssmarttagspreventparsing' content='true'>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
    <meta name='msapplication-starturl' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
    <meta name='msapplication-window' content='width=800;height=600'>
    <meta name='msapplication-navbutton-color' content='red'>
    <meta name='application-name' content='{{ $doc->title }}'>
    <meta name='msapplication-tooltip' content='{{ $doc->user->name }}'s Blog'>
    <meta name='msvalidate.01' content='6E3AD52DC176461A3C81DD6E98003BC9'>
    <meta http-equiv='cleartype' content='on'>

    <!-- Google meta tags -->
    <meta name="news_keywords" content="{{ $doc->title }}">

    <!-- TweetMeme -->
    <meta name='tweetmeme-title' content='{{ $doc->title }}'>
    <meta data-rh="true" name="referrer" content="safe-url">

    <link data-rh="true" rel="canonical" href="{{ env('APP_URL')."/docs/".$doc->slug }}">
    <link rel="alternate" type="application/rss+xml" title="Patienceman - blogs &raquo; Feed" href="{{ env('APP_URL').'/feed.xml' }}" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BHRK59S1F7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-BHRK59S1F7');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N96KD8Q');</script>
    <!-- End Google Tag Manager -->
@stop

@section('title')
    {{ $doc->title }}
@stop

@section('content')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N96KD8Q"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <x-navigation-bar />

    <div id="downloadable">
        <div class="post-header dark:bg-deep-green-800">
            <div class="post-header-wrap global-padding">
                <div class="post-header-container">
                    <div class="post-header-content">
                        <div>
                            <div class="post-tags global-tags">
                                @foreach ($doc->docTopic->topics as $topic)
                                    <a>{{ $topic }}</a>
                                @endforeach
                            </div>
                            <h1 class="post-title global-title dark:text-gray-200">{{ $doc->title }}</h1>
                            <p class="post-excerpt global-excerpt dark:text-gray-200">{{ $doc->caption }}</p>
                        </div>
                        <div class="flex justify-between items-center post-socials">
                            <div class="post-meta">
                                <div class="post-authors">
                                    <div class="post-item-author global-item-author is-image global-image">
                                        <a href="{{ optional($doc->user->userMetaData)->twitter_handler }}" class="global-link font-bold" title="{{ $doc->user->name }}"></a>
                                        <img src="{{ $doc->user->avatar }}" loading="lazy" alt="{{ $doc->user->name }}">
                                    </div>
                                </div>

                                <div class="post-meta-content font-anek">
                                    <a href="{{ ($doc->user->userMetaData) ? $doc->user->userMetaData->twitter_handler : "/" }}" class="font-bold dark:text-gray-200">{{ $doc->user->name }}</a> <br>
                                    <span class="font-anek text-gray-500">{{ ($doc->user->userMetaData) ? $doc->user->userMetaData->position : "Position" }}</span> <br />
                                    <strong class="text-gray-600 mt-1">Published: {{ $doc->created_at->diffForHumans() }}</strong> <read-time text="{{ $doc->contents }}" /></time>
                                </div>
                            </div>
                        </div>

                        {{-- Share this doc --}}
                        <social-links
                            page_description="{{ $doc->caption }}"
                            page_title="{{ $doc->title }}"
                        />
                    </div>
                    <div class="post-header-image">
                        <figure>
                            <div class="global-image global-image-orientation global-radius is-square">
                                <img srcset="{{ $doc->docMedia->file_url }} 300w,
                                            {{ $doc->docMedia->file_url }} 600w,
                                            {{ $doc->docMedia->file_url }} 1200w"
                                    sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px"
                                    src="{{ $doc->docMedia->file_url }}" alt="{{ $doc->title }}" id="global-image-picker">
                            </div>
                        </figure>
                        <div class="gradient-overlay"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-content-container dark:bg-deep-green-900">
            <div class="post-content dark:text-gray-300" id="page_brak_post_content">
                <render-mark-down-contents contents="{{ $doc->contents }}" />
            </div>
        </div>
    </div>

    <section class="comments dark:bg-deep-green-800">
        <div class="comment-container">
            <div>
                {{-- Comment statistics --}}
                <comment-stats
                    liked="{{ Auth::check() ? ($doc->likes->filter(fn($value) => $value->user_id == Auth::user()->id)->isNotEmpty() ? true : false) : false }}"
                    likes="{{ $doc->likes->count() }}"
                    doc="{{ $doc->id }}"
                    auth="{{ Auth::check() }}" />
            </div>

            <div>
                @if (Auth::check())
                    <div class="mb-4">
                        <h2 class="font-anek dark:text-[#E8E8ED]">Share your comments</h2>
                    </div>
                    {{-- Add comment --}}
                    <add-comments avatar="{{ authUser()->avatar }}" doc="{{ $doc->id }}" />
                @else
                    <div class="mb-4">
                        <h2 class="font-anek dark:text-[#E8E8ED]">Sign In to share <br> your comments</h2>
                    </div>
                    <div>
                        <a href="{{ route('init.oauth', ['google']) }}" class="text-white font-anek bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                            <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                            <span class="mt-1" style="font-size: 16px">Sign in with Google</span>
                        </a>
                        <a href="{{ route('init.oauth', ['github']) }}" class="text-white font-anek bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                            <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                            <span class="mt-1" style="font-size: 16px">Sign in with Github</span>
                        </a>
                    </div>
                @endif
            </div>
            <div>
                {{-- List comments --}}
                <get-comments doc="{{ $doc->id }}" />
            </div>
        </div>
    </section>
@endsection
