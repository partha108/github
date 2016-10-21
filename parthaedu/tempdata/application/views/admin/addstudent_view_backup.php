<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Student</a> <span class="divider">/</span> </li>
      <li> <a href="#">Add Student</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Add Student</h2>
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
           <?php echo form_open_multipart('addstudent/registration_post', array('class' => 'form-horizontal', 'id' => 'addstudent')); ?>
            <legend>Add Student</legend>
            <div style="width:500px;  float:left;">
               
               <input type="hidden" id="user" name="user" value="2" />
                    
            <div class="control-group" id="registration_no_control">
              <label class="control-label" for="inputSuccess">Registration No</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="registration_no" name="registration_no" />             
                                   
                <span class="help-inline" id="registration_no_message" style="display:none;"></span> </div>
            </div>
            
           
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
              <label class="control-label" for="inputSuccess">email</label>
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
                <input type="radio" name="gender" id="female" value="female" >
               Female </label>
            </div>
          </div> 
          
           <div class="control-group" id="class_control" >
              <label class="control-label" for="class">Select Class</label><span style="color:#F00">*</span>
              <div class="controls">
                <select id="class" data-rel="chosen" name="class" onchange="class_fees(this.value);" >
                  <option value="">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo->id;?>"><?php echo $classinfo->name;?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
           
           
        </div>
             
        <div style="width:400px; float:left;" >
          
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
                  <option value="0">--Select Country--</option>
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
                  <option value="0">--Select Blood Group--</option>
                  
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
                <input type="radio" name="status" id="status" value="active">
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
            
             <!----------------Concession ----Special -----Fees-------------------> 
            
            
          <div class="control-group" id="fees_control" >
               <label class="control-label" for="inputSuccess">Student Fees</label><span style="color:#F00">*</span>
              <div class="controls">
                <input type="text" id="fees" name="fees" onchange="all_amount()"  readonly="readonly"/>
               <span class="help-inline" id="fees_message" style="display:none;"></span> 
                <span class="help-inline" id="concessionamountfees_message" style="display:none;"></span> 
                <span class="help-inline" id="specialamountfees_message" style="display:none;"></span> 
              </div>
           </div>
            
         <div class="control-group" id="divconcessionamount" style="display:none" >
                  <label class="control-label" for="inputSuccess">Concession Amount</label>
                  <div class="controls">
                    <input type="text" id="concessionamount" name="concessionamount"  readonly="readonly"/> 
                     <input type="hidden" id="concession_id" name="concession_id" />                  
                    <span class="help-inline" id="concessionamount_message" style="display:none;"></span> </div>
            </div>
        
         <div class="control-group" id="divspecialamount" style="display:none" >
                  <label class="control-label" for="inputSuccess">Special Amount</label>
                  <div class="controls">
                    <input type="text" id="specialamount" name="specialamount"  readonly="readonly"/>
                     <input type="hidden" id="specialfees_id" name="specialfees_id" />                    
                    <span class="help-inline" id="specialamount_message" style="display:none;"></span> </div>
            </div>
            
       	 <div class="control-group" id="divtotalfees" style="display:none" >
                  <label class="control-label" for="inputSuccess">Total Amount</label>
                  <div class="controls">
                    <input type="text" id="totalfees" name="totalfees"  readonly="readonly"/>                   
                    <span class="help-inline" id="totalfees_message" style="display:none;"></span> </div>
            </div>
        
        <!----------------Concession ----Special -----Fees------------------->  
        
         <div class="control-group" id="" >
                  <label class="control-label" for="inputSuccess">Session Charge</label>
                  <div class="controls">
                    <input type="text" id="session_charge" name="session_charge" onkeyup="all_amount()"  />                   
                    <span class="help-inline" id="session_charge_message" style="display:none;"></span> </div>
            </div>
        
         <div class="control-group" id="">
              <label class="control-label" for="inputSuccess">Deposit Amount</label>
              <div class="controls">
                <input type="text" id="deposit" name="deposit" onkeyup="all_amount()"  />                   
                <span class="help-inline" id="deposit_message" style="display:none;"></span> </div>
            </div>
        
        	<div class="control-group" id="">
                  <label class="control-label" for="inputSuccess">Total Amount</label>
                  <div class="controls">
                    <input type="text" id="allamount" name="allamount" readonly="readonly" />                   
                    <span class="help-inline" id="allamount_message" style="display:none;"></span> </div>
            </div>
        
        </div>
         </fieldset>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary" onclick="return validate_form()" >Add</button>
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

function all_amount()
{
	var fees=$('#fees').val();
	var sessionchrg=$('#session_charge').val();
	var deposit=$('#deposit').val();
	
	var totsum=alwaysAddAsNumbers(fees,sessionchrg,deposit);
	$('#allamount').val(totsum);
	
}

function alwaysAddAsNumbers(a, b,c){
  var m = 0,
      n = 0,
	  o=0,
      d = /\./,
      f = parseFloat,
      i = parseInt,
      t = isNaN,
      r = 10;
  m = (d.test(a)) ? f(a) : i(a,r);
  n = (d.test(b)) ? f(b) : i(b,r);
   o = (d.test(c)) ? f(c) : i(c,r);
  if (t(m)) m = 0;
  if (t(n)) n = 0;
   if (t(o)) o = 0;
  return m + n + o;
}


</script>

