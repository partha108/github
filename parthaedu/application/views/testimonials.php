
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Testimonials</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Testimonials</a></li>
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
    		<section class="edu2_teachers_page">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-10">
                        <h3>Testimonials from Parents & Students</h3><hr/>
                        <?php if($test){foreach ($test as $al){?>
    					<div class="col-lg-3 col-md-3 col-sm-6 <?php echo $al->usertype;?>">
    						<!-- FACULTY DES START-->
							<div class="edu2_faculty_des" style="text-align:center;">
								<a href="<?php echo base_url();?>uploads/testimonials/<?php echo $al->image;?>"><img src="<?php echo base_url();?>uploads/testimonials/<?php echo $al->image;?>" alt=""/></a>
									<!--<figcaption>
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-linkedin"></i></a>
										<a href="#"><i class="fa fa-google-plus"></i></a>
									</figcaption>-->
								
								<div class="edu2_faculty_des2">
									<h6><a href="#"><?php echo $al->username;?></a></h6>
									<strong class="text-success"><?php echo $al->usertype;?> <i class="text-warning"><?php echo $al->add_date;?></i></strong>
                                   
									<p><?php echo $al->comment;?></p>
								</div>
							</div>
							<!-- FACULTY DES END-->
    					</div>
						<?php }}else{?>
                        <hr/><h1>No Testimonials Found</h1><?php }?>
    			
                        
						</div>
                        <div class="col-md-2">
                        
                       	<h6>Filter Testimonials</h6><hr/>
                        <button class="btn-3" id="students">Students</button><br/><br/>
                        <button class="btn-3" id="parents">Parents</button>
                       </div>
    					<!--<div class="col-md-12">
    						<div class="loadmore">
    							<a href="#" class="btn-3">load more</a>
    						</div>
    					</div>-->
    				</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End--><!--NEWS LETTERS START-->
		