@extends('layouts.guest')

@section('meta-data')
    <meta name="description" content="A short for weblog, where i frequently updated web page used for personal commentary or business content. Often interactive and for individual blog posts where readers can leave comments." />
    <meta name="keywords" content="manirabona, patience, manirabona patience, patienceman, personal blog, blogs, docs" />
@stop

@section('title')
    Home
@stop

@section('content')
    <x-navigation-bar />

    <main>
        <div class="loop-section global-padding dark:bg-deep-green-800">
            <div> <global-tags /> </div>
            <div class=""> <title-section /> </div>
            <div class=""> <public-cards auth="{{ Auth::check() }}" /> </div>
        </div>
    </main>
@stop
