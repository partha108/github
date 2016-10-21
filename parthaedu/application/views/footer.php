	<div class="edu2_ft_topbar_wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="edu2_ft_topbar_des">
							<h5>Subcribe weekly newsletter</h5>
						</div>
					</div>
					<div class="col-md-6">
						<div class="edu2_ft_topbar_des">
							<?php echo form_open("Welcome/subscribe");?>
								<input type="email" name="email" placeholder="Enter Valid Email Address">
								<button type="submit" name="submit"><i class="fa fa-paper-plane"></i>Submit</button>
							<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--NEWS LETTERS END-->
		<!--FOOTER START-->
		<footer>
			<!--EDU2 FOOTER CONTANT WRAP START-->
				<div class="container">
					<div class="row">
						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-4">
							<div class="widget widget-links">
								<h5>Quick Links</h5>
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/courses">Courses</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/aboutus">About Us</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/contact">Contact</a></li>
									<!--<li><a href="#">Sprcialist Info</a></li>-->
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-4">
							<div class="widget widget-links">
								<h5>Student Help</h5>
								<ul>
									<li><a href="<?php echo base_url();?>index.php/Welcome/test_results">Test Results</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/achivements/2015">Achivement Results</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/vision">Gallery</a></li>
									<li><a href="<?php echo base_url();?>index.php/Welcome/gallery">Vision & Objectives</a></li>
									<!--<li><a href="#">Latest Informations</a></li>-->
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-4">
							<div class="widget widget-contact">
								<h5>Contact</h5>
								<ul>
									<li>Saltlake City, West Bengal 700064 India</li>
									
									<li>Office Hrs 12.30PM -8.30 PM (Mon off)</li>
                                    <li>Mo : +91 9163833903</li> 
									<li>Email : info@parthaedu.com</li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->
					</div>
				</div>
		</footer>
		<!--FOOTER END-->
		<!--COPYRIGHTS START-->
		<div class="edu2_copyright_wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="edu2_ft_logo_wrap">
							<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>partheducation/images/logo-head.png" alt=""/></a>
						</div>
					</div>

					<div class="col-md-6">
						<div class="copyright_des">
							<span><a href="<?php echo base_url();?>">Partha Educational Institutions</a></span>
						</div>
					</div>

					<!--<div class="col-md-3">
						<ul class="cards_wrap">
							<li><a href="#"><img src="<?php //echo base_url();?>partheducation/extra-images/visacard.png" alt=""/></a></li>
							<li><a href="#"><img src="<?php //echo base_url();?>partheducation/extra-images/mastercard.png" alt=""/></a></li>
							<li><a href="#"><img src="<?php //echo base_url();?>partheducation/extra-images/americancard.png" alt=""/></a></li>
							<li><a href="#"><img src="<?php //echo base_url();?>partheducation/extra-images/card.png" alt=""/></a></li>
							<li><a href="#"><img src="<?php //echo base_url();?>partheducation/extra-images/descoverycard.png" alt=""/></a></li>
						</ul>
					</div>-->
				</div>
			</div>
		</div>
		<!--COPYRIGHTS START-->
    </div>
   
    <!--KF KODE WRAPPER WRAP END-->
	<!--Bootstrap core JavaScript-->
    
	<script src="<?php echo base_url();?>partheducation/js/jquery.js"></script>
   <script>
		$(document).ready(function(){
			$(".alumi").change(function(){
				var u=$(this).val();
				$(".ggghhh").hide();
				$(".year"+u).show();
			});
			$("#showreg").click(function(){
				$("#regform").slideToggle();
			});
			$("#students").click(function(){
				$(".Parents").hide();
				$(".Student").show();
			});
			$("#parents").click(function(){
				$(".Parents").show();
				$(".Student").hide();
			});
			
		});
	</script>
    <?php $chk=$this->db->get("modal")->row();
	if($chk->status=="yes"){?>
    <script type="text/javascript">
    $(window).load(function(){
        $('#reg-box3').modal('show');
    });
</script>
<?php }?>
	<script src="<?php echo base_url();?>partheducation/js/bootstrap.min.js"></script>
	<!--Bx-Slider JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.bxslider.min.js"></script>
	<!--Owl Carousel JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/owl.carousel.min.js"></script>
	<!--Pretty Photo JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.prettyPhoto.js"></script>
	<!--Full Calender JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/moment.min.js"></script>
	<script src="<?php echo base_url();?>partheducation/js/fullcalendar.min.js"></script>
	<script src="<?php echo base_url();?>partheducation/js/jquery.downCount.js"></script>
	<!--Image Filterable JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/jquery-filterable.js"></script>
	<!--Accordian JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.accordion.js"></script>
	<!--Number Count (Waypoints) JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/waypoints-min.js"></script>
	<!--v ticker-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.vticker.min.js"></script>
	<!--select menu-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.selectric.min.js"></script>
	<!--Side Menu-->
	<script src="<?php echo base_url();?>partheducation/js/jquery.sidr.min.js"></script>
	<!--Custom JavaScript-->
	<script src="<?php echo base_url();?>partheducation/js/custom.js"></script>

    
</body>

<!-- Mirrored from kodeforest.net/html/uoe/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 May 2016 03:56:30 GMT -->
</html>
