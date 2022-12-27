@extends('layouts.guest')

@section('title') Home @stop

@section('content')
    <x-navigation-bar />

    <nav class="navbar-expand-lg navbar-dark bg-dark ftco-navbar-light mt-4">
        <div class="container">
            <div class="docs-list">
                <div class="w-dyn-list">
                    <div role="list" class="w-dyn-items">
                        <div role="listitem" class="w-dyn-item">
                            <a href="/post/the-complete-guide-to-finding-your-perfect-tour-agent-match"
                                class="post-item margin-80 w-inline-block">
                                <div class="column-large text-align-center">
                                    <div class="post-item-data featured margin-12">
                                        <div class="post-item-date">
                                            <div id="w-node-_29f45216-5385-d0d7-833b-dd8bd1a47b13-fdadf31b"
                                                class="text-size-xsmall text-color-primary-2 text-style-allcaps">
                                                Mar 31
                                            </div>
                                        </div>
                                        <div id="w-node-_20de0388-c874-0d1d-b43f-a06cf864f8d6-fdadf31b"
                                            class="text-size-xsmall text-color-primary-2 text-style-allcaps">
                                            5 min read {message}
                                        </div>
                                    </div>
                                    <h2 class="heading-medium margin-24">
                                        The Complete Guide to Finding Your Perfect Tour Agent Match
                                    </h2>
                                    <p class="text-size-xlarge">
                                        Faucibus dignissim eget pellentesque aliquam amet. Quis lectus
                                        vestibulum in vulputate dui vitae vel.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-dyn-list">
            
                    {{-- All delived docs --}}
                    <front-docs />

                    {{-- Add load more button --}}
                </div>
            </div>
        </div>
    </nav>
@stop
