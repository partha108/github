<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Rule Category"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Rule Category"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
      <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Rules Category </a></div>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Rule Name</th>              
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($rules as $user):
			$count=$count+1;
			?>
             
            <tr>
              <td><?php echo $count;?></td>
              <td ><?php echo $user['rule_name']?></td>
             
              <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $user['id'];?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-info" href="#" onclick="deleteRuleCategory(<?php echo $user['id'] ;?>)"> <i class="icon-edit icon-white"></i> Delete </a> 
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

<!----------------------------------------Add----------------------------------------------------->
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/add_ruleCategoryPost', array('class' => 'form-horizontal', 'id' => 'addRuleCategoryFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Rule Category</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
            <div class="control-group" id="rule_name_control">
              <label class="control-label" for="inputSuccess">Rule Name</label>
              <div class="controls">
                <input type="text" id="rule_name"  name="rule_name" >
                <span class="help-inline" id="rule_name_message" style="display:none;"></span> </div>
            </div>
           
             
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form()">Add</button>
  </div>
  </form>
</div>

<!----------------------------------------Edit----------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_rule_category_post', array('class' => 'form-horizontal', 'id' => 'editRuleCategoryFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit Rule</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Id</label>
              <div class="controls">
                <input type="text" id="id"  name="id" readonly="readonly" >
                <span class="help-inline"  style="display:none;"></span> </div>
            </div>
            
              <div class="control-group" id="edit_rule_name_control">
              <label class="control-label" for="inputSuccess">Rule Name</label>
              <div class="controls">
                <input type="text" id="edit_rule_name"  name="edit_rule_name" >
                <span class="help-inline" id="edit_rule_name_message" style="display:none;"></span> </div>
            </div>
            
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_edit_form()">Save changes</button>
  </div>
  </form>
</div>

<!-------------------------------------------success modal--------------------------------------->

<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>
  
  <div class="modal-body">
   <h4>The Post has been Deleted !</h4>
          <div style=" float:right;">             
           <button type="submit" class="btn btn-primary">ok</button>          
           </div>            
  </div>
  
  </form>
</div>

<script src="<?php echo base_url();?>custom_script/additional_validation.js"></script>
<script language="javascript" type="text/javascript">
function openedit_model(id)
{
	//alert(role_id);
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+id ;
		//alert(dataString);
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/admin/edit_rule_category",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 
						var edit_rulesCategory=data.edit_rulesCategory[0];
						$("#id").val(edit_rulesCategory.id);
						$("#edit_rule_name").val(edit_rulesCategory.rule_name);
						
											
						$('#myEditModal').modal('show');
						
				}  
		});
	}
	return false;
		
}

function open_add_model()
{
		$('#myAddModal').modal('show');
	
}

function deleteRuleCategory(id)
{
	//alert(id);
	if(id)
	{		
	var base_url='<?php echo base_url();?>'; 
		if(confirm('Are you sure do you want to delete this Rule?')){		
					 $.ajax({
					  type:"POST",
					  url: "<?php echo base_url() ?>index.php/admin/delete_Rule_Category",
					  data:{deleteid:id},
					  success:function(msg){				
						 
						  }
				  });
				  
				  $('#myOKModal').modal('show');
				  
		}
	}
}

function validate_form()
{
	if(!validate_add_ruleCatgoryName()){
			$("#rule_name").focus();
			return false;
	}
	
	
	
return true;
}

function validate_edit_form()
{
	if(!validate_edit_ruleCategoryName()){
			$("#edit_rule_name").focus();
			return false;
	}
	
		
return true;
}

</script>