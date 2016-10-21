<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Class</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Class</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <div>
           <table class="tblborder">
               <tr>
                   <td width="50%" colspan="2" style=" text-align:left">

                       <select style="width:50%" id="per_page"  onchange="pagination_select(this.value,this.id)">
                           <option value="">Select</option>
                           <option value="10" <?php if($per_page==10)  { echo 'selected';} ?>>10</option>
                           <option value="50" <?php if($per_page==50)  { echo 'selected';} ?>>50</option>
                           <option value="100" <?php if($per_page==100) { echo 'selected';} ?>>100</option>
                           <option value="500" <?php if($per_page==500) { echo 'selected';} ?>>500</option>
                           <option value="1000" <?php if($per_page==1000){ echo 'selected';} ?>>1000</option>

                       </select></td>
               </tr>
           </table>
           <a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Class</a>

       <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_sub_admin()" >
       <i class="icon-edit icon-white"></i> Active </a>
       <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_sub_admin()" >
       <i class="icon-edit icon-white"></i> In-Active </a></span>
              </div>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
            <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
              <th> Sl No</th>
              <th>Academic Year</th>
              <th>Class Name</th>
              <th>Exam Fee</th>
              <th>Status</th>
             <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <tr>
           <?php
           $count = 0;
           foreach($class as $class_details)
           {
              $count = $count+1;
          ?>
           <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $class_details->class_id;?>"  class="chtest_test" 
           onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $class_details->class_id;?>"/></td>
          <td><?php echo $count; ?></td>
          <td><?php echo $class_details->class_academic_year;?></td>
          
          <td><?php echo $class_details->class_name;?></td>
          <td><?php echo $class_details->exam_fee;?></td>
          
          <td style="text-align:center" ><?php  if($class_details->class_status =='active'){?>
                    <span class="label label-success">Active</span>
                    <?php }else{?>
                    <span class="label label-important">Inactive</span>
                    <?php }?>
                </td>
          <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $class_details->class_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-danger" href="#" onclick="delete_class(<?php echo $class_details->class_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
               </td>

          
           
          </tr>
          <?php
           }
              ?>

          <tr>  <td colspan="8"><div id="pagination_container"> <?php echo @$msg; ?> </div></td></tr>

        </table>
        
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>
<!------------------------------------------------Add ---------------------------------------------------------->
<div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%"> <?php echo form_open_multipart('class_module/add_class', array('class' => 'form-horizontal', 'id' => 'addSubjectFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Batch</h3>              
  </div>
  <div class="modal-body">
    <div style="width:500px;  float:left;">
      <?php echo $this->session->flashdata('insert_message');?> 
        <div class="control-group" id="name_control" >
          <label class="control-label" for="inputSuccess">Academic Year</label>
          <div class="controls">
            <select name="add_academic_year" id="add_academic_year">
                <option value="0">---select Year---</option>
              <?php
              foreach ($academic_year as $acy) {
              ?>
              <option value="<?php echo $acy->academic_year;?>"><?php echo $acy->academic_year;?></option>
              <?php
                }
              ?>
            </select>              
            <span class="help-inline" id="name_message" style="display:none;"></span> 
          </div>
        </div>
        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Class Name</label>
              <div class="controls">
                <input type="text" name="add_class" id="add_class">             
                <span class="help-inline" id="name_message" style="display:none;"></span>
              </div>
        </div>
        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Exam Fee </label>
              <div class="controls">
                <input type="text" autocomplete="off" name="add_exam_fee" id="add_exam_fee" onkeyup="show_total_amount();">
                <span class="help-inline" id="name_message" style="display:none;"></span>
              </div>
        </div>
        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Service Tax </label>
            <div class="controls">
                <input type="text" readonly name="add_vat" id="add_vat">
                <input type="hidden" readonly name="add_vat_amt" id="add_vat_amt">
                <span class="help-inline" id="name_message" style="display:none;"></span>
            </div>
        </div>
        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Total Exam Fees </label>
            <div class="controls">
                <input type="text" readonly name="add_tot_amt" id="add_tot_amt">
                <span class="help-inline" id="name_message" style="display:none;"></span>
            </div>
        </div>

        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Status</label>
              <div class="controls">
                <select id="add_status" name="add_status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>              
                <span class="help-inline" id="name_message" style="display:none;"></span>
              </div>
        </div>
  </div>            
</div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form()"  >Add</button>
  </div>
  </form>
</div>
<!-- -----------------------------------------success modal------------------------------------- -->

<div class="modal hide fade" id="myOKModal" style="width: 284px; margin-block-start: 1%;margin-left: -85px;;margin-top:-72px ; display: block;"> <?php echo form_open_multipart(); ?>
  
  <div class="modal-body">
   <h4>The Post has been Deleted !</h4>
          <div style=" float:center;">             
           <button type="submit" class="btn btn-primary">ok</button>          
           </div>            
  </div>
  
  </form>
</div>

<!-- ----------------------------------Edit---------------------------------------------------------------- - -->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%">
    <?php echo form_open_multipart('class_module/edit_class', array('class' => 'form-horizontal', 'id' => 'editSubjectFrm')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit Subject</h3>
    </div>
    <div class="modal-body">
        <div style="width:500px;  float:left;">
            <?php echo $this->session->flashdata('insert_message');?>
            <input type="hidden" id="id"  name="id" readonly="readonly" >
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Academic Year</label>
                <div class="controls">
                    <select name="edit_academic_year" id="edit_academic_year">
                        <option value="0">---select Year---</option>
                        <?php
                        foreach ($academic_year as $acy) {
                            ?>
                            <option value="<?php echo $acy->academic_year;?>"><?php echo $acy->academic_year;?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess"> Class Name</label>
                <div class="controls">
                    <input type="text" id="edit_class_name"  name="edit_class_name" >
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Exam Fee</label>
                <div class="controls">
                    <input type="text" id="edit_exam_fee"  name="edit_exam_fee" onkeyup="edit_show_total_amount();" >
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Service Tax </label>
                <div class="controls">
                    <input type="text" readonly name="edit_vat" id="edit_vat">
                    <input type="hidden" readonly name="edit_vat_amt" id="edit_vat_amt">
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Total Exam Fees </label>
                <div class="controls">
                    <input type="text" readonly name="edit_tot_amt" id="edit_tot_amt">
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>

            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Status</label>
                <div class="controls">
                    <select id="edit_class_status" name="edit_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>

        </div>
        </div>
        <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary" onclick="return validate_edit_form()" >Save changes</button>
        </div>
        </form>

</div>
<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>

<script language="javascript" type="text/javascript">
function show_course(id)
	{
		//alert(id);
		$("#db_course").load('<?php echo base_url();?>index.php/batch_module/course/'+id);
	}
function edit_show_course(id)
	{
		//alert(id);
		$("#edit_db_course").load('<?php echo base_url();?>index.php/batch_module/edit_course_model/'+id);
	}
	

var base_url='<?php echo base_url();?>';
function open_add_model()
{
  $("#myaddmodel").modal('show'); 
}

function open_addBook_model(id)
{
  //alert(id);
  if(id)
  {
    var dataString='id='+id;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url:base_url+"index.php/admin/get_subject_book",  
        data: dataString,
        async: false,  
        success: function(data) {
            var booklist = data.BookList;
            var selected_book_list = data.selected_book_list;
            console.log(data);
            var html_string="";
            var i=0;
            var j=0;
            for(i=0;i<booklist.length;i++)
            {
              html_string+="<input   type='checkbox' name='books[]' id='check"+booklist[i].book_id+"'  value='"+booklist[i].book_id+"'/>&nbsp;<span>"+booklist[i].book_name+"</span><br />";

            }
            
            $('#book_html').html(html_string);
            for(j=0;j<selected_book_list.length;j++){ 
                        
              $("#check"+selected_book_list[j].book_id).attr('checked','checked');
            }
        }
    })
  }
  $("#subid").val(id);
  $("#myaddBookmodel").modal('show'); 
}

function openedit_model(id)
{//alert(id)

  if(id){
     
    var dataString = 'id='+ id ;
    //alert(dataString)
    $.ajax({
          type: "POST",
          dataType:'json',  
          url:base_url+"index.php/class_module/edit_fees", 
          data: dataString,
          async: false,  
         success: function(data) {             
           var edit_fees=data.edit_fees[0];   
            $("#id").val(id);
            $("#edit_academic_year").val(edit_fees.class_academic_year);
           $("#edit_vat").val(edit_fees.vat);
             $("#edit_vat_amt").val(edit_fees.vat_amt);
             $("#edit_tot_amt").val(edit_fees.tot_amt);
            $("#edit_class_name").val(edit_fees.class_name);
           $("#edit_class_status").val(edit_fees.class_status);
            $("#edit_exam_fee").val(edit_fees.exam_fee);
             /*$("#edit_electric_charge").val(edit_fees.electric_charge);
            $("#edit_total").val(edit_fees.total);  */                
            $('#myEditModal').modal('show');
        }
    });
  }
}


function deleteitem(id)
{
  var base_url='<?php echo base_url();?>'; 
  var id=id;
  var tablename='tblsubject';
  var column='id';
  var page='admin/subjects';
  if(confirm('Are you sure do you want to Delete it?')){
      window.location = base_url+'index.php/admin/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
    }
  
}


$("#add_academic_year").on("change", function(e) {
    var course_id = this.value;
    //alert(course_id);


    $.ajax({
        url: "<?php echo base_url();?>index.php/class_module/add_reg_total_amt",
        type: "POST",
        dataType:'text',
        data: {course_id:course_id},
        success: function (data) {
            //alert(data)
            obj = JSON.parse(data);

            $('#add_vat').val(obj.amount);
        }
    });
});

$("#edit_academic_year").on("change", function(e) {
    var course_id = this.value;
    //alert(course_id);


    $.ajax({
        url: "<?php echo base_url();?>index.php/class_module/add_reg_total_amt",
        type: "POST",
        dataType:'text',
        data: {course_id:course_id},
        success: function (data) {
            //alert(data)
            obj = JSON.parse(data);

            $('#edit_vat').val(obj.amount);
        }
    });
});


</script>
<script language="javascript" type="text/javascript">


    function filterInactiveActive(id)
    {

        window.location = base_url+'index.php/class_module/'+id;

    }
    function delete_data(id)
    {
        if(confirm('Are you sure do you want to delete it?'))
        {
            window.location = base_url+'index.php/class_module/sub_admin_delete/'+id;
        }
    }



    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/class_module/sub_admin_active_inactive/',
            {
                id:id,
                value:value
            },
            function(data,status)
            {
                //alert(value)
                if(value.trim()=='Y')
                {
                    alert("Sub-admin has been Activate successfully ");
                }
                else
                {
                    alert("Sub-admin has been In-activate successfully ");
                }
            });
    }
</script>

<script>

    function single_check_box_checked(isChecked,id)
    {

        if(isChecked==true)
        {
            $("#select_"+id).addClass('selectCheck');
            $("#"+id).parent().addClass('checked');
            $("#"+id).attr('checked',true);

        }
        else if(isChecked==false)
        {
            $("#select_"+id).removeClass('selectCheck');
            $("#"+id).parent().removeClass('checked');
            $("#"+id).attr('checked', false);
        }

    }


    function parent_check_checked(isChecked,id)
    {
        //alert(isChecked)
        if(isChecked==true)
        {
            $("#"+id).attr('checked',true);
            $(".select").addClass('selectCheck');
            $(".chtest_test").parent().addClass('checked');
            $('.chtest_test').attr('checked','checked');

        }
        else if(isChecked==false)
        {
            $("#"+id).attr('checked',false);
            $(".select").removeClass('selectCheck');
            $(".chtest_test").parent().removeClass('checked');
            $('.chtest_test').attr('checked', false);
        }
    }




    function active_sub_admin()
    {
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            $.post(base_url+'index.php/class_module/sub_admin_active_more_than_one_id/',
                {
                    sub_admin_id:checkboxValue
                },
                function(data,status)
                {
                    $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
                    $("#parent_check_id").parent().removeClass('checked');
                    $('#parent_check_id').attr('checked', false);
                    $(".chtest_test").parent().removeClass('checked');
                    $('.chtest_test').attr('checked', false);
                    $(".select").removeClass('selectCheck');
                    alert('Unit has been Activated successfully.');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }



    function in_active_sub_admin()
    {	//alert("hi");
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            //alert(checkboxValue);
            $.post(base_url+'index.php/class_module/sub_admin_in_active_more_than_one_id/',
                {
                    sub_admin_id:checkboxValue
                },
                function(data,status)
                {
                    $(".selectCheck").html('<img src="'+base_url+'img/inactive.png" width="26" >');
                    $("#parent_check_id").parent().removeClass('checked');
                    $('#parent_check_id').attr('checked', false);
                    $(".chtest_test").parent().removeClass('checked');
                    $('.chtest_test').attr('checked', false);
                    $(".select").removeClass('selectCheck');

                    var split=checkboxId.split(',');
                    var length=split.length;
                    var i=0;
                    for(i=0;i<length;i++)
                    {
                        //var status_id=split[i];

                        //$('#status_'+split[i]).html('tgreye');
                        //alert(status_id);
                    }
                    alert('Unit has been Successfully Inactivated.');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }

    function delete_class(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Academic Year?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/class_module/delete_class",
                    data:{deleteid:id},
                    success:function(msg){


                    }
                });

                $('#myOKModal').modal('show');

            }
        }
    }

</script>
<script>
    function show_total_amount()
    {
        var a = document.getElementById('add_exam_fee').value;

        var b = document.getElementById('add_vat').value;
        var c = (parseFloat(a) *parseFloat(b))/100;
        if(a== "")
        {
            $('#total_ammount_').val('0');

        }
        else if(b== "")
        {
            $('#total_ammount_').val(a);
        }
        else if(a== "" && b== "")
        {
            $('#total_ammount_').val('');
        }
        else {
            var d = parseFloat(a)+parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#add_tot_amt').val(Math.round(d));
            $('#add_vat_amt').val(Math.round(c));
        }

    }
    function edit_show_total_amount()
    {
        var a = document.getElementById('edit_exam_fee').value;

        var b = document.getElementById('edit_vat').value;
        var c = (parseFloat(a) *parseFloat(b))/100;
        if(a== "")
        {
            $('#total_ammount_').val('0');

        }
        else if(b== "")
        {
            $('#total_ammount_').val(a);
        }
        else if(a== "" && b== "")
        {
            $('#total_ammount_').val('');
        }
        else {
            var d = parseFloat(a)+parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#edit_tot_amt').val(Math.round(d));
            $('#edit_vat_amt').val(Math.round(c));
        }

    }
</script>
<script language="javascript" type="text/javascript">

    function pagination_select(value,id)
    {

        var str='<?php echo @$page_str ;?>';
        if(value.trim())
        {
            if(value.trim())
            {

                window.location = base_url+'index.php/class_module?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/class_module?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/class_module?'+id+'='+value;
        }

    }


    function page_func(id)
    {
        //alert('0o');
        loadData(id);
    }

    $('#go_btn').live('click',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadData(page);
        }
        else
        {
            //alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }

    });
</script>
