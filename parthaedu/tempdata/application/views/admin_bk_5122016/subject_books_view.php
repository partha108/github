<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Classes And Subject</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i><?php echo $classname;?>: Books of <?php echo $subname;  ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <div><a class="btn btn-primary" href="#" onclick="open_add_model(<?php echo $subid;?>,<?php echo $classid;?>)" > Add Book </a></div>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th> Id</th>            
              <th>Book Name</th>
              <th>Author Name</th>
              <th>Edition</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0;  foreach($books_sub as $subjectlist):
				$count=$count+1;
			?>             
            <tr>
              <td><?php echo $count;?></td>             
               <td><?php echo $subjectlist['book_name'];?></td>
                <td><?php echo $subjectlist['author_name'];?></td>
              <td> <?php echo $subjectlist['edition'];?>  </td>              
            </tr>
            <?php endforeach;?>
           
          </tbody>
        </table>
        
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>
<!----------------------------------------------------------------------Add ------------------------------------------------------------------------->
<div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/classSubject_book_post', array('class' => 'form-horizontal', 'id' => 'addSubjectbookFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Book</h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
             <?php echo $this->session->flashdata('insert_message');?>           
            
            <input type="hidden" id="subid" name="subid" value="<?php echo $subid;?>" />
            <input type="hidden" id="classname" name="classname" value="<?php echo $classname;?>" />
            <input type="hidden" id="classid" name="classid" value="<?php echo $classid;?>" />
            <input type="hidden" id="classubid" name="classubid" value="<?php echo $classsubid;?>" />
            <input type="hidden" id="subname" name="subname" value="<?php echo $subname;?>" />
            
             <div class="control-group" id="subject_control" >
            <label class="control-label" for="subject">Select Book</label>
              <div class="controls" id="booklist">
                
             
				
              
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" >Add</button>
  </div>
  </form>
</div>

<!--------------------------------------------------Add Book----------------------------------------------->


<!------------------------------------Edit------------------------------------------------------------------->

<script language="javascript" type="text/javascript">
function open_add_model(subid,classid)
{
	$("#myaddmodel").modal('show');	
	
	var base_url='<?php echo base_url();?>'; 
	//alert("id="+subid);
	//window.location=base_url+"index.php/admin/subject_all_books?subid="+subid+"&classid="+classid;
	$.ajax({
					
				type:"GET",
				  url:base_url+"index.php/admin/subject_all_books?subid="+subid+"&classid="+classid,
				  dataType:'json', 
				  success: function(data) {
					var books_sub = data.books_sub;
					var books_list = data.books_list;
					
					 console.log(books_sub);
					 
					var html_string=" ";
						var i=0;
						var j=0;
						for(i=0;i<books_list.length;i++)
						{
							html_string+="<input   type='checkbox' name='books[]' id='check"+books_list[i].book_id+"'  value='"+books_list[i].book_id+"'/>&nbsp;<span>"+books_list[i].book_name+"</span>&nbsp;<span>(For &nbsp;"+ books_list[i].class_name+")<br />";
							
						}
						
						$('#booklist').html(html_string);
						for(j=0;j<books_sub.length;j++){	
												
							$("#check"+books_sub[j].book_id).attr('checked','checked');
						}
					
				  }
				  
		});
		
}

function openedit_model(id)
{
	if(id){
		var base_url='<?php echo base_url();?>'; 
		var dataString = 'id='+ id ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/admin/edit_classSubject",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 
				 
					var edit_class = data.edit_class[0];
					 console.log(edit_class);
					 $('#id').val(edit_class.id);
					$('#edit_name').val(edit_class.name);
					$('#status').val(edit_class.status);
					 $('#myEditModal').modal('show');
				  }
				  
		});
	}
}



function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='tblclass';
	var column='id';
	var page='admin/classes';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/admin/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}

function activate_inactivateitem(id,status){
	var base_url='<?php echo base_url();?>'; 
	var tablename='tblclass';
	var columnname='id';
	var setColumn='status';
	var page='admin/classes';
	if(status=="active"){
		
		status="inactive";
		if(confirm('Are you sure do you want to Deactivate it?')){
			
			window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}
	}else{
		status="active";
		if(confirm('Are you sure do you want to Active it?')){
			window.location = 	base_url+'index.php/admin/block_unblock?id='+id+'&table='+tablename+'&setColumn='+setColumn+'&columnvalue='+status+'&column='+columnname+'&page='+page;
		}

	}
}


function validate_form()
{
	
	if(!validate_add_name()){
		$("#name").focus();
		return false;}
	
	return true;
}	

function validate_add_name()
{
	var firstname = $.trim($("#name").val());
	if(firstname == ''){
		$("#name_message").text("Please Enter Class Name");
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

function validate_edit_name()
{
	var firstname = $.trim($("#edit_name").val());
	if(firstname == ''){
		$("#edit_name_message").text("Please Enter Class Name");
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
   
function validate_edit_form()
{
	if(!validate_edit_name()){
		$("#edit_name").focus();
		return false;}
	
	return true;
}	

function add_subjects(id){
	var base_url='<?php echo base_url();?>'; 
		
	window.location = base_url+'index.php/admin/class_subject?id='+id;
}

function open_add_book(class_subject_id)
{
	//alert(class_subject_id);
	$("#subid").val(class_subject_id);
	
	var base_url='<?php echo base_url();?>'; 
		var dataString = 'subid='+ class_subject_id ;
		$.ajax({
				  type: "POST",
				  dataType:'json',  
				  url:base_url+"index.php/admin/subject_all_books",  
				  data: dataString,
				  async: false,  
				  success: function(data) { 
				 
					var books_sub = data.books_sub[0];
					 console.log(books_sub);
					$('input:checkbox[id=books_sub.book_id]').prop('checked', this.checked);
					 
				
				  }
				  
		});
	
	$("#myaddBookmodel").modal('show');	
	
}





</script>