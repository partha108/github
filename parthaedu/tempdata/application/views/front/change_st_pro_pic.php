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
                        if(isset($session_data[0]))
                        {
                        	$session_data=$session_data[0];
                            $user_name = $session_data->student_id;
                            $a = $session_data->student_id;
                            $user_fullname = $session_data->first_name.' '. $session_data->last_name; 
                         }
						 
						 $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);
						 //print_r($pro_img);
					}
                 ?>
               <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>" id="header_img">
                </div>    
                <div class="name-author">
                    <h2 class="big">
					<?php 
                    	$user_fullname ='';
                        if($this->session->userdata('partha'))
                        {
                        	$session_data = $this->session->userdata('partha');
                            if(isset($session_data[0]))
                            {
                            	$session_data=$session_data[0];
                                $user_name = $session_data->student_id;
                                $pimg = $session_data->profile_image;
                                $a = $session_data->student_id;
                                $b= $session_data->state;
								$st_mobile_no = $session_data->student_phone_no;
								$first_name = $session_data->first_name;
                                $user_fullname = $session_data->first_name.' '. $session_data->last_name; 
                            }
						}
                        echo $user_fullname;
                    ?>
                    </h2>
                    <input type="hidden" name="sess_student_id" value="<?php echo $a;?>">
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
                <li >
                    <a href="<?php echo base_url('home/st_dashboard');?>">
                        <i class="fa fa-user"></i>
                        User Profile
                    </a>
                </li>
                
                 <li class="active1">
                     <a href="<?php echo base_url('home/change_profile_pic') ?>">
                         <i class="fa fa-bar-chart"></i>
                         Change Profile Pic
                     </a>
                 </li>
                <li>
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

                    <div class="col-md-8 background-white">
                        <div class="message-ct">
                            <div class="author">
                                
                              
                                    <div class="col-md-12">
      <div class="mc-section-1-content-1"> 
       <form method="post" id="myForm" action="<?php echo base_url('index.php/home/student_change_profile_pic');?>"  enctype="multipart/form-data"> 
       <h2 class="hesd-text"><i class="fa fa-user color-sky"></i> Change Profile Pic </h2>
       <input type="hidden" name="student_id" value="<?php echo $a;?>">
      <input type="file" name="profile_pic[]" id="upload">
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
 <script>
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();

             reader.onload = function (e) {
                 $('#header_img').attr('src', e.target.result);
             }

             reader.readAsDataURL(input.files[0]);
         }
     }

     $("#upload").change(function(){
         readURL(this);
     });
 </script>
  