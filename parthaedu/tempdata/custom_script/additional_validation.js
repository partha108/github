

<!------------------------------------News----------------------------------------->
function validate_title()
{
	var title = $.trim($("#add_title").val());
	if(title == ''){
		$("#add_title_message").text("Please Enter Title");
		$("#add_title_message").show();
		$("#add_title_control").removeClass();
		$("#add_title_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#add_title_message").text("Valid");
		$("#add_title_message").show();
		$("#add_title_control").removeClass();
		$("#add_title_control").addClass("control-group success");
		return true;	
	}		
}
function title_onblur(){
	if(!validate_title())
		$("#add_title").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_description()
{
	var add_description = $.trim($("#add_description").val());
	if(add_description == ''){
		$("#add_description_message").text("Please Enter Description");
		$("#add_description_message").show();
		$("#add_description_control").removeClass();
		$("#add_description_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#add_description_message").text("Valid");
		$("#add_description_message").show();
		$("#add_description_control").removeClass();
		$("#add_description_control").addClass("control-group success");
		return true;	
	}		
}
function description_onblur(){
	if(!validate_description())
		$("#add_description").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_add_enddate()
{
	var add_end_date = $.trim($("#add_end_date").val());
	if(add_end_date == ''){
		$("#add_end_date_message").text("Please Enter End date");
		$("#add_end_date_message").show();
		$("#add_end_date_control").removeClass();
		$("#add_end_date_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#add_end_date_message").text("Valid");
		$("#add_end_date_message").show();
		$("#add_end_date_control").removeClass();
		$("#add_end_date_control").addClass("control-group success");
		return true;	
	}
		
}
function add_enddate_onblur(){
	if(!validate_add_enddate())
		$("#add_end_date").focus();
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

function dateCompare_edit_news()
{
	var currentDate = new Date();
	var day = currentDate.getDate();
  var month =('0'+(currentDate.getMonth()+1)).slice(-2); // currentDate.getMonth() + 1;
  var year = currentDate.getFullYear();
  var today=year+"-"+month+"-"+day;
 	var add_end_date = $.trim($("#end_date").val());
			 if(add_end_date < today)
				{
					
				$("#edit_date_message").text("Date must be future date");
				$("#edit_date_message").show();
				$("#edit_date_control").removeClass();
				$("#edit_date_control").addClass("control-group error");
				return false;
				
				}
				else{
				$("#edit_date_message").text("Valid");
				$("#edit_date_message").show();
				$("#edit_date_control").removeClass();
				$("#edit_date_control").addClass("control-group success");
				return true;
					
				}
}

<!----------------------------------------------------------------------------------------------------------------------------->
function validate_edit_title()
{
	var title = $.trim($("#title").val());
	if(title == ''){
		$("#title_message").text("Please Enter Title");
		$("#title_message").show();
		$("#title_control").removeClass();
		$("#title_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#title_message").text("Valid");
		$("#title_message").show();
		$("#title_control").removeClass();
		$("#title_control").addClass("control-group success");
		return true;	
	}		
}
function edit_title_onblur(){
	if(!validate_edit_title())
		$("#title").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_edit_description()
{
	var description = $.trim($("#description").val());
	if(description == ''){
		$("#description_message").text("Please Enter Description");
		$("#description_message").show();
		$("#description_message_control").removeClass();
		$("#description_message_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#description_message").text("Valid");
		$("#description_message").show();
		$("#description_message_control").removeClass();
		$("#description_message_control").addClass("control-group success");
		return true;	
	}		
}
function edit_description_onblur(){
	if(!validate_edit_description())
		$("#description").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_end_date()
{
	var end_date = $.trim($("#end_date").val());
	if(end_date == ''){
		$("#end_date_message").text("Please Enter End date");
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
function end_date_onblur(){
	if(!validate_end_date())
		$("#end_date").focus();
}

<!-------------------------------------Career----------------------------------------------------->
function validate_Career_exp_date()
{
	var exp_date = $.trim($("#exp_date").val());
	if(exp_date == ''){
		$("#exp_date_message").text("Please Enter End date");
		$("#exp_date_message").show();
		$("#exp_date_control").removeClass();
		$("#exp_date_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#exp_date_message").text("Valid");
		$("#exp_date_message").show();
		$("#exp_date_control").removeClass();
		$("#exp_date_control").addClass("control-group success");
		return true;	
	}
			
}
function Career_exp_date_onblur(){
	if(!validate_Career_exp_date())
		$("#exp_date").focus();
}



<!----------------------------------Career validate_Vacancies------------------------------------------------->
function validate_Vacancies()
{
	var vacancies = $.trim($("#vacancies").val());
	if(vacancies == ''){
		$("#vacancies_message").text("Please Enter vacancies");
		$("#vacancies_message").show();
		$("#vacancies_control").removeClass();
		$("#vacancies_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#vacancies_message").text("Valid");
		$("#vacancies_message").show();
		$("#vacancies_control").removeClass();
		$("#vacancies_control").addClass("control-group success");
		return true;	
	}		
}
function vacancies_message_onblur(){
	if(!validate_Vacancies())
		$("#vacancies").focus();
}

<!--------------------------------Career validate_Post---------------------------------------------------------->
function validate_Post()
{
	var post = $.trim($("#post").val());
	if(post == ''){
		$("#post_message").text("Please Enter vacancies");
		$("#post_message").show();
		$("#post_control").removeClass();
		$("#post_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#post_message").text("Valid");
		$("#post_message").show();
		$("#post_control").removeClass();
		$("#post_control").addClass("control-group success");
		return true;	
	}		
}
function validate_Post_onblur(){
	if(!validate_Post())
		$("#post").focus();
}


<!---------------------------------------------------------------------------------------------------------------------->
function validate_edit_Career_exp_date()
{
	var edit_exp_date = $.trim($("#edit_exp_date").val());
	if(edit_exp_date == ''){
		$("#edit_exp_date_message").text("Please Enter End date");
		$("#edit_exp_date_message").show();
		$("#edit_exp_date_control").removeClass();
		$("#edit_exp_date_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_exp_date_message").text("Valid");
		$("#edit_exp_date_message").show();
		$("#edit_exp_date_control").removeClass();
		$("#edit_exp_date_control").addClass("control-group success");
		return true;	
	}		
}
function edit_Career_exp_date_onblur(){
	if(!validate_edit_Career_exp_date())
		$("#edit_exp_date").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_edit_Vacancies()
{
	var edit_vacancies = $.trim($("#edit_vacancies").val());
	if(edit_vacancies == ''){
		$("#edit_vacancies_message").text("Please Enter vacancies");
		$("#edit_vacancies_message").show();
		$("#edit_vacancies_control").removeClass();
		$("#edit_vacancies_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_vacancies_message").text("Valid");
		$("#edit_vacancies_message").show();
		$("#edit_vacancies_control").removeClass();
		$("#edit_vacancies_control").addClass("control-group success");
		return true;	
	}	
	
			
}
function edit_vacancies_message_onblur(){
	if(!validate_edit_Vacancies())
		$("#edit_vacancies").focus();
}



<!---------------------------------------------------------------------------------------------------------------------->
function edit_validate_Post()
{
	var edit_post = $.trim($("#edit_post").val());
	if(edit_post == ''){
		$("#edit_post_message").text("Please Enter vacancies");
		$("#edit_post_message").show();
		$("#edit_post_control").removeClass();
		$("#edit_post_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_post_message").text("Valid");
		$("#edit_post_message").show();
		$("#edit_post_control").removeClass();
		$("#edit_post_control").addClass("control-group success");
		return true;	
	}		
}
function edit_validate_Post_onblur(){
	if(!edit_validate_Post())
		$("#edit_post").focus();
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
   
   <!------------------------------------add_numeric vacancies------------------------------------------------------------>
function add_numeric(vacancies)  
   {  
      var numbers = /^[0-9]+$/;  
      if(vacancies.value.match(numbers))  
      {       
      		return true;  
      }  
      else  
      {  
		 $("#vacancies_message").text("Please Enter numeric ");
		$("#vacancies_message").show();
		$("#vacancies_control").removeClass();
		$("#vacancies_control").addClass("control-group error");
		  
		  return false;  
      }  
   }

<!------------------------------------Image Category------------------------------------------------------->
function validate_ImageCategory()
{
	var photo_category = $.trim($("#photo_category").val());
	if(photo_category == ''){
		
		$("#photo_category_message").text("Please Enter Image Category");
		$("#photo_category_message").show();
		$("#photo_category_control").removeClass();
		$("#photo_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#photo_category_message").text("Valid");
		$("#photo_category_message").show();
		$("#photo_category_control").removeClass();
		$("#photo_category_control").addClass("control-group success");
		return true;	
	}		
}
function validate_ImageCategory_onblur(){
	if(!validate_ImageCategory())
		$("#photo_category").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_EditImageCategory()
{
	var edit_photo_category = $.trim($("#edit_photo_category").val());
	if(edit_photo_category == ''){
		$("#edit_photo_category_message").text("Please Enter Image Category");
		$("#edit_photo_category_message").show();
		$("#edit_photo_category_control").removeClass();
		$("#edit_photo_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_photo_category_message").text("Valid");
		$("#edit_photo_category_message").show();
		$("#edit_photo_category_control").removeClass();
		$("#edit_photo_category_control").addClass("control-group success");
		return true;	
	}		
}
function validate_EditImageCategory_onblur(){
	if(!validate_EditImageCategory())
		$("#edit_photo_category").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_selectImageCategory()
{
	var category = $.trim($("#category").val());
	if(Number(category) == 0){
		$("#category_message").text("Please Select Image Category ");
		$("#category_message").show();
		$("#category_control").removeClass();
		$("#category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#category_message").text("Valid");
		$("#category_message").show();
		$("#category_control").removeClass();
		$("#category_control").addClass("control-group success");
		return true;	
	}		
}
function validate_selectImageCategory_onblur(){
	if(!validate_selectImageCategory())
		$("#category").focus();
}

<!---------------------------------------------------------------------------------------------------------------------->
function validate_Edit_selectImageCategory()
{
	var edit_category = $.trim($("#edit_category").val());
	if(Number(edit_category) == 0){
		$("#edit_category_message").text("Please Select Image Category");
		$("#edit_category_message").show();
		$("#edit_category_control").removeClass();
		$("#edit_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_category_message").text("Valid");
		$("#edit_category_message").show();
		$("#edit_category_control").removeClass();
		$("#edit_category_control").addClass("control-group success");
		return true;	
	}		
}
function validate_Edit_selectImageCategory_onblur(){
	if(!validate_Edit_selectImageCategory())
		$("#edit_category").focus();
}

<!-----------------------------------------Board_Category-------------------------------->
function validate_add_board_category()
{
	var board_category = $.trim($("#board_category").val());
	if(board_category == ''){
		$("#board_category_message").text("Please Enter Category");
		$("#board_category_message").show();
		$("#board_category_control").removeClass();
		$("#board_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#board_category_message").text("Valid");
		$("#board_category_message").show();
		$("#board_category_control").removeClass();
		$("#board_category_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_board_category()
{
	var edit_board_category = $.trim($("#edit_board_category").val());
	if(edit_board_category == ''){
		$("#edit_board_category_message").text("Please Enter Category");
		$("#edit_board_category_message").show();
		$("#edit_board_category_control").removeClass();
		$("#edit_board_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_board_category_message").text("Valid");
		$("#edit_board_category_message").show();
		$("#edit_board_category_control").removeClass();
		$("#edit_board_category_control").addClass("control-group success");
		return true;	
	}		
}

<!-----------------------------------------Board_view-------------------------------->
function validate_add_boardCategory()
{
	var board_category = $.trim($("#board_category").val());
	if(Number(board_category) == 0){
		$("#board_category_message").text("Please Enter Category");
		$("#board_category_message").show();
		$("#board_category_control").removeClass();
		$("#board_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#board_category_message").text("Valid");
		$("#board_category_message").show();
		$("#board_category_control").removeClass();
		$("#board_category_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_boardCategory()
{
	var edit_board_category = $.trim($("#edit_board_category").val());
	if(Number(edit_board_category) == 0){
		$("#edit_board_category_message").text("Please Enter Category");
		$("#edit_board_category_message").show();
		$("#edit_board_category_control").removeClass();
		$("#edit_board_category_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_board_category_message").text("Valid");
		$("#edit_board_category_message").show();
		$("#edit_board_category_control").removeClass();
		$("#edit_board_category_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_firstname()
{
	var firstname = $.trim($("#firstname").val());
	if(firstname == ''){
		$("#firstname_message").text("Please Enter Firstname");
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

function validate_edit_firstname()
{
	var edit_firstname = $.trim($("#edit_firstname").val());
	if(edit_firstname == ''){
		$("#edit_firstname_message").text("Please Enter Firstname");
		$("#edit_firstname_message").show();
		$("#edit_firstname_control").removeClass();
		$("#edit_firstname_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_firstname_message").text("Valid");
		$("#edit_firstname_message").show();
		$("#edit_firstname_control").removeClass();
		$("#edit_firstname_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_lastname()
{
	var lastname = $.trim($("#lastname").val());
	if(lastname == ''){
		$("#lastname_message").text("Please Enter Firstname");
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

function validate_edit_lastname()
{
	var edit_lastname = $.trim($("#edit_lastname").val());
	if(edit_lastname == ''){
		$("#edit_lastname_message").text("Please Enter Lastname");
		$("#edit_lastname_message").show();
		$("#edit_lastname_control").removeClass();
		$("#edit_lastname_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_lastname_message").text("Valid");
		$("#edit_lastname_message").show();
		$("#edit_lastname_control").removeClass();
		$("#edit_lastname_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_occupation()
{
	var occupation = $.trim($("#occupation").val());
	if(occupation == ''){
		$("#occupation_message").text("Please Enter Occupation");
		$("#occupation_message").show();
		$("#occupation_control").removeClass();
		$("#occupation_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#occupation_message").text("Valid");
		$("#occupation_message").show();
		$("#occupation_control").removeClass();
		$("#occupation_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_occupation()
{
	var edit_occupation = $.trim($("#edit_occupation").val());
	if(edit_occupation == ''){
		$("#edit_occupation_message").text("Please Enter Occupation");
		$("#edit_occupation_message").show();
		$("#edit_occupation_control").removeClass();
		$("#edit_occupation_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_occupation_message").text("Valid");
		$("#edit_occupation_message").show();
		$("#edit_occupation_control").removeClass();
		$("#edit_occupation_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_position()
{
	var position = $.trim($("#position").val());
	if(position == ''){
		$("#position_message").text("Please Enter Position");
		$("#position_message").show();
		$("#position_control").removeClass();
		$("#position_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#position_message").text("Valid");
		$("#position_message").show();
		$("#position_control").removeClass();
		$("#position_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_position()
{
	var edit_position = $.trim($("#edit_position").val());
	if(edit_position == ''){
		$("#edit_position_message").text("Please Enter Position");
		$("#edit_position_message").show();
		$("#edit_position_control").removeClass();
		$("#edit_position_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_position_message").text("Valid");
		$("#edit_position_message").show();
		$("#edit_position_control").removeClass();
		$("#edit_position_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_address()
{
	var address = $.trim($("#address").val());
	if(address == ''){
		$("#address_message").text("Please Enter Address");
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

function validate_edit_address()
{
	var edit_address = $.trim($("#edit_address").val());
	if(edit_address == ''){
		$("#edit_address_message").text("Please Enter Address");
		$("#edit_address_message").show();
		$("#edit_address_control").removeClass();
		$("#edit_address_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_address_message").text("Valid");
		$("#edit_address_message").show();
		$("#edit_address_control").removeClass();
		$("#edit_address_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_city()
{
	var city = $.trim($("#city").val());
	if(city == ''){
		$("#city_message").text("Please Enter City");
		$("#city_message").show();
		$("#city_control").removeClass();
		$("#city_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#city_message").text("Valid");
		$("#city_message").show();
		$("#city_control").removeClass();
		$("#city_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_city()
{
	var edit_city = $.trim($("#edit_city").val());
	if(edit_city == ''){
		$("#edit_city_message").text("Please Enter City");
		$("#edit_city_message").show();
		$("#edit_city_control").removeClass();
		$("#edit_city_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_city_message").text("Valid");
		$("#edit_city_message").show();
		$("#edit_city_control").removeClass();
		$("#edit_city_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_state()
{
	var state = $.trim($("#state").val());
	if(state == ''){
		$("#state_message").text("Please Enter State");
		$("#state_message").show();
		$("#state_control").removeClass();
		$("#state_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#state_message").text("Valid");
		$("#state_message").show();
		$("#state_control").removeClass();
		$("#state_control").addClass("control-group success");
		return true;	
	}		
}
function validate_edit_state()
{
	var edit_state = $.trim($("#edit_state").val());
	if(edit_state == ''){
		$("#edit_state_message").text("Please Enter State");
		$("#edit_state_message").show();
		$("#edit_state_control").removeClass();
		$("#edit_state_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_state_message").text("Valid");
		$("#edit_state_message").show();
		$("#edit_state_control").removeClass();
		$("#edit_state_control").addClass("control-group success");
		return true;	
	}		
}
function validate_add_country()
{
	var country = $.trim($("#country").val());
	if(Number(country) == 0){
		$("#country_message").text("Please Enter Country");
		$("#country_message").show();
		$("#country_control").removeClass();
		$("#country_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#country_message").text("Valid");
		$("#country_message").show();
		$("#country_control").removeClass();
		$("#country_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_country()
{
	var edit_country = $.trim($("#edit_country").val());
	if(Number(edit_country) == 0){
		$("#edit_country_message").text("Please Enter Country");
		$("#edit_country_message").show();
		$("#edit_country_control").removeClass();
		$("#edit_country_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_country_message").text("Valid");
		$("#edit_country_message").show();
		$("#edit_country_control").removeClass();
		$("#edit_country_control").addClass("control-group success");
		return true;	
	}		
}
function validate_add_phone()
{
	var phone = $.trim($("#phone").val());
	if(phone == ''){
		$("#phone_message").text("Please Enter Phone");
		$("#phone_message").show();
		$("#phone_control").removeClass();
		$("#phone_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#phone_message").text("Valid");
		$("#phone_message").show();
		$("#phone_control").removeClass();
		$("#phone_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_phone_numeric(phone)  
   {  
      var numbers = /^[0-9]+$/;  
      if(phone.value.match(numbers))  
      {       
      		return true;  
      }  
      else  
      {  
		 $("#phone_message").text("Please Enter only numeric ");
		$("#phone_message").show();
		$("#phone_control").removeClass();
		$("#phone_control").addClass("control-group error");
		  
		  return false;  
      }  
   }

function validate_edit_phone()
{
	var edit_phone = $.trim($("#edit_phone").val());
	if(edit_phone == ''){
		$("#edit_phone_message").text("Please Enter Phone");
		$("#edit_phone_message").show();
		$("#edit_phone_control").removeClass();
		$("#edit_phone_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_phone_message").text("Valid");
		$("#edit_phone_message").show();
		$("#edit_phone_control").removeClass();
		$("#edit_phone_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_phone_numeric(edit_phone)  
   {  
      var numbers = /^[0-9]+$/;  
      if(edit_phone.value.match(numbers))  
      {       
      		return true;  
      }  
      else  
      {  
		 $("#edit_phone_message").text("Please Enter only numeric ");
		$("#edit_phone_message").show();
		$("#edit_phone_control").removeClass();
		$("#edit_phone_control").addClass("control-group error");
		  
		  return false;  
      }  
   }
   
function validate_add_emptyEmail()
{
	var email = $.trim($("#email").val());
	if(email == ''){
		
		return true; 
	}
	else
	{
			return false;  
		   	
	}		
}

function validate_edit_emptyEmail(edit_email)
{
	var edit_email = $.trim($("#edit_email").val());
	if(edit_email == ''){
		
		return true; 
	}
	else
	{
		if(!validateEmail(edit_email))
		{
		 $("#edit_email_message").text("Please Enter Valid Email ");
				$("#edit_email_message").show();
				$("#edit_email_control").removeClass();
				$("#edit_email_control").addClass("control-group error");
				 return false; 	
		}
			return true;  
		   	
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
 <!------------------------------------------------End Board------------------------------------------->
 
 <!----------------------------------------------Rules------------------------------------------------>
 
function validate_add_ruleName()
{
	var rule_name = $.trim($("#rule_name").val());
	if(Number(rule_name) == 0){
		$("#rule_name_message").text("Please Select a Rule Name");
		$("#rule_name_message").show();
		$("#rule_name_control").removeClass();
		$("#rule_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#rule_name_message").text("Valid");
		$("#rule_name_message").show();
		$("#rule_name_control").removeClass();
		$("#rule_name_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_ruleName()
{
	var edit_rule_name = $.trim($("#edit_rule_name").val());
	
	if(Number(edit_rule_name) == 0){
		$("#edit_rule_name_message").text("Please Select a Rule Name");
		$("#edit_rule_name_message").show();
		$("#edit_rule_name_control").removeClass();
		$("#edit_rule_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_rule_name_message").text("Valid");
		$("#edit_rule_name_message").show();
		$("#edit_rule_name_control").removeClass();
		$("#edit_rule_name_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_ruleTitle()
{
	var rule_name = $.trim($("#rule_title").val());
	if(rule_name == ''){
		$("#rule_title_message").text("Please Enter Rule Title");
		$("#rule_title_message").show();
		$("#rule_title_control").removeClass();
		$("#rule_title_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#rule_title_message").text("Valid");
		$("#rule_title_message").show();
		$("#rule_title_control").removeClass();
		$("#rule_title_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_ruleTitle()
{
	var edit_rule_title = $.trim($("#edit_rule_title").val());
	if(edit_rule_title == ''){
		$("#edit_rule_title_message").text("Please Enter Rule Title");
		$("#edit_rule_title_message").show();
		$("#edit_rule_title_control").removeClass();
		$("#edit_rule_title_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_rule_title_message").text("Valid");
		$("#edit_rule_title_message").show();
		$("#edit_rule_title_control").removeClass();
		$("#edit_rule_title_control").addClass("control-group success");
		return true;	
	}		
}

function validate_add_ruleContent()
{
	var rule_content = $.trim($("#rule_content").val());
	if(rule_content == ''){
		$("#rule_content_message").text("Please Enter Rule Content");
		$("#rule_content_message").show();
		$("#rule_content_control").removeClass();
		$("#rule_content_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#rule_content_message").text("Valid");
		$("#rule_content_message").show();
		$("#rule_content_control").removeClass();
		$("#rule_content_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_ruleContent()
{
	var edit_rule_content = $.trim($("#edit_rule_content").val());
	if(edit_rule_content == ''){
		$("#edit_rule_content_message").text("Please Enter Rule Content");
		$("#edit_rule_content_message").show();
		$("#edit_rule_content_control").removeClass();
		$("#edit_rule_content_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_rule_content_message").text("Valid");
		$("#edit_rule_content_message").show();
		$("#edit_rule_content_control").removeClass();
		$("#edit_rule_content_control").addClass("control-group success");
		return true;	
	}		
}

<!------------------------------------------------Rule Category-------------------------------------------------->

function validate_add_ruleCatgoryName()
{
	var rule_name = $.trim($("#rule_name").val());
	if(rule_name == ''){
		$("#rule_name_message").text("Please Enter Rule Name");
		$("#rule_name_message").show();
		$("#rule_name_control").removeClass();
		$("#rule_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#rule_name_message").text("Valid");
		$("#rule_name_message").show();
		$("#rule_name_control").removeClass();
		$("#rule_name_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_ruleCategoryName()
{
	var edit_rule_name = $.trim($("#edit_rule_name").val());
	if(edit_rule_name == ''){
		$("#edit_rule_name_message").text("Please Enter Rule Name");
		$("#edit_rule_name_message").show();
		$("#edit_rule_name_control").removeClass();
		$("#edit_rule_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_rule_name_message").text("Valid");
		$("#edit_rule_name_message").show();
		$("#edit_rule_name_control").removeClass();
		$("#edit_rule_name_control").addClass("control-group success");
		return true;	
	}		
}

<!------------------------------------------------Grading System-------------------------------------------------->

function validate_add_gradingName()
{
	var name = $.trim($("#name").val());
	if(name == ''){
		$("#name_message").text("Please Enter Grading System Name");
		$("#name_message").show();
		$("#name_control").removeClass();
		$("#name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#name_message").text("Valid");
		$("#name_message").show();
		$("#name_control").removeClass();
		$("#name_control").addClass("control-group success");
		return true;	
	}		
}

function validate_edit_gradingName()
{
	var edit_name = $.trim($("#edit_name").val());
	if(edit_name == ''){
		$("#edit_name_message").text("Please Enter Grading System Name");
		$("#edit_name_message").show();
		$("#edit_name_control").removeClass();
		$("#edit_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#edit_name_message").text("Valid");
		$("#edit_name_message").show();
		$("#edit_name_control").removeClass();
		$("#edit_name_control").addClass("control-group success");
		return true;	
	}		
}


