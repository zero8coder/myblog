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
                 <!--看板娘-->
                @include('layouts._2dmm')

            </div>


            @include('layouts._footer')
        </div>



        <script src="{{ asset('js/app.js') }}"></script>


    <!--看板娘-->
        <!-- waifu-tips.js 依赖 JQuery 库 -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>

        <!-- 实现拖动效果，需引入 JQuery UI -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>



        <script src="//live2d-cdn.fghrsh.net/assets/1.4.2/waifu-tips.min.js"></script>
        <script src="//live2d-cdn.fghrsh.net/assets/1.4.2/live2d.min.js"></script>
        <script type="text/javascript">
            /* 可直接修改部分参数 */
            live2d_settings['modelId'] = 6;                  // 默认模型 ID
            live2d_settings['modelTexturesId'] = 14;         // 默认材质 ID
            live2d_settings['modelStorage'] = true;         // 不储存模型 ID
            live2d_settings['canCloseLive2d'] = false;       // 隐藏 关闭看板娘 按钮
            live2d_settings['canTurnToHomePage'] = false;    // 隐藏 返回首页 按钮
            live2d_settings['waifuSize'] = '285x235';        // 看板娘大小
            live2d_settings['waifuTipsSize'] = '285x50';    // 提示框大小
            live2d_settings['waifuFontSize'] = '12px';       // 提示框字体
            live2d_settings['waifuToolFont'] = '36px';       // 工具栏字体
            live2d_settings['waifuToolLine'] = '50px';       // 工具栏行高
            live2d_settings['waifuToolTop'] = '-60px';       // 工具栏顶部边距
            live2d_settings['waifuDraggable'] = 'axis-x';    // 拖拽样式
            /* 在 initModel 前添加 */
            initModel("//live2d-cdn.fghrsh.net/assets/1.4.2/waifu-tips.json")
        </script>
    <!--看板娘END-->


        @yield('scripts')
    </body>
</html>