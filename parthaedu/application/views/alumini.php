<div class="modal fade" dis id="aluminiform" tabindex="-1" role="dialog">
        <div class="modal-dialog" >
        	<button style="border:2px solid #999; border-radius:100px; min-width:30px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <div class="modal-content" style="padding:50px;">
           <h3>Alumini Registration form</h3>
            <div id="regform">
								<?php echo form_open_multipart('Welcome/alumini_register');?>
									<div class="edu2_serc_des">
										<input type="text" style="height: 35px;" name="name" placeholder="Name:" required>
									</div>
                                      
                                    <div class="edu2_serc_des">
                                    <b class="text-success">Select Gender</b>&nbsp;&nbsp;&nbsp;
										<input type="radio"  name="gender" value="male" required> Male&nbsp;&nbsp;&nbsp;
                                        <input type="radio"  name="gender" value="female" required> Female
									</div>
                                  
									<div class="edu2_serc_des">
										<input type="date"  style="border:1px solid #FC6;height: 35px; width:100%;" name="dob" required>
                                        <small class="text-success">Date Of Birth</small>
									</div>
                                    
                                    <div class="edu2_serc_des">
										<input type="text" style="height: 35px;" name="email" required placeholder="Email:">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" maxlength="10" style="height: 35px;" required name="mobile" placeholder="Mobile:">
									</div>
                                    <div class="edu2_serc_des">
										<input type="file" style="height: 35px;" name="file">
                                        <small class="text-success">Upload Profile Image</small>
									</div>
                                   
									<div class="edu2_serc_des">
										<!-- Single button -->
										<select  style="height: 35px;" name="year" required>
                                       <option value="">Year of Completing XII</option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                         
                                             <option value="2015">2015</option>
                                              <option value="2014">2014</option>
                                               <option value="2013">2013</option>
                                               <option value="2012">2012</option>
                                               <option value="2011">2011</option>
                                                 
                                           
                                        </select>
									</div>
									<!-- EDU2 DROP DOWN DES END -->
									<div class="edu2_serc_des">
										<input type="text" name="cur_address" required style="height: 35px;" placeholder="Current Address">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="res_address" required style="height: 35px;" placeholder="Residential Address">
									</div>
                                    <h5>Educational Details</h5>
                                    <div class="edu2_serc_des">
										<input type="text" name="after_ten" style="height: 35px;" placeholder="Institute Joined After XII">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="course_taken" style="height: 35px;" required placeholder="Course Taken">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="school" style="height: 35px;" required placeholder="School From Which XII completed">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="board" style="height: 35px;" required placeholder="Board">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="percent" style="height: 35px;" placeholder="% Marks Obtained in XII">
									</div>
                                    <h5>Personal Details</h5>
                                     <div class="edu2_serc_des">
										<input type="text" name="father" style="height: 35px;" placeholder="Father Name">
									</div>
                                     <div class="edu2_serc_des">
										<input type="text" name="foc" style="height: 35px;" placeholder="Father Occupation">
									</div>
                                     <div class="edu2_serc_des">
										<input type="text" name="mother" style="height: 35px;" placeholder="Mother Name">
									</div>
                                    <div class="edu2_serc_des">
										<input type="text" name="moc" style="height: 35px;" placeholder="Mother Occupation">
									</div>
                                    <div class="edu2_serc_des">
										<textarea name="about" rows="3" required placeholder="Remarks About Partha" style="width:100%;border:1px solid #FC6;"></textarea>
									</div>
                                    
                                  
                                    <div class="edu2_serc_des">
										<textarea name="message" rows="5" placeholder="Write Your Message(Please mention your name , Mobile no in the context)" style="width:100%; border:1px solid #FC6;"></textarea>
									</div>
                                    
									<button type="submit" class="btn btn-warning" style="height: 40px; padding:5px 13px;" name="submit">Register</button>
								<?php echo form_close();?>
                                </div>
                                </div>
            <div class="clearfix"></div>
        </div>
    </div>
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Alumini</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Our Alumini Students</a></li>
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
                    
    					<div class="col-md-8">
                        <h5>Alumini Students can register here</h5><hr/>
                        <?php if($al){foreach ($al as $al){?>
    					<div class="ggghhh col-lg-4 col-md-4 col-sm-6 year<?php echo $al->com_year;?>">
    						<!-- FACULTY DES START-->
							<div class="edu2_faculty_des">
								<figure><img src="<?php echo base_url();?>alumini/<?php echo $al->image;?>" alt=""/>
									<!--<figcaption>
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-linkedin"></i></a>
										<a href="#"><i class="fa fa-google-plus"></i></a>
									</figcaption>-->
								</figure>
								<div class="edu2_faculty_des2">
									<h6><a href="#"><?php echo $al->name;?></a></h6>
									<strong>Passed XII in <?php echo $al->com_year;?></strong>
                                  <strong>School -  <?php echo $al->school;?></strong>
                                    <strong>Board - <?php echo $al->board;?></strong>
                                     <strong>Percent Scored -  <?php echo $al->percent;?></strong>
									<p><?php echo $al->remark;?></p>
								</div>
							</div>
							<!-- FACULTY DES END-->
    					</div>
						<?php }}else{?>
                        <hr/><h1>No Alumini Found</h1><?php }?>
    			
                        
						</div>
                       <div class="col-md-4">
                       
                       
							<!-- EDU2 SEARCH WRAP START -->
							<div class="kf_edu2_search_wrap">
								<div class="kf_edu2_heading1">
                                
									<button type="button" data-toggle="modal" data-target="#aluminiform" class="btn btn-warning" >Register Now</button>
								</div>
                                <hr/>
                                <h4>Sort By Year</h4>
                                <select class="alumi form-control">
                                	<option value="">Filter by year</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                </select>
                               <!-- <button style="margin:10px;" type="button" class="btn btn-warning alumi" id="2016">2016</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2015" >2015</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2014" >2014</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2013">2013</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2012">2012</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2011">2011</button>
                                <button style="margin:10px;" type="button"  class="btn btn-warning alumi" id="2010">2010</button>-->
                          
                                
								<!-- FORM START -->
                                
								<!-- FORM END -->
							</div>
							<!-- EDU2 SEARCH WRAP END -->
						</div>
    					
    				</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End--><!--NEWS LETTERS START-->
		