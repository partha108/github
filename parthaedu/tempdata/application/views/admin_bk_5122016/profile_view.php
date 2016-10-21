<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Student</a> <span class="divider">/</span> </li>
      <li> <a href="#">Admin Profile</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i>Profile</h2>
      </div>
      <div class="box-content">
         
        
          <div class="control-group" id="status_control">
            <div class="controls"></div>
          </div>
            <?php echo $this->session->flashdata('insert_message');?>
            <?php echo $this->session->flashdata('error_message');  ?> 
            <?php if($user_data =$this->session->userdata('schoolbolpur_admin'))
					{
						$session_data = $this->session->userdata('schoolbolpur_admin');
						//echo "<pre>";print_r ($session_data);exit();
						foreach($userdata as $detail)
						{
							
						?>
           <div id="divsingelUserAdd" > 
           <fieldset>
           <?php echo form_open_multipart('admin_profile/update', array('class' => 'form-horizontal', 'id' => 'addstudent')); ?>
            <legend>Profile</legend>
            <div style="width:500px;  float:left;">
               
               <input type="hidden" id="editid" name="editid" value="<?php echo $detail->id; ?>" />
           
            <div class="control-group" id="">
              <label class="control-label" for="inputSuccess">First Name</label>
              <div class="controls">
                <input type="text" id="first_name"  name="first_name" value="<?php echo $detail->first_name; ?>" >
                <span class="help-inline" id="firstname_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Last Name</label>
              <div class="controls">
              <input type="text" id="last_name" name="last_name" value="<?php echo $detail->last_name; ?>" />              
              </div>
            </div>
            
            <div class="control-group" id="">
              <label class="control-label" for="inputSuccess">Mobile Number</label>
              <div class="controls">
                <input type="text" id="phone"  name="phone" value="<?php echo $detail->phone; ?>" >
                <span class="help-inline" id="middle_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="">
              <label class="control-label" for="inputSuccess">Email</label>
              <div class="controls">
                <input type="text" id="email"  name="email" value="<?php echo $detail->email; ?>" >
                <span class="help-inline" id="email_message" style="display:none;"></span> </div>
            </div>
          <?php  }
					}?>
           
       
        </div>
        
        <?php  if($detail->role_id==1){?>    
        <div style="width:400px; float:left;" >
        
         <div class="control-group" id="">
              <label class="control-label" for="inputSuccess">Username</label>
             <label class="control-label" for="inputSuccess"><?php echo $detail->username; ?></label>
              
            </div>
        
         <div class="control-group" id="" >
           <div class="controls"></div>
            <a class="btn btn-primary" 
                  href="javascript:void(0)" onclick="change_password('<?php echo $detail->id;?>')" 
                  > Change Password</a>   
            </div>
        </div>
        <?php } ?>
         </fieldset>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
       </div>        
      </form>
   
            
      </div>
    </div>
    <!--/span-->     
  </div>
</div>


<div class="modal hide fade" id="mypassModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('admin_profile/changepassword', array('class' => 'form-horizontal', 'id' => '')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
           
             <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">New Password</label>
              <div class="controls">
              <input type="text" id="newpass" name="newpass"  />  
               <input type="hidden" id="edit_id" name="edit_id"  />              
              </div>
            </div>
            
                        
                        
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  onclick="validation_();" >Save</button>
  </div>
  </form>
</div> 
  
<link href="<?php echo base_url();?>css/jquery-ui.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/jquery-ui.js"></script> 
<script src="<?php echo base_url();?>custom_script/teacher_validation.js"></script> 
<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>

<script type="text/javascript">
var base_url='<?php echo base_url();?>';
  
function change_password(id)
	{
		$("#edit_id").val(id);
		$('#mypassModal').modal('show');
	}


</script>










