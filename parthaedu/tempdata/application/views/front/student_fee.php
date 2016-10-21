<!-- PROFILE FEATURE -->

<section class="profile-feature">
    <div class="awe-parallax bg-profile-feature"></div>
    <div class="awe-overlay overlay-color-3"></div>
    <div class="container">
        <div class="info-author margin-top2">

            <div class="image">
                <?php
                $user_fullname ='';

                //print_r($this->session->userdata('partha'));

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
                        $user_fullname = $session_data->first_name.' '. $session_data->last_name;
                    }
					
					 $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);
						 //print_r($pro_img);
					}
                 ?>
               <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>">
            </div>
            <div class="name-author">
                <h2 class="big"><?php
                    $user_fullname ='';

                    //print_r($this->session->userdata('partha'));

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
                            $b= $session_data->state;
							$st_mobile_no = $session_data->student_phone_no;
                            $user_fullname = $session_data->first_name.' '. $session_data->last_name;
                        }}
                    echo $user_fullname;
                    //  echo ;


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
                     <a href="<?php echo base_url('home/student_graph') ?>">
                         <i class="fa fa-bar-chart"></i>
                         Change Profile Pic
                     </a>
                 </li>
                        <li class="active1">
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
                                    <form method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="st_id" value="<?php echo $a;?>" />
                                        <h2 class="hesd-text"><i class="fa fa-credit-card color-sky"></i> Fees Payment / Due </h2>


                                        <div class="clear"></div>

                                        <div class="table-asignment">
                                            <div class="nav-tabs-wrap">
                                                <ul class="nav-tabs" role="tablist">
                                                    <li class="active"><a href="#mysubmissions" role="tab" data-toggle="tab"> Paid Payment </a></li>
                                                    <li><a href="#studentssubmissions" role="tab" data-toggle="tab"> Due Payment </a></li>
                                                    
                                                    <li class="tabs-hr" style="left: 0px; width: 113px;"></li>
                                                </ul>
                                            </div>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <!-- MY SUBMISSIONS -->
                                                <div class="tab-pane fade in active" id="mysubmissions">
                                                  
                                                    <div class="tab-content">
                                                        <ul>
<?php


	   	$st_payment_detail = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','student_id',$a);
		foreach($st_payment_detail as $spd)
		{
			$payment_head_id = $spd->payment_head_name;
			$payment_head_detail = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);								
			foreach($payment_head_detail as $phd)
			{
				@$pay_head_name = $phd->payment_head_name;
			}
			if($spd->payment_status == "paid" || $spd->payment_status == "1")
	{
?>
	<li><i class="fa fa-arrow-right"></i>
	<?php
	/*$st_payment_detail = $this->common_model->student_payment_unpaid_details('tbl_add_course_to_student_payment_details','student_id',$a,'payment_status','pending');*/ 
	
		if($spd->payment_head_name == "Exam Fees")
		{ 
			echo $spd->payment_head_name; 
		}
		else if($spd->payment_head_name =="Reg Fees")
		{ 
			echo $spd->payment_head_name;
		}
		else
		{
			echo $pay_head_name;
		}
	?>
	<span> 
	<i class="fa fa-inr"></i>
	<?php 
	if($spd->payment_head_name == "Exam Fees")
	{ 
		echo $spd->exam_tot_amt; 
	}
	else if($spd->payment_head_name =="Reg Fees")
	{
		echo $spd->course_vat_tot_amt;
	}
	else
	{
		echo $spd->payment_head_tot_amt;
	} 
	}
	?>
	</span></li>
<?php } ?>
                                                        
														

                                                        </ul>
                                                    </div>  
                                                    
                                                </div>
                                                <!-- END / MY SUBMISSIONS -->

                                                <div class="tab-pane fade" id="studentssubmissions">
                                                    
                                                   <div class="tab-content">
                                                        <ul>
<?php
	   	$st_payment_detail = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','student_id',$a);
		foreach($st_payment_detail as $spd)
		{
			$payment_head_id = $spd->payment_head_name;
			$payment_head_detail = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);								
			foreach($payment_head_detail as $phd)
			{
				@$pay_head_name = $phd->payment_head_name;
			}
			if($spd->payment_status == "pending" || $spd->payment_status == "2" || $spd->payment_status == "3")
	{
?>
	<li><i class="fa fa-arrow-right"></i>
	<?php 
		if($spd->payment_head_name == "Exam Fees")
		{ 
			echo $spd->payment_head_name; 
		}
		else if($spd->payment_head_name =="Reg Fees")
		{ 
			echo $spd->payment_head_name;
		}
		else
		{
			echo $pay_head_name;
		}
	?>
	<span> 
	<i class="fa fa-inr"></i>
	<?php 
	if($spd->payment_head_name == "Exam Fees")
	{ 
		echo $spd->exam_tot_amt; 
	}
	else if($spd->payment_head_name =="Reg Fees")
	{
		echo $spd->course_vat_tot_amt;
	}
	else
	{
		echo $spd->payment_head_tot_amt;
	} }
	?>
	</span></li>
<?php } ?>
                                                        </ul>
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
    </div>
</section>

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>