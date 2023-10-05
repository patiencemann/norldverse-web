
{{-- <div> @if (Auth::check() && !hasWritterRequest()) <become-writter /> @endif </div> --}}
<div><navbar-component /></div>

<header class="site-header border border-x-0 border-t-0 border-gray-200" style="background-image: url('/img/knowledge-bro.svg')">
    <div class="container">
        <div style="border: 1px solid #ececed" class="header-inner flex justify-space-between dark:bg-deep-green-800 dark:border-none">
            {{-- <div class="flex items-center">
                <x-navbar.mobile-navbar />
            </div> --}}

            {{-- Search bar --}}
            <div><search-bar /></div>

            {{-- Large screen navbar --}}
            <x-navbar.large-navbar />

        </div>
    </div>
    <profile-card user="{{ json_encode(authUser()) }}" />
</header>
