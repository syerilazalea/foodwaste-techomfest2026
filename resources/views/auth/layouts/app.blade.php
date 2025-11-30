<!DOCTYPE html>
<html lang="en">

@include('auth.layouts.head')

@stack('styles')

<body class="h-100">
    <div id="root" class="h-100">

        <!-- Background Start -->
        <div class="fixed-background"></div>
        <!-- Background End -->

        @yield('content')

    </div>

    @include('auth.layouts.script')

    @stack('scripts')

</body>

</html>