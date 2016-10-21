<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Payment</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Manual</h2>
      </div>
      <div class="box-content">
      
     <?php echo form_open_multipart('fees/payment_manually', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); ?> 
       
       <div class="control-group" id="user_control">
              <label class="control-label" for="user">Select User</label>
              
              <div class="controls">
                <select id="user" name="user"  onchange="onChange()" >
                  
                  <?php  foreach($roles as $user){     if($user['role_id']!=1):?>
                  <option value="<?php echo $user['role_id'];?>" <?php if($current_role==$user['role_id']){ echo "selected";}?>><?php echo $user['role_name'];?></option>
                  <?php endif; }?>
                </select>
                
                <select id="month" name="month"  onchange="changeMonth(this.value);">
                  <option value="0">--Select Month--</option>
                  <?php  for($m=1; $m<=count($months); $m++){  ?> 
                  <option value="<?php echo $m;?>" <?php if($m== $month_value){echo "selected"; } ?> ><?php echo $months[$m];?></option>
                 <?php }?>
                </select>
                
                  <select id="year" name="year" onchange="changeYear(this.value);" >
                  <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($year); $y++){  
				  ?>
                  <option value="<?php echo $year[$y];?>" <?php if($year[$y]== $year_value){echo "selected"; } ?> > <?php echo $year[$y];?></option>
                 <?php }?>
                </select>    
                <span class="help-inline" id="user_message" style="display:none;"></span> </div>
            
           		
                
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
             
                                
         <!--<button type="submit" class="btn btn-primary" onclick="return validate_user_id();">Show User List</button>-->
         
        </form> 
                
        <div class="box-content">
         <?php echo form_open_multipart('fees/payment_manually_post', array('class' => 'form-horizontal', 'id' => 'paymentManualFrm')); ?>
          <fieldset>
            <legend>Payment Manual</legend> 
                        
                        <input type="hidden" id="role_id"  name="role_id" value="<?php echo $current_role;?>" >
                        <input type="hidden" id="class_id"  name="class_id" value="<?php echo $class_id;?>" >
                        <input type="hidden" id="concession"  name="concession" value="" >
                        <input type="hidden" id="concess_name"  name="concess_name" value="" >
                        <input type="hidden" id="other_charge_amount"  name="other_charge_amount" value="" >
                        <input type="hidden" id="other_charge_reason"  name="other_charge_reason" value="" >
                        <input type="hidden" id="month_value_Pay"  name="month_value_Pay" value="<?php echo $month_value;?>" > 
                        <input type="hidden" id="year_value_Pay"  name="year_value_Pay" value="<?php echo $year_value;?>" >
            
						<?php $fees=0; if(isset($monthly)){   if(count($monthly)>0){
                                foreach($monthly as $row){ 
                                $fees=$row->total;   
                                }
                                } } ?> 
                           
             	<div style="width:400px;  float:left;">      
                     <div class="control-group"  >
                      <label class="control-label" for="inputSuccess">User Registration</label>
                      <div class="controls">
                        <select name="registration_no_payment" id="registration_no_payment" onchange="user_detail(this.value,<?php echo $current_role; ?>,<?php echo $fees; ?>)">
                        <option value="0">--Select Registration--</option>
                        <?php  foreach($user_list as $row_user){ ?>
                              <option value="<?php echo $row_user->id;?>" ><?php echo $row_user->registration_no;?></option>
                        <?php }?>
                        </select>   
                        </div>
                        </div>  
                       
                        <div class="control-group"  >
                      <label class="control-label" for="inputSuccess">Payable Amount</label>
                      <div class="controls">
                        <input type="text" id="monthly"  name="monthly" value="<?php echo $fees;?>" readonly="readonly">  
                          <span class="help-inline" id="monthly_message" style="display:none;"></span>               
                        </div>
                    </div>
                     
                    <div class="control-group" id="amount_control" >
                      <label class="control-label" for="inputSuccess">Amount</label>
                      <div class="controls">
                        <input type="text" id="amount"  name="amount"  onchange="return dueAmount();" >                
                        <span class="help-inline" id="amount_message" style="display:none;"></span> 
                       </div>
                    </div>
                              
                     <div class="control-group" id="due_amount_control" >
                    <!--  <label class="control-label" for="inputSuccess">Due Amount</label>-->
                      <div class="controls">
                        <input type="hidden" id="due_amount"  name="due_amount"  readonly="readonly" >
                        <span class="help-inline" id="due_amount_message" style="display:none;"></span>
                        <span class="help-inline" id="due_message" style="display:none;"></span>
                      </div>
                    </div>
                    
                    <div class="control-group" id="due_reason_control" >
                      <!--<label class="control-label" for="inputSuccess">Due Reason</label>-->
                      <div class="controls">
                         <input type="hidden" id="due_reason"  name="due_reason"  >                       
                        <span  class="help-inline" id="due_reason_message" style="display:none;"></span>
                      </div>
                    </div>                          
                       
                  </div> 
                  <div style="width:400px;  float:left;">
                  		<div class="control-group"  >
                          <label class="control-label" for="inputSuccess">Name</label>
                          <div class="controls">
                             <input type="text" id="name"  name="name" value="" readonly="readonly"> 
                             <input type="hidden" id="user_id"  name="user_id" value="" >
                              <input type="hidden" id="registration_no"  name="registration_no" value="" >               
                            </div>
                        </div> 
                         <div class="control-group"  >
                              <label class="control-label" for="inputSuccess">Address</label>
                              <div class="controls">
                                 <input type="text" id="address"  name="address" value="" readonly="readonly"> 
                                              
                                </div>
                            </div>
                       
                  		<div class="control-group"  >
                          <label class="control-label" for="inputSuccess">Phone</label>
                          <div class="controls">
                             <input type="text" id="phone"  name="phone" value="" readonly="readonly"> 
                                           
                            </div>
                        </div> 
                        <div class="control-group"  >
                          <label class="control-label" for="inputSuccess">Mobile</label>
                          <div class="controls">
                             <input type="text" id="mobile"  name="mobile" value="" readonly="readonly"> 
                                           
                            </div>
                        </div> 
                        <div class="control-group"  >
                          <label class="control-label" for="inputSuccess">Email</label>
                          <div class="controls">
                             <input type="text" id="email"  name="email" value="" readonly="readonly"> 
                                           
                            </div>
                        </div> 
                        
                  </div>               
                    
                  
   		
  </div>
   <div class="modal-footer"> 
    <button type="submit" class="btn btn-primary" onclick="return payment_validation();">Pay</button>
    <input type="hidden" id="selected_date"  name="selected_date" value="" > 
  </div>
  </fieldset>
  </form>
        
       		
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>



<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script language="javascript" type="text/javascript">

function onChange(x)
{
	alert(x);
	
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

function changeYear(){
	$("#showUserFrm").submit();
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

function user_detail(id,role,fees){
	var m=$("#month").val();
	var y=$("#year").val();
		//alert(fees);	
					   
			 $.ajax({
					  type:"POST",
					  dataType:"json",
					  url: "<?php echo base_url() ?>index.php/fees/user_detal/"+role+"/"+id+"/"+m+"/"+y,
					   success:function(data){					
						console.log(data.Payment);
							 $("#user_id").val(id);		
							$("#registration_no").val(data.user_list[0].registration_no);
							var fname=data.user_list[0].first_name;
							var Mname=data.user_list[0].middle_name;
							var Lname=data.user_list[0].last_name;
							var fullname=fname+" "+	Mname+" "+Lname;
							
							$("#name").val(fullname);
							$("#address").val(data.user_list[0].address);
							$("#phone").val(data.user_list[0].phone);
							$("#mobile").val(data.user_list[0].mobile);
							$("#email").val(data.user_list[0].email);
							
							if(data.Payment.length>0){
								$("#monthly").val(data.Payment[0].payable);
								if(data.Payment[0].payable==0){
									$("#monthly_message").text("Paid For This Month.");	
									$("#monthly_message").show();
									$("#amount_control").hide();
								}
								else{
									$("#amount_control").show();
									$("#monthly_message").hide();
									$("#monthly").val(fees);
								}
							}
							
							
													 
						}
				  });
				  
	
	
}

function dueAmount()
{
	var monthly=$("#monthly").val();
	var amount=$("#amount").val();
	
		if(parseInt(amount)<=parseInt(monthly))
		{
			var due=monthly-amount;
			$("#due_amount").val(due);
			if(due > 0){
				$("#due_message").text("Due amount will be added with next month's amount.");
				$("#due_message").hide();
			}
			else{
				$("#due_message").hide();
			}
			return true;
		}		
		else{
			alert("Payable amount must be greater or equal to amount.");
			$("#amount").val(0);
			$("#due_amount").val(0);
			return false;
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
	var monthly=$("#monthly").val();
	var amount=$("#amount").val();
	if($("#monthly").val()==0){
		alert("Already Paid For This Month");
		
		return false;
	}else{
			
			
			if($("#amount").val()==""){
				alert("Please Enter Amount");
				$("#amount").focus();
				return false;
			}
			
			if(parseInt(amount)<parseInt(monthly))
			{
				alert("please Enter Full Amount.");
				return false;
			}
			if(parseInt(amount)>parseInt(monthly))
			{
				alert("Amount must be same of Payable Amount.");
				return false;
			}
			
			if(!dueAmount()){
				$("#amount").focus();
				return false;
			}
			
			if(confirm("Do you Want To Pay For The Selected Month? ")){
				$("#selected_date").val("yes");
				return true;
			}
			else{
				if(confirm("Do you Want To Pay For The Current Month?")){
					$("#selected_date").val("no");
					return true;
				}
				return false;
			}
	}
	return true;
}





function voucher_generate(data_voucher_list){
var base_url='<?php echo base_url();?>';
	voucher_arr = data_voucher_list.split(",");
	var user_id=voucher_arr[0];
	var month_value=voucher_arr[1];
	var year_value=voucher_arr[2];
	window.open(base_url+"index.php/fees/voucher/"+user_id+"/"+month_value+"/"+year_value,'voucher',"width=790,height=600,toolbar=1,resizable=1,scrollbars=1");
  	 
		
}

</script>