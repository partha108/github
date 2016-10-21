function validate_class(){
	
		var classname=$.trim($("#classname").val());
	
	if(Number(classname) == 0){
		$("#class_message").text("Please Select a class");
		$("#class_message").show();
		$("#class_control").removeClass();
		$("#class_control").addClass("control-group error");
		return false;	
	}else{
		$("#class_message").text("Valid");
		$("#class_message").show();
		$("#class_control").removeClass();
		$("#class_control").addClass("control-group success");
		return true;	
	}
}

function validate_pass_year(){
	
		var pass_year=$.trim($("#pass_year").val());
	
	if(Number(pass_year) == 0){
		$("#pass_year_message").text("Please Select a year");
		$("#pass_year_message").show();
		$("#pass_year_control").removeClass();
		$("#pass_year_control").addClass("control-group error");
		return false;	
	}else{
		$("#pass_year_message").text("Valid");
		$("#pass_year_message").show();
		$("#pass_year_control").removeClass();
		$("#pass_year_control").addClass("control-group success");
		return true;	
	}
}

function validate_section(){
	
		var section=$.trim($("#section").val());
	
	if(Number(section) == 0){
		$("#section_message").text("Please Select  section");
		$("#section_message").show();
		$("#section_control").removeClass();
		$("#section_control").addClass("control-group error");
		return false;	
	}else{
		$("#section_message").text("Valid");
		$("#section_message").show();
		$("#section_control").removeClass();
		$("#section_control").addClass("control-group success");
		return true;	
	}
}

function validate_total_marks(){
	
		var total_marks=$.trim($("#total_marks").val());
	
	if(total_marks == ''){
		$("#total_marks_message").text("Please Enter Total marks .");
		$("#total_marks_message").show();
		$("#total_marks_control").removeClass();
		$("#total_marks_control").addClass("control-group error");
		return false;	
	}else{
		$("#total_marks_message").text("Valid");
		$("#total_marks_message").show();
		$("#total_marks_control").removeClass();
		$("#total_marks_control").addClass("control-group success");
		return true;	
	}
}

function validate_result_csv(){
	
		var result_csv=$.trim($("#result_csv").val());
	
	if(result_csv == ''){
		$("#result_csv_message").text("Please choose a file.");
		$("#result_csv_message").show();
		$("#result_csv_control").removeClass();
		$("#result_csv_control").addClass("control-group error");
		return false;	
	}else{
		$("#result_csv_message").text("Valid");
		$("#result_csv_message").show();
		$("#result_csv_control").removeClass();
		$("#result_csv_control").addClass("control-group success");
		return true;	
	}
}



