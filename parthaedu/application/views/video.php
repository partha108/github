
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Video Gallery</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Video Gallery</a></li>
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
    	<div class="inner-content-holder">
			<div class="container">
				<div class="row">
					<!--EDUCATION BLOG PAGE START-->
					<?php if($video){
						foreach($video as $video){?>
                    <div class="col-md-6">
						<div class="edu2_blog_page">
    						
							<div class="edu2_blogpg_wrap">
                            <div class="edu2_blogpg_des">
									
									<ul>
										<li><i class="fa fa-calendar"></i>Uploaded on <?php echo $video->upload_date;?></li>
										
									</ul>
									<h5><?php echo $video->title;?></h5>
									
									
								</div>
								<div class="kd-video-post">
                                <?php if($video->url==""){?>
                                <iframe src="<?php echo base_url();?>images/<?php echo $video->vfile;?>"></iframe>
                                <?php }else{?>
                                <iframe src="<?php echo $video->url;?>"></iframe>
                                <?php }?>
                                    
                                </div>
								
							</div>
							<!--EDUCATION BLOG PAGE WRAP END-->
						</div>
                        <?php }}else{?>
                        <h2>No Videos Uploaded In the gallery</h2>
                       


						

					
					<?php }?>
                    <!--EDUCATION BLOG PAGE END-->

				    <!--KF_EDU_SIDEBAR_WRAP START-->
					
					<!--KF EDU SIDEBAR WRAP END-->

				</div>
			</div>
    	</div>
        <!--Content Wrap End-->
<!--NEWS LETTERS START-->
       