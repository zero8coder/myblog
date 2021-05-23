<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
            <!-- Branding Image -->


            <ul class="nav navbar-nav">

                <li>
                    <a href="{{ url('/') }}" target="_blank">{{ env('APP_NAME') }}</a>
                </li>

                <li>
                    <a href="{{ route('index') }}" target="_blank"><span class="glyphicon glyphicon-home"></span></a>
                </li>

                <li>
                    <a id="logout" data-toggle="modal" data-target="#logoutModel" href="javascript:;"><span class="glyphicon glyphicon-log-out"></span></a>
                </li>
              <!--  -->

            </ul>
    </div>
</nav>

<!-- 退出登录模态框（Modal） -->
<div class="modal fade" id="logoutModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modalLabel">
                    退出
                </h4>
            </div>
            <div class="modal-body">
                是否退出该账号
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="logoutBtn">
                    <span class="glyphicon glyphicon-ok" style="color:#66CD00"></span>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" >
                    <span class="glyphicon glyphicon-remove" style="color:red"></span>
                </button>
            </div>
        </div>
    </div>
</div>