@extends('layouts.app')

@section('meta-data')
    <meta data-rh="true" name="theme-color" content="#000000">

    <meta data-rh="true" name="googlebot" content="noodp" />
    <meta data-rh="true" name="copyright" content="Manirabona Patience" />
    <meta data-rh="true" name="author" content="Manirabona Patience" />
    <meta data-rh="true" name="news_keywords"
        content="manirabona, patience, manirabona patience, norldverse, personal blog, blogs, docs, patienceman">
    <link data-rh="true" rel="author" href="https://twitter.com/manirabonaW">
    <meta data-rh="true" name="referrer" content="unsafe-url">

    <meta data-rh="true" name="title" content="norldverse">
    <meta data-rh="true" name="description"
        content="Norldverse: online website where you can find dynamic thinking, experiences, or creative work including technology, tips, personal development, and much more.">
    <meta data-rh="true" name="keywords"
        content="manirabona, patience, manirabona patience, norldverse, personal blog, blogs, docs, Norldverse blogs, blogs" />
    <meta data-rh="true" property="article:published_time" content="May 01 2023">
    <meta data-rh="true" property="article:author" content="{{ env('APP_URL') }}">
    <meta data-rh="true" name="robots" content="index,follow,max-image-preview:large">

    <link data-rh="true" rel="canonical" href="{{ env('APP_URL') }}">
    <link rel="alternate" type="application/rss+xml" title="Norldverse - blogs &raquo; Feed"
        href="{{ env('APP_URL') . '/feed.xml' }}" />

    {{-- Twitter tags --}}
    <meta data-rh="true" name="twitter:image:src" content="/img/logos/logo-black.png">
    <meta data-rh="true" name="twitter:card"
        content="Norldverse: an online platform where you can find dynamic thinking, experiences, or creative work and share your thoughts with an audience, including technology, tips, personal development, and much more.">
    <meta data-rh="true" name="twitter:creator" content="Manirabona Patience">
    <meta data-rh="true" name="twitter:label1" content="Reading time">
    <meta data-rh="true" name="twitter:data1" content="10 min read">
    <meta data-rh="true" name="twitter:tile:template:testing" content="2">
    <meta data-rh="true" name="twitter:tile:image" content="/img/logos/logo-black.png">
    <meta data-rh="true" name="twitter:tile:info1:icon" content="Person">
    <meta data-rh="true" name="twitter:tile:info1:text" content="Manirabona Patience">
    <meta data-rh="true" name="twitter:tile:info2:icon" content="Calendar">
    <meta data-rh="true" name="twitter:tile:info2:text" content="May 01 2023">
    <meta data-rh="true" name="twitter:cta" content="Visit Norldverse">
    <meta data-rh="true" property="twitter:title"
        content="Norldverse: an online platform where you can find dynamic thinking, experiences, or creative work and share your thoughts with an audience, including technology, tips, personal development, and much more.">
    <meta data-rh="true" property="twitter:description"
        content="Norldverse: an online platform where you can find dynamic thinking, experiences, or creative work and share your thoughts with an audience, including technology, tips, personal development, and much more.">

    {{-- Facebook tags --}}
    <meta data-rh="true" property="og:type" content="article">
    <meta data-rh="true" property="og:site_name" content="norldverse.patienceman.com">
    <meta data-rh="true" property="og:title" content="norldverse">
    <meta data-rh="true" property="og:description"
        content="Norldverse: an online platform where you can find dynamic thinking, experiences, or creative work and share your thoughts with an audience, including technology, tips, personal development, and much more.">
    <meta data-rh="true" property="og:image" content="/img/logos/logo-black.png">
    <meta data-rh="true" property="og:url" content="{{ env('APP_URL') }}">

    <link rel="stylesheet" href="/css/temp.css">
@stop

@section('title')
    Home
@stop

@section('content')
    <x-navigation-bar />

    <main>
        <div class="loop-section global-padding dark:bg-deep-green-800">
            <div> <global-tags /> </div>
            <div class="px-4"> <title-section /> </div>
            <div class="px-4"> <public-cards auth="{{ Auth::check() }}" /> </div>
        </div>
    </main>

    <x-footer />
@stop
