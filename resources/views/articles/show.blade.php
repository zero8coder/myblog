@extends('layouts.app')
@section('title', $article->title)

@section('styles')
    <link href="https://cdn.bootcss.com/highlight.js/9.15.6/styles/a11y-dark.min.css" rel="stylesheet">

    <style>
/* Custom Styles */
    ul.nav-tabs{
        width: 140px;
        margin-top: 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
    }
    ul.nav-tabs li{
        margin: 0;
        border-top: 1px solid #ddd;
    }
    ul.nav-tabs li:first-child{
        border-top: none;
    }
    ul.nav-tabs li a{
        margin: 0;
        padding: 8px 16px;
        border-radius: 0;
    }
    ul.nav-tabs li.active a, ul.nav-tabs li.active a:hover{
        color: #fff;
        background: #0088cc;
        border: 1px solid #0088cc;
    }
    ul.nav-tabs li:first-child a{
        border-radius: 4px 4px 0 0;
    }
    ul.nav-tabs li:last-child a{
        border-radius: 0 0 4px 4px;
    }
    ul.nav-tabs.affix{
        top: 30px; /* Set the top position of pinned element */
    }
</style>
@stop

@section('content')
    @if ($article->category->is_show == 1 && $article->is_show == 1)
        <div class="col-lg-9 col-md-9 article-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $article->title }}
                    </h1>
                    <p class="article-time">日期：{{ $article->created_at->toDateString() }}</p>
                    <hr>

                    <div class="article-body" id="content">
                        {!! Parsedown::instance()->setMarkupEscaped(true)->text($article->body) !!}
                    </div>
                </div>
            </div>
            <div class="article-page">
                <ul class="pager">
                    @if ( ! is_null($previousArticleID) )
                        <li class="previous">
                            @if (!isset($category))
                                <a href="{{ route('articles.show', [$previousArticleID]) }}">
                            @else
                                <a href="{{ route('articles.showWithCategory', [$article->category_id, $previousArticleID]) }}">
                            @endif
                                上一篇
                            </a>
                        </li>
                    @endif

                    @if ( ! is_null($nextArticleId) )
                        <li class="next">
                            @if (!isset($category))
                                <a href="{{ route('articles.show', [$nextArticleId]) }}">
                            @else
                                <a href="{{ route('articles.showWithCategory', [$article->category_id, $nextArticleId]) }}">
                            @endif
                                下一篇
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- 目录 -->
        <div class="col-xs-3">
            <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" id="toc">

            </ul>
        </div>
    @else
        无数据
    @endif

@stop

@section('scripts')
    <script src="https://cdn.bootcss.com/highlight.js/9.15.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script type="text/javascript">
        var toc = $("#toc")
        $(document).ready(function(){
           $("#content > h2").each(function(i,item){
                console.log(i)
                console.log(item)
                var num = i + 1;
                $(item).attr("id", "header_" + num);

                if (i == 0) {
                   toc.append('<li class="active"><a href="#header_'+num+'">' + $("#header_" + num).text() + '</a></li>');
                } else {
                    toc.append('<li><a href="#header_'+num+'">' + $("#header_" + num).text() + '</a></li>');
                }

           })
        });
    </script>

    <script>
    $(document).ready(function(){
        $("#toc").affix({
            offset: {
                top: 125
          }
        });
    });
</script>
@stop