<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                忠
            </a>

            <ul class="nav navbar-nav">

                <li class="{{
                    active_class(
                        if_route('index') || (if_route('articles.show') && if_route_param('category', ''))
                    )
                }}">
                    <a href="{{ route('index') }}">首页</a>
                </li>

                <li class="{{
                    active_class(
                        (if_route('categories.index')          && if_route_param('category', 1)) ||
                        (if_route('articles.show')             && if_route_param('category', 1)) ||
                        (if_route('articles.showWithCategory') && if_route_param('category', 1))
                    )
                }}">
                    <a href="{{ route('categories.index', 1) }}">PHP</a>
                </li>

                <li class="{{
                    active_class(
                        (if_route('categories.index')          && if_route_param('category', 2)) ||
                        (if_route('articles.show')             && if_route_param('category', 2)) ||
                        (if_route('articles.showWithCategory') && if_route_param('category', 2))
                    )
                }} ">
                    <a href="{{ route('categories.index', 2) }}">BUG</a>
               </li>

                <li class="{{
                    active_class(
                        (if_route('categories.index')          && if_route_param('category', 3)) ||
                        (if_route('articles.show')             && if_route_param('category', 3)) ||
                        (if_route('articles.showWithCategory') && if_route_param('category', 3))
                    )
                }}">
                    <a href="{{ route('categories.index', 3) }}">Game</a>
                </li>

            </ul>
    </div>
</nav>