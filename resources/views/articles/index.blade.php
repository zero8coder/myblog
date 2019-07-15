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
                                    <a href="{{ route('articles.showWithCategory', [$category->slug, $article->id]) }}">
                                @else
                                    <a href="{{ route('articles.show', [$article->id]) }}">
                                @endif
                                    <div class="media-left"><h5>{{ $article->title }}<h5></div>
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

        <div class="text-center" style="height: 40px">
            {!! $articles->render() !!}
        </div>
        @if (count($articles) == 17)
        <div class="text-center">
            <a href="http://www.miitbeian.gov.cn/" target="_blank" style="font-size: 11px; color:#ccc">粤ICP备19001767号</a>
        </div>
        @else
            <div style="position:fixed; bottom:35px; width: 825px; text-align: center">
                <a href="http://www.miitbeian.gov.cn/" target="_blank" style="font-size: 11px; color:#ccc">粤ICP备19001767号</a>
            </div>
        @endif
    </div>
@else
    <div class="empty-block">暂无数据 ~_~ </div>
    <div style="position:fixed; bottom:35px; width: 825px; text-align: center">
        <a href="http://www.miitbeian.gov.cn/" target="_blank" style="font-size: 11px; color:#ccc">粤ICP备19001767号</a>
    </div>

@endif

@stop