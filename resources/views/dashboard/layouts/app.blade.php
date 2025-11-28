@include('dashboard.layouts.header')
@stack('style')

<body>
    <div id="root">

@include('dashboard.layouts.topbar')

@yield('content')

@include('dashboard.layouts.toolbar')

@include('dashboard.layouts.footer')

@include('dashboard.layouts.tail')

@stack('script')

</body>

</html>