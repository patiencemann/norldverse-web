@extends('layouts.app')

@section('meta-data')
    <!-- Basic Meta Tags -->
    <meta charset='UTF-8'>
    <meta name="description" content="Norldverse: journey through life's diverse experiences and valuable lessons. Follow along as I share captivating travel stories and reflections on personal growth, navigating the highs and lows of everyday existence. Through heartwarming tales, practical wisdom, and thought-provoking stories, this compelling mixture of inspiration and guidance will leave you eager for more. Join me as we explore life's rich tapestry and discover new insights to guide us through its myriad challenges and victories.">
    <meta name="keywords" content="norldverse, norldverse patienceman, blogs, norldverse blogs, manirabona, patience, patienceman, insights, stories, experiences, travel adventures, personal growth, everyday life, anecdotes, practical tips, life's twists and turns">
    <meta name="author" content="Manirabona Patience">
    <meta data-rh="true" name="theme-color" content="#000000">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="norldverse">
    <meta itemprop="description" content="Norldverse: journey through life's diverse experiences and valuable lessons. Follow along as I share captivating travel stories and reflections on personal growth, navigating the highs and lows of everyday existence. Through heartwarming tales, practical wisdom, and thought-provoking stories, this compelling mixture of inspiration and guidance will leave you eager for more. Join me as we explore life's rich tapestry and discover new insights to guide us through its myriad challenges and victories.">
    <meta itemprop="image" content="{{ env('APP_URL') }}/img/logos/logo-black.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="norldverse">
    <meta property="og:description" content="Norldverse: journey through life's diverse experiences and valuable lessons. Follow along as I share captivating travel stories and reflections on personal growth, navigating the highs and lows of everyday existence. Through heartwarming tales, practical wisdom, and thought-provoking stories, this compelling mixture of inspiration and guidance will leave you eager for more. Join me as we explore life's rich tapestry and discover new insights to guide us through its myriad challenges and victories.">
    <meta property="og:image" content="{{ env('APP_URL') }}/img/logos/logo-black.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="norldverse">
    <meta name="twitter:description" content="Norldverse: journey through life's diverse experiences and valuable lessons. Follow along as I share captivating travel stories and reflections on personal growth, navigating the highs and lows of everyday existence. Through heartwarming tales, practical wisdom, and thought-provoking stories, this compelling mixture of inspiration and guidance will leave you eager for more. Join me as we explore life's rich tapestry and discover new insights to guide us through its myriad challenges and victories.">
    <meta name="twitter:image" content="{{ env('APP_URL') }}/img/logos/logo-black.png">

    <!-- Meta Tags Generated via http://heymeta.com -->

    <!-- RSS Feed -->
    <link rel="alternate" type="application/rss+xml" title="Norldverse - blogs &raquo; Feed" href="{{ env('APP_URL') . '/feed.xml' }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="/css/temp.css">
@stop

@section('title')
Life's Diverse Adventures: A Journey Through Growth and Reflection
@stop

@section('content')
    <x-navigation-bar />

    <main>
        <div class="loop-section global-padding dark:bg-deep-green-800">
            <div> <global-tags /> </div>
            <div class="px-4"> <title-section /> </div>
            <div class=""><public-cards auth="{{ Auth::check() }}" /></div>
        </div>
    </main>

    <x-footer />
@stop
