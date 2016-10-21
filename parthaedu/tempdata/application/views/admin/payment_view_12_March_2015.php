<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li>  <?php if($this->uri->uri_string()=='fees')
			{?>
            <a href="<?php echo base_url();?>index.php/fees"> Student Payment</a>
            <?php }else{?>
            <a href="<?php echo base_url();?>index.php/salary">Salary Payment</a>
            <?php } ?> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2>
         <?php if($this->uri->uri_string()=='fees')
			{?>
        		Student Payment
         <?php }else{?>
         Salary Payment
         <?php } ?>
        </h2>
          <div style="float:right"><a id="" href="<?php echo base_url()?>index.php/salary/download_file/paymentlist.xls" > Export As Excel Sheet </a></div>
    
      </div>
      <div class="box-content" >
     
       <?php if($this->uri->uri_string()=='fees')
			{  
      			echo form_open_multipart('fees', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 
			}else{
				echo form_open_multipart('salary', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 
				
			}?>        
        
       <div class="control-group" id="user_control">
              <label class="control-label" for="user">Select Month </label>
              
              <div class="controls">
                <select id="month" name="month"  onchange="changeMonth(this.value);">
                  <option value="0">--Select Month--</option>
                  <?php  for($m=1; $m<=count($months); $m++){  ?> 
                  <option value="<?php echo $m;?>" <?php if($m== $month_value){echo "selected"; } ?> ><?php echo $months[$m];?></option>
                 <?php }?>
                </select>
                
                  <select id="year" name="year" onchange="changeYear(this.value);"  disabled="disabled">
                  <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($year); $y++){  
				  ?>
                  <option value="<?php echo $year[$y];?>" <?php if($year[$y]== $year_value){echo "selected"; } ?> ?> <?php echo $year[$y];?></option>
                 <?php }?>
                </select>    
                <span class="help-inline" id="user_message" style="display:none;"></span> 
                </div>
           
             <?php if($this->uri->uri_string()=='fees')
			{  ?>
   
          		<div class="control-group" id="user_control">
                  <label class="control-label" for="user">Select Class</label>
                  <div class="controls">
                    <select id="class"  name="class"  onchange="onChangeClass()">
                      <option value="0">--Select Class--</option>
                      <?php  foreach($class as $classinfo):?>
                      <option value="<?php echo $classinfo->id;?>" <?php if($class_id==$classinfo->id){ echo "selected";}?> >
					  	<?php echo $classinfo->name;?>
                      </option>
                      <?php endforeach;?>
                    </select>
               		</div>
           	 </div>
           <?php } ?>
             
            </div>         
        </form> 
        <span style="color:red;"><?php echo $this->session->flashdata('amount'); ?></span>
     <div id="printdiv">
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr> 
             <?php if($this->uri->uri_string()=='fees')
			{?>            
              <th>Registration No</th> 
              <th>Name</th>             
              <th>Monthly Fee</th> 
               <th>Special Charges</th>
               <th>Concession</th>            
               <th>Session Charge</th>
               <th>Deposit</th>
               <th>Paid Late Fine</th>
               <?php }else{?>  
                <th>Sl. No.</th> 
             	 <th>Name</th>             
              	<th>Monthly Salary</th> 
              	 <th>Incentive</th>
              	 <!--<th>Concession</th>-->
               <?php } ?>            
               <th>Total For Month</th>               
               <th>Paid For Month</th>
               <th>Due For Month</th>              
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($user_list))
				{
					foreach($user_list as $row){
						$latefine=0;
			?>
            <tr>
           
             <td><?php echo $row->registration_no ;?></td>
             <td><?php echo $row->name;?></td>
             <td><?php echo $row->class_fees ;?></td>            
              <td><?php echo $row->specialfees ;?></td>
              
                <?php if($this->uri->uri_string()=='fees')
					{ $latefine=$row->latefine;
			?>
         	 <td><?php echo $row->concession ;?></td>
              <td><?php echo $row->session_charge ;?></td>
              <td><?php echo $row->security_deposit ;?></td>
              <td><?php echo $row->latefine ; ?></td>
              <?php } ?>
              <td><?php echo number_format(($row->totfees + $latefine),2) ;?></td>
              <td><?php echo $row->paid ;?></td>
              <td><?php echo $row->nowdue; ?></td>
              <td>          
            <?php 
	if($this->uri->uri_string()!='salary')
	{
			if($row->payment_status=='paid'){ 
			echo "Paid";
			?>
           <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/fees?payuser=<?php echo $row->user_id?>&class=<?php echo $class_id;?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>" > 				
                Show Details </a>
              <?php }else{
						?>
			 <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/fees?payuser=<?php echo $row->user_id?>&class=<?php echo $class_id;?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>" > 
                 Go to Pay </a>		
					<?php	}	?>
              
              
             <?php if($month_value==1){?>
             <a class="btn btn-info" 
      href="javascript:void(0)" onclick="session_update('<?php echo $row->name?>','<?php echo $row->user_id?>','<?php echo $class_id;?>','<?php echo $year_value?>','<?php echo $row->session_charge ;?>')" > 
                  Change Session </a> 
            <?php } ?>   
              
              
              </td>
              
              
              
            </tr>
            <?php 
	}else{
		if($row->payment_status=='paid'){ 
			echo "Paid";
			?>
           <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $row->user_id?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>" > 				
                Show Details </a>
              <?php }else{
						?>
			 <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $row->user_id?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>" > 
                  Pay </a>		
					<?php	}	?>
              </td>
              
         
              
            </tr>
            <?php 
		
	}
			} } ?>
            
          </tbody>
        </table>
        </div>
       		 
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>

<!------------------------------------------------------------Pay modal------------------------------------------------>

<div class="modal hide fade" id="myPayModal" style="width:1000px; left:40%"> 
<?php echo form_open('fees/payment_post', array('class' => 'form-horizontal', 'id' => 'paymentPostFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Payment</h3>
  </div>
  <div class="modal-body">
  			<input type="hidden" id="user_id"  name="user_id" value="" >
            <input type="hidden" id="class_id"  name="class_id" value="" >
            <input type="hidden" id="due"  name="due" value="" >
            <input type="hidden" id="paid"  name="paid" value="" >
            <input type="hidden" id="paid_amount"  name="paid_amount" value="" >
             <input type="hidden" id="paid_month"  name="paid_month" value="" > 
             <input type="hidden" id="paid_year"  name="paid_year" value="" >
             <input type="hidden" id="role_id"  name="role_id" value="" >
            
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Fees Of the Month</label>
              <div class="controls">
                <input type="text" id="feesmonth"  name="feesmonth" value="" readonly="readonly">                
                </div>
            </div>
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Total Due</label>
              <div class="controls">
                <input type="text" id="totdue"  name="totdue" value="" readonly="readonly">                
                </div>
            </div>
            
    		<div class="control-group"  >
              <label class="control-label" for="inputSuccess">Payable Amount</label>
              <div class="controls">
                <input type="text" id="payable"  name="payable" value="" readonly="readonly">                
                </div>
            </div>
                       
            <div class="control-group" id="amount_control" >
              <label class="control-label" for="inputSuccess">Amount</label>
              <div class="controls">
                <input type="text" id="amount"  name="amount" onkeypress="dueAmount();" onchange="dueAmount();"  >                
                <span class="help-inline" id="amount_message" style="display:none;"></span> 
               </div>
            </div>
            
             <div class="control-group" id="due_amount_control" >
              <label class="control-label" for="inputSuccess">Due Amount</label>
              <div class="controls">
             	 <input type="text" id="due_payable"  name="due_payable"  readonly="readonly" >
                <input type="hidden" id="due_amount"  name="due_amount"  readonly="readonly" >
                <span class="help-inline" id="due_amount_message" style="display:none;"></span>
                <span class="help-inline" id="due_message" style="display:none;"></span>
              </div>
            </div>
            
            <div class="control-group" id="due_reason_control" >
              <label class="control-label" for="inputSuccess">Due Reason</label>
              <div class="controls">
                
               <textarea id="due_reason" name="due_reason" rows="" cols=""></textarea>
                <span class="help-inline" id="due_reason_message" style="display:none;"></span>
              </div>
            </div>
    
  </div>
   <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="payment_validation();">Pay</button>
  </div>
  </form>
</div>


<div class="modal hide fade" id="mysessionModal" style="width:1000px; left:40%"> 
<?php echo form_open('studentlist/sessionupdate', array('class' => 'form-horizontal', 'id' => 'paymentPostFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3> <span id="span_name"></span></h3>
  </div>
  <div class="modal-body">
  
    
  <div class="control-group" id="" >
      <label class="control-label" for="inputSuccess">Session</label>
      <div class="controls">        
       <input type="number" step="any" id="editsession" name="session" />
        <input type="text" id="edituserid" name="userid" />
        <input type="text" id="editclass" name="class" />
        <input type="text" id="edityear" name="year" />
        <span class="help-inline" id="session_message" style="display:none;"></span>
      </div>
    </div>
  
   </div>
   <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" >Save</button>
  </div>
  </form>
</div>


<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">

function session_update(name,userid,class_id,year_value,session_charge)
{
	
	$('#span_name').text(name);
	$('#editsession').val(session_charge);
	$('#edituserid').val(userid);
	$('#editclass').val(class_id);
	$('#edityear').val(year_value);
	$('#mysessionModal').modal('show');
	
}
		
		
		
</script>