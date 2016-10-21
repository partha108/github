<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Rules"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Rules"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
      <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Rules </a></div>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Rule Name</th>
              <th>Rule Title</th>
              <th>Rule Content</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rules as $user):?>
             
            <tr>
              <td><?php echo $user['id'];?></td>
              <td ><?php echo $user['rule_name']?></td>
               <td ><?php echo $user['rule_title']?></td>
               <td ><?php echo $user['rule_content']?></td>
              <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $user['id'];?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-info" href="#" onclick="deleteRule(<?php echo $user['id'] ;?>)"> <i class="icon-edit icon-white"></i> Delete </a> 
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
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/add_rulePost', array('class' => 'form-horizontal', 'id' => 'addRuleFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Rule</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
            <div class="control-group" id="rule_name_control">
              <label class="control-label" for="inputSuccess">Rule Name</label>
              <div class="controls">
                                
                 <select id="rule_name"  name="rule_name"  >
                  <option value="0">--Select Rule Name--</option>
                  <?php  foreach($rulescat as $catid):?>
                  <option value="<?php echo $catid['rule_name'];?>"><?php echo $catid['rule_name'];?></option>
                  <?php endforeach;?>
                </select>  
                <span class="help-inline" id="rule_name_message" style="display:none;"></span> </div>
            </div>
           
              <div class="control-group" id="rule_title_control">
              <label class="control-label" for="inputSuccess">Rule Title</label>
              <div class="controls">
                <input type="text" id="rule_title"  name="rule_title" >
                <span class="help-inline" id="rule_title_message" style="display:none;"></span> </div>
            </div>
            
             <div class="control-group" id="rule_content_control">
              <label class="control-label" for="inputSuccess">Rule Content</label>
              <div class="controls">
                <input type="text" id="rule_content"  name="rule_content" >
                <span class="help-inline" id="rule_content_message" style="display:none;"></span> </div>
            </div>            
            
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form()">Save changes</button>
  </div>
  </form>
</div>

<!----------------------------------------Edit----------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_rule_post', array('class' => 'form-horizontal', 'id' => 'editRuleFrm')); ?>
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
               
                <select id="edit_rule_name"  name="edit_rule_name"  >
                  <option value="0">--Select Rule Name--</option>
                  <?php  foreach($rulescat as $catid):?>
                  <option value="<?php echo $catid['rule_name'];?>"><?php echo $catid['rule_name'];?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="edit_rule_name_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="edit_rule_title_control">
              <label class="control-label" for="inputSuccess">Rule Title</label>
              <div class="controls">
                <input type="text" id="edit_rule_title"  name="edit_rule_title" >
                <span class="help-inline" id="edit_rule_title_message" style="display:none;"></span> </div>
            </div> 
                         
             <div class="control-group" id="edit_rule_content_control">
              <label class="control-label" for="inputSuccess">Rule Content</label>
              <div class="controls">
                <input type="text" id="edit_rule_content"  name="edit_rule_content" >
                <span class="help-inline" id="edit_rule_content_message" style="display:none;"></span> </div>
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
				  url:base_url+"index.php/admin/edit_rule",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 
						var edit_rules_data=data.edit_rules_data[0];
						$("#id").val(edit_rules_data.id);
						$("#edit_rule_name").val(edit_rules_data.rule_name);
						$("#edit_rule_title").val(edit_rules_data.rule_title);
						$("#edit_rule_content").val(edit_rules_data.rule_content);
											
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

function deleteRule(id)
{
	//alert(id);
	if(id)
	{
		var base_url='<?php echo base_url();?>'; 
		if(confirm('Are you sure do you want to delete this Rule?')){		
					 $.ajax({
					  type:"POST",
					  url: "<?php echo base_url() ?>index.php/admin/delete_Rule",
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
	if(!validate_add_ruleName()){
			$("#rule_name").focus();
			return false;
	}
	
	if(!validate_add_ruleTitle()){
			$("#rule_title").focus();
			return false;
	}
	
	if(!validate_add_ruleContent()){
			$("#rule_content").focus();
			return false;
	}
	
return true;
}

function validate_edit_form()
{
	if(!validate_edit_ruleName()){
			$("#edit_rule_name").focus();
			return false;
	}
	
	if(!validate_edit_ruleTitle()){
			$("#edit_rule_title").focus();
			return false;
	}
	
	if(!validate_edit_ruleContent()){
			$("#edit_rule_content").focus();
			return false;
	}
	
return true;
}

</script>