<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Teacher</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Teacher</h2>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
           
            <th>Reg. No.</th>
             <th>Reg. Date</th>
              <th>Username</th>
              <th>Password</th>
              <th>First Name</th>
              <th>Last Name</th>
               <th>Salary</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($stud_list as $user):
				$name=$user->first_name.' ';
				if($user->middle_name!='')
				{
					$name.=$user->middle_name.' ';
				}
				$name.=$user->last_name;
			?>
             
            <tr>
            
            <td><?php echo $user->id;?></td>
            <td><?php echo $user->registration_date;?></td>
              <td><?php echo $user->username;?></td>
              <td><?php echo $user->password;?></td>
              <td ><?php echo $user->first_name?></td>
              <td ><?php echo $user->last_name?></td>
              <td ><?php echo $user->salary?></td>
              <td ><?php echo $user->email?></td>
              <td ><?php echo $user->phone?></td>
              <td ><?php echo $user->address?></td>             
              <td ><?php  if($user->status=='active'){?>
                <span class="label label-success">Active</span>
                <?php }else{?>
                <span class="label label-important">Banned</span>
                <?php }?></td>
              <td class="center">
              <a class="btn btn-info" href="<?php echo base_url();?>index.php/teachertlist/edit?userid=<?php echo $user->id;?>" >
               <i class="icon-edit icon-white"></i> Edit </a>
                <a class="btn btn-info" href="javascript:void(0)" 
                onclick="openedit_model('<?php echo $user->id;?>','<?php echo $user->up_salary;?>','<?php echo $name;?>')">
               Salary Increament </a>
               
                <?php if($user->status=='active'){?>
                <a class="btn btn-danger" href="javascript:void();" onclick="activate_inactivateitem('<?php echo $user->id;?>','inactive')"> 
                In-Activate </a>
                <?php }else{?>
                <a class="btn btn-success" href="javascript:void();" onclick="activate_inactivateitem('<?php echo $user->id;?>','active')"> 
                 Activate </a>
                <?php } ?>
                 <a class="btn btn-danger" href="javascript:void();" onclick="deleteitem('<?php echo $user->id;?>')"> 
                Delete </a>
                
               </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>


<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> 
<?php echo form_open('teachertlist/salary', array('class' => 'form-horizontal', 'id' => 'paymentPostFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3> <span id="span_name"></span></h3>
  </div>
  <div class="modal-body">
  
  <div class="control-group" id="" >
      <label class="control-label" for="inputSuccess">Salary</label>
      <div class="controls">        
       <input type="number" step="any" id="editsalary" name="salary" />
        <input type="hidden" id="edituserid" name="userid" />
        <span class="help-inline" id="salary_message" style="display:none;"></span>
      </div>
    </div>
  
   </div>
   <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="payment_validation();">Save</button>
  </div>
  </form>
</div>



<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script language="javascript" type="text/javascript">
function openedit_model(userid,salary,name)
{
	//alert(username);
	var base_url='<?php echo base_url();?>';
	$("#editsalary").val(salary);
	$("#edituserid").val(userid);
	$("#span_name").text(name);
	
	$('#myEditModal').modal('show');
		
}

function payment_validation()
{
	confirm("Do you want to change the salary amount?");
}

function original_email_onblur()
{
	if($("#original_email").val()!=$("#email").val())
	{
		
		if(!validate_email()){
			$("#email").focus();
			return false;
		}	
	}
	else
	{
		$("#email_message").text("Available");
		$("#email_message").show();
		$("#email_control").removeClass();
		$("#email_control").addClass("control-group success");
		return true;		
	}
	
}

function activate_inactivateitem(id,status){
	var base_url='<?php echo base_url();?>'; 
	var tablename='teacher';
	var columnname='id';
	var setColumn='status';
	var page='teachertlist';
	if(status=="active"){		
		
		if(confirm('Are you sure do you want to '+status+' it?')){			
		window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}
	}else{
		
		if(confirm('Are you sure do you want to '+status+' it?')){
		window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}
	}	
}


function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='teacher';
	var column='id';
	var page='teachertlist';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/teachertlist/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

</script>