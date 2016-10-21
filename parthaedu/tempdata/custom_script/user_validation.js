
$(window).load(function()
{	
	$("#rdmultipleUserAdd").prop('checked',false);	
    $("#rdsingelUserAdd").attr('checked', 'checked'); 

});
 

function concession_set()
{
	if($('#class').val()==0)
	{
		$('#concessionamountfees_message').text('Please select Class.');		
		$('#concessionamountfees_message').show();
	}
	else{
		$('#myconcessionModal').modal('show');
	}
}

function concession_div()
{	
	$('#myconcessionModal').modal('hide');	
	$('#divconcessionamount').show();
	
	$('#concessionamountfees_message').text('');		
	$('#concessionamountfees_message').hide();
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
			//console.log(data);
			$("#concession_id").val(data.edit[0]['id']);
			$("#concession_amount").val(data.edit[0]['concession_amount']);	
			$("#concessionamount").val(data.edit[0]['concession_amount']);	
			var fees=alwaysAddAsNumbers( ($("#fees").val()),$("#specialamount").val());
			
			var total=alwaysSubNumbers(fees,data.edit[0]['concession_amount']);
			$("#totalfees").val(total);	
			$('#divtotalfees').show();	
		}
	});
}
function get_concession(value_){
	var datastring='id='+value_;
	$.ajax({
		url:base_url+"index.php/concession/concession_data_byId",
		type:"POST",
		dataType:"json",
		data: datastring,
		async: false,  
		success: function(data){
			//console.log(data);
			$("#concession_id").val(data.edit[0]['id']);
			$("#concession_amount").val(data.edit[0]['concession_amount']);	
			$("#concessionamount").val(data.edit[0]['concession_amount']);	
			var fees=alwaysAddAsNumbers( ($("#fees").val()),$("#specialamount").val());
			
			var total=alwaysSubNumbers(fees,data.edit[0]['concession_amount']);
			$("#concessionfeestotalamount").val(total);	
			//$('#divtotalfees').show();	
		}
	});
}
function specialfees_set()
{
	if($('#class').val()==0)
	{
		$('#specialamountfees_message').text('Please select Class.');		
		$('#specialamountfees_message').show();
	}
	else{
		$('#myspecialfeesModal').modal('show');	
	}
}

function specialfees_(value_)
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
			$("#specialfees_id").val(data.edit[0]['id']);			
			$("#specialfees_amount").val(data.edit[0]['specialamount']);
			$("#specialamount").val(data.edit[0]['specialamount']);
			var fees=alwaysSubNumbers($("#fees").val(),$("#concessionamount").val());
			var total=alwaysAddAsNumbers(fees,data.edit[0]['specialamount']);
			$("#totalfees").val(total);	
			$('#divtotalfees').show();	
		}
	});

}
function alwaysAddAsNumbers(a, b){
  var m = 0,
      n = 0,
      d = /\./,
      f = parseFloat,
      i = parseInt,
      t = isNaN,
      r = 10;
  m = (d.test(a)) ? f(a) : i(a,r);
  n = (d.test(b)) ? f(b) : i(b,r);
  if (t(m)) m = 0;
  if (t(n)) n = 0;
  return m + n;
}

function alwaysSubNumbers(a, b){
  var m = 0,
      n = 0,
      d = /\./,
      f = parseFloat,
      i = parseInt,
      t = isNaN,
      r = 10;
  m = (d.test(a)) ? f(a) : i(a,r);
  n = (d.test(b)) ? f(b) : i(b,r);
  if (t(m)) m = 0;
  if (t(n)) n = 0;
  return m - n;
}
function get_specialfees(value_){
	var datastring='id='+value_;
	$.ajax({
		url:base_url+"index.php/specialfees/get_specialfee",
		type:"POST",
		dataType:"json",
		data: datastring,
		async: false,  
		success: function(data){
			//console.log(data);
			$("#specialfees_id").val(data.edit[0]['id']);			
			$("#specialfees_amount").val(data.edit[0]['specialamount']);
			$("#specialamount").val(data.edit[0]['specialamount']);
			var fees=alwaysSubNumbers($("#fees").val(),$("#concessionamount").val());
			var total=alwaysAddAsNumbers(fees,data.edit[0]['specialamount']);
			//alert(total);
			$("#specialfeestotalamount").val(total);	
			// $("#specialfeestotalamount").val(total);	
			// $('#divtotalfees').show();	
		}
	});
}
function specialfees_div()
{
	$('#myspecialfeesModal').modal('hide');	
	$('#divspecialamount').show();
	
	$('#specialamountfees_message').text('');		
	$('#specialamountfees_message').hide();
}


function getDistricts(){
	var state_code=$('#state').val();
	var datastring='state_code='+state_code;
	$("#statecode_message").text(state_code);
	$("#statecode_message").show();
	$("#distcode_message").hide();
	$.ajax({
		url:base_url+"index.php/admin/get_district",
		type:"POST",
		dataType:"json",
		data: datastring,
		async: false,  
		success: function(data){
			//console.log(data);
			var districtstring=' <select id="city" data-rel="chosen" name="city" > <option value="0">--Select City--</option> ';
			for(var i=0;i<data.city.length;i++){
				districtstring+='<option value="'+data.city[i]['city_id']+'">'+data.city[i]['city']+'</option>';	
			}
			districtstring+='</state>';
			$("#citydist").html(districtstring);		
		}
	});
}

function getState(country){
		var country=$('#country').val();
		if($('#country').val()=='IN')
		{
		//alert($('#country_group').val());
			$('#state_dist').show();
			$('#pardist_city').hide();
		}
		else{
			$('#state_dist').hide();
			$('#pardist_city').show();
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


function validate_form()
{
		if(!validate_registration_no()){
			$("#registration_no").focus();
			return false;
		}
				
		if(!validate_firstname()){
			$("#firstname").focus();
			return false;
		}
		if(!validate_lastname()){
			$("#lastname").focus();
			return false;
		}
		
		var email = $.trim($("#email").val());
	/*if(email==''){
		$("#email_message").text("Please enter email");
		$("#email_message").show();
		$("#email_control").removeClass();
		$("#email_control").addClass("control-group error");
		return false;
	}else{*/
	if(email!=''){	
		var bAvailable =false;
		var dataString = 'email='+ email ;
		$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/studentlist/checkuseremailavailability",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			  		var exists=data.exists;				
					if(exists.length==0)
					{
						$("#email_message").text("Available");
						$("#email_message").show();
						$("#email_control").removeClass();
						$("#email_control").addClass("control-group success");
						return true;
						}else
							{
								$("#email_message").text("Not Available");
								$("#email_message").show();
								$("#email_control").removeClass();
								$("#email_control").addClass("control-group error");
								return false;	
							}
				}  
			});
			
	
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 if (!filter.test($('#email').val())) 
		{
			alert('Please enter a valid email id');
			
			$('#email').focus();
			return false;
		}
		
	}
	
		var filter = /[0-9 -()+]+$/;
	if (!filter.test($('#phonenumber').val())) 
		{
			alert('Please enter valid Phone Number');			
			$('#phonenumber').focus();
			return false;
		}
	
		if($("#class").val()==''){
			alert("Please select Class.");  
			return false;	
		}
		
		if($("#fees").val()==''){
			alert("Fees has not been set.Please set fees for the class before.");  
			return false;	
		}
		
		
		
		return true;
}

function changeAddOptionMultiple()
{
	$("#divmultipleUserAdd").show();
	$("#divsingelUserAdd").hide();
	
}

function changeAddOptionSingle(){
		
	$("#divmultipleUserAdd").hide();
	$("#divsingelUserAdd").show();
}

function class_fees(class_id){
	var datastring="class_id="+class_id;
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/class_fees",  
			  data:datastring,
			  async: false,  
			  success: function(data) { 			  
			  var fees=data.fees;
			  console.log(data);
			  if(fees.length>0){	
					$("#fees").val(fees[0].total);
					$("#permanentfees").val(fees[0].total);
					$("#concessionamount").val(null);
					$("#specialamount").val(null);
					$("#totalfees").val(null);
						
			  }else{
				alert("Fees has not been set. Please set fees for the class.");  
				$("#fees").val(null);
					$("#concessionamount").val(null);
					$("#specialamount").val(null);
					$("#totalfees").val(null);
			  }
			}  
	});
	$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/additional_charges",  
			  data:datastring,
			  async: false,  
			  success: function(data) { 			  
			  var charge=data.charge;
			  console.log(data);
			  if(charge.length>0){	
					$("#session_charge").val(charge[0].amount);
					$("#deposit").val(charge[0].caution_amount);
					$("#concessionamount").val(null);
					$("#specialamount").val(null);
					$("#totalfees").val(null);
						
			  }else{
				//alert("Fees has not been set. Please set fees for the class.");  
				$("#session_charge").val(charge[0].amount);
				$("#deposit").val(charge[0].caution_amount);
					$("#concessionamount").val(null);
					$("#specialamount").val(null);
					$("#totalfees").val(null);
			  }
			}  
	});
	all_amount()
	}

function validate_username()
{
	var username = $.trim($("#username").val());	
	if(username==''){		
		$("#username_message").text("Please enter username");
		$("#username_message").show();
		$("#username_control").removeClass();
		$("#username_control").addClass("control-group error");
		return false;
	}	
	var bAvailable =false;
	var dataString = 'username='+ username ;
	$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/user/checkuseravailability",  
			  data: dataString,
			  async: false,  			  
			  success: function(data) { 
			  		bAvailable=data.Available;
					
			}  
	});
	
	if(bAvailable)
	{
		$("#username_message").text("Available");
		$("#username_message").show();
		$("#username_control").removeClass();
		$("#username_control").addClass("control-group success");
		return true;	
	}
	else
	{
		$("#username_message").text("Not Available");
		$("#username_message").show();
		$("#username_control").removeClass();
		$("#username_control").addClass("control-group error");
		return false;	
	}
}

function validate_registration_no(){
	var registration_no=$.trim($("#registration_no").val());
	if(registration_no==''){
		$("#registration_no_message").text("Please Enter Registration No");
		$("#registration_no_message").show();
		$("#registration_no_control").removeClass();
		$("#registration_no_control").addClass("control-group error");
		return false;	
	}else{
		var dataString = 'registration_no='+ registration_no ;
		$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/studentlist/checkregistration",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			  		var exists=data.exists;				
					if(exists.length==0)
					{
						$("#registration_no_message").text("Available");
						$("#registration_no_message").show();
						$("#registration_no_control").removeClass();
						$("#registration_no_control").addClass("control-group success");
						return true;
						}else
							{
								$("#registration_no_message").text("Not Available");
								$("#registration_no_message").show();
								$("#registration_no_control").removeClass();
								$("#registration_no_control").addClass("control-group error");
								return false;	
							}
				}  
			});
					
		return true;	
	}
}

function validate_date_of_birth(){
	var date_of_birth=$.trim($("#date_of_birth").val());
	if(date_of_birth==''){
		$("#date_of_birth_message").text("Please Enter Date of Birth");
		$("#date_of_birth_message").show();
		$("#date_of_birth_control").removeClass();
		$("#date_of_birth_control").addClass("control-group error");
		return false;	
	}else{
		$("#date_of_birth_message").text("Valid");
		$("#date_of_birth_message").show();
		$("#date_of_birth_control").removeClass();
		$("#date_of_birth_control").addClass("control-group success");
		return true;	
	}
}

function validate_email()
{
	var email = $.trim($("#email").val());
	if(email==''){
		$("#email_message").text("Please enter email");
		$("#email_message").show();
		$("#email_control").removeClass();
		$("#email_control").addClass("control-group error");
		return false;
	}else{
		
		var bAvailable =false;
		var dataString = 'email='+ email ;
		$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/studentlist/checkuseremailavailability",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			  		var exists=data.exists;				
					if(exists.length==0)
					{
						$("#email_message").text("Available");
						$("#email_message").show();
						$("#email_control").removeClass();
						$("#email_control").addClass("control-group success");
						return true;
						}else
							{
								$("#email_message").text("Not Available");
								$("#email_message").show();
								$("#email_control").removeClass();
								$("#email_control").addClass("control-group error");
								return false;	
							}
				}  
			});
			
	}
	
		
}

function validate_firstname()
{
	var firstname = $.trim($("#firstname").val());
	if(firstname==''){
		$("#firstname_message").text("Please enter firstname");
		$("#firstname_message").show();
		$("#firstname_control").removeClass();
		$("#firstname_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#firstname_message").text("Valid");
		$("#firstname_message").show();
		$("#firstname_control").removeClass();
		$("#firstname_control").addClass("control-group success");
		return true;	
	}
		
}
function validate_vendor()
{
	var firstname = $.trim($("#firstname").val());
	if(firstname==''){
		$("#firstname_message").text("Please enter Name");
		$("#firstname_message").show();
		$("#firstname_control").removeClass();
		$("#firstname_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#firstname_message").text("Valid");
		$("#firstname_message").show();
		$("#firstname_control").removeClass();
		$("#firstname_control").addClass("control-group success");
		return true;	
	}
		
}

function validate_lastname()
{
	var lastname = $.trim($("#lastname").val());
	if(lastname==''){
		$("#lastname_message").text("Please enter lastname");
		$("#lastname_message").show();
		$("#lastname_control").removeClass();
		$("#lastname_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#lastname_message").text("Valid");
		$("#lastname_message").show();
		$("#lastname_control").removeClass();
		$("#lastname_control").addClass("control-group success");
		return true;	
	}
		
}

function validate_address()
{
	var address = $.trim($("#address").val());
	if(address==''){
		$("#address_message").text("Please enter address");
		$("#address_message").show();
		$("#address_control").removeClass();
		$("#address_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#address_message").text("Valid");
		$("#address_message").show();
		$("#address_control").removeClass();
		$("#address_control").addClass("control-group success");
		return true;	
	}
}

function validate_phonenumber()
{
	var phonenumber = $.trim($("#phonenumber").val());
	if(phonenumber==''){
		$("#phonenumber_message").text("Please enter phonenumber");
		$("#phonenumber_message").show();
		$("#phonenumber_control").removeClass();
		$("#phonenumber_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#phonenumber_message").text("Valid");
		$("#phonenumber_message").show();
		$("#phonenumber_control").removeClass();
		$("#phonenumber_control").addClass("control-group success");
		return true;	
	}	
}
function validate_batch()
{
	var batch = $.trim($("#batch_id").val());
	if(Number(batch) == 0){
		$("#batch_message").text("Please select Batch Name");
		$("#batch_message").show();
		$("#batch_control").removeClass();
		$("#batch_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#batch_message").text("Valid");
		$("#batch_message").show();
		$("#batch_control").removeClass();
		$("#batch_control").addClass("control-group success");
		return true;	
	}		
}

function validate_class(){
	var classid=$.trim($("#class").val());
			if(Number(classid) == 0){
			$("#class_message").text("Please Select a class");
			$("#class_message").show();
			$("#class_control").removeClass();
			$("#class_control").addClass("control-group error");
			
			return false;	
			}
			else{
			$("#class_message").text("Valid");
			$("#class_message").show();
			$("#class_control").removeClass();
			$("#class_control").addClass("control-group success");
			return true;
			}
}


function validate_department(){
	var department=$.trim($("#department").val());
			if(Number(department) == 0){
			$("#department_message").text("Please Select a department");
			$("#department_message").show();
			$("#department_control").removeClass();
			$("#department_control").addClass("control-group error");
			
			return false;	
			}
			else{
			$("#department_message").text("Valid");
			$("#department_message").show();
			$("#department_control").removeClass();
			$("#department_control").addClass("control-group success");
			return true;
			}
}


function firstname_onblur()
{
	if(!validate_firstname())
		$("#firstname").focus();
}

function lastname_onblur()
{
	if(!validate_lastname())
		$("#lastname").focus();
}
/*function email_onblur()
{
	if(!validate_email())
		$("#email").focus();
	
}*/
function phonenumber_onblur()
{
	if(!validate_phonenumber())
	 $("#phonenumber").focus();	
}

function address_onblur()
{
	if(!validate_address())
		$("#address").focus();	
}

function userrole_onblur()
{
	if(!validate_userrole())
	 $("#userrole").focus();	
}
function date_of_birth_onblur(){
	if(!validate_date_of_birth())
	 $("#date_of_birth").focus();
}
function batch_onblur(){
	if(!validate_batch())
	 $("#batch_id").focus();
}
