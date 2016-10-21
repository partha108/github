<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Document List</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Document List</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
        <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Document </a></div>
        
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Sr.NO</th>
              <th>Title</th>
              <th>Description</th>
            <th>Document</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($file_list as $item):
				$count=$count+1;
			?>
             
            <tr>
              <td><?php echo $count;?></td>
              <td ><?php echo $item['title']?></td>
              <td  ><?php echo substr($item['description'],0,100)?></td>
             <td><a href="<?php echo base_url()?>index.php/admin/download_file/<?php echo $item['file_name']?>">Download</a></td>
              
              <td class="center">
              <a class="btn btn-info" href="javscript:void();" onclick="return openedit_model('<?php echo $item['file_id'];?>')"> <i class="icon-edit icon-white"></i> Edit </a>
         
              <a class="btn btn-info" href="#" onclick="deleteDocument('<?php echo $item['file_id'];?>')"> <i class="icon-edit icon-white"></i> Delete </a>
              
              
             
                
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
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/add_document', array('class' => 'form-horizontal', 'id' => 'addNewsFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Document</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Title</label>
              <div class="controls" id="add_title_control">
                <input type="text" id="add_title"  name="add_title"  onblur="title_onblur()">
                <span class="help-inline" id="add_title_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Description</label>
              <div class="controls" id="add_description_control">
                
                <textarea id="add_description" name="add_description" cols="" rows="" onblur="description_onblur()"></textarea>
                <span class="help-inline" id="add_description_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">File</label>
              <div class="controls">
                <input type="file" id="filename" name="filename" />
                <span class="help-inline" id="filename_message" style="display:none;"></span> </div>
            </div>
            
            
          
          
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
  
  
    <button type="submit" class="btn btn-primary" onclick="return validate_form();">Save changes</button>
   
  </div>
  </form>
</div>

<!------------------------------------------Edit News---------------------------------------------------------->

<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_document_post', array('class' => 'form-horizontal', 'id' => 'addEditFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit News</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Id</label>
              <div class="controls">
                <input type="text" id="id"  name="id" readonly="readonly" >
                 </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Title</label>
              <div class="controls" id="title_control">
                <input type="text" id="title"  name="title"  onblur="edit_title_onblur()">
                <span class="help-inline" id="title_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Description</label>
              <div class="controls" id="description_message_control">
            
                 <textarea id="description" name="description" cols="" rows="" onblur="validate_edit_description()"></textarea>
                <span class="help-inline" id="description_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">File</label>
              <div class="controls">
                <input type="file" id="edit_file" name="edit_file" />
               
                <span class="help-inline" id="edit_file_message" style="display:none;"></span> </div>
            </div>
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_edit_form()" >Save changes</button>
  </div>
  </form>
</div>

<!-------------------------------------------success modal--------------------------------------->

<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>  
  
  <div class="modal-body">
   <h4>Document has been Deleted !</h4>
          <div style=" float:right;">             
           <button type="submit" class="btn btn-primary">ok</button>          
           </div> 
            
  </div>  
  </form>
</div>


<script src="<?php echo base_url();?>custom_script/additional_validation.js"></script>
<script >
function openedit_model(id)
{
	//alert("id");
	var base_url='<?php echo base_url();?>'; 
	var dataString = 'id='+ id ;
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/get_document_detail",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 			 
			
			  
				 console.log(data);
					$("#id").val(data[0].file_id);
					$("#title").val(data[0].title);
					$("#description").val(data[0].description);
					
				
										
					$('#myEditModal').modal('show');
					
			}  
	});
	return false;
		
}

function open_add_model(){
	$('#myAddModal').modal('show');
}

function activate_inactivate_news(id,status)
{
	var base_url='<?php echo base_url();?>'; 
	
	if(status=="active"){
		status="inactive";
		if(confirm('Are you sure do you want to Deactivate this News?')){
			window.location = 	base_url+'index.php/admin/block_unblock_news?status='+status+'&id='+id;
		}
	}else{
		status="active";
		if(confirm('Are you sure do you want to Active this News?')){
			window.location = 	base_url+'index.php/admin/block_unblock_news?status='+status+'&id='+id;
		}

	}
}

function deleteDocument(id)
{
	//alert(id);
	if(id)
	{
		var base_url='<?php echo base_url();?>'; 
		if(confirm('Are you sure do you want to delete this Document?')){		
					 $.ajax({
					  type:"POST",
					  url: "<?php echo base_url() ?>index.php/admin/delete_document",
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
	if(!validate_title()){
			$("#add_title").focus();
			return false;
	}
	
	
	if(!validate_description()){
			$("#add_description").focus();
			return false;
	}
	
	
	return true;
}	


function validate_edit_form()
{
	if(!validate_edit_title()){
			$("#title").focus();
			return false;
	}
	
	
	if(!validate_edit_description()){
			$("#description").focus();
			return false;
	}
	

	return true;
}	  

</script>