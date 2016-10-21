<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="<?php echo base_url();?>index.php/concession/concessionandspecial">Current Concession And Charges </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Concession Details <?php if(isset($name)){ echo 'of '.$name;}?></h2>
      </div>
      <div class="box-content">
      
     
        <span style="color:red;"><?php echo $this->session->flashdata('change_con'); ?></span>
       
       <div><a href="javascript:void(0);" onclick="myaddModal()" class="btn btn-primary"  >Add</a></div> 
            
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>              
              <th>Registration No</th> 
              <th>Name</th> 
               <th>Concession</th>
               <th>Effective Month</th>
               <th>End Month</th>         
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($concession_user))
				{
					foreach($concession_user as $row){
			?>
            <tr>
             <td><?php echo $row->registration ;?></td>
             <td><?php echo $row->name;?></td>
              <td><?php echo $row->amount ;?></td>
                <td><?php echo date("F",strtotime($row->effective_month)).','.date("Y",strtotime($row->effective_month)) ;?></td>
                <td><?php echo date("F",strtotime($row->endmonth)).','.date("Y",strtotime($row->endmonth));?></td>
              <td>
              <?php /*?><?php if($row->enable=='Enabled' || $row->enable=='New' ){?><?php */?>             
                  <a class="btn btn-info" 
                  href="javascript:void(0)" onclick="myConcessionModal('<?php echo $row->user_id;?>','<?php echo $row->id;?>','<?php echo $row->effective_month ;?>','<?php echo $row->endmonth ;?>')" 
                  > Concession Fees</a> 
                   <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="deleteitem('<?php echo $row->user_id;?>','<?php echo $row->id;?>')" 
                  > Delete</a>
                  
                  
                  <?php //} ?>                          
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
 <?php echo form_open_multipart('concession/userforconcession_add', array('class' => 'form-horizontal', 'id' => 'userAddConcession')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Concession
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             
           <input type="hidden" id="userid" name="userid" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>"  />
            <input type="hidden" id="add_concessionuser_id" name="add_concessionuser_id" value="<?php if(isset($_GET['conuser_id'])){echo $_GET['conuser_id'];}?>"  />
             
             <div class="control-group"  id="concession_control">
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

<!----------------------------------------------------------------Concession------------------------------------------------------------>
<div class="modal hide fade" id="myConcessionModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('concession/concession_post', array('class' => 'form-horizontal', 'id' => '')); ?>
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
            
             <div class="control-group"  id="concession_control">
              <label class="control-label" for="inputSuccess">Concession</label>
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
           
            <div class="control-group"  id="concession_amount_modal_control">
              <label class="control-label" for="inputSuccess">Concession Amount</label>
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
	function myConcessionModal(id,concessionuser_id,effective,endmonth)
	{
		$('#uid').val(id);
		$('#concessionuser_id').val(concessionuser_id);
		 $('#orig_effective_month').val(effective);
		 $("#end_month").val(endmonth);
		 
		var datastring='concessionuser_id='+concessionuser_id;
		$.ajax({
			url:base_url+"index.php/concession/concessionuser_id",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){
				//console.log(data);
				$("#concession_amount_modal").val(data.edit[0]['amount']);	
				$("#concession_list option[value='"+data.edit[0]['concession_id']+"']").attr("selected", "selected");
				$("#effective_month").val(data.edit[0]['effective_month']);
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
	
	function deleteitem(uid,id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='concession_user';
	var column='id';
	var page='concession/concession_user_id?id='+uid;
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/concession/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

</script>