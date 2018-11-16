<!DOCTYPE html>
<html lang="en">
<head>
    <title>启动</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @include('admin.shared._errors')

                        <form method="POST" action="{{ route('admin.login') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="email">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="password">
                            </div>

                         {{--    <div class="form-group">
                                <label><input type="checkbox" name="remember">记住我</label>
                            </div> --}}

                            <button type="submit" class="btn btn-primary">GO</button>
                        </form>

                        <hr>

                    </div>
               </div>
           </div>
        </div>
    </div>
</body>
</html>