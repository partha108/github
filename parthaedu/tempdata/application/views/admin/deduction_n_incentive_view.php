<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Details <?php if(isset($for)){ echo  $for;}?> </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Details <?php if(isset($for)){ echo $for;}?></h2>
      </div>
      <div class="box-content">
      
       <div><?php echo $this->session->flashdata('change_con');?></div>
       <div><a href="javascript:void(0);" onclick="myaddModal()" class="btn btn-primary"  >Add</a></div> 
            
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>              
              <th>User ID</th> 
              <th>Name</th> 
               <th>Amount</th>
               <th>Effective Month</th>
               <th>End Month</th>         
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($user_list))
				{
					foreach($user_list as $row){
			?>
            <tr>
             <td><?php echo $row->user_id ;?></td>
             <td><?php echo $row->name;?></td>
              <td><?php echo $row->amount ;?></td>
                <td><?php echo date("F",strtotime($row->effective_month)).','.date("Y",strtotime($row->effective_month));//$row->effective_month ;?></td>
                  <td><?php echo date("F",strtotime($row->endmonth)).','.date("Y",strtotime($row->endmonth));//$row->endmonth ;?></td>
               
              <td>
              <?php if(isset($row->con_id)){ 
			  	$for_id=$row->con_id; $model='concession_control';?>            
                  <a class="btn btn-info" href="javascript:void(0)" 
                  onclick="myConcessionModal('<?php echo $row->user_id;?>','<?php echo $for_id;?>','<?php echo $row->effective_month ;?>')" > 
                 Cange Deduction</a> 
                 
                   <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="deleteitem('<?php echo $row->user_id;?>','<?php echo $for_id;?>')" 
                  > Delete</a>
                  <?php }else{ 
				  		$for_id=$row->special_id; $model='special_control'; ?>
						 <a class="btn btn-info" href="javascript:void(0)" 
                 	 onclick="mySpecialModal('<?php echo $row->user_id;?>','<?php echo $for_id;?>','<?php echo $row->effective_month ;?>')" > 
                  		Cange Incentive</a>
                        
                   <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="deleteitem_incentive('<?php echo $row->user_id;?>','<?php echo $for_id;?>')" 
                  > Delete</a>      
                        
					<?php	}
                ?>
                                        
              </td>
            </tr>
            <?php } } ?>
            
          </tbody>
        </table>
        
       		 
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>


<!--------------------------------------------------------------------Other charge --------------------------------------------------------->
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
<?php if($model=='concession_control'){?>
 <?php echo form_open_multipart('deductionandincentive/userforconcession_add', array('class' => 'form-horizontal', 'id' => 'userAddConcession')); 
	}else{		
		echo form_open_multipart('deductionandincentive/userincentive', array('class' => 'form-horizontal', 'id' => 'userAddIncentive')); 
	}
 ?>
 
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Concession
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             
           <input type="hidden" id="userid" name="userid" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>"  />
            <input type="hidden" id="add_concessionuser_id" name="add_concessionuser_id" value="<?php if(isset($_GET['conuser_id'])){echo $_GET['conuser_id'];}?>"  />
             
             <div class="control-group"  <?php if($model=='concession_control'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
              <label class="control-label" for="inputSuccess">Concession</label>
              <div class="controls">
              <select id="ad_concession_list" name="ad_concession_list"  onchange="concession_add(this.value)" >
               <option value="0">--Select Concession--</option>
                  <?php  foreach($concession as $concsn){     ?>
                  <option value="<?php echo $concsn->id;?>" ><?php echo $concsn->concession_type;?></span>
                 </option>
                  <?php }?>
                </select>
              </div>
            </div>
            
            <div class="control-group" <?php if($model=='special_control'){echo 'style="display:block"';}else{echo 'style="display:none"';}?> >
              <label class="control-label" for="inputSuccess">Special Amount</label>
              <div class="controls">
              <select id="ad_special_list" name="ad_special_list"  onchange="specialfees_add(this.value)" >
               <option value="0">--Select Special--</option>
                  <?php  foreach($concession as $concsn){     ?>
                  <option value="<?php echo $concsn->id;?>" ><?php echo $concsn->specialfees;?></span>
                 </option>
                  <?php }?>
                </select>
              </div>
            </div>
           
            <div class="control-group"  id="concession_amount_modal_control">
              <label class="control-label" for="inputSuccess">Concession Amount</label>
              <div class="controls">
                <input type="text" id="ad_concession_amount_modal"  name="ad_concession_amount_modal" value="" readonly="readonly" >
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Effective Month</label>
              <div class="controls">
                <input type="text" id="ad_effective_month"  name="ad_effective_month" value="" class="datepicker_" >
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">End Month</label>
              <div class="controls">
                <input type="text" id="ad_end_month"  name="ad_end_month" value="" class="datepicker_" >
               </div>
            </div>
           </div> 
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  >Add</button>
  </div>
  </form>
</div>

<!----------------------------------------------------------------Deduction------------------------------------------------------------>
<div class="modal hide fade" id="myConcessionModal" style="width:1000px; left:40%"> 
<?php if($model=='concession_control'){?>
 <?php echo form_open_multipart('deductionandincentive/userforconcession_add', array('class' => 'form-horizontal', 'id' => '')); 
	}else{		
		echo form_open_multipart('deductionandincentive/userincentive', array('class' => 'form-horizontal', 'id' => '')); 
	}
 ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Change Concession
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
           <input type="hidden" id="uid" name="uid" value=""  />
            <input type="hidden" id="concessionuser_id" name="concessionuser_id" value=""  />
            <input type="hidden" id="orig_effective_month" name="orig_effective_month" value=""  />
             <input type="hidden" id="orig_end_month" name="orig_end_month" value=""  />
          
             <div class="control-group"  id="concession_control" <?php if($model=='concession_control'){echo 'style="display:block"';}else{echo 'style="display:none"';}?> >
              <label class="control-label" for="inputSuccess">Concession Amount</label>
              <div class="controls">
              <select id="concession_list" name="concession_list"  onchange="concession_(this.value)" >
               <option value="0">--Select Concession--</option>
                  <?php  foreach($concession as $concsn){     ?>
                  <option value="<?php echo $concsn->id;?>" ><?php echo $concsn->concession_type;?></span>
                 </option>
                  <?php }?>
                </select>
              </div>
            </div>
            
            <div class="control-group"  id="special_control" <?php if($model=='special_control'){echo 'style="display:block"';}else{echo 'style="display:none"';}?> >
              <label class="control-label" for="inputSuccess">Special Amount</label>
              <div class="controls">
              <select id="special_list" name="special_list"  onchange="specialfees_add(this.value)" >
               <option value="0">--Select Special--</option>
                  <?php  foreach($concession as $concsn){     ?>
                  <option value="<?php echo $concsn->id;?>" ><?php echo $concsn->specialfees;?></span>
                 </option>
                  <?php }?>
                </select>
              </div>
            </div>
           
            <div class="control-group"  id="concession_amount_modal_control">
              <label class="control-label" for="inputSuccess"> Amount</label>
              <div class="controls">
                <input type="text" id="concession_amount_modal"  name="concession_amount_modal" value="" readonly="readonly" >
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Effective Month</label>
              <div class="controls">
                <input type="text" id="effective_month"  name="effective_month" value="" class="datepicker_" >
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">End Month</label>
              <div class="controls">
                <input type="text" id="end_month"  name="end_month" value="" class="datepicker_" >
               </div>
            </div>
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  onclick="validation_concession();" >Add</button>
  </div>
  </form>
</div>

<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>

<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">
	
	function mySpecialModal(id,con_id,effective)
	{
		$('#uid').val(id);
		$('#concessionuser_id').val(con_id);
		 $('#orig_effective_month').val(effective);
		 
		var datastring='con_id='+con_id;
		$.ajax({
			url:base_url+"index.php/deductionandincentive/incentiveby_id",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){
				//console.log(data);
				$("#concession_amount_modal").val(data.edit[0]['amount']);	
				$("#special_list option[value='"+data.edit[0]['specialfees_id']+"']").attr("selected", "selected");
				$("#effective_month").val(data.edit[0]['effective_month']);
				$("#end_month").val(data.edit[0]['endmonth']);
				$("#orig_end_month").val(data.edit[0]['endmonth']);
			}
			
		});
		$('#myConcessionModal').modal('show');
	}
	
	function myConcessionModal(id,con_id,effective)
	{
		$('#uid').val(id);
		$('#concessionuser_id').val(con_id);
		 $('#orig_effective_month').val(effective);
		 
		var datastring='con_id='+con_id;
		$.ajax({
			url:base_url+"index.php/deductionandincentive/deductionby_id",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){
				//console.log(data);
				$("#concession_amount_modal").val(data.edit[0]['amount']);	
				$("#concession_list option[value='"+data.edit[0]['concession_id']+"']").attr("selected", "selected");
				$("#effective_month").val(data.edit[0]['effective_month']);
				$("#end_month").val(data.edit[0]['endmonth']);
				$("#orig_end_month").val(data.edit[0]['endmonth']);
			}
			
		});
		$('#myConcessionModal').modal('show');
	}
	
	function myaddModal()
	{
		$('#myAddModal').modal('show');
	}
	
	function concession_(value_)
	{
		var datastring='id='+value_;
		$.ajax({
			url:base_url+"index.php/concession/concession_data_byId",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){				
				$("#concession_amount_modal").val(data.edit[0]['concession_amount']);	
			}
			
		});
	}
	function concession_add(value_)
	{
		var datastring='id='+value_;
		$.ajax({
			url:base_url+"index.php/concession/concession_data_byId",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){				
				$("#ad_concession_amount_modal").val(data.edit[0]['concession_amount']);	
			}
			
		});
	}
	
function specialfees_add(value_)
{	
	var datastring='id='+value_;
	$.ajax({
		url:base_url+"index.php/specialfees/get_specialfee",
		type:"POST",
		dataType:"json",
		data: datastring,
		async: false,  
		success: function(data){
			//console.log(data);
			$("#ad_concession_amount_modal").val(data.edit[0]['specialamount']);	
		}
	});
}

function deleteitem(uid,id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='concession_teacher';
	var column='con_id';
	var page='deductionandincentive/deduction?id='+uid;
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/deductionandincentive/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}


function deleteitem_incentive(uid,id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='specialfees_teacher';
	var column='special_id';
	var page='deductionandincentive/incentive?id='+uid;
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/deductionandincentive/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

</script>