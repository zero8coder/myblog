
    @foreach ($replies as $reply)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $reply->nickname}} 回复于
                    {{ $reply->created_at->diffForHumans() }}
                </div>

                <div class="panel-body">
                    {{ $reply->content }}
                </div>
            </div>
    @endforeach

    <div class="text-center" style="height: 40px">
        {!! $replies->render() !!}
    </div>

