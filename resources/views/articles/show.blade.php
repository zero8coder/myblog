@extends('layouts.app')
@section('title', '详情页')
@section('content')
    <div class="col-lg-9 col-md-9 article-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $article->title }}
                </h1>
                <p class="article-time">日期：{{ $article->created_at->toDateString() }}</p>
                <hr>

                <div class="article-body">
                     {!! $article->body !!}
                </div>
            </div>


        </div>
        <div class="article-page">
            <ul class="pager">
                @if ( ! is_null($previousArticleID) )
                    <li class="previous">
                        <a href="{{ route('articles.show', [$previousArticleID]) }}">
                            上一篇
                        </a>
                    </li>
                @endif

                @if ( ! is_null($nextArticleId) )
                    <li class="next">
                        <a href="{{ route('articles.show', [$nextArticleId]) }}">
                            下一篇
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

@stop