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
                    }
					
					 $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);
						 //print_r($pro_img);
					}
                 ?>
               <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>"></div>    
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
                    <a href="<?php echo base_url('home/st_chg_pwd');?>">
                        <i class="fa fa-key"></i>
                        Change Password
                    </a>
                </li>
                 <li>
                     <a href="<?php echo base_url('home/change_profile_pic') ?>">
                         <i class="fa fa-bar-chart"></i>
                         Change Profile Pic
                     </a>
                 </li>
                <li>
                    <a href="<?php echo base_url('home/fee_structure');?>">
                        <i class="fa fa-credit-card"></i>
                        Fees Payment / Due
                    </a>
                </li>
                <li class="active1">
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
                        
                            <div class="col-md-12">
                                <div class="mc-section-1-content-1">
                                    <form method="post" action="<?php echo base_url('index.php/home/insert_student_data');?>" enctype="multipart/form-data">
                                        <h2 class="hesd-text"><i class="fa fa-book color-sky"></i> Result</h2>


                                        <div class="clear"></div>

                                        <div class="table-asignment">
                                            <div class="nav-tabs-wrap">
                                                <ul class="nav-tabs" role="tablist">
                                                    <li class="active"><a href="#mysubmissions" role="tab" data-toggle="tab"> 8th Class</a></li>
                                                    <li><a href="#studentssubmissions" role="tab" data-toggle="tab"> 9th Class</a></li>
                                                    <li><a href="#address" role="tab" data-toggle="tab">10th Class</a></li>
                                                    <li><a href="#studentrecord" role="tab" data-toggle="tab"> 11th Class</a></li>
                                                    <li><a href="#class" role="tab" data-toggle="tab"> 12th Class</a></li>
                                                    <li class="tabs-hr" style="left: 0px; width: 113px;"></li>
                                                </ul>
                                            </div>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <!-- MY SUBMISSIONS -->
                                                <div class="tab-pane fade in active" id="mysubmissions">
                                                  
                                                    <div class="tab-content">
                                                        <h2></h2>
                                                        <div class="tab-content-box">&nbsp</div>
                                                    </div>  
                                                    
                                                </div>
                                                <!-- END / MY SUBMISSIONS -->

                                                <div class="tab-pane fade" id="studentssubmissions">
                                                    
                                                   <div class="tab-content">
                                                        <h2></h2>
                                                        <div class="tab-content-box">&nbsp</div>
                                                    </div>  

                                                </div>

                                                <!-- END / MY SUBMISSIONS -->

                                                <div class="tab-pane fade" id="address">
                                                
                                                    <div class="tab-content">
                                                        <h2></h2>
                                                        <div class="tab-content-box">&nbsp</div>
                                                    </div> 

                                                </div>

                                                <!-- MY SUBMISSIONS -->

                                                <div class="tab-pane fade" id="studentrecord">
                                                    
                                                    <div class="tab-content">
                                                        <h2></h2>
                                                        <div class="tab-content-box">&nbsp</div>
                                                    </div> 

                                                </div>



                                                <div class="tab-pane fade" id="class">
                                                   
                                                   <div class="tab-content">
                                                        <h2></h2>
                                                        <div class="tab-content-box">&nbsp</div>
                                                   </div>

                                                </div>

                                        </div>
                                        <div class="clear"></div>
                                </div>
                                <!--  <input type="submit" value="Cancel" class="mc-btn-4 btn-style-1"> -->

                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->