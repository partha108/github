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
                <a href="<?php echo base_url()?>index.php/pending_list/excel"><h2 class="down">Download Excel</h2></a></span>
            </div>



            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <table class="tblborder">
                    <form method="post" action="<?php echo base_url('index.php/studentlist/send_sms_to_student');?>">
                        <input type="hidden" name="chk[]" id="field_results" value="">
                        <input type="submit" value="Send Sms" class="btn btn-primary" onclick="return chk_send_sms_input();">
                    </form>
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
                    <form method="post" action="<?php echo base_url('pending_list/search');?>">
                        <select  name="add_ac_year" id="add_ac_year" onchange="add_show_course(this.value)" >
                            <option value="0">---Select Academic Year---</option>
                            <?php
                            foreach ($academic_year as $item) {
                                ?>
                                <option value="<?php echo $item->academic_year;?>"><?php echo $item->academic_year;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select id="edit_db_course" name="add_course" onchange="add_show_class(this.value);">
                            <option value="0">---Select Course---</option>

                        </select>
                        <select id="class_id" name="add_class" onchange="add_show_batch(this.value);add_show_subject(this.value);">
                            <option value="0">---Select class---</option>
                        </select>
                        <select id="sub_id_0" class="sub_id" name="add_subject" >
                            <option value="0">---Select Subject---</option>
                        </select>
                        <select id="batch_id_0" name="batch_id">
                            <option value="0">---Select Batch---</option>
                        </select>
                        <input type="submit" value="Search">
                    </form>

                </table>

                <table class="table table-striped table-bordered bootstrap-datatable">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
                        <th>Sl No</th>
                        <th>Academic Year</th>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Payment Head</th>
                        <th>Course</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Subject Fee</th>
                        <th>Service Tax</th>
                        <th>Service Amt</th>
                        <th>Fees</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>



                    <tr>
                        <?php
                        $count = 0;
                        $total_fees_per_page = 0;
                        $total_vat_amt_per_page = 0;
                        $total_amt_per_page = 0;
                        foreach($payment_details as $pd)
                        {
                            if($pd->payment_head_name == 'Exam Fees')
                            {
                                $payment_head_fee_per_page = $pd->exam_fee;
                            }
                            else if($pd->payment_head_name == 'Reg Fees')
                            {
                                $payment_head_fee_per_page = $pd->course_reg_fee;
                            }
                            else
                            {
                                $payment_head_fee_per_page = $pd->payment_head_amt;
                            }

                            if($pd->payment_head_name == 'Exam Fees')
                            {
                                $vat_fee_per_page = $pd->exam_vat_fee;
                            }
                            else if($pd->payment_head_name == 'Reg Fees')
                            {
                                $vat_fee_per_page = $pd->course_fee_vat_amt;
                            }
                            else
                            {
                                $vat_fee_per_page = $pd->payment_head_vat;
                            }

                            if($pd->payment_head_name == 'Exam Fees')
                            {
                                $tot_fee_per_page = $pd->exam_tot_amt;
                            }
                            else if($pd->payment_head_name == 'Reg Fees')
                            {
                                $tot_fee_per_page = $pd->course_vat_tot_amt;
                            }
                            else
                            {
                                $tot_fee_per_page = $pd->payment_head_tot_amt;
                            }
                            $total_fees_per_page +=$payment_head_fee_per_page;
                            $total_vat_amt_per_page +=$vat_fee_per_page;
                            $total_amt_per_page +=$tot_fee_per_page;

                        
							//print_r($pd);
                        @$student_id = $pd->student_id;
                        @$payment_head_id = $pd->payment_head_name;
                        @$course_id = $pd->course_id;
                        @$student_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
						//print_r($student_details);
                        @$payment_head_details = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                        @$std_course_id = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                        @$course_name_id =  $std_course_id[0]->course_name;
                        @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                        @$subject_id = $pd->subject_id;
                        @$sub_details = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                        @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                        $count = $count+1;
                        ?>
                        <td style="width:1px">
                            <input type="checkbox" name="check_id" id="<?php echo $pd->student_id;?>"
                                   class="chtest_test" onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $pd->student_id;?>"/>
                        </td>
                        <td><?php echo (($per_page*($page-1))+$count); ?></td>
                        <td><?php echo @$std_course_id[0]->academic_year;?></td>
                        <td><?php echo @$student_details[0]->roll_no;?></td>
                        <td><?php echo @$student_details[0]->first_name." ".@$student_details[0]->last_name;  ?></td>

                        <td><?php if(@$pd->payment_head_name == 'Exam Fees'){echo @$pd->payment_head_name; }else if(@$pd->payment_head_name == 'Reg Fees'){echo @$pd->payment_head_name; }else{echo @ $subject_name = $payment_head_name[0]->payment_head_name;;}?></td>
                        <td> <?php echo @$course_details[0]->course_name; ?></td>
                        <td><?php echo @$std_course_id[0]->class_name;?></td>
                        <td><?php echo @$sub_details[0]->subject_name;?></td>
                        <td><?php if(@$pd->payment_head_name == 'Exam Fees'){echo @$pd->exam_fee; }else if($pd->payment_head_name == 'Reg Fees'){echo @$pd->course_reg_fee; }else{echo @$pd->payment_head_amt	;}?></th></td>
                        <td><?php if(@$pd->payment_head_name == 'Exam Fees'){echo @$pd->exam_vat; }else if($pd->payment_head_name == 'Reg Fees'){echo @$pd->course_fee_vat; }else{echo @$pd->payment_head_vat	;}?></th></td>
                        <td><?php if(@$pd->payment_head_name == 'Exam Fees'){echo @$pd->exam_vat_fee; }else if($pd->payment_head_name == 'Reg Fees'){echo @$pd->course_fee_vat_amt; }else{echo @$pd->payment_head_vat_amt	;}?></th></td>
                        <td><?php if(@$pd->payment_head_name == 'Exam Fees'){echo @$pd->exam_tot_amt; }else if($pd->payment_head_name == 'Reg Fees'){echo @$pd->course_vat_tot_amt; }else{echo @$pd->payment_head_tot_amt	;}?></td>
                        <td><a onclick="return open_payment_view(<?php echo $student_id;?>)" href="#">Payment Schedule Details</a></td>

                    </tr>


                    <?php
                    }
                        ?>
                    <?php
                    $count = count($payment_det_count);
                    $total_fees =0;
                    $total_vat_amt =0;
                    $total_amt =0;

                    // echo "<pre>";
                    // print_r($details);

                    foreach($payment_det_count as $pending_payment_details)
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
                            $vat_fee = $pending_payment_details->exam_vat_fee;
                        }
                        else if($pending_payment_details->payment_head_name == 'Reg Fees')
                        {
                            $vat_fee = $pending_payment_details->course_fee_vat_amt;
                        }
                        else
                        {
                            $vat_fee = $pending_payment_details->payment_head_vat;
                        }

                        if($pending_payment_details->payment_head_name == 'Exam Fees')
                        {
                            $tot_fee = $pending_payment_details->exam_tot_amt;
                        }
                        else if($pending_payment_details->payment_head_name == 'Reg Fees')
                        {
                            $tot_fee = $pending_payment_details->course_vat_tot_amt;
                        }
                        else
                        {
                            $tot_fee = $pending_payment_details->payment_head_tot_amt;
                        }
                        $total_fees +=$payment_head_fee;
                        $total_vat_amt +=$vat_fee;
                        $total_amt +=$tot_fee;
                    }



                    ?>
                    <tr>
                        <td colspan="8"><span style="padding-left: 80%"><b>Total Amount Per Page </b></span> </td>
                        <td ><?php echo $total_fees_per_page;?></td>
                        <td>&nbsp;</td>
                        <td ><?php echo $total_vat_amt_per_page;?></td>
                        <td colspan="10"><?php echo $total_amt_per_page;?></td>
                    </tr>
                    <tr>
                        <td colspan="8"><span style="padding-left: 82%"><b>Grand Total Amount</b></span> </td>
                        <td ><?php echo $total_fees;?></td>
                        <td>&nbsp;</td>
                        <td ><?php echo $total_vat_amt;?></td>
                        <td colspan="10"><?php echo $total_amt;?></td>
                    </tr>

                    </tbody>
                </table>
               
                <table width="100%">





                <tr>
              <td colspan="8"><div id="pagination_container"> <?php echo @$msg; ?> </div></td>
            </tr>
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
</script>
<script language="javascript" type="text/javascript">

    function pagination_select(value,id)
    {   
        
          var str='<?php echo @$page_str ;?>';
          if(value.trim())
          {
            if(value.trim())
            {
                
                window.location = base_url+'index.php/pending_list?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/pending_list?'+str;
            }
            
          }
          else
          {
              window.location = base_url+'index.php/pending_list?'+id+'='+value;
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
    function add_show_course(id)
    {
        $("#edit_db_course").load('<?php echo base_url();?>index.php/subject_module/add_course_model/'+id);
    }

    function add_show_class(id)
    {
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_class/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                $("#class_id").load('<?php echo base_url();?>index.php/studentlist/add_class/'+id);
            }
        });

    }

    function add_show_subject(id)
    {
        var acc_value = $('#add_ac_year').val();
        var course_value = $('#edit_db_course').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_subject/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,course_value:course_value},
            success: function (data) {
                $("#sub_id_0").load('<?php echo base_url();?>index.php/studentlist/add_subject/'+id);
            }
        });

    }

    function add_show_batch(id)
    {
        var acc_value = $('#add_ac_year').val();
        var course_value = $('#edit_db_course').val();
        //var class_value = $('#class_id').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_batch/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,course_value:course_value},
            success: function (data) {
                //alert(data)


                //$("#sub_id_0").load('<?php echo base_url();?>index.php/studentlist/add_subject/'+id);
                $("#batch_id_0").load('<?php echo base_url();?>index.php/studentlist/add_batch/'+id);


            }
        });

    }

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
        alert('hi')
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

    function chk_send_sms_input()
    {
        alert(hi)
        /*if($.trim($("#chk").val())=="")
        {
            alert('Please Select Atleast One Checkbox');
            return false;
        }*/
    }




</script>

