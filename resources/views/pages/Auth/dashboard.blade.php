@extends('layouts.app')

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


                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 mt-5">
                            <ul class="flex flex-wrap -mb-px text-md font-bold font-anek text-center p-0 m-0" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Published
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                                        Dratfs
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div id="myTabContent">
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <div class="grid grid-cols-2 gap-x-20">
                                        {{-- all delived docs --}}
                                        <admin-cards />
                                    </div>
                                </p>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <div class="grid grid-cols-2 gap-x-20">
                                        {{-- all drafted docs --}}
                                        <admin-drafts />
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
