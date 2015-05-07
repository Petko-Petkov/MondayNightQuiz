<div class="modal-dialog">
    <div class="modal-content">
        <form class="form-horizontal" role="form" method="POST">
            <div class="modal-header">
                <h4>Login</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="user-name-login" class="col-lg-2">Username:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="username" id="user-name-login" placeholder="Username"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user-password-login" class="col-lg-2">Password:</label>

                    <div class="col-lg-10">
                        <input type="password" class="form-control" name="password" id="user-password-login"
                               placeholder="Password"/>
                    </div>
                </div>
                <div class="checkbox" id="sign-in-control">
                    <label class="col-lg-2">
                        <input type="checkbox" id="remember-me"/> Remember me
                    </label>
                    <input type="submit" value="Login" class="btn btn-danger pull-right" id="sign-in-btn"/>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo DX_ROOT_LIBS . 'user/register'?>" class="btn btn-warning" data-toggle="modal"> Register</a>
            </div>
        </form>
    </div>
</div>