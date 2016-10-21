<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Concession</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Concession</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('message');  ?>
       <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Concession </a></div>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Id</th>
              <th>Concession</th>
              <th>Concession Amount</th>
              <th>Concession Type</th>
              <th>Effective Month</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($concession as $item):
			  $count=$count+1;
			?>
           
            <tr>
              <td><?php echo $count;?></td>
              <td ><?php echo $item->concession_type ;?></td>
              <td ><?php echo $item->concession_amount ;?></td>
              <td ><?php echo $item->concession_status ;?></td>
              <td >
			  <?php if($item->concession_status!='individual')
			  {
				  echo date("F",strtotime($item->start_date)).','.date("Y",strtotime($item->start_date)).' To '.date("F",strtotime($item->end_date)).','.date("Y",strtotime($item->end_date));}?>
              
              </td>
              <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $item->id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
                <a class="btn btn-info" href="#" onclick="deleteitem(<?php echo $item->id ;?>)"> <i class="icon-edit icon-white"></i> Delete </a>
              
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
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('concession/add_concession_post', array('class' => 'form-horizontal', 'id' => 'addConcessionFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Concession
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
            <div class="control-group"  id="concession_type_control">
              <label class="control-label" for="inputSuccess">Concession name</label>
              <div class="controls">
                <input type="text" id="concession_type"  name="concession_type" >
                <span class="help-inline" id="concession_type_message" style="display:none;"></span> </div>
            </div>
           
            <div class="control-group"  id="concession_amount_control">
              <label class="control-label" for="inputSuccess">Concession Amount</label>
              <div class="controls">
                <input type="text" id="concession_amount"  name="concession_amount" >
                <span class="help-inline" id="concession_amount_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Concession Type</label>
              <div class="controls">
                <select id="concession_status" name="concession_status" onchange="dateshow(this.value)">
                	<option value="individual">Individual</option>
                    <option value="all">All</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                <span class="help-inline" id="concession_status_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="date_concession" style="display:none">
              <label class="control-label" for="inputSuccess">Concession Date</label>
              <div class="controls">
               
                <input type="text" id="start_date" name="start_date"  class="datepicker_"/>
                                
              <label class="control-label" for="inputSuccess">To</label>
               
                <input type="text" id="end_date" name="end_date" class="datepicker_" />
          
                <span class="help-inline" id="date_concession_message" style="display:none;"></span> </div>
            </div>
          
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return add_validation()" >Add</button>
  </div>
  </form>
</div>

<!------------------------------------Edit --------------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('concession/add_concession_post', array('class' => 'form-horizontal', 'id' => 'editConcessionFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit concession</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
            <input type="hidden" id="id"  name="id" >
           
           <div class="control-group"  id="edit_concession_type_control">
              <label class="control-label" for="inputSuccess">Concession name</label>
              <div class="controls">
                <input type="text" id="edit_concession_type"  name="edit_concession_type" >
                <span class="help-inline" id="edit_concession_type_message" style="display:none;"></span> </div>
            </div>
           
            <div class="control-group"  id="edit_concession_amount_control">
              <label class="control-label" for="inputSuccess">Concession Amount</label>
              <div class="controls">
                <input type="text" id="edit_concession_amount"  name="edit_concession_amount" >
                <span class="help-inline" id="edit_concession_amount_message" style="display:none;"></span> </div>
            </div>
            
             <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Concession Type</label>
              <div class="controls">
                <select id="edit_concession_status" name="concession_status" onchange="date_show(this.value)">
                	<option value="individual">Individual</option>
                    <option value="all">All</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                <span class="help-inline" id="edit_concession_status_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group"  id="edit_date_concession" style="display:none">
              <label class="control-label" for="inputSuccess">Concession Date</label>
              <div class="controls">
                <input type="text" id="edit_start_date" name="start_date" class="datepicker_" />
                                
                 <label class="control-label" for="inputSuccess">To</label>
               
                 <input type="text" id="edit_end_date" name="end_date" class="datepicker_" />
                             
                <span class="help-inline" id="edit_date_concession_message" style="display:none;"></span> </div>
            </div>
           
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return edit_validation()">Save changes</button>
  </div>
  </form>
</div>



<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>
<script language="javascript" type="text/javascript">

function date_show(id)
{
	if(id=='individual')
	{
		$("#start_date").val(null);
		$("#end_date").val(null);
		$("#edit_date_concession").hide();
		
	}else{
		$("#edit_date_concession").show();
	}
	
}

function dateshow(id)
{
	if(id=='individual')
	{
		$("#start_date").val(null);
		$("#end_date").val(null);
		$("#date_concession").hide();
		
	}else{
		$("#date_concession").show();
	}
	
}

function add_validation()
{
		
	if($("#concession_status").val()=='individual')
	{
		return true;
	}else{
		
		if($("#start_date").val()=='')
		{
			$("#date_concession_message").show();
			$("#date_concession_message").text('Please Enter both Start Date and End date.');
			return false;
		}
		
		if($("#end_date").val()=='')
		{
			$("#date_concession_message").show();
			$("#date_concession_message").text('Please Enter both Start Date and End date.');
			return false;
		}
		if($("#start_date").val()!='' ||$("#end_date").val()!='' )
		{
			return true;
		}
	}
	
	return true;
}

function edit_validation()
{
	//alert($("#edit_concession_status").val());
	if($("#edit_concession_status").val()=='individual')
	{
		return true;
	}else{
				
		if($("#edit_start_date").val()=='')
		{
			$("#edit_date_concession_message").show();
			$("#edit_date_concession_message").text('Please Enter both Start Date and End date.');
			return false;
		}
		
		if($("#edit_end_date").val()=='')
		{
			$("#edit_date_concession_message").show();
			$("#edit_date_concession_message").text('Please Enter both Start Date and End date.');
			return false;
		}
		if($("#edit_start_date").val()!='' ||$("#edit_end_date").val()!='' )
		{
			return true;
		}
	}
	return true;
}


function open_add_model()
{
	$("#myAddModal").modal('show');	
}

function openedit_model(id)
{
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+ id ;
		$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/concession/concession_data_byId",  
			  data: dataString,
			  async: false,  
			  success: function(data) 
			  { 
				var edit = data.edit[0];
				console.log(data.edit[0]);
				$("#id").val(edit.id);
				$("#edit_concession_type").val(edit.concession_type);
				$("#edit_concession_amount").val(edit.concession_amount);
				$('#edit_concession_status option[value="'+edit.concession_status+'"]').attr('selected','selected');
				
				if(edit.concession_status=='individual')
				{
					$("#edit_date_concession").hide();
				}else{
					$("#edit_date_concession").show();
				}
				$("#edit_start_date").val(edit.start_date);
				$("#edit_end_date").val(edit.end_date);
						
									
				$('#myEditModal').modal('show');
			}  
		});
	}
	return false;		
}

function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='concession';
	var column='id';
	var page='concession';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/concession/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

function validate_form()
{
	if(!validate_ImageCategory()){
			$("#photo_category").focus();
			return false;
	}
	
	
	
return true;
}

function validate_edit_form()
{
	if(!validate_EditImageCategory()){
			$("#edit_photo_category").focus();
			return false;
	}
	
		
return true;
}
</script>