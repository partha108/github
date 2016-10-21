<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Student List</a> </li>
        </ul>
    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Student List</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><!--<a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Student </a>-->
          <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_sub_admin()" >
                  <i class="icon-edit icon-white"></i> Active </a>
                <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_sub_admin()" >
                    <i class="icon-edit icon-white"></i> In-Active </a>
          </span>
                </div>
                <br><br>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                        <th> Sl<br> No</th>
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
                        <td><?php echo $count; ?></td>

                        <td><?php echo $sd->first_name."<br>".$sd->last_name;?></td>
                        <td><?php echo $sd->student_email."<br>".$sd->student_phone_no;?></td>
                        <td><?php echo $sd->father_name;?></td>
                        <td style="text-align:center" ><?php  if($sd->status =='active'){?>
                                <span class="label label-success">Active</span>
                            <?php }else{?>
                                <span class="label label-important">Inactive</span>
                            <?php }?>
                        </td>
                        <td><a href="#" onclick="return openedit_modelqqq('<?php echo $sd->student_id;?>')">Course </a><br>
                            <a href="#" onclick="return openedit_modelqqq('<?php echo $sd->student_id;?>')">Payment </a></td>
                        <td class="center">
                            <a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $sd->student_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
                            <a class="btn btn-info" href="#" onclick="return add_course('<?php echo $sd->student_id;?>')"> <i class="icon-edit icon-white"></i> Add Course </a>
                            <a class="btn btn-danger" href="#" onclick="deletesubject(<?php echo $sd->student_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>
<!------------------------------------------------Add ---------------------------------------------------------->

<!-- -----------------------------------------success modal------------------------------------- -->



<!-- ----------------------------------Edit---------------------------------------------------------------- - -->

<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<script language="javascript" type="text/javascript">
    var base_url='<?php echo base_url();?>';
    function add_course(id)
    {
        window.location = base_url+'index.php/studentlist/add_course_view/'+id;
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

</script>


