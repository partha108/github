<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Collection Amount</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Collection Amount</h2>
                <a href="<?php echo base_url()?>index.php/bounce_cheque/excel"><h2 class="down">Download Excel</h2></a></span>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><!--<a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Student </a>-->
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
                    <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_payment_status()" >
                            <i class="icon-edit icon-white"></i> Clear Payment </a>
                </div>




                <?php
                $count = 0;

                ?>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                        <th>Ack no</th>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Receiving Date</th>
                        <th>Cheque Number </th>
                        <th>Bank Name</th>
                        <th>Status</th>
                        <th>Subject Fee</th>
                        <th>Service Amt</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        foreach(@$payment_details as $pd)
                        {
                            @$student_id = $pd->student_id;
                            @$payment_head_id = $pd->payment_head_name;
                            @$course_id = $pd->course_id;
                            @$student_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                            @$payment_head_details = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                            @$std_course_id = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                            @$course_name_id =  $std_course_id[0]->course_name;
                            @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                            @$subject_id = $pd->subject_id;
                            @$sub_details = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                            $count = $count+1;
                            $rec_no = $pd->ack_no;
                            @$pay_rec_details = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
                            //echo count($payment_details);
                            @$payment_tot_amt = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','2','ack_no',$rec_no);
                            // print_r($payment_tot_amt);
                            @$count = count($payment_tot_amt);
                            @$total_fees =0;
                            @$total_vat_amt =0;
                            @$total_amt =0;
                        // echo "<pre>";
                        // print_r($details);
                        //print_r($payment_tot_amt);

                        foreach($payment_tot_amt as $pending_payment_details)
                        {
                            if($pending_payment_details->payment_head_name == 'Exam Fees')
                            {
                                $payment_head_fee = $pending_payment_details->exam_fee;
                            }
                            else if($pending_payment_details->payment_head_name == 'Reg Fees')
                            {
                                $payment_head_fee = $pending_payment_details->course_reg_fee;
                            }
                            else
                            {
                                $payment_head_fee = $pending_payment_details->payment_head_amt;
                            }

                            if($pending_payment_details->payment_head_name == 'Exam Fees')
                            {
                                $vat_fee =  $pending_payment_details->exam_vat_fee;
                            }
                            else if($pending_payment_details->payment_head_name == 'Reg Fees')
                            {
                                $vat_fee= $pending_payment_details->course_fee_vat_amt;
                            }
                            else
                            {
                                $vat_fee =  $pending_payment_details->payment_head_vat_amt;
                            }

                            if($pending_payment_details->payment_head_name == 'Exam Fees')
                            {
                                @$tot_fee = $pending_payment_details->exam_tot_amt;
                            }
                            else if($pending_payment_details->payment_head_name == 'Reg Fees')
                            {
                                @$tot_fee = $pending_payment_details->course_vat_tot_amt;
                            }
                            else
                            {
                                @$tot_fee = $pending_payment_details->payment_head_tot_amt;
                            }
                            @$total_fees +=$payment_head_fee;
                            @$total_vat_amt +=$vat_fee;
                            @$total_amt +=$tot_fee;}
                        ?>

                        <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo @$pd->check_no;?>"  class="chtest_test"
                                                     onClick="single_check_box_checked(/*this.checked,*/this.id)" value="<?php echo @$pd->check_no;?>"/></td>
                        <td><?php echo $pd->ack_no;?></td>

                        <td><?php echo @$student_details[0]->roll_no;?></td>
                        <td><?php echo @$student_details[0]->first_name." ".@$student_details[0]->last_name;  ?></td>

                        <td><?php echo date('d-F-Y',strtotime(@$pd->payment_date));?></td>
                        <td> <?php echo @$pd->check_no; ?></td>
                        <td><?php echo @$pd->bank_name;?></td>

                        <td><?php if(@$pd->check_status == '2'){echo "Bounced";}?></td>
                        <td><?php echo $total_fees;?></td>
                        <td><?php echo $total_vat_amt;?></td>
                        <td><?php echo $total_amt;?></td>
                        <td> <a class="btn btn-danger" href="#" title="Delete Cheque" onclick="delete_cheque(<?php echo $pd->check_no ;?>)"> <i class="icon-trash icon-white"></i>  </a>
                           </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="11"><div id="pagination_container"> <?php echo @$msg; ?> </div></td>
                    </tr>

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
<script>
    function open_payment_view(id){
        window.location = base_url+'index.php/studentlist/add_student_to_payment_view/'+id;
    }

    function delete_cheque()
    {


        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        // alert(checkboxId)
        var checkboxValue=checkboxValue.join("_");
        //alert(checkboxValue);
        if(checkboxValue!='')
        {

            window.location = base_url+'index.php/pending_cheque/delete_cheque/'+checkboxValue;

        }
        else
        {
            alert('Please Select  check box.');
        }
        //alert(id);

    }
    function bounced_cheque(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this cheque?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/pending_cheque/bounced_cheque",
                    data:{deleteid:id},
                    success:function(msg){
                        location.reload();

                    }
                });



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
        // alert(checkboxId)
        var checkboxValue=checkboxValue.join("_");
        if(checkboxValue!='')
        {

            window.location = base_url+'index.php/pending_cheque/receive_payment_model/'+checkboxValue;

        }
        else
        {
            alert('Please Select at least one check box.');
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

                window.location = base_url+'index.php/pending_cheque?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/pending_cheque?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/pending_cheque?'+id+'='+value;
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




