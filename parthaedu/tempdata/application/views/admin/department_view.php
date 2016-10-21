<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Department"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Department"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_addImageCategory_model()" > Add Department </a></div>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Id</th>
              <th>Department</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($department as $item):
			  $count=$count+1;
			?>
           
            <tr>
              <td><?php echo $count;?></td>
              <td ><?php echo $item->department?></td>
              
              
              <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $item->id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
              <a class="btn btn-info" href="#" onclick="deleteDepartment(<?php echo $item->id;?>)"> <i class="icon-edit icon-white"></i> Delete </a>
              
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
<!------------------------------------------------Add department---------------------------------------------------------->
<div class="modal hide fade" id="myAddCategoryModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/add_department', array('class' => 'form-horizontal', 'id' => 'addDepartmentFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Department</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
            <div class="control-group"  id="department_control">
              <label class="control-label" for="inputSuccess">Department name</label>
              <div class="controls">
                <input type="text" id="department"  name="department" >
                <span class="help-inline" id="department_message" style="display:none;"></span> </div>
            </div>
           
          
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form();">Save changes</button>
  </div>
  </form>
</div>

<!------------------------------------Edit --------------------------------------------------------->
<div class="modal hide fade" id="myEditCategoryModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_department_post', array('class' => 'form-horizontal', 'id' => 'editDepartmentFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit Department</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
           <div class="control-group" >
              
              <div class="controls">
                <input type="hidden" id="id"  name="id"  readonly="readonly">
                 </div>
            </div>
           
            <div class="control-group" id="edit_department_control" >
              <label class="control-label" for="inputSuccess">Department name</label>
              <div class="controls">
                <input type="text" id="edit_department"  name="edit_department" >
                <span class="help-inline" id="edit_department_message" style="display:none;"></span> </div>
            </div>
           
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_edit_form();">Save changes</button>
  </div>
  </form>
</div>

<!-----------------------------success modal----------------------------------------------------------------->

<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>  
  
  <div class="modal-body">
   <h4>Category has been Deleted !</h4>
          <div style=" float:right;">
             
           <button type="submit" class="btn btn-primary">ok</button>
          
           </div> 
            
  </div>
  
  </form>
</div>

<script src="<?php echo base_url();?>custom_script/additional_validation.js"></script>
<script language="javascript" type="text/javascript">

function open_addImageCategory_model()
{
	$("#myAddCategoryModal").modal('show');	
}

function openedit_model(id)
{
	//alert("id");
	var base_url='<?php echo base_url();?>'; 
	var dataString = 'id='+ id ;
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/edit_department",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			
			  	var edit_department = data.edit_department[0];
				 console.log(edit_department);
					$("#id").val(edit_department.id);
					$("#edit_department").val(edit_department.department);
										
					$('#myEditCategoryModal').modal('show');
					
			}  
	});
	return false;
		
}

function deleteDepartment(id)
{
	//alert(id);
	var base_url='<?php echo base_url();?>'; 
	if(confirm('Are you sure do you want to delete this?')){		
				window.location=base_url+"index.php/admin/delete_department?id="+id;
			  
	}	
}

function validate_form()
{
	if(!validate_add_department()){		
			$("#department").focus();
			return false;
	}
	return true;
	
	
}

function validate_edit_form()
{
	if(!validate_edit_department_category()){
			$("#edit_department").focus();
			return false;
	}
	return true;	
}

</script>