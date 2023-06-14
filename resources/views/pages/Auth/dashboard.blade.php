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
                    <div class="bg-gray-50 rounded-3xl p-8 mb-5 dark:bg-gray-700 border border-gray-200">
                        {{-- <h1 class="text-3xl font-bold mb-10">{{ authUser()->name }}'s Documents</h1> --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-x-2">
                                <a href="{{ route('get.writable-doc') }}" class="text-white flex items-center bg-[#1E40AF] hover:bg-[#1E40AF]/75 focus:outline-none focus:ring-4 focus:ring-blue-300 font-bold capitalize rounded-full px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-[#1E40AF] dark:focus:ring-blue-800">
                                    <span class="mr-3 text-md">Write</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </a>
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
                                        Drafts
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
