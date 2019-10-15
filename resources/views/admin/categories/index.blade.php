@extends('admin.layouts.default')
@section('title', '分类管理')
@section('content')
<br>
@include('admin.shared._messages')
<br>
<div class="panel panel-default">
    <table class="table">
        <th>操作</th><th>分类</th><th>slug</th><th>是否展示</th><th>排序</th>
        @foreach ($categories as $category)
            <tr>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->slug)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    &nbsp;
                    <form id="delForm_{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->slug) }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <span class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#delModel" data-categoryid="{{$category->id}}"></span>
                    </form>
                </td>

                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>

                @if ($category->is_show == 1)
                    <td><span class="glyphicon glyphicon-ok" style="color:#66CD00"></span></td>
                @elseif ($category->is_show == 2)
                    <td><span class="glyphicon glyphicon-remove" style="color:red"></span></td>
                @endif

                <td>{{ $category->order }}</td>


            </tr>
        @endforeach
    </table>
</div>

<!-- 删除分类模态框（Modal） -->
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
                是否删除该分类
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="delCategoryBtn">
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
            var categoryid;
            $('#delModel').on('show.bs.modal', function (e) {
                categoryid = $(e.relatedTarget).data("categoryid");
            });

            $('#delCategoryBtn').on('click', function () {
                $('#delModel').modal('hide')
                var form = '#delForm_' + categoryid;
                $(form).submit();
            });
        });
    </script>
@stop