<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Student</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Student</h2>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>User Id</th>
              <th>Error Message</th>
              <th>Created Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($stud_error as $user):?>
             
            <tr>
              <td><?php echo $user->user_id;?></td>
              <td ><?php echo $user->error_msg?></td>
              <td ><?php echo $user->created_date?></td>
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
					
					
					$('#myEditModal').modal('show');
					
			}  
	});
	return false;
		
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