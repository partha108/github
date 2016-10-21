<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Current Concession And Special Fees </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Current Concession And Special Fees</h2>
      </div>
      <div class="box-content">
      
     <?php echo form_open_multipart('concession/concessionandspecial', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); ?> 
       
       		<div class="control-group" id="user_control">                           
            	<div class="control-group" id="user_control">
                  <label class="control-label" for="user">Select Class</label>
                  <div class="controls">
                    <select id="class"  name="class"  onchange="onChangeClass()">
                      <option value="0">--Select Class--</option>
                      <?php  foreach($class as $classinfo):?>
                      <option value="<?php echo $classinfo->id;?>" <?php if($class_id==$classinfo->id){ echo "selected";}?>><?php echo $classinfo->name;?></option>
                      <?php endforeach;?>
                    </select>
               		</div>
           	 	</div>
            </div>         
        </form> 
        <span style="color:red;"><?php echo $this->session->flashdata('amount'); ?></span>
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>              
              <th>Registration No</th> 
              <th>Name</th>             
               <!--<th>Special Fees</th>
               <th>Concession</th> -->            
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
             <td><?php echo $row->registration_no ;?></td>
             <td><?php echo $row->name;?></td>
             <?php /*?> <td><?php echo $row->specialfee ;?></td>
              <td><?php echo $row->concession ;?></td><?php */?>
              <td>             
                  <a class="btn btn-info" 
                  href="<?php echo base_url();?>index.php/concession/concession_user_id?id=<?php echo $row->user_id;?>" 
                  > Concession Fees</a> <!--onclick="myConcessionModal('<?php //echo $row->id;?>','<?php //echo $row->concessionuser_id;?>')"-->
                  <a class="btn btn-info" 
                  href="<?php echo base_url();?>index.php/specialfees/special_user_id?id=<?php echo $row->user_id;?>" 
                  > Special Fees </a>   <!--onclick="mychargeModal('<?php //echo $row->id;?>','<?php //echo $row->specialuser_id;?>')"-->           
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
<div class="modal hide fade" id="mychargeModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('concession/othercharge_post', array('class' => 'form-horizontal', 'id' => '')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Change Special Fees
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
           <input type="hidden" id="userid" name="userid" value=""  />
           <input type="hidden" id="roleid" name="roleid" value=""  />
            <input type="hidden" id="month_value" name="month_value" value=""  /> 
            <input type="hidden" id="year_value_charge" name="year_value_charge" value=""  />
            
            <div class="control-group"  id="charge_amount_control">
              <label class="control-label" for="inputSuccess">Charge Amount</label>
              <div class="controls">
                <input type="text" id="charge_amount"  name="charge_amount" value="">
                <span class="help-inline" id="charge_amount_message" style="display:none;"></span> </div>
            </div>
           
            <div class="control-group"  id="charge_reason_control">
              <label class="control-label" for="inputSuccess">The Reason Of Charge</label>
              <div class="controls">
                <textarea id="charge_reason"  name="charge_reason"  rows="" cols="" >
                </textarea>
                <span class="help-inline" id="charge_reason_message" style="display:none;"></span> </div>
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
            <input type="hidden" id="year_value_concession" name="year_value_concession" value=""  />
            
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
	function myConcessionModal(id,concessionuser_id)
	{
		$('#uid').val(id);
		$('#concessionuser_id').val(concessionuser_id);
		var datastring='id='+concessionuser_id;
		$.ajax({
			url:base_url+"index.php/concession/concession_user_id",
			type:"POST",
			dataType:"json",
			data: datastring,
			async: false,  
			success: function(data){
				console.log(data);
				$("#concession_amount_modal").val(data.edit[0]['concession_amount']);	
				$("#concession_list option[value='"+data.edit[0]['id']+"']").attr("selected", "selected");
				$("#effective_month").val(data.edit[0]['effective_month']);
			}
			
		});
		$('#myConcessionModal').modal('show');
	}
	
	function mychargeModal(id,specialuser_id)
	{
		$('#mychargeModal').modal('show');
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

</script>