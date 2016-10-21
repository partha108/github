<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li>  <?php if($this->uri->uri_string()=='fees')
			{?>
            <a href="<?php echo base_url();?>index.php/fees"> Payment</a>
            <?php }else{?>
            <a href="<?php echo base_url();?>index.php/salary"> Payment</a>
            <?php } ?>
            </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> 
        <?php if($this->uri->uri_string()=='salary')
			{?>
           Salary
            <?php }if(isset($name)){ echo "Payment List Of ".$name;}?>
        
        </h2>
          <div style="float:right"><a id="" href="<?php echo base_url()?>index.php/salary/download_file/user_paymentlist.xls">Export As Excel Sheet </a></div>
      </div>
      
       <div class="box-content">
      <?php // print_r($_SERVER['QUERY_STRING']);	  
	  $path=$this->uri->uri_string().'?'.$_SERVER['QUERY_STRING'];
	 
	  $this->session->set_userdata('inv_path',$path);
	  if($this->uri->uri_string()=='fees')
			{  
      			echo form_open_multipart('fees', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 
			}else{
				echo form_open_multipart('salary', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 
				
			}?>        
      
            
             
             
            </div>         
        </form> 
       </div>
      <div class="box-content">
          <span style="color:#F00"><?php echo $this->session->flashdata('message');?></span>
          <span style="color:#F00"><?php echo $this->session->flashdata('amount');?></span>
           
     <?php if($this->uri->uri_string()=='fees'){
			if(isset($_GET['month_status']))
			{
				if($_GET['month_status']=='all')
				{
			?>
			<a class="btn btn-info"    
  href="<?php echo base_url();?>index.php/fees?payuser=<?php echo $user_id;?>&class=<?php echo $class_id;?>&month=<?php echo $month_value;?>&year=<?php echo $year_value;?>&month_status=no">Current Month</a>
		<?php	}else{?>
			
			<a class="btn btn-info"    
  href="<?php echo base_url();?>index.php/fees?payuser=<?php echo $user_id;?>&class=<?php echo $class_id;?>&month=<?php echo $month_value;?>&year=<?php echo $year_value;?>&month_status=all">Show All Months</a>  	
				<?php }
			}
		 ?>     
  <?php } 
  		else{			
			if(isset($_GET['month_status']))
			{
				if($_GET['month_status']=='all')
				{?>
			<a class="btn btn-info" 
  href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $user_id?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>&month_status=no" >Current Month</a>
  			<?php }else{?>
			
			 <a class="btn btn-info" 
  href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $user_id?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>&month_status=all" >Show All Months</a>
  			<?php }
			}else{			
			?>
        
  <a class="btn btn-info" 
  href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $user_id?>&month=<?php echo $month_value;?>&year=<?php echo $year_value?>&month_status=all" >Show All Months</a>
  
  <?php }} ?>
 
      <div id="printdiv">
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
               <th>No.</th>  
               <th>Month</th>                          
                       
               <th>Paid</th>
               <th>Due</th>
               <th>Due Reason</th>                
              <!-- <th>Payable</th> --> 
              <?php
				if($this->uri->uri_string()=="fees")
			  {?>              
               <th>Paid Late Fine</th>
               <?php } ?>
               <th>Invoice</th> 
               <th>Payment Date</th>
                  <th>Total Amount</th>     
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				$count=0;
				if(isset($user_list))
				{
					foreach($user_list as $row){
						$count++;
						
			?>
            <tr>
             <td><?php echo $count ;?></td>
             
              <td><?php echo $row['full_month'] ;?></td>
              
              <td><?php echo $row['paid'] ;?></td>
              <td><?php echo number_format(($row['payable']),2) ;?> <?php //echo $row['due']; ?></td>
               <td><?php echo $row['due_reason']; ?></td>
             
                <?php /*?><td><?php echo number_format(($row['payable']),2) ;?></td><?php */?>
                
                <?php
				if($this->uri->uri_string()=="fees")
			  {
				 if(isset($row['latefine'])){?>
                <td><?php echo $row['latefine'] ;?></td>
                <?php }else{ ?>
                <td><?php echo 0 ;?></td>
                <?php } 
				
			  }?>
                
              <td><?php echo $row['invoice_no']; if($row['invoice_no']!=''){?>
              <a href="javascript:void(0)" onclick="print_window('<?php echo base_url();?>index.php/reports/invoice_print/<?php echo $row['invoice_no']?>')"
               title="Print" target="_blank" >
              <img src="<?php echo base_url();?>admin_design/print.png"  height="20px" width="20px"/>
              </a>
              <a href="<?php echo base_url();?>index.php/reports/invoice_generate/<?php echo $row['invoice_no']?>"
               title="Export As Doc" target="_blank" >
              <img src="<?php echo base_url();?>uploads/document/img_download.jpg"  height="20px" width="20px"/>
              </a>
              <?php } ?>
              </td>
               <td><?php echo $row['payment_date'] ;?></td>
               
            
              <td>
			  
            
              		<?php 
			  if($this->uri->uri_string()=="fees")
			  {
			 	 echo number_format(($row['totfees'] + $row['latefine'] + $row['medical_crg']),2) ;
			  }else{
				  echo number_format(($row['totfees']),2) ;
			  }
			  ?>
              </td>
              
              <td>
              <?php 
			if(isset($row['medical_crg']))
			{
				$medical_crg=$row['medical_crg'];
			}else{
				$medical_crg=0;	
			}
			
			if(isset($row['medical_crg_paid']))
			{
				$medical_crg_paid=$row['medical_crg_paid'];
			}else{
				$medical_crg_paid='';
			}
			  $data=array(
			   			'user_id'=>$user_id,
						'payable'=>$row['payable'],
						'paid'=>$row['paid'],
						'classid'=>$class_id,
						'due'=>$row['due'],
						'month_value'=>$row['paid_month'],
						'year_value'=>$row['paid_year'],
						'feesmonth'=>$row['totfees'],
						'totdue'=>0	,
						'fullmonth'=>$row['full_month'],
						'medicalcrg'=>$medical_crg,
						'medical_crg_paid'=>$medical_crg_paid		
			   		);
			   ?>               
            <?php if($row['btnpay']=='unpaid'){ ?>
           <a class="btn btn-info" href="javascript:void(0)" onclick="open_pay_modal('<?php echo implode(',',$data);?>')" > 
                  Pay </a>
              <?php }else if($row['btnpay']=='due'){
			  		echo $row['btnpay'];
			  }else{
						echo $row['btnpay'];
						}	?>
     
     
       <?php if($this->uri->uri_string()=='fees')
		{ 
		if($row['invoice_no']!=''){?>
    <a class="btn btn-danger" href="javascript:void(0);"
    onclick="deleteitem('<?php echo $row['invoice_no'];?>','<?php echo $user_id;?>','<?php echo $row['paid_month'];?>','<?php echo $row['paid_year'];?>',<?php echo $class_id;?>)"
     > Delete</a>
     <?php }}
	 else{ 
	 	if($row['invoice_no']!=''){
	 ?>
     
      <a class="btn btn-danger" href="javascript:void();"
     onclick="deleteitem_salary(<?php echo $row['invoice_no'];?>,'<?php echo $user_id;?>','<?php echo $row['paid_month'];?>','<?php echo $row['paid_year'];?>')"
      > Delete</a>
     <?php }} ?>                  
      
     
             
              </td>
            </tr>
            <?php } } ?>            
          </tbody>
        </table>
        </div>
        
              
      </div>
    </div>
  </div>
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
            <input type="hidden" id="pay_class_id"  name="class_id" value="<?php if(isset($_GET['class'])){ echo $_GET['class']; }?>" >
            <input type="hidden" id="due"  name="due" value="" >
            <input type="hidden" id="pay_paid"  name="paid" value="" >
            <input type="hidden" id="paid_amount"  name="paid_amount" value="" >
             <input type="hidden" id="paid_month"  name="paid_month" value="" > 
             <input type="hidden" id="paid_year"  name="paid_year" value="" >
          <?php if($this->uri->uri_string()=='salary')
			{?>	 
           	 <input type="hidden" id="role_id"  name="role_id" value="3" >
            <?php }else{?>
          	  <input type="hidden" id="role_id"  name="role_id" value="2" >
            <?php } ?>
             <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Month For Payment</label>
              <div class="controls">
                  <label class="control-label" for="inputSuccess">
                  	<strong><span id="f_month"></span></strong>
                  </label>              
                </div>
            </div>
            
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Amount Of the Month</label>
              <div class="controls">
                <input type="text" id="feesmonth"  name="feesmonth" value="" readonly="readonly">                
                </div>
            </div>
                        
    		<div class="control-group"  >
              <label class="control-label" for="inputSuccess"> Amount</label>
              <div class="controls">
                <input type="text" id="due_payablee"  name="due_payablee" value="" readonly="readonly">                
                </div>
            </div>
             <?php if($this->uri->uri_string()=='fees')
			{?>
           
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Late Fine</label>
              <div class="controls">
                <input type="text" id="latefine"  name="latefine" onkeyup="lateAmount();" />  
                  <input type="hidden" id="paidlatefine"  name="paidlatefine"  /> 
                  <span id="latefine_message" style="display:none"></span>               
                </div>
            </div>
            
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Medical Charge</label>
              <div class="controls">
                <input type="text" id="medicalcrg"  name="medicalcrg" onkeyup="medicalAmount();" />  
                  <input type="hidden" id="paidmedicalcrg"  name="paidmedicalcrg"  value="" /> 
                  <span id="medicalcrg_message" style="display:none"></span>               
                </div>
            </div>
            
            <?php } ?>
            
            <div class="control-group"  >
              <label class="control-label" for="inputSuccess">Payable Amount</label>
              <div class="controls">
                <input type="text" id="payable"  name="payable" value="" readonly="readonly">                
                </div>
            </div>
                       
            <div class="control-group" id="amount_control" >
              <label class="control-label" for="inputSuccess">Amount</label>
              <div class="controls">
                <input type="text" id="amount"  name="amount"  onchange="dueAmount();" onkeyup="dueAmount();"  >                
                <span class="help-inline" id="amount_message" style="display:none;"></span> 
               </div>
            </div>
            
             <div class="control-group" id="due_amount_control" >
              <label class="control-label" for="inputSuccess">Due Amount</label>
              <div class="controls">
             	
                <input type="text" id="due_amount"  name="due_amount"  readonly="readonly" >
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
    <button type="submit" class="btn btn-primary" onclick="return payment_validation();">Pay</button>
  </div>
  </form>
</div>


<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">
var base_url='<?php echo base_url();?>';
function print_window(url)
{
	var divToPrint=document.getElementById("printoption");
   newWin= window.open(url);
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();	
}



</script>