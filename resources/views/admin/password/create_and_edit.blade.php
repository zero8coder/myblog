@extends('admin.layouts.default')
@section('title', '修改密码')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="col-md-offset-1 col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
        @include('admin.shared._errors')

            <form action="{{ route('admin.password.update') }}" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">旧密码：</label>
                    <input type="password" name="old_password" class="form-control" value="{{ old('old_password') }}"  required>
                </div>

                <div class="form-group">
                    <label for="name">密码：</label>
                    <input type="password" name="password" class="form-control"  value="{{ old('password') }}" required>
                </div>

                <div class="form-group">
                    <label for="name">确认密码：</label>
                    <input type="password" name="password_confirmation"  class="form-control" value="{{ old('password_confirmation') }}"  required>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>修改密码</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop