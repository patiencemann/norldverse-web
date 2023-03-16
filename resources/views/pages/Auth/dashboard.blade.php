@extends('layouts.guest')

@section('title') Home @stop

@section('style')
    <link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('content')
    <x-navigation-bar />

    <div class="relative bg-gray-200 dark:bg-gray-900 overflow-hidden max-h-screen">
        <main class="ml-50 pt-10 max-h-screen overflow-auto">
            <div class="px-6 py-8">
                <div class="w-full mx-auto px-24">
                    <div class="bg-gray-100 rounded-3xl p-8 mb-5 dark:bg-gray-700">
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
