@extends('admin.layouts.default')
@section('title', '分类管理')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>分类</th><th>是否展示</th><th>排序</th>
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

                @if ($category->is_show == 1)
                    <td>√</td>
                @elseif ($category->is_show == 2)
                    <td>x</td>
                @endif

                <td>{{ $category->order }}</td>


            </tr>
        @endforeach
    </table>
</div>
@stop