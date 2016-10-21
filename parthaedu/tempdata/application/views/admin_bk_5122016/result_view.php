

<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Result</a> <span class="divider">/</span> </li>
      <li> <a href="#">Result</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Result</h2>
      </div>
      <div class="box-content">   
      
            <fieldset>
            <legend>Result</legend>
            <?php echo $this->session->flashdata('error_message');  ?> 
             <?php echo $this->session->flashdata('message');  ?>
              
             <div class="control-group" id="status_control">
            <label class="control-label" for="inputSuccess"><span style="font-weight:bolder;">Select Option</span></label>
                <div class="controls">
                  <label class="radio">
                    <input type="radio" name="result" id="rdshowResult" value="showResult" checked="checked"  onclick="changeshowResult()">
                   Show Result </label>
                   
                   <label class="radio">
                    <input type="radio" name="result" id="rdaddResultAsCSV" value="addResultAsCSV"  onclick="changerdaddResultAsCSV()">
                    Result Upload  </label>
                   
                    <label class="radio">
                    <input type="radio" name="result" id="Result_format" value="Result_format"  onclick="Add_edit_Format()">
                    Result Format  </label>
                     
                </div>
              </div>
              
<!----------------------------------------------------------Result Upload -----------------------------------------------> 
      
         <?php echo form_open_multipart('admin/result_csv', array('class' => 'form-horizontal', 'id' => 'addresultCSV')); ?>  
       <div id="addResultAsCSV" style="display:none;">
      
           
             <div class="control-group" id="class_control" >
              <label class="control-label" for="class">Select Class</label>
              <div class="controls">
                <select id="classname" data-rel="chosen" name="classname"  onchange="selected_section()" >
                  <option value="0">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo['id'];?>"><?php echo $classinfo['name'];?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>
            
             <div class="control-group" id="section_control" >
              <label class="control-label" for="section">Select Section</label>
              <div class="controls">
                <select id="section" data-rel="chosen" name="section"  >
                  <option value="0">--Select Section--</option>
                  <?php  foreach($section as $classinfo):?>
                  <option value="<?php echo $classinfo['id'];?>"><?php echo $classinfo['name'];?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="section_message" style="display:none;"></span> </div>
            </div>
            
            <div class="control-group" id="pass_year_control">
       		 	<label class="control-label" for="inputSuccess">Year Of Passing </label>
             	<div class="controls">
               <!--	<input type="text" id="pass_year" name="pass_year" />-->
                
                  <select id="pass_year" data-rel="chosen" name="pass_year"  >
                  <option value="0">--Select Year--</option>
                  
                  <option value="2008">2008</option>
                  <option value="2009">2009</option>
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                </select>
              	 <span class="help-inline" id="pass_year_message" style="display:none;"></span> </div>
           </div>
           
            <div class="control-group" id="total_marks_control" >
              <label class="control-label" for="section">Total Marks</label>
              <div class="controls">
               <input type="text" id="total_marks" name="total_marks" />
                <span class="help-inline" id="total_marks_message" style="display:none;"></span> </div>
            </div>
             <div class="control-group" id="total_marks_control" >
              <label class="control-label" for="section">Result System</label>
              <div class="controls">
              <select id="grading" data-rel="chosen" name="grading"  >
                  <option value="0">--Select System--</option>
                  <?php  foreach($grades as $gradesinfo):?>
                  <option value="<?php echo $gradesinfo['grading_system_id'];?>"><?php echo $gradesinfo['grading_system_name'];?></option>
                  <?php endforeach;?>
                </select>
                <span class="help-inline" id="total_marks_message" style="display:none;"></span> </div>
            </div>
           
       		<div class="control-group" id="result_csv_control">
       		 	<label class="control-label" for="inputSuccess">Select file </label>
             	<div class="controls">
               	<input type="file" id="result_csv" name="result_csv" />
                <?php if(count($result_format)>0){  ?>
                	<a id="img_download" data-rel="tooltip" title="Download result format" href="<?php echo base_url(); ?>uploads/document/<?php echo $result_format[0]['file_name'];?>">
                	<img height="50px" width="60px" src="<?php echo base_url(); ?>uploads/document/img_download.jpg"  /></a>
              	<?php } ?>
                 <span class="help-inline" id="result_csv_message" style="display:none;"></span> </div>
           </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary" onclick="return validate_form();">Add</button>
              <button type="reset" class="btn">Cancel</button>
            </div> 
              
       </div>
          </form>  </fieldset> 
            
  <!----------------------------------------------------- show Result div ---------------------------------------------------------->           
         
       <div id="showResultdiv" >
       <fieldset>
                <div class="control-group" >
       		 	<label class="control-label" for="inputSuccess">Registration No </label>
             	<div class="controls">
               <input type="text" id="registration_no" name="registration_no" />
               
				</div>
                <div class="control-group" >
       		 	<label class="control-label" for="inputSuccess">class </label>
             	
                <select id="show_classname" data-rel="chosen" name="show_classname"   >
                  <option value="0">--Select Class--</option>
                  <?php  foreach($class as $classinfo):?>
                  <option value="<?php echo $classinfo['id'];?>"><?php echo $classinfo['name'];?></option>
                  <?php endforeach;?>
                </select>
               	<button  class="btn btn-primary"  onclick="show_result();">Show Result</button> 
                <button type="reset" class="btn" onclick="resetform()">Reset</button>
				</div>
           </div>
            <!--<div class="control-group" >
       		 	 <label class="control-label" for="inputSuccess"  >Marks </label>
             	<div class="controls">
              <input type="text" id="st_marks" name="st_marks" readonly="readonly" value=""  />
				</div>
           </div>
                <div class="controls">
                 <label class="control-label" for="inputSuccess" >Total Marks </label> 
                 <div class="controls">
                <input type="text" id="exm_tot_marks" name="exm_tot_marks" readonly="readonly" value="" />
                </div>
                </div>-->
                 <div class="control-group" id="result_table">
                 
                 </div>
        </fieldset>
       </div>  
       <!--------------------------------------------------------Result Format---------------------------------------------------------->  
     <div id="resultFormat" >
             	
                 <div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> <?php echo form_open_multipart('admin/csvfile_format_save', array('class' => 'form-horizontal', 'id' => 'addNewsFrm')); ?>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Add Document</h3>
                  </div>
                  <div class="modal-body">
                   
                          <div style="width:500px;  float:left;">
                             <?php echo $this->session->flashdata('insert_message');?> 
                             
                             <div class="control-group" >
                              <label class="control-label" for="inputSuccess">Id</label>
                              <div class="controls" >
                                <input type="text" id="id"  name="id" readonly="readonly" value=""  >
                               </div>
                            </div>          
                            
                            <div class="control-group" >
                              <label class="control-label" for="inputSuccess">Title</label>
                              <div class="controls" id="add_title_control">
                                <input type="text" id="add_title"  name="add_title" readonly="readonly" value=""  onblur="title_onblur()">
                                <span class="help-inline" id="add_title_message" style="display:none;"></span> </div>
                            </div>
                            
                            <div class="control-group" >
                              <label class="control-label" for="inputSuccess">Description</label>
                              <div class="controls" id="add_description_control">
                                
                                <textarea id="add_description" name="add_description"  cols="" rows="" onblur="description_onblur()"></textarea>
                                <span class="help-inline" id="add_description_message" style="display:none;"></span> </div>
                            </div>
                            
                            <div class="control-group" >
                              <label class="control-label" for="inputSuccess">File</label>
                              <div class="controls">
                                <input type="file" id="filename" name="filename" />
                                <a id="download_file" href="">Download</a>
                                <span class="help-inline" id="filename_message" style="display:none;"></span> </div>
                            </div>
                            </div>
                    </div>
                      <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                      </div>
                      </form>
                </div>
          
       </div>     
       
      </div>
    </div>
    <!--/span--> 
    
  </div>
</div>
<script src="<?php echo base_url();?>custom_script/result_validation.js"></script> 
<script type="text/javascript">

function validate_form()
{
	if(confirm("If there is any record of the student that has been uploaded before that will be removed parmanently.Please check the sheet carefully and go ahead! ")){
		if(!validate_class()){
				$("#classname").focus();
				return false;
		}
		
		if(!validate_section()){
				$("#section").focus();
				return false;
		}
		
		if(!validate_pass_year()){
				$("#pass_year").focus();
				return false;
		}
			
		if(!validate_total_marks()){
				$("#total_marks").focus();
				return false;
		}
		
		if(!validate_result_csv()){
				$("#result_csv").focus();
				return false;
		}
		return true;
	}else{
		return false;
	}

}


function show_result(){

var reg_no=$("#registration_no").val();
var class_id=$("#show_classname").val();

var base_url='<?php echo base_url();?>'; 
		//var dataString = 'reg_no='+ reg_no ;
		$.ajax({
				  type: "GET",
				  dataType:'json',  
				  url:base_url+"index.php/admin/show_result?reg_no="+reg_no+"&classid="+class_id,  
				  //data: dataString,
				  async: false,  
				  success: function(data) { 				 
					var result = data.result;
					var resultSubwise=data.resultSubwise;
					var studInfo=data.studInfo[0];
					
					 console.log(data);
					 var total=resultSubwise.length;
					 var value=3;
					 var colspan=total-value;
					 var htmlstr="<span><strong>Name:</strong>&nbsp;</span><span >"+studInfo.first_name+" "+studInfo.middle_name+" "+studInfo.last_name+" </span><br>";
					htmlstr+="<span><strong>Registration No:</strong>&nbsp;</span><span>"+studInfo.registration_no+"  </span>";
					
					 htmlstr+="<table class='table table-striped table-bordered bootstrap-datatable datatable'><thead><tr>";
						for (var j = 0; j < resultSubwise.length; j++) {
    					htmlstr += "<td><span style='font-weight:bolder'>"+resultSubwise[j].subjects+"</span>	</td>";				
						}
						htmlstr+="</tr></thead><tbody><tr>";
					
					for (var i = 0; i < resultSubwise.length; i++) {
    					htmlstr += "<td>"+resultSubwise[i].marks+"</td>";
					
					}
				htmlstr += "</tr></tbody><tfoot><tr>";
				htmlstr += "<td><span style='font-weight:bolder'>Marks</span></td><td>"+result[0].marks+"</td>";
				htmlstr += "<td><span style='font-weight:bolder'>Total Marks</span></td><td colspan='"+colspan+"'>"+result[0].total_marks+"</td>";
				htmlstr +="</tr></tfoot></table>";
				 $('#result_table').html(htmlstr);
				 
				 /*$("#st_marks").val(result[0].marks);
					$("#exm_tot_marks").val(result[0].total_marks);*/
				  }
		});	
}

function resetform()
{
	$("#registration_no").val(null);
	/*$("#st_marks").val(null);
	$("#exm_tot_marks").val(null);*/
	
}

function changeshowResult()
{
	$("#addResultAsCSV").hide();
	$("#showResultdiv").show();
	
}

function changerdaddResultAsCSV(){
		
	$("#addResultAsCSV").show();
	$("#showResultdiv").hide();
}


function Add_edit_Format()
{
	//alert("id");
	var id=1;  //'id' of Result_Format is 1 in 'csv_file_format' table.
	
	var base_url='<?php echo base_url();?>'; 
	var dataString = 'id='+ id ;
	$.ajax({
			  type: "GET",
			  dataType:'json',  
			  url:base_url+"index.php/admin/get_csvfile_format",  
			  data: dataString,
			  async: false,  
			  success: function(data) { 
				 console.log(data);
				 var result_format=data.result_format[0];
					$("#id").val(result_format.csvfile_id);
					$("#add_title").val(result_format.title);
					$("#add_description").val(result_format.description);
					if(result_format.file_name!=null){
					$("#download_file").attr("href", base_url+"uploads/document/"+result_format.file_name);
					}
					else{
					$("#download_file").attr("href", "#");
					}
					
			}  
	});
	$('#myAddModal').modal('show');
	return false;
		
}


</script>










