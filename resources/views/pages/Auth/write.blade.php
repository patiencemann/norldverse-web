@extends('layouts.guest')

@section('title') Home @stop

@section('style')
    <link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('content')
    <x-navigation-bar />

    <div class="relative bg-gray-50 overflow-hidden max-h-screen border-t-2">
        <main class="ml-50 pt-10 max-h-screen overflow-auto dark:bg-gray-900">
            <div class="px-6 py-8">
                <div class="w-full mx-auto px-24">
                    <write-doc />
                </div>
            </div>
        </main>
    </div>
@endsection
