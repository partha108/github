        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Answer Key of recent tests</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Answer Key</a></li>
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
	 					<div class="col-md-12">

	 						<!-- COURSES DETAIL WRAP START -->
	 						<div class="kf_courses_detail_wrap">
	 							<div class="courses_detail_heading">
	 								<h4>Answer Key </h4>
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
                            <tbody><?php $sql=$this->db->get_where("time_table",array("for_class"=>$tr2->for_class))->result();
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
    					
						<!--KF EDU SIDEBAR WRAP END-->
	 				</div>
	 			</div>
	 		</section>
    	</div>
        <!--Content Wrap End-->
        <!--NEWS LETTERS START-->
	