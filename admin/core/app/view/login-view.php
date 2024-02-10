<div class="login-box">
    <div class="login-logo">
        <a href="./"><b>Administrador</b></a>
    </div>
    <div class="login-box-body">
        <form action="./?action=processlogin" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" required class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
                </div>
            </div>
        </form>
    </div>
</div>
