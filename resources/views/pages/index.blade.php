@extends('layouts.guest')

@section('title') Home @stop

@section('content')
    <x-navigation-bar />

    <nav class="navbar-expand-lg navbar-dark bg-dark ftco-navbar-light mt-10">
        <div class="container">
            <div class="docs-list">
                <div class="w-dyn-list">

                    {{-- Title section vue components --}}
                    <title-section />

                </div>
                <div class="w-dyn-list">

                    {{-- All delived docs --}}
                    <public-cards />

                    {{-- Add load more button --}}
                </div>
            </div>
        </div>
    </nav>
@stop
