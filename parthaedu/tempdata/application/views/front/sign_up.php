<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.js"></script>
<section id="mc-section-1" class="mc-section-1 section">
<div class="container">
<div class="row">
 

<div class="col-md-5 float-left">
    <div class="register-logo">
        <img src="<?php echo base_url();?>frontend_assest/images/logo-head.png" alt="">
    </div>
</div>


    <div class="col-md-7 float-right registration-form-box1">
      <div class="mc-section-1-content-1"> 
       <form method="post" action="<?php echo base_url('index.php/home/insert_student_data');?>" enctype="multipart/form-data"> 
        <h2 class="big text-align">Student add new record</h2>
     

            <div class="table-asignment" id="tabs">
                <div class="nav-tabs-wrap" id="">
                     <ul class="nav nav-tabs" role="tablist" id="active_inactive">
                        <li class="active"><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li>
                        <li><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li>
                        <li><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li>
                        <li><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>
                        <li class="tabs-hr" style="left: 0px; width: 113px;"></li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- MY SUBMISSIONS -->
                    <div class="tab-pane fade in active" id="tabs-1">
                    <div class="full-section" id='t1'>
                        <div class="col-md-6 registration-form-box padding-left">
                            <p> First Name</p>
                            <input type="text" name="first_name" id="first_name">
                            <span id="show_first_name" style="color:red"></span>

                            <p> E-mail</p>
                            <input type="text" name="email" id="st_email" onblur="emailvali();">
                            <span id="show_email" style="color:red"></span>
                            <span id="show_st_email_error" style="display:none ;color:red">Please Enter Valid Email</span>

                            <p> Photo</p>
                            <input type="file" class="file-box" name="profile_pic[]" id="profile_pic">

                            <p class="margin-top"> Gender</p>
                            <label>Male</label>
                            <input type="radio" class="width1" name="gender" value="male" checked>
                            <label>Female</label>
                            <input type="radio" class="width1" name="gender" value="female">

                            <p> Date Of Birth</p>
                            <input type="text" name="dob" id="dob">
                            <span id="show_dob" style="color:red"></span>
                        </div>

                        <div class="col-md-6 registration-form-box padding-right">
                            <p> Last Name</p>
                            <input type="text" name="last_name" id="last_name">
                            <span id="show_last_name"  style="color:red"></span>
                            <p> Mobile No</p>
                            <input type="text" name="student_mobile_number" id="student_mobile_number" maxlength="10" onKeyPress="return onlyNos4(event,this);" autocomplete="off">
                            <span id="show_mobile"  style="color:red"></span>
                            <p> Stream</p>
                            <select name="stream" id="stream">
                                <option value="0">---Stream---</option>
                                <option value="engineering">Engineering</option>
                                <option value="medical">Medical</option>
                            </select>
                            <span id="show_stream" style="color:red"></span>

                            <p> Category</p>
                            <select name="category" id="category">
                                <option value="0">---Select Category</option>
                                <option value="sc">SC</option>
                                <option value="st">ST</option>
                                <option value="obc">OBC</option>
                                <option value="general">GENERAL</option>
                            </select>
                            <span id="show_category" style="color:red"></span>

                            <p> Addmission In Class</p>
                            <select name="addmission_class" id="addmission_class">
                                <option value="0">---Select Class---</option>
                                <?php
                                foreach ($class as $cn) {
                                    ?>
                                    <option value="<?php echo $cn->class_name;?>"><?php echo $cn->class_name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span id="show_class" style="color:red"></span>
                        </div>
                        <div class="clear"></div>
                        </div>
                      
                    <input type="button"  id="nextBtn" value="Next" class="mc-btn-4 btn-style-1" onclick="tab_1();activeSignUp();">
                   
                      <!-- <input type="button" id="btn_back"  value="Back" class="mc-btn-4 btn-style-1">
                       <input type="button" value="Next" id="btn_pre" class="mc-btn-4 btn-style-1" onclick="return a();">-->

                    </div>

                    <div class="tab-pane fade" id="tabs-2">
                    <div class="full-section">
                        <div class="col-md-6 registration-form-box padding-left">
                            <p> School Name</p>
                            <input type="text" id="school_name" name="school_name">
                            <span id="show_school_name" style="color:red"></span>
                            <p> School week Off</p>
                            <input type="text" id="week_day" id="week_day">
                            <span id="show_week_day" style="color:red"></span>

                            <p>Marks Obtained Total %</p>
                            <input type="text" id="total_marks" name="total_marks">
                            <span id="show_total_marks" style="color:red"></span>
                            <p> Marks Obtained Math % </p>
                            <input type="text" id="math_marks" name="math_marks">
                            <span id="show_math" style="color:red"></span>
                            <p> Marks Obtained Physics %</p>
                            <input type="text" id="phy_marks" name="phy_marks">
                            <span id="show_phy" style="color:red"></span>
                            <p>School Address</p>
                            <textarea id="school_address" name="school_address" ></textarea>
                            <span id="show_school_address" style="color:red"></span>
                             <p>School Pin Code</p>
                            <input type="text"  id="school_pin_code"  name="school_pin_code" >
                            <span id="show_school_pin_code" style="color:red"></span>
                        </div>

                        <div class="col-md-6 registration-form-box padding-right">
                             <p> School Timing</p>
                            <input type="text" name="school_timing" id="school_timing">
                            <span id="show_school_timing" style="color:red"></span>
                            <p> Board</p>
                            <select name="board" id="board">
                            <option value="0">---Select Board---</option>
                            <option value="cbsc">CBSC</option>
                            <option value="icsc">ICSC</option>
                            <option value="isc">ISC</option>
                            <option value="hs">HS</option>
                            <option value="wb">WB</option>
                            <option value="other">OTHER</option>
                            </select>
                            <span id="show_board" style="color:red"></span>
                            <p>Marks Obtained Chemistry %</p>
                            <input type="text" id="che_marks" name="che_marks">
                            <span id="show_che" style="color:red"></span>
                            <p>Marks Obtained Bio %</p>
                            <input type="text" name="bio_marks" id="bio_marks">
                            <span id="show_bio" style="color:red"></span>
                            <p> Marks Obtained Science %</p>
                            <input type="text" id="science_marks" name="science_marks">
                            <span id="show_science" style="color:red"></span>

                            <p> Mark Sheet</p>
                            <input type="file" class="file-box" id="mark_sheet"  name="mark_sheet[]" multiple  accept=".jpeg,.jpg,.png,.gif">
                            <span id="show_mark_sheet" style="color:red"></span>
                           
                        </div>

                        <div class="clear"></div>
                        </div>
                         <input type="button" id="btnPrevious" id="prevBtn" value="Previous" class="mc-btn-4 btn-style-1" onclick="activeSignUp3();"/>
                    <input type="button"  id="nextBtn" value="Next" class="mc-btn-4 btn-style-1" onclick="tab_2();activeSignUp1();">
                  
                     <!--  <input type="button" value="Back" id="btn_back"  class="mc-btn-4 btn-style-1">
                       <input type="button" value="Next" id="btn_pre" class="mc-btn-4 btn-style-1" onclick="return a();">-->

                    </div>
                    <!-- END / MY SUBMISSIONS -->

                    <div class="tab-pane fade" id="tabs-3">
                    <div class="full-section">
                       <div class="col-md-6 registration-form-box padding-left">
                            <p> Father's Name </p>
                            <input type="text" name="father_name" id="father_name">
                            <span id="show_fathername" style="color:red"></span>
                            <p> Mother's Name</p>
                            <input type="text" name="mother_name" id="mother_name">
                            <span id="show_mothename" style="color:red"></span>
                            <p>Father Mobile No<!-- Guardian Mobile--> </p>
                            <input type="text" name="guardian_mobile_no" id="guardian_mobile_no">
                            <span id="show_guardian_mobile" style="color:red"></span>
                        </div>
                        <div class="col-md-6 registration-form-box padding-right">
                            <p> Father's Occupation </p>
                            <input type="text" name="father_occupation" id="father_occupation">
                            <span id="show_fathe_occupation" style="color:red"></span>
                             <p> Mother's Occupation</p>
                            <input type="text" name="mother_occupation" id="mother_occupation">
                            <span id="show_mother_occupation" style="color:red"></span>
                            <p>Mother Mobile No <!--Phone No--></p>
                            <input type="text" name="parent_number" id="parent_number">

                        </div>

                        <div class="clear"></div>
                    </div>
                     <input type="button" id="btnPrevious" id="prevBtn" value="Previous" class="mc-btn-4 btn-style-1" onclick="activeSignUp4();"/>
                    <input type="button"  id="nextBtn" value="Next" class="mc-btn-4 btn-style-1" onclick="tab_3();activeSignUp2();">
                                         <!-- <input type="button" value="Back" id="btn_back" class="mc-btn-4 btn-style-1">
                       <input type="button" value="Next" id="btn_pre" class="mc-btn-4 btn-style-1" onclick="return a();">-->

                    </div>

                    <!-- END / MY SUBMISSIONS -->

                    <div class="tab-pane fade" id="tabs-4">
                    
                    <div class="full-section">
                        <div class="col-md-6 registration-form-box padding-left">
                            <p>Address1</p>
                            <textarea name="address1" id="address1" type="textarea" ></textarea>
                            <span id="show_address1" style="color:red"></span>
                            <p>State</p>
                            <input type="hidden" value="" id="hidden_state_name" name="hidden_state_name"> </input>
                            <select name="state" id="state" onchange="return change_city(this.value);" onkeyup="return change_city(this.value);">

                                <option value="0">---Select State---</option>
                                <?php
                                foreach ($state as $state_name) {

                                ?>
                                <option value="<?php echo $state_name->state_code;?>"><?php echo $state_name->state;?></option>
                                <?php
                            		}
                                ?>
                            </select>
                            <span id="show_state" style="color:red"></span>
                            <p>Pincode</p>
                            <input type="text" name="pincode" id="pincode">
                            <span id="show_pincode" style="color:red"></span>
                        </div>
                        
                        <div class="col-md-6 registration-form-box padding-right">
                            <p>Address2</p>
                            <textarea name="address2" id="address2" type="textarea" ></textarea>
                             <p>City</p>
                            <select name="city" id="city">
                                <option value="0">---Select City---</option>

                            </select>
                            <span id="show_city" style="color:red"></span>
                            <p>Land Line Number</p>
                            <input type="text" name="home_number" id="home_number">

                       </div>

                       <div class="clear"></div>
                     </div>
                        </form>
                         <input type="button" id="btnPrevious" id="prevBtn" value="Previous" class="mc-btn-4 btn-style-1" onclick="activeSignUp5();"/>
                   
                    <input type="submit"  value="Register" class="mc-btn-4 btn-style-1" onclick="return a();">
                    <!--   <input type="button" value="Back" id="btn_back"  class="mc-btn-4 btn-style-1">
      
                       <input type="button" value="Register"  class="mc-btn-4 btn-style-1" onclick="return a();">-->

                    </div>

                     <!-- MY SUBMISSIONS -->

                    <div class="clear"></div>

                </div>

            </div>
            <div class="clear"></div> 
                    </div>
                 	<input type="hidden" name="div_count" id="div_count" value="0" />
    				
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">

 function activeSignUp(){

     if($.trim($("#first_name").val())!="")
         if($.trim($("#last_name").val())!="")
             if($.trim($("#st_email").val())!="")
                 if($.trim($("#student_mobile_number").val())!="")
                     if($.trim($("#stream").val())!= 0)
                         if($.trim($("#category").val())!=0)
                             if($.trim($("#dob").val())!="")
                                 if($.trim($("#addmission_class").val())!= 0){

         var html_set= ' <li><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li class="active"><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';
         $("#active_inactive").html(html_set);
         $("#tabs-1").toggleClass('tab-pane fade  tab-pane fade in active');
         $("#tabs-2").toggleClass('tab-pane fade in active  tab-pane fade');
     }

  

 }
  function activeSignUp1(){
      if($.trim($("#school_name").val())!="")
          if($.trim($("#school_timing").val())!="")
              if($.trim($("#week_day").val())!="")
                  if($.trim($("#board").val())!= 0)
                      if($.trim($("#total_marks").val())!="")
                          if($.trim($("#che_marks").val())!="")
                              if($.trim($("#math_marks").val())!="")
                                  if($.trim($("#bio_marks").val())!="")
                                      if($.trim($("#phy_marks").val())!="")
                                          if($.trim($("#science_marks").val())!="")
                                              if($.trim($("#school_address").val())!=""){
          var html_set= ' <li><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li ><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li class="active"><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';

          $("#active_inactive").html(html_set);
          $("#tabs-2").toggleClass('tab-pane fade  tab-pane fade in active');
          $("#tabs-3").toggleClass('tab-pane fade in active  tab-pane fade');
      }

 }
  function activeSignUp2(){
      if($.trim($("#father_name").val())!="")
          if($.trim($("#father_occupation").val())!="")
              if($.trim($("#mother_name").val())!="")
                  if($.trim($("#mother_occupation").val())!="")
                      if($.trim($("#guardian_mobile_no").val())!="") {
                          var html_set = ' <li><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li ><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li class="active"><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';

                          $("#active_inactive").html(html_set);
                          $("#tabs-3").toggleClass('tab-pane fade  tab-pane fade in active');
                          $("#tabs-4").toggleClass('tab-pane fade in active  tab-pane fade');
                      }
 }
 
 
 
 function activeSignUp3(){
     if($.trim($("#address1").val())!="")
         if($.trim($("#state").val())!=0)
             if($.trim($("#city").val())!=0)
                 if($.trim($("#pincode").val())!="") {
                     var html_set = ' <li class="active"><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li ><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';

                     $("#active_inactive").html(html_set);
                     $("#tabs-2").toggleClass('tab-pane fade  tab-pane fade in active');
                     $("#tabs-1").toggleClass('tab-pane fade in active  tab-pane fade');
                 }
 }



  function activeSignUp4(){
   var html_set= ' <li><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li class="active"><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li ><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';
  
   $("#active_inactive").html(html_set);
      $("#tabs-3").toggleClass('tab-pane fade  tab-pane fade in active');
      $("#tabs-2").toggleClass('tab-pane fade in active  tab-pane fade');
 }
  function activeSignUp5(){
   var html_set= ' <li><a href="#tabs-1" role="tab" data-toggle="tab" onclick="showStuff(this)">Student Record</a></li><li ><a href="#tabs-2" role="tab" data-toggle="tab" onclick="showStuff(this)">Schooling</a></li><li class="active"><a href="#tabs-3" role="tab" data-toggle="tab" onclick="showStuff(this)">Guardian</a></li><li ><a href="#tabs-4" role="tab" data-toggle="tab" onclick="showStuff(this)">Address</a></li>';
  
   $("#active_inactive").html(html_set);
      $("#tabs-4").toggleClass('tab-pane fade  tab-pane fade in active');
      $("#tabs-3").toggleClass('tab-pane fade in active  tab-pane fade');
 }


    
</script>


  
      <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script>
      
         
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
      <script type="text/javascript">

function tab_1()
{
	  if($.trim($("#first_name").val())=="")
    {
        $("#show_first_name").text('Please enter Your First Name');
        $("#show_first_name").show();
        $("#first_name").focus();
        return false;
    }
    else
    {
        $("#show_first_name").text('');
        $("#show_first_name").hide();
    }

    if($.trim($("#last_name").val())=="")
	{	
        $("#show_last_name").text('Please enter Your Last Name');
        $("#show_last_name").show();
        $("#last_name").focus();
        return false;
    }
    else
    {
        $("#show_last_name").text('');
        $("#show_last_name").hide();
    }

    if($.trim($("#st_email").val())=="")
	{	
        $("#st_email").text('Please enter Your Email');
        $("#show_email").show();
        $("#st_email").focus();
        return false;
    }
    else
    {    
        $("#show_email").text('');
        $("#show_email").hide();
    }
     if($.trim($("#student_mobile_number").val())=="")
	{	
        $("#show_mobile").text('Please enter Your Mobile Number');
        $("#show_mobile").show();
        $("#student_mobile_number").focus();
        return false;
    }
    else
    {
        $("#show_mobile").text('');
        $("#show_mobile").hide();
    }

    if($.trim($("#stream").val())== 0)
    {
        $("#show_stream").text('Please Select Your Stream');
        $("#show_stream").show();
        $("#stream").focus();
        return false;
    }
    else
    {
        $("#show_stream").text('');
        $("#show_stream").hide();
    }

    if($.trim($("#category").val())==0)
    {
        $("#show_category").text('Please Select Category');
        $("#show_category").show();
        $("#show_category").focus();
        return false;
    }
    else
    {
        $("#show_category").text('');
        $("#show_category").hide();
    }

    if($.trim($("#dob").val())=="")
    {
        $("#show_dob").text('Please Enter Your Data of Birth');
        $("#show_dob").show();
        $("#dob").focus();
        return false;
    }

    else
    {
        $("#show_dob").text('');
        $("#show_dob").hide();
    }

    if($.trim($("#addmission_class").val())== 0)
    {
        $("#show_class").text('Please Select Class');
        $("#show_class").show();
        $("#addmission_class").focus();
        return false;
    }
    else
    {
        $("#show_class").text('');
        $("#show_class").hide();
    }
}
function  tab_2()
{
    if($.trim($("#school_name").val())=="")
    {
        $("#show_school_name").text('Please Enter Your School Name');
        $("#show_school_name").show();
        $("#school_name").focus();
        return false;
    }
    else
    {
        $("#show_school_name").text('');
        $("#show_school_name").hide();
    }
    if($.trim($("#school_timing").val())=="")
    {
        $("#show_school_timing").text('Please Enter Your School Timing');
        $("#show_school_timing").show();
        $("#school_timing").focus();
        return false;
    }
    else
    {
        $("#show_school_timing").text('');
        $("#show_school_timing").hide();
    }
    if($.trim($("#week_day").val())=="")
    {
        $("#show_week_day").text('Please Enter School Week Day');
        $("#show_week_day").show();
        $("#week_day").focus();
        return false;
    }
    else
    {
        $("#show_week_day").text('');
        $("#show_week_day").hide();
    }


    if($.trim($("#board").val())== 0)
    {
        $("#show_board").text('Please Select Your Board');
        $("#show_board").show();
        $("#board").focus();
        return false;
    }
    else
    {
        $("#show_board").text('');
        $("#show_board").hide();
    }

    if($.trim($("#total_marks").val())=="")
    {
        $("#show_total_marks").text('Please Enter Total Marks');
        $("#show_total_marks").show();
        $("#total_marks").focus();
        return false;
    }
    else
    {
        $("#show_total_marks").text('');
        $("#show_total_marks").hide();
    }

    if($.trim($("#che_marks").val())=="")
    {
        $("#show_che").text('Please Enter Your Chemistry Marks');
        $("#show_che").show();
        $("#che_marks").focus();
        return false;
    }
    else
    {
        $("#show_che").text('');
        $("#show_che").hide();
    }

    if($.trim($("#math_marks").val())=="")
    {
        $("#show_math").text('Please Enter Your Math Marks');
        $("#show_math").show();
        $("#math_marks").focus();
        return false;
    }
    else
    {
        $("#show_math").text('');
        $("#show_math").hide();
    }

    if($.trim($("#bio_marks").val())=="")
    {
        $("#show_bio").text('Please Enter Your Biology Marks');
        $("#show_bio").show();
        $("#bio_marks").focus();
        return false;
    }
    else
    {
        $("#show_bio").text('');
        $("#show_bio").hide();
    }
    if($.trim($("#phy_marks").val())=="")
    {
        $("#show_phy").text('Please Enter Your Physics Marks');
        $("#show_phy").show();
        $("#phy_marks").focus();
        return false;
    }
    else
    {
        $("#show_phy").text('');
        $("#show_phy").hide();
    }

    if($.trim($("#science_marks").val())=="")
    {
        $("#show_science").text('Please Enter Your Science Marks');
        $("#show_science").show();
        $("#science_marks").focus();
        return false;
    }
    else
    {
        $("#show_science").text('');
        $("#show_science").hide();
    }
    if($.trim($("#school_address").val())=="")
    {
        $("#show_school_address").text('Please Enter School Address');
        $("#show_school_address").show();
        $("#school_address").focus();
        return false;
    }
    else
    {
        $("#show_school_address").text('');
        $("#show_school_address").hide();
    }

}

function tab_3()
{
    if($.trim($("#father_name").val())=="")
    {
        $("#show_fathername").text('Please Enter father Name');
        $("#show_fathername").show();
        $("#father_name").focus();
        return false;
    }
    else
    {
        $("#show_fathername").text('');
        $("#show_fathername").hide();
    }

    if($.trim($("#father_occupation").val())=="")
    {
        $("#show_fathe_occupation").text('Please Enter father Occupation');
        $("#show_fathe_occupation").show();
        $("#father_occupation").focus();
        return false;
    }
    else
    {
        $("#show_fathe_occupation").text('');
        $("#show_fathe_occupation").hide();
    }
    if($.trim($("#mother_name").val())=="")
    {
        $("#show_mothename").text('Please Enter Mother Name');
        $("#show_mothename").show();
        $("#mother_name").focus();
        return false;
    }
    else
    {
        $("#show_mothename").text('');
        $("#show_mothename").hide();
    }
    if($.trim($("#mother_occupation").val())=="")
    {
        $("#show_mother_occupation").text('Please Enter Mother Occupation');
        $("#show_mother_occupation").show();
        $("#mother_occupation").focus();
        return false;
    }
    else
    {
        $("#show_mother_occupation").text('');
        $("#show_mother_occupation").hide();
    }

    if($.trim($("#guardian_mobile_no").val())=="")
    {
        $("#show_guardian_mobile").text('Please Enter Guardian Mobile Number');
        $("#show_guardian_mobile").show();
        $("#guardian_mobile_no").focus();
        return false;
    }
    else
    {
        $("#show_guardian_mobile").text('');
        $("#show_guardian_mobile").hide();
    }
}



function tab_4()
{
    if($.trim($("#address1").val())=="")
    {
        $("#show_address1").text('Please Enter Address');
        $("#show_address1").show();
        $("#address1").focus();
        return false;
    }
    else
    {
        $("#show_address1").text('');
        $("#show_address1").hide();
    }

    if($.trim($("#state").val())==0)
    {
        $("#show_state").text('Please Select State');
        $("#show_state").show();
        $("#state").focus();
        return false;
    }
    else
    {
        $("#show_state").text('');
        $("#show_state").hide();
    }

    if($.trim($("#city").val())==0)
    {
        $("#show_city").text('Please Select City');
        $("#show_city").show();
        $("#city").focus();
        return false;
    }
    else
    {
        $("#show_city").text('');
        $("#show_city").hide();
    }

    if($.trim($("#pincode").val())=="")
    {
        $("#show_pincode").text('Please Enter Pincode');
        $("#show_pincode").show();
        $("#pincode").focus();
        return false;
    }
    else
    {
        $("#show_pincode").text('');
        $("#show_pincode").hide();
    }
}



function a()
{
	if($.trim($("#first_name").val())=="")
	{	
        $("#show_first_name").text('Please enter Your First Name');
        $("#show_first_name").show();
        $("#first_name").focus();
        return false;
    }
    else
    {
        $("#show_first_name").text('');
        $("#show_first_name").hide();
    }

    if($.trim($("#last_name").val())=="")
	{	
        $("#show_last_name").text('Please enter Your Last Name');
        $("#show_last_name").show();
        $("#last_name").focus();
        return false;
    }
    else
    {
        $("#show_last_name").text('');
        $("#show_last_name").hide();
    }

    if($.trim($("#st_email").val())=="")
	{	
        $("#st_email").text('Please enter Your Email');
        $("#show_email").show();
        $("#st_email").focus();
        return false;
    }
    else
    {    
        $("#show_email").text('');
        $("#show_email").hide();
    }
     if($.trim($("#student_mobile_number").val())=="")
	{	
        $("#show_mobile").text('Please enter Your Mobile Number');
        $("#show_mobile").show();
        $("#student_mobile_number").focus();
        return false;
    }
    else
    {
        $("#show_mobile").text('');
        $("#show_mobile").hide();
    }

    if($.trim($("#stream").val())== 0)
    {
        $("#show_stream").text('Please Select Your Stream');
        $("#show_stream").show();
        $("#stream").focus();
        return false;
    }
    else
    {
        $("#show_stream").text('');
        $("#show_stream").hide();
    }

    if($.trim($("#category").val())==0)
    {
        $("#show_category").text('Please Select Category');
        $("#show_category").show();
        $("#show_category").focus();
        return false;
    }
    else
    {
        $("#show_category").text('');
        $("#show_category").hide();
    }

    if($.trim($("#dob").val())=="")
    {
        $("#show_dob").text('Please Enter Your Data of Birth');
        $("#show_dob").show();
        $("#dob").focus();
        return false;
    }

    else
    {
        $("#show_dob").text('');
        $("#show_dob").hide();
    }

    if($.trim($("#addmission_class").val())== 0)
    {
        $("#show_class").text('Please Select Class');
        $("#show_class").show();
        $("#addmission_class").focus();
        return false;
    }
    else
    {
        $("#show_class").text('');
        $("#show_class").hide();
    }

    if($.trim($("#school_name").val())=="")
    {
        $("#show_school_name").text('Please Enter Your School Name');
        $("#show_school_name").show();
        $("#school_name").focus();
        return false;
    }
    else
    {
        $("#show_school_name").text('');
        $("#show_school_name").hide();
    }
    if($.trim($("#school_timing").val())=="")
    {
        $("#show_school_timing").text('Please Enter Your School Timing');
        $("#show_school_timing").show();
        $("#school_timing").focus();
        return false;
    }
    else
    {
        $("#show_school_timing").text('');
        $("#show_school_timing").hide();
    }
    if($.trim($("#week_day").val())=="")
    {
        $("#show_week_day").text('Please Enter School Week Day');
        $("#show_week_day").show();
        $("#week_day").focus();
        return false;
    }
    else
    {
        $("#show_week_day").text('');
        $("#show_week_day").hide();
    }


    if($.trim($("#board").val())== 0)
    {   
        $("#show_board").text('Please Select Your Board');
        $("#show_board").show();
        $("#board").focus();
        return false;
    }
    else
    {
        $("#show_board").text('');
        $("#show_board").hide();
    }

    if($.trim($("#total_marks").val())=="")
    {   
        $("#show_total_marks").text('Please Enter Total Marks');
        $("#show_total_marks").show();
        $("#total_marks").focus();
        return false;
    }
    else
    {
        $("#show_total_marks").text('');
        $("#show_total_marks").hide();
    }   

    if($.trim($("#che_marks").val())=="")
    {   
        $("#show_che").text('Please Enter Your Chemistry Marks');
        $("#show_che").show();
        $("#che_marks").focus();
        return false;
    }
    else
    {
        $("#show_che").text('');
        $("#show_che").hide();
    } 

    if($.trim($("#math_marks").val())=="")
    {   
        $("#show_math").text('Please Enter Your Math Marks');
        $("#show_math").show();
        $("#math_marks").focus();
        return false;
    }
    else
    {
        $("#show_math").text('');
        $("#show_math").hide();
    }

     if($.trim($("#bio_marks").val())=="")
    {   
        $("#show_bio").text('Please Enter Your Biology Marks');
        $("#show_bio").show();
        $("#bio_marks").focus();
        return false;
    }
    else
    {
        $("#show_bio").text('');
        $("#show_bio").hide();
    } 
     if($.trim($("#phy_marks").val())=="")
    {   
        $("#show_phy").text('Please Enter Your Physics Marks');
        $("#show_phy").show();
        $("#phy_marks").focus();
        return false;
    }
    else
    {
        $("#show_phy").text('');
        $("#show_phy").hide();
    } 

    if($.trim($("#science_marks").val())=="")
    {   
        $("#show_science").text('Please Enter Your Science Marks');
        $("#show_science").show();
        $("#science_marks").focus();
        return false;
    }
    else
    {
        $("#show_science").text('');
        $("#show_science").hide();
    } 
    if($.trim($("#school_address").val())=="")
    {   
        $("#show_school_address").text('Please Enter School Address');
        $("#show_school_address").show();
        $("#school_address").focus();
        return false;
    }
    else
    {
        $("#show_school_address").text('');
        $("#show_school_address").hide();
    } 

   /* if($.trim($("#mark_sheet").val())=="")
    {   
        $("#show_mark_sheet").text('Please Upload Yoor Mark Sheet');
        $("#show_mark_sheet").show();
        $("#school_address").focus();
        return false;
    }
    else
    {
        $("#show_mark_sheet").text('');
        $("#show_mark_sheet").hide();
    } */

    

     if($.trim($("#father_name").val())=="")
    {   
        $("#show_fathername").text('Please Enter father Name');
        $("#show_fathername").show();
        $("#father_name").focus();
        return false;
    }
    else
    {
        $("#show_fathername").text('');
        $("#show_fathername").hide();
    }

    if($.trim($("#father_occupation").val())=="")
    {   
        $("#show_fathe_occupation").text('Please Enter father Occupation');
        $("#show_fathe_occupation").show();
        $("#father_occupation").focus();
        return false;
    }
    else
    {
        $("#show_fathe_occupation").text('');
        $("#show_fathe_occupation").hide();
    }
    if($.trim($("#mother_name").val())=="")
    {   
        $("#show_mothename").text('Please Enter Mother Name');
        $("#show_mothename").show();
        $("#mother_name").focus();
        return false;
    }
    else
    {
        $("#show_mothename").text('');
        $("#show_mothename").hide();
    }
    if($.trim($("#mother_occupation").val())=="")
    {   
        $("#show_mother_occupation").text('Please Enter Mother Occupation');
        $("#show_mother_occupation").show();
        $("#mother_occupation").focus();
        return false;
    }
    else
    {
        $("#show_mother_occupation").text('');
        $("#show_mother_occupation").hide();
    }

     if($.trim($("#guardian_mobile_no").val())=="")
    {   
        $("#show_guardian_mobile").text('Please Enter Guardian Mobile Number');
        $("#show_guardian_mobile").show();
        $("#guardian_mobile_no").focus();
        return false;
    }
    else
    {
        $("#show_guardian_mobile").text('');
        $("#show_guardian_mobile").hide();
    }

    if($.trim($("#address1").val())=="")
    {   
        $("#show_address1").text('Please Enter Address');
        $("#show_address1").show();
        $("#address1").focus();
        return false;
    }
    else
    {
        $("#show_address1").text('');
        $("#show_address1").hide();
    }

    if($.trim($("#state").val())==0)
    {   
        $("#show_state").text('Please Select State');
        $("#show_state").show();
        $("#state").focus();
        return false;
    }
    else
    {
        $("#show_state").text('');
        $("#show_state").hide();
    }

    if($.trim($("#city").val())==0)
    {   
        $("#show_city").text('Please Select City');
        $("#show_city").show();
        $("#city").focus();
        return false;
    }
    else
    {
        $("#show_city").text('');
        $("#show_city").hide();
    }

     if($.trim($("#pincode").val())=="")
    {   
        $("#show_pincode").text('Please Enter Pincode');
        $("#show_pincode").show();
        $("#pincode").focus();
        return false;
    }
    else
    {
        $("#show_pincode").text('');
        $("#show_pincode").hide();
    }
}

		</script>
<script language="Javascript" type="text/javascript">
    function emailvali()
    {
        var em=document.getElementById('st_email')
        var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (filter.test(em.value))
        {
            $("#st_email").css("borderColor", "green");
 $("#show_st_email_error").hide();
            email.focus;
            return false;
        }
        else
            $("#st_email").css("borderColor", "red");
        $("#show_st_email_error").show();
        email.focus;

        return false;
    }

    function onlyNos1(e, t)
    {
        try
        {
            if (window.event)
            {
                var charCode = window.event.keyCode;
            }
            else if (e)
            {
                var charCode = e.which;
            }
            else
            {
                return true;
            }
            if (charCode > 31 && (charCode < 48 || charCode > 57))
            {
                //alert('Please Enter Only Number');
                $("#agent_phone_no").css("borderColor", "red");
                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }



    function onlyNos3(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert('Please Enter Only Number');
                $("#mobile_no").css("borderColor", "red");

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }
    function onlyNos4(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert('Please Enter Only Number');
                $("#clinic_phone_no").css("borderColor", "red");

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }
    function onlyNos5(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert('Please Enter Only Number');
                $("#fax").css("borderColor", "red");

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }
    function onlyNos6(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert('Please Enter Only Number');
                $("#payment_amount").css("borderColor", "red");

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }


    function onlyNos7(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert('Please Enter Only Number');
                $("#postcode").css("borderColor", "red");

                return false;
            }
            return true;
        }
        catch (err) {
            alert(err.Description);
        }
    }
</script>



<style>
.full-section{ width:100%;}

</style>

