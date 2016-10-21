<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Fees Structure"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Fees Structure"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('emptypost');  ?>
       <?php echo $this->session->flashdata('update_message');  ?>
      <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Fees Structure </a></div>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
            <th>sl. no. </th>
              <th>Class</th>
              <th>Tution Fees</th>  
              <th>Hostel Fees</th>  
              <th>Fooding Fees</th>  
              <!--<th>Electric Charge</th>-->              
              <th>Total / Month</th>              
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($fees as $item):
			$count=$count+1;
			
			
			?>
             
            <tr>
             <td ><?php echo $count ; ?></td>
              <td ><?php foreach($class as $clname){ if($clname->id==$item->class_id){ echo $clname->name ; } }?></td>
              <td ><?php echo $item->school_fees?></td>
              <td ><?php echo $item->hostel_fees?></td>
              <td ><?php echo $item->admission_fees?></td><!--
              <td ><?php echo $item->electric_charge?></td>-->
              <td ><?php echo $item->total?></td>
             
              <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $item->id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-info" href="#" onclick="deleteFees(<?php echo $item->id ;?>)"> <i class="icon-edit icon-white"></i> Delete </a> 
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
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('fees_module/add_fees_post', array('class' => 'form-horizontal', 'id' => 'addFeesStucFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
           
            <div class="control-group" id="class_control" >
              <label class="control-label" for="class">Select Class</label>
              <div class="controls">
                <select id="class" data-rel="chosen" name="class"  >
                  <option value="0">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo->id;?>"><?php echo $classinfo->name;?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="school_fees_control">
              <label class="control-label" for="inputSuccess">Tution Fees</label>
              <div class="controls">
                <input type="text" id="school_fees"  name="school_fees" onkeyup="feestotal()" >
                <span class="help-inline" id="school_fees_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="hostel_fees_control">
              <label class="control-label" for="inputSuccess">Hostel Fees</label>
              <div class="controls">
                <input type="text" id="hostel_fees"  name="hostel_fees" onkeyup="feestotal()" >
                <span class="help-inline" id="hostel_fees_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="admission_fees_control">
              <label class="control-label" for="inputSuccess">Fooding Fees</label>
              <div class="controls">
                <input type="text" id="admission_fees"  name="admission_fees" onkeyup="feestotal()" >
                <span class="help-inline" id="admission_fees_message" style="display:none;"></span> </div>
            </div>
            
            <!--<div class="control-group" id="electric_charge_control">
              <label class="control-label" for="inputSuccess">Electric Charge</label>
              <div class="controls">
                <input type="text" id="electric_charge"  name="electric_charge" onkeyup="feestotal()" >
                <span class="help-inline" id="electric_charge_message" style="display:none;"></span> </div>
            </div>-->
            
            <div class="control-group" id="total_control">
              <label class="control-label" for="inputSuccess">Total</label>
              <div class="controls">
                <input type="text" id="total"  name="total"  >
                <span class="help-inline" id="total_message" style="display:none;"></span> </div>
            </div>
           
             
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form();" >Save changes</button>
  </div>
  </form>
</div>

<!----------------------------------------Edit----------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('fees_module/edit_fees_post', array('class' => 'form-horizontal', 'id' => 'editFeesStucFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
          
                	<input type="hidden" id="id"  name="id" readonly="readonly" >
                    
              <div class="control-group" id="class_control" >
              <label class="control-label" for="class">Select Class</label>
              <div class="controls">
                <select id="edit_class"  name="edit_class"  >
                  <option value="0">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo->id;?>"><?php echo $classinfo->name;?></option>                 
                  <?php endforeach;?>
                </select>
                  <span class="help-inline" id="edit_class_name" style="display:none;"><?php echo $classinfo->name;?></span>
                
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="edit_school_fees_control">
              <label class="control-label" for="inputSuccess">Tution Fees</label>
              <div class="controls">
                <input type="text" id="edit_school_fees"  name="edit_school_fees" onkeyup="editfeestotal()" >
                <span class="help-inline" id="edit_school_fees_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="edit_hostel_fees_control">
              <label class="control-label" for="inputSuccess">Hostel Fees</label>
              <div class="controls">
                <input type="text" id="edit_hostel_fees"  name="edit_hostel_fees"  onkeyup="editfeestotal()">
                <span class="help-inline" id="edit_hostel_fees_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="edit_admission_fees_control">
              <label class="control-label" for="inputSuccess">Fooding Fees</label>
              <div class="controls">
                <input type="text" id="edit_admission_fees"  name="edit_admission_fees"  onkeyup="editfeestotal()" >
                <span class="help-inline" id="edit_admission_fees_message" style="display:none;"></span> </div>
            </div>
            
           <!-- <div class="control-group" id="edit_electric_charge_control">
              <label class="control-label" for="inputSuccess">Electric Charge</label>
              <div class="controls">
                <input type="text" id="edit_electric_charge"  name="edit_electric_charge"  onkeyup="editfeestotal()" >
                <span class="help-inline" id="edit_electric_charge_message" style="display:none;"></span> </div>
            </div>-->
            
            <div class="control-group" id="edit_total_control">
              <label class="control-label" for="inputSuccess">Total</label>
              <div class="controls">
                <input type="text" id="edit_total"  name="edit_total"  readonly="readonly">
                <span class="help-inline" id="edit_total_message" style="display:none;"></span> </div>
            </div>            
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" >Save changes</button>
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

<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">
function openedit_model(id)
{
	//alert(id);
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+id ;
		//alert(dataString);
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/fees_module/edit_fees",  
				  data: dataString,
				  async: false,  
				  success: function(data) {					   
						var edit_fees=data.edit_fees[0];						
						$("#id").val(id);
						$("#edit_class").val(edit_fees.class_id);
						$("#edit_school_fees").val(edit_fees.school_fees);
						$("#edit_hostel_fees").val(edit_fees.hostel_fees);
						$("#edit_admission_fees").val(edit_fees.admission_fees);
						//$("#edit_electric_charge").val(edit_fees.electric_charge);
						$("#edit_total").val(edit_fees.total);											
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

function deleteFees(id)
{
	//alert(id);
	if(id)
	{		
	var base_url='<?php echo base_url();?>'; 
		if(confirm('Are you sure do you want to delete this Fees structure?')){		
					 $.ajax({
					  type:"POST",
					  url: "<?php echo base_url() ?>index.php/fees_module/delete_fees",
					  data:{deleteid:id},
					  success:function(msg){				
						 
						  }
				  });
				  
				  $('#myOKModal').modal('show');
				  
		}
	}
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