<!DOCTYPE html>
<html lang="en">

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
    <meta name="theme-color" content="##20acec"> <!-- sesuai header app -->
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
    <!-- Favicon -->

    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset ('font/CS-Interface/style.css')}}" />
    <!-- Font Tags End -->

    <link rel="stylesheet" href="{{asset ('css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/vendor/OverlayScrollbars.min.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset ('css/main.css')}}" />
    <script src="{{asset ('js/base/loader.js')}}"></script>
</head>

<body class="h-100">
    <div id="root" class="h-100">
        <!-- Background Start -->
        <div class="fixed-background"></div>
        <!-- Background End -->

        <div class="container-fluid p-0 h-100 position-relative">
            <div class="row g-0 h-100">
                <!-- Left Side Start -->
                <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100"></div>
                <!-- Left Side End -->

                <!-- Right Side Start -->
                <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
                    <div
                        class="sw-lg-80 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                        <div class="sw-lg-60 px-5">
                            <div class="mb-5">
                                <h2 class="display-2 text-primary">Error 404</h2>
                                <h2 class="cta-1 mb-0">Ooops, sepertinya terjadi kesalahan!</h2>
                            </div>

                            <div class="mb-5">
                                <p class="h6">Maaf halaman yang Anda cari tidak tersedia.</p>
                                <p class="h6">
                                    Jika Anda merasa ini adalah sebuah kesalahan, silakan
                                    <a href="mailto:zaleavera@gmail.com">hubungi kami</a>.
                                </p>
                            </div>

                            <div>
                                <a href="{{route ('home.index')}}" class="btn btn-icon btn-icon-start btn-primary">
                                    <i data-acorn-icon="arrow-left"></i>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side End -->
            </div>
        </div>
    </div>

    <!-- Vendor Scripts Start -->
    <script src="{{asset ('js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset ('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset ('js/vendor/OverlayScrollbars.min.js')}}"></script>
    <script src="{{asset ('js/vendor/autoComplete.min.js')}}"></script>
    <script src="{{asset ('js/vendor/clamp.min.js')}}"></script>

    <script src="{{asset ('icon/acorn-icons.js')}}"></script>
    <script src="{{asset ('icon/acorn-icons-interface.js')}}"></script>

    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="{{asset ('js/base/helpers.js')}}"></script>
    <script src="{{asset ('js/base/globals.js')}}"></script>
    <script src="{{asset ('js/base/nav.js')}}"></script>
    <script src="{{asset ('js/base/search.js')}}"></script>
    <script src="{{asset ('js/base/settings.js')}}"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->

    <script src="{{asset ('js/common.js')}}"></script>
    <script src="{{asset ('js/scripts.js')}}"></script>
    <!-- Page Specific Scripts End -->
</body>

</html>