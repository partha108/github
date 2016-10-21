function validate_course_code()
{
	var course_code = $.trim($("#course_code").val());	
	if(course_code==''){		
		$("#course_code_message").text("Please enter Course Code");
		$("#course_code_message").show();
		$("#course_code_control").removeClass();
		$("#course_code_control").addClass("control-group error");
		return false;
	}	
	var bAvailable =false;
	var dataString = 'course_code='+ course_code ;

	$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/checkcourse_codeavailability",  
			  data: dataString,
			  async: false,  			  
			  success: function(data) { 
			  		bAvailable=data.Available;
					
			}  
	});
	
	if(bAvailable)
	{
		$("#course_code_message").text("Available");
		$("#course_code_message").show();
		$("#course_code_control").removeClass();
		$("#course_code_control").addClass("control-group success");
		return true;	
	}
	else
	{
		$("#course_code_message").text("Not Available");
		$("#course_code_message").show();
		$("#course_code_control").removeClass();
		$("#course_code_control").addClass("control-group error");
		return false;	
	}
}
function validate_editcourse_code()
{
	var course_code = $.trim($("#course_code1").val());	
	if(course_code==''){		
		$("#course1_code_message").text("Please enter Course Code");
		$("#course1_code_message").show();
		$("#course1_code_control").removeClass();
		$("#course1_code_control").addClass("control-group error");
		return false;
	}	
	var bAvailable =false;
	var dataString = 'course_code='+ course_code ;

	$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/admin/checkcourse_codeavailability",  
			  data: dataString,
			  async: false,  			  
			  success: function(data) { 
			  		bAvailable=data.Available;
					
			}  
	});
	
	if(bAvailable)
	{
		$("#course1_code_message").text("Available");
		$("#course1_code_message").show();
		$("#course1_code_control").removeClass();
		$("#course1_code_control").addClass("control-group success");
		return true;	
	}
	else
	{
		$("#course1_code_message").text("Not Available");
		$("#course1_code_message").show();
		$("#course1_code_control").removeClass();
		$("#course1_code_control").addClass("control-group error");
		return false;	
	}
}
function validate_course(){
	var coursename=$.trim($("#coursename").val());
	if(coursename==''){
		$("#coursename_message").text("Please Enter Course Name");
		$("#coursename_message").show();
		$("#coursename_control").removeClass();
		$("#coursename_control").addClass("control-group error");
		return false;	
	}else{
		$("#coursename_message").text("Valid");
		$("#coursename_message").show();
		$("#coursename_control").removeClass();
		$("#coursename_control").addClass("control-group success");
		return true;	
	}
}

function validate_editcourse(){
	var coursename=$.trim($("#coursename1").val());
	if(coursename==''){
		$("#coursename1_message").text("Please Enter Course Name");
		$("#coursename1_message").show();
		$("#coursename1_control").removeClass();
		$("#coursename1_control").addClass("control-group error");
		return false;	
	}else{
		$("#coursename1_message").text("Valid");
		$("#coursename1_message").show();
		$("#coursename1_control").removeClass();
		$("#coursename1_control").addClass("control-group success");
		return true;	
	}
}
function validate_batch_name()
{
	var batch_name = $.trim($("#batch_name").val());
	if(batch_name==''){
		$("#batch_name_message").text("Please enter Batch Name");
		$("#batch_name_message").show();
		$("#batch_name_control").removeClass();
		$("#batch_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#batch_name_message").text("Valid");
		$("#batch_name_message").show();
		$("#batch_name_control").removeClass();
		$("#batch_name_control").addClass("control-group success");
		return true;	
	}
		
}

function validate_start_date()
{
	var start_date = $.trim($("#start_date").val());
	if(start_date==''){
		$("#start_date_message").text("Please enter Start Date");
		$("#start_date_message").show();
		$("#start_date_control").removeClass();
		$("#start_date_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#start_date_message").text("Valid");
		$("#start_date_message").show();
		$("#start_date_control").removeClass();
		$("#start_date_control").addClass("control-group success");
		return true;	
	}
		
}

function validate_end_date()
{
	var end_date = $.trim($("#end_date").val());
	if(end_date==''){
		$("#end_date_message").text("Please enter End Date");
		$("#end_date_message").show();
		$("#end_date_control").removeClass();
		$("#end_date_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#end_date_message").text("Valid");
		$("#end_date_message").show();
		$("#end_date_control").removeClass();
		$("#end_date_control").addClass("control-group success");
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
function validate_grade_system()
{
	var grading_system_id = $.trim($("#grading_system_id").val());
	if(Number(grading_system_id) == 0){
		$("#grading_system_id_message").text("Please select Grade System");
		$("#grading_system_id_message").show();
		$("#grading_system_id_control").removeClass();
		$("#grading_system_id_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#grading_system_id_message").text("Valid");
		$("#grading_system_id_message").show();
		$("#grading_system_id_control").removeClass();
		$("#grading_system_id_control").addClass("control-group success");
		return true;	
	}		
}
function course_code_onblur(){
	if(!validate_course_code())
		$("#course_code").focus();
}

function coursename_onblur()
{
	if(!validate_course())
		$("#coursename").focus();
}
function batch_name_onblur()
{
	if(!validate_batch_name())
		$("#batch_name").focus();
}

function grading_system_onblur()
{
	if(!validate_grade_system())
		$("#grade_system_id").focus();
}
function start_date_onblur()
{
	if(!validate_start_date())
		$("#start_date").focus();
}
function end_date_onblur()
{
	if(!validate_end_date())
		$("#end_date").focus();
}

