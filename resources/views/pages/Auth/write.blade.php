@extends('layouts.guest')

@section('title') Home @stop

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <x-navigation-bar />

    <div class="relative bg-gray-200 overflow-hidden max-h-screen">
        <header class="fixed right-0 top-0 left-60 bg-yellow-50 py-3 px-4 h-16">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-between">
                    <div>
                        <button type="button"
                            class="flex items-center focus:outline-none rounded-lg text-gray-600 hover:text-yellow-600 focus:text-yellow-600 font-semibold p-2 border border-transparent hover:border-yellow-300 focus:border-yellow-300 transition">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 text-gray-600 text-xs rounded bg-white transition mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </span>
                            <span class="text-sm">Archive</span>
                        </button>
                    </div>
                    <div class="text-lg font-bold">Today's Plan</div>
                    <div>
                        <button type="button"
                            class="flex items-center focus:outline-none rounded-lg text-gray-600 hover:text-yellow-600 focus:text-yellow-600 font-semibold p-2 border border-transparent hover:border-yellow-300 focus:border-yellow-300 transition">
                            <span class="text-sm">This week</span>
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 text-gray-600 text-xs rounded bg-white transition ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="ml-50 pt-10 max-h-screen overflow-auto">
            <div class="px-6 py-8">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-3xl p-8 mb-5">
                        <h1 class="text-3xl font-bold mb-10">untitled doc</h1>

                        <div class="mb-6 mt-2">
                            <input type="text" id="Title" name="title" placeholder="Your Title..."
                                class="bg-gray-100 border border-none text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-6 mt-3">
                            <input type="text" id="caption" name="caption"
                                placeholder="What are you thinking!?., just caption...."
                                class="block w-full p-4 text-gray-900 rounded-lg border-none border bg-gray-100 sm:text-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-6 mt-3">
                            <textarea id="tinymce" rows="4"
                                class="block p-4 w-full text-md text-gray-900 bg-gray-100 rounded-lg border border-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your full thoughts here..."></textarea>
                        </div>
                        <div class="mt-5 flex justify-between items-center">
                            <button type="button" class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-5 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Publish the doc</button>
                            <x-loader />
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
