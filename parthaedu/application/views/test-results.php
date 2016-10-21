        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Test Results</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Courses Details</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

    	<div class="kf_content_wrap">
    		<section>
	 			<div class="container">
	 				<div class="row">
	 					<div class="col-md-8">

	 						<!-- COURSES DETAIL WRAP START -->
	 						<div class="kf_courses_detail_wrap">
	 							<div class="courses_detail_heading">
	 								<h4>Weekly Test Result Sheets</h4>
	 							</div>

	 							<!--<ul class="course_detail_meta">
	 								<!--<li><i class="fa fa-user"></i><a href="#">John Doe</a></li>
	 								<li><i class="fa fa-clock-o"></i>December 29, 2015</li>
	 								<!--<li><i class="fa fa-bookmark"></i><a href="#">Language</a></li>
	 							</ul>-->

	 							
	 							<div class="kf_courses_tabs">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
                                    <?php $i=1;foreach($tr as $tr1){?>
										<li role="presentation" <?php if($i==1){?>class="active"<?php }?>><a href="#coursedetails<?php echo $i;?>" aria-controls="coursedetails<?php echo $i;?>" role="tab" data-toggle="tab">Class - <?php echo $tr1->for_class;?></a></li>
                                        <?php $i++;}?>
										
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<?php $j=1;foreach($tr as $tr2){?>
                                        
										<div role="tabpanel" class="tab-pane <?php if($j==1){?>active<?php }?>" id="coursedetails<?php echo $j;?>">

											<!-- COURSES DETAIL DES START -->
											<div class="kf_courses_detail_des">
												<div class="course_heading">
													
                                                    <table class="table-condensed table">
                                                    	<thead><th>Date</th><th>Test Name</th><th>View</th><th>Download</th></thead>
                            <tbody><?php $sql=$this->db->get_where("test_result",array("for_class"=>$tr2->for_class))->result();
								foreach($sql as $y)
							{?>
                                                        	
                                                            <tr>
                                                            	<td><?php echo $y->upload_date;?></td>
                                                                <td><?php echo $y->test_name;?></td>
                                                                <td><a href="<?php echo base_url();?>uploads/<?php echo $y->filename;?>" class="btn btn-warning" target="_new"><i class="fa fa-eye"></i> View Result</a></td>
                                                                <td><a href="<?php echo base_url();?>uploads/<?php echo $y->filename;?>" class="btn btn-warning" download><i class="fa fa-download"></i>  Download Pdf</a></td>
                                                            </tr>
                                                        <?php }?></tbody>
                                                    </table>
                       
                       
         			<!-- <embed src="<?php //echo base_url();?>uploads/<?php //echo $tr2->filename;?>" height="560" width="100%">-->
									</embed>	
												</div>
											
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
    							<div class="sidebar_register_wrap">
                              	  <?php echo form_open('Welcome/test_result_search');?>	
    								<div class="edu2_serc_des">
										<!-- Single button -->
                                        
										<select class="basic" name="searchby">
                                        <option value="">Search Result by Date</option>
                                        <?php foreach($dates as $dt){?>
                                  <option value="<?php echo $dt->upload_date;?>"><?php echo $dt->upload_date;?></option>
                                         <?php }?>
                                       </select>
									</div>
									<!-- EDU2 DROP DOWN DES END -->
									
									<button type="submit" name="submit" class="btn btn-warning">Search For Result</button>
                                   <?php echo form_close();?>
    							</div>
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
	    							<h2>Recent Test Results</h2>
									<ul>
								<?php foreach($dates as $d){?>		
                                <li><a href="<?php echo base_url();?>index.php/Welcome/test_results/<?php echo $d->upload_date;?>"><i class="fa fa-caret-right"></i><?php echo $d->upload_date;?></a></li>
								<?php }?>
									</ul><hr/>
                                  
	    						</div>
                                  <a class="btn btn-warning" href="<?php echo base_url();?>index.php/Welcome/exam">Exam Announcement</a>
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
	