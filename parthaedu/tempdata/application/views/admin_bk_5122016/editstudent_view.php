<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Student</a> <span class="divider">/</span> </li>
      <li> <a href="#">Edit User</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i></h2>
      </div>
      <div class="box-content">
        <div class="control-group" id="status_control">          </div>
            <?php echo $this->session->flashdata('insert_message');?>
            <?php echo $this->session->flashdata('error_message');  ?> 
           <div id="divsingelUserAdd" > 
           <fieldset>
           <?php echo form_open_multipart('studentlist/update', array('class' => 'form-horizontal', 'id' => 'addstudent')); ?>
            <legend>Edit User</legend>
            <div style="width:500px;  float:left;">
               
               <input type="hidden" id="userid" name="userid" value="<?php echo $userid; ?>" />
                  
            <div class="control-group" id="registration_no_control">
              <label class="control-label" for="inputSuccess">Registration No</label>
              <div class="controls">
                <input type="text" id="registration_no" name="registration_no" value="<?php echo $stud_list[0]->registration_no; ?>" readonly="readonly" />             
                                   
                <span class="help-inline" id="registration_no_message" style="display:none;"></span> </div>
            </div>
            
           
            <div class="control-group" id="firstname_control">
              <label class="control-label" for="inputSuccess">First Name</label>
              <div class="controls">
                <input type="text" id="firstname"  name="firstname" value="<?php echo $stud_list[0]->first_name; ?>">
                <span class="help-inline" id="firstname_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="middle_name_control">
              <label class="control-label" for="inputSuccess">Middle Name</label>
              <div class="controls">
                <input type="text" id="middle_name"  name="middle_name" value="<?php echo $stud_list[0]->middle_name; ?>" >
                <span class="help-inline" id="middle_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="lastname_control">
              <label class="control-label" for="inputSuccess">Last Name</label>
              <div class="controls">
                <input type="text" id="lastname"  name="lastname" value="<?php echo $stud_list[0]->last_name; ?>" >
                <span class="help-inline" id="lastname_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="date_of_birth_control">
              <label class="control-label" for="inputSuccess">Date of Birth</label>
              <div class="controls">
                <input type="text" id="date_of_birth" class="datepicker_"  name="date_of_birth" value="<?php echo $stud_list[0]->date_of_birth; ?>" >
                <span class="help-inline" id="date_of_birth_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="birth_place_control">
              <label class="control-label" for="inputSuccess">Birth Place</label>
              <div class="controls">
                <input type="text" id="birth_place"  name="birth_place" value="<?php echo $stud_list[0]->birth_place; ?>" >
                <span class="help-inline" id="birth_place_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="email_control">
              <label class="control-label" for="inputSuccess">email</label>
              <div class="controls">
                <input type="text" id="email" name="email" value="<?php echo $stud_list[0]->email; ?>" />
                <span class="help-inline" id="email_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="phonenumber_control">
              <label class="control-label" for="inputSuccess">Phone Number</label>
              <div class="controls">
                <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $stud_list[0]->phone; ?>" />
                <span class="help-inline" id="phonenumber_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="address_control">
              <label class="control-label" for="inputSuccess">Address</label>
              <div class="controls">
                <textarea id="address" rows="3" name="address" ><?php echo $stud_list[0]->address; ?></textarea>
                <span class="help-inline" id="address_message" style="display:none;"></span> </div>
            </div>
             <div class="control-group" >
            <label class="control-label" for="inputSuccess">Gender</label>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="gender" id="male" value="male" <?php if($stud_list[0]->gender == 'male'){ echo "checked";} ?>>
                Male  </label>
              <label class="radio">
                <input type="radio" name="gender" id="female" value="female" <?php if($stud_list[0]->gender == 'female'){ echo "checked";} ?> >
               Female </label>
            </div>
          </div> 
           
           
        </div>
             
        <div style="width:400px; float:left;" >
        
         <div class="control-group" id="class_control" >
              <label class="control-label" for="class">Select Class</label>
              <div class="controls">
                <select id="class" data-rel="chosen" name="class" onchange="class_fees(this.value);" >
                  <option value="">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo->id;?>" <?php if( $classinfo->id == $stud_list[0]->class_id){ echo "selected";} ?> ><?php echo $classinfo->name;?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
            
                         
           <!----------------Concession ----Special -----Fees-------------------> 
            
            
             <div class="control-group" id="fees_control" >
                  <label class="control-label" for="inputSuccess">Fees</label>
                  <div class="controls">
                    <input type="text" id="fees" name="fees" readonly="readonly" value="<?php echo $stud_list[0]->generalfees; ?>"  />
                   <!-- <a href="javascript:void();" onclick="concession_set()">concession</a>&nbsp;
                    <a href="javascript:void();" onclick="specialfees_set()">special fees</a>
                   --> <span class="help-inline" id="fees_message" style="display:none;"></span> 
                    <span class="help-inline" id="concessionamountfees_message" style="display:none;"></span> 
                    <span class="help-inline" id="specialamountfees_message" style="display:none;"></span> 
                  </div>
            </div>
            
         <div class="control-group" id="divconcessionamount"  >
                  <label class="control-label" for="inputSuccess">Concession Amount</label>
                  <div class="controls">
                    <input type="text" id="concessionamount" name="concessionamount"  readonly="readonly" value="<?php echo $concessionamout; ?>"/> 
                     <input type="hidden" id="concession_id" name="concession_id" value="<?php echo $concession_id; ?>"/> 
                     <input type="hidden" id="concessionuser_id" name="concessionuser_id" value="<?php echo $stud_list[0]->concessionuser_id ; ?>"/>                  
                    <span class="help-inline" id="concessionamount_message" style="display:none;"></span> </div>
            </div>
        
         <div class="control-group" id="divspecialamount"  >
                  <label class="control-label" for="inputSuccess">Special Amount</label>
                  <div class="controls">
                    <input type="text" id="specialamount" name="specialamount"  readonly="readonly"  value="<?php echo $specialamout ; ?>"/>
                     <input type="hidden" id="specialfees_id" name="specialfees_id" value="<?php echo $specialfees_id; ?>"/> 
                      <input type="hidden" id="specialuser_id" name="specialuser_id" value="<?php echo $stud_list[0]->specialuser_id ; ?>"/>                    
                    <span class="help-inline" id="specialamount_message" style="display:none;"></span> </div>
            </div>
            
       	 <div class="control-group" id="divtotalfees"  >
                  <label class="control-label" for="inputSuccess">Total Amount</label>
                  <div class="controls">
                    <input type="text" id="totalfees" name="totalfees"  readonly="readonly" value="<?php echo $stud_list[0]->fees ; ?>"/>                   
                    <span class="help-inline" id="totalfees_message" style="display:none;"></span> </div>
            </div>
        
        <!----------------Concession ----Special -----Fees------------------->  
        
       
        <div class="control-group" id="mother_tongue_control">
              <label class="control-label" for="inputSuccess">Mother Tongue</label>
              <div class="controls">
                <input type="text" id="mother_tongue" name="mother_tongue"  value="<?php echo $stud_list[0]->mother_tongue; ?>"  />
                <span class="help-inline" id="mother_tongue_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="religion_control">
              <label class="control-label" for="inputSuccess">Religion</label>
              <div class="controls">
               <!-- <input type="text" id="religion" name="religion" />-->
                <select id="religion" name="religion">
                	<option value="islam" <?php if($stud_list[0]->religion == 'islam'){ echo "selected";} ?>>Islam</option>
               		 <option value="hindu" <?php if($stud_list[0]->religion == 'hindu'){ echo "selected";} ?>>Hindu</option>
                </select>
                <span class="help-inline" id="religion_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="country_control">
              <label class="control-label" for="country">Select Country</label>
              <div class="controls">
                <select id="country" data-rel="chosen" name="country"  onchange="getState(this.value);">
                  <option value="0">--Select Country--</option>
                  <?php  foreach($country as $country):?>
                  <option value="<?php echo $country['country_code'];?>" 
				  <?php if( $country['country_code'] == $stud_list[0]->country_name){ echo "selected";} ?> >
				 	 <?php echo $country['country_name'];?>
                  </option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="country_message" style="display:none;"></span> </div>
            </div>
            
            <div id="state_dist"  <?php if($stud_list[0]->country_name=='IN'){ echo 'style="display:block"'; }else{ echo 'style="display:none"';}?> >
                <div class="control-group" id="state_control">
                  <label class="control-label" for="inputSuccess">State </label>
                  <div class="controls">
                   
                    <select id="state" data-rel="chosen" name="state" onchange="getDistricts()" >
                      <option value="0">--Select State--</option>
                      <?php  foreach($state as $state):?>
                         <option value="<?php echo $state['state_code'];?>" 
						 <?php if( $state['state_code'] == $stud_list[0]->state){ echo "selected";} ?> >
							 <?php echo $state['state'];?>
                         </option>
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
                          <option value="<?php echo $city['city_id'];?>"
                          <?php if( $city['city_id'] == $stud_list[0]->city){ echo "selected";} ?> >
                             <?php echo $city['city'];?>
                          </option>
                      <?php endforeach;?>
                    </select>              
                    <span class="help-inline" id="city_message" style="display:none;"></span> </div>
                </div>
            </div>
            
            <div class="control-group" id="pardist_city" <?php if($stud_list[0]->country_name=='IN'){ echo 'style="display:none"'; }else{ echo 'style="display:block"';}?>>
              <label class="control-label" for="inputSuccess">District </label>
              <div class="controls">
                <input type="text" id="dist_city" name="dist_city" value="<?php echo $stud_list[0]->city_dist ; ?>" />
                <span class="" id="dist_city_message" style="display:none;"></span>  </div>
            </div>
            
            <div class="control-group" id="blood_group_control">
              <label class="control-label" for="blood_group">Select Blood Group</label>
              <div class="controls">
                <select id="blood_group" data-rel="chosen" name="blood_group"  >
                  <option value="0">--Select Blood Group--</option>
                  
                  <option value="unknown">Unknown</option>
                  <option value="A+" <?php if($stud_list[0]->blood_group == 'A+'){ echo "selected";} ?>>A+</option>
                    <option value="A-" <?php if($stud_list[0]->blood_group == 'A-'){ echo "selected";} ?>>A-</option>
                    <option value="B+" <?php if($stud_list[0]->blood_group == 'B+'){ echo "selected";} ?>>B+</option>
                    <option value="B-" <?php if($stud_list[0]->blood_group == 'B-'){ echo "selected";} ?>>B-</option>
                    <option value="O+" <?php if($stud_list[0]->blood_group == 'O+'){ echo "selected";} ?>>O+</option>
                    <option value="O-" <?php if($stud_list[0]->blood_group == 'O-'){ echo "selected";} ?>>O-</option>
                    <option value="AB+" <?php if($stud_list[0]->blood_group == 'AB+'){ echo "selected";} ?>>AB+</option>
                    <option value="AB-" <?php if($stud_list[0]->blood_group == 'AB-'){ echo "selected";} ?>>AB-</option>
                </select>
                <span class="help-inline" id="blood_group_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="postal_code_control">
              <label class="control-label" for="inputSuccess">Postal Code </label>
              <div class="controls">
                <input type="text" id="postal_code" name="postal_code" value="<?php echo $stud_list[0]->postal_code; ?>" />
                <span class="help-inline" id="postal_code_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="mobile_control">
              <label class="control-label" for="inputSuccess">Mobile Number</label>
              <div class="controls">
                <input type="text" id="mobile" name="mobile" value="<?php echo $stud_list[0]->mobile; ?>" />
                <span class="help-inline" id="mobile_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="status_control">
            <label class="control-label" for="inputSuccess">Status</label>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="status" id="status" value="active" <?php if($stud_list[0]->status == 'active'){ echo "checked";} ?>>
                Active  </label>
              <label class="radio">
                <input type="radio" name="status" id="status" value="inactive" <?php if($stud_list[0]->status == 'inactive'){ echo "checked";} ?> >
               Inactive </label>
            </div>
          </div>
            
            <div class="control-group" id="profile_image_control">
              <label class="control-label" for="inputSuccess">Profile Image</label>
              <div class="controls">
              <img src="<?php echo base_url();?>uploads/profile_image/small_images/<?php echo $stud_list[0]->profile_image;?>" />
              	  <input type="file" id="profile_image" name="profile_image" />
                  <input type="hidden" id="org_profile_image" name="org_profile_image" value="<?php echo $stud_list[0]->profile_image;?>" />
                <span class="help-inline" id="profile_image_message" style="display:none;"></span> </div>
            </div>
        </div>
         </fieldset>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary" onclick="return editvalidate_form()"  >Save</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
       </div>        
      </form>
       
       
       
       
      
       <!---------------------------------------------------------------------------------------------------------------------------------->
                
         
       <div id="divmultipleUserAdd" style="display:none;">
       <?php echo form_open_multipart('addstudent/multiple_registration', array('class' => 'form-horizontal', 'id' => 'adduserCSV')); ?>
      	 <fieldset>
            <legend>Add Student</legend>
       		<div class="control-group" id="multipleAdd_control">
       		 	<label class="control-label" for="inputSuccess">Select file </label>
             	<div class="controls">
               	<input type="file" id="student_csv" name="student_csv" />
                <a id="img_download" data-rel="tooltip" title="Download sample format" href="<?php echo base_url(); ?>uploads/document/User_list.csv">
                	<img height="50px" width="60px" src="<?php echo base_url(); ?>uploads/document/img_download.jpg"  /></a>
              	 <span class="help-inline" id="multipleAdd_message" style="display:none;"></span> </div>
           </div>
           
        <div class="form-actions">
              <button type="submit" class="btn btn-primary" >Add</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
           </fieldset> </form>            
       </div>
      </div>
    </div>
    <!--/span-->     
  </div>
</div>

<div class="modal hide fade" id="myconcessionModal" style="width:1000px; left:40%"> 
	<?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'editStudFrm')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Concession Fees</h3>
      </div>
 		 <div class="modal-body">
         
         	  <div class="control-group" id="">
       		 		<label class="control-label" for="inputSuccess">Concession </label>
                    <div class="controls">
                        <select  data-rel="chosen" id="concession" name="concession" onchange="concession_(this.value)" >
                        <option value="0">Select Concession</option>
                        <?php if(isset($concession))
                        {
                             if(count($concession)>0)
                            {
                                foreach($concession as $row_concession)
                                {
                                    echo ' <option value="'.$row_concession->id.'">'.$row_concession->concession_type.'</option>';
                                }
                            }                            
                        }?>
                        </select>               
                     <span class="help-inline" id="concession_message" style="display:none;"></span> </div>
           </div>  
           
           <div class="control-group" id="">
                <label class="control-label" for="inputSuccess">Amount </label>
                <div class="controls">
                    <input type="text" id="concession_amount" name="concession_amount" disabled="disabled" />            
                 <span class="help-inline" id="multipleAdd_message" style="display:none;"></span> </div>
           </div>         
            
         </div>
          <div class="modal-footer"> 
            <button type="button" class="btn btn-primary" onclick="concession_div();">Set Amount</button>
          </div> 
         </form>
</div>


<div class="modal hide fade" id="myspecialfeesModal" style="width:1000px; left:40%"> 
	<?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => '')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Special Fees</h3>
      </div>
 		 <div class="modal-body">
         
         	  <div class="control-group" id="">
       		 		<label class="control-label" for="inputSuccess">Special Fees </label>
                    <div class="controls">
                        <select  data-rel="chosen" id="specialfees" name="specialfees" onchange="specialfees_(this.value)" >
                        <option value="0">Select Special Fees</option>
                        <?php if(isset($specialfees))
                        {
                             if(count($specialfees)>0)
                            {
                                foreach($specialfees as $row_specialfees)
                                {
                                    echo ' <option value="'.$row_specialfees->id.'">'.$row_specialfees->specialfees.'</option>';
                                }
                            }                            
                        }?>
                        </select>               
                     <span class="help-inline" id="specialfees_message" style="display:none;"></span> </div>
           </div>  
           
           <div class="control-group" id="">
                <label class="control-label" for="inputSuccess">Amount </label>
                <div class="controls">
                    <input type="text" id="specialfees_amount" name="specialfees_amount" disabled="disabled" />            
                 <span class="help-inline" id="specialfeesamount_message" style="display:none;"></span> </div>
           </div>                   
            
         </div>
         <div class="modal-footer"> 
            <button type="button" class="btn btn-primary" onclick="specialfees_div();">Set Amount</button>
          </div> 
         </form>
</div>
         
  
  
  
  
  
<link href="<?php echo base_url();?>css/jquery-ui.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/jquery-ui.js"></script> 
<script src="<?php echo base_url();?>custom_script/user_validation.js"></script> 
<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>
<script type="text/javascript">

var base_url='<?php echo base_url();?>';
function editvalidate_form()
{
	
		var registration_no=$.trim($("#registration_no").val());
	if(registration_no==''){
		$("#registration_no_message").text("Please Enter Registration No");
		$("#registration_no_message").show();
		$("#registration_no_control").removeClass();
		$("#registration_no_control").addClass("control-group error");
		return false;	
	}
		if($.trim($("#firstname").val())==''){
			alert('Please Enter First Name');
			$("#firstname").focus();
			return false;
		}
		if($.trim($("#lastname").val())==''){
			alert('Please Enter Last Name');
			$("#lastname").focus();
			return false;
		}
	
		
		var email = $.trim($("#email").val());
	/*if(email==''){
		$("#email_message").text("Please enter email");
		$("#email_message").show();
		$("#email_control").removeClass();
		$("#email_control").addClass("control-group error");
		return false;
	}*/
	if(email!=''){
	 	if (!filter.test($('#email').val())) 
		{
			alert('Please enter a valid email id');		
			return false;
		}
	}
	
		if($("#class").val()==''){
			alert("Please select Class.");  
			return false;	
		}
		
		if($("#fees").val()==''){
			alert("Fees has not been set.Please set fees for the class before.");  
			return false;	
		}
		
		
		
		return true;
}

</script>

