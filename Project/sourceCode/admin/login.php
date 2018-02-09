<?php
    require_once '../core/init.php';
    /**
     * checj if User SEsssion is active
     * if Yes allow to view this page
     * Else redirect to auth
     */
    if($helper->isLoggedIn() == true)
    {
        $helper->redirect('../admin/');
    }
    /**
     * include the header file
     * that contain all <head> elements
     */
    require '../includes/header.php';

    ?>

<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Sign In</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
            <form id="loginform" class="form-horizontal" role="form" data-parsley-validate="">
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="email" class="form-control" name="email"  placeholder="email"
                        data-parsley-required-message="your email is required"
                        data-parsley-trigger="change focusout"
                        data-parsley-type="email"
                        data-parsley-minlength="3" required autofocus>
                </div>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password"
                        data-parsley-required-message="a password is required"
                        data-parsley-trigger="change focusout"
                        data-parsley-minlength="6" required>
                </div>
                <div class="form-group">
                    <?php $csrf->echoInputField() ?>
                </div>
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                        <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                        </label>
                    </div>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->
                    <div class="col-sm-12 controls">
                        <button id="btn-login" type="button" class="btn btn-success">Login  </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account!
                            <a href="auth.php">
                            Sign Up Here
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    /**
     * include the footer file
     * that contain all <script> elements
     */
    require '../includes/footer.php';
    ?>