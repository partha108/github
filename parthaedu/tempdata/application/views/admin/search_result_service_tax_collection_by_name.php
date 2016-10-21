
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
            <div class="box-header well" data-original-title style="text-align: right">
                <h2><i class="icon-user"></i>Service Tax Collection Amount</h2>
                <a href="javascript:void(0)" id="dwn_excel"><h2 class="down">Download Excel</h2></a></span>
                <form method="post" action="<?php echo base_url()?>index.php/report_module/excel_search_by_class">
                    <input type="hidden" name="txt_search_data" value="<?php echo $name;?>">
                    <input type="hidden" name="txt_rec_no" value="<?php echo $rec_no;?>">
                    <input type="hidden" name="to_date" value="<?php echo $to_date;?>">&nbsp;&nbsp;&nbsp;
                    <input type="hidden" name="frm_date" value="<?php echo $frm_date;?>">
                    <input type="hidden" name="payment_head" value="<?php echo $drp_payment_head;?>">
                   <!-- <input type="submit" value="Download Excel" id="sub_frm">-->
                </form>
            </div>
            <style>
                #sub_frm
                {
                    background-color: Transparent;
                    border:0 none;
                    cursor:pointer;
                    color: #317eac;
                    font-family: "Karla",sans-serif;
                    font-weight: bold;
                    margin: 0;
                    text-rendering: optimizelegibility;
                }
            </style>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div><!--<a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Student </a>-->
                    <table class="tblborder">
                        <!--<tr>
                            <td width="15%" colspan="2" style=" text-align:left">

                                <select style="width:50%" id="per_page"  onchange="pagination_select(this.value,this.id)">
                                    <option value="">Select</option>
                                    <option value="10" <?php /*if($per_page==10)  { echo 'selected';} */?>>10</option>
                                    <option value="50" <?php /*if($per_page==50)  { echo 'selected';} */?>>50</option>
                                    <option value="100" <?php /*if($per_page==100) { echo 'selected';} */?>>100</option>
                                    <option value="500" <?php /*if($per_page==500) { echo 'selected';} */?>>500</option>
                                    <option value="1000" <?php /*if($per_page==1000){ echo 'selected';} */?>>1000</option>
                                </select></td>

                        </tr>
-->
                        <input type="radio" name="search_data" value="search_by_class">Search By Class
                        <input type="radio" name="search_data" value="search_by_name" checked>Search By Name
                        <div id="frm1" style="display: block">
                            <form method="post" action="<?php echo base_url('report_module/search');?>">
                                <input type="text" name="txt_search_data" id="txt_search_data" value="<?php echo $name;?>">
                                <input type="text" placeholder="Enter recepit_no" id="txt_rec_no" name="txt_rec_no" value="<?php echo $rec_no;?>">
                                To<input type="text" id="to_date" name="to_date" value="<?php echo $to_date;?>">&nbsp;&nbsp;&nbsp;
                                Form<input type="text" id="frm_date" name="frm_date" value="<?php echo $frm_date;?>">
                                <select name="payment_head" id="dr_payment_head">
                                    <option value="0">---Select Payment Head Name---</option>
                                    <option value="Exam Fees" <?php if($drp_payment_head == "Exam Fees"){echo "selected";} ?>>Exam Fees</option>
                                    <option value="Reg Fees" <?php if($drp_payment_head == "Reg Fees"){echo "selected";} ?>>Reg Fees</option>
                                    <?php
                                    foreach ($payment_head as $sph)
                                    {
                                        $p_name = $sph->payment_head_name;
                                        $p_id   = $sph->payment_id;
                                        ?>
                                        <option value="<?php echo $p_id;?>" <?php if($drp_payment_head == $p_id){echo "selected";} ?> ><?php echo $p_name;?></option>
                                    <?php } ?>
                                    <option value="Discount" <?php if($drp_payment_head == "Discount"){echo "selected";} ?>>Discount Fee</option>
                                    <option value="Add_fee" <?php if($drp_payment_head == "Add_fee"){echo "selected";} ?>>Additional Fee</option>

                                </select>
                                <input type="submit" value="Search">
                            </form>
                        </div>
                        <div id="frm2" style="display: none"><form method="post" action="<?php echo base_url('report_module/search_by_class');?>">
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
                </div>

                <?php
                $count = 0;

                ?>
                <table class="table table-striped table-bordered" id="tbl_data">
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

                    foreach(@$search_by_id as $pd)
                    {
                        if($chk_rec_no_cnt == 0)
                        {
                            $chk_rec_no = $pd->recepit_no;
                            $chk_rec_no_cnt++;
                        }

                        @$student_id            =   $pd->student_id;
                        @$payment_head_id       =   $pd->payment_head_name;
                        @$course_id             =   $pd->course_id;
                        $acd_year               =   $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                        @$student_details       =   $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                        @$payment_head_details  =   $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                        @$std_course_id         =   $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                        @$course_name_id        =   $std_course_id[0]->course_name;
                        @$course_details        =   $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                        @$subject_id            =   $pd->subject_id;
                        @$sub_details           =   $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                        @$batch_details         =   $this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);
                        $count                  =   $count+1;
                        $rec_no                 =   $pd->recepit_no;
                        @$pay_rec_details       =   $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
                        @$payment_tot_amt       =   $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
                        @$payment_head_id       =   $pd->payment_head_name;
                        @$payment_head_name     =   $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                        $count = count($payment_tot_amt);
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

                    $count = count($search_by_id);
                    $tot_head_fee =0;
                    $tot_head_vat_amt =0;
                    $tot_head_amt =0;
                    $tot_ne_head_fee =0;
                    $tot_ne_head_vat_amt =0;
                    $tot_ne_head_amt =0;
                    // echo "<pre>";
                    // print_r($details);

                    foreach($search_by_id as $tot_amt_clear_cheque)
                    {
                        if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees')
                        {
                            $payment_head_fee = $tot_amt_clear_cheque->exam_fee;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees')
                        {
                            $payment_head_fee = $tot_amt_clear_cheque->course_reg_fee;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee")
                        {
                            $payment_head_fee = $tot_amt_clear_cheque->discount_fee;
                        }
                        else
                        {
                            $payment_head_fee = $tot_amt_clear_cheque->payment_head_amt;
                        }

                        if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees')
                        {
                            $vat_fee = $tot_amt_clear_cheque->exam_vat_fee;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees')
                        {
                            $vat_fee = $tot_amt_clear_cheque->course_fee_vat_amt;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee")
                        {
                            $vat_fee = $tot_amt_clear_cheque->discount_vat_amt;
                        }
                        else
                        {
                            $vat_fee = $tot_amt_clear_cheque->payment_head_vat_amt;
                        }


                        if ($tot_amt_clear_cheque->payment_head_name == 'Exam Fees')
                        {
                            @$tot_fee = $tot_amt_clear_cheque->exam_tot_amt;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == 'Reg Fees')
                        {
                            @$tot_fee = $tot_amt_clear_cheque->course_vat_tot_amt;
                        }
                        else if ($tot_amt_clear_cheque->payment_head_name == "Discount" || $tot_amt_clear_cheque->payment_head_name == "Add_fee")
                        {
                            $tot_fee = $tot_amt_clear_cheque->discount_tot_amt;
                        }
                        else
                        {
                            @$tot_fee = $tot_amt_clear_cheque->payment_head_tot_amt;
                        }
                        $tot_head_fee +=$payment_head_fee;
                        $tot_head_vat_amt +=$vat_fee;
                        $tot_head_amt +=$tot_fee;
                    }


                    foreach($search_by_id as $tot_amt_nv_cheque)
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
                        <td><?php echo "<b>".($tot_head_fee);?></td>
                        <td><?php echo "<b>".($tot_head_vat_amt);?></td>
                        <td colspan="2"><?php echo "<b>".($tot_head_amt) ;?></td

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
    $( "#to_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy/mm/dd",
        showAnim: "slide",
        yearRange: '2000:2016'
    });

    $( "#frm_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy/mm/dd",
        showAnim: "slide",
        yearRange: '2000:2016'
    });
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

<?php  $tags1= json_encode($xyz);?>

<script>
    $(function() {

        var availableTags = <?php echo $tags1;?>;
        $("#txt_rec_no").autocomplete({

            source: availableTags,
            autoFocus:true
        });
    });

</script>
<script>
    $(document).ready(function(){

        $('input[type="radio"]').click(function(){


            if($(this).attr("value")=="search_by_class"){

                $("#frm2").show();
                $("#frm1").hide();



            }

            if($(this).attr("value")=="search_by_name"){
                $("#frm1").show();
                $("#frm2").hide();
            }


        });

    });

</script>

<script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>

<script>
    $("#dwn_excel").click(function(){
        $("#tbl_data").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: "SomeFile" //do not include extension
        });
    });
</script>
