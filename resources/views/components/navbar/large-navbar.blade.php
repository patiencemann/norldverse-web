<div class="flex items-center">
    <button id="theme-toggle" onclick="toggleDarkMode()" data-tooltip-target="tooltip-toggle" type="button" class="theme-toggle flex mr-4 text-gray-500 dark:bg-gray-700 dark:text-gray-400 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-full text-sm p-3">
        {{-- <svg id="theme-toggle-dark-icon" class="w-12 h-12 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
        </svg> --}}
        <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
        </svg>
    </button>
    <div id="tooltip-toggle" role="tooltip"
        class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
        data-popper-placement="top"
        style="font-size: 15px;position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1262px, -62px);">
        Toggle dark mode
        <div class="tooltip-arrow" data-popper-arrow=""
            style="position: absolute; left: 0px; transform: translate(69px, 0px);"></div>
    </div>

    @if (!Auth::check())
        <div>
            <a href="{{ route('init.oauth', ['google']) }}" class="text-white font-calistoga bg-[#4285F4]/90 hover:bg-[#4285F4]/80 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 rounded-full text-sm px-4 py-3 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2">
                <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                <span class="mt-1 font-calistoga" style="font-size: 14px">Continue with Google</span>
            </a>
            <a href="{{ route('init.oauth', ['github']) }}" class="text-white font-calistoga bg-[#24292F]/90 hover:bg-[#24292F]/80 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 rounded-full text-sm px-4 py-3 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2">
                <svg class="mr-2 -ml-1 w-8 h-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                <span class="mt-1 font-calistoga" style="font-size: 14px">Continue with Github</span>
            </a>
        </div>
    @endif

    @if (Auth::check())

        <!-- Notification menu -->
        <notification-list></notification-list>

        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="ml-3" type="button">
            <div id="tooltip-jese" role="tooltip" style="font-size: 15px;" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                {{ authUser()->name }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <img data-tooltip-target="tooltip-jese"
                class="ring-4 ring-gray-100 dark:ring-gray-500 w-16 h-16 rounded-circle ml-2"
                src="{{ authUser()->avatar }}" alt="{{ authUser()->name }}">
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownAvatar" class="z-50 hidden bg-gray-50 dark:bg-deep-green-900 divide-y w-96 divide-gray-100 rounded-lg shadow dark:divide-gray-600">
            <div class="px-4 py-3 text-md font-anek font-semibold text-gray-500 dark:text-white">
                <div class="font-calistoga">{{ authUser()->name }}</div>
                <div class="font-medium truncate">{{ authUser()->email }}</div>
            </div>
            <ul class="p-0 m-0 text-md text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                <li class="cursor-pointer">
                    <a href="{{ route('get.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white font-calistoga">
                        Stories
                    </a>
                </li>
                <li class="cursor-pointer"><profile-opener /></li>
            </ul>
            <div class="py-2">
                <a href="{{ route('post.logout') }}" class="block px-4 py-2 text-md text-gray-700 hover:bg-red-100 dark:hover:bg-red-600 dark:text-gray-200 dark:hover:text-white font-calistoga">Sign out</a>
            </div>
        </div>
    @endif
</div>
