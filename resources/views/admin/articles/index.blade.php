@extends('admin.layouts.default')
@section('title', '文章管理')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>分类</th><th>标题</th><th>是否显示</th><th>排序</th><th>创建时间</th>
        @foreach ($articles as $article)
            <tr>
                <td>
                    <a href="{{ route('admin.articles.edit', $article->id)}}">
                        <input name="" type="button" class="edit-img-btn" />
                    </a>
                    &nbsp;
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <input name="" type="submit" class="del-img-btn"  value=''/>
                    </form>
                </td>
                <td>{{ $article->category->name }}</td>
                <td> <a href="{{ route('admin.articles.edit', $article->id)}}">{{ $article->title }}</a></td>
                 @if ($article->is_show == 1)
                    <td>√</td>
                @elseif ($article->is_show == 2)
                    <td>x</td>
                @endif
                <td>{{ $article->order }}</td>
                <td>{{ $article->created_at->toDateString() }}</td>
            </tr>
        @endforeach
    </table>
</div>
<div class="text-center">
    {!! $articles->render() !!}
</div>
@stop