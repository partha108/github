

<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Student</a> <span class="divider">/</span> </li>
      <li> <a href="#">Add Teacher</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Add Teacher</h2>
      </div>
      <div class="box-content">
          <div class="control-group" id="status_control">
           <span style="font-weight:bolder;"> <label class="control-label" for="inputSuccess">Select Option</label></span>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="selectOption" id="rdsingelUserAdd" value="singelUserAdd" checked="checked"  onclick="changeAddOptionSingle()">
                Singele User Add  </label>
              <label class="radio">
                <input type="radio" name="selectOption" id="rdmultipleUserAdd" value="multipleUserAdd"  onclick="changeAddOptionMultiple()">
               Multiple User Add </label>
            </div>
          </div>
            <?php echo $this->session->flashdata('insert_message');?>
            <?php echo $this->session->flashdata('error_message');  ?> 
           <div id="divsingelUserAdd" > 
           <fieldset>
           <?php echo form_open_multipart('addteacher/registration_post', array('class' => 'form-horizontal', 'id' => 'addstudent')); ?>
            <legend>Add Teacher</legend>
            <div style="width:500px;  float:left;">
               
               <input type="hidden" id="user" name="user" value="2" />
           
            <div class="control-group" id="firstname_control">
              <label class="control-label" for="inputSuccess">First Name</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="firstname"  name="firstname" >
                <span class="help-inline" id="firstname_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="middle_name_control">
              <label class="control-label" for="inputSuccess">Middle Name</label>
              <div class="controls">
                <input type="text" id="middle_name"  name="middle_name" >
                <span class="help-inline" id="middle_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="lastname_control">
              <label class="control-label" for="inputSuccess">Last Name</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="lastname"  name="lastname" >
                <span class="help-inline" id="lastname_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="date_of_birth_control">
              <label class="control-label" for="inputSuccess">Date of Birth</label>
              <div class="controls">
                <input type="text" id="date_of_birth" class="datepicker_"  name="date_of_birth" >
                <span class="help-inline" id="date_of_birth_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="birth_place_control">
              <label class="control-label" for="inputSuccess">Birth Place</label>
              <div class="controls">
                <input type="text" id="birth_place"  name="birth_place" >
                <span class="help-inline" id="birth_place_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="email_control">
              <label class="control-label" for="inputSuccess">email</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="email" name="email" />
                <span class="help-inline" id="email_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="phonenumber_control">
              <label class="control-label" for="inputSuccess">Phone Number</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="phonenumber" name="phonenumber" />
                <span class="help-inline" id="phonenumber_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="address_control">
              <label class="control-label" for="inputSuccess">Address</label>
              <div class="controls">
                <textarea id="address" rows="3" name="address" ></textarea>
                <span class="help-inline" id="address_message" style="display:none;"></span> </div>
            </div>
             <div class="control-group" >
            <label class="control-label" for="inputSuccess">Gender</label>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="gender" id="male" value="male">
                Male  </label>
              <label class="radio">
                <input type="radio" name="gender" id="female" value="female" checked >
               Female </label>
            </div>
          </div> 
           
           
        </div>
             
        <div style="width:400px; float:left;" >
        
        
            
             <div class="control-group" id="section_control" >
              <label class="control-label" for="section">Qualification</label>
              <div class="controls">
                <input type="text" id="qualification" name="qualification"  />
                <span class="help-inline" id="qualification_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="section_control" >
              <label class="control-label" for="section">Designation</label>
              <div class="controls">
                <input type="text" id="position" name="position"  />
                <span class="help-inline" id="position_message" style="display:none;"></span> </div>
            </div>
            
            
            
            
            
            
            
           <!----------------S A L A R Y-------------------> 
            
            
             <div class="control-group" id="fees_control" >
                  <label class="control-label" for="inputSuccess">Salary</label><span style="color:#F00">*</span>
                  <div class="controls">
                    <input type="text" id="salary" name="salary"  />
                   
                    <span class="help-inline" id="salary_message" style="display:none;"></span> 
                  </div>
            </div>
            
         
        
        <!----------------Salary------------------->  
        
        
        
        
        
        
        
        
        <div class="control-group" id="mother_tongue_control">
              <label class="control-label" for="inputSuccess">Mother Tongue</label>
              <div class="controls">
                <input type="text" id="mother_tongue" name="mother_tongue" />
                <span class="help-inline" id="mother_tongue_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="religion_control">
              <label class="control-label" for="inputSuccess">Religion</label>
              <div class="controls">
               <!-- <input type="text" id="religion" name="religion" />-->
                <select id="religion" name="religion">
                	<option value="islam">Islam</option>
               		 <option value="hindu">Hindu</option>
                </select>
                <span class="help-inline" id="religion_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="country_control">
              <label class="control-label" for="country">Select Country</label>
              <div class="controls">
                <select id="country" data-rel="chosen" name="country"  onchange="getState(this.value);">
                  <option value="">--Select Country--</option>
                  <?php  foreach($country as $country):?>
                  <option value="<?php echo $country['country_code'];?>"><?php echo $country['country_name'];?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="country_message" style="display:none;"></span> </div>
            </div>
            
            <div id="state_dist"  style="display:none">
                <div class="control-group" id="state_control">
                  <label class="control-label" for="inputSuccess">State </label>
                  <div class="controls">
                   
                    <select id="state" data-rel="chosen" name="state" onchange="getDistricts()" >
                      <option value="0">--Select State--</option>
                      <?php  foreach($state as $state):?>
                         <option value="<?php echo $state['state_code'];?>"><?php echo $state['state'];?></option>
                      <?php endforeach;?>
                    </select>
                    
                    <span class="help-inline" id="state_message" style="display:none;"></span> </div>
                </div>
                
                <div class="control-group" id="city_control">
                  <label class="control-label" for="inputSuccess">City</label>
                  <div class="controls" id="citydist">
                    
                   <select id="city" data-rel="chosen" name="city" >
                      <option value="0">--Select City--</option>
                      <?php  foreach($city as $city):?>
                      <option value="<?php echo $city['city_id'];?>"><?php echo $city['city'];?></option>
                      <?php endforeach;?>
                    </select>              
                    <span class="help-inline" id="city_message" style="display:none;"></span> </div>
                </div>
            </div>
            
            <div class="control-group" id="pardist_city">
              <label class="control-label" for="inputSuccess">District </label>
              <div class="controls">
                <input type="text" id="dist_city" name="dist_city" />
                <span class="" id="dist_city_message" style="display:none;"></span>  </div>
            </div>
            
            <div class="control-group" id="blood_group_control">
              <label class="control-label" for="blood_group">Select Blood Group</label>
              <div class="controls">
                <select id="blood_group" data-rel="chosen" name="blood_group"  >
                  <option value="unknown">Unknown</option>
                   <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <span class="help-inline" id="blood_group_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="postal_code_control">
              <label class="control-label" for="inputSuccess">Postal Code </label>
              <div class="controls">
                <input type="text" id="postal_code" name="postal_code" />
                <span class="help-inline" id="postal_code_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="mobile_control">
              <label class="control-label" for="inputSuccess">Mobile Number</label>
              <div class="controls">
                <input type="text" id="mobile" name="mobile" />
                <span class="help-inline" id="mobile_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="status_control">
            <label class="control-label" for="inputSuccess">Status</label>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="status" id="status" value="active" checked>
                Active  </label>
              <label class="radio">
                <input type="radio" name="status" id="status" value="inactive" >
               Inactive </label>
            </div>
          </div>
            
            <div class="control-group" id="profile_image_control">
              <label class="control-label" for="inputSuccess">Profile Image</label>
              <div class="controls">
              	  <input type="file" id="profile_image" name="profile_image" />
                <span class="help-inline" id="profile_image_message" style="display:none;"></span> </div>
            </div>
        </div>
         </fieldset>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary" onclick="return validation_();">Add</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
       </div>        
      </form>
   
       
 
      
       <!---------------------------------------------------------------------------------------------------------------------------------->
                
         
       <div id="divmultipleUserAdd" style="display:none;">
       <?php echo form_open_multipart('addteacher/multiple_registration', array('class' => 'form-horizontal', 'id' => 'adduserCSV')); ?>
      	 <fieldset>
            <legend>Add Student</legend>
       		<div class="control-group" id="multipleAdd_control">
       		 	<label class="control-label" for="inputSuccess">Select file </label>
             	<div class="controls">
               	<input type="file" id="student_csv" name="student_csv" />
                <a id="img_download" data-rel="tooltip" title="Download sample format" href="<?php echo base_url(); ?>uploads/document/teacher1.csv">
                	<img height="50px" width="60px" src="<?php echo base_url(); ?>uploads/document/img_download.jpg"  /></a>
              	 <span class="help-inline" id="multipleAdd_message" style="display:none;"></span> </div>
           </div>
           
        <div class="form-actions">
              <button type="submit" class="btn btn-primary" onclick="return validation_form()">Add</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
           </fieldset> </form>            
       </div>
       
       
      </div>
    </div>
    <!--/span-->     
  </div>
</div>

  
<link href="<?php echo base_url();?>css/jquery-ui.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/jquery-ui.js"></script> 
<script src="<?php echo base_url();?>custom_script/teacher_validation.js"></script> 
<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>

<script type="text/javascript">
var base_url='<?php echo base_url();?>';
  

	

	
	//return false;




</script>










