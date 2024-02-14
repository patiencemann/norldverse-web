<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') | Norldverse</title>

    <meta name="rating" content="adult" />
    <meta name="rating" content="RTA-5042-1996-1400-1577-RTA" />

    @if (Auth::check()) <meta name="user" content="{{ Auth::user() }}"> @endif

    @yield('meta-data')

    <link rel="icon" type="image/x-icon" href="/img/logos/logo-black.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">

    {{-- Anek Terugo Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Telugu:wght@300;400;500;700&display=swap" rel="stylesheet">

    {{-- Plus Jakarta Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Custom style links --}}
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/neon.css">
    <link rel="stylesheet" href="/css/bash.css">
    <link rel="stylesheet" href="/css/section.css">
    <link rel="stylesheet" href="/css/preloader.css">

    @yield('style')

     <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-BHRK59S1F7"></script>
     <script>
         window.dataLayer = window.dataLayer || [];

         function gtag() {
             dataLayer.push(arguments);
         }
         gtag('js', new Date());

         gtag('config', 'G-BHRK59S1F7');
     </script>

     <!-- Google Tag Manager -->
     <script>
         (function(w, d, s, l, i) {
             w[l] = w[l] || [];
             w[l].push({
                 'gtm.start': new Date().getTime(),
                 event: 'gtm.js'
             });
             var f = d.getElementsByTagName(s)[0],
                 j = d.createElement(s),
                 dl = l != 'dataLayer' ? '&l=' + l : '';
             j.async = true;
             j.src =
                 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
             f.parentNode.insertBefore(j, f);
         })(window, document, 'script', 'dataLayer', 'GTM-N96KD8Q');
     </script>
     <!-- End Google Tag Manager -->

    {{-- Dark theme switche --}}
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="dark:bg-deep-green-800">
    <div id="app">

        <!-- preloader
        ================================================== -->
        <div id="preloader">
            <div id="loader" class="dots-fade">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N96KD8Q"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->

        @yield('content')
    </div>

    <script src="/js/preloader.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nnlpesm8jfglmqbkm0xy1bh0p3pzhfpslfkjyt978k8whp6l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- Dark theme handler --}}
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        function toggleTheme() {
            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark') {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        toggleTheme();

        function toggleDarkMode() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

            window.location.reload();
        }
    </script>
</body>
</html>
