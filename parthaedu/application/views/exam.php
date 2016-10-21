
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>All Exam Notice</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Exam Notice</a></li>
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
    		<section class="our_event_page">
    			<div class="container">
    				<div class="row">

	    				<!-- HEADING 2 START-->
						<div class="col-md-12">
							<div class="kf_edu2_heading2">
								<h3>Exam Notice</h3>
							</div>
						</div>
						<!-- HEADING 2 END-->

    					<!-- EDU2 NEW DES START-->
					 <?php $i=5;foreach($exam as $notice){?>
						<div class="col-md-6" style="border-left:1px solid #999;">
							<div class="edu2_new_des">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="edu2_event_des">
                                        <?php $m=explode("-",$notice['edate']);
									//$curdate = date("Y-m-d");
									$cdate = date_create($notice['edate']);
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
                                        <button type="button" class="btn" data-toggle="modal" data-target="#reg-box<?php echo $i;?>">Read More</button>
                                       <div class="modal fade" dis id="reg-box<?php echo $i;?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" style="padding:30px; background:#FFF;">
        	<button style="border:2px solid #999; border-radius:100px; min-width:30px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-header">
            <h3 class="text-warning"><?php echo $todaydt." ".$m[2];?></h3>
            <h4><?php echo $notice['title'];?></h4>
            </div>
            <div class="modal-content" style="padding:30px;">
            	<!--SIGNIN AS USER START-->
                <p>
                                        <?php echo $notice['content'];?>
                                        </p>
                <!--SIGNIN AS USER END-->
              <!--  <div class="user-box-footer">
                    Already have an account? <a href="#">Sign In</a>
                </div>
                <div class="clearfix"></div>-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
									</div>
								</div>
							</div>
						</div>
                        <?php $i++;}?>

    				</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End-->
<!--NEWS LETTERS START-->
		