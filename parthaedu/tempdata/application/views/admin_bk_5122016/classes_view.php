<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Classes</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Class</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add class </a></div>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Sl No</th>
              <th>Class Name</th>
           
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($Classes as $item):
				$count=$count+1;
			?>
             
            <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['name'];?></td>
          
              <td style="text-align:center" ><?php  if($item['status']=='active'){?>
                    <span class="label label-success">Active</span>
                    <?php }else{?>
                    <span class="label label-important">Inactive</span>
                    <?php }?>
                </td>
                           
              <td class="center"> <a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $item['id'];?>')"> <i class="icon-edit icon-white"></i> Edit </a>
             <a class="btn btn-danger" href="#" onclick="deleteitem('<?php echo $item['id'];?>')"> <i class="icon-trash icon-white"></i> Delete </a>
         <?php /*?> <?php if($item['status']=='active'){?>
                <a class="btn btn-danger" href="#" onclick="activate_inactivateitem('<?php echo $item['id'];?>','<?php echo $item['status'];?>')"> <i class="icon-trash icon-white"></i> In-Activate </a>
                <?php }else{?>
                <a class="btn btn-danger" href="#" onclick="activate_inactivateitem('<?php echo $item['id'];?>','<?php echo $item['status'];?>')"> <i class="icon-trash icon-white"></i> Activate </a>
                <?php } ?><?php */?>
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
<!------------------------------------------------Add ---------------------------------------------------------->
<div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('admin/add_class_post', array('class' => 'form-horizontal', 'id' => 'addClassFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Class</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
            
             <div class="control-group" id="name_control" >
              <label class="control-label" for="inputSuccess">Academic Year</label>
              <div class="controls">
               <select name="add_academic_year" id="add_academic_year">
               		<?php
               			foreach ($academic_year as $acy) {
               				
               			
               		?>
               		<option value="<?php echo $acy->academic_year;?>"><?php echo $acy->academic_year;?></option>
               		<?php
               		}
               		?>
               </select>           
                <span class="help-inline" id="name_message" style="display:none;"></span> </div>
            </div>
             <div class="control-group" id="name_control" >
              <label class="control-label" for="inputSuccess"> Class Name</label>
              <div class="controls">
                <input type="text" id="name"  name="name" >                
                <span class="help-inline" id="name_message" style="display:none;"></span> </div>
            </div>
                         
            
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form()"  >Add</button>
  </div>
  </form>
</div>

<!------------------------------------Edit------------------------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%">
	<?php echo form_open_multipart('admin/add_class_post', array('class' => 'form-horizontal', 'id' => 'editClassFrm')); ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>Edit Class</h3>
	</div>

	</form>
</div>


<script language="javascript" type="text/javascript">
function open_add_model()
{
	$("#myaddmodel").modal('show');	
}

function openedit_model(id)
{
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+ id ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/admin/edit_Class",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 
				 
					var edit_class = data.edit_class[0];
					 console.log(edit_class);
					 $('#id').val(edit_class.id);
					$('#edit_name').val(edit_class.name);
					$('#status').val(edit_class.status);
					 $('#myEditModal').modal('show');
				  }
				  
		});
	}
}



function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='tblclass';
	var column='id';
	var page='admin/classes';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/admin/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

function activate_inactivateitem(id,status){
	var base_url='<?php echo base_url();?>'; 
	var tablename='tblclass';
	var columnname='id';
	var setColumn='status';
	var page='admin/classes';
	if(status=="active"){
		
		status="inactive";
		if(confirm('Are you sure do you want to Deactivate it?')){
			
			window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}
	}else{
		status="active";
		if(confirm('Are you sure do you want to Active it?')){
			window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}

	}
}


function validate_form()
{
	
	if(!validate_add_name()){
		$("#name").focus();
		return false;}
	
	return true;
}	

function validate_add_name()
{
	var firstname = $.trim($("#name").val());
	if(firstname == ''){
		$("#name_message").text("Please Enter Class Name");
		$("#name_message").show();
		$("#name_control").removeClass();
		$("#name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#name_message").text("Valid");
		$("#name_message").show();
		$("#name_control").removeClass();
		$("#name_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_name()
{
	var firstname = $.trim($("#edit_name").val());
	if(firstname == ''){
		$("#edit_name_message").text("Please Enter Class Name");
		$("#edit_name_message").show();
		$("#edit_name_control").removeClass();
		$("#edit_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_name_message").text("Valid");
		$("#edit_name_message").show();
		$("#edit_name_control").removeClass();
		$("#edit_name_control").addClass("control-group success");
		return true;	
	}		
}
   
function validate_edit_form()
{
	if(!validate_edit_name()){
		$("#edit_name").focus();
		return false;}
	
	return true;
}	

function add_subjects(id){
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='tblclassstudent';
	var column='id';	
	window.location = base_url+'index.php/admin/class_subject?id='+id;
}







</script>