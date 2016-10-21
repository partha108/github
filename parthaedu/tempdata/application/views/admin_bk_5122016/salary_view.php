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
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($stud_list as $user):?>
             
            <tr>
              <td><?php echo $user->username;?></td>
              <td ><?php echo $user->first_name?></td>
              <td ><?php echo $user->last_name?></td>
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
                <?php if($user->status=='active'){?>
                <a class="btn btn-danger" href="javascript:void();" onclick="activate_inactivate_user('<?php echo $user->id;?>','inactive')"> 
                <i class="icon-trash icon-white"></i> In-Activate </a>
                <?php }else{?>
                <a class="btn btn-danger" href="javascript:void();" onclick="activate_inactivate_user('<?php echo $user->id;?>','active')"> 
                <i class="icon-trash icon-white"></i> Activate </a>
                <?php } ?>
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



<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script language="javascript" type="text/javascript">
function openedit_model(username)
{
	//alert(username);
	var base_url='<?php echo base_url();?>';
	var dataString = 'username='+ username ;
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/student_details",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			  //alert(data);
			 console.log(data);
			  	var student_detail = data.student_detail;
					$("#username").val(student_detail.username);
					$("#firstname").val(student_detail.first_name);
					$("#lastname").val(student_detail.last_name);
					$("#password").val(student_detail.password);
					$("#email").val(student_detail.email);
					$("#date_of_birth").val(student_detail.date_of_birth);
					$("#middle_name").val(student_detail.middle_name);
					$("#birth_place").val(student_detail.birth_place);
					//$("#original_email").val(user.email);
					$("#phonenumber").val(student_detail.phone);
					$("#address").val(student_detail.address);
					$("#mother_tongue").val(student_detail.mother_tongue);
					$("#city").val(student_detail.city);
					$("#state").val(student_detail.state);
					$("#religion").val(student_detail.religion);
					$("#postal_code").val(student_detail.postal_code);
					$("#mobile").val(student_detail.mobile);
					
					$("#country option[value='"+student_detail.country_name+"']").attr("selected", "selected");
					$("#blood_group option[value='"+student_detail.blood_group+"']").attr("selected", "selected");
					
					if(student_detail.profile_image!=null){
						$("#profile_image_tag").attr("src",base_url+"uploads/profile_image/"+student_detail.profile_image);
					}
					else{
						$("#profile_image_tag").attr("src",base_url+"images/noimages.jpg");
					}
					//$("#profile_image").val(student_detail.profile_image);
					
					$('#myEditModal').modal('show');
					
			}  
	});
	return false;
		
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

function activate_inactivate_user(username,status){
	var flag=false;
	if(status=="inactive")
		flag = confirm("Do you want to in-activate the user?")	;
	else
		flag = confirm("Do you want to activate the user?")	;
	
	if(flag){
		var base_url='<?php echo base_url();?>';
		var actionUrl = base_url+'index.php/admin/block_unblock_user';
		var frm = $('<form method="post" action="'+actionUrl+'"></form>');
			var txtuser_id = $("<input>").attr({
				id: 'user_id'
				, name: 'user_id'
				, value: username
				, type: 'hidden'
								
				 });
		   frm.append(txtuser_id);
		   var txtcurrent_status = $("<input>").attr({
				id: 'current_status'
				, name: 'current_status'
				, value: status
				, type: 'hidden'
				
				 });
		   frm.append(txtcurrent_status);
		   
		   frm.appendTo($('body'));
		   frm.submit();	
	}
}
</script>