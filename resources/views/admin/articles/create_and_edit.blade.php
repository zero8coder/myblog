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
                    <label for="order">排序:</label>
                    <input type="text" name="order" class="form-control" value="{{ old('order', $article->order) }}">
                </div>

                <div class="form-group">
                    <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" >{{old('body', $article->body)}}</textarea>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <!-- 高亮css -->
    <link href="https://cdn.bootcss.com/highlight.js/9.15.6/styles/a11y-dark.min.css" rel="stylesheet">

@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="{{ asset('js/inline-attachment.js') }}"></script>
    <script src="{{ asset('js/codemirror-4.inline-attachment.js') }}"></script>

    <!-- 高亮代码 -->
    <script src="https://cdn.bootcss.com/highlight.js/9.15.6/highlight.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({
            element: $("#editor")[0],

            renderingConfig: {
                // 设置 highlight.js 生效
                codeSyntaxHighlighting: true
            },
            // 快捷键
            shortcuts: {
                "togglePreview": "F9", // alter the shortcut for toggleOrderedList
            }

        });

        inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
            uploadUrl: '{{ route("admin.articles.upload_image") }}',
            uploadFieldName: "image",
            //urlText: "\n ![file]({filename})\n\n",
            extraParams: {
                '_token': '{{ csrf_token() }}',
            },
            onFileUploadResponse: function (xhr) {
                var result = JSON.parse(xhr.responseText),
                    filename = result[this.settings.jsonFieldName];

                if (result && filename) {
                    var newValue;
                    if (typeof this.settings.urlText === 'function') {
                        newValue = this.settings.urlText.call(this, filename, result);
                    } else {
                        newValue = this.settings.urlText.replace(this.filenameTag, filename);
                    }
                    var text = this.editor.getValue().replace(this.lastValue, newValue);
                    this.editor.setValue(text);
                    this.settings.onFileUploaded.call(this, filename);
                }
                return false;
            }
        });
    </script>



@stop