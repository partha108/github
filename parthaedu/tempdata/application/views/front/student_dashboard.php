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
                                $st_mobile_no = $session_data->student_phone_no;
                             }
                              $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);
                        }
                    ?>
                        <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>">
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
								$first_name = $session_data->first_name;
                                $user_fullname = $session_data->first_name.' '. $session_data->last_name; 
                            }
                            $st_details = $this->common_model->edit_subject_payment_details_model('tbl_student','student_id',$a);
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
                            <li class="active1">
                                <a href="<?php echo base_url('home/st_dashboard');?>">
                                    <i class="fa fa-user"></i>
                                    User Profile
                                </a>
                            </li>
                            <li>
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
                                        <form method="post" action="<?php echo base_url('index.php/home/edit_student_data');?>" enctype="multipart/form-data">
                                            <input type="hidden" name="student_id" value="<?php echo $session_data->student_id;?>">
                                            <h2 class="hesd-text"><i class="fa fa-user color-sky"></i> User Profile </h2>
                                            <div class="clear"></div>
                                            <div class="table-asignment">
                                                <div class="nav-tabs-wrap">
                                                    <ul class="nav-tabs" role="tablist">
                                                        <li class="active"><a href="#mysubmissions" role="tab" data-toggle="tab">Schooling</a></li>
                                                        <li><a href="#studentssubmissions" role="tab" data-toggle="tab">Guardian</a></li>
                                                        <li><a href="#address" role="tab" data-toggle="tab">Address</a></li>
                                                        <li><a href="#studentrecord" role="tab" data-toggle="tab">Student Record</a></li>
                                                        <li class="tabs-hr" style="left: 0px; width: 113px;"></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active" id="mysubmissions">
                                                        <div class="col-md-6 registration-form-box padding-left">
                                                            <p> School Name</p>
                                                            <input type="text"  id="school_name" name="school_name" value="<?php echo $st_details[0]->school_name;?>">
                                                            <span id="show_school_name" style="color:red"></span>
                                                            <p> School week Off</p>
                                                            <input type="text"  id="week_day" id="week_day" value="<?php echo $st_details[0]->school_weekoff_day;?>">
                                                            <span id="show_week_day" style="color:red"></span>

                                                            <p>Marks Obtained Total %</p>
                                                            <input type="text" id="total_marks" name="total_marks" value="<?php echo $st_details[0]->total_marks;?>">
                                                            <span id="show_total_marks" style="color:red"></span>
                                                            <p> Marks Obtained Math % </p>
                                                            <input type="text"  id="math_marks" name="math_marks" value="<?php echo $st_details[0]->math_marks;?>">
                                                            <span id="show_math" style="color:red"></span>
                                                            <p> Marks Obtained Physics %</p>
                                                            <input type="text"  id="phy_marks" name="phy_marks" value="<?php echo $st_details[0]->phy_marks;?>">
                                                            <span id="show_phy" style="color:red"></span>
                                                            <p>School Address</p>
                                                            <textarea id="school_address"  name="school_address" ><?php echo $st_details[0]->school_address;?></textarea>
                                                            <span id="show_school_address" style="color:red"></span>
                                                        </div>
                                                        <div class="col-md-6 registration-form-box padding-right">
                                                            <p> School Timing</p>
                                                            <input type="text" name="school_timing"  id="school_timing" value="<?php echo $st_details[0]->school_timing;?>">
                                                            <span id="show_school_timing" style="color:red"></span>
                                                            <p> Board</p>
                                                            <input type="text"  value="<?php echo $st_details[0]->board;?>" />
                                                            <span id="show_board" style="color:red"></span>
                                                            <p>Marks Obtained Chemistry %</p>
                                                            <input type="text"  id="che_marks" name="che_marks" value="<?php echo $st_details[0]->che_marks;?>">
                                                            <span id="show_che" style="color:red"></span>
                                                            <p>Marks Obtained Bio %</p>
                                                            <input type="text"  name="bio_marks" id="bio_marks" value="<?php echo $st_details[0]->bio_marks;?>">
                                                            <span id="show_bio" style="color:red"></span>
                            <p> Marks Obtained Science %</p>
                            <input type="text" id="science_marks" name="science_marks" value="<?php echo $st_details[0]->science_marks;?>">
                            <span id="show_science" style="color:red"></span>

                            <p> Mark Sheet</p>
                            <span id="show_mark_sheet" style="color:red"></span>
                        </div>

                    </div>
                    <!-- END / MY SUBMISSIONS -->

                    <div class="tab-pane fade" id="studentssubmissions">
                       <div class="col-md-6 registration-form-box padding-left">
                            <p> Father's Name </p>
                            <input type="text" name="father_name"  id="father_name"  value="<?php echo $st_details[0]->father_name;?>">
                            <span id="show_fathername" style="color:red"></span>
                            <p> Mother's Name</p>
                            <input type="text" name="mother_name"  id="mother_name" value="<?php echo $st_details[0]->mother_name;?>">
                            <span id="show_mothename" style="color:red"></span>
                            <p> Father Mobile No </p>
                            <input type="text" name="guardian_mobile_no"  id="guardian_mobile_no" value="<?php echo $st_details[0]->guardian_mobile_no	;?>">
                            <span id="show_guardian_mobile" style="color:red"></span>
                        </div>
                        <div class="col-md-6 registration-form-box padding-right">
                            <p> Father's Occupation </p>
                            <input type="text" name="father_occupation"  id="father_occupation" value="<?php echo $st_details[0]->father_occupation;?>">
                            <span id="show_fathe_occupation" style="color:red"></span>
                             <p> Mother's Occupation</p>
                            <input type="text" name="mother_occupation"  id="mother_occupation" value="<?php echo $st_details[0]->mother_occupation;?>">
                            <span id="show_mother_occupation" style="color:red"></span>
                            <p> Mother Mobile No</p>
                            <input type="text" name="parent_number"  id="parent_number" value="<?php echo $st_details[0]->guardian_phone_no;?>">

                        </div>

                    </div>

                    <!-- END / MY SUBMISSIONS -->

                    <div class="tab-pane fade" id="address">
                        <div class="col-md-6 registration-form-box padding-left">
                            <p>Address1</p>
                            <textarea name="address1" id="address1"  type="textarea" ><?php echo $st_details[0]->address1;?></textarea>
                            <span id="show_address1" style="color:red"></span>
                            <p>State</p>
                            <input type="text" value=""  id="hidden_state_name" name="hidden_state_name" value="<?php echo $st_details[0]->state;?>">
                            <span id="show_state" style="color:red"></span>
                            <p>Pincode</p>
                            <input type="text"  name="pincode" id="pincode" value="<?php echo $st_details[0]->pincode;?>">
                            <span id="show_pincode" style="color:red"></span>
                        </div>
                        <div class="col-md-6 registration-form-box padding-right">
                            <p>Address2</p>
                            <textarea name="address2"  id="address2" type="textarea" ><?php echo $st_details[0]->address2;?></textarea>
                             <p>City</p>
                            <input type="text"  value="<?php echo $session_data->city;?>" />
                            <span id="show_city" style="color:red"></span>
                            <p>Land Line Number</p>
                            <input type="text"  name="home_number" id="home_number" value="<?php echo $st_details[0]->landline_no;?>">

                       </div>

                    </div>

                     <!-- MY SUBMISSIONS -->

                        <div class="tab-pane fade" id="studentrecord">
                             <div class="col-md-6 registration-form-box padding-left">
                            <p> First Name</p>
                            <input type="text"  name="first_name" id="first_name" value="<?php echo $st_details[0]->first_name; ?>">
                            <span id="show_first_name" style="color:red"></span>

                            <p> E-mail</p>
                            <input type="text"  name="email" id="email" value="<?php echo $st_details[0]->student_email;?>">
                            <span id="show_email" style="color:red"></span>

                            <p class="margin-top"> Gender</p>
                            <input type="text"  name="gender" value="<?php echo $st_details[0]->gender;?>">

                            <p> Date Of Birth</p>
                            <input type="text"  name="dob" value="<?php echo $st_details[0]->dob;?>">
                            <span id="show_dob"></span>
                        </div>

                        <div class="col-md-6 registration-form-box padding-right">
                            <p> Last Name</p>
                            <input type="text"  name="last_name" id="last_name" value="<?php echo $st_details[0]->last_name;?>">
                            <span id="show_last_name"  style="color:red"></span>
                            <p> Mobile No</p>
                            <input type="text"  name="student_mobile_number" id="student_mobile_number" maxlength="10" value="<?php echo $st_details[0]->student_phone_no;?>">
                            <span id="show_mobile"  style="color:red"></span>
                            <p> Stream</p>
                           <input type="text"  value="<?php echo $st_details[0]->stream?>" />
                            <span id="show_stream" style="color:red"></span>

                            <p> Category</p>

                            <input type="text"  value="<?php echo $st_details[0]->category?>" />

                            <span id="show_category" style="color:red"></span>

                            <p> Addmission In Class</p>
                            <input type="text"  value="<?php echo $st_details[0]->addmission_class ; ?>" />

                            <span id="show_class" style="color:red"></span>
                            </div>
                        <div class="clear"></div>

                    </div>

                </div>

            </div>
            <div class="clear"></div>
                    </div>
                   <!--  <input type="submit" value="Cancel" class="mc-btn-4 btn-style-1"> -->
                   <input type="submit" value="Update" class="mc-btn-4 btn-style-1" onclick="return a();">
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