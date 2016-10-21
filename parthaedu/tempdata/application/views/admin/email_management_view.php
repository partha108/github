<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="<?php echo base_url();?>index.php/admin">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Email Management</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Email Management</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('message');?>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">                      
          <tbody>  
             <?php foreach($fromemail as $row){?>       
            <tr>
              <td>  From Email  </td> 
              <td class="center"><?php echo $row->from_email;?> </td>             
              <td  class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('tblemail','<?php echo $row->email_id;?>','<?php echo $row->from_email;?>','from_email')"> 
              <i class="icon-edit icon-white"></i> Edit </a>
              </td>
            </tr>
            
            <tr>
              <td>
			    Receive Email 
              </td> 
              <td class="center"><?php echo $row->receive_email;?> </td>             
              <td  class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('tblemail','<?php echo $row->email_id;?>','<?php echo $row->receive_email;?>','receive_email')"> 
              <i class="icon-edit icon-white"></i> Edit </a>
              </td>
            </tr>
            
            
            <?php } ?>            
          </tbody>
        </table>
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>

<!--============== set email modal================-->
<div class="modal hide fade" id="myEditModal"> <?php echo form_open_multipart('setemail/emailUpdate_post', array('class' => 'form-horizontal', 'id' => 'editemailFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit </h3>
  </div>
  <div class="modal-body">
    <div class="control-group">
    Edit     
      <div class="controls">
        <input type="text" class="span6 typeahead" id="email_change"  name="email_change" value=""> 
         <span class="help-inline" id="email_change_message" style="display:none;"></span>
         <input type="hidden" class="span6 typeahead" id="email_id"  name="email_id" value="">
         <input type="hidden" class="span6 typeahead" id="table"  name="table" value="">
         <input type="hidden" class="span6 typeahead" id="changecolumn"  name="changecolumn" value="">    
               
      </div>
    </div>
    
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_email();" >Save changes</button>
  </div>
  </form>
</div>
<!--/*===========end set email modal================*/-->

<script language="javascript" type="text/javascript">
function openedit_model(table,id,email,changecolumn)
{
	var base_url='<?php echo base_url();?>'
			$("#email_change").val(email);
			$("#email_id").val(id);
			$("#table").val(table);
			$("#changecolumn").val(changecolumn);
			
			$('#myEditModal').modal('show');
	
}

function btnEditSize_Click()
{
	if($("#size_name").val()=='')
	{
		alert("Please enter Size name.");
		return false;
	}
	
	if($("#country").val()==0)
	{
		alert("Please Select Country Name.");
		return false;		
	}
	if($("#category_id").val()==0)
	{
		alert("Please Select Category Name.");
		return false;		
	}
	if($("#size_value").val()=='')
	{
		alert("Please enter Size Value.");
		return false;		
	}
	
	return true;
}

function delete_size(size_id)
{
	if(confirm('Are you sure do you want to delete this Size?')){
		window.location = 	base_url+'index.php/admin/deleteSize/'+size_id;
	}	
}



function validate_email()
{
	//alert($("#changecolumn").val());
	
	if( $("#changecolumn").val()=='receive_email' || $("#changecolumn").val()=='from_email' || $("#changecolumn").val()=='paypal_email')
	{
		if($('#email_change').val()=='')
		{
			$('#email_change_message').text('Please enter email');
			$('#email_change_message').show();
			$("#email_change_message").addClass("error_msg");
			$('#email_change').focus();
			return false;
		}else{
			$('#email_change_message').hide();
			}
		
		var changecolumn=$('#changecolumn').val();
		if(changecolumn!='payment_mode')
		{
		
			var email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
			if(!email.test($('#email_change').val()))
			{
				$('#email_change_message').text('Please enter valid email');
				$('#email_change_message').show();
				$("#email_change_message").addClass("error_msg");
				$('#email_change').focus();
				return false;
			}else{
				$('#email_change_message').hide();
				}
				
		}
	}
		return true;
	
}
</script>