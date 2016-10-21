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
            <li> <a href="<?php echo base_url(); ?>index.php/product">Edit Student</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-globe"></i> Edit Student</h2>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <?php echo form_open_multipart('studentlist/edit_student', array('class' => 'form-horizontal', 'id' => 'user_validation_form')); ?>
                    <div>
                        <div class="alert alert-error " style="display: none">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning:</strong> Please check all the error! .
                        </div>

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
                                <?php foreach($student_data as $sd){ ?>

                                <tr>
                                    <td width="100%" style=" text-align:center"><h3>STUDENT DETAILS</h3></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                         <input type="hidden" name="student_id" value="<?php echo $sd->student_id; ?>">
                                        <?php $id = $max_id+1;
                                        if($sd->reg_no == '' && $sd->roll_no == '' ){?>
										<?php
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

										
										
										
										<?php }else{ ?>
                                               
                                                <input type="hidden"  name="student_reg_no" value="<?php echo $sd->reg_no;?>">
                                                <input type="hidden"  name="student_roll_no" value="<?php echo $sd->roll_no;?>">
												<?php }?>	


                                            <tr>
                                                <td>First Name<span style="color:#F00">*</span></td>
                                                <td><input id="first_name" name="first_name" type="text" size="500px;" value="<?php echo $sd->first_name;?>"></td>
                                                <td>Last Name<span style="color:#F00">*</span></td>
                                                <td><input type="text" name="last_name" id="last_name" value="<?php echo $sd->last_name;?>"></td>
                                            </tr>

                                            <tr>
                                                <td>E-mail<span style="color:#F00">*</span></td>
                                                <td><input id="email" name="email" type="text"  value="<?php echo $sd->student_email;?>"></td>
                                                <td>Mobile No<span style="color:#F00">*</span></td>
                                                <td><input type="text" name="student_mobile_number" id="student_mobile_number" value="<?php echo $sd->student_phone_no;?>"></td>
                                            </tr>

                                            <tr>
                                                <td>Photo</td>
                                                <?php foreach($student_pro_img as $st_pro_img) { ?>
                                                <td><a href="#" onclick="document.getElementById('profile_pic').click(); return false;"><embed src="<?php echo base_url(); ?>uploads/profile_image/<?php echo $st_pro_img->img_name;?>" width="30px" height="30px"></a>
                                                    </embed></a>
                                                    
                                                    <input id="profile_pic"  style="display: none" name="profile_pic[]" type="file" value="<?php echo $st_pro_img->img_name; ?>"></td><?php }?>
                                                <td>Stream<span style="color:#F00">*</span></td>
                                                <td>
                                                    <select id="stream" name="stream">
                                                        <option value="0">---Stream---</option>
                                                        <option value="engineering" <?php if($sd->stream == 'engineering'){echo "selected";}?>>Engineering</option>
                                                        <option value="medical" <?php if($sd->stream == 'medical'){echo "selected";}?>>Medical</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Gender<span style="color:#F00">*</span></td>
                                                <td><input type="radio" name="gender" id="gender" value="male" <?php if($sd->gender == 'male'){echo "checked";}?>>Male</label>
                                                    <input type="radio" name="gender" id="gender" value="female" style="margin: 0 0 0 5px; " <?php if($sd->gender == 'female'){echo "checked";}?>>Female</label>
                                                </td>
                                                <td>Category<span style="color:#F00">*</span></td>
                                                <td>
                                                    <select id="category" name="category">
                                                        <option value="0">---Select Category</option>
                                                        <option value="sc" <?php if($sd->category == 'sc'){echo "selected";}?>>SC</option>
                                                        <option value="st" <?php if($sd->category == 'st'){echo "selected";}?>>ST</option>
                                                        <option value="obc" <?php if($sd->category == 'obc'){echo "selected";}?>>OBC</option>
                                                        <option value="general" <?php if($sd->category == 'general'){echo "selected";}?>>GENERAL</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Date Of Birth <span style="color:#F00">*</span></td>
                                                <td><input type="text" name="dob" id="dob" value="<?php echo $sd->dob;?>"></td>
                                                <td>Addmission In Class<span style="color:#F00">*</span></td>
                                                <td>
                                                    <select name="addmission_class" id="addmission_class">
                                                        <option value="0">---Select Class---</option>
                                                        <?php
                                                        foreach ($class as $cn)
                                                        {
                                                            $class_name = $cn->class_name;
                                                            ?>
                                                            <option value="<?php echo $cn->class_name;?>"<?php if($sd->addmission_class == $class_name){echo "selected";} ?>><?php echo $cn->class_name;?></option>
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
                                                        <option value="studying" <?php if($sd->studying == 'studying'){echo "selected";} ?>>Studying</option>
                                                        <option value="passout" <?php if($sd->studying == 'passout'){echo "selected";} ?>>Passout</option>
                                                        <option value="dropout" <?php if($sd->studying == 'dropout'){echo "selected";} ?>>Dropout</option>
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
                                                    <td><input id="school_name" name="school_name" type="text" value="<?php echo $sd->school_name; ?>"></td>
                                                    <td>School Timing<span style="color:#F00">*</span></td>
                                                    <td><input type="text" name="school_timing" id="school_timing" value="<?php echo $sd->school_timing; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>School week Off<span style="color:#F00">*</span></td>
                                                    <td><input id="week_day" name="week_day" type="text" value="<?php echo $sd->school_weekoff_day; ?>"></td>
                                                    <td>Board<span style="color:#F00">*</span></td>
                                                    <td>
                                                        <select id="board" name="board">
                                                            <option value="0">---Select Board---</option>
                                                            <option value="cbsc" <?php if($sd->board == 'cbsc'){echo "selected";} ?>>CBSC</option>
                                                            <option value="icsc" <?php if($sd->board == 'icsc'){echo "selected";} ?>>ICSC</option>
                                                            <option value="isc" <?php if($sd->board == 'isc'){echo "selected";} ?>>ISC</option>
                                                            <option value="hs" <?php if($sd->board == 'hs'){echo "selected";} ?>>HS</option>
                                                            <option value="wb" <?php if($sd->board == 'wb'){echo "selected";} ?>>WB</option>
                                                            <option value="other" <?php if($sd->board == 'other'){echo "selected";} ?>>OTHER</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Marks Obtained Total %<span style="color:#F00">*</span></td>
                                                    <td><input id="total_marks" name="total_marks" type="text"  value="<?php echo $sd->total_marks; ?>"></td>
                                                    <td>Marks Obtained Chemistry %<span style="color:#F00">*</span></td>
                                                    <td><input type="text" name="che_marks" id="che_marks"  value="<?php echo $sd->che_marks; ?>"></td>
                                                </tr>

                                                <tr>
                                                    <td>Marks Obtained Math % <span style="color:#F00">*</span></td>
                                                    <td><input id="math_marks" name="math_marks" type="text"  value="<?php echo $sd->math_marks; ?>"></td>
                                                    <td>Marks Obtained Bio %<span style="color:#F00">*</span></td>
                                                    <td><input type="text" name="bio_marks" id="bio_marks"  value="<?php echo $sd->bio_marks; ?>"></td>
                                                </tr>

                                                <tr>
                                                    <td>Marks Obtained Physics % <span style="color:#F00">*</span></td>
                                                    <td><input id="phy_marks" name="phy_marks" type="text"  value="<?php echo $sd->phy_marks; ?>"></td>
                                                    <td>Marks Obtained Science %<span style="color:#F00">*</span></td>
                                                    <td><input type="text" name="science_marks" id="science_marks"  value="<?php echo $sd->science_marks; ?>"></td>
                                                </tr>

                                                <tr>
                                                    <td>School Address <span style="color:#F00">*</span></td>
                                                    <td><textarea name="school_address" id="school_address"><?php echo $sd->school_address; ?></textarea></td>
                                                    <td>Mark Sheet<br><br>Pincode<span style="color:#F00">*</span></td>
                                                    <td><?php foreach($student_mark_sheet_img as $msimg){ ?>

                                                            <a href="#" onclick="document.getElementById('file_option').click(); return false;"><embed src="<?php echo base_url(); ?>uploads/<?php echo $msimg->marks_sheet_name;?>" width="30px" height="30px"></a>
                                                            </embed></a>

                                                            <input type="hidden" name="img_id" value="<?php echo $msimg->mark_sheet_image_id;?>">
                                                        <span  style="display:none"><input type="file" id ="file_option" accept=".jpeg,.jpg,.png,.gif" multiple="" name="mark_sheet[]" value="<?php echo $msimg->marks_sheet_name;?>" class="file-box"></span>

                                                        <?php } ?>
                                                        <br><br><input type="text" name="school_pincode" id="school_pincode" value="<?php echo $sd->school_pincode;?>">
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
                                                    <td><input id="father_name" name="father_name" type="text" value="<?php echo $sd->father_name; ?>"></td>
                                                    <td>Father's Occupation<span style="color:#F00">*</span></td>
                                                    <td><input type="text" id="father_occupation" name="father_occupation" value="<?php echo $sd->father_occupation; ?>"></td>
                                                </tr>

                                                <tr>
                                                    <td>Mother's Name<span style="color:#F00">*</span></td>
                                                    <td><input type="text" id="mother_name" name="mother_name" value="<?php echo $sd->mother_name; ?>"></td>
                                                    <td>Mother's Occupation<span style="color:#F00">*</span></td>
                                                    <td><input type="text" id="mother_occupation" name="mother_occupation" value="<?php echo $sd->mother_occupation; ?>"></td>
                                                </tr>

                                                <tr>
                                                    <td>Mobile No  <span style="color:#F00">*</span></td>
                                                    <td><input type="text" id="father_mobile_no" name="father_mobile_no" value="<?php echo $sd->guardian_mobile_no; ?>"></td>
                                                    <td>Email-Id<span style="color:#F00">*</span></td>
                                                    <td><input type="email" id="mother_mobile_no" name="mother_mobile_no" value="<?php echo $sd->guardian_phone_no; ?>"></td>
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
                                                    <td><textarea type="textarea" id="address1" name="address1"><?php echo $sd->address1; ?></textarea></td>
                                                    <td>Address2</td>
                                                    <td><textarea type="textarea" id="address2" name="address2"><?php echo $sd->address2; ?></textarea></td>
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
                                                                $state_name1 = $state_name->state_code;
                                                                ?>
                                                                <option value="<?php echo $state_name->state_code;?>" <?php if($sd->state == $state_name1){echo "selected";} ?>><?php echo $state_name->state;?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>City<span style="color:#F00">*</span></td>
                                                    <td>
                                                        <select name="city" id="city">
                                                            <option value="0">---Select City---</option>
                                                            <?php foreach($city as $ci){
                                                                $city_id = $ci['city_id'];
                                                                $city_name = $ci['city'];

                                                                ?>
                                                                <option value="<?php echo $ci['city_id'];?>" <?php if($sd->city == $city_name){echo "selected";} ?>><?php echo $ci['city'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pincode<span style="color:#F00">*</span></td>
                                                    <td><input type="text" name="pincode" id="pincode" value="<?php echo $sd->pincode ; ?>"></td>
                                                    <td>Land Line Number</td>
                                                    <td> <input type="text" name="home_number" id="home_number" value="<?php echo $sd->landline_no ; ?>"></td>
                                                </tr>



                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php } ?>
                        <!--<div class="tab-pane" id="experience_tab">


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
                        <input class="btn btn-primary" type="submit" onclick="return validate_add_doctor()" value="Update"  >
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
