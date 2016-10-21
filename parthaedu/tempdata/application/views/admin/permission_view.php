<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Permission</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Permission</h2>
      </div>
      <div class="box-content">
       <div class="box span12">
      
      <div class="box-content"><?php echo form_open_multipart('permission/add_permission', array('class' => 'form-horizontal', 'id' => 'addpermission')); ?>
            <div class="box-header well" data-original-title>Subadmin List
        <div class="box-icon"></div>
      </div>
         <div class="control-group"> 
         <select class="span3 typeahead" id="role" name="role" onchange="role_user(this.value)">        
             <option value="0">--Select Role---</option>
                <?php if(isset($roles)){  foreach($roles as $roleitm): if($roleitm->id==5){?>
              <option value="<?php echo $roleitm->id ?>"><?php echo $roleitm->role_name ?></option>
         	 <?php } endforeach; } ?>  
         </select>         
			<div id="divSubadmin">
            
            </div>
                    
          </div> 
          <div class="box-header well" data-original-title>Permision Details List
            <div class="box-icon"></div>
          </div>                       
      	 <div class="control-group">
         <table>
       <?php $count=0;   
	   foreach($pages as $page) { 
	   			$count++ ;
				if($count==0)
				{
					echo "<tr>";	
				}
			?>
            
            <td>
         	  <input type="checkbox" name="permission_page[]" value="<?php echo $page->page_id  ?> "  id="<?php echo $page->page_id  ?>"/>
			  <?php echo $page->page_name.' ' ?>               
             </td>  
            <?php if($count==4){
						echo "</tr>";
						$count=0;
					} ?>
			
			<?php } ?> 
            
          </table>      
        </div>
        
      </div>    
         
          <div class="form-actions">
            <input type="submit" class="btn btn-primary" value="Save" onclick="return change_permission();" >
            <button type="reset" class="btn">Cancel</button>
          </div>          
      
        </form>
   
    </div>
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>



<script src="<?php echo base_url();?>custom_script/user_validation.js"></script>
<script language="javascript" type="text/javascript">

function change_permission()
{
	if($('#role').val()==0)
	{
		alert('Please select user from list.');
		$('#role').focus();
		return false;
	}
	return true;
	
}

function role_user(id){
	
	var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+ id ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/permission/permission_role_user",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 				
					var user_list = data.user_list;
					 console.log(user_list);
					var i=0;
					 var html_string=" ";
					 for( i=0;i<user_list.length;i++){
					
					 html_string+="<input type='radio' id='subadmin' name='subadmin' value='"+user_list[i].id+"' onclick='permitted_page();' /> <span>";
					 html_string+=user_list[i].first_name+"&nbsp;"+user_list[i].last_name+"</span><br>";
					 
					 }
					 $('#divSubadmin').html(html_string);
				  }
		});
	
}

function permitted_page()
{
	var userid= $("input[name='subadmin']:checked").val()	;
	var roleid= $("#role").val()	;
	
	var dataString = 'userid='+ userid+'&roleid='+roleid ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/permission/permitted_pages_view",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 				
					var permission = data.permited_page;
					console.log(permission.length);	
					var checkboxarr = document.getElementsByName("permission_page[]");
						for(var ichecbox=0;ichecbox<checkboxarr.length;ichecbox++ )
						{
							var jsCheckBox = checkboxarr[ichecbox];
							var objCheckBx =$(jsCheckBox);	
							var spanelement = objCheckBx.parent();
							spanelement.removeClass("checked");
							objCheckBx.prop('checked', false); 
						}
						
					if(permission.length==0)
					{
						var checkboxarr = document.getElementsByName("permission_page[]");
						for(var ichecbox=0;ichecbox<checkboxarr.length;ichecbox++ )
						{
							var jsCheckBox = checkboxarr[ichecbox];
							var objCheckBx =$(jsCheckBox);	
							var spanelement = objCheckBx.parent();
							spanelement.removeClass("checked");
							objCheckBx.prop('checked', false); 
						}
						
					}else{
						
					 var checkboxarr = document.getElementsByName("permission_page[]");
						for(var ichecbox=0;ichecbox<checkboxarr.length;ichecbox++ )
						{
							var jsCheckBox = checkboxarr[ichecbox];
							var objCheckBx =$(jsCheckBox);	
							var spanelement = objCheckBx.parent();
							var bChecked=false;
								for(var ipermision=0;ipermision<permission.length;ipermision++)
								{	
										if(checkboxarr[ichecbox].id == permission[ipermision].page_id)
										{
											bChecked=true;
										}
										
										if(bChecked)
										{
											spanelement.addClass("checked");
											objCheckBx.prop('checked', true); 		
										}
											
								 }
							
						}
					}
							
							
				  }
		});
}
</script>