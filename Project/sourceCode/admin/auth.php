<?php
    require_once '../core/init.php';
    if($helper->isLoggedIn() == true)
    {
        $helper->redirect('../admin/');
    }
    require '../includes/header.php';
    ?>

<div id="signupbox" style=" margin-top:50px" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
        </div>
        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" data-parsley-validate="">
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name"
                            data-parsley-required-message="your name is required"
                            data-parsley-trigger="change focusout"
                            data-parsley-required
                            data-parsley-minlength="6" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"
                            data-parsley-required-message="your email is required"
                            data-parsley-trigger="change focusout"
                            data-parsley-type="email"
                            data-parsley-minlength="3" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            data-parsley-required-message="a password is required"
                            data-parsley-trigger="change focusout"
                            data-parsley-minlength="6" required>
                    </div>
                </div>
                <div class="form-group">
                    <?php $csrf->echoInputField() ?>
                </div>
                <div class="form-group">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="button" class="btn btn-success"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                    </div>
                </div>
                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <a id="btn-fbsignup" href="login.php" class="btn btn-primary">   Login</a>
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