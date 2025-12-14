<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content>
    <meta name="keywords" content>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Permissions-Policy" content="clipboard-read=(), clipboard-write=()">
    <title>Econect</title>

    <!-- Favicon -->
    <!-- Di dalam bagian <head> Anda -->
    <link rel="icon" href="{{ asset('logo/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('logo/favicon.svg') }}" type="image/svg+xml">
    <!-- stop Favicon -->

    <!-- Web Application Manifest -->
    <link rel="manifest" href="{{asset ('manifest.json')}}">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="##1ea863"> <!-- sesuai header app -->
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Econect">
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Econect">
    <!-- Tile for Win8 -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset ('logo/favicon-mobile.svg')}}">

    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset ('font/CS-Interface/style.css')}}" />
    <!-- Font Tags End -->

    <link rel="stylesheet" href="{{asset ('css/vendor/glide.core.min.css')}}" />

    <link rel="stylesheet" href="{{asset ('css/vendor/introjs.min.css')}}" />

    <link rel="stylesheet" href="{{asset ('css/vendor/select2.min.css')}}" />

    <link rel="stylesheet" href="{{asset ('css/vendor/select2-bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/vendor/baguetteBox.min.css')}}" />

    <link rel="stylesheet" href="{{asset ('css/vendor/plyr.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/vendor/OverlayScrollbars.min.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/main.css')}}" />
    <script src="{{asset ('js/base/loader.js')}}"></script>

    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <!-- CKEditor5 -->
    <link rel="stylesheet" href="{{ asset('js/ckeditor5/ckeditor5.css') }}">
</head>

<style>
    /* Scroll masih bisa, tapi scrollbar tidak terlihat */
    body::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    body {
        -ms-overflow-style: none;
        /* IE, Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>