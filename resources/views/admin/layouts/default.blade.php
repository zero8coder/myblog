<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', '后台')</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('styles')
</head>
<body>
    <div class="{{ route_class() }}-page">
        @include('admin.layouts._header')
        @include('admin.layouts._leftnav')
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
               @yield('content')
           </div>

        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

    <script>
        $(function() {
            $('#logoutBtn').on('click', function () {
                window.location.href="{{ route('logout') }}";
            });
        });
    </script>
</body>
</html>