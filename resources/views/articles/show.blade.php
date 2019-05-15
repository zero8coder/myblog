@extends('layouts.app')
@section('title', $article->title)

@section('styles')
    <link href="https://cdn.bootcss.com/highlight.js/9.15.6/styles/a11y-dark.min.css" rel="stylesheet">

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
                        {!! Parsedown::instance()->text($article->body) !!}
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
        <div class="col-xs-3 article-affix">
            <ul class="nav" data-spy="affix" data-offset-top="0" id="toc">

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
        // 文章侧栏导航栏
        var toc = $("#toc")
        $(document).ready(function(){
            $("#content > h2, #content > h3").each(function(i,item){
                var num = i + 1;
                $(item).attr("id", "header_" + num);
                var tagName = $(item).prop("tagName");
                if (i == 0) {
                   // 默认选择第一个
                   toc.append('<li class="active"><a href="#header_'+num+'">' + $("#header_" + num).text() + '</a></li>');
                } else {
                    if  (tagName == "H3") {
                        //  增加下级样式
                        toc.append('<li><a class="subordinate" href="#header_'+num+'">' + $("#header_" + num).text() + '</a></li>');
                    } else {
                        toc.append('<li><a href="#header_'+num+'">' + $("#header_" + num).text() + '</a></li>');
                    }
                }

            })

            // 选中
            $('ul li').click(function(){
                $(this).addClass('active').siblings().removeClass('active');
            })
        });


    </script>

@stop