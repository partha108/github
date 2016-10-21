<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Payment Head</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Payment Head</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Payment Head </a>

       <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_sub_admin()" >
               <i class="icon-edit icon-white"></i> Active </a>
       <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_sub_admin()" >
           <i class="icon-edit icon-white"></i> In-Active </a></span>
                </div>
                <?php
                $count = 0;
                if(!empty($sub))
                {

                ?>

                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                        <th> Sl No</th>
                        <th>Payment Head</th>

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($sub as $sub_name)
                    {
                        $count = $count+1;?>
                    <tr>

                        <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $sub_name->payment_id;?>"  class="chtest_test"
                                                     onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $sub_name->payment_id;?>"/></td>
                        <td><?php echo $count; ?></td>

                        <td><?php echo $sub_name->payment_head_name;?></td>


                        <td style="text-align:center" ><?php  if($sub_name->payment_head_status =='active'){?>
                                <span class="label label-success">Active</span>
                            <?php }else{?>
                                <span class="label label-important">Inactive</span>
                            <?php }?>
                        </td>
<td>

                            <a class="btn btn-danger" href="#" onclick="delete_academic(<?php echo $sub_name->payment_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
                        </td>



                    </tr>
                    <?php
                    }}
                    else{
                        ?>
                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                            <th> Sl No</th>
                            <th>Payment Head</th>

                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </table>

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

<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%">
    <?php echo form_open_multipart('payment_head/add_payment_head', array('class' => 'form-horizontal', 'id' => 'addFeesStucFrm')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add </h3>
    </div>
    <div class="modal-body">
        <div style="width:500px;  float:left;">
            <?php echo $this->session->flashdata('insert_message');?>



            <div class="control-group" id="school_fees_control">
                <label class="control-label" for="inputSuccess">Payment Head Name</label>
                <div class="controls">
                    <input type="text" id="course_name"  name="add_payment_head_name">
                    <span class="help-inline" id="school_fees_message" style="display:none;"></span> </div>
            </div>






            <div class="control-group" id="name_control" >
                <label class="control-label" for="inputSuccess">Status</label>
                <div class="controls">
                    <select id="add_status" name="add_payment_status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span class="help-inline" id="name_message" style="display:none;"></span>
                </div>
            </div>




        </div>

    </div>
    <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary" onclick="return validate_form();" >Save changes</button>
    </div>
    </form>
</div>


<!-- -----------------------------------------success modal------------------------------------- -->

<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>

    <div class="modal-body">
        <h4>The Post has been Deleted !</h4>
        <div style=" float:center;">
            <button type="submit" class="btn btn-primary">ok</button>
        </div>
    </div>

    </form>
</div>


<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<script language="javascript" type="text/javascript">

    /*function delete_data(id)
     {
     if(confirm('Are you sure do you want to delete it?')){
     window.location = 	base_url+'index.php/subject_module/delete_subject/'+id;
     }
     }*/

    function open_add_model()
    {
        $('#myAddModal').modal('show');

    }

    function delete_academic(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Academic Year?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/payment_head/delete_subject",
                    data:{deleteid:id},
                    success:function(msg){


                    }
                });

                $('#myOKModal').modal('show');

            }
        }
    }

    function go_to_add_view()
    {
        window.location = base_url+'index.php/subject_module/add_subject_view/';
    }





    var base_url='<?php echo base_url();?>';


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
    {

        window.location = base_url+'index.php/subject_module/subject_edit/'+id;

        /*if(id){

         var dataString = 'id='+ id ;
         //alert(dataString)
         $.ajax({
         type: "POST",
         dataType:'json',
         url:base_url+"index.php/subject_module/subject_edit",
         data: dataString,
         async: false,
         success: function(data) {
         var edit_fees=data.edit_fees[0];
         /!* $("#id").val(id);
         $("#edit_class_id").val(edit_fees.class_name);
         $("#edit_subject_name").val(edit_fees.subject_name);
         $("#edit_status").val(edit_fees.status);
         $("#edit_batch").val(edit_fees.batch_name);*!/
         /!*$("#edit_admission_fees").val(edit_fees.admission_fees);
         //$("#edit_electric_charge").val(edit_fees.electric_charge);
         $("#edit_total").val(edit_fees.total);  *!/
         $('#myEditModal').modal('show');

         }

         });
         }*/
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


</script>
<script language="javascript" type="text/javascript">


    function filterInactiveActive(id)
    {

        window.location = base_url+'index.php/subject_module/'+id;

    }
    /*function delete_data(id)
     {
     if(confirm('Are you sure do you want to delete it?'))
     {
     window.location = base_url+'index.php/subject_module/sub_admin_delete/'+id;
     }
     }
     */


    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/subject_module/sub_admin_active_inactive/',
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
            $.post(base_url+'index.php/subject_module/sub_admin_active_more_than_one_id/',
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
            $.post(base_url+'index.php/subject_module/sub_admin_in_active_more_than_one_id/',
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