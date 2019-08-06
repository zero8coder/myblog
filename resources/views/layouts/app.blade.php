<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="忠的博客，用于记录生活点滴。写一些技术博客和游戏博客，记录自己学到的玩到的，自己喜欢的东西。尽可能地留下自己脚印。人生开心就好。学到老，玩到老，笑到老。哈哈哈哈哈哈哈哈">
        <meta name="keyword" contet="记录生活点滴,忠,laravel博客,php博客,技术博客,个人博客">
        <title>@yield('title', 'myblog') - 记录生活点滴</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body>
        <div id="app" class="{{ route_class() }}-page">

            @include('layouts._header')

            <div class="container">

                @yield('content')

            </div>
            <flash message="{{ session('flash') }}"></flash>
            @include('layouts._footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>