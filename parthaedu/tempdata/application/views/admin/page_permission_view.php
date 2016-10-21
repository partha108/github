<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Unit List</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-th-list"></i> USER PRIVILEGES (<?php echo count($admin_page_list ); ?>) </h2>
            </div>
            <div class="box-content">
                <style>
                    #screenshot{position:absolute; background:#333; padding:2px; display:none; color:#fff;}
                </style>
                <script type="text/javascript" src="<?php echo base_url();?>img_hover/imagetooltip.js"></script>
                <?php if($this->session->flashdata('message')) { ?>
                    <table class="table table-striped table-bordered bootstrap-datatable ">
                        <tr>
                            <td width="100%" colspan="2" style=" text-align:center"><span style="color:#F00"><?php echo $this->session->flashdata('message'); ?></span></td>
                        </tr>
                    </table>
                <?php } ?>
                <table class="table table-striped table-bordered bootstrap-datatable ">
                    <tr>
                        <td width="50%" colspan="2" style=" text-align:left"><!--<a class="btn btn-primary" href="<?php echo base_url();?>index.php/unit" ><i class="icon-edit icon-white"></i> Add UNIT </a>--></td>
                        <td align="right" style="padding-left:315px;" ><a class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_page(<?php echo $sub_admin_user_id; ?>)" ><i class="icon-edit icon-white"></i> Allow </a> <a class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_unit(<?php echo $sub_admin_user_id; ?>)" ><i class="icon-edit icon-white"></i> Dis-Allow </a></td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered bootstrap-datatable datatable ">
                    <thead>
                    <tr>
                        <td ><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /></td>
                        <th width="">Status</th>
                        <th>Page Title</th>
                        <!-- <th>Date</th>
                         <th>Edited Date</th>-->
                        <!-- <th>Status</th>-->
                        <!-- <th>Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    if(count($admin_page_list )>0)
                    {
                        //echo 'test'; exit();
                        foreach($admin_page_list  as $row)
                        {
                            $i++;

                            $emptyString='NA';

                            ?>
                            <tr>
                                <!-- <td><?php echo $i;?></td>-->

                                <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $row->parent_page_id;?>"  class="chtest_test" onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $row->parent_page_id;?>"/></td>
                                <td  style="width:1px;"><span class="select" id="select_<?php echo $row->parent_page_id;?>">
                <?php if($row->is_view=='Y'){?>
                    <span style="display:none">active</span><img src="<?php echo base_url();?>img/active.png" width="26" alt="active" >
                <?php } else if($row->is_view=='N') {?>
                    <span style="display:none">In-active</span><img src="<?php echo base_url();?>img/inactive.png" width="26" alt="In-active"  >
                <?php } else {?>
                    <span style="display:none">In-active</span><img src="<?php echo base_url();?>img/inactive.png" width="26" alt="In-active"  >
                <?php } ?>
                </span></td>
                                <td><?php if(!empty($row->title)){ echo $row->title;}else{ echo $emptyString;}?></td>
                                <!--  <td><?php if(!empty($row->added_time_stamp)){ echo $createDate=date('M d,Y',$row->added_time_stamp);}else{ echo $emptyString;}?></td>
              <td><?php if(!empty($row->edited_time_stamp)){ echo $editDate=date('M d,Y',$row->edited_time_stamp);}else{ echo $emptyString;}?></td>-->
                                <!--  <td width="20%"><select style="width:90px" onchange="unitActivateInactive(<?php echo $row->parent_page_id;?>,this.value)" >
                  <option value="Y" <?php if($row->is_allow=='Y'){?>selected<?php }?>>Active</option>
                  <option value="N" <?php if($row->is_allow=='N'){?>selected<?php }?> >In-active</option>
                </select></td>-->
                                <!--<td class="center"><a class="btn btn-small btn-warning" href="<?php echo base_url();?>index.php/unit/unit_edit/<?php echo $row->parent_page_id;?>/" > <i class="icon-edit icon-white"></i> </a> <a class="btn btn-danger" href="javascript:void(0);" onclick="delete_data('<?php echo $row->parent_page_id;?>')"> <i class="icon-trash icon-white"></i> </a></td>-->
                            </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>
<!--<div class="sort_data_custom" style="margin-top: 172px; z-index: 1001; position: absolute; margin-left: 411px; width: 158px;">Show as:&nbsp;
  <select style="width:85px" id="activeInactive" onchange="filter_allow_disallow(this.value)" >
    <option value="">All</option>
    <option value="allow" <?php if($allow_dis_allow_value=='allow'){ ?> selected="selected"<?php }?>>Allow</option>
    <option value="dis-allow" <?php if($allow_dis_allow_value=='dis-allow'){ ?> selected="selected"<?php }?>>Dis-Allow</option>
  </select>
</div>-->

<!-- our main javascript file -->
<script language="javascript" type="text/javascript">

    function delete_data(id)
    {
        if(confirm('Are you sure do you want to delete it?'))
        {
            window.location = base_url+'index.php/admin_page_list_manage/unit_delete/'+id;
        }
    }


    function filter_allow_disallow(id)
    {
        window.location = base_url+'index.php/page_permission/'+id;

    }



    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/admin_page_list_manage/unit_active_inactive/',
            {
                id:id,
                value:value
            },
            function(data,status)
            {
                //alert(value)
                if(value.trim()=='Y')
                {
                    alert("Unit has been Activate successfully ");
                }
                else
                {
                    alert("Unit has been In-activate successfully ");
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




    function active_page(user_id)
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
            $.post(base_url+'index.php/page_permission/permission_allow_more_than_one_id/',
                {
                    page_id:checkboxValue,
                    user_id:user_id
                },
                function(data,status)
                {
                    $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
                    $("#parent_check_id").parent().removeClass('checked');
                    $('#parent_check_id').attr('checked', false);
                    $(".chtest_test").parent().removeClass('checked');
                    $('.chtest_test').attr('checked', false);
                    $(".select").removeClass('selectCheck');
                    alert('Page has been allowed to view.');
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }



    function in_active_unit(user_id)
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
            $.post(base_url+'index.php/page_permission/permisson_dis_allow_more_than_one_id/',
                {
                    page_id:checkboxValue,
                    user_id:user_id
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
                    alert('Page has been dis-allowed to view.');
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }

</script>
