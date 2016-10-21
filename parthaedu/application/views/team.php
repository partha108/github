        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>OUR TEAM</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Our Team</a></li>
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
                	<div class="col-md-6">
                    <h4>Our Esteemed Faculties</h4>
                    <p>The faculty members associated with PARTHA are a strong and dedicated team of experts who possess ample experience and knowledge to nurture the students at the basic level and simultaneously making them adaptable to face the competitive examinations successfully. The faculty at PARTHA is more like companions who inspire the students to master the concepts. This is achieved through fostering innovations in education, interaction with professors, conceptual teaching, assessment, evaluation, guidance and motivation.</p>
                    </div>
                    <div class="col-md-6">
                    <div class="abt_univ_thumb">
    							<figure>
    								<img src="<?php echo base_url();?>partheducation/images/team.jpg" alt=""/>
    							</figure>
    						</div>
                    </div>
                </div>
    				<div class="row">
    					<?php foreach($team as $team){?>
                        
    					<div class="col-lg-3 col-md-4 col-sm-6">
    						<!-- FACULTY DES START-->
							<div class="edu2_faculty_des" style="height:50%;">
								<figure><img style="height:50%;" src="<?php echo base_url();?>team/<?php echo $team->image;?>" alt=""/>
									
								</figure>
								<div class="edu2_faculty_des2">
									<h6><a href="#"><?php echo $team->name;?> </a></h6>
									<strong><?php echo $team->position;?></strong>
									<p><?php echo $team->education;?></p>
								</div>
							</div>
							<!-- FACULTY DES END-->
    					</div>
                        <?php }?>
                        
                    

    					
    				
    				</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End--><!--NEWS LETTERS START-->
		