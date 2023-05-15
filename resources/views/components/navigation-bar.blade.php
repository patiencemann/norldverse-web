<div> @if (Auth::check() && !hasWritterRequest()) <become-writter /> @endif </div>
<header class="site-header" style="background-image: url('/img/space-guy.jpg')">
    <div class="container">
        <div class="header-inner flex justify-space-between dark:bg-deep-green-800">
            <div class="flex items-center">

                <x-navbar.mobile-navbar />

                {{-- Large screen Nav-bar --}}
                <div class="flex justify-between items-center">
                    <a href="/" class="flex" data-tooltip-target="tooltip-logo-1">
                        <div class="cursor-pointer w-20">
                            <img src="/img/logos/logo-no-background.svg"
                                alt="patienceman logo">
                        </div>
                        <span class="self-center text-3xl mt-2 font-semibold whitespace-nowrap dark:text-white ml-4"
                            style="font-family: 'Anek Telugu', sans-serif; font-weight: 700; font-size: 3rem">
                            Patienceman
                        </span>
                    </a>
                    <div id="tooltip-logo-1" role="tooltip"
                        class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
                        data-popper-placement="top"
                        style="font-size: 15px; position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1186px, -64px);">
                        Patience Manirabona Logo
                        <div class="tooltip-arrow" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(99px, 0px);"></div>
                    </div>
                </div>
            </div>

            {{-- Large screen navbar --}}
            <x-navbar.large-navbar />

        </div>
    </div>
    <profile-card user="{{ json_encode(authUser()) }}" />
</header>
