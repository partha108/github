<!-- LOGIN -->
<script type="text/javascript">
    function login_ckeck_detail()
    {
        /*var a = document.getElementById('username').value;
        alert(a);*/

        if($.trim($("#username").val())=="")
        {   
        $("#show_username").text('Please enter Username');
        $("#show_username").show();
        $("#first_name").focus();
        return false;
        }
        else
        {
        $("#show_username").text('');
        $("#show_username").hide();
        }
        if($.trim($("#password").val())=="")
        {   
        $("#show_password").text('Please enter Password');
        $("#show_password").show();
        $("#password").focus();
        return false;
        }
        else
        {
        $("#show_password").text('');
        $("#show_password").hide();
        }
    }
</script>
<section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        <form method="post" action="<?php echo base_url('index.php/home/user_login');?>">
                            <h2 class="text-uppercase">sign in</h2>
                            <div class="form-email">
                                <input type="text" placeholder="Username" name="username" id="username">
                                <span id="show_username" style="color:red"></span>
                            </div>
                            <div class="form-password">
                                <input type="password" placeholder="Password" name="password" id="password">
                                <span id="show_password" style="color:red"></span>
                            </div>
                             <div class="form-check">
                                <a href="<?php echo base_url('index.php/forgot_password');?>" id="click">Forget password?</a></div>
                            <div class="form-submit-1">
                                <input type="submit" value="Sign In" class="mc-btn btn-style-1 margin-top" onclick="return login_ckeck_detail();">
                            </div>
                            <div class="link">
                                <a href="<?php echo base_url('index.php/home/sign_up');?>">
                                    <i class="icon md-arrow-right"></i>Don’t have account yet ? Join Us
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END / FORM -->
    
                <div class="image">
                    <img src="<?php echo base_url();?>frontend_assest/images/homeslider/img-thumb.png" alt="">
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / LOGIN -->
    