function onChangeClass()
{	
	$("#showUserFrm").submit();	
}

function changeMonth(month){
	$("#showUserFrm").submit();	
}

function open_pay_modal(data1){
	data_arr = data1.split(",");  					
		$("#user_id").val(data_arr[0]);	
		$("#payable").val(data_arr[1]);
		$("#due_payablee").val(data_arr[1]); 
		$("#pay_class_id").val(data_arr[3]);
		
		$("#due").val(data_arr[4]);
		$("#pay_paid").val(data_arr[2]);
		$("#paid_month").val(data_arr[5]);
		$("#paid_year").val(data_arr[6]);
		$("#feesmonth").val(data_arr[7]);
		$("#totdue").val(data_arr[8]);				
		$("#amount").val(0);
		$("#f_month").text(data_arr[9]);
		$("#latefine").val(0);
		$("#medicalcrg").val(data_arr[10]);
		$("#paidmedicalcrg").val(data_arr[11]);	
		if($("#paidmedicalcrg").val()=='paid')
		{
			$("#medicalcrg").attr('readonly','readonly');
			$("#medicalcrg_message").text('Paid');
			$("#medicalcrg_message").show();
		}
	/*var classid=$("#class").val();
	$("#class_id").val(classid);*/

	if($('#role_id').val()==2)
	{
		var dataString ='month='+data_arr[5]+'&year='+data_arr[6]+'&userid='+data_arr[0]+'&class='+data_arr[3];
		$.ajax({
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/latepayment/count_late_fine",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
			 console.log(data);
				 if(data.exists==0)
				 {			
					 $("#latefine").val(data.fine);
					  $("#paidlatefine").val(data.fine); 
					 var payable=TwoNumbers(data.fine,data_arr[1]);					 
					 $("#payable").val(payable);
				 }else{					
					 $("#latefine").val(data.fine);
					 $("#latefine").attr('readonly','readonly');
					 $("#paidlatefine").val(data.fine); 
					 $("#latefine_message").text('Paid');
					 $("#latefine_message").show();
				 }
			  }
		});
	}
	$("#myPayModal").modal('show');
}



function dueAmount()
{
	var feesmonth=$("#feesmonth").val();
	var payable=$("#payable").val();
	var amount=$("#amount").val();
	var due=$("#due").val();
	var paid=$("#pay_paid").val();
	
	var due=(parseFloat(payable).toFixed(2)-parseFloat(amount).toFixed(2)).toFixed(2);
	$("#due_amount").val(due);
	
		if(due > 0){
				$("#due_message").text("Due amount will be added with next month's amount.");
				$("#due_message").show();
			}
			else if(due < 0)
			{
				alert("Amount is greater than payable amount.");
				$("#amount").val(0);
				$("#due_amount").val(0);
				$("#due_payable").val(0);
				return false;
			}
			else{
				$("#due_message").hide();
			}
	
	
}


function lateAmount()
{	
	var payable=$("#due_payablee").val();
	var medicalcrg=0;
	medicalcrg=$("#medicalcrg").val();
	var late_fine=0;
	// alert(late_fine);
	if($("#latefine").val()!='')
	{
		late_fine=$("#latefine").val();	
	}
	//var amount=TwoNumbers(payable,late_fine);
	var amount=alwaysAddAsNumbers(payable,late_fine,medicalcrg,0);		
	$("#payable").val(amount);
	 $("#paidlatefine").val($("#latefine").val());
}

function medicalAmount()
{	
	var payable=$("#due_payablee").val();
	var medicalcrg=0;
	medicalcrg=$("#medicalcrg").val();
	
	var late_fine=0;
	if($("#latefine").val()!='')
	{
		late_fine=$("#paidlatefine").val();	
	}
	var amount=alwaysAddAsNumbers(payable,0,medicalcrg,0);	
	$("#payable").val(amount);
	 $("#paidmedicalcrg").val($("#medicalcrg").val());
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
	/*if(!dueAmount()){
		$("#amount").focus();
		return false;
	}*/
	//if(role_id==2)
//	{
//		if(!concessionAmount()){
//			$("#concession").focus();
//		return false;
//		},'<?php echo $row['paid_month'];?>','<?php echo $row['paid_year'];?>'
//		
//	}class,month,year
	return true;
}
function deleteitem(id,uid,month,year,classid)
{
	var id=id;
	var tablename='payment';
	var column='invoice_no';
	var page="fees?payuser="+uid+"&month="+month+"&year="+year+"&classid="+classid;
	
	if(confirm('Are you sure do you want to Delete it?'))
	{
		window.location = base_url+'index.php/fees/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&uid='+uid+'&page='+page;
		}	
}

function deleteitem_salary(id,uid,month,year)
{
	var id=id;
	var tablename='payment';
	var column='invoice_no';
	var page='salary?payuser='+uid+'&month='+month+'&year='+year;
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/fees/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}	
}

function feestotal()
{
	var schfees=$.trim($("#school_fees").val());  if(schfees==''){ schfees=0;}
	var hostlfees= $.trim($("#hostel_fees").val());  if(hostlfees==''){ hostlfees=0;}
	var adnfees= $.trim($("#admission_fees").val());  if(adnfees==''){ adnfees=0;}
	var elecfees= $.trim($("#electric_charge").val());	 if(elecfees==''){ elecfees=0;}
	var fees=alwaysAddAsNumbers(schfees, hostlfees,adnfees,elecfees);
	$.trim($("#total").val(fees));
}

function editfeestotal()
{
	var schfees=$.trim($("#edit_school_fees").val()); if(schfees==''){ schfees=0;}
	var hostlfees= $.trim($("#edit_hostel_fees").val()); if(hostlfees==''){ hostlfees=0;}
	var adnfees= $.trim($("#edit_admission_fees").val());  if(adnfees==''){ adnfees=0;}
	var elecfees= $.trim($("#edit_electric_charge").val());	  if(elecfees==''){ elecfees=0;}
	var fees=0;
	fees=alwaysAddAsNumbers(schfees, hostlfees,adnfees,elecfees);
	$.trim($("#edit_total").val(fees));
}

function alwaysAddAsNumbers(schfees, hostlfees,adnfees,elecfees){
  var m = 0,
      n = 0,o=0,p=0,
      d = /\./,
      f = parseFloat,
      i = parseInt,
      t = isNaN,
      r = 10;
  m = (d.test(schfees)) ? f(schfees) : i(schfees,r);
  n = (d.test(hostlfees)) ? f(hostlfees) : i(hostlfees,r);
  o = (d.test(adnfees)) ? f(adnfees) : i(adnfees,r);
  p = (d.test(elecfees)) ? f(elecfees) : i(elecfees,r);
  if (t(m)) m = 0;
  if (t(n)) n = 0;
  var sum=0;
  sum=(m + n + o + p).toFixed(2);
  
  return sum;
}

function TwoNumbers(x,y){
  var m = 0,
      n = 0,o=0,p=0,
      d = /\./,
      f = parseFloat,
      i = parseInt,
      t = isNaN,
      r = 10;
  m = (d.test(x)) ? f(x) : i(x,r);
  n = (d.test(y)) ? f(y) : i(y,r);
  
  if (t(m)) m = 0;
  if (t(n)) n = 0;
  var sum=0;
  sum=(m + n).toFixed(2);
  
  return sum;
}

function validate_form()
{
	if($("#class").val() == 0){
		$("#class_message").text("Please Select Class");
		$("#class_message").show();
		$("#class_message").removeClass();
		$("#class_message").addClass("control-group error");
		return false;
	}
	else
	{
		$("#class_message").text("Valid");
		$("#class_message").show();
		$("#class_message").removeClass();
		$("#class_message").addClass("control-group success");
		return true;	
	}
	
	if($.trim($("#school_fees").val()) == ''){
		$("#school_fees_message").text("Please School Fees");
		$("#school_fees_message").show();
		$("#school_fees_message").removeClass();
		$("#school_fees_message").addClass("control-group error");
		return false;
	}
	else
	{
		$("#school_fees_message").text("Valid");
		$("#school_fees_message").show();
		$("#school_fees_message").removeClass();
		$("#school_fees_message").addClass("control-group success");
		return true;	
	}
	
	if($.trim($("#hostel_fees").val()) == ''){
		$("#hostel_fees_message").text("Please Hostel Fees");
		$("#hostel_fees_message").show();
		$("#hostel_fees_message").removeClass();
		$("#hostel_fees_message").addClass("control-group error");
		return false;
	}
	else
	{
		$("#hostel_fees_message").text("Valid");
		$("#hostel_fees_message").show();
		$("#hostel_fees_message").removeClass();
		$("#hostel_fees_message").addClass("control-group success");
		return true;	
	}
	
	if($.trim($("#admission_fees").val()) == ''){
		$("#admission_fees_message").text("Please Admission Fees");
		$("#admission_fees_message").show();
		$("#admission_fees_message").removeClass();
		$("#admission_fees_message").addClass("control-group error");
		return false;
	}
	else
	{
		$("#admission_fees_message").text("Valid");
		$("#admission_fees_message").show();
		$("#admission_fees_message").removeClass();
		$("#admission_fees_message").addClass("control-group success");
		return true;	
	}
	
	if($.trim($("#electric_charge").val()) == ''){
		$("#electric_charge_message").text("Please Electric Charge");
		$("#electric_charge_message").show();
		$("#electric_charge_message").removeClass();
		$("#electric_charge_message").addClass("control-group error");
		return false;
	}
	else
	{
		$("#electric_charge_message").text("Valid");
		$("#electric_charge_message").show();
		$("#electric_charge_message").removeClass();
		$("#electric_charge_message").addClass("control-group success");
		return true;	
	}	
	return true;		
}

function dateCompare_news()
{
	var currentDate = new Date();
	var day = currentDate.getDate();
  var month =('0'+(currentDate.getMonth()+1)).slice(-2); // currentDate.getMonth() + 1;
  var year = currentDate.getFullYear();
  var today=year+"-"+month+"-"+day;
  var add_end_date = $.trim($("#add_end_date").val());
			 if(add_end_date < today)
				{
						 
					$("#add_end_date_message").text("Date must be future date");
					$("#add_end_date_message").show();
					$("#add_end_date_control").removeClass();
					$("#add_end_date_control").addClass("control-group error");
					return false;
				}
				else{
					$("#add_end_date_message").text("Valid");
					$("#add_end_date_message").show();
					$("#add_end_date_control").removeClass();
					$("#add_end_date_control").addClass("control-group success");
					return true;;	
				}

}


<!---------------------------------------------------------------------------------------------------------------------->
function edit_numeric(edit_vacancies)  
   {  
      var numbers = /^[0-9]+$/;  
      if(edit_vacancies.value.match(numbers))  
      {       
      		return true;  
      }  
      else  
      {  
		 $("#edit_vacancies_message").text("Please Enter numeric ");
		$("#edit_vacancies_message").show();
		$("#edit_vacancies_control").removeClass();
		$("#edit_vacancies_control").addClass("control-group error");
		  
		  return false;  
      }  
   }
   

function validateEmail(email)
	   {
			var splitted = email.match("^(.+)@(.+)$");
			if(splitted == null) return false;
			if(splitted[1] != null )
			{
			  var regexp_user=/^\"?[\w-_\.]*\"?$/;
			  if(splitted[1].match(regexp_user) == null) return false;
			}
			if(splitted[2] != null)
			{
			  var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
			  if(splitted[2].match(regexp_domain) == null) 
			  {
				var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
				if(splitted[2].match(regexp_ip) == null) return false;
			  }// if
			  return true;
			}
			return false;
	 }
 