<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "News"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "News"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
        <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add News </a></div>
        
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Id</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($news as $item):
				$count=$count+1;
			?>
             
            <tr>
              <td><?php echo $count;?></td>
              <td ><?php echo $item['title']?></td>
              <td  ><?php echo substr($item['description'],0,100)?></td>
              <td ><?php  if($item['status']=='active'){?>
                		<span class="label label-success">Active</span>
                <?php }
				else{?>
                		<span class="label label-important">Banned</span>
                <?php }?></td>
              
              <td class="center"><a class="btn btn-info" href="javscript:void();" onclick="return openedit_model('<?php echo $item['id'];?>')"> <i class="icon-edit icon-white"></i> Edit </a>
					<?php if($item['status']=='active'){?>
                    <a class="btn btn-danger" href="javascript:void();" onclick="activate_inactivate_news('<?php echo $item['id'];?>','<?php echo $item['status'];?>')"> <i class="icon-trash icon-white"></i> In-Activate </a>
                    <?php }else{?>
                    <a class="btn btn-danger" href="javascript:void();" onclick="activate_inactivate_news('<?php echo $item['id'];?>','<?php echo $item['status'];?>')"> <i class="icon-trash icon-white"></i> Activate </a>
                    <?php } ?>
                	 <a class="btn btn-info" href="#" onclick="deleteitem(<?php echo $item['id'];?>)"> <i class="icon-edit icon-white"></i> Delete </a>
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
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/add_news', array('class' => 'form-horizontal', 'id' => 'addNewsFrm')); ?>


  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add News</h3>
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
              <label class="control-label" for="inputSuccess">Image</label>
              <div class="controls">
                <input type="file" id="add_image" name="add_image" />
                <span class="help-inline" id="add_image_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
            <label class="control-label" for="inputSuccess">Status</label>
            <div class="controls" id="add_status_control">
              <label class="radio">
                <input type="radio" name="add_status" id="add_active" value="active"  >
                Active  </label>
              <label class="radio">
                <input type="radio" name="add_status" id="add_inactive" value="inactive" >
               Inactive </label>
               
            </div>
            
          </div>
          
          <div class="control-group" id="add_end_date_control">
              <label class="control-label" for="inputSuccess">End Date</label>
              <div class="controls">
                <input type="text" id="add_end_date" value="" class="datepicker"  name="add_end_date"  >
                
                <span class="help-inline" id="add_end_date_message" style="display:none;"></span> </div>
            </div>
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
  
  
    <button type="submit" class="btn btn-primary" onclick="return validate_form();">Save changes</button>
   
  </div>
  </form>
</div>

<!------------------------------------------Edit News---------------------------------------------------------->

<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/edit_news_post', array('class' => 'form-horizontal', 'id' => 'addEditFrm')); ?>
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
                <input type="text" id="description"  name="description"  onblur="validate_edit_description()">
                
                <span class="help-inline" id="description_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
              <label class="control-label" for="inputSuccess">Image</label>
              <div class="controls">
                <input type="file" id="edit_image" name="edit_image" />
                <img src="" width="150" height="100" id="image_tag" />
                <span class="help-inline" id="image_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" >
            <label class="control-label" for="inputSuccess">Status</label>
            <div class="controls">
              <label class="radio">
                <input type="radio" name="status" id="active" value="active">
                Active  </label>
              <label class="radio">
                <input type="radio" name="status" id="inactive" value="inactive" >
               Inactive </label>
            </div>
          </div>
          
          <div class="control-group" id="edit_date_control">
              <label class="control-label" for="inputSuccess">End Date</label>
              <div class="controls">
                <input type="text" id="end_date" class="datepicker" value=""  name="end_date" >
                <span class="help-inline" id="edit_date_message" style="display:none;"></span> </div>
            </div>
            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_edit_form()" >Save changes</button>
  </div>
  </form>
</div>

<script src="<?php echo base_url();?>custom_script/additional_validation.js"></script>
<script language="javascript" type="text/javascript">
function openedit_model(id)
{
	//alert("id");
	var base_url='<?php echo base_url();?>'; 
	var dataString = 'id='+ id ;
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/edit_news",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 			 
			
			  	var edit_news = data.edit_news[0];
				 console.log(edit_news);
					$("#id").val(edit_news.id);
					$("#title").val(edit_news.title);
					$("#description").val(edit_news.description);
					
					if(edit_news.image!=null){
					$("#image_tag").attr("src",base_url+"uploads/news/small_images/"+edit_news.image);
					}
					else{
						$("#image_tag").attr("src",base_url+"uploads/noimage/noimages.jpg");
					}
					if(edit_news.status=="active"){
						$('#uniform-active > span').addClass("checked");
					
					}else{
						$('#uniform-inactive > span').addClass("checked");
					}
					$("#status").val(edit_news.status);
					$("#end_date").val(edit_news.end_date);
										
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
	
	/*if(!validate_add_enddate())	
	{
		$("#add_end_date").focus();
			return false;
	} */
	
	if(!dateCompare_news())
	{
		$("#add_end_date").focus();
		
			return false;		
	}
	return true;
}	

function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='news';
	var column='id';
	var page='admin/news';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/admin/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
	}
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
	
	/*if(!validate_end_date())	
	{
		$("#end_date").focus();
			return false;
	}*/
	
	if(!dateCompare_edit_news())
	{
		$("#end_date").focus();
		
			return false;		
	}
	
	return true;
}	  

</script>