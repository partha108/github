    <link href="<?php echo base_url();?>assets/plugins/step-form-wizard/css/step-form-wizard.min.css" rel="stylesheet">
        <div class="page-content page-wizard">
          <div class="header">
            <h2>Add <strong>New Student Record</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Make</a>
                </li>
                <li><a href="#">Pages</a>
                </li>
                <li class="active">Form Wizard</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
             <!-- <p class="m-t-10 m-b-20 f-16">You can sort your data by column and search specific value. If you want, you can hide part of info and you can export your tables: Pdf, Excel, Print or Csv.</p>-->
              <div class="tabs tabs-linetriangle">
               <!-- <ul class="nav nav-tabs">
                  <li class="active"><a href="#style" data-toggle="tab"><span>Choose your style</span></a></li>
                  <li><a href="#navigation" data-toggle="tab"><span>Side Navigation</span></a></li>
                  <li><a href="#validation" data-toggle="tab"><span>Step Validation</span></a></li>
                </ul>-->
                <div class="tab-content">
                  <div class="tab-pane active" id="style">
                    <!--<div class="form-wizard-style">
                      <span>Click on a style to see:</span>
                      <a id="sea" class="current" href="#">Deep Sea</a>
                      <a id="sky" href="#">Night Sky</a>
                      <a id="arrow" href="#">Arrow</a>
                      <a id="simple" href="#">Simple</a>
                      <a id="circle" href="#">Circle</a>
                    </div>-->
                    <div class="wizard-div current wizard-sea">
                    <?php echo form_open_multipart("admin/admin/admission",array("class"=>"wizard","data-style"=>"sea"));?>
                      <!--<form class="wizard" data-style="sea" role="form" action="" method="post">-->
                        <fieldset>
                          <legend>Basic information</legend>
                          <div class="row">
                            <div class="col-lg-6">
                            <div class="row">
                           	   <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Enrollment No</label>
                                <input type="text" maxlength="20" name="enroll" class="form-control" placeholder="Enter Enrollment Number">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Date Of Birth</label>
                                <input type="text" name="dob" class="form-control" placeholder="YYYY-MM-DD">
                              </div>
                            </div>
                             <div class="row">
                           	   <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Enter Enrollment Number">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Enter Student Name">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email">
                              </div>
                              <div class="form-group col-md-5">
                              <label for="exampleInputEmail1">Select Gender</label>
                                 <div class="icheck-inline" style="padding-top:5px;">
                                  
                                  <label><input type="radio" name="gender" value="male" checked data-radio="iradio_minimal-blue">Male</label>
                                  <label><input type="radio" name="gender" value="female" data-radio="iradio_minimal-blue">Female</label>
                                
                                </div>
                              </div>
                            </div>  
                             <div class="row">
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Account Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                              </div>
                              
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                              </div>
                            </div>
                            
                             <div class="row">
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Contact</label>
                                <input type="text" name="mobile" maxlength="10" class="form-control" placeholder="Contact">
                              </div>
                              
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Emergency Contact</label>
                                <input type="text" name="emobile" maxlength="10" class="form-control" placeholder="Emergengy Contact">
                              </div>
                            </div>
                            
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Select Courese</label>
                               <select class="form-control" name="course" data-search="true" id="courses">
                                <option value="">Select Course</option>
                                <?php foreach($courses as $c){?>
                                <option value="<?php echo $c->id;?>"><?php echo $c->courses;?></option>
                                <?php }?>
                              </select>
                              </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Select Stream</label>
                                 <select class="form-control" name="stream" data-search="true" id="streams">
                                    <option value="">Select Stream</option>
                                  </select>
                              </div>
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Select Year</label>
                               <select class="form-control" name="year" data-search="true" id="year">
                                <option value="">Select Year</option>
                              </select>
                              </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Select Semester</label>
                               <select class="form-control" name="sem" data-search="true" id="semester">
                                <option value="">Select Semester</option>
                              </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Select Batch</label>
                               <select class="form-control" name="batch" data-search="true" id="batch">
                                <option value="">Select Batch</option>
                              </select>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              In publishing and graphic design, lorem ipsum is common placeholder text used to
                              demonstrate the graphic elements of a document or visual presentation, such as web
                              pages, typography, and graphical layout. It is a form of "greeking".
                            </div>
                          </div>
                        </fieldset>
                        <fieldset>
                          <legend>Personal information</legend>
                          <div class="row">
                            <div class="col-lg-6">
                           	<div class="row">
                           	   <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Blood Group</label>
                                <select name="bgroup"  class="form-control">
                                        <option value="select">-Select-</option> 
                                        <option value="A+"<?php //if($bood_group== 'A+'){ echo 'selected="selected"';}?>>A+</option> 
                                        <option value="B+"<?php //if($bood_group== 'B+'){ echo 'selected="selected"';}?>>B+</option> 
                                        <option value="A-"<?php //if($bood_group== 'A-'){ echo 'selected="selected"';}?>>A-</option> 
                                        <option value="B-"<?php //if($bood_group== 'B-'){ echo 'selected="selected"';}?>>B-</option> 
                                        <option value="AB+"<?php //if($bood_group== 'AB+'){ echo 'selected="selected"';}?>>AB+</option> 
                                        <option value="AB-"<?php //if($bood_group== 'AB-'){ echo 'selected="selected"';}?>>AB-</option>  
                                        <option value="O+"<?php //if($bood_group== 'O+'){ echo 'selected="selected"';}?>>O+</option>  
                                        <option value="O-"<?php //if($bood_group== 'O-'){ echo 'selected="selected"';}?>>O-</option>   
                                    </select><br/>
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="category" class="form-control">
                                        <option value="-Select-">-Select-</option>
                                        <option value="GEN"<?php ///if($category== 'GEN'){ echo 'selected="selected"';}?>>GEN</option>  
                                        <option value="SC"<?php //if($category== 'SC'){ echo 'selected="selected"';}?>>SC</option>
                                        <option value="ST"<?php //if($category== 'ST'){ echo 'selected="selected"';}?>>ST</option>
                                        <option value="OBC"<?php // if($category== 'OBC'){ echo 'selected="selected"';}?>>OBC</option>
                                        <option value="PHP"<?php //if($category== 'PHP'){ echo 'selected="selected"';}?>>PHP</option>
                                        <option value="NRI"<?php //if($category== 'NRI'){ echo 'selected="selected"';}?>>NRI</option>
                                    </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Student Photo</label>
                                <img class="img img-responsive img-circle" src="<?php echo base_url();?>assets/images/avatars/avatar7_big.png" />
                                <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="userimage" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="Student Image" readonly="">
                                </div>
                              </div>
                                 
                              </div>
                            </div>
                           
                           	   <div class="form-group">
                                <label for="exampleInputEmail1">Father's Full Name</label>
                                <input type="text" name="father" class="form-control" placeholder="Enter Father Number">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Occupation</label>
                               <select name="occ" class="form-control">
	
        <option <?php //if($father_employment_details=="-Select-"){?>selected=''<?php //}?>value="-Select-">--Select--</option>

                            <option <?php //if($father_employment_details=="Employed Government"){?>selected=''<?php //}?>value="Employed Government">Employed Government</option>

                            <option <?php //if($father_employment_details=="Employed Private"){?>selected=''<?php //}?>value="Employed Private">Employed Private</option>

                            <option <?php //if($father_employment_details=="Business"){?>selected=''<?php //}?>value="Business">Business</option>

                            <option <?php //if($father_employment_details=="Not Employed"){?>selected=''<?php //}?>value="Not Employed">Not Employed</option>

                            <option <?php //if($father_employment_details=="Not Applicable"){?>selected=''<?php //}?>value="Not Applicable">Not Applicable</option>



						</select>
                              </div>
                         <div class="form-group">
                                <label for="exampleInputEmail1">Mother's Full Name</label>
                                <input type="text" name="mother" class="form-control" placeholder="Enter Mother Number">
                              </div>
                             
                              
                             
                            
                             
                            
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Local Address</label>
                             	<textarea name="laddress" rows="3" class="form-control"></textarea>
                              </div>
                              <div class="row">
                              
                                <div class="form-group col-md-6">
                                 <!--<label for="exampleInputPassword1">Local Guardian Name</label>-->
                                <input type="text" name="gname"  placeholder="Guardian Name"  class="form-control" />
                              </div>
                                <div class="form-group col-md-6">
                                <!-- <label for="exampleInputPassword1">Guardian Contact</label>-->
                               <input type="text" name="gnumber" maxlength="10" placeholder="Contact" minlength="10" class="form-control" />
                              </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Permanent Address</label>
                             	<textarea name="paddress" rows="3" class="form-control"></textarea>
                              </div>
                               <div class="form-group">
                                <!--<label for="exampleInputPassword1">Select State</label>-->
                                 <select class="form-control" name="state" data-search="true" id="state">
                                 <option value="">Select State</option>
                                 <?php 	foreach($state as $state){?>
                                    <option value="<?php echo $state->state_id;?>"><?php echo $state->state_name;?></option>
                                  	<?php }?></select>
                              </div>
                              <div class="row">
                              
                                <div class="form-group col-md-6">
                                 <label for="exampleInputPassword1">Select City</label>
                               <select class="form-control" name="state" data-search="true" id="city">
                                <option value="">Select City</option>
                              </select>
                              </div>
                                <div class="form-group col-md-6">
                                 <label for="exampleInputPassword1">Enter Pin</label>
                               <input type="text" name="pin" maxlength="6" placeholder="6 digit pin code" minlength="6" class="form-control" />
                              </div>
                              </div>
                              
                             
                            </div>
                            <div class="col-lg-12">
                              In publishing and graphic design, lorem ipsum is common placeholder text used to
                              demonstrate the graphic elements of a document or visual presentation, such as web
                              pages, typography, and graphical layout. It is a form of "greeking".
                            </div>
                          </div>
                        </fieldset>
                        <fieldset>
                          <legend>Acedemic Details</legend>
                          <div class="row">
                            
                            <div class="col-lg-12">
                            <table class="table table-striped table-condensed">
             <thead><tr><th>Exam Name</th><th>Spec.Subject</th><th>Board/University</th><th>Institute Name</th><th>Passing Year</th><th>% Scored</th><th>Document</th></tr></thead>
             <tbody>
             <tr><td><input type="text" name="highschool" value="10th" readonly="readonly" class="form-control" /></td>
             	 <td><input type="text" name="highsub" value="All Subject" readonly="readonly" class="form-control" /></td>
                 <td><input type="text" name="highboard" class="form-control" /></td>
                 <td><input type="text" name="highins" class="form-control" /></td>
                 <td><input type="text" name="highyear" class="form-control" /></td>
                 <td><input type="text" name="highper" class="form-control" /></td>
                 <td><div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" name="highfile" class="custom-file" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div></td></tr>
              
             <tr><td><input type="text" name="higherschool" value="12th" readonly="readonly" class="form-control" /></td>
             	 <td><input type="text" name="highersub" class="form-control" /></td>
                 <td><input type="text" name="higherboard" class="form-control" /></td>
                 <td><input type="text" name="higherins" class="form-control" /></td>
                 <td><input type="text" name="higheryear" class="form-control" /></td>
                 <td><input type="text" name="higherper" class="form-control" /></td>
                 <td><div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="higherfile" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div></td></tr>
            
             <tr><td><input type="text" name="graduation" value="Graduation" readonly="readonly" class="form-control" /></td>
             	 <td><input type="text" name="grasub" class="form-control" placeholder="Stream/Branch" /></td>
                 <td><input type="text" name="graboard" class="form-control" /></td>
                 <td><input type="text" name="grains" class="form-control" /></td>
                 <td><input type="text" name="grayear" class="form-control" /></td>
                 <td><input type="text" name="graper" class="form-control" /></td>
                 <td><div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="grafile" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div></td></tr>
            
             <tr><td><input type="text" name="other1" placeholder="Other 1" class="form-control" /></td>
             	 <td><input type="text" name="other1sub" class="form-control" /></td>
                 <td><input type="text" name="other1board" class="form-control" /></td>
                 <td><input type="text" name="other1ins" class="form-control" /></td>
                 <td><input type="text" name="other1year" class="form-control" /></td>
                 <td><input type="text" name="other1per" class="form-control" /></td>
                 <td><div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="other1file" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div></td></tr>
          
            <tr><td><input type="text" name="other2" placeholder="Other 2" class="form-control" /></td>
             	<td><input type="text" name="other2sub" class="form-control" /></td>
                 <td><input type="text" name="other2board" class="form-control" /></td>
                 <td><input type="text" name="other2ins" class="form-control" /></td>
                 <td><input type="text" name="other2year" class="form-control" /></td>
                 <td><input type="text" name="other2per" class="form-control" /></td>
                 <td><div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="other2file" id="avatar" onchange="document.getElementById('uploader').value = this.value;">
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div></td></tr>
             </tbody>
                            </table>
                              <!--<div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="sr-only" for="exampleInputName1">Your name</label>
                                    <input type="text" class="form-control" placeholder="Your name">
                                  </div>
                                  <div class="form-group">
                                    <label class="sr-only" for="exampleInputCat1">Name of your cat</label>
                                    <input type="text" class="form-control" placeholder="Name of your cat">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="sr-only" for="hamster"></label>
                                    <input type="text" id="hamster" class="form-control" placeholder="Name of your hamster">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="sr-only" for="grocery"></label>
                                    <input type="text" id="grocery" class="form-control" placeholder="Name of your grocery seller">
                                  </div>
                                </div>
                              </div>-->
                            </div>
                            <div class="col-lg-12">
                              <div class="row">
                                
                                <div class="col-lg-3">
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="gap" value="gap" data-checkbox="icheckbox_square-blue">  
                                   	Gap Certificate(If/Any)
                                    </label>
                                  </div>
                               
                                </div>
                                <div class="col-lg-3">
                                  <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="gap" id="avatar" onchange="document.getElementById('uploader').value = this.value;" >
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                                </div>
                                </div>
                                  <div class="row">
                                   <div class="col-lg-3">
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="caste" value="caste" data-checkbox="icheckbox_square-blue">  
                                   	Caste Certificate*
                                    </label>
                                  </div>
                               
                                </div>
                                <div class="col-lg-3">
                                  <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="caste" id="avatar" onchange="document.getElementById('uploader').value = this.value;" >
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                                </div>
                               </div>
                                 <div class="row">
                                   <div class="col-lg-3">
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="tc" value="tc" data-checkbox="icheckbox_square-blue">  
                                   	Transfer Certificate*
                                    </label>
                                  </div>
                               
                                </div>
                                <div class="col-lg-3">
                                  <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="tc" id="avatar" onchange="document.getElementById('uploader').value = this.value;" >
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                                </div>
                                </div>  <div class="row">
                                   <div class="col-lg-3">
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="other" value="other" data-checkbox="icheckbox_square-blue">  
                                   	Other Documents
                                    </label>
                                  </div>
                               
                                </div>
                                <div class="col-lg-3">
                                  <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" multiple="multiple" class="custom-file" name="other[]" id="avatar" onchange="document.getElementById('uploader').value = this.value;" >
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                                </div>
                              </div>
                            </div>
                            
                           <noscript>
                  <input class="nocsript-finish-btn sf-right nocsript-sf-btn" type="submit"
                                name="submit" value="Finish"/>
                            </noscript>
                          </div>
                        </fieldset>
                      <?php echo form_close();?>
                    </div>
                  
                  </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2015 </span>
                <span>THEMES LAB</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN BUILDER -->
      <div class="builder hidden-sm hidden-xs" id="builder">
        <a class="builder-toggle"><i class="icon-wrench"></i></a>
        <div class="inner">
          <div class="builder-container">
            <a href="#" class="btn btn-sm btn-default" id="reset-style">reset default style</a>
            <h4>Layout options</h4>
            <div class="layout-option">
              <span> RTL</span>
              <label class="switch pull-right">
              <input data-layout="rtl" id="switch-rtl" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Fixed Sidebar</span>
              <label class="switch pull-right">
              <input data-layout="sidebar" id="switch-sidebar" type="checkbox" class="switch-input" checked>
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Sidebar on Hover</span>
              <label class="switch pull-right">
              <input data-layout="sidebar-hover" id="switch-sidebar-hover" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Submenu on Hover</span>
              <label class="switch pull-right">
              <input data-layout="submenu-hover" id="switch-submenu-hover" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Sidebar on Top</span>
              <label class="switch pull-right">
              <input data-layout="sidebar-top" id="switch-sidebar-top" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span>Fixed Topbar</span>
              <label class="switch pull-right">
              <input data-layout="topbar" id="switch-topbar" type="checkbox" class="switch-input" checked>
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span>Boxed Layout</span>
              <label class="switch pull-right">
              <input data-layout="boxed" id="switch-boxed" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <h4 class="border-top">Color</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="theme-color bg-dark" data-main="default" data-color="#2B2E33"></div>
                <div class="theme-color background-primary" data-main="primary" data-color="#319DB5"></div>
                <div class="theme-color bg-red" data-main="red" data-color="#C75757"></div>
                <div class="theme-color bg-green" data-main="green" data-color="#1DA079"></div>
                <div class="theme-color bg-orange" data-main="orange" data-color="#D28857"></div>
                <div class="theme-color bg-purple" data-main="purple" data-color="#B179D7"></div>
                <div class="theme-color bg-blue" data-main="blue" data-color="#4A89DC"></div>
              </div>
            </div>
            <h4 class="border-top">Theme</h4>
            <div class="row row-sm">
              <div class="col-xs-6">
                <div class="theme clearfix sdtl" data-theme="sdtl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltd" data-theme="sltd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sdtd" data-theme="sdtd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltl" data-theme="sltl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
            </div>
            <h4 class="border-top">Background</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="bg-color bg-clean" data-bg="clean" data-color="#F8F8F8"></div>
                <div class="bg-color bg-lighter" data-bg="lighter" data-color="#EFEFEF"></div>
                <div class="bg-color bg-light-default" data-bg="light-default" data-color="#E9E9E9"></div>
                <div class="bg-color bg-light-blue" data-bg="light-blue" data-color="#E2EBEF"></div>
                <div class="bg-color bg-light-purple" data-bg="light-purple" data-color="#E9ECF5"></div>
                <div class="bg-color bg-light-dark" data-bg="light-dark" data-color="#DCE1E4"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END BUILDER -->
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
    <div id="quickview-sidebar">
      <div class="quickview-header">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
          <li><a href="#notes" data-toggle="tab">Notes</a></li>
          <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
        </ul>
      </div>
      <div class="quickview">
        <div class="tab-content">
          <div class="tab-pane fade active in" id="chat">
            <div class="chat-body current">
              <div class="chat-search">
                <form class="form-inverse" action="#" role="search">
                  <div class="append-icon">
                    <input type="text" class="form-control" placeholder="Search contact...">
                    <i class="icon-magnifier"></i>
                  </div>
                </form>
              </div>
              <div class="chat-groups">
                <div class="title">GROUP CHATS</div>
                <ul>
                  <li><i class="turquoise"></i> Favorites</li>
                  <li><i class="turquoise"></i> Office Work</li>
                  <li><i class="turquoise"></i> Friends</li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FAVORITES</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar13.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On the road again...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar5.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">Alexa Johnson</div>
                      <div class="user-txt">Still at the beach</div>
                    </div>
                    <div class="user-status">
                      <i class="away"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar10.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On stage...</div>
                    </div>
                    <div class="user-status">
                      <i class="busy"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FRIENDS</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar7.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">James Miller</div>
                      <div class="user-txt">At work...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar11.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Fred Smith</div>
                      <div class="user-txt">Waiting for tonight</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar8.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Ben Addams</div>
                      <div class="user-txt">On my way to NYC</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="chat-conversation">
              <div class="conversation-header">
                <div class="user clearfix">
                  <div class="chat-back">
                    <i class="icon-action-undo"></i>
                  </div>
                  <div class="user-details">
                    <div class="user-name">James Miller</div>
                    <div class="user-txt">On the road again...</div>
                  </div>
                </div>
              </div>
              <div class="conversation-body">
                <ul>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:38pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Hi you!</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:45pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Are you there?</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:51pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Send me a message when you come back.</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="conversation-message">
                <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
                <div class="item-footer clearfix">
                  <div class="footer-actions">
                    <i class="icon-rounded-marker"></i>
                    <i class="icon-rounded-camera"></i>
                    <i class="icon-rounded-paperclip-oblique"></i>
                    <i class="icon-rounded-alarm-clock"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="notes">
            <div class="list-notes current withScroll">
              <div class="notes ">
                <div class="row">
                  <div class="col-md-12">
                    <div id="add-note">
                      <i class="fa fa-plus"></i>ADD A NEW NOTE
                    </div>
                  </div>
                </div>
                <div id="notes-list">
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="detail-note note-hidden-sm">
              <div class="note-header clearfix">
                <div class="note-back">
                  <i class="icon-action-undo"></i>
                </div>
                <div class="note-edit">Edit Note</div>
                <div class="note-subtitle">title on first line</div>
              </div>
              <div id="note-detail">
                <div class="note-write">
                  <textarea class="form-control" placeholder="Type your note here"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings">
            <div class="settings">
              <div class="title">ACCOUNT SETTINGS</div>
              <div class="setting">
                <span> Show Personal Statut</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Picture</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="title">CHAT</div>
              <div class="setting">
                <span> Show User Image</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Fullname</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Unread Count</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="title">STATISTICS</div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 1</div>
                  <div class="chart-number">82%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
                </div>
              </div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 2</div>
                  <div class="chart-number">43%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
                </div>
              </div>
              <div class="m-t-30" style="width:100%">
                <canvas id="setting-chart" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN SEARCH -->
    <div id="morphsearch" class="morphsearch">
      <form class="morphsearch-form">
        <input class="morphsearch-input" type="search" placeholder="Search..."/>
        <button class="morphsearch-submit" type="submit">Search</button>
      </form>
      <div class="morphsearch-content withScroll">
        <div class="dummy-column user-column">
          <h2>Users</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar1_big.png" alt="Avatar 1"/>
            <h3>John Smith</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar2_big.png" alt="Avatar 2"/>
            <h3>Bod Dylan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar3_big.png" alt="Avatar 3"/>
            <h3>Jenny Finlan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar4_big.png" alt="Avatar 4"/>
            <h3>Harold Fox</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar5_big.png" alt="Avatar 5"/>
            <h3>Martin Hendrix</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar6_big.png" alt="Avatar 6"/>
            <h3>Paul Ferguson</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Articles</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/1.jpg" alt="1"/>
            <h3>How to change webdesign?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/2.jpg" alt="2"/>
            <h3>News From the sky</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/3.jpg" alt="3"/>
            <h3>Where is the cat?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/4.jpg" alt="4"/>
            <h3>Just another funny story</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/5.jpg" alt="5"/>
            <h3>How many water we drink every day?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/6.jpg" alt="6"/>
            <h3>Drag and drop tutorials</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Recent</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/7.jpg" alt="7"/>
            <h3>Design Inspiration</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/8.jpg" alt="8"/>
            <h3>Animals drawing</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/9.jpg" alt="9"/>
            <h3>Cup of tea please</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/10.jpg" alt="10"/>
            <h3>New application arrive</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/11.jpg" alt="11"/>
            <h3>Notification prettify</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/12.jpg" alt="12"/>
            <h3>My article is the last recent</h3>
          </a>
        </div>
      </div>
      <!-- /morphsearch-content -->
      <span class="morphsearch-close"></span>
    </div>
    <!-- END SEARCH -->
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
   
    <script>
		$(document).ready(function(){
			$("#courses").change(function(){
				var c=$(this).val();
				//alert(c);
				 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/ajax_courses/"+c,
                        data: { c : c } 
                    }).done(function(data){
                   //  alert(data);
						$("#streams").html(data);	
                    });
					 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/ajax_year/"+c,
                        data: { c : c } 
                    }).done(function(data){
                     //alert(data);
						$("#year").html(data);	
                    });
					 				
			});
			$("#year").change(function(){ //alert("Afsds");return false;
				var c = $(this).val();//alert(c);
				var cou = $("#courses option:selected").val();
				//var stream = $("#stream option:selected").val();
				 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/ajax_semester/"+c,
                        data: { c : c } 
                    }).done(function(data){
                   //  alert(data);
						$("#semester").html(data);	
                    });
					 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/ajax_batch/"+c+"/"+cou,
                        data: { c : c } 
                    }).done(function(data){
                    //alert(data);
						$("#batch").html(data);	
                    });
					
				
			});
	
                          
                       
		});
	</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="<?php echo base_url();?>assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="<?php echo base_url();?>assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="<?php echo base_url();?>assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="<?php echo base_url();?>assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="<?php echo base_url();?>assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="<?php echo base_url();?>assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="<?php echo base_url();?>assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="<?php echo base_url();?>assets/plugins/charts-chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/builder.js"></script> <!-- Theme Builder -->
    <script src="<?php echo base_url();?>assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="<?php echo base_url();?>assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="<?php echo base_url();?>assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="<?php echo base_url();?>assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="<?php echo base_url();?>assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPTS -->
    <script src="<?php echo base_url();?>assets/plugins/step-form-wizard/plugins/parsley/parsley.min.js"></script> <!-- OPTIONAL, IF YOU NEED VALIDATION -->
    <script src="<?php echo base_url();?>assets/plugins/step-form-wizard/js/step-form-wizard.js"></script> <!-- Step Form Validation -->
    <script src="<?php echo base_url();?>assets/js/pages/form_wizard.js"></script>
    <!-- END PAGE SCRIPTS -->
  </body>
</html>