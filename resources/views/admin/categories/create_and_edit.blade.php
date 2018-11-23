@extends('admin.layouts.default')
@section('title', '添加分类')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="col-md-offset-1 col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
        @include('admin.shared._errors')

        @if ($category->id)
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" accept-charset="UTF-8">
            <input type="hidden" name="_method" value="PATCH">
        @else
            <form action="{{ route('admin.categories.store') }}" method="post" accept-charset="UTF-8">
        @endif
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">分类名称：</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

