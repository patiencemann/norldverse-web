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
                        <h1 class="text-3xl font-bold mb-10">{{ authUser()->name }}'s Documents</h1>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-x-2">
                                <div class="inline-flex rounded-md shadow-sm">
                                    <a href="{{ route('get.writable-doc') }}" aria-current="page" class="py-2 px-4 text-md text-center font-bold text-white bg-gray-700 rounded border border-gray-200 hover:bg-gray-900 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Create new Doc
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr class="my-10">

                        <div class="grid grid-cols-2 gap-x-20">
                            {{-- all delived docs --}}
                            <admin-cards />
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
