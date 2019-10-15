@extends('admin.layouts.default')
@section('title', '文章评论管理')
@section('content')
<br>
<h4>《{{ $article->title }}》文章评论</h4>
@include('admin.shared._messages')
<br>

<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>昵称</th><th>email</th><th>内容</th><th>创建时间</th>
        @foreach ($replies as $reply)
            <tr>
                <td>
                    <form id="delForm_{{ $reply->id }}" action="{{ route('admin.replies.destroy', $reply->id) }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <span class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#delModel" data-replyid="{{$reply->id}}"></span>
                    </form>
                </td>
                <td>{{ $reply->nickname }}</td>
                <td>{{ $reply->email }}</td>
                <td>{{ $reply->content }}</td>
                <td>{{ $reply->created_at->toDateString() }}</td>
            </tr>
        @endforeach
    </table>
</div>

<div class="text-center">
    {!! $replies->render() !!}
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
                是否删除该评论
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="delRelpyBtn">
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
        $(function() {
            // 删除文章提示框
            var replyid;
            $('#delModel').on('show.bs.modal', function (e) {
                replyid = $(e.relatedTarget).data("replyid");
            });

            $('#delRelpyBtn').on('click', function () {
                $('#delModel').modal('hide')
                var form = '#delForm_' + replyid;
                $(form).submit();
            });


        });
    </script>
@stop