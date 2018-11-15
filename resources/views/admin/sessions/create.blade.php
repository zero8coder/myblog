<!DOCTYPE html>
<html lang="en">
<head>
    <title>登录</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app" class="admin-{{ route_class() }}-page">
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>登录</h5>
                    </div>
                    <div class="panel-body">

                        <form method="POST" action="">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">邮箱：</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">密码:</label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                            </div>

                            <div class="form-group">
                                <label><input type="checkbox" name="remember">记住我</label>
                            </div>

                            <button type="submit" class="btn btn-primary">登录</button>
                        </form>

                        <hr>

                    </div>
               </div>
           </div>
        </div>
    </div>
</body>
</html>