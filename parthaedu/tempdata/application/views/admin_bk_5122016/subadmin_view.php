<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Subadmin </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Subadmin</h2>
      </div>
      <div class="box-content">
      <div><a href="javascript:void(0);" onclick="myaddModal()" class="btn btn-primary">Add</a></div>
      
      <div><?php echo $this->session->flashdata('message'); ?></div>
            
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr> 
              <th>Reg. Date</th>
              <th>Username</th>
              <th>Password</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th> 
              <th>Salary</th>  
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($subadmin))
				{
					foreach($subadmin as $user){
			?>
            <tr>            
              <td><?php echo $user->registration_date;?></td>
              <td><?php echo $user->username;?></td>
              <td><?php echo $user->password;?></td>
              <td ><?php echo $user->first_name?></td>
              <td ><?php echo $user->last_name?></td>
              <td ><?php echo $user->email?></td>
              <td ><?php echo $user->phone?></td>  
              <td ><?php echo $user->salary?></td>              
              <td>                         
              <a class="btn btn-info" 
          href="javascript:void(0)"
       onclick="myConcessionModal('<?php echo $user->id;?>','<?php echo $user->first_name;?>','<?php echo $user->last_name?>','<?php echo $user->email?>','<?php echo $user->phone?>','<?php echo $user->salary?>')" 
                  > Edit</a>  
                  <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="deleteitem('<?php echo $user->id;?>')" 
                  > Delete</a> 
                  
                   <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="change_password('<?php echo $user->id;?>','<?php echo $user->password;?>')" 
                  > Change Password</a>                                         
              </td>
            </tr>
            <?php } } ?>
            
          </tbody>
        </table>
        
       		 
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>


<!--------------------------------------------------------------------Other charge --------------------------------------------------------->
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('subadmin/subadmin_post', array('class' => 'form-horizontal', 'id' => 'add')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
           
           <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">First Name</label>
              <div class="controls">
              <input type="text" id="first_name" name="first_name"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Last Name</label>
              <div class="controls">
              <input type="text" id="last_name" name="last_name"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Email</label>
              <div class="controls">
              <input type="email" id="email" name="email"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Phone</label>
              <div class="controls">
              <input type="number" id="phone" name="phone"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Salary</label>
              <div class="controls">
              <input type="number" id="salary" name="salary"  />              
              </div>
            </div>
           
                        
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  >Add</button>
  </div>
  </form>
</div>

<!----------------------------------------------------------------Concession------------------------------------------------------------>
<div class="modal hide fade" id="myConcessionModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('subadmin/subadmin_post', array('class' => 'form-horizontal', 'id' => '')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
           
             <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">First Name</label>
              <div class="controls">
              <input type="text" id="editfirst_name" name="first_name"  />  
               <input type="hidden" id="editid" name="editid"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Last Name</label>
              <div class="controls">
              <input type="text" id="editlast_name" name="last_name"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Email</label>
              <div class="controls">
              <input type="email" id="editemail" name="email"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Phone</label>
              <div class="controls">
              <input type="number" id="editphone" name="phone"  />              
              </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Salary</label>
              <div class="controls">
              <input type="number" id="editsalary" name="salary"  />              
              </div>
            </div>
            
                        
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  onclick="validation_();" >Save</button>
  </div>
  </form>
</div>



<div class="modal hide fade" id="mypassModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('subadmin/changepassword', array('class' => 'form-horizontal', 'id' => '')); ?>
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
            

<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>
<script language="javascript" type="text/javascript">
	function myConcessionModal(id,fistname,lastname,email,phone,salary)
	{
		$('#editid').val(id);
		$("#editfirst_name").val(fistname);
		$("#editlast_name").val(lastname);	
		$("#editemail").val(email);
		$("#editphone").val(phone);		 
		$("#editsalary").val(salary);
		 
		$('#myConcessionModal').modal('show');
	}
	
	function myaddModal()
	{
		$('#myAddModal').modal('show');
	}
	
	function deleteitem(id)
	{
		var base_url='<?php echo base_url();?>'; 
		var id=id;
		var tablename='latepayment';
		var column='id';
		var page='latepayment';
		if(confirm('Are you sure do you want to Delete it?')){
				window.location = base_url+'index.php/latepayment/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
			}		
	}
	
	function change_password(id,password)
	{
		$("#edit_id").val(id);
		$("#oldpassword").val(password);
		$('#mypassModal').modal('show');
	}
	
</script>