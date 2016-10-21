<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Payment List</a> </li>
        </ul>

    </div>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Payment List</h2>
                <h2 style="padding-left:82%;"><a href="#" onclick="javascript: window.history.back()">Back</a></h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Payment Head </a>
                    <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_payment_status()" >
                            <i class="icon-edit icon-white"></i> Receive Payment </a>
                </div>
                <br><br>
                <input type="hidden" name="student_id" value="<?php echo $this->uri->segment(3);?>">

                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                        <th>Date</th>
                        <th>Academic Year</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Subject</th>
                        <th>Payment Head</th>
                        <th>Sub Fee</th>
                        <th>Service Amt</th>
                        <th>Tot Amt</th>
                        <th>Ack no</th>
                        <th>Rec no</th>
                        <th>status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 0;
                    foreach($details as $cd) //1st
                    {
                        @$subject_id = $cd->subject_id;
                       // print_r($details);
                        foreach ($stu_details as $sd) {
                            //print_r($sd);
                            @$student_id = $sd->student_id;
                            @$course_id = $cd->course_id;
                            @$payment_head_name = $cd->payment_head_name;


                            @$p_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_name);
                            @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                            @$course_name_id = $acd_year[0]->course_name;
                            @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                            @$details_sub_name = $this->common_model->payment_head_detail('tbl_add_course_subject_to_student','add_course_id',$course_id,'student_id',$student_id);

                            //print_r($details_sub_name);




                            @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);


                            //echo $acd_year[0]->academic_year;
                            @$count = $count + 1;
                            ?>
                            <tr>
                                <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $cd->payment_id;?>"  class="chtest_test"
                                                                 onClick="single_check_box_checked(/*this.checked,*/this.id)" value="<?php echo $cd->payment_id;?>"/></td>
                                <td><?php echo date('j F, Y', strtotime($cd->payment_head_frm_date)); ?></td>
                                <td><?php echo @$acd_year[0]->academic_year;?></td>
                                <td><?php echo @$sd->first_name." ".$sd->last_name; ?></td>
                                <td><?php echo @$course_name[0]->course_name; ?></td>
                                <td><?php if(@$cd->payment_head_name == "Exam Fees" || $cd->payment_head_name == "Reg Fees" || $cd->payment_head_name == "Discount" || $cd->payment_head_name == "Add_fee"){echo '-';}else{echo @$subject_name[0]->subject_name;} ?></td>
                                <td><?php if(@$cd->payment_head_name == "Exam Fees" || $cd->payment_head_name == "Reg Fees"){echo $cd->payment_head_name;} else if($cd->payment_head_name == "Discount" || $cd->payment_head_name == "Add_fee"){echo $cd->add_payment_head_name;}else{echo @$p_head_name[0]->payment_head_name;} ?></td>
                                <td><?php if(@$cd->payment_head_name == "Exam Fees"){echo $cd->exam_fee;}else if($cd->payment_head_name == "Reg Fees"){echo $cd->course_reg_fee;}else if($cd->payment_head_name == "Discount" || $cd->payment_head_name == "Add_fee"){ echo $cd->discount_fee;}else{echo @$cd->payment_head_amt;} ?></td>
                                <td><?php if(@$cd->payment_head_name == "Exam Fees"){echo $cd->exam_vat_fee;}else if($cd->payment_head_name == "Reg Fees"){echo $cd->course_fee_vat;}else if($cd->payment_head_name == "Discount" || $cd->payment_head_name == "Add_fee"){ echo $cd->discount_vat_amt;}else{echo @$cd->payment_head_vat;} ?></td>
                                <td><?php if(@$cd->payment_head_name == "Exam Fees"){echo $cd->exam_tot_amt;}else if($cd->payment_head_name == "Reg Fees"){echo $cd->course_vat_tot_amt;}else if($cd->payment_head_name == "Discount" || $cd->payment_head_name == "Add_fee"){ echo $cd->discount_tot_amt;}else{echo @$cd->payment_head_tot_amt;} ?></td>
                                <td><?php echo @$cd->ack_no; ?></td>
                                <td><?php echo @$cd->recepit_no; ?></td>
                                <td style="text-align:center" ><?php  if(@$cd->payment_status=='paid' && @$cd->payment_mode=='cash' && @$cd->check_status  == '0'){?>
                                        <span class="label label-success">Cash</span>
                                        <?php } else if(@$cd->payment_status=='paid' || $cd->payment_status=='0' && @$cd->payment_mode=='chaque' && @$cd->check_status  == '1'){?>
                                                <span class="label label-success">Cleared</span>
                                        <?php //}?>
                                    <?php } else if(@$cd->payment_status=='pending' && @$cd->payment_mode=='chaque' && @$cd->check_status  == '2'){?>
                                        <span class="label label-important">Bounced</span>
                                    <?php } else if(@$cd->payment_status=='pending' && @$cd->payment_mode=='chaque' && @$cd->check_status  == '3'){?>
                                        <span class="label label-important">In-Process</span>
                                    <?php } else{?>
                                        <span class="label label-important">Pending</span>
                                    <?php } ?>
                                </td>
                                <td><?php if($cd->payment_status == 'pending' && $cd->payment_mode == 'chaque' && $cd->check_status  == '3'){?>
                                        <a class="btn btn-info" onclick="return open_recipet(<?php echo $cd->payment_id;?>)" href="#">
                                            <i class="icon-print icon-white"></i>
                                            Ack print
                                        </a>
                                <?php } else if(@trim($cd->payment_status)=='paid' || @trim($cd->payment_status)=='0' && (@trim($cd->payment_mode) == 'cash' || trim($cd->payment_mode)=='chaque') && (@trim($cd->check_status)  == '0' || trim($cd->check_status)  == '1'))
                                    {?>
                                        <a class="btn btn-info" onclick="return open_recipet(<?php echo $cd->payment_id;?>)" href="#" title="Print Receipt">
                                            <i class="icon-print icon-white"></i>
                                           <!-- Print Receipt-->
                                        </a>

                                        <a class="btn btn-info" onclick="return refund_fee(<?php echo @$cd->recepit_no;?>)" href="#" title="Refund Fee">
                                            <i class="icon-remove icon-white"></i>
                                             <!--//cancel-->
                                        </a>


                                    <?php }
                                    ?>
                                </td>
                            </tr>

                            <?php
//}
                        }
                    } //1st
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
    <div class="modal hide fade" id="myaddmodel" style="width:1000px; left:40%">
            <?php echo form_open_multipart('studentlist/add_payment_head', array('class' => 'form-horizontal', 'id' => 'addClassFrm')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Add Payment Head</h3>
                </div>
                <div class="modal-body">
                    <div style="width:500px;  float:left;">
                        <?php echo $this->session->flashdata('insert_message');?>
                        <input type="hidden" name="st_id" value="<?php echo $student_id;?>">
                        <input type="hidden" id="id"  name="id" readonly="readonly" >


                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess"> Payment Head Name </label>
                            <div class="controls">
                                <select name="payment_head_name" id="payment_head_name">
                                    <option value="Discount">Discount</option>
                                    <option value="Add_fee">Add Fee</option>
                                </select>
                               
                                <span class="help-inline" id="name_message" style="display:none;"></span>
                            </div>
                            </div>
                            <div class="control-group" id="name_control" >
                                <label class="control-label" for="inputSuccess">Enter Payment Head Name</label>
                                <div class="controls">
                                   <input type="text" name="txt_payment_head_name">

                                    <span class="help-inline" id="name_message" style="display:none;"></span>
                                </div>




                        </div>
                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess"> Calculate Tot Amt</label>
                            <div class="controls">
                               <input type="text" id="tot_amt" onkeyup="cal_total_amount();" autocomplete="off">
                             <span class="help-inline" id="name_message" style="display:none;"></span>
                            </div>
                        </div>
                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess"> Calculate %</label>
                            <div class="controls">
                               <input type="text" id="tot_pre_amt" onkeyup="cal_total_amount();" autocomplete="off">%
                                <span class="help-inline" id="name_message" style="display:none;"></span>
                            </div>
                        </div>

                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess">Discount Amt</label>
                            <div class="controls">
                                <input type="text" id="edit_exam_fee"  name="discount_fee" onkeyup="edit_show_total_amount();" autocomplete="off">
                                <span class="help-inline" id="name_message" style="display:none;"></span>
                            </div>
                        </div>


                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess">Service Tax </label>
                            <div class="controls">
                                <input type="text"  name="discount_service_vat" id="edit_vat" onkeyup="edit_show_total_amount();" autocomplete="off">%
                                <input type="hidden" readonly name="discount_service_vat_amt" id="edit_vat_amt" >
                                <span class="help-inline" id="name_message" style="display:none;"></span>
                            </div>
                        </div>

                        <div class="control-group" id="name_control" >
                            <label class="control-label" for="inputSuccess">Total Discount Amt </label>
                            <div class="controls">
                                <input type="text"  name="discount_tot_amt" id="edit_tot_amt">
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
</div>
</div>
<script>
    function open_add_model()
    {
        $("#myaddmodel").modal('show');
    }
    var base_url='<?php echo base_url();?>';
    function add_course(id)
    {
        window.location = base_url+'index.php/studentlist/add_course_view/'+id;
    }

    function open_course_view(id)
    {

        window.location = base_url+'index.php/studentlist/add_student_to_course_view'+id;
    }



    function receive_payment_model(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Course?')){


                window.location = base_url+'index.php/studentlist/receive_payment_model/'+id;

            }
        }
    }

    function open_recipet(id){
       // alert(id);
        window.location = base_url+'index.php/studentlist/payment_receipt/'+id;
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



</script>

<script>
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


                    }
                });

                location.reload();

            }
        }
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




    function active_payment_status()
    {
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        //alert(checkboxId)
        var checkboxValue=checkboxValue.join("_");
        if(checkboxValue!='')
        {

            window.location = base_url+'index.php/studentlist/receive_payment_model/'+checkboxValue;

        }
        else
        {
            alert('Please Select at least one check box.');
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


    function cal_total_amount()
    {

        var a = document.getElementById('tot_amt').value;

        var b = document.getElementById('tot_pre_amt').value;
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
            var d = parseFloat(a)-parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#edit_exam_fee').val(Math.round(d));
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
<script>
    $("#add_academic_year").on("change", function(e) {
        var course_id = this.value;
       // alert(course_id);


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




    function refund_fee(id)
    {


            window.location = base_url+'index.php/studentlist/refund_fee/'+id;


    }

</script>




