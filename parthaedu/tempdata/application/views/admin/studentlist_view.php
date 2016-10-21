<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
        <?php if($this->uri->segment(2) =="search_result"){?>
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Search Result</a> </li>
        <?php }else{ ?>
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Student List</a> </li>
        <?php } ?>
    </ul>
  </div>
   

  <div class="row-fluid sortable">
      <div class="box span12">
          <div class="box-header well" data-original-title>
              <?php if($this->uri->segment(2) =="search_result"){?>
                  <h2><i class="icon-user"></i> Student Search List</h2>
                  <h2>Send SMS</h2>
              <?php }else{ ?>
              <h2><i class="icon-user"></i> Student List</h2>
              <?php } ?>

               <a href="javascript:void(0)" onclick="download_student_id()"><h2 class="down">Download with selected</h2></a>
              <a href="<?php echo base_url()?>index.php/download_excel/excel"><h2 class="down">Download Excel</h2></a>
          </div>
          <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
              <table width="100%">
                  <tr>
                      <td>
                          <form method="post" action="<?php echo base_url('index.php/studentlist/send_sms_to_student');?>">
                              <input type="hidden" name="chk[]" id="field_results" value="">
                              <input type="submit" value="Send Sms" class="btn btn-primary"></form>
                      </td>

                      <td style="padding-left: 16%;">
                          <form method="post" action="<?php echo base_url('studentlist/search_result');?>">
                              <input type="search" name="search" id="search_name" value="<?php echo $str_val;?>"><input type="submit" value="Search" >
                          </form>
                      </td>

                      <td style="padding-right: 0%;">
                          <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="dropout_student()" >
                              <i class="icon-edit icon-white"></i>Dropout </a>
                          <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="passout_student()" >
                              <i class="icon-edit icon-white"></i>Passout </a>
                          <a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)"  onclick="studying_student()" >
                              <i class="icon-edit icon-white"></i>Studying </a>
                      </td>
                  </tr>
              </table>




              <table class="tblborder" style="width: 14%;">
                  <tr>
                      <td>

                          <select style="width:50%" id="per_page"  onchange="pagination_select(this.value,this.id)">
                              <option value="">Select</option>
                              <option value="10" <?php if($per_page==10)  { echo 'selected';} ?>>10</option>
                              <option value="50" <?php if($per_page==50)  { echo 'selected';} ?>>50</option>
                              <option value="100" <?php if($per_page==100) { echo 'selected';} ?>>100</option>
                              <option value="500" <?php if($per_page==500) { echo 'selected';} ?>>500</option>
                              <option value="1000" <?php if($per_page==1000){ echo 'selected';} ?>>1000</option>

                          </select>
                      </td>
                     <!-- <td width="30%">
                          <form method="post" action="<?php /*echo base_url('studentlist/search_result');*/?>">
                          <input type="search" name="search" id="search_name" value="<?php /*echo $str_val;*/?>"><input type="submit" value="Search" >
                          </form>
                      </td>


               <td width="50%"><a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="dropout_student()" >
                   <i class="icon-edit icon-white"></i>Dropout </a>
              <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="passout_student()" >
                  <i class="icon-edit icon-white"></i>Passout </a>
              <a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)"  onclick="studying_student()" >
                  <i class="icon-edit icon-white"></i>Studying </a></td>-->
         </tr>
              </table>
          </div>

      <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                <th> Sl<br> No</th>
                <th>Student Id</th>
                <th>Student Password</th>
                <th>Reg No</th>
                <th>Roll No</th>
                <th>Student<br>Name </th>
                <th>Student<br>Email/<br>Phone No </th>
                <th>Father<br>Name </th>
                <th>Status</th>
                <th>Manage</th>
                <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr>
                <?php
                    $count = 0;
                    foreach($student_detail as $sd)
                    {
                    $count = $count+1;
                ?>
                <td style="width:1px">
                      <input type="checkbox" name="check_id" id="<?php echo $sd->student_id;?>"
                             class="chtest_test" onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $sd->student_id;?>"/>
                </td>
                <td><?php echo (($per_page*($page-1))+$count); ?></td>
                <td><?php echo $sd->username;?></td>
                <td><?php echo $sd->password;?></td>
                <td><?php echo $sd->reg_no;?></td>
                <td><?php echo $sd->roll_no;?></td>

                <td><?php echo $sd->first_name."<br>".$sd->last_name;?></td>
                <td><?php echo $sd->student_email."<br>".$sd->student_phone_no;?></td>
                <td><?php echo $sd->father_name;?></td>
                <td style="text-align:center" ><?php  if($sd->studying =='studying'){?>
                        <span class="label label-success">Studying</span>
                        <?php }else if($sd->studying =='passout'){?>
                        <span class="label label-important">passout</span>
                        <?php }else if($sd->studying =='inactive'){?>
                        <span class="label label-important">In Active</span>
						<?php }else {?>
                        <span class="label label-important">Dropout</span>
                        <?php }?>
                </td>
                <td><a href="#" onclick="return open_course_view('<?php echo $sd->student_id;?>')">Course Details</a><br>
                    <a href="#" onclick="return open_payment_view('<?php echo $sd->student_id;?>')">Payment Details </a></td>
                <td class="center">
                    <a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $sd->student_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
                    <a class="btn btn-info" href="#" onclick="return add_course('<?php echo $sd->student_id;?>')"> <i class="icon-edit icon-white"></i> Add Course </a>
                    <a class="btn btn-danger" href="#" onclick="delete_academic(<?php echo $sd->student_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
                </td>
            </tr>
                <?php
                    }
                ?>

          </tbody>


      </table>
              <table>
                  <tr> <td colspan="8"><div id="pagination_container"> <?php echo @$msg; ?> </div></td></tr>
              </table>
        
      </div>
    </div>
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
  <!-- content ends --> 
</div>
<!------------------------------------------------Add ---------------------------------------------------------->
<!------------------------------------------------Add ---------------------------------------------------------->
<div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%">
    <?php echo form_open_multipart('academic_year_module/add_academic', array('class' => 'form-horizontal', 'id' => 'addClassFrm')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add Class</h3>
    </div>
    <div class="modal-body">

        <div style="width:500px;  float:left;">
            <?php echo $this->session->flashdata('insert_message');?>

            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess"> Academic Year</label>
                <div class="controls">
                    <input type="text" id="add_academin_year"  name="add_academin_year" >
                    <span class="help-inline" id="name_message" style="display:none;"></span> </div>
            </div>

            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">service tax</label>
                <div class="controls">
                    <input type="text" id="add_service_tax"  name="add_service_tax" ><span>%</span>
                    <span class="help-inline" id="name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess"> Status</label>
                <div class="controls">
                    <select name="add_status" id="add_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span style="display:none;" id="name_message" class="help-inline"></span> </div>
            </div>

        </div>

    </div>
    <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary"  >Add</button>
    </div>
    </form>
</div>
<!-- -----------------------------------------success modal------------------------------------- -->



<!-- ----------------------------------Edit---------------------------------------------------------------- - -->

<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<script language="javascript" type="text/javascript">
    function open_add_model()
    {

        $("#myaddmodel").modal('show');
    }
    var base_url='<?php echo base_url();?>';
    function search_fun() {
        window.location = base_url+'index.php/studentlist/search_result/'
    }
    function add_course(id)
    {
        window.location = base_url+'index.php/studentlist/add_course_view/'+id;
    }

    function openedit_model(id)
    {
        window.location = base_url+'index.php/studentlist/add_student_edit_view/'+id;
    }

    function open_course_view(id)
    {

        window.location = base_url+'index.php/studentlist/add_student_to_course_view/'+id;
    }
	
	function open_payment_view(id)
	{
		window.location = base_url+'index.php/studentlist/add_student_to_payment_view/'+id;
	}

</script>

<script language="javascript" type="text/javascript">


    function filterInactiveActive(id)
    {

        window.location = base_url+'index.php/studentlist/'+id;

    }
    function delete_data(id)
    {
        if(confirm('Are you sure do you want to delete it?'))
        {
            window.location = base_url+'index.php/studentlist/sub_admin_delete/'+id;
        }
    }

    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/studentlist/sub_admin_active_inactive/',
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

    function studying_student()
    {

        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        id= "abc";
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            //alert(checkboxValue);


            // window.location = base_url+'index.php/studentlist/excel_download/?'+'='+checkboxValue;
            window.location = base_url+'index.php/studentlist/studying_student/?'+id+'='+checkboxValue;


        }
        else
        {
            alert('Please Select at least one check box.');
        }
        
    }

    function passout_student()
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
            $.post(base_url+'index.php/studentlist/passout_student/',
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
                    alert('Student status change to passout.');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }

    function dropout_student()
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
            $.post(base_url+'index.php/studentlist/dropout_student/',
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
                    alert('Student status change to dropout');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }

    function delete_academic(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Student?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/studentlist/delete_academic",
                    data:{deleteid:id},
                    success:function(msg){


                    }
                });

                //location.reload();

            }
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

                window.location = base_url+'index.php/studentlist?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/studentlist?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/studentlist?'+id+'='+value;
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

<script>
    function download_student_id()
    {
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        id= "abc";
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            //alert(checkboxValue);


               // window.location = base_url+'index.php/studentlist/excel_download/?'+'='+checkboxValue;
            window.location = base_url+'index.php/studentlist/excel_download/?'+id+'='+checkboxValue;


        }
        else
        {
            alert('Please Select at least one check box.');
        }


        //$.post(base_url+'index.php/studentlist/excel_download/');

    }
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php $tags= json_encode($where);?>
<script>
    $(function() {

        var  availableTags= <?php echo $tags; ?>;
        $("#search_name").autocomplete({

            source: availableTags,
            autoFocus:true
        });
    });

</script>

<script>

    $(document).ready(function(){
        $checks = $(":checkbox");
        $checks.on('click', function() {
            var string = $checks.filter(":checked").map(function(i,v){
                return this.value;
            }).get().join(",");
            $('#field_results').val(string);
        });
    });


    function send_sms()
    {
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        id= "abc";
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
       // alert(checkboxValue)
        if(checkboxValue!='')
        {
            
            //window.location = base_url+'studentlist/send_sms_to_student/?'+id+'='+checkboxValue;
            //window.location = base_url+'studentlist/send_sms_to_student/?'+id+'='+checkboxValue;
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }
</script>

