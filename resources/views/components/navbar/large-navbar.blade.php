<div class="flex items-center">
    @if (!Auth::check())
        <a href="{{ route('get.login') }}" data-tooltip-target="tooltip-login"
            class="hidden sm:inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2 mr-1">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                </path>
            </svg>
        </a>
        <div id="tooltip-login" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
            data-popper-placement="top"
            style="font-size: 15px;position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1186px, -64px);">
            Login to your account
            <div class="tooltip-arrow" data-popper-arrow=""
                style="position: absolute; left: 0px; transform: translate(99px, 0px);"></div>
        </div>
    @endif

    <button id="theme-toggle" onclick="toggleDarkMode()" data-tooltip-target="tooltip-toggle" type="button"
        class="flex mr-4 text-gray-500 dark:bg-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
        <svg id="theme-toggle-dark-icon" class="w-12 h-12 hidden"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-12 h-12">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
        </svg>
        <svg id="theme-toggle-light-icon"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-12 h-12">
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

    @if (Auth::check())

        <!-- Notification menu -->
        <notification-list></notification-list>

        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="ml-3" type="button">
            <div id="tooltip-jese" role="tooltip" style="font-size: 15px;"
                class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                {{ authUser()->name }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <img data-tooltip-target="tooltip-jese"
                class="ring-4 ring-gray-50 dark:ring-gray-500 w-16 h-16 rounded-circle ml-2"
                src="{{ authUser()->avatar }}" alt="{{ authUser()->name }}">
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownAvatar" class="z-10 hidden bg-gray-50 dark:bg-deep-green-900 divide-y w-80 divide-gray-100 rounded-lg shadow dark:divide-gray-600">
            <div class="px-4 py-3 text-md font-anek font-semibold text-gray-500 dark:text-white">
                <div>{{ authUser()->name }}</div>
                <div class="font-medium truncate">{{ authUser()->email }}</div>
            </div>
            <ul class="p-0 m-0 text-md text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                <li class="cursor-pointer">
                    <a href="{{ route('get.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">
                        Stories
                    </a>
                </li>
                <li class="cursor-pointer"><profile-opener /></li>
            </ul>
            <div class="py-2">
                <a href="{{ route('post.logout') }}" class="block px-4 py-2 text-md text-gray-700 hover:bg-red-100 dark:hover:bg-red-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </div>
        </div>
    @endif
</div>
