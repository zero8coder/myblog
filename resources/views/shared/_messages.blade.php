@foreach(['danger', 'warning', 'success', 'info'] as $msg)
    @if (session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach