<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom_css/autocomplete.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom_css/validate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom_css/form_validation.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/validation_rulse.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>custom_script/add_doctor_more_feld.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/doctor_validation.js" ></script>
<style>
	.dropdownc dd, .dropdownc dt {
		margin: 0px;
		padding: 0px;
	}
	.dropdownc ul {
		margin: -1px 0 0 0;
	}
	.dropdownc dd {
		position: relative;
	}
	.dropdownc a, .dropdownc a:visited {
		color: #ff;
		text-decoration: none;
		outline: none;
		font-size: 12px;
	}
	/*
	.dropdownc dt a {
			background-color: #4F6877;
			display: block;
			padding: 8px 20px 5px 10px;
			min-height: 25px;
			line-height: 24px;
			overflow: hidden;
			border: 0;
			width: 100px;
		}*/


	.dropdownc dt a {
		display: block;
		padding: 11px 20px 3px 10px;
		line-height: 4px;
		overflow: hidden;
		width: 100px;
		border: 1px solid #ccc;
		margin: -9% 0 0 0 !important;
	}
	.dropdownc dt a span, .multiSel span {
		cursor: pointer;
		display: inline-block;
		padding: 0 3px 2px 0;
	}
	.dropdownc dd ul {
		background-color: #4F6877;
		border: 0;
		color: #fff;
		display: none;
		left: 0px;
		padding: 2px 15px 2px 5px;
		position: absolute;
		top: 2px;
		width: 113px;
		list-style: none;
		height: 62px;
		overflow: auto;
	}
	.dropdownc span.value {
		display: none;
	}
	.dropdownc dd ul li a {
		padding: 5px;
		display: block;
	}
	.dropdownc dd ul li a:hover
	{
		background-color: #fff;
	}
</style>

<!-- START ADD MORE FIELD -->
<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/manage-users/manage_doctors/manage_doctor_add_more_or_remove.js" ></script>
<!-- END ADD MORE FIELD -->

<!-- <script type="text/javascript">//editProductDetails(<?php //echo $product_id; ?>
	)
	//multipleFieldListingForEdit(
<?php //echo $product_id; ?>)</script> -->


<div id="content" class="span10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Admin</a> <span class="divider">/</span> </li>
			<li> <a href="<?php echo base_url(); ?>index.php/product">Add Student</a> </li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-globe"></i> Add Student</h2>
			</div>
		<div class="box-content">
			<div class="box-content">
				<?php echo form_open_multipart('addstudent/registration_post', array('class' => 'form-horizontal', 'id' => 'user_validation_form')); ?>
				<div>
					<div class="alert alert-error " style="display: none">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Warning:</strong> Please check all the error! .
					</div>
					<!--<ul class="breadcrumb">
						<li>
							<a class="btn btn-primary" id="in_active_user" href="javascript:void(0)" onclick="javascript:  window.history.back();/*window.location=base_url+'index.php/manage_doctor_list'*/"><i title="Cancel" class="icon icon-undo icon-white"></i> </a>
						</li>
						<li>
							<a class="btn btn-primary" id="add_doctor_Submit" onClick="exequete_dr_form_validation();" ><i title="save"  class="icon icon-save icon-white"></i></a>
						</li>
						<li>
							<a class="btn btn-primary" id="in_active_user" href="javascript:void(0)" onclick="javascript:location.reload();/*location=base_url+'index.php/add_doctor/add_doctor'*/"><i class="icon-refresh icon-white"></i></a>
						</li>
					</ul>-->
				</div>
				<ul id="myTab" class="nav nav-tabs" style="margin-bottom: 15px;">
					<li class="active">
						<a href="#home" data-toggle="tab">Student Detail</a>
					</li>
					<li class="">
						<a href="#contact_tab" data-toggle="tab">Schooling</a>
					</li>
					<li class="">
						<a href="#education_tab" data-toggle="tab">Guardian</a>
					</li>
					<li class="">
						<a href="#chember_tab" data-toggle="tab">Address</a>
					</li>

					</ul>
<div id="myTabContent" class="tab-content" >
	<div class="tab-pane active" id="home">
		<table class="table table-striped table-bordered bootstrap-datatable ">
		<tr>
			<td width="100%" style=" text-align:center"><h3>STUDENT DETAILS</h3></td>
		</tr>
		<tr>
			<td colspan="3">
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<?php $id = $max_id+1;
					if(strlen($id) == 1)
					{
						?>
						<input type="hidden"  name="student_reg_no" value="<?php echo date('Y')."000".$id;?>">
						<input type="hidden"  name="student_roll_no" value="<?php echo "000".$id;?>">

					<?php
					}
					if(strlen($id) == 2)
					{
						?>
						<input type="hidden"  name="student_reg_no" value="<?php echo date('Y')."00".$id;?>">
						<input type="hidden"  name="student_roll_no" value="<?php echo "00".$id;?>">
					<?php
					}
					else if(strlen($id) == 3)
					{
						?>
						<input type="hidden"  name="student_reg_no" value="<?php echo date('Y')."0".$id;?>">
						<input type="hidden"  name="student_roll_no" value="<?php echo "0".$id;?>">

					<?php
					}
					else if(strlen($id) >= 4)
					{

						?>
						<input type="hidden"  name="student_reg_no" value="<?php echo date('Y').$id;?>">
						<input type="hidden"  name="student_roll_no" value="<?php echo $id;?>">
					<?php
					}
					?>

					<tr>
						<td>First Name<span style="color:#F00">*</span></td>
						<td><input id="first_name" name="first_name" type="text" size="500px;"></td>
						<td>Last Name<span style="color:#F00">*</span></td>
						<td><input type="text" name="last_name" id="last_name"></td>
					</tr>

					<tr>
						<td>E-mail<span style="color:#F00">*</span></td>
						<td><input id="email" name="email" type="text" ></td>
						<td>Mobile No<span style="color:#F00">*</span></td>
						<td><input type="text" name="student_mobile_number" id="student_mobile_number"></td>
					</tr>

					<tr>
						<td>Photo</td>
						<td><input id="profile_pic" name="profile_pic[]" type="file" ></td>
						<td>Stream<span style="color:#F00">*</span></td>
						<td>
							<select id="stream" name="stream">
								<option value="0">---Stream---</option>
								<option value="engineering">Engineering</option>
								<option value="medical">Medical</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Gender<span style="color:#F00">*</span></td>
						<td><input type="radio" name="gender" id="gender" value="male" checked="">Male</label>
							<input type="radio" name="gender" id="gender" value="female" style="margin: 0 0 0 5px; " >Female</label>
						</td>
						<td>Category<span style="color:#F00">*</span></td>
						<td>
							<select id="category" name="category">
								<option value="0">---Select Category</option>
								<option value="sc">SC</option>
								<option value="st">ST</option>
								<option value="obc">OBC</option>
								<option value="general">GENERAL</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Date Of Birth <span style="color:#F00">*</span></td>
						<td><input type="text" name="dob" id="dob"></td>
						<td>Addmission In Class<span style="color:#F00">*</span></td>
						<td>
							<select name="addmission_class" id="addmission_class">
								<option value="0">---Select Class---</option>
								<?php
									foreach ($class as $cn)
									{
								?>
									<option value="<?php echo $cn->class_name;?>"><?php echo $cn->class_name;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							Enrollment Date
						</td>
						<td><?php echo date('d/m/Y');?></td>
						<td>
							Status
						</td>
						<td>
							<select name="student_status">
								<option value="studying">Studying</option>
								<option value="passout">Passout</option>
								<option value="dropout">Dropout</option>
							</select>
						</td>
					</tr>
		</table>
			</td>
				</tr>
	</table>
</div>


<div class="tab-pane" id="contact_tab">
	<table class="table table-striped table-bordered bootstrap-datatable" >
		<tr> <td width="100%" style=" text-align:center"><h3>SCHOOLING</h3></td></tr>
		<tr>
			<td>
				<div class="add_more_contact_list" id="add_more_contact_0">
					<table class="table table-striped table-bordered bootstrap-datatable datatable" >
					<tr>
						<td>School Name<span style="color:#F00">*</span></td>
						<td><input id="school_name" name="school_name" type="text" ></td>
						<td>School Timing<span style="color:#F00">*</span></td>
						<td><input type="text" name="school_timing" id="school_timing"></td>
					</tr>
					<tr>
						<td>School week Off<span style="color:#F00">*</span></td>
						<td><input id="week_day" name="week_day" type="text" ></td>
						<td>Board<span style="color:#F00">*</span></td>
						<td>
							<select id="board" name="board">
								<option value="0">---Select Board---</option>
								<option value="cbsc">CBSC</option>
								<option value="icsc">ICSC</option>
								<option value="isc">ISC</option>
								<option value="hs">HS</option>
								<option value="wb">WB</option>
								<option value="other">OTHER</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Marks Obtained Total %<span style="color:#F00">*</span></td>
						<td><input id="total_marks" name="total_marks" type="text" ></td>
						<td>Marks Obtained Chemistry %<span style="color:#F00">*</span></td>
						<td><input type="text" name="che_marks" id="che_marks"></td>
					</tr>

					<tr>
						<td>Marks Obtained Math % <span style="color:#F00">*</span></td>
						<td><input id="math_marks" name="math_marks" type="text" ></td>
						<td>Marks Obtained Bio %<span style="color:#F00">*</span></td>
						<td><input type="text" name="bio_marks" id="bio_marks"></td>
					</tr>

					<tr>
						<td>Marks Obtained Physics % <span style="color:#F00">*</span></td>
						<td><input id="phy_marks" name="phy_marks" type="text" ></td>
						<td>Marks Obtained Science %<span style="color:#F00">*</span></td>
						<td><input type="text" name="science_marks" id="science_marks"></td>
					</tr>

					<tr>
						<td>School Address <span style="color:#F00">*</span></td>
						<td><textarea name="school_address" id="school_address"></textarea></td>
						<td>Mark Sheet<br><br>Pincode<span style="color:#F00">*</span></td>
						<td>
							<input type="file" accept=".jpeg,.jpg,.png,.gif" multiple="" name="mark_sheet[]" id="mark_sheet" class="file-box">
							<br><br><input type="text" name="school_pincode" id="school_pincode">
						</td>
					</tr>

					</table>
				</div>
			</td>
		</tr>
	</table>
</div>


<div class="tab-pane" id="education_tab">
	<table class="table table-striped table-bordered bootstrap-datatable" >
		<tr><td style=" text-align:center"><h3>GUARDIAN</h3></td></tr>
		<tr>
			<td>
				<div class="add_more_edu_list" id="add_more_edu_0">
					<table class="table table-striped table-bordered bootstrap-datatable datatable" >
						<tr>
							<td>Father's Name <span style="color:#F00">*</span></td>
							<td><input id="father_name" name="father_name" type="text"></td>
							<td>Father's Occupation<span style="color:#F00">*</span></td>
							<td><input type="text" id="father_occupation" name="father_occupation"></td>
						</tr>

						<tr>
							<td>Mother's Name<span style="color:#F00">*</span></td>
							<td><input type="text" id="mother_name" name="mother_name"></td>
							<td>Mother's Occupation<span style="color:#F00">*</span></td>
							<td><input type="text" id="mother_occupation" name="mother_occupation"></td>
						</tr>

						<tr>
							<td>Mobile No  <span style="color:#F00">*</span></td>
							<td><input type="text" id="father_mobile_no" name="father_mobile_no"></td>
							<td>Email-Id<span style="color:#F00">*</span></td>
							<td><input type="email" id="mother_mobile_no" name="mother_mobile_no"></td>
						</tr>


					</table>
				</div>
			</td>
		</tr>
	</table>
</div>


<div class="tab-pane" id="chember_tab">
	<table class="table table-striped table-bordered bootstrap-datatable" >
		<tr><td style=" text-align:center"><h3>ADDRESS</h3></td></tr>
		<tr>
			<td>
				<div class="add_more_chamber_list" id="add_more_chamber_0">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tr>
							<td>Address1<span style="color:#F00">*</span></td>
							<td><textarea type="textarea" id="address1" name="address1"></textarea></td>
							<td>Address2</td>
							<td><textarea type="textarea" id="address2" name="address2"></textarea></td>
						</tr>

						<tr>
							<td>State<span style="color:#F00">*</span></td>
							<td>
								<input type="hidden" value="" id="hidden_state_name" name="hidden_state_name"> </input>
								<select name="state" id="state" onchange="return change_city(this.value);" onkeyup="return change_city(this.value);">
									<option value="0">---Select State---</option>
									<?php
										foreach ($state as $state_name)
										{
									?>
										<option value="<?php echo $state_name->state_code;?>"><?php echo $state_name->state;?></option>
									<?php
										}
									?>
								</select>
							</td>
							<td>City<span style="color:#F00">*</span></td>
							<td>
								<select name="city" id="city">
									<option value="0">---Select City---</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>Pincode<span style="color:#F00">*</span></td>
							<td><input type="text" name="pincode" id="pincode"></td>
							<td>Land Line Number</td>
							<td> <input type="text" name="home_number" id="home_number"></td>
						</tr>



					</table>
				</div>
			</td>
		</tr>
	</table>
</div>



						<!--<div class="tab-pane" id="experience_tab">

							<table class="table table-striped table-bordered bootstrap-datatable" >
								<tr><td style=" text-align:center"><h3>CURRENT EXPERIENCE</h3></td></tr>
								<tr>

									<td>
										<div class="add_more_experience_list" id="add_more_experience_0">
											<table class="table table-striped table-bordered bootstrap-datatable datatable add_more_exp" id="add_more_exp">
												<tr><td rowspan="2" class="tdwidth" id="experience_count_0">EXPERIENCE 1</td>
													<td ><textarea class="autogrow" id="experience_details_0" name="experience_details[]" placeholder="Please enter experience details" style="height: 84px; margin: 0px; width: 400px;"></textarea></td>
													<td rowspan="2" class="tdwidth2"><img class="cursor" id="experience_add_more_or_delete_id_0" src="<?php /*echo base_url()*/?>images/plus.png" onclick="add_more_experience();"></td>
												</tr></table></div>

									</td>
								</tr>
							</table>

						</div>

						<div class="tab-pane" id="awards_and_recognitions_tab">
							<table class="table table-striped table-bordered bootstrap-datatable" >
								<tr><td style=" text-align:center"><h3>AWARDS AND RECOGNITIONS</h3></td></tr>
								<tr>

									<td>

										<div class="add_more_awards_list" id="add_more_awards_0">
											<table class="table table-striped table-bordered bootstrap-datatable datatable">
												<tr><td rowspan="2" class="tdwidth" id="awards_count_0">AWARDS AND RECOGNITIONS 1</td>
													<td><textarea class="autogrow" id="awards_details_0" name="awards_details[]" placeholder="Please enter awards and recognitions details" style="height: 84px; margin: 0px; width: 400px;"></textarea></td>
													<td rowspan="2" class="tdwidth2"><img class="cursor" id="awards_add_more_or_delete_id_0" src="<?php /*echo base_url()*/?>images/plus.png" onclick="add_more_awards();"></td>
												</tr></table></div>

									</td>
								</tr>
							</table>
						</div>


						<div class="tab-pane" id="membership_tab_tab">
							<table class="table table-striped table-bordered bootstrap-datatable" >
								<tr><td style=" text-align:center"><h3>MEMBERSHIP</h3></td></tr>
								<tr>

									<td>

										<div class="add_more_membership_list" id="add_more_membership_0">
											<table class="table table-striped table-bordered bootstrap-datatable datatable add">
												<tr><td rowspan="2" class="tdwidth" id="membership_count_0">MEMBERSHIPS 1</td>
													<td ><textarea class="autogrow" id="memberships_details_0" name="memberships_details[]" placeholder="Please enter memberships details" style="height: 84px; margin: 0px; width: 400px;"></textarea></td>
													<td rowspan="2" class="tdwidth2"><img class="cursor" id="membership_add_more_or_delete_id_0" src="<?php /*echo base_url()*/?>images/plus.png" onclick="add_more_membership();"></td>
												</tr></table></div>

									</td>
								</tr>
							</table>

						</div>







						<div class="tab-pane" id="specialization_tab_tab">


							<table class="table table-striped table-bordered bootstrap-datatable" >
								<tr><td style=" text-align:center"><h3>SPECIALIZATIONS</h3></td></tr>
								<tr>

									<td>

										<div class="" id="">
											<table class="table table-striped table-bordered bootstrap-datatable datatable add">
												<tr>
													<td rowspan="2" class="tdwidth" id="">SPECIALIZATIONS</td>
													<td>





														<div>
															<input type="text" id="services-input-local-exclude" name="mul_selected_services" placeholder="Multi select" />
															<!--START MANAGE MULTISELCT -->
															<script type="text/javascript" src="<?php /*echo base_url(); */?>manage-multi-select/js/jquery.tokeninput.js"></script>
															<link rel="stylesheet" href="<?php /*echo base_url(); */?>manage-multi-select/css/token-input.css" type="text/css" />
															<link rel="stylesheet" href="<?php /*echo base_url(); */?>manage-multi-select/css/token-input-facebook.css" type="text/css" />
															<!--END MANAGE MULTISELCT -->
															<script type="text/javascript">
																$(document).ready(function()
																{
																	$("#services-input-local-exclude").tokenInput(base_url+"index.php/specialization_autocomplete", {

																		allowFreeTagging: true


																	});

																});
															</script>
														</div>





														<div class="controls doctor_form ">
															<!--<div id="error_specialisation" style="width: 29%">-->
															<!--
													 <select id="specialization_id" name="specialization_id[]" multiple data-rel="chosen" >
																										  <?php /*foreach($specialization as $row) {*/?>
																										  <option value="<?php /*echo $row->specialization_id */?>"><?php /*echo $row->specialization_name */?></option>
																										  <?php /*} */?>
																										  </select>-->

															<!--  </div>-->
													</td>
												</tr>
											</table>
										</div>

									</td>
								</tr>
							</table>







						</div>
	<ul class="breadcrumb">
		<li>
			<input class="btn btn-primary" type="submit" onclick="return validate_add_doctor()" value="Submit"  >

		</li>
		<li>
			<input class="btn btn-primary" type="button" value="Refresh" onclick="javascript: location.reload();">

		</li>
		<li>
			<input class="btn btn-primary" type="button" value="Back"  onclick="javascript: window.history.back();">

		</li>
	</ul>

						</form>



					</div>
					<!--/span-->

				</div>
				<!--/row-->

				<!-- content ends -->
			</div>
			<input type="hidden" id="equivalent_all_product_id_store" name="equivalent_all_product_id_store" value="" />

			<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/image_add.js" ></script>

			<script type="text/javascript" src="<?php echo base_url(); ?>tiny_mce/tiny_mce_src.js" ></script>

			<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/check_email_availability.js" ></script>
	<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


			<script language="javascript" type="text/javascript">
				/*jQuery(document).ready(function() {
					addTinyMCE("user_details");

				});*/
				$( "#dob" ).datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat:"dd/mm/yy",
					showAnim: "slide",
					yearRange: '1960:2016'
				});
				function change_city(id)
				{
					//alert(id);
					var a = $( "#state option:selected" ).text();
					//alert($("#state option:selected", $(this)).text());
					$('#hidden_state_name').val(a);
					$("#city").load('<?php echo base_url();?>index.php/home/city_ajax/'+id);
				}

				

			</script>

			


			<script>
				



				$(".dropdownc dd ul li a").on('click', function()
				{
					$(".dropdownc dd ul").hide();
				});
				

			</script>
			<script>

				function user_validate_email(id)
				{
					var email = $.trim($('#uesr_email_'+ id).val());
					if(email==''){
						$("#email_message_"+id).text("Please enter email");
						$("#email_message_"+id).show();
						$('#uesr_email_'+id).removeClass('black_border').addClass('red_border');
						return false;
					}

					if(!isEmail(email))
					{
						$("#email_message_"+id).text("Please enter valid email");
						$("#email_message_"+id).show();
						$('#uesr_email_'+id).removeClass('black_border').addClass('red_border');
						return false;
					}

					var bAvailable =false;
					var dataString = 'email='+ email ;
					$.ajax({
						type: "POST",
						dataType:'json',
						url:'add_hospital/check_contact_email_availability',
						data: dataString,
						async: false,
						success: function(data) {
							console.log(data.Available);
							bAvailable=data.Available;

						}
					});

					if(bAvailable)
					{
						$('#uesr_email_'+id).removeClass('red_border').addClass('black_border');
						$("#email_message_"+id).hide();
						return true;
					}
					else
					{
						$("#email_message_"+id).text("Not Available");
						$("#email_message_"+id).show();
						$('#uesr_email_'+id).removeClass('black_border').addClass('red_border');
						return false;
					}

				}


			</script>


