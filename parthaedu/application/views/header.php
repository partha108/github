<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from kodeforest.net/html/uoe/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 May 2016 03:52:47 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="<?php echo base_url();?>partheducation/images/favicon.ico">
	<title>Education</title>
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>partheducation/css/bootstrap.min.css" rel="stylesheet">
	<!-- Full Calender CSS -->
	<link href="<?php echo base_url();?>partheducation/css/fullcalendar.css" rel="stylesheet">
	<!-- Owl Carousel CSS -->
	<link href="<?php echo base_url();?>partheducation/css/owl.carousel.css" rel="stylesheet">
	<!-- Pretty Photo CSS -->
	<link href="<?php echo base_url();?>partheducation/css/prettyPhoto.css" rel="stylesheet">
	<!-- Bx-Slider StyleSheet CSS -->
	<link href="<?php echo base_url();?>partheducation/css/jquery.bxslider.css" rel="stylesheet"> 
	<!-- Font Awesome StyleSheet CSS -->
	<link href="<?php echo base_url();?>partheducation/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>partheducation/svg/style.css" rel="stylesheet">
	<!-- Widget CSS -->
	<link href="<?php echo base_url();?>partheducation/css/widget.css" rel="stylesheet">
	<!-- Typography CSS -->
	<link href="<?php echo base_url();?>partheducation/css/typography.css" rel="stylesheet">
	<!-- Shortcodes CSS -->
	<link href="<?php echo base_url();?>partheducation/css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
	<link href="<?php echo base_url();?>partheducation/style.css" rel="stylesheet">
	<!-- Color CSS -->
	<link href="<?php echo base_url();?>partheducation/css/color.css" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?php echo base_url();?>partheducation/css/responsive.css" rel="stylesheet">
	<!-- SELECT MENU -->
	<link href="<?php echo base_url();?>partheducation/css/selectric.css" rel="stylesheet">
	<!-- SIDE MENU -->
	<link rel="stylesheet" href="<?php echo base_url();?>partheducation/css/jquery.sidr.dark.css">
</head>

<body>
	<!--KF KODE WRAPPER WRAP START-->
    <div class="kode_wrapper">
    <!-- register Modal -->
    <div class="modal fade" dis id="reg-box" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-content">
            	<!--SIGNIN AS USER START-->
                <div class="user-box">
                	<h2>Sign up as a User</h2>
                    <!--FORM FIELD START-->
                    <div class="form">
                    
                        <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="fullname" placeholder="Name">
                            <i class="fa fa-user"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="email" placeholder="Email">
                            <i class="fa fa-user"></i>
                        </div>
                      
                        <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="password" name="password" placeholder="Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="password" name="cpassword" placeholder="Confirm Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="phone" placeholder="Phone">
                            <i class="fa fa-unlock"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <select name="country">
                                                                                                <option value="Afghanistan">Afghanistan</option>
                                                                                                <option value="Albania">Albania</option>
                                                                                                <option value="Algeria">Algeria</option>
                                                                                                <option value="American Samoa">American Samoa</option>
                                                                                                <option value="Andorra">Andorra</option>
                                                                                                <option value="Angola">Angola</option>
                                                                                                <option value="Anguilla">Anguilla</option>
                                                                                                <option value="Antarctica">Antarctica</option>
                                                                                                <option value="Antigua and/or Barbuda">Antigua and/or Barbuda</option>
                                                                                                <option value="Argentina">Argentina</option>
                                                                                                <option value="Armenia">Armenia</option>
                                                                                                <option value="Aruba">Aruba</option>
                                                                                                <option value="Australia">Australia</option>
                                                                                                <option value="Austria">Austria</option>
                                                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                                                <option value="Bahamas">Bahamas</option>
                                                                                                <option value="Bahrain">Bahrain</option>
                                                                                                <option value="Bangladesh">Bangladesh</option>
                                                                                                <option value="Barbados">Barbados</option>
                                                                                                <option value="Belarus">Belarus</option>
                                                                                                <option value="Belgium">Belgium</option>
                                                                                                <option value="Belize">Belize</option>
                                                                                                <option value="Benin">Benin</option>
                                                                                                <option value="Bermuda">Bermuda</option>
                                                                                                <option value="Bhutan">Bhutan</option>
                                                                                                <option value="Bolivia">Bolivia</option>
                                                                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                                                <option value="Botswana">Botswana</option>
                                                                                                <option value="Bouvet Island">Bouvet Island</option>
                                                                                                <option value="Brazil">Brazil</option>
                                                                                                <option value="British lndian Ocean Territory">British lndian Ocean Territory</option>
                                                                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                                                <option value="Bulgaria">Bulgaria</option>
                                                                                                <option value="Burkina Faso">Burkina Faso</option>
                                                                                                <option value="Burundi">Burundi</option>
                                                                                                <option value="Cambodia">Cambodia</option>
                                                                                                <option value="Cameroon">Cameroon</option>
                                                                                                <option value="Canada">Canada</option>
                                                                                                <option value="Cape Verde">Cape Verde</option>
                                                                                                <option value="Cayman Islands">Cayman Islands</option>
                                                                                                <option value="Central African Republic">Central African Republic</option>
                                                                                                <option value="Chad">Chad</option>
                                                                                                <option value="Chile">Chile</option>
                                                                                                <option value="China">China</option>
                                                                                                <option value="Christmas Island">Christmas Island</option>
                                                                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                                                <option value="Colombia">Colombia</option>
                                                                                                <option value="Comoros">Comoros</option>
                                                                                                <option value="Congo">Congo</option>
                                                                                                <option value="Cook Islands">Cook Islands</option>
                                                                                                <option value="Costa Rica">Costa Rica</option>
                                                                                                <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                                                                                <option value="Cuba">Cuba</option>
                                                                                                <option value="Cyprus">Cyprus</option>
                                                                                                <option value="Czech Republic">Czech Republic</option>
                                                                                                <option value="Denmark">Denmark</option>
                                                                                                <option value="Djibouti">Djibouti</option>
                                                                                                <option value="Dominica">Dominica</option>
                                                                                                <option value="Dominican Republic">Dominican Republic</option>
                                                                                                <option value="East Timor">East Timor</option>
                                                                                                <option value="Ecuador">Ecuador</option>
                                                                                                <option value="Egypt">Egypt</option>
                                                                                                <option value="El Salvador">El Salvador</option>
                                                                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                                                <option value="Eritrea">Eritrea</option>
                                                                                                <option value="Estonia">Estonia</option>
                                                                                                <option value="Ethiopia">Ethiopia</option>
                                                                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                                                                <option value="Faroe Islands">Faroe Islands</option>
                                                                                                <option value="Fiji">Fiji</option>
                                                                                                <option value="Finland">Finland</option>
                                                                                                <option value="France">France</option>
                                                                                                <option value="France, Metropolitan">France, Metropolitan</option>
                                                                                                <option value="French Guiana">French Guiana</option>
                                                                                                <option value="French Polynesia">French Polynesia</option>
                                                                                                <option value="French Southern Territories">French Southern Territories</option>
                                                                                                <option value="Gabon">Gabon</option>
                                                                                                <option value="Gambia">Gambia</option>
                                                                                                <option value="Georgia">Georgia</option>
                                                                                                <option value="Germany">Germany</option>
                                                                                                <option value="Ghana">Ghana</option>
                                                                                                <option value="Gibraltar">Gibraltar</option>
                                                                                                <option value="Greece">Greece</option>
                                                                                                <option value="Greenland">Greenland</option>
                                                                                                <option value="Grenada">Grenada</option>
                                                                                                <option value="Guadeloupe">Guadeloupe</option>
                                                                                                <option value="Guam">Guam</option>
                                                                                                <option value="Guatemala">Guatemala</option>
                                                                                                <option value="Guinea">Guinea</option>
                                                                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                                                <option value="Guyana">Guyana</option>
                                                                                                <option value="Haiti">Haiti</option>
                                                                                                <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                                                                                                <option value="Honduras">Honduras</option>
                                                                                                <option value="Hong Kong">Hong Kong</option>
                                                                                                <option value="Hungary">Hungary</option>
                                                                                                <option value="Iceland">Iceland</option>
                                                                                                <option value="India">India</option>
                                                                                                <option value="Indonesia">Indonesia</option>
                                                                                                <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                                                                                <option value="Iraq">Iraq</option>
                                                                                                <option value="Ireland">Ireland</option>
                                                                                                <option value="Israel">Israel</option>
                                                                                                <option value="Italy">Italy</option>
                                                                                                <option value="Ivory Coast">Ivory Coast</option>
                                                                                                <option value="Jamaica">Jamaica</option>
                                                                                                <option value="Japan">Japan</option>
                                                                                                <option value="Jordan">Jordan</option>
                                                                                                <option value="Kazakhstan">Kazakhstan</option>
                                                                                                <option value="Kenya">Kenya</option>
                                                                                                <option value="Kiribati">Kiribati</option>
                                                                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                                                                <option value="Kosovo">Kosovo</option>
                                                                                                <option value="Kuwait">Kuwait</option>
                                                                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                                                                <option value="Latvia">Latvia</option>
                                                                                                <option value="Lebanon">Lebanon</option>
                                                                                                <option value="Lesotho">Lesotho</option>
                                                                                                <option value="Liberia">Liberia</option>
                                                                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                                                <option value="Liechtenstein">Liechtenstein</option>
                                                                                                <option value="Lithuania">Lithuania</option>
                                                                                                <option value="Luxembourg">Luxembourg</option>
                                                                                                <option value="Macau">Macau</option>
                                                                                                <option value="Macedonia">Macedonia</option>
                                                                                                <option value="Madagascar">Madagascar</option>
                                                                                                <option value="Malawi">Malawi</option>
                                                                                                <option value="Malaysia">Malaysia</option>
                                                                                                <option value="Maldives">Maldives</option>
                                                                                                <option value="Mali">Mali</option>
                                                                                                <option value="Malta">Malta</option>
                                                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                                                <option value="Martinique">Martinique</option>
                                                                                                <option value="Mauritania">Mauritania</option>
                                                                                                <option value="Mauritius">Mauritius</option>
                                                                                                <option value="Mayotte">Mayotte</option>
                                                                                                <option value="Mexico">Mexico</option>
                                                                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                                                                <option value="Monaco">Monaco</option>
                                                                                                <option value="Mongolia">Mongolia</option>
                                                                                                <option value="Montenegro">Montenegro</option>
                                                                                                <option value="Montserrat">Montserrat</option>
                                                                                                <option value="Morocco">Morocco</option>
                                                                                                <option value="Mozambique">Mozambique</option>
                                                                                                <option value="Myanmar">Myanmar</option>
                                                                                                <option value="Namibia">Namibia</option>
                                                                                                <option value="Nauru">Nauru</option>
                                                                                                <option value="Nepal">Nepal</option>
                                                                                                <option value="Netherlands">Netherlands</option>
                                                                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                                                <option value="New Caledonia">New Caledonia</option>
                                                                                                <option value="New Zealand">New Zealand</option>
                                                                                                <option value="Nicaragua">Nicaragua</option>
                                                                                                <option value="Niger">Niger</option>
                                                                                                <option value="Nigeria">Nigeria</option>
                                                                                                <option value="Niue">Niue</option>
                                                                                                <option value="Norfork Island">Norfork Island</option>
                                                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                                                <option value="Norway">Norway</option>
                                                                                                <option value="Oman">Oman</option>
                                                                                                <option value="Pakistan">Pakistan</option>
                                                                                                <option value="Palau">Palau</option>
                                                                                                <option value="Panama">Panama</option>
                                                                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                                                                <option value="Paraguay">Paraguay</option>
                                                                                                <option value="Peru">Peru</option>
                                                                                                <option value="Philippines">Philippines</option>
                                                                                                <option value="Pitcairn">Pitcairn</option>
                                                                                                <option value="Poland">Poland</option>
                                                                                                <option value="Portugal">Portugal</option>
                                                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                                                <option value="Qatar">Qatar</option>
                                                                                                <option value="Reunion">Reunion</option>
                                                                                                <option value="Romania">Romania</option>
                                                                                                <option value="Russian Federation">Russian Federation</option>
                                                                                                <option value="Rwanda">Rwanda</option>
                                                                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                                                <option value="Saint Lucia">Saint Lucia</option>
                                                                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                                                <option value="Samoa">Samoa</option>
                                                                                                <option value="San Marino">San Marino</option>
                                                                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                                                                <option value="Senegal">Senegal</option>
                                                                                                <option value="Serbia">Serbia</option>
                                                                                                <option value="Seychelles">Seychelles</option>
                                                                                                <option value="Sierra Leone">Sierra Leone</option>
                                                                                                <option value="Singapore">Singapore</option>
                                                                                                <option value="Slovakia">Slovakia</option>
                                                                                                <option value="Slovenia">Slovenia</option>
                                                                                                <option value="Solomon Islands">Solomon Islands</option>
                                                                                                <option value="Somalia">Somalia</option>
                                                                                                <option value="South Africa">South Africa</option>
                                                                                                <option value="South Georgia South Sandwich Islands">South Georgia South Sandwich Islands</option>
                                                                                                <option value="Spain">Spain</option>
                                                                                                <option value="Sri Lanka">Sri Lanka</option>
                                                                                                <option value="St. Helena">St. Helena</option>
                                                                                                <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                                                                                                <option value="Sudan">Sudan</option>
                                                                                                <option value="Suriname">Suriname</option>
                                                                                                <option value="Svalbarn and Jan Mayen Islands">Svalbarn and Jan Mayen Islands</option>
                                                                                                <option value="Swaziland">Swaziland</option>
                                                                                                <option value="Sweden">Sweden</option>
                                                                                                <option value="Switzerland">Switzerland</option>
                                                                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                                                                <option value="Taiwan">Taiwan</option>
                                                                                                <option value="Tajikistan">Tajikistan</option>
                                                                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                                                                <option value="Thailand">Thailand</option>
                                                                                                <option value="Togo">Togo</option>
                                                                                                <option value="Tokelau">Tokelau</option>
                                                                                                <option value="Tonga">Tonga</option>
                                                                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                                                <option value="Tunisia">Tunisia</option>
                                                                                                <option value="Turkey">Turkey</option>
                                                                                                <option value="Turkmenistan">Turkmenistan</option>
                                                                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                                                <option value="Tuvalu">Tuvalu</option>
                                                                                                <option value="Uganda">Uganda</option>
                                                                                                <option value="Ukraine">Ukraine</option>
                                                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                                                <option value="United Kingdom">United Kingdom</option>
                                                                                                <option value="United States">United States</option>
                                                                                                <option value="United States minor outlying islands">United States minor outlying islands</option>
                                                                                                <option value="Uruguay">Uruguay</option>
                                                                                                <option value="Uzbekistan">Uzbekistan</option>
                                                                                                <option value="Vanuatu">Vanuatu</option>
                                                                                                <option value="Vatican City State">Vatican City State</option>
                                                                                                <option value="Venezuela">Venezuela</option>
                                                                                                <option value="Vietnam">Vietnam</option>
                                                                                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                                                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                                                                                <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                                                                                <option value="Western Sahara">Western Sahara</option>
                                                                                                <option value="Yemen">Yemen</option>
                                                                                                <option value="Yugoslavia">Yugoslavia</option>
                                                                                                <option value="Zaire">Zaire</option>
                                                                                                <option value="Zambia">Zambia</option>
                                                                                                <option value="Zimbabwe">Zimbabwe</option>
                                                                                                </select>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="state" placeholder="Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="city" placeholder="Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="zip" placeholder="Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                         <div class="input-container" style="width:49%;padding: 5px;">
                            <input type="text" name="address" placeholder="Password">
                            <i class="fa fa-unlock"></i>
                        </div>
                        
                        <div class="input-container">
                            <button class="btn-style" type="submit" name="submit">Sign Up</button>
                        </div>
                    </div>
                    <!--FORM FIELD END-->
                    <!--OPTION START-->
                   
                    <!--OPTION END-->
                </div>
                <!--SIGNIN AS USER END-->
              <!--  <div class="user-box-footer">
                    Already have an account? <a href="#">Sign In</a>
                </div>
                <div class="clearfix"></div>-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- register Modal end-->
    
    <!-- SIGNIN MODEL START -->
    <div class="modal fade" id="signin-box" tabindex="-1" role="dialog">
        <div class="modal-dialog">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-content">
                <div class="user-box">
                    <h2>Sign In</h2>
                    <!--FORM FIELD START-->
                    <div class="form">
                        
                        <div class="input-container">
                            <a class="btn-style" href="http://studentscorner.parthaedu.com/" target="_blank">Student Portal</a>
                        </div>
                        <div class="input-container">
                            <a class="btn-style" href="http://www.onlineexam.parthaedu.com/onlineexam" target="_blank">Online Exam</a>
                        </div>
                    </div>
                    <!--FORM FIELD END-->
                    <!--OPTION START-->
                   <!-- <div class="option">
                        <h5>Or Using</h5>
                    </div>-->
                    <!--OPTION END-->
                    <!--OPTION START-->
                   <!-- <div class="social-login">
                        <a href="#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>
                    </div>-->
                    <!--OPTION END-->
                
                </div>
               
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- SIGNIN MODEL END -->
    
	<div id="sidr">
		<div class="logo_wrap">
			<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>partheducation/images/logo-head.png" alt=""></a>
		</div>
		<div class="clearfix clear"></div>
		<!-- Your content -->
		<div class="kf-sidebar">
			<!--KF_SIDEBAR_SEARCH_WRAP START-->
			
			<!--KF_SIDEBAR_SEARCH_WRAP END-->

			<!--KF_SIDEBAR_ARCHIVE_WRAP START-->
			<div class="widget widget-archive ">
				<h2>Test Results</h2>
				<ul class="sidebar_archive_des">
               		<?php foreach($tr as $tr){?>
					<li>
						<a href="<?php echo base_url();?>index.php/Welcome/test_results/<?php echo $tr->upload_date;?>"><i class="fa fa-angle-right"></i><?php echo $tr->upload_date;?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<!--KF_SIDEBAR_ARCHIVE_WRAP END-->

			<p class="copy-right-sidr">Design and Developed by PiTechnologies Pvt. Ltd.</p>
		</div>
	</div>
    	<!--HEADER START-->
    	<header id="header_2">
    		<!--kode top bar start-->
    		<div class="top_bar_2">
	    		<div class="container">
	    			<div class="row">
	    				<div class="col-md-5">
	    					<div class="pull-left">
	    						<em class="contct_2"><i class="fa fa-phone"></i> Call Us  on +91 9163833903</em>
	    					</div>
	    				</div>
	    				<div class="col-md-7">
    						<!--<div class="lng_wrap">
	    						<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<i class="fa fa-globe"></i>Language
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li><a href="#"><i><img src="images/english.jpg" alt=""></i>English</a></li>
										<li><a href="#"><i><img src="images/german.jpg" alt=""></i>German</a></li> 
									</ul>
								</div>
	    					</div>-->
                            <?php if(!empty($this->session->userdata['user_details']['id'])){ ?>
                            
                           <ul class="top_nav">
	    						<li><i class="fa fa-user"></i><a href="<?php echo base_url();?>dashboard">My Account</a></li>
                               <li><i class="fa fa-sign-out"></i><a href="<?php echo base_url();?>logout">Log out</a></li>
                           </ul>
                            
								<!--<a href="<?php //echo base_url();?>dashboard" class="custom-btn colored">My Account</a>-->
                                <?php } else { ?>
                                
                              <!--  <a href="<?php //echo base_url();?>register" class="custom-btn colored">Register</a>-->
                                
                                 						<ul class="login_wrap">
                                 			<li><a href="http://www.studentscorner.parthaedu.com/" data-toggle="modal" target="_blank"><i class="fa fa-user"></i>Students Corner</a></li>
    							<li><a href="http://www.onlineexam.parthaedu.com/onlineexam" data-toggle="modal" target="_blank"><i class="fa fa-user"></i>Free online Exam</a></li>
    							<li><a href="#" data-toggle="modal" data-target="#signin-box"><i class="fa fa-sign-in"></i>Sign In</a></li>
    						</ul>	    					

	    					
                             <?php } ?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
    		<!--kode top bar end-->
        	
	    	<!--kode navigation start-->
    		<div class="kode_navigation">
    			<div id="mobile-header">
                	<a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
                </div>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2">
    						<div class="logo_wrap">
    							<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>partheducation/images/logo-head.png" alt=""></a>
    						</div>
    					</div>
    					<div class="col-md-10">
    						<!--kode nav_2 start-->
    						<div class="nav_2" id="navigation">
    							<ul>
    								<li><a href="<?php echo base_url();?>">home</a></li>
									
		                            <li><a href="<?php echo base_url();?>index.php/Welcome/aboutus">About Us</a>
		                            	<ul>
		                                    <li><a href="<?php echo base_url();?>index.php/Welcome/whypartha">Why Partha ?</a></li>
                                             <li><a href="<?php echo base_url();?>index.php/Welcome/team">Our Team</a></li>
		                                    <li><a href="<?php echo base_url();?>index.php/Welcome/directrorsdesk">From Director's Desk</a></li>
		                                    <li><a href="<?php echo base_url();?>index.php/Welcome/vision">Vision &amp; Objective</a></li>
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/parthazeals">Partha Zeals</a></li>
                                             <li><a href="<?php echo base_url();?>index.php/Welcome/gallery">Our Gallery</a></li>
                                             
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/video">Video Gallery</a></li>
		                                </ul>
		                            </li>
		                           
		                            <li><a href="<?php echo base_url();?>index.php/Welcome/courses">Courses</a>
		                            	<ul>
		                                	<li><a href="<?php echo base_url();?>index.php/Welcome/board_jee_courses">Boards+JEE</a></li>
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/pjace_course">PJAC Course</a></li>
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/foundation">Foundation Program</a></li>
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/prefoundation">Pre Foundation Program</a></li>
		                                </ul>
		                            </li>
                                    
                                     <li><a href="#">Acedemic</a>
		                            	<ul>
		                                   
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/test_results">Test Results</a></li>
                                            <li><a href="<?php echo base_url();?>index.php/Welcome/time_table">Answer Key</a></li>

                                            <li><a href="<?php echo base_url();?>index.php/Welcome/notice">Notice Board</a></li>
                                           
                                               
		                                </ul>
		                            </li>
                                    
                                    
		                            <li><a href="#">Achivements</a>
		                            	<ul>
		                                	<li><a href="<?php echo base_url();?>index.php/Welcome/achivements/2015">Results</a></li>
                                         <li><a href="<?php echo base_url();?>index.php/Welcome/testimonials">Testimonials</a></li>
		                                </ul>
		                            </li>
		                            <li><a href="<?php echo base_url();?>index.php/Welcome/alumini">Alumini</a></li>
									 <li><a href="<?php echo base_url();?>index.php/Welcome/contact">Contact</a></li>
		                            <li><a id="simple-menu" href="#sidr"><i class="fa fa-bars"></i></a></li>
    							</ul>
    						</div>
    						<!--kode nav_2 end-->
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--kode navigation end-->
		</header>
		<!--HEADER END-->