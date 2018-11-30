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
                    <form id="delForm" action="{{ route('admin.articles.destroy', $article->id) }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <input class="del-img-btn" data-toggle="modal" data-target="#delModel"/>
                    </form>
                </td>
                <td>{{ $article->category->name }}</td>
                <td> <a href="{{ route('admin.articles.edit', $article->id)}}">{{ $article->title }}</a></td>
                 @if ($article->is_show == 1)
                    <td><span class="glyphicon glyphicon-ok" style="color:#66CD00"></span></td>
                @elseif ($article->is_show == 2)
                    <td><span class="glyphicon glyphicon-remove" style="color:red"></span></td>
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

<!-- 删除文章模态框（Modal） -->
<div class="modal fade" id="delModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modalLabel">
                    删除
                </h4>
            </div>
            <div class="modal-body">
                是否删除该文章
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="delArticle()">
                    <span class="glyphicon glyphicon-ok" style="color:#66CD00"></span>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" >
                    <span class="glyphicon glyphicon-remove" style="color:red"></span>
                </button>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
        function delArticle()
        {
            $('#delModel').modal('hide')
            $('#delForm').submit();
        }
    </script>
@stop


