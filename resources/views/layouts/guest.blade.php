<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Manirabona Patience" />

    <meta name="description" content="" />
    <meta name="rating" content="adult" />
    <meta name="rating" content="RTA-5042-1996-1400-1577-RTA" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="https://tuk-cdn.s3.amazonaws.com/can-uploader/footer_5_marketing_svg1.svg">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Patienceman - Docs - @yield('title')</title>

    {{-- Extenral dynamics links --}}
    <link href="/css/app.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Telugu:wght@300;400;500;700&display=swap" rel="stylesheet">

    {{-- Custom style links --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">

    @yield('style')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nnlpesm8jfglmqbkm0xy1bh0p3pzhfpslfkjyt978k8whp6l/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#tinymce',
            height: 700,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
</body>
</html>
