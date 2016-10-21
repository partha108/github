<section id="login-content" class="login-content padding-top">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        <?php echo $this->session->flashdata('message');  ?>
                        <form method="post" action="<?php echo base_url('index.php/forgot_password/forget_password_action');?>">
                            <h2 class="text-uppercase">Forgot Password</h2>
                            <div class="form-email">
                                <input type="text" placeholder="Email" name="student_email" id="username">
                                <span id="show_username" style="color:red"></span>
                            </div>
                            
                            
                            <div class="form-submit-1">
                                <input type="submit" value="Submit" class="mc-btn btn-style-1 margin-top" onclick="return login_ckeck_detail();">
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
</form>

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<style>
  .padding-top{ padding-top: 244px !important; }
</style>
  