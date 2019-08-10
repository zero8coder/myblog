
    @foreach ($replies as $key => $reply)
            <div class="panel panel-default" id="reply">
                <div class="panel-heading">
                    {{ $reply->nickname}}
                    <span class="reply-time">{{ $reply->created_at->diffForHumans() }}</span>
                    <span class="reply-num">{{ $key+1+$replies_num }}楼</span>
                </div>

                <div class="panel-body">
                    {{ $reply->content }}
                </div>
            </div>
    @endforeach

    <div class="text-center" style="height: 40px">
        {!! $replies->render() !!}
    </div>