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
    @else
        无数据
    @endif

@stop

@section('scripts')
    <script src="https://cdn.bootcss.com/highlight.js/9.15.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@stop