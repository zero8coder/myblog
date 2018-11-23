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

                @foreach ($categoryMenus as $categoryMenu)
                    <li class="{{
                        active_class(
                            (if_route('categories.index')          && if_route_param('category', $categoryMenu->id)) ||
                            (if_route('articles.show')             && if_route_param('category', $categoryMenu->id)) ||
                            (if_route('articles.showWithCategory') && if_route_param('category', $categoryMenu->id))
                        )
                    }}">
                        <a href="{{ route('categories.index', $categoryMenu->id) }}">{{ $categoryMenu->name }}</a>
                    </li>
               @endforeach

            </ul>
    </div>
</nav>