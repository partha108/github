 <!-- PROFILE FEATURE -->
    <section class="profile-feature">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="info-author margin-top2">
                <div class="image">
                    <?php
                    $user_fullname ='';

                    if($this->session->userdata('partha'))
                    {
                    $session_data = $this->session->userdata('partha');
                    // print_r($session_data);
                    if(isset($session_data[0]))
                    {
                    $session_data=$session_data[0];
                    $user_name = $session_data->student_id;
                    $pimg = $session_data->profile_image;
                    $a = $session_data->student_id;
					$st_mobile_no = $session_data->student_phone_no;
                    $user_fullname = $session_data->first_name.' '. $session_data->last_name;
                    }}
                    // echo $user_fullname;
					 $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);



                    ?>
                    <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>"alt="">
                </div>    
                <div class="name-author">
                    <h2 class="big"><?php echo $user_fullname;?></h2>
                </div>     
                <div class="address-author">
                    <i class="fa fa-phone"></i>
                    <h3><?php echo $st_mobile_no;?></h3>
                </div>
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
                
             <ul>
                <li>
                    <a href="<?php echo base_url('home/st_dashboard');?>">
                        <i class="fa fa-user"></i>
                        User Profile
                    </a>
                </li>
                
                 <li>
                     <a href="<?php echo base_url('home/student_graph') ?>">
                         <i class="fa fa-bar-chart"></i>
                         Change Profile Pic
                     </a>
                 </li>
                <li class="active1">
                    <a href="<?php echo base_url('home/st_chg_pwd');?>">
                        <i class="fa fa-key"></i>
                        Change Password
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('home/fee_structure');?>">
                        <i class="fa fa-credit-card"></i>
                        Fees Payment / Due
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('home/student_result') ?>">
                        <i class="fa fa-book"></i>
                        Result
                    </a>
                </li>
                 <li>
                     <a href="<?php echo base_url('home/student_att') ?>">
                         <i class="fa fa-flag-o"></i>
                         Attendance Report
                     </a>
                 </li>
                 <li>
                     <a href="<?php echo base_url('home/student_graph') ?>">
                         <i class="fa fa-bar-chart"></i>
                         Performance Graph
                     </a>
                 </li>
            </ul>
                    </div>
					<form method="post" action="<?php echo base_url('index.php/home/student_change_password');?>">
                    <div class="col-md-8 background-white">
                        <div class="message-ct">
                        <h2 class="hesd-text"><i class="fa fa-key color-sky"></i> Change Password</h2>
                            <div class="form-action1">
                            <input type="hidden" name="st_id" value="<?php echo $a; ?>" />
                            <input type="text" placeholder="New Password" id="old" name="old"> 
                              <input type="text" placeholder="New Password" id="pwd" name="pwd"> 
                              <input type="text" placeholder="Conferm Password" id="repwd" name="repwd">  
                             </div>
                            
                            <div class="form-action">
                                <input type="submit" value="Send message" class="send mc-btn-3 btn-style-1" id="btnChangePass">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
    
    <script>
	$("#btnChangePass").click(function(){
		//alert("hii");
    		$.ajax({
        		url: '<?php echo base_url() ?>index.php/changePassword/updatePassword', //This is the current doc
        		type: 'POST',
        		data: $("#myForm").serialize(),
        		success: function(data){
            		$( "#div4" ).html( data );
            			}
            		});    
        		});
</script>
