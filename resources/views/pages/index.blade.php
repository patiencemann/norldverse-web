@extends('layouts.guest')

@section('title') Home @stop

@section('content')
    <x-navigation-bar />

    <main>
        <div class="loop-section global-padding">
            <div class="">
                <title-section />
            </div>
            <div class="">
                <public-cards />
            </div>
        </div>
    </main>

    <x-footer />
@stop
