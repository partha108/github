$(function() {
    $( ".datepicker_" ).datepicker({		
      changeMonth: true,
        changeYear: true,
		dateFormat : 'yy-mm-dd',
  		yearRange: "-100:+10",
        onChangeMonthYear: function (year, month, day) {
            $(this).datepicker('setDate', new Date(year, month - 1, day.selectedDay));
        }
		
    });
  });

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


