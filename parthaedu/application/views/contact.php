
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>contact us</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">contact us</a></li>
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
    		<!--LOCATION MAP Wrap Start-->
    		<div class="kf_location_wrap overlay">
				<div id="map-canvas" class="map-canvas"></div>
				<div class="location_des">
					<h6>Partha Educations</h6>
					<!--<p>Sed ut imperdiet nisi. Proin condimen nunc Etiam pharetra, erat sed fermentu</p>-->
					<ul class="location_meta">
						<li><i class="fa fa-phone"></i> <a href="#">+ 91 9163833903</a></li>
						<li><i class="fa fa-map-marker"></i>  Saltlake City, West Bengal 700064 India</li>
						<li><i class="fa fa-envelope-o"></i>  <a href="#"> admin@parthaedu.com</a></li>
					</ul>
					<a href="#">Contct Us Now and Get Started <i class="fa fa-long-arrow-right"></i></a>
				</div>
    		</div>
    		<!--LOCATION MAP Wrap END-->
    		<section>
    			<div class="container">
    				<!--CONTACT HEADING Start-->
    				
    				<!--CONTACT HEADING END-->
                    <div class="contct_wrap">
                        <div class="row">
                            <div class="col-md-8">
                                <?php echo form_open('Welcome/contact_query');?>
                                    <div class="contact_des">
                                        <h4>Contact Form</h4>
                                        <div class="inputs_des des_2">
                                            <input type="text" name="name" placeholder="Name"><i class="fa fa-user"></i>
                                        </div>
    
                                        <div class="inputs_des des_2">
                                            <input type="text" name="email" placeholder="E-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="inputs_des des_2">
                                            <input type="text" name="phone" placeholder="Phone">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="inputs_des des_3">
                                            <textarea name="message"  placeholder="Description"></textarea>
                                            <i class="fa fa-comments-o"></i>
                                        </div>
                                        <div class="inputs_des des_2">
                                            <button type="submit" name="submit">Send</button>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-4">
                                <div class="contact_heading">
                                    <h4>Contact info</h4>
                                    
                                </div>
                                <ul class="contact_meta">
                                    <li><i class="fa fa-building"></i>Saltlake City, West Bengal 700064 India</li>
                                   <li><i class="fa fa-clock-o"></i> Office Hrs 12.30PM -8.30 PM (Mon off)</li>
                                    <li><i class="fa fa-phone"></i><a href="#"> +91 9163833903</a></li>
                                    <li><i class="fa fa-envelope-o"></i><a href="#"> admin@parthaedu.com</a></li>
                                </ul>
                                <div class="contact_heading social">
                                    <h4>Get Social</h4>
                                </div>
                                <ul class="cont_socil_meta">
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
	    			</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End-->
        <!--NEWS LETTERS START-->
		 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>