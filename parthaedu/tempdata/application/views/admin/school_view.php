<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">AboutUs</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> AboutUs</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <?php /*?><div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_addImageCategory_model()" > Add content </a></div><?php */?>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Id</th>
              <th>Content</th>
               <th>Route Direction</th>
               <th>Phone</th>
               <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; if(isset($aboutus)){ if(count($aboutus)>0){foreach($aboutus as $item):
			  $count=$count+1;
			?>
            <tr>
              <td><?php echo $count; echo $id=$item->id; ?></td>
              <td ><?php echo $item->content;?></td>
               <td ><?php echo $item->route_direction;?></td>
               <td ><?php echo $item->phone;?></td>
               <td ><?php echo $item->email;?></td>
              <td class="center"><a class="btn btn-info" href="javascript:void(0)" onclick="openedit_model(<?php echo $item->id?>)"> <i class="icon-edit icon-white"></i> Edit </a>
               </td>
            </tr>
            <?php endforeach;
			}}?>
          </tbody>
        </table>
        
      </div>
    </div>
    <!--/span--> 
    
  </div>
  
  <!--/row--> 
  
  <!-- content ends --> 
</div>


<!------------------------------------Edit Image Category--------------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_aboutus_post', array('class' => 'form-horizontal', 'id' => 'editaboutusFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit Content</h3>
  </div>
  <div class="modal-body">
   
      <div style="width:500px;  float:left;">
      
       <input type="hidden" id="id" name="id" value="" />
       
        <div class="control-group"  id="edit_content_control">
              <label class="control-label" for="inputSuccess">Content</label>
              <div class="controls">
               <textarea id="edit_content" name="edit_content" rows="" cols="" ></textarea>
                <span class="help-inline" id="edit_content_message" style="display:none;"></span> </div>
            </div>
            
              <div class="control-group"  id="edit_route_control">
              <label class="control-label" for="inputSuccess">Route Direction</label>
              <div class="controls">
               <textarea id="edit_route" name="edit_route" rows="" cols=""></textarea>
                <span class="help-inline" id="edit_route_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="phone_control">
              <label class="control-label" for="inputSuccess">Phone</label>
              <div class="controls">
              <input  type="text" id="phone" name="phone"  />
                <span class="help-inline" id="phone_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="email_control">
              <label class="control-label" for="inputSuccess">Email</label>
              <div class="controls">
               <input type="text" id="email" name="email"  />
                <span class="help-inline" id="email_message" style="display:none;"></span> </div>
            </div>
     
       </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" >Save changes</button>
  </div>
  </form>
</div>




<script language="javascript" type="text/javascript">
function edit_content(id){
	alert(id);
}


function openedit_model(id)
{
	//alert(id);
	$("#id").val(id);
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+ id ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/admin/edit_aboutus",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 				
					
					 console.log(data);
					 var edit_aboutus = data.edit_aboutus;
						//$("#id").val(edit_aboutus.id);
						$("#edit_content").val(edit_aboutus.content);
						$("#edit_route").val(edit_aboutus.route_direction);
						
				}  
		});
		$('#myEditModal').modal('show');
	}
	return false;
		
}



</script>

