<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="忠的博客，用于记录生活点滴">
        <meta name="keyword" contet="忠,laravel博客,php博客,技术博客,个人博客">
        <title>@yield('title', 'myblog') - 记录生活点滴</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="{{ route_class() }}-page">

            @include('layouts._header')

            <div class="container">

                @yield('content')

            </div>

            @include('layouts._footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>