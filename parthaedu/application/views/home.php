<div class="modal fade" dis id="reg-box3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" >
        	<button style="min-width:30px;opacity:1;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-content" style="padding:30px;">
            	<!--SIGNIN AS USER START-->
                <img class="img img-responsive" src="<?php echo base_url();?>images/<?php echo $popup->image;?>" style="height:100%;width:100%;" />
                <!--SIGNIN AS USER END-->
              <!--  <div class="user-box-footer">
                    Already have an account? <a href="#">Sign In</a>
                </div>
                <div class="clearfix"></div>-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    
	<link href="css/owl.carousel.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet"> 

		<div class="edu2_main_bn_wrap">
			<div id="owl-demo-main" class="owl-carousel owl-theme">
				<div class="item">
					<figure>
						<img src="<?php echo base_url();?>images/<?php echo $banner1->image;?>" alt=""/>
						<figcaption>
							<span>The Best Learning Institution</span>
							<h2>welcome to Partha Educational Institutions</h2>
							<p>Where Personal Attention is the culture.</p>
							<a href="<?php echo base_url();?>index.php/Welcome/courses" class="btn-1">read more</a>
						</figcaption>
					</figure>
				</div>
				<div class="item">
					<figure>
						<img src="<?php echo base_url();?>images/<?php echo $banner2->image;?>" alt=""/>
						<figcaption>
							<span>Dedicated team of Experienced Faculties & IITians </span>
							<h2>ONLINE EXAM,PERSONAL GUIDANCE</h2>
							<p>Synchronizing board exams with JEE MAIN/ JEE ADVANCE / WBJEE.</p>
                                           <p>Performance monitoring through CPTs, PCTs & Study Card prepared and reviewed by IITians.</p>

							<a href="<?php echo base_url();?>index.php/Welcome/courses" class="btn-1">read more</a>
						</figcaption>
					</figure>
				</div>
				<div class="item">
					<figure>
						<img src="<?php echo base_url();?>images/<?php echo $banner3->image;?>" alt=""/>
						<figcaption>
							<span>Study card System and Study hours Schedule</span>
							<h2>PARTHA ZEALS</h2>
							<p>Mentor based one to one Counseling from IITians, Monthly Revision test.</p>
                                                           <p> Complete care of BOARDS ( ICSE & CBSE) with JEE & Medical</p>
							<a href="<?php echo base_url();?>index.php/Welcome/courses" class="btn-1">read more</a>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>

<section class="edu2_new_wrap">
				<div class="container">
					<!-- HEADING 2 START-->
					<div class="col-md-12">
						<div class="kf_edu2_heading2">
							<h3>Latest Notice</h3>
						</div>
					</div>
					<!-- HEADING 2 END-->
					<div class="row">
						<!-- EDU2 NEW DES START-->
                        <?php foreach($notice as $notice){?>
						<div class="col-md-6">
							<div class="edu2_new_des">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="edu2_event_des">
                                        <?php $m=explode("-",$notice['add_date']);
									//$curdate = date("Y-m-d");
									$cdate = date_create($notice['add_date']);
									$todaydt =  date_format($cdate, 'M');
										?>
											<h4><?php echo $todaydt;?></h4>
											<p><?php echo $notice['title'];?></p>
											<!--<ul class="post-option">
 												<li>By<a href="#">Admin</a></li>
 												<li>03/12/2015</li>
 												<li><a href="#">21 Comments</a></li>
											</ul>-->
											
											<span><?php echo $m[2];?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 thumb" style="padding:10px;">
										<p>
                                        <?php echo substr($notice['content'],0,100);?>
                                        </p>
									</div>
								</div>
							</div>
						</div>
                        <?php }?>
						<!-- EDU2 NEW DES END-->

						<!-- EDU2 NEW DES START-->
						
					</div>
				</div>
			</section>
		<div class="kf_content_wrap">
			<!--COURSE OUTER WRAP START-->
			<div class="kf_course_outerwrap">
				<div class="container-fluid">

					<div class="row">

						<div class="col-md-6">
							<div class="row">
								<!--COURSE CATEGORIES WRAP START-->
								<div class="kf_cur_catg_wrap">
									<!--COURSE CATEGORIES WRAP HEADING START-->
									<div class="col-md-12">
										<div class="kf_edu2_heading1">
											<h3>Course Categories</h3>
										</div>
									</div>
									<!--COURSE CATEGORIES WRAP HEADING END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-1">
											<span><i class="icon-statistics"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Board + JEE</h5>
												<p>1 Years Regular Program for XI-Passed/XII Studying Students</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-3">
											<span><i class="icon-chemistry29"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>PJAC Course</h5>
												<p>JEE Advance Crash Course for the students appeared in JEE MAIN. </p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-4">
											<span><i class="icon-caduceus8"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Foundation Program</h5>
												<p>Four Years Foundation Program (IX Studying) </p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									
									<!--COURSE CATEGORIES DES END-->

									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6">
										<div class="kf_cur_catg_des color-6">
											<span><i class="fa fa-line-chart"></i></span>
											<div class="kf_cur_catg_capstion">
												<h5>Pre Foundation Programs</h5>
												<p>The first step towards nurturing the young generation of the country.</p>
											</div>
										</div>
									</div>
									<!--COURSE CATEGORIES DES END-->

								</div>
								<!--COURSE CATEGORIES WRAP END-->
							</div>
						</div>

						<div class="col-md-6" style="padding-top:100px;padding-bottom:50px;">
								<ul class="bxslider">
                                <?php foreach($slider as $front1){?>
									<li>
										<!-- STUDENT SLIDER DES START-->
										<div class="student_slider_des">
											 <img alt="" src="<?php echo base_url();?>album/<?php echo $front1->image;?>">
										</div>
										<!-- STUDENT SLIDER DES END-->
									</li>
								<?php }?>
								</ul>
							</div>
					</div>

				</div>
			</div>
            
			<!--COURSE OUTER WRAP END-->
			<!--KF INTRO WRAP START-->
			<section class="kf_edu2_intro_wrap">
				 
                <div class="kf_intro_des_wrap">
					<!-- HEADING 2 START-->
					<div class="col-md-12">
						<div class="kf_edu2_heading2">
							<h3>Welcome To Partha Education</h3>
						</div>
					</div>
					<!-- HEADING 2 END-->
					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<span><i class="icon-earth132"></i></span>
							<h6>Salient Features</h6>
							<p>World Largest books and library center is here where you can study the latest trends of the education.</p>
							
						</div>
                       <div align="center"><a href="<?php echo base_url();?>index.php/Welcome/whypartha" class="btn btn-warning" style="text-align:center;">Read More</a></div>
						<!--<figure>
							<img src="<?php //echo base_url();?>index.php/Welcome/whypartha" alt=""/>
							<figcaption><a href="#">Learn Courses Online</a></figcaption>
						</figure>-->
					</div>
					<!-- INTERO DES END-->
					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<span><i class="icon-educational18"></i></span>
							<h6>Partha Zeals</h6>
							<p>World Largest books and library center is here where you can study the latest trends of the education.</p>
							
						</div>
                       <div align="center"> <a href="<?php echo base_url();?>index.php/Welcome/parthazeals" class="btn btn-warning" style="text-align:center;">Read More</a></div>
					
					</div>
					<!-- INTERO DES END-->

					<!-- INTERO DES START-->
					<div class="kf_intro_des">
						<div class="kf_intro_des_caption">
							<span><i class="icon-teacher4"></i></span>
							<h6>Our Team</h6>
							<p>World Largest books and library center is here where you can study the latest trends of the education.</p>
							
						</div>
					<div align="center"> <a href="<?php echo base_url();?>index.php/Welcome/team" class="btn btn-warning" style="text-align:center;">Read More</a></div>
					</div>
					<!-- INTERO DES END-->
				</div>
			</section>
			<!--KF INTRO WRAP END-->

			<!--KF COURSES CATEGORIES WRAP START-->
			
			<!--KF COURSES CATEGORIES WRAP END-->

			<!--GALLERY SECTION START-->
			
			<!--GALLERY SECTION END-->
<section class="edu2_counter_wrap">
				<div class="container">
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-group2"></i></span>
						<h3 class="counter">2904</h3>
						<h5>USERS</h5>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-book236"></i></span>
						<h3 class="counter">9426</h3>
						<h5>TESTS TAKEN</h5>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-win5"></i></span>
						<h3 class="counter">19924</h3>
						<h5>QUESTIONS ATTEMPTED</h5>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="fa fa-clock-o"></i></span>
						<h3 class="counter">5140</h3>
						<h5>TOTAL Hrs SPENT</h5>
					</div>
					<!--EDU2 COUNTER DES END-->
				</div>
			</section>
            <section class="edu2_counter_wrap">
				<div class="container">
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-group2"></i></span>
						
						<h3>IIT-JEE</h3>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-book236"></i></span>
						
						<h3>BITSAT</h3>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="icon-win5"></i></span>
						
						<h3>MEDICAL</h3>
					</div>
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<div class="edu2_counter_des">
						<span><i class="fa fa-clock-o"></i></span>
						
						<h3>FOUNDATION</h3>
					</div>
					<!--EDU2 COUNTER DES END-->
				</div>
			</section>
			<!--COUNTER SECTION START-->
			
			<!--COUNTER SECTION END-->

			<!-- FACULTY WRAP START
			<section>
				<div class="container">
					<div class="row">
					
						<div class="col-md-12">
							<div class="kf_edu2_heading1">
								<h3>Faculty member</h3>
							</div>
						</div>
						
						<div class="edu2_faculty_wrap">
							<div id="owl-demo-8" class="owl-carousel owl-theme">
								<div class="item">
								
									<div class="edu2_faculty_des">
										<figure><img src="<?php //echo base_url();?>partheducation/extra-images/faculty-mb1.jpg" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">Danny Awesome</a></h6>
											<strong>Manager</strong>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>
										</div>
									</div>
									
								</div>

								<div class="item">
									
									<div class="edu2_faculty_des">
										<figure><img src="<?php echo base_url();?>partheducation/extra-images/faculty-mb2.jpg" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">Kimberly Richiez</a></h6>
											<strong>Russian Teacher</strong>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>
										</div>
									</div>
									
								</div>

								<div class="item">
									
									<div class="edu2_faculty_des">
										<figure><img src="<?php echo base_url();?>partheducation/extra-images/faculty-mb3.jpg" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">Dylan Taylor</a></h6>
											<strong>English Teacher</strong>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>
										</div>
									</div>
									
								</div>

								<div class="item">
									
									<div class="edu2_faculty_des">
										<figure><img src="<?php echo base_url();?>partheducation/extra-images/faculty-mb4.jpg" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">Simon Grishaber</a></h6>
											<strong>Health Teacher</strong>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>
										</div>
									</div>
									
								</div>

								<div class="item">
									
									<div class="edu2_faculty_des">
										<figure><img src="<?php echo base_url();?>partheducation/extra-images/faculty-mb1.jpg" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#">Simon Grishaber</a></h6>
											<strong>Health Teacher</strong>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</section>
			 FACULTY WRAP START-->

			<!-- LATEST NEWS AND EVENT WRAP START-->
			
			<!-- LATEST NEWS AND EVENT WRAP END-->


			<!--TRAINING WRAP START-->
			<section class="edu2_tarining_bg">
				<div class="container">
					<div class="row">
						

						<div class="col-md-12">
							<div class="edu2_training_wrap">
								<h2>Online Examination Platform</h2>
							<h3><strong>Exhaustive preparation for JEE  MAINS , BITSAT with online Mock Test series
 Prepare To Score Higher</strong></h3>
								<!--COUNTDOWN START-->
								<!--<ul class="countdown">
									<li>
										<span class="days">195</span>
										<p class="days_ref">days</p>
									</li>
									<li>
										<span class="hours">20</span>
										<p class="hours_ref">hours</p>
									</li>
									<li>
										<span class="minutes">34</span>
										<p class="minutes_ref">minutes</p>
									</li>
									<li>
										<span class="seconds last">17</span>
										<p class="seconds_ref">seconds</p>
									</li>
								</ul>-->
								<!--COUNTDOWN END-->
								
								<a href="http://www.onlineexam.parthaedu.com/onlineexam" target="blank" class="btn-1">Get Started NOW</a>
							</div>

						</div>
					</div>
				</div>
			</section>
            <section class="kode-gallery-section">
				<!-- HEADING 2 START-->
                <div class="col-md-12">
                    <div class="kf_edu2_heading2">
                        <h3>Our Gallery</h3>
						<!--<p>Student gallery of the year past graduated passouts</p>-->
                    </div>
                </div>
                <!-- HEADING 2 END-->
                <!-- EDU2 GALLERY WRAP START-->
                <div class="edu2_gallery_wrap gallery">
                   
                    <!-- EDU2 GALLERY DES START-->
                    <div class="gallery3">
                    <?php foreach($front as $front){?>
                        <div class="filterable-item all 2 1 9 col-md-3 col-sm-4 col-xs-12 no_padding">
                            <div class="edu2_gallery_des">
                                <figure>
                                    <img alt="" src="<?php echo base_url();?>album/<?php echo $front->image;?>">
                                    <figcaption>
                                        
                                        <h5>Partha Educational Institutions</h5>
                                        <p></p>
                                    </figcaption>
                                </figure>
                            </div>	
                        </div>
                     <?php }?>
                    </div>
                    
                <!-- EDU2 GALLERY WRAP END-->
                </div>
             
			</section>
			<!--TRAINING WRAP END-->

			<!--PLAN AND PRICE WRAP START-->
			
			<!--PLAN AND PRICE WRAP END-->

			<!--OUR TESTEMONIAL WRAP START-->
			<section>
				<div class="container">
					<div class="row">
						<!-- HEADING 2 START-->
						<div class="col-md-12">
							<div class="kf_edu2_heading2">
								<h3>Our Testimonial</h3>
							</div>
						</div>
						<!-- HEADING 2 END-->
						<!-- TESTEMONIAL SLIDER WRAP START-->
						<div class="edu2_testemonial_slider_wrap">
							<div id="owl-demo-9">
                            <?php foreach($test as $test){?>
								<div class="item">
									<!-- TESTEMONIAL SLIDER WRAP START-->
									<div class="edu_testemonial_wrap">
					<figure><img src="<?php echo base_url();?>uploads/testimonials/<?php echo $test->image;?>" alt=""/></figure>
										<div class="kode-text">
											<p><?php echo $test->comment;?></p>
											<a href="#"><?php echo $test->username;?><span>- <?php echo $test->usertype;?></span></a>
										</div>
									</div>
									<!-- TESTEMONIAL SLIDER WRAP END-->
								</div>
							<?php }?>
							</div>
						</div>
						<!-- TESTEMONIAL SLIDER WRAP END-->
					</div>
				</div>
			</section>
			<!--OUR TESTEMONIAL WRAP END-->
		</div>

		<!--EDU2 FOOTER WRAP START-->
		<!--NEWS LETTERS START-->
	