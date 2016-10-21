<script>
//$(document).ready(function() { window.close(); });
function CloseAndRefresh()
{
	window.close();
	//opener.location.reload(true);
}
</script>
<!------------------------------------------------Add ---------------------------------------------------------->

 <?php echo form_open_multipart('fees/othercharge_post', array('class' => 'form-horizontal', 'id' => 'otherchargeFrm')); ?>
  <div class="modal-header">
   
    <h3>Add Charge
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>
           
           <input type="hidden" id="user_id" name="user_id" value="<?php echo $id; ?>"  />
           <input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id; ?>"  />
            <input type="hidden" id="month_value" name="month_value" value="<?php echo $month_value; ?>"  />
            
           <?php  $amount=0; $reason=""; $effective_month="";
		   		if(count($user_exists_in_table)>0){
			   		foreach($user_exists_in_table as $item){
						$amount=$item->charge_amount ;
						$reason=$item->charge_reason ;
						$effective_month=$item->effective_month;
					}
		   		}else{
					$amount=0; $reason=""; $effective_month="";
				}
				?>
            <div class="control-group"  id="charge_amount_control">
              <label class="control-label" for="inputSuccess">Charge Amount</label>
              <div class="controls">
                <input type="text" id="charge_amount"  name="charge_amount" value="<?php echo $amount; ?>">
                <span class="help-inline" id="charge_amount_message" style="display:none;"></span> </div>
            </div>
           
            <div class="control-group"  id="charge_reason_control">
              <label class="control-label" for="inputSuccess">The Reason Of Charge</label>
              <div class="controls">
                <textarea id="charge_reason"  name="charge_reason"  rows="" cols="" ><?php echo $reason; ?>
                </textarea>
                <span class="help-inline" id="charge_reason_message" style="display:none;"></span> </div>
            </div>
            
            <!--<div class="control-group" id="effective_month_control">
              <label class="control-label" for="inputSuccess">For Month</label>
              <div class="controls">
                <input type="text" id="effective_month" class="datepicker"  name="effective_month" value="<?php echo $effective_month; ?>" >
                <span class="help-inline" id="effective_month_message" style="display:none;"></span> </div>
            </div>-->
          
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn"  onclick="closeWindow();">Close</a>
    <button type="submit" class="btn btn-primary"  >Add</button>
  </div>
  </form>



<script>
function closeWindow(){
close();
}

 function submitForm()  
{  
      
    document.forms.submit();  
      
} 

</script>