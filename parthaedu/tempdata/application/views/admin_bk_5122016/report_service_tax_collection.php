
<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Service Tax Collection</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Service Tax Collection Amount</h2>
                <a href="<?php echo base_url()?>index.php/report_module/excel"><h2 class="down">Download Excel</h2></a></span>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><!--<a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Student </a>-->
                    <table class="tblborder">
                        <tr>
                            <td width="15%" colspan="2" style=" text-align:left">

                                <select style="width:50%" id="per_page"  onchange="pagination_select(this.value,this.id)">
                                    <option value="">Select</option>
                                    <option value="10" <?php if($per_page==10)  { echo 'selected';} ?>>10</option>
                                    <option value="50" <?php if($per_page==50)  { echo 'selected';} ?>>50</option>
                                    <option value="100" <?php if($per_page==100) { echo 'selected';} ?>>100</option>
                                    <option value="500" <?php if($per_page==500) { echo 'selected';} ?>>500</option>
                                    <option value="1000" <?php if($per_page==1000){ echo 'selected';} ?>>1000</option>
                                </select></td>
                       <td>
                        <form method="post">
                            <input type="text" name="txt_search_data" id="txt_search_data" placeholder="Student name etc..">
                            To<input type="text" id="to_date" name="to_date">&nbsp;&nbsp;&nbsp;
                            Form<input type="text" id="frm_date" name="frm_date">
                            <select >
                                <option value="0">---Select Payment Head Name---</option>
                            </select>
                            <input type="submit" value="Search">
                        </form>
                            </td>
                        </tr>
                    </table>
                </div>

                <?php
                $count = 0;

                ?>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Receipt no</th>
                        <th>Status</th>
                        <th>Receiving Date</th>
                        <th>Cheque Number </th>
                        <th>Bank Name</th>
                        <th>Academic Year</th>
                        <th>Reg No</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Class</th>
                        <th>Batch</th>
                        <th>Subject</th>
                        <th>Payment Head Name</th>
                        <th>Subject Fee</th>
                        <th>Service Amt</th>
                        <th>Total</th>


                    </tr>
                    </thead>
                    <tbody>
                   <!-- <tr>-->
                        <?php
                        $chk_rec_no_cnt = 0;

                        foreach(@$payment_details as $pd)
                        {
                             //print_r($pd);
                            if($chk_rec_no_cnt == 0)
                            {
                                $chk_rec_no = $pd->recepit_no;
                                $chk_rec_no_cnt++;

                            }

                            @$student_id = $pd->student_id;
                            @$payment_head_id = $pd->payment_head_name;
                            @$course_id = $pd->course_id;
                            $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                            @$student_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                            @$payment_head_details = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                            @$std_course_id = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                            @$course_name_id =  $std_course_id[0]->course_name;
                            @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);

                            //  print_r($course_details);
                            @$subject_id = $pd->subject_id;
                            @$sub_details = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                            @$batch_details = $this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);
                            //print_r($batch_details);


                            //print_r($sub_details);
                            $count = $count+1;
                            $rec_no = $pd->recepit_no;
                            @$pay_rec_details = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
                            //echo count($payment_details);
                            @$payment_tot_amt = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
                            @$payment_head_id = $pd->payment_head_name;
                            @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                            // print_r($payment_tot_amt);


                            $count = count($payment_tot_amt);

                            // echo "<pre>";
                            // print_r($details);


                           /* foreach($payment_tot_amt as $pending_payment_details)
                            {
                                if($pending_payment_details->payment_head_name == 'Exam Fees')
                                {
                                    $payment_head_fee = $pending_payment_details->exam_fee;
                                }
                                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                                {
                                    $payment_head_fee = $pending_payment_details->course_reg_fee;
                                }
                                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                                {
                                    $payment_head_fee = $pending_payment_details->discount_fee;
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
                                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                                {
                                    $vat_fee = $pending_payment_details->discount_vat_amt;
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
                                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                                {
                                    $tot_fee = $pending_payment_details->discount_tot_amt;
                                }
                                else
                                {
                                    @$tot_fee = $pending_payment_details->payment_head_tot_amt;
                                }
                                @$total_fees +=$payment_head_fee;
                                @$total_vat_amt +=$vat_fee;
                                @$total_amt +=$tot_fee;
                            }*/


                            ?>
                            <?php
                            if($pd->payment_status == "paid" && @$pd->check_status == '1')
                            {
                                if ($pd->recepit_no != $chk_rec_no) {
                                    $chk_rec_no = $pd->recepit_no;
                                    ?>
                                    <tr>
                                        <td colspan="12"></td>
                                        <td><b>Sum Of Amount</td>
                                        <td><?php echo "<b>" . $head_fees; ?></td>
                                        <td><?php echo "<b>" . $total_vat_amt; ?></td>
                                        <td><?php echo "<b>" . $total_amt; ?></td>
                                    </tr>
                                    <?php
                                    @$head_fees = 0;
                                    @$total_vat_amt = 0;
                                    @$total_amt = 0;
                                }
                            }
                            else
                            {

                                if ($pd->recepit_no != $chk_rec_no) {
                                $chk_rec_no = $pd->recepit_no;

                                ?>
                                <tr>
                                    <td colspan="12"></td>
                                    <td><b>Sum Of Amount</td>
                                    <td><?php echo "<b>" . $head_fees; ?></td>
                                    <td><?php echo "<b>" . $total_vat_amt; ?></td>
                                    <td><?php echo "<b>" . $total_amt; ?></td>
                                </tr>
                                <?php
                                @$head_fees = 0;
                                @$total_vat_amt = 0;
                                @$total_amt = 0;
                            }
                            }
                            ?>


<tr>
                            <td><?php echo $pd->recepit_no;?></td>
                            <td><?php if($pd->payment_status == "paid" && @$pd->check_status == '1'){echo "Cleared";}else {echo "Cancled";}?></td>
                            <td><?php echo date('d-m-Y',strtotime(@$pd->payment_date));?></td>
                            <td> <?php echo @$pd->check_no; ?></td>
                            <td><?php echo @$pd->bank_name;?></td>
                            <td><?php echo @$acd_year[0]->academic_year;?></td>
                            <td><?php echo @$student_details[0]->reg_no;?></td>
                            <td><?php echo @$student_details[0]->first_name."<br> ".@$student_details[0]->last_name;  ?></td>
                            <td><?php  echo @$course_details[0]->course_name;?></td>
                            <td><?php echo @$acd_year[0]->class_name;?></td>
                            <td><?php  echo @$batch_details[0]->batch_name; ?></td>
                            <td><?php  echo @$sub_details[0]->subject_name; ?></td>
                            <!--<td><?php /*echo $total_fees;*/?></td>
                            <td><?php /*echo $total_vat_amt;*/?></td>
                            <td><?php /*echo $total_amt;*/?></td>-->
                            <td>
                                <?php

                                if($pd->payment_status == "paid" && @$pd->check_status == '1')
                                {
                                    if($pd->payment_head_name == 'Exam Fees')
                                    {
                                        echo "Exam_fee";
                                    }
                                    else if($pd->payment_head_name == 'Reg Fees')
                                    {
                                        echo  "Reg fee";
                                    }
                                    else if($pd->payment_head_name == "Discount")
                                    {
                                        echo $pd->add_payment_head_name;
                                    }
                                    else if($pd->payment_head_name == "Add_fee")
                                    {
                                        echo $pd->add_payment_head_name;
                                    }
                                    else
                                    {
                                        echo  $payment_head_name[0]->payment_head_name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($pd->payment_head_name == 'Exam Fees')
                                    {
                                        echo $pd->exam_fee;
                                        $payment_head_fee = $pd->exam_fee;
                                    }
                                    else if($pd->payment_head_name == 'Reg Fees')
                                    {
                                        echo  $pd->course_reg_fee;
                                        $payment_head_fee = $pd->course_reg_fee;
                                    }
                                    else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                                    {
                                        echo  $pd->discount_fee;
                                        $payment_head_fee = $pd->discount_fee;
                                    }
                                    else
                                    {
                                        echo  $pd->payment_head_amt;
                                        $payment_head_fee = $pd->payment_head_amt;
                                    }
                                    @$head_fees +=$payment_head_fee;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($pd->payment_head_name == 'Exam Fees')
                                    {
                                        echo  $pd->exam_vat_fee;
                                        $vat_fee =  $pd->exam_vat_fee;
                                    }
                                    else if($pd->payment_head_name == 'Reg Fees')
                                    {
                                        echo $pd->course_fee_vat_amt;
                                        $vat_fee =  $pd->course_fee_vat_amt;
                                    }
                                    else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                                    {
                                        echo $pd->discount_vat_amt;
                                        $vat_fee =  $pd->discount_vat_amt;
                                    }
                                    else
                                    {
                                        echo  $pd->payment_head_vat_amt;
                                        $vat_fee =   $pd->payment_head_vat_amt;
                                    }
                                    @$total_vat_amt +=$vat_fee;
                                    ?>
                                </td>
                                <td>
                                    <?php

                                    if($pd->payment_head_name == 'Exam Fees')
                                    {
                                        echo $pd->exam_tot_amt;
                                        @$tot_fee = $pd->exam_tot_amt;
                                    }
                                    else if($pd->payment_head_name == 'Reg Fees')
                                    {
                                        echo $pd->course_vat_tot_amt;
                                        @$tot_fee = $pd->course_vat_tot_amt;
                                    }
                                    else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                                    {
                                        echo $pd->discount_tot_amt;
                                        @$tot_fee = $pd->discount_tot_amt;
                                    }
                                    else
                                    {
                                        echo $pd->payment_head_tot_amt;
                                        @$tot_fee = $pd->payment_head_tot_amt;
                                    }
                                    @$total_amt +=$tot_fee;



                            }
                                    else
                                    { if($pd->payment_head_name == 'Exam Fees')
                                    {
                                        echo "Exam_fee";
                                    }
                                    else if($pd->payment_head_name == 'Reg Fees')
                                    {
                                        echo  "Reg fee";
                                    }
                                    else if($pd->payment_head_name == "Discount")
                                    {
                                        echo $pd->add_payment_head_name;
                                    }
                                    else if($pd->payment_head_name == "Add_fee")
                                    {
                                        echo $pd->add_payment_head_name;
                                    }
                                    else
                                    {
                                        echo  $payment_head_name[0]->payment_head_name;
                                    }
                                    ?>
                                </td>
    <td>
        <?php
        if($pd->payment_head_name == 'Exam Fees')
        {
            echo -($pd->exam_fee);
            $payment_head_fee = $pd->exam_fee;
        }
        else if($pd->payment_head_name == 'Reg Fees')
        {
            echo  -($pd->course_reg_fee);
            $payment_head_fee = $pd->course_reg_fee;
        }
        else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
        {
            echo  -($pd->discount_fee);
            $payment_head_fee = $pd->discount_fee;
        }
        else
        {
            echo  -($pd->payment_head_amt);
            $payment_head_fee = $pd->payment_head_amt;
        }
        @$head_fees +=$payment_head_fee;
        ?>
    </td>
    <td>
        <?php
        if($pd->payment_head_name == 'Exam Fees')
        {
            echo  -($pd->exam_vat_fee);
            $vat_fee =  $pd->exam_vat_fee;
        }
        else if($pd->payment_head_name == 'Reg Fees')
        {
            echo -($pd->course_fee_vat_amt);
            $vat_fee =  $pd->course_fee_vat_amt;
        }
        else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
        {
            echo -($pd->discount_vat_amt);
            $vat_fee =  $pd->discount_vat_amt;
        }
        else
        {
            echo  -($pd->payment_head_vat_amt);
            $vat_fee =   $pd->payment_head_vat_amt;
        }
        @$total_vat_amt +=$vat_fee;
        ?>
    </td>
    <td>
        <?php

        if($pd->payment_head_name == 'Exam Fees')
        {
            echo -($pd->exam_tot_amt);
            @$tot_fee = $pd->exam_tot_amt;
        }
        else if($pd->payment_head_name == 'Reg Fees')
        {
            echo -($pd->course_vat_tot_amt);
            @$tot_fee = $pd->course_vat_tot_amt;
        }
        else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
        {
            echo -($pd->discount_tot_amt);
            @$tot_fee = $pd->discount_tot_amt;
        }
        else
        {
            echo -($pd->payment_head_tot_amt);
            @$tot_fee = $pd->payment_head_tot_amt;
        }
        @$total_amt +=$tot_fee;


        }
                                    ?>
                                </td>



                        </tr>




                    <?php
                    }
                    //$chk_rec_no++;
                    if(@$pd->payment_status == "paid" && @$pd->check_status == '1')
                    {
                        ?>
                        <tr>
                            <td colspan="12"></td>
                            <td><b>Sum Of Amount</td>
                            <td><?php echo "<b>" . $head_fees; ?></td>
                            <td><?php echo "<b>" . $total_vat_amt; ?></td>
                            <td><?php echo "<b>" . $total_amt; ?></td>
                        </tr>
                        <?php
                    }
                    else
                    {
                        @$ne_head_fees = $head_fees;
                        @$ne_tot_vat_amt = $total_vat_amt;
                        @$ne_tot_amt = $total_amt;
                        ?>
                        <tr>
                            <td colspan="12"></td>
                            <td><b>Sum Of Amount</td>
                            <td><?php echo "<b>" ."-" .$ne_head_fees; ?></td>
                            <td><?php echo "<b>" ."-" .$ne_tot_vat_amt; ?></td>
                            <td><?php echo "<b>" ."-". $ne_tot_amt; ?></td>
                        </tr>
                        <?php
                    }
                   ?>


                <?php

                $count = count($payment_det_count);
                $tot_head_fee =0;
                $tot_head_vat_amt =0;
                $tot_head_amt =0;
                $tot_ne_head_fee =0;
                $tot_ne_head_vat_amt =0;
                $tot_ne_head_amt =0;
                // echo "<pre>";
                // print_r($details);

                foreach($payment_det_count as $tot_amt_clear_cheque) {
                    if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees') {
                        $payment_head_fee = $tot_amt_clear_cheque->exam_fee;
                    } else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees') {
                        $payment_head_fee = $tot_amt_clear_cheque->course_reg_fee;
                    } else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee") {
                        $payment_head_fee = $tot_amt_clear_cheque->discount_fee;
                    } else {
                        $payment_head_fee = $tot_amt_clear_cheque->payment_head_amt;
                    }

                    if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees') {
                        $vat_fee = $tot_amt_clear_cheque->exam_vat_fee;
                    } else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees') {
                        $vat_fee = $tot_amt_clear_cheque->course_fee_vat_amt;
                    } else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee") {
                        $vat_fee = $tot_amt_clear_cheque->discount_vat_amt;
                    } else {
                        $vat_fee = $tot_amt_clear_cheque->payment_head_vat_amt;
                    }


                    if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees') {
                        @$tot_fee = $tot_amt_clear_cheque->exam_tot_amt;
                    } else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees') {
                        @$tot_fee = $tot_amt_clear_cheque->course_vat_tot_amt;
                    } else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee") {
                        $tot_fee = $tot_amt_clear_cheque->discount_tot_amt;
                    } else {
                        @$tot_fee = $tot_amt_clear_cheque->payment_head_tot_amt;
                    }
                    $tot_head_fee +=$payment_head_fee;
                    $tot_head_vat_amt +=$vat_fee;
                    $tot_head_amt +=$tot_fee;
                }


                foreach($payment_amt_count as $tot_amt_nv_cheque)
                {
                    if($tot_amt_nv_cheque->payment_head_name == 'Exam Fees')
                    {
                        $payment_head_fee = $tot_amt_nv_cheque->exam_fee;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == 'Reg Fees')
                    {
                        $payment_head_fee = $tot_amt_nv_cheque->course_reg_fee;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == "Discount" || $tot_amt_nv_cheque->payment_head_name == "Add_fee")
                    {
                        $payment_head_fee = $tot_amt_nv_cheque->discount_fee;
                    }
                    else
                    {
                        $payment_head_fee = $tot_amt_nv_cheque->payment_head_amt;
                    }

                    if($tot_amt_nv_cheque->payment_head_name == 'Exam Fees')
                    {
                        $vat_fee =  $tot_amt_nv_cheque->exam_vat_fee;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == 'Reg Fees')
                    {
                        $vat_fee= $tot_amt_nv_cheque->course_fee_vat_amt;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == "Discount" || $tot_amt_nv_cheque->payment_head_name == "Add_fee")
                    {
                        $vat_fee = $tot_amt_nv_cheque->discount_vat_amt;
                    }
                    else
                    {
                        $vat_fee =  $tot_amt_nv_cheque->payment_head_vat_amt;
                    }


                    if($tot_amt_nv_cheque->payment_head_name == 'Exam Fees')
                    {
                        @$tot_fee = $tot_amt_nv_cheque->exam_tot_amt;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == 'Reg Fees')
                    {
                        @$tot_fee = $tot_amt_nv_cheque->course_vat_tot_amt;
                    }
                    else if($tot_amt_nv_cheque->payment_head_name == "Discount" || $tot_amt_nv_cheque->payment_head_name == "Add_fee")
                    {
                        $tot_fee = $tot_amt_nv_cheque->discount_tot_amt;
                    }
                    else
                    {
                        @$tot_fee = $tot_amt_nv_cheque->payment_head_tot_amt;
                    }
                    $tot_ne_head_fee += $payment_head_fee;
                    $tot_ne_head_vat_amt += $vat_fee;
                    $tot_ne_head_amt += $tot_fee;

                }
                ?>


                    <tr>

                        <td colspan="13" style="text-align:right"><b>Grand Total</td>
                        <td><?php echo "<b>".($tot_head_fee - $tot_ne_head_fee);?></td>
                        <td><?php echo "<b>".($tot_head_vat_amt - $tot_ne_head_vat_amt);?></td>
                        <td colspan="2"><?php echo "<b>".($tot_head_amt - $tot_ne_head_amt) ;?></td

                    </tr>


                    <tr>
                        <td colspan="17"><div id="pagination_container"> <?php echo @$msg; ?> </div></td>
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
<!--<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
-->

<script language="javascript" type="text/javascript">
    /*jQuery(document).ready(function() {
     addTinyMCE("user_details");

     });*/
   /* $( "#to_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"dd/mm/yy",
        showAnim: "slide",
        yearRange: '2000:2016'
    });

    $( "#frm_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"dd/mm/yy",
        showAnim: "slide",
        yearRange: '2000:2016'
    });*/
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php  $tags= json_encode($abc);?>

<script>
    $(function() {

        var availableTags = <?php echo $tags;?>;
        $("#txt_search_data").autocomplete({

            source: availableTags,
            autoFocus:true
        });
    });

</script>