<!DOCTYPE html>
<html lang="en" data-footer="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />


@include('dashboard.layouts.head')

@stack('styles')

<body>
    <div id="root">

        @include('dashboard.layouts.topbar')

        @yield('content')

        @include('dashboard.layouts.toolbar')

        @include('dashboard.layouts.footer')

    </div>

    @include('dashboard.layouts.scripts')

    @stack('scripts')

</body>

</html>