<!-- PROFILE FEATURE -->

<section class="profile-feature">
  <div class="awe-parallax bg-profile-feature"></div>
  <div class="awe-overlay overlay-color-3"></div>
  <div class="container">
    <div class="info-author margin-top2">


          </div>

  </div>
</section>

<!-- END / CONTENT BAR -->


<!-- COURSE CONCERN -->
<section id="course-concern" class="course-concern">
  <div class="container">

    <div class="message-body background-none">
      <div class="row">
        <div class="col-md-4 left-menu">



        </div>

        <div class="col-md-8 background-white">
          <div class="message-ct">
            <div class="author">


              <div class="col-md-12">
                <div class="mc-section-1-content-1">
                  <?php echo $this->session->flashdata('message');  ?>
                  <form method="post" id="myForm" action="<?php echo base_url('index.php/forgot_password/forget_password_action');?>"  enctype="multipart/form-data">
                    <h2 class="hesd-text"><i class="fa fa-user color-sky"></i>Forget Password </h2>
                    <input type="text" name="student_email" >

                </div>

                <input type="submit" value="Upload" id="btnChangePass" class="mc-btn-4 btn-style-1">
              </div>
            </div>

          </div>




        </div>
      </div>
    </div>
  </div>
  </div>
</section>
</form>

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  