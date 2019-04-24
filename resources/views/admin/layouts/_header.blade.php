<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
            <!-- Branding Image -->


            <ul class="nav navbar-nav">

                <li>
                    <a href="{{ url('/') }}" target="_blank">忠</a>
                </li>

                <li class="{{
                    active_class(
                        if_route('index') || (if_route('articles.show') && if_route_param('category', ''))
                    )
                }}">
                    <a href="{{ route('index') }}" target="_blank"><span class="glyphicon glyphicon-home"></span></a>
                </li>

              <!--  -->

            </ul>
    </div>
</nav>