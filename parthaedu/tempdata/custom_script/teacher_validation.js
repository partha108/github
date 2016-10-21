
$(window).load(function()
{	
	$("#rdmultipleUserAdd").prop('checked',false);	
    $("#rdsingelUserAdd").attr('checked', 'checked'); 

});

function changeAddOptionMultiple()
{
	$("#divmultipleUserAdd").show();
	$("#divsingelUserAdd").hide();
	
}

function changeAddOptionSingle(){
		
	$("#divmultipleUserAdd").hide();
	$("#divsingelUserAdd").show();
}


 function validation_()
{
	//alert('Please Enter First Name.');
	
	if($('#firstname').val()=="")
	{
		//alert('Please Enter First Name.');
		$('#firstname_message').text('Please Enter First Name');
		$('#firstname_message').show();
		$('#firstname').focus();
		return false;
	}else{
		$('#firstname_message').hide();
		}
		
		
	
		
	if($('#lastname').val()=="")
	{
		//alert('Please Enter Last Name.');
		$('#lastname_message').text('Please Enter Last Name');
		$('#lastname_message').show();
		$('#lastname').focus();
		return false;
	}else{
		$('#lastname_message').hide();
		}
		
	
		
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
	if($('#email').val() == '')
	{
		
		//alert('Please enter your email id');
		$('#email_message').text('Please enter your email id');
		$('#email_message').show();
		$('#email').focus();
		return false;
	} else if (!filter.test($('#email').val())) 
		{
			//alert('Please enter a valid email id');
			$('#email_message').text('Please enter a valid email id');
		$('#email_message').show();
			$('#email').focus();
			return false;
		}
	
	else
	{
		$('#email_message').hide();
		
	}
	
	var filter = /[0-9 -()+]+$/;
	 if($('#phonenumber').val() == '')
	{
		
		//alert('Please enter your Phone Number');
		$('#phonenumber_message').text('Please enter your Phone Number');
		$('#phonenumber_message').show();
		$('#phonenumber').focus();
		return false;
	}
	else if (!filter.test($('#phonenumber').val())) 
		{//alert('Please enter your Phone Number');
			$('#phonenumber_message').text('Please enter your Phone Number');
		$('#phonenumber_message').show();
			$('#phonenumber').focus();
			return false;
		}
	else
	{
		$('#phonenumber_message').hide();
		
	}
	
		
	
	var filter = /[0-9 -()+]+$/;
	if($('#salary').val() == '')
	{
		
		//alert('Please enter salary');
		$('#salary_message').text('Please enter salary');
		$('#salary_message').show();
		$('#salary').focus();
		return false;
	}
	else if (!filter.test($('#salary').val())) 
		{ //alert('Please enter your salary');
			$('#salary_message').text('Please enter salary');
		$('#salary_message').show();
			$('#salary').focus();
			return false;
		}else
	{
		$('#salary_message').hide();
		
	}
	
		
	var filter = /[0-9 -()+]+$/;
	 if (!filter.test($('#mobile').val())) 
		{
			
			//alert('Please enter your Mobile Number');
			$('#mobile_message').text('Please enter your Mobile Number');
		$('#mobile_message').show();
			$('#mobile').focus();
			return false;
		}else
	{
		$('#mobile_message').hide();
		
	}
	
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


