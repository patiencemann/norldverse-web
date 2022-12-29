@extends('layouts.guest')

@section('title') Home @stop

@section('content')
    <x-navigation-bar />

    <div class="page-wrap">
        <div class="section wf-section">
            <div class="container">
                <div class="grid post-cms">
                    <a id="w-node-f57e326d-a19c-7eee-2611-0c96c7b2fe67-91ad0a2d" href="/author/esther-howard"
                        class="author-item margin-24 w-inline-block">
                        <img src="{{ $doc->user->avatar }}" loading="lazy" alt="{{ $doc->user->name }}" class="author-avatar" />
                        <div>{{ $doc->user->name }}</div>
                    </a>
                    <div id="w-node-_505d2201-f684-2352-90d4-5418fdd4cf84-91ad0a2d"
                        class="column-xlarge text-align-center margin-24">
                        <h1 class="heading-large">
                            {{ $doc->title }}
                        </h1>
                    </div>
                    <div id="w-node-_2c15b86e-7e80-ed9f-b1a9-301760069107-91ad0a2d"
                        class="post-item-data text-align-center margin-80">
                        <div class="post-item-date">
                            <div class="text-size-xsmall text-color-primary-2 text-style-allcaps">
                                {{ $doc->created_at->diffForHumans() }} ,
                            </div>
                        </div>
                        <div class="text-size-xsmall text-color-primary-2 text-style-allcaps">
                            <read-time text="{{ $doc->contents }}" />
                        </div>
                    </div>
                    <div id="w-node-c930898f-48f9-5bdc-ba0a-ec34c5dbc399-91ad0a2d" class="column-2xlarge">
                        <div id="w-node-f70628f9-6789-54b4-d320-8d24eaa0f0c3-91ad0a2d" class="rich-text w-richtext">
                            {!! $doc->contents !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
