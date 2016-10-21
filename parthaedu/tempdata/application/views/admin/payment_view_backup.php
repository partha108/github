<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Fees</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Payment</h2>
      </div>
      <div class="box-content">
      
     <?php echo form_open_multipart('fees', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); ?> 
       
       <div class="control-group" id="user_control">
              <label class="control-label" for="user">Select User</label>
              
              <div class="controls">
                <select id="user" name="user"  onchange="onChange()" >
                  
                  <?php  foreach($roles as $user){     if($user['role_id']!=1):?>
                  <option value="<?php echo $user['role_id'];?>" <?php if($current_role==$user['role_id']){ echo "selected";}?>><?php echo $user['role_name'];?></option>
                  <?php endif; }?>
                </select>
                
                <select id="month" name="month"  onchange="changeMonth();">
                  <option value="0">--Select Month--</option>
                  <?php  for($m=1; $m<=count($months); $m++){  ?> 
                  <option value="<?php echo $m;?>" <?php if($m== $month_value){echo "selected"; } ?> ><?php echo $months[$m];?></option>
                 <?php }?>
                </select>
                
                  <select id="year" name="year"  >
                  <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($year); $y++){  
				 $curntYear=date("Y"); ?>
                  <option value="<?php echo $year[$y];?>" <?php if($year[$y]== $curntYear){echo "selected"; } ?> ?> <?php echo $year[$y];?></option>
                 <?php }?>
                </select>    
                <span class="help-inline" id="user_message" style="display:none;"></span> </div>
            </div>
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
                                
         <!--<button type="submit" class="btn btn-primary" onclick="return validate_user_id();">Show User List</button>-->
         
        </form> 
        <span style="color:red;"><?php echo $this->session->flashdata('amount'); ?></span>
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
        
              <th>Registration No</th> 
              <th>Name</th>             
               <th>Monthly Fee</th> 
               <th>Due</th>
               <th>payable</th>         
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          
          <?php $total=0; foreach($monthly as $m){ $total=$m->total; }
		 	 $cur_month=(int)date("m"); $due_next=$month_value-$cur_month; 
				$due_basic=0;
				//for($i=0;$i<$due_next; $i++)
				//{
					$due_basic=$total*$due_next;
				//}
           ?>
          
            <?php $count=0; foreach($user_list as $user){ ?>
            <tr>
              <td><?php echo $user->registration_no;?></td>
              <td ><?php echo $user->first_name." ".$user->middle_name." ".$user->last_name;?></td>              
                <td><?php echo $total; $payable=0; if( $month_value>$cur_month){ echo " * ".$due_next ;}?>
                </td> 
                <td><?php $cur_month=(int)date("m"); $due_rs=0; $payable=$total; $count=0;
				
				if( count($dueList)>0 ){
						foreach($dueList as $due){ 
							if($user->id == $due['user_id'] ){ 
								if($month_value >= ((int)date("m",strtotime($due['payment_date']))))
								{?>							
								 <span class="label label-important">Due</span>
								<?php echo $due['due']."Rs"."<br>"." <span style='font-style:italic; font-size:12px;'>".$due['due_reason']."</span>";
								$due_rs=$due['due'];
								$payable= $total+$due_rs;	$count++;
								
							}}
						}
					}?></td>
                <td><?php echo $payable;?></td>         
              <td ><?php 
					foreach($payment as $pay){ 
			  			if($user->id == $pay->user_id ){  
							if($pay->due==0){?>
                        	<span class="label label-success">Paid</span>
                        	<?php $count++; }  ?>
							<?php /*?>else{ ?>
							 <span class="label label-important">Due</span>
							<?php echo $pay->due ."Rs";	}<?php */?>
					<?php 	}
					}
					
					 if($count==0 ){?>
						<span class="label label-error">Not paid</span>
				<?php	}
				?>
               </td> 
               <?php $data=array(
			   			'user_id'=>$user->id,						
						'role_id'=>$user->role_id,
						'payable'=>$payable,
						'due_rs'=>$due_rs
			   		);
			   ?>
               	
              <td class="center"><a class="btn btn-info" href="#" 
              onclick="open_pay_modal('<?php echo implode(',',$data);?>')"> pay </a>
               </td>
            </tr>
            
            <?php $count=$count+1;}?>
          </tbody>
        </table>
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>

<!------------------------------------------------------------Pay modal------------------------------------------------>

<div class="modal hide fade" id="myPayModal" style="width:1000px; left:40%"> <?php echo form_open('fees/payment_post', array('class' => 'form-horizontal', 'id' => 'paymentPostFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Payment</h3>
  </div>
  <div class="modal-body">
  			<input type="hidden" id="user_id"  name="user_id" value="" >
            <input type="hidden" id="role_id"  name="role_id" value="" >
            <input type="hidden" id="class_id"  name="class_id" value="" >
            
    		<div class="control-group"  >
              <label class="control-label" for="inputSuccess">Total Amount(monthly)</label>
              <div class="controls">
                <input type="text" id="monthly"  name="monthly" value="" readonly="readonly">                
                </div>
            </div>
            
            <div class="control-group"  id="concession_control" >
              <label class="control-label" for="inputSuccess">Concession Amount</label>
              <div class="controls">
                <input type="text" id="concession"  name="concession"  onchange="concessionAmount();" > 
                <span class="help-inline" id="concession_amount" style="display:none;"></span>
                <span class="help-inline" id="concession_amount_message" style="display:none;"></span>               
                </div>
            </div>
            
            <div class="control-group" id="amount_control" >
              <label class="control-label" for="inputSuccess">Amount</label>
              <div class="controls">
                <input type="text" id="amount"  name="amount"  onchange="dueAmount();">                
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
    
  </div>
   <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="payment_validation();">Pay</button>
  </div>
  </form>
</div>
<!----------------------------------------------------------------------------End--------------------------------------------------------->

<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script language="javascript" type="text/javascript">

function onChange()
{
	/*var base_url='<?php echo base_url();?>';
	window.location = base_url+'index.php/admin/user?user='+role_id;*/
	$("#showUserFrm").submit();
		
}
function onChangeClass()
{
	if($("#user").val()!=2){
		alert("Please select Student.");
		$("#class").val(0);
		return false;
	}
	else{
		$("#showUserFrm").submit();	
	}
}

function changeMonth(month){
	$("#showUserFrm").submit();	
}

function activate_inactivateitem(username,status,role_id){
	var base_url='<?php echo base_url();?>'; 
	var tablename='user';
	var columnname='username';
	var setColumn='status';
	var page='admin/user?role_id='+role_id;
	if(status=="active"){
		
		status="inactive";
		if(confirm('Are you sure do you want to Deactivate it?')){
			
			window.location = 	base_url+'index.php/admin/block_unblock?id='+username+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}
	}else{
		status="active";
		if(confirm('Are you sure do you want to Active it?')){
			window.location =base_url+'index.php/admin/block_unblock?id='+username+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}

	}
}

function validate_user(){
		var user=$.trim($("#user").val());
	if(Number(user) == 0){
		$("#user_message").text("Please Select a user");
		$("#user_message").show();
		$("#user_control").removeClass();
		$("#user_control").addClass("control-group error");
		return false;	
	}else{
		$("#user_message").text("Valid");
		$("#user_message").show();
		$("#user_control").removeClass();
		$("#user_control").addClass("control-group success");
		return true;	
	}
}
function validate_edit_user(){
		var user=$.trim($("#edit_user").val());

	if(Number(user) == 0){
		$("#edit_user_message").text("Please Select a user");
		$("#edit_user_message").show();
		$("#edit_user_control").removeClass();
		$("#edit_user_control").addClass("control-group error");
		return false;	
	}else{
		$("#edit_user_message").text("Valid");
		$("#edit_user_message").show();
		$("#edit_user_control").removeClass();
		$("#edit_user_control").addClass("control-group success");
		return true;	
	}
}

function validate_user_id()
{
	if(!validate_user()){
			$("#user").focus();
			return false;
	}
	return true;
}

function validate_edit_form()
{
	if(!validate_edit_user()){
			$("#edit_user").focus();
			return false;
	}
	return true;
}

function open_pay_modal(data1){
	data_arr = data1.split(",");
  //alert(data_arr.length);
	//alert(data_arr[1]);
	
	$("#user_id").val(data_arr[0]);
	$("#role_id").val(data_arr[1]);
	
		$("#monthly").val(data_arr[2]);
		$("#concession").val(0);
		$("#amount").val(0);
		$("#due_amount").val(data_arr[3]);
	 
	var classid=$("#class").val();
	$("#class_id").val(classid);
	
	if(role_id==3)
	{
		$("#concession_control").hide();
		
	}
	$("#myPayModal").modal('show');
}

function concessionAmount(){
	var monthly=$("#monthly").val();
	var concession=$("#concession").val();
	
		if(monthly < concession)
		{
			alert("Total amount must be greater or equal to Concession.");
			$("#amount").val(0);
			$("#due_amount").val(0);
			$("#due_message").hide();
			return false;
		}else{
			monthly=monthly-concession;
			$("#amount").val(0);
			$("#due_amount").val(0);
			$("#due_message").hide();
			
			$("#concession_amount").text(monthly); 		
			$("#concession_amount_message").text("Rs. to be paid.");
			$("#concession_amount").show();
			$("#concession_amount_message").show();
			return true;
		}
	
}

function dueAmount()
{
	var monthly=$("#monthly").val();
	var amount=$("#amount").val();
	var concession=$("#concession").val();
		
		monthly=monthly-concession;
	
		if(monthly < amount )
		{
			alert("Total amount must be greater or equal to amount.");
			$("#amount").val(0);
			$("#due_amount").val(0);
			return false;
		}
		
		else{
			var due=monthly-amount;
			$("#due_amount").val(due);
			if(due > 0){
				$("#due_message").text("Due amount will be added with next month's amount.");
				$("#due_message").show();
			}
			else{
				$("#due_message").hide();
			}
			return true;
		}
	
}

function amount_validation(){
var amount=$("#amount").val();
	if(amount!=0){
		$("#amount_message").text("Amount must not be zero(0)");
		$("#amount_message").hide();
		return true;
	}
	else {
				
				$("#amount_message").text("Amount must not be zero(0)");
				$("#amount_message").show();
				return false;
		}	
}

function payment_validation(){
	if(!dueAmount()){
		$("#amount").focus();
		return false;
	}
	if(role_id==2)
	{
		if(!concessionAmount()){
			$("#concession").focus();
		return false;
		}
		
	}
	return true;
}



</script>