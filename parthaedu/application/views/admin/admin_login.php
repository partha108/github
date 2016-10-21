<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Partha | Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/ui.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    </head>
    <body class="account2" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info">
                <h2><strong>ParthaEdu Admin</strong></h2> 
                <h4>WHERE PERSONAL ATTENTION IS CULTURE</h4>
                <ul>
                    <li><i class="icon-magic-wand"></i> Fully customizable</li>
                    <li><i class="icon-layers"></i> Various sibebars look</li>
                    <li><i class="icon-arrow-right"></i> RTL direction support</li>
                    <li><i class="icon-drop"></i> Colors options</li>
                </ul>
            </div>
            <div class="account-form">
                <?php echo form_open("admin/admin/login",array("class"=>"form-signin"));?>
                    <h3><strong>Admin LOG In</strong></h3>
                    <?php echo validation_errors(); 
					if(isset($error)){echo $error;}
					?>
                    <div class="append-icon">
                        <input type="text" name="username" id="name" class="form-control form-white username" placeholder="Username" required>
                        <i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" name="submit" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left">Sign In</button>
                   <!-- <span class="forgot-password"><a id="password" href="account-forgot-password.html">Forgot password?</a></span>-->
                    <!--<div class="form-footer">
                        <div class="social-btn">
                            <button type="button" class="btn-fb btn btn-lg btn-block btn-square"><i class="fa fa-facebook pull-left"></i>Connect with Facebook</button>
                            <button type="button" class="btn btn-lg btn-block btn-blue btn-square"><i class="fa fa-twitter pull-left"></i>Login with Twitter</button>
                        </div>
                        <div class="clearfix">
                            <p class="new-here"><a href="user-signup-v2.html">New here? Sign up</a></p>
                        </div>
                    </div>-->
                <?php echo form_close();?>
                <form class="form-password" role="form">
                    <h3><strong>Reset</strong> your password</h3>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password Reset Link</button>
                    <div class="clearfix m-t-60">
                        <p class="pull-left m-t-20 m-b-0"><a id="login" href="#">Have an account? Sign In</a></p>
                        <p class="pull-right m-t-20 m-b-0"><a href="user-signup2.html">New here? Sign up</a></p>
                    </div>
                </form>
            </div>
            
        </div>
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © 2016 </span><span>PiTechnologies.org</span>.<span>All rights reserved.</span>
        </p>
        <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/gsap/main-gsap.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pages/login-v2.js"></script>
    </body>
</html>