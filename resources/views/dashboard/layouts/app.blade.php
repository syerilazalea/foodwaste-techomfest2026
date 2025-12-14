<!DOCTYPE html>
<html lang="en" data-color="lime-light" data-footer="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />


@include('dashboard.layouts.head')

@stack('styles')

<body class="d-flex flex-column min-vh-100">
    <div id="root" class="d-flex flex-column flex-grow-1">

        @include('dashboard.layouts.topbar')

        @yield('content')

        @include('dashboard.layouts.toolbar')

        @include('dashboard.layouts.footer')

    </div>

    @php
    $noScripts = $noScripts ?? false;
    @endphp

    @if(!$noScripts)
    @include('dashboard.layouts.scripts')
    @endif

    @stack('scripts')
    @include('dashboard.components.swal-global')

</body>

</html>