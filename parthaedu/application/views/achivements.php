        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Achivements</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Achivements</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->

    	<!--Content Wrap Start-->
    	<div class="kf_content_wrap">
    		<section>
	 			<div class="container">
	 				<div class="row">
	 					<div class="col-md-8">

	 						<!-- COURSES DETAIL WRAP START -->
	 						<div class="kf_courses_detail_wrap">
	 							<div class="courses_detail_heading">
	 								<h4>Partha Achivements <?php echo $this->uri->segment(3);?></h4>
	 							</div>

	 							<!--<ul class="course_detail_meta">
	 								<!--<li><i class="fa fa-user"></i><a href="#">John Doe</a></li>
	 								<li><i class="fa fa-clock-o"></i>December 29, 2015</li>
	 								<!--<li><i class="fa fa-bookmark"></i><a href="#">Language</a></li>
	 							</ul>-->

	 							
	 							<div class="kf_courses_tabs">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
                                    <?php $i=1;foreach($ac as $tr1){?>
										<li role="presentation" <?php if($i==1){?>class="active"<?php }?>><a href="#coursedetails<?php echo $i;?>" aria-controls="coursedetails<?php echo $i;?>" role="tab" data-toggle="tab"><?php echo $tr1->for_class;?></a></li>
                                        <?php $i++;}?>
										
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<?php $j=1;foreach($ac as $tr2){?>
                                        
										<div role="tabpanel" class="tab-pane <?php if($j==1){?>active<?php }?>" id="coursedetails<?php echo $j;?>">

											<!-- COURSES DETAIL DES START -->
											<div class="kf_courses_detail_des">
												<?php $ih=explode(",",$tr2->file);
												foreach($ih as $ii){?>
                                                <div class="col-md-3">
									<img class="img img-responsive" src="<?php echo base_url();?>uploads/<?php echo $ii;?>" />			
                                                </div>
                                                <?php }?>
											</div>
										
										
										</div>
										<?php $j++;}?>
										

									</div>
	 							</div>
	 							

	 						</div>
	 						<!-- COURSES DETAIL WRAP END -->
	 					</div>

	 					<!--KF_EDU_SIDEBAR_WRAP START-->
    					<div class="col-md-4">
    						<div class="kf-sidebar">

    							<!--KF_SIDEBAR_SEARCH_WRAP START-->
    							
    							<!--KF_SIDEBAR_SEARCH_WRAP END-->

    							<!--KF_SIDEBAR_ARCHIVE_WRAP START-->
    							<!--<div class="widget teacher_outer_wrap">
    								<h2>Teachers</h2>
    								<div class="teacher_wrap">
    									<figure><img src="extra-images/teacher-sidebar.jpg" alt=""/></figure>
    									<div class="teacher_des">
    										<h4>John Advert</h4>
    										<small>English Professor</small>
    									</div>
    									<p>Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum . Proin gravida nibh vel velit auctor aliquet.  Proin gravida nibh vel velit auctor aliquet. </p>
    									<ul class="teacher_meta">
    										<li><a href="#"><i class="fa fa-envelope"></i></a></li>
    										<li><a href="#"><i class="fa fa-skype"></i></a></li>
    										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
    									</ul>
    								</div>

    							</div>-->
    							<!--KF_SIDEBAR_ARCHIVE_WRAP END-->
    							<!--KF_SIDEBAR_ARCHIVE_WRAP START-->
    							<!--<div class="widget widget-archive ">
    								<h2>Archives</h2>
    								<ul class="sidebar_archive_des">
    									<li>
    										<a href="#"><i class="fa fa-angle-right"></i>January</a>
    									</li>
    									<li>
    										<a href="#"><i class="fa fa-angle-right"></i>February</a>
    									</li>
    									<li>
    										<a href="#"><i class="fa fa-angle-right"></i>March</a>
    									</li>
    									<li>
    										<a href="#"><i class="fa fa-angle-right"></i>April</a>
    									</li>
    									<li>
    										<a href="#"><i class="fa fa-angle-right"></i>May</a>
    									</li>
    								</ul>
    							</div>-->
    							<!--KF_SIDEBAR_ARCHIVE_WRAP END-->


    							<!--KF SIDEBAR RECENT POST WRAP START-->
    							
    							<!--KF SIDEBAR RECENT POST WRAP END-->

    							<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP START-->
	    						<div class="widget widget-categories">
	    							<h2>Partha Achivements</h2>
									<ul>
								<?php foreach($yr as $yr){?>		
                                <li><a href="<?php echo base_url();?>index.php/Welcome/achivements/<?php echo $yr->year;?>"><i class="fa fa-caret-right"></i>Result <?php echo $yr->year;?></a></li>
								<?php }?>
									</ul>
	    						</div>
	    						<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP END-->

	    						<!--KF SIDE BAR COURSES LIST WRAP START WRAP START-->
	    						
	    						<!--KF SIDE BAR COURSES LIST WRAP START WRAP END-->

	    						<!--KF SIDE BAR TAG CLOUD WRAP START-->
	    						<!--<div class="widget widget-tag-cloud">
	    							<h2>Tags Cloud</h2>
	    							<ul>
	    								<li><a href="#">Science</a></li>
	    								<li><a href="#">Development</a></li>
	    								<li><a href="#">Fine Arts</a></li>
	    								<li><a href="#">Research</a></li>
	    								<li><a href="#">Admissions</a></li>
	    								<li><a href="#">PHD</a></li>
	    								<li><a href="#">History &amp; Politics</a></li>
	    								<li><a href="#">Sports</a></li>
	    							</ul>

	    						</div>-->
	    						<!--KF SIDE BAR TAG CLOUD WRAP END-->

    						</div>
    					</div>
						<!--KF EDU SIDEBAR WRAP END-->
	 				</div>
	 			</div>
	 		</section>
    	</div>
        <!--Content Wrap End-->
        <!--NEWS LETTERS START-->
	