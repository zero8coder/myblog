@extends('admin.layouts.default')
@section('title', '首页')
@section('content')
@include('admin.shared._messages')

<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>分类</th><th>标题</th><th>创建时间</th>
        @foreach ($articles as $article)
            <tr>
                <td>
                    <a href="{{ route('admin.articles.edit', $article->id)}}">
                        <button type="button" class="btn btn-sm btn-success ">修改</button>
                    </a>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger ">删除</button>
                    </form>
                </td>
                <td>{{ $article->category->name }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->created_at->toDateString() }}</td>
            </tr>
        @endforeach
    </table>
    <div class="text-center">
        {!! $articles->render() !!}
    </div>
</div>
@stop