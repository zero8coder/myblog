@extends('layouts.app')
@section('title')
    @if ($category->id)
        {{ $category->name }}
    @else
        首页
    @endif
@stop

@section('content')
@if (count($articles))
    <div class="col-lg-9 col-md-9 page-list">
        <div class="panel panel-default">
            <div class="panel-body">
                    <ul class="media-list">

                        @foreach ($articles as $article)

                            <li class="media">
                                @if ($category->id)
                                    <a href="{{ route('articles.showWithCategory', [$category->id, $article->id]) }}">
                                @else
                                    <a href="{{ route('articles.show', [$article->id]) }}">
                                @endif
                                    <div class="media-left">{{ $article->title }}</div>
                                    <div class="media-right">{{ $article->created_at->toDateString() }}</div>
                                </a>
                            </li>

                            @if (! $loop->last)
                                <hr>
                            @endif

                        @endforeach

                    </ul>
            </div>
        </div>

        <div class="text-center">
            {!! $articles->render() !!}
        </div>

    </div>
@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

@stop