<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Course List</a> </li>
        </ul>

    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Course List</h2>
                <h2 style="padding-left:85%;"><a href="#" onclick="javascript: window.history.back()">Back</a></h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div>
                    <?php

                    foreach($stu_details as $sd) {
                        $st_id = $sd->student_id;
                    }
                    ?>
                    <!--<a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Student </a>-->
                    <a class="btn btn-info" href="#" onclick="return add_course('<?php echo $st_id; ?>')"> <i class="icon-edit icon-white"></i> Add Course </a>
                </div>
                <br><br>
                <input type="hidden" name="student_id" value="<?php echo $this->uri->segment(3);?>">

<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
<thead>
    <tr>
        <th>Sl<br>No</th>
        <th>Student Name</th>
        <th>Course</th>
        <th>Class</th>

        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $count = 0;
        foreach($details as $cd)
        {
            $count = $count + 1;
            foreach($stu_details as $sd){
                $course_id = $cd->course_name;
                $data['ccd'] =$this->common_model->add_course_data('tbl_course','course_id',$course_id);
                //print_r($data['ccd']);
              //  echo
    ?>
    <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo @$sd->first_name." ".$sd->last_name; ?></td>
        <td><?php echo @$data['ccd'][0]->course_name; ?></td>
        <td><?php echo @$cd->class_name; ?></td>

        <td class="center">
            <a class="btn btn-info" href="#" onclick="return view_course('<?php echo $cd->add_course_id;; ?>')"> <i class="icon-edit icon-white"></i> View </a>
            <a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $cd->add_course_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
            <a class="btn btn-danger" href="#" onclick="delete_academic(<?php echo $cd->add_course_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
        </td>
    </tr>




<?php

}} ?>
</tbody>
</table>

            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>
</div>
<script language="javascript" type="text/javascript">
    var base_url='<?php echo base_url();?>';
    function  view_course(id) {
        //alert(id);
        window.location = base_url+'index.php/studentlist/view_course_details/'+id;
        
    }
    function add_course(id)
    {
        window.location = base_url+'index.php/studentlist/add_course_view/'+id;
    }

    function open_course_view(id)
    {

        window.location = base_url+'index.php/studentlist/add_student_to_course_view'+id;
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
            $.post(base_url+'index.php/studentlist/sub_admin_active_more_than_one_id/',
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
            $.post(base_url+'index.php/studentlist/sub_admin_in_active_more_than_one_id/',
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
    function openedit_model(id)
    {
        //alert(id)

        window.location = base_url+'index.php/studentlist/edit_student_course_view/'+id;
    }

    function delete_academic(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Course?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/studentlist/delete_student_course",
                    data:{deleteid:id},
                    success:function(msg){
                        alert('Successfully Deleted');
                        location.reload();

                    }
                });



            }
        }
    }

</script>


