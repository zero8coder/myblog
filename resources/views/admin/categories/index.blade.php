@extends('admin.layouts.default')
@section('title', '分类管理')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>分类</th><th>是否展示</th>
        @foreach ($categories as $category)
            <tr>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id)}}">
                        <input name="" type="button" class="edit-img-btn" />
                    </a>
                    &nbsp;
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <input name="" type="submit" class="del-img-btn"  value=''/>
                    </form>
                </td>
                <td>{{ $category->name }}</td>
                <td>是</td>
            </tr>
        @endforeach
    </table>
</div>
@stop