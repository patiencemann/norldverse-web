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
    <meta name='copyright' content='Norldverse'>
    <meta name='language' content='ES'>
    <meta name='robots' content='index,follow'>
    <meta name='revised' content='Sunday, June 12th, 2023'>
    <meta name='abstract' content=''>
    <meta name='topic' content="{{ $doc->title }}">
    <meta name='summary' content="{{ $doc->caption }}"> 
    <meta name='Classification' content='blogging'>
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
    <meta property='og:site_name' content='Norldverse'>
    <meta property='og:description' content='{{ $doc->caption }}'>

    <meta property='fb:page_id' content='43929265776'>
    <meta property='application-name' content='Norldverse'>
    <meta property='og:email' content='{{ $doc->user->email }}'>

    <meta property='og:latitude' content='-1.9584038'>
    <meta property='og:longitude' content='30.0694946'>
    <meta property='og:street-address' content='34 KN 41 Street'>
    <meta property='og:locality' content='Nyarugenge'>
    <meta property='og:region' content='NY'>
    <meta property='og:postal-code' content='5748'>
    <meta property='og:country-name' content='RW'>

    <meta property='twitter:card' content='summary_large_image'>
    <meta property='twitter:site' content='Norldverse'>
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

    <!-- Internet Explore -->
    <meta http-equiv='Page-Enter' content='RevealTrans(Duration=2.0,Transition=2)'>
    <meta http-equiv='Page-Exit' content='RevealTrans(Duration=3.0,Transition=12)'>
    <meta name='mssmarttagspreventparsing' content='true'>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
    <meta name='msapplication-starturl' content='{{ env('APP_URL')."/docs/".$doc->slug }}'>
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
    <link rel="alternate" type="application/rss+xml" title="Norldverse - blogs &raquo; Feed" href="{{ env('APP_URL').'/feed.xml' }}" />

    <link rel="stylesheet" href="/css/temp.css">
@stop

@section('title')
    {{ $doc->title }}
@stop

@section('content')
    <x-navigation-bar />

    <div id="downloadable">
        <div class="post-header overflow-hidden relative bg-slate-900">
            <div class="post-header-wrap global-padding bg-[#10172a]">
                <div class="post-header-container">
                    <div class="post-header-content relative">
                        <img alt="" fetchpriority="high" width="530" height="530"
                                decoding="async" data-nimg="1" class="absolute -right-64 -top-64"
                                style="color:transparent" src="https://syntax.tailwindui.com/_next/static/media/blur-cyan.d28a5585.png"><img
                                alt="" fetchpriority="high" width="567" height="567" decoding="async"
                                data-nimg="1" class="absolute -bottom-40 -left-44" style="color:transparent"
                                src="https://syntax.tailwindui.com/_next/static/media/blur-indigo.b752cf77.png">
                        <div>
                            <div class="mb-6">
                                @foreach ($doc->docTopic->topics as $topic)
                                    <button class="rounded-full bg-slate-800 capitalize py-2.5 px-4 text-md font-calistoga text-white hover:bg-slate-700 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/50 active:text-slate-400">{{ $topic }}</button>
                                @endforeach
                            </div>
                            <h1 class="post-title global-title dark:text-gray-200 mt-3">{{ $doc->title }}</h1>
                            <p class="post-excerpt global-excerpt dark:text-gray-200">{{ $doc->caption }}</p>
                        </div>
                        <div class="flex justify-between items-center post-socials">
                            <div class="post-meta">
                                <div class="post-authors">
                                    <div class="post-item-author global-item-author is-image global-image">
                                        <a href="{{ optional($doc->user->userMetaData)->twitter_handler }}" class="global-link font-bold text-gray-50" title="{{ $doc->user->name }}"></a>
                                        <img src="{{ $doc->user->avatar }}" loading="lazy" alt="{{ $doc->user->name }}">
                                    </div>
                                </div>

                                <div class="post-meta-content ml-4">
                                    <a href="{{ ($doc->user->userMetaData) ? $doc->user->userMetaData->twitter_handler : "/" }}" class="font-bold dark:text-gray-50">{{ $doc->user->name }}</a> <br>
                                    <span class="text-gray-200 font-calistoga">{{ ($doc->user->userMetaData) ? $doc->user->userMetaData->position : "Position" }}</span> <br />
                                    <strong class="text-gray-300 mt-2 font-calistoga capitalize leading-3">{{ $doc->created_at->diffForHumans() }}, </strong>
                                    <read-time text="{{ $doc->contents }}" class="mt-2 font-calistoga text-gray-300"/>
                                </div>
                            </div>
                        </div>

                        {{-- Share this doc --}}
                        <social-links
                            page_description="{{ $doc->caption }}"
                            page_title="{{ $doc->title }}"
                        />
                    </div>
                    <div class="post-header-image relative z-10">
                        <img alt="" fetchpriority="high" width="530" height="530"
                                decoding="async" data-nimg="1" class="absolute -right-64 -top-64"
                                style="color:transparent" src="https://syntax.tailwindui.com/_next/static/media/blur-cyan.d28a5585.png"><img
                                alt="" fetchpriority="high" width="567" height="567" decoding="async"
                                data-nimg="1" class="absolute -bottom-40 -right-44" style="color:transparent"
                                src="https://syntax.tailwindui.com/_next/static/media/blur-indigo.b752cf77.png">
                    </div>
                    <div class="absolute inset-x-[-50vw] -bottom-48 -top-32 [mask-image:linear-gradient(transparent,white,white)] dark:[mask-image:linear-gradient(transparent,white,transparent)] lg:-bottom-32 lg:-top-32 lg:left-[calc(50%+14rem)] lg:right-0 lg:[mask-image:none] lg:dark:[mask-image:linear-gradient(white,white,transparent)]">
                        <svg aria-hidden="true" viewBox="0 0 668 1069" width="668" height="1069" fill="none"
                            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 lg:left-0 lg:translate-x-0 lg:translate-y-[-60%]">
                            <defs>
                                <clipPath id=":R1l6:-clip-path">
                                    <path fill="#fff" transform="rotate(-180 334 534.4)" d="M0 0h668v1068.8H0z">
                                    </path>
                                </clipPath>
                            </defs>
                            <g opacity=".4" clip-path="url(#:R1l6:-clip-path)" stroke-width="4">
                                <path opacity=".3"
                                    d="M584.5 770.4v-474M484.5 770.4v-474M384.5 770.4v-474M283.5 769.4v-474M183.5 768.4v-474M83.5 767.4v-474"
                                    stroke="#334155"></path>
                                <path
                                    d="M83.5 221.275v6.587a50.1 50.1 0 0 0 22.309 41.686l55.581 37.054a50.102 50.102 0 0 1 22.309 41.686v6.587M83.5 716.012v6.588a50.099 50.099 0 0 0 22.309 41.685l55.581 37.054a50.102 50.102 0 0 1 22.309 41.686v6.587M183.7 584.5v6.587a50.1 50.1 0 0 0 22.31 41.686l55.581 37.054a50.097 50.097 0 0 1 22.309 41.685v6.588M384.101 277.637v6.588a50.1 50.1 0 0 0 22.309 41.685l55.581 37.054a50.1 50.1 0 0 1 22.31 41.686v6.587M384.1 770.288v6.587a50.1 50.1 0 0 1-22.309 41.686l-55.581 37.054A50.099 50.099 0 0 0 283.9 897.3v6.588"
                                    stroke="#334155"></path>
                                <path
                                    d="M384.1 770.288v6.587a50.1 50.1 0 0 1-22.309 41.686l-55.581 37.054A50.099 50.099 0 0 0 283.9 897.3v6.588M484.3 594.937v6.587a50.1 50.1 0 0 1-22.31 41.686l-55.581 37.054A50.1 50.1 0 0 0 384.1 721.95v6.587M484.3 872.575v6.587a50.1 50.1 0 0 1-22.31 41.686l-55.581 37.054a50.098 50.098 0 0 0-22.309 41.686v6.582M584.501 663.824v39.988a50.099 50.099 0 0 1-22.31 41.685l-55.581 37.054a50.102 50.102 0 0 0-22.309 41.686v6.587M283.899 945.637v6.588a50.1 50.1 0 0 1-22.309 41.685l-55.581 37.05a50.12 50.12 0 0 0-22.31 41.69v6.59M384.1 277.637c0 19.946 12.763 37.655 31.686 43.962l137.028 45.676c18.923 6.308 31.686 24.016 31.686 43.962M183.7 463.425v30.69c0 21.564 13.799 40.709 34.257 47.529l134.457 44.819c18.922 6.307 31.686 24.016 31.686 43.962M83.5 102.288c0 19.515 13.554 36.412 32.604 40.645l235.391 52.309c19.05 4.234 32.605 21.13 32.605 40.646M83.5 463.425v-58.45M183.699 542.75V396.625M283.9 1068.8V945.637M83.5 363.225v-141.95M83.5 179.524v-77.237M83.5 60.537V0M384.1 630.425V277.637M484.301 830.824V594.937M584.5 1068.8V663.825M484.301 555.275V452.988M584.5 622.075V452.988M384.1 728.537v-56.362M384.1 1068.8v-20.88M384.1 1006.17V770.287M283.9 903.888V759.85M183.699 1066.71V891.362M83.5 1068.8V716.012M83.5 674.263V505.175"
                                    stroke="#334155"></path>
                                <circle cx="83.5" cy="384.1" r="10.438"
                                    transform="rotate(-180 83.5 384.1)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="83.5" cy="200.399" r="10.438"
                                    transform="rotate(-180 83.5 200.399)" stroke="#334155"></circle>
                                <circle cx="83.5" cy="81.412" r="10.438"
                                    transform="rotate(-180 83.5 81.412)" stroke="#334155"></circle>
                                <circle cx="183.699" cy="375.75" r="10.438"
                                    transform="rotate(-180 183.699 375.75)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="183.699" cy="563.625" r="10.438"
                                    transform="rotate(-180 183.699 563.625)" fill="#1E293B" stroke="#334155">
                                </circle>
                                <circle cx="384.1" cy="651.3" r="10.438"
                                    transform="rotate(-180 384.1 651.3)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="484.301" cy="574.062" r="10.438"
                                    transform="rotate(-180 484.301 574.062)" fill="#0EA5E9" fill-opacity=".42"
                                    stroke="#0EA5E9"></circle>
                                <circle cx="384.1" cy="749.412" r="10.438"
                                    transform="rotate(-180 384.1 749.412)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="384.1" cy="1027.05" r="10.438"
                                    transform="rotate(-180 384.1 1027.05)" stroke="#334155"></circle>
                                <circle cx="283.9" cy="924.763" r="10.438"
                                    transform="rotate(-180 283.9 924.763)" stroke="#334155"></circle>
                                <circle cx="183.699" cy="870.487" r="10.438"
                                    transform="rotate(-180 183.699 870.487)" stroke="#334155"></circle>
                                <circle cx="283.9" cy="738.975" r="10.438"
                                    transform="rotate(-180 283.9 738.975)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="83.5" cy="695.138" r="10.438"
                                    transform="rotate(-180 83.5 695.138)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="83.5" cy="484.3" r="10.438"
                                    transform="rotate(-180 83.5 484.3)" fill="#0EA5E9" fill-opacity=".42"
                                    stroke="#0EA5E9"></circle>
                                <circle cx="484.301" cy="432.112" r="10.438"
                                    transform="rotate(-180 484.301 432.112)" fill="#1E293B" stroke="#334155">
                                </circle>
                                <circle cx="584.5" cy="432.112" r="10.438"
                                    transform="rotate(-180 584.5 432.112)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="584.5" cy="642.95" r="10.438"
                                    transform="rotate(-180 584.5 642.95)" fill="#1E293B" stroke="#334155"></circle>
                                <circle cx="484.301" cy="851.699" r="10.438"
                                    transform="rotate(-180 484.301 851.699)" stroke="#334155"></circle>
                                <circle cx="384.1" cy="256.763" r="10.438"
                                    transform="rotate(-180 384.1 256.763)" stroke="#334155"></circle>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-content-container dark:bg-[#10172a]">
            <div class="post-content dark:text-gray-300" id="page_brak_post_content">
                <render-mark-down-contents contents="{{ $doc->contents }}" doc_id="{{ $doc->id }}" />
            </div>
        </div>
    </div>

    <section class="comments dark:bg-[#10172a]">
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
                    <div class="mb-5">
                        <h2 class="font-calistoga tracking-wide dark:text-[#E8E8ED]">Share your comments</h2>
                    </div>
                    {{-- Add comment --}}
                    <add-comments avatar="{{ authUser()->avatar }}" doc="{{ $doc->id }}" />
                @else
                    <div class="mb-5">
                        <h2 class="font-calistoga tracking-wide dark:text-[#E8E8ED]">Sign In to share <br> your comments</h2>
                    </div>
                    <div>
                        <a href="{{ route('init.oauth', ['google']) }}" class="text-white font-calistoga bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                            <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                            <span class="mt-1 font-calistoga" style="font-size: 16px">Sign in with Google</span>
                        </a>
                        <a href="{{ route('init.oauth', ['github']) }}" class="text-white font-calistoga bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                            <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                            <span class="mt-1 font-calistoga" style="font-size: 16px">Sign in with Github</span>
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

    <div><newsletter-card /></div>

    <div><card-slider story_id="{{ $doc->id }}" /></div>
@endsection
