@extends('admin.layouts.default')
@section('title', '添加文章')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="col-md-offset-1 col-md-10">
    <div class="panel panel-default">
        <div class="panel-body">
        @include('admin.shared._errors')

        @if ($article->id)
            <form action="{{ route('admin.articles.update', $article->id) }}" method="post"accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PATCH">
        @else
            <form action="{{ route('admin.articles.store') }}" method="post" accept-charset="UTF-8">
        @endif

                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">标题：</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}">
                </div>

                <div class="form-group">
                    <label for="title">分类：</label>
                    <select name="category_id"  class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"

                                @if($article->category_id == $category->id)
                                    selected = "selected"
                                @endif>

                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">是否显示：</label>
                    <select name="is_show"  class="form-control" required>
                        <option value="2"
                            @if($article->is_show == 2)
                                selected = "selected"
                            @endif
                        >x</option>

                        <option value="1"
                            @if($article->is_show == 1)
                                selected = "selected"
                            @endif
                        >√</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required>{{ $article->body }}</textarea>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('articles.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}'},
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中, 关闭此页面将取消上传。'
                },
                pasteImage: true,
            });

        });
    </script>
@stop