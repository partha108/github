<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Sub Admin</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Sub Admin List</h2>
                <span style="color: red;padding-left:40px;font-size: 15px"><?php echo $this->session->flashdata('message');  ?></span>
            </div>
            <div class="box-content">
               
                <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Sub Admin </a>

               <!-- <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_sub_admin()" >
                        <i class="icon-edit icon-white"></i> Active </a>
       <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_sub_admin()" >
           <i class="icon-edit icon-white"></i> In-Active </a></span>-->
                </div>

                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                       <!-- <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>-->
                        <th> Sl No</th>
                        <th>Sub Admin Name</th>
                        <th>Last Login Date & Time</th>
                        <th>Last Logged Ip Addres</th>



                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=0;
                    foreach($sub_admin_detail as $item):
                        $count=$count+1;
                        ?>

                        <tr>
                            <!--<td style="width:1px"><input type="checkbox" name="check_id" id="<?php /*echo $item->id;*/?>"  class="chtest_test"
                                                         onClick="single_check_box_checked(this.checked,this.id)" value="<?php /*echo $item->id;*/?>"/></td>-->
                            <td><?php echo $count;?></td>
                            <td><?php echo $item->first_name;?></td>

                            <td><?php echo date('d-m-Y g:m:i A',strtotime($item->lastlogon_datetime));?></td>
                            <td><?php echo $item->logged_ip;?></td>

                            <td style="text-align:center" ><?php  if($item->status=='active'){?>
                                    <span class="label label-success">Active</span>
                                <?php }else{?>
                                    <span class="label label-important">Banned</span>
                                <?php }?>
                            </td>

                            <td class="center"> <a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $item->id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
                                <a class="btn btn-danger" href="#" onclick="delete_sub_admin('<?php echo $item->id;?>')"> <i class="icon-trash icon-white"></i> Delete </a>

                            </td>
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
<!------------------------------------------------Add ---------------------------------------------------------->
<div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%">
    <?php echo form_open_multipart('add_sub_admin/sub_admin_record', array('class' => 'form-horizontal', 'id' => 'addClassFrm')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add Class</h3>
    </div>
    <div class="modal-body">

        <div style="width:500px;  float:left;">
            <?php echo $this->session->flashdata('insert_message');?>

            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Name</label>
                <div class="controls">
                    <input type="text" id="sub_admin_name"  name="sub_admin_name" >
                    <span class="help-inline" id="show_sub_admin_name" style="display:none;"></span> </div>
            </div>


            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">User Name</label>
                <div class="controls">
                    <input type="text" id="sub_admin_name_user_name"  name="sub_admin_name_user_name" >
                    <span class="help-inline" id="show_sub_admin_user_name" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Email</label>
                <div class="controls">
                    <input type="text" id="sub_admin_name_email"  name="sub_admin_name_email" onblur="emailvali();">
                    <span class="help-inline" id="show_sub_admin_name_email" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Password</label>
                <div class="controls">
                    <input type="text" id="sub_admin_name_password"  name="sub_admin_name_password" >
                    <span class="help-inline" id="show_sub_admin_name_password" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess"> Status</label>
                <div class="controls">
                    <select name="sub_admin_name_status" id="sub_admin_name_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span style="display:none;" id="name_message" class="help-inline"></span> </div>
            </div>

        </div>

    </div>
    <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary" onclick="addplan();emailvali();" >Add</button>
    </div>
    </form>
</div>



<!------------------------------------Edit------------------------------------------------------------------->
<div class="modal hide fade" id="myEditModal" style="width:1000px; left:40%">
    <?php echo form_open_multipart('add_sub_admin/edit_academic', array('class' => 'form-horizontal', 'id' => 'editClassFrm')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit Class</h3>
    </div>
    <div class="modal-body">

        <div style="width:500px;  float:left;">
            <?php echo $this->session->flashdata('insert_message');?>

            <input type="hidden" id="id" name="id" />

            <div class="control-group" id="edit_name_control" >
                <label class="control-label" for="inputSuccess"> Name</label>
                <div class="controls">
                    <input type="text" id="edit_sub_admin_name"  name="edit_sub_admin_name" >
                    <span class="help-inline" id="edit_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="edit_name_control" >
                <label class="control-label" for="inputSuccess"> User Name</label>
                <div class="controls">
                    <input type="text" id="edit_sub_admin_user_name"  name="edit_sub_admin_user_name" >
                    <span class="help-inline" id="edit_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="edit_name_control" >
                <label class="control-label" for="inputSuccess"> Email</label>
                <div class="controls">
                    <input type="text" id="edit_sub_admin_user_email"  name="edit_sub_admin_userl_email" >
                    <span class="help-inline" id="edit_name_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="edit_name_control" >
                <label class="control-label" for="inputSuccess"> Password</label>
                <div class="controls">
                    <input type="text" id="edit_sub_admin_password"  name="edit_sub_admin_password" >
                    <span class="help-inline" id="edit_name_message" style="display:none;"></span> </div>
            </div>

            <input type="hidden" id="status" name="status" />
            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess"> Status</label>
                <div class="controls">
                    <select name="edit_status" id="edit_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span style="display:none;" id="name_message" class="help-inline"></span> </div>
            </div>

        </div>

    </div>
    <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary"  >Save changes</button>
    </div>
    </form>
</div>


<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>

    <div class="modal-body">
        <h4>The Post has been Deleted !</h4>
        <div style=" float:right;">
            <button type="submit" class="btn btn-primary">ok</button>
        </div>
    </div>

    </form>
</div>


<script language="javascript" type="text/javascript">
    function open_add_model()
    {
        $("#myaddmodel").modal('show');
    }

    function openedit_model(id)
    {

        if(id){

            var dataString = 'id='+ id ;
            //alert(dataString)
            $.ajax({
                type: "POST",
                dataType:'json',
                url:base_url+"index.php/add_sub_admin/edit_fees",
                data: dataString,
                async: false,
                success: function(data) {
                    var edit_fees=data.edit_fees[0];
                    $("#id").val(id);
                   $("#edit_sub_admin_name").val(edit_fees.first_name);
                   $("#edit_sub_admin_user_name").val(edit_fees.username);
                   $("#edit_sub_admin_password").val(edit_fees.password);
                   $("#edit_sub_admin_user_email").val(edit_fees.email);
                     $("#edit_status").val(edit_fees.status);
                    //   $("#edit_total").val(edit_fees.total);  */
                    $('#myEditModal').modal('show');

                }

            });
        }
    }

    function delete_sub_admin(id)
    {
        alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Sub Admin?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/add_sub_admin/delete_sub_admin",
                    data:{deleteid:id},
                    success:function(msg){

                    }
                });

                $('#myOKModal').modal('show');

            }
        }
    }


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
            window.location = base_url+'index.php/academic_year_module/sub_admin_delete/'+id;
        }
    }



    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/academic_year_module/sub_admin_active_inactive/',
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
            $.post(base_url+'index.php/academic_year_module/sub_admin_active_more_than_one_id/',
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
            $.post(base_url+'index.php/academic_year_module/sub_admin_in_active_more_than_one_id/',
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



<script>
    function addplan()
    {
        var coverage=$("#sub_admin_name").val();
        //alert(coverage);


        if(coverage==''||coverage=='0')
        {
            $("#show_sub_admin_name").text('Please enter your value');
            $("#show_sub_admin_name").show();
            $("#coverage").focus();
            return false;
        }
        else{
            $("#show_sub_admin_name").text('');
            $("#show_sub_admin_name").hide();
        }


    }

</script>
<script>
    $(document).ready(function()
    {
        $("#sub_admin_name").keyup(function()
        {
            if($(this).val().length != 0)
            {
                $("#sub_admin_name").css("borderColor", "green");
            }
        });
    })
    $(document).ready(function()
    {
        $("#sub_admin_name_user_name").keyup(function()
        {
            if($(this).val().length != 10)
            {
                $("#sub_admin_name_user_name").css("borderColor", "red");
            }
        });
    })


    $(document).ready(function()
    {
        $("#sub_admin_name_status").change(function()
        {
            if($(this).val() != 0)
            {
                $("#sub_admin_name_status").css("borderColor", "green");
            }
        });
    })

    $(document).ready(function()
    {
        $("#sub_admin_name_password").keyup(function()
        {
            if($(this).val().length != 0)
            {
                $("#sub_admin_name_password").css("borderColor", "green");
            }
        });
    })
    $(document).ready(function()
    {
        $("#sub_admin_name_email").keyup(function()
        {
            if($(this).val() != 0)
            {
                $("#sub_admin_name_email").css("borderColor", "green");
            }
        });
    })
    $(document).ready(function()
    {
        $("#qualification").keyup(function()
        {
            if($(this).val().length != 0)
            {
                $("#qualification").css("borderColor", "green");
            }
        });
    })

</script>

<script language="Javascript" type="text/javascript">
    function emailvali()
    {
        var em=document.getElementById('sub_admin_name_email')
        var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (filter.test(em.value))
        {
            $("#sub_admin_name_email").css("borderColor", "green");
            email.focus;
            return false;
        }
        else
            $("#sub_admin_name_email").css("borderColor", "red");
        email.focus;
        return false;
    }


</script>