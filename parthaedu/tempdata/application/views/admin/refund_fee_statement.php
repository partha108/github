
<style>
    .tbl
    {
        border-collapse:collapse;
        font-family: Verdana, Geneva, sans-serif;
    }
    td
    {
        border: none
    }
    .head
    {
        padding-left: -10%;
    }
    .receipt
    {
        padding-left: 13px;
    }
    .date
    {
        padding-left: 3%;
    }
    .re_copy
    {
        font-size: 10px;
    }
    .content
    {
        font-size: 12px;
    }
    .tbl_font_size
    {
        font-size: 14px;
        font-family: Verdana, Geneva, sans-serif;
    }
    .tbl_size
    {
        font-size: 10px;
        font-family: Verdana, Geneva, sans-serif;
    }
    .des
    {
        font-size: 12px;
        font-family: Verdana, Geneva, sans-serif;
    }
    hr{
        height: 0;
        max-height: 0;
        font-size: 1px;
        line-height: 0;
        clear: both;
    }


</style>
<?php
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
//echo convert_number_to_words(1800);
?>
<?php
$total_fees =0;
$total_vat_amt =0;
$total_amt =0;

foreach($rec_details as $rc)
{

    if ($rc->payment_head_name == 'Exam Fees')
    {
        $payment_head_fee = $rc->exam_fee;
    } else if ($rc->payment_head_name == 'Reg Fees')
    {
        $payment_head_fee = $rc->course_reg_fee;
    }
    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
    {
        $payment_head_fee = $rc->discount_fee;
    }
    else
    {
        $payment_head_fee = $rc->payment_head_amt;
    }

    if ($rc->payment_head_name == 'Exam Fees')
    {
        $vat_fee = $rc->exam_vat_fee;
    } else if ($rc->payment_head_name == 'Reg Fees')
    {
        $vat_fee = $rc->course_fee_vat_amt;
    }
    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
    {
        $vat_fee = $rc->discount_vat_amt;
    }
    else
    {
        $vat_fee = $rc->payment_head_vat_amt;
    }


    if ($rc->payment_head_name == 'Exam Fees')
    {
        $tot_fee = $rc->exam_tot_amt;
    }
    else if ($rc->payment_head_name == 'Reg Fees')
    {
        $tot_fee = $rc->course_vat_tot_amt;
    }
    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
    {
        $tot_fee = $rc->discount_tot_amt;
    }
    else
    {
        $tot_fee = $rc->payment_head_tot_amt;
    }
    $total_fees += $payment_head_fee;
    $total_vat_amt += $vat_fee;
    $total_amt += $tot_fee;
}
?>


<center>
    <div style="border: 1px solid black;width: 60%">
        <table class="tbl" width="100%" >
            <tr>
                <td align="center" colspan="3"><b>FEE RECEIPT</b><span class="re_copy">(STUDENT COPY)</span><hr></td>
            </tr>
            <tr>
                <td width="31%"><img src="<?php echo base_url();?>front_design/images/logo.png" width="200px" height="83px"></td>
                <td ><b>Partha Educational Institutions</b><br><span class="content">salt lake sec 1 KOL 64<br>+91-9163833903<br>www.parthaedu.com</span></td>
                <td style="font-size: 11px"> PAN No. AAL TS 9367F<br>
                    Service Tax No. AALTS9367FSD001</td>
            </tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
        </table>

        <table width="100%" class="tbl_font_size">
            <?php //foreach($rec_details as $rd){

            ?>
            <tr><td colspan="5"><center><b><span style="font-size:20px">CANCELED</span></b></center></td></tr>
            <tr>
                <?php foreach($rec_details as $rc){
                    $student_id = $rc->student_id;
                    $subject_id = $rc->subject_id;
                    $course_id = $rc->course_id;
                    $st_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                    $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$course_name_id = $acd_year[0]->course_name;
                    $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);


                    @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                    @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                }
                ?>

                <td class="receipt" colspan="2">Receipt No:<?php echo $rc->recepit_no;?></td>
                <td class="date" colspan="2">Payment Date : <?php echo $rc->payment_date;?> </td>


            </tr>
            <tr>
                <td class="receipt" colspan="2">Received from : <?php echo $st_details[0]->first_name." ".$st_details[0]->last_name;; ?></td>
                <td class="date" colspan="2">Registration No :<?php echo $st_details[0]->reg_no;?></td>
            </tr>
            <tr>
                <td class="receipt">Academic Year : <?php echo @$acd_year[0]->academic_year;?></td>
                <td>Course : <?php echo @$course_name[0]->course_name;?> </td>
                <td>Class : <?php echo @$acd_year[0]->class_name;?></td>
                <!--<td>Subject : <?php /*if($rc->payment_head_name == 'Exam Fees'){echo '';}if($rc->payment_head_name == 'Reg Fees'){echo '';}else{echo @$subject_name[0]->subject_name;}*/?></td>-->
            </tr>
            <tr>
                <td colspan="4" class="receipt">Total Amount Received:<?php echo $total_amt." (".convert_number_to_words($total_amt).")"; ?></td>
            </tr>

        </table>
        <table width="100%" class="des">
            <tr>
                <td class="receipt"><span style="font-size:14px;"><b>Academic Year</b></span></td>
                <td><span style="font-size:14px;"><b>Course</b></span></td>
                <td><span style="font-size:14px;"><b>Class</b></span></td>
                <td><span style="font-size:14px;"><b>Subject</b></span></td>
                <td><span style="font-size:14px;"><b>Decsription</b></span></td>
                <td><span style="font-size:14px;"><b>Amount</b></span></td>
                <td><span style="font-size:14px;"><b>Stax</b></span></td>
                <td><span style="font-size:14px;"><b>Total Amount</b></span></td>
            </tr>
            <?php
            $total_fees =0;
            $total_vat_amt =0;
            $total_amt =0;

            foreach($rec_details as $rc)
            {

                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $payment_head_fee = $rc->exam_fee;
                } else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $payment_head_fee = $rc->course_reg_fee;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $payment_head_fee = $rc->discount_fee;
                }
                else
                {
                    $payment_head_fee = $rc->payment_head_amt;
                }

                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $vat_fee = $rc->exam_vat_fee;
                } else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $vat_fee = $rc->course_fee_vat_amt;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $vat_fee = $rc->discount_vat_amt;
                }
                else
                {
                    $vat_fee = $rc->payment_head_vat_amt;
                }


                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $tot_fee = $rc->exam_tot_amt;
                }
                else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $tot_fee = $rc->course_vat_tot_amt;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $tot_fee = $rc->discount_tot_amt;
                }
                else
                {
                    $tot_fee = $rc->payment_head_tot_amt;
                }
                $total_fees += $payment_head_fee;
                $total_vat_amt += $vat_fee;
                $total_amt += $tot_fee;



                $subject_id = $rc->subject_id;
                $course_id = $rc->course_id;
                @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$course_name_id = $acd_year[0]->course_name;
                @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$payment_head_id = $rc->payment_head_name;
                @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);


                @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                ?>
                <tr>
                    <td class="receipt"><?php echo @$acd_year[0]->academic_year;?></td>
                    <td><?php echo @$course_name[0]->course_name;?></td>
                    <td><?php echo @$acd_year[0]->class_name;?></td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo '';
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo '';
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo '';
                        }

                        else
                        {
                            echo @$subject_name[0]->subject_name;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo 'Exam Fess';
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo 'Reg Fees';
                        }
                        else if($rc->payment_head_name == "Discount")
                        {
                            echo $rc->add_payment_head_name;
                        }
                        else if($rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->add_payment_head_name;
                        }
                        else
                        {
                            echo @$payment_head_name[0]->payment_head_name;
                        }
                        ?>
                    </td>
                    <td>







                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_fee;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_reg_fee;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_fee;
                        }
                        else
                        {
                            echo $rc->payment_head_amt;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_vat;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_fee_vat;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_vat;
                        }
                        else
                        {
                            echo $rc->payment_head_vat;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_tot_amt;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_vat_tot_amt;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_tot_amt;
                        }
                        else
                        {
                            echo $rc->payment_head_tot_amt;
                        }
                        ?>
                    </td>
                </tr>

            <?php } ?>

            <tr>
                <td>&nbsp</td>
                <td>&nbsp</td>
                <td>&nbsp</td>

                <td COLSPAN="2"><b>GRAND TOTAL</b></td>
                <td><b><?php echo $total_fees;?></b></td>
                <td><b><?php echo $total_vat_amt;?></b></td>
                <td><b><?php echo $total_amt;?></b></td>
            </tr>
            <tr>
                <td colspan="2" class="receipt">Payment Mode: <?php if($rc->payment_mode == 'cash'){echo 'Cash';}else if($rc->payment_mode == 'chaque'){echo 'Cheque';} else {echo 'Credit/Debit Card';} ;?>
                    <?php if($rc->payment_mode == "chaque"){ ?>
                <td colspan="2">check no:<?php echo $rc->check_no;?></td>
                <td colspan="2">check Status:<?php if($rc->check_status == '1'){echo 'Cleared';}else if($rc->check_status == '2'){echo 'Bounced';}else{echo 'In Process';}?></td>
                <td colspan="2">Bank : <?php echo $rc->bank_name;?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="8"><hr></td>
            </tr>
        </table>
        <table width="100%" class="tbl_size">
            <tr>
                <td class="receipt">*&nbsp;This receipt is subject to realisation of cheque.</td>
            </tr>
            <tr>
                <td class="receipt">*&nbsp;This receipt should be carefully preserved and must be produced on demand</td>
                <td >student/parent<br>signature</td>
                <td>Authorised<br>signature</td>
            </tr>
            <tr>
                <td class="receipt">Fees once paid are not refundable/transferable in any circumstance.</td>
            </tr>

        </table>
    </div>
</center>
<br><br>

<center>
    <div style="border: 1px solid black;width: 60%">
        <table class="tbl" width="100%" >
            <tr>
                <td align="center" colspan="3"><b>FEE RECEIPT</b><span class="re_copy">(ADMIN COPY)</span><hr></td>
            </tr>
            <tr>
                <td width="31%"><img src="<?php echo base_url();?>front_design/images/logo.png" width="200px" height="83px"></td>
                <td ><b>Partha Educational Institutions</b><br><span class="content">salt lake sec 1 KOL 64<br>+91-9163833903<br>www.parthaedu.com</span></td>
                <td style="font-size: 11px"> PAN No. AAL TS 9367F<br>
                    Service Tax No. AALTS9367FSD001</td>
            </tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
        </table>

        <table width="100%" class="tbl_font_size">
            <?php //foreach($rec_details as $rd){

            ?>
            <tr><td colspan="5"><center><b><span style="font-size:20px">CANCELED</span></b></center></td></tr>

            <tr>
                <?php foreach($rec_details as $rc){
                    $student_id = $rc->student_id;
                    $subject_id = $rc->subject_id;
                    $course_id = $rc->course_id;
                    $st_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                    $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$course_name_id = $acd_year[0]->course_name;
                    $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);


                    @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                    @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                }
                ?>
                <td class="receipt" colspan="2">Receipt No:<?php echo $rc->recepit_no;?></td>
                <td class="date" colspan="2">Payment Date : <?php echo $rc->payment_date;?> </td>


            </tr>
            <tr>
                <td class="receipt" colspan="2">Received from : <?php echo $st_details[0]->first_name." ".$st_details[0]->last_name;; ?></td>
                <td class="date" colspan="2">Registration No :<?php echo $st_details[0]->reg_no;?></td>
            </tr>
            <tr>
                <td class="receipt">Academic Year : <?php echo @$acd_year[0]->academic_year;?></td>
                <td>Course : <?php echo @$course_name[0]->course_name;?> </td>
                <td>Class : <?php echo @$acd_year[0]->class_name;?></td>
                <!--<td>Subject : <?php /*if($rc->payment_head_name == 'Exam Fees'){echo '';}if($rc->payment_head_name == 'Reg Fees'){echo '';}else{echo @$subject_name[0]->subject_name;}*/?></td>-->
            </tr>
            <tr>
                <td colspan="4" class="receipt">Total Amount Received:<?php echo $total_amt." (".convert_number_to_words($total_amt).")"; ?></td>
            </tr>

        </table>
        <table width="100%" class="des">
            <tr>
                <td class="receipt"><span style="font-size:14px;"><b>Academic Year</b></span></td>
                <td><span style="font-size:14px;"><b>Course</b></span></td>
                <td><span style="font-size:14px;"><b>Class</b></span></td>
                <td><span style="font-size:14px;"><b>Subject</b></span></td>
                <td><span style="font-size:14px;"><b>Decsription</b></span></td>
                <td><span style="font-size:14px;"><b>Amount</b></span></td>
                <td><span style="font-size:14px;"><b>Stax</b></span></td>
                <td><span style="font-size:14px;"><b>Total Amount</b></span></td>
            </tr>
            <?php
            $total_fees =0;
            $total_vat_amt =0;
            $total_amt =0;

            foreach($rec_details as $rc)
            {

                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $payment_head_fee = $rc->exam_fee;
                } else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $payment_head_fee = $rc->course_reg_fee;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $payment_head_fee = $rc->discount_fee;
                }
                else
                {
                    $payment_head_fee = $rc->payment_head_amt;
                }

                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $vat_fee = $rc->exam_vat_fee;
                } else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $vat_fee = $rc->course_fee_vat_amt;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $vat_fee = $rc->discount_vat_amt;
                }
                else
                {
                    $vat_fee = $rc->payment_head_vat_amt;
                }


                if ($rc->payment_head_name == 'Exam Fees')
                {
                    $tot_fee = $rc->exam_tot_amt;
                }
                else if ($rc->payment_head_name == 'Reg Fees')
                {
                    $tot_fee = $rc->course_vat_tot_amt;
                }
                else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                {
                    $tot_fee = $rc->discount_tot_amt;
                }
                else
                {
                    $tot_fee = $rc->payment_head_tot_amt;
                }
                $total_fees += $payment_head_fee;
                $total_vat_amt += $vat_fee;
                $total_amt += $tot_fee;



                $subject_id = $rc->subject_id;
                $course_id = $rc->course_id;
                @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$course_name_id = $acd_year[0]->course_name;
                @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$payment_head_id = $rc->payment_head_name;
                @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);


                @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                ?>
                <tr>
                    <td class="receipt"><?php echo @$acd_year[0]->academic_year;?></td>
                    <td><?php echo @$course_name[0]->course_name;?></td>
                    <td><?php echo @$acd_year[0]->class_name;?></td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo '';
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo '';
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo '';
                        }

                        else
                        {
                            echo @$subject_name[0]->subject_name;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo 'Exam Fess';
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo 'Reg Fees';
                        }
                        else if($rc->payment_head_name == "Discount")
                        {
                            echo $rc->add_payment_head_name;
                        }
                        else if($rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->add_payment_head_name;
                        }
                        else
                        {
                            echo @$payment_head_name[0]->payment_head_name;
                        }
                        ?>
                    </td>
                    <td>







                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_fee;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_reg_fee;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_fee;
                        }
                        else
                        {
                            echo $rc->payment_head_amt;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_vat;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_fee_vat;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_vat;
                        }
                        else
                        {
                            echo $rc->payment_head_vat;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($rc->payment_head_name == 'Exam Fees')
                        {
                            echo $rc->exam_tot_amt;
                        }
                        else if($rc->payment_head_name == 'Reg Fees')
                        {
                            echo $rc->course_vat_tot_amt;
                        }
                        else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                        {
                            echo $rc->discount_tot_amt;
                        }
                        else
                        {
                            echo $rc->payment_head_tot_amt;
                        }
                        ?>
                    </td>
                </tr>

            <?php } ?>

            <tr>
                <td>&nbsp</td>
                <td>&nbsp</td>
                <td>&nbsp</td>

                <td COLSPAN="2"><b>GRAND TOTAL</b></td>
                <td><b><?php echo $total_fees;?></b></td>
                <td><b><?php echo $total_vat_amt;?></b></td>
                <td><b><?php echo $total_amt;?></b></td>
            </tr>
            <tr>
                <td colspan="2" class="receipt">Payment Mode: <?php if($rc->payment_mode == 'cash'){echo 'Cash';}else if($rc->payment_mode == 'chaque'){echo 'Cheque';} else {echo 'Credit/Debit Card';} ;?>
                    <?php if($rc->payment_mode == "chaque"){ ?>
                <td colspan="2">check no:<?php echo $rc->check_no;?></td>
                <td colspan="2">check Status:<?php if($rc->check_status == '1'){echo 'Cleared';}else if($rc->check_status == '2'){echo 'Bounced';}else{echo 'In Process';}?></td>
                <td colspan="2">Bank : <?php echo $rc->bank_name;?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="8"><hr></td>
            </tr>
        </table>
        <table width="100%" class="tbl_size">
            <tr>
                <td class="receipt">*&nbsp;This receipt is subject to realisation of cheque.</td>
            </tr>
            <tr>
                <td class="receipt">*&nbsp;This receipt should be carefully preserved and must be produced on demand</td>
                <td >student/parent<br>signature</td>
                <td>Authorised<br>signature</td>
            </tr>
            <tr>
                <td class="receipt">Fees once paid are not refundable/transferable in any circumstance.</td>
            </tr>

        </table>
    </div>

    <a href="javascript:void(0)" onclick="print_data()">Print</a>
</center>
<script>

    function print_data()
    {
        var divToPrint=document.getElementById("data_print");
        //table.border = "1";
        newWin= window.open("");
        newWin.document.write(divToPrint.innerHTML);
        newWin.print();
        newWin.close();
    }
    $('button').on('click',function(){
        printData();
    })
</script>


<div id="data_print" style="display: none;">

    <center>
        <div style="border: 1px solid black;width: 100%">
            <table class="tbl" width="100%" >
                <tr>
                    <td align="center" colspan="3"><b>FEE RECEIPT</b><span class="re_copy">(STUDENT COPY)</span><hr></td>
                </tr>
                <tr>
                    <td width="31%"><img src="<?php echo base_url();?>front_design/images/logo.png" width="200px" height="83px"></td>
                    <td ><b>Partha Educational Institutions</b><br><span class="content">salt lake sec 1 KOL 64<br>+91-9163833903<br>www.parthaedu.com</span></td>
                    <td style="font-size: 11px"> PAN No. AAL TS 9367F<br>
                        Service Tax No. AALTS9367FSD001</td>
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
            </table>

            <table width="100%" class="tbl_font_size">
                <?php //foreach($rec_details as $rd){

                ?>
                <tr><td colspan="5"><center><b><span style="font-size:20px">CANCELED</span></b></center></td></tr>

                <tr>
                    <?php foreach($rec_details as $rc){
                        $student_id = $rc->student_id;
                        $subject_id = $rc->subject_id;
                        $course_id = $rc->course_id;
                        $st_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                        $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                        @$course_name_id = $acd_year[0]->course_name;
                        $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);


                        @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                        @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                    }
                    ?>
                    <td class="receipt" colspan="2">Receipt No:<?php echo $rc->recepit_no;?></td>
                    <td class="date" colspan="2">Payment Date : <?php echo $rc->payment_date;?> </td>


                </tr>
                <tr>
                    <td class="receipt" colspan="2">Received from : <?php echo $st_details[0]->first_name." ".$st_details[0]->last_name;; ?></td>
                    <td class="date" colspan="2">Registration No :<?php echo $st_details[0]->reg_no;?></td>
                </tr>
                <tr>
                    <td class="receipt">Academic Year : <?php echo @$acd_year[0]->academic_year;?></td>
                    <td>Course : <?php echo @$course_name[0]->course_name;?> </td>
                    <td>Class : <?php echo @$acd_year[0]->class_name;?></td>
                    <!--<td>Subject : <?php /*if($rc->payment_head_name == 'Exam Fees'){echo '';}if($rc->payment_head_name == 'Reg Fees'){echo '';}else{echo @$subject_name[0]->subject_name;}*/?></td>-->
                </tr>
                <tr>
                    <td colspan="4" class="receipt">Total Amount Received:<?php echo $total_amt." (".convert_number_to_words($total_amt).")"; ?></td>
                </tr>

            </table>
            <table width="100%" class="des">
                <tr>
                    <td class="receipt"><span style="font-size:14px;"><b>Academic Year</b></span></td>
                    <td><span style="font-size:14px;"><b>Course</b></span></td>
                    <td><span style="font-size:14px;"><b>Class</b></span></td>
                    <td><span style="font-size:14px;"><b>Subject</b></span></td>
                    <td><span style="font-size:14px;"><b>Decsription</b></span></td>
                    <td><span style="font-size:14px;"><b>Amount</b></span></td>
                    <td><span style="font-size:14px;"><b>Stax</b></span></td>
                    <td><span style="font-size:14px;"><b>Total Amount</b></span></td>
                </tr>
                <?php
                $total_fees =0;
                $total_vat_amt =0;
                $total_amt =0;

                foreach($rec_details as $rc)
                {

                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $payment_head_fee = $rc->exam_fee;
                    } else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $payment_head_fee = $rc->course_reg_fee;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $payment_head_fee = $rc->discount_fee;
                    }
                    else
                    {
                        $payment_head_fee = $rc->payment_head_amt;
                    }

                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $vat_fee = $rc->exam_vat_fee;
                    } else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $vat_fee = $rc->course_fee_vat_amt;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $vat_fee = $rc->discount_vat_amt;
                    }
                    else
                    {
                        $vat_fee = $rc->payment_head_vat_amt;
                    }


                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $tot_fee = $rc->exam_tot_amt;
                    }
                    else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $tot_fee = $rc->course_vat_tot_amt;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $tot_fee = $rc->discount_tot_amt;
                    }
                    else
                    {
                        $tot_fee = $rc->payment_head_tot_amt;
                    }
                    $total_fees += $payment_head_fee;
                    $total_vat_amt += $vat_fee;
                    $total_amt += $tot_fee;

                    $subject_id = $rc->subject_id;
                    $course_id = $rc->course_id;
                    @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$course_name_id = $acd_year[0]->course_name;
                    @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$payment_head_id = $rc->payment_head_name;
                    @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);


                    @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                    @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                    ?>
                    <tr>
                        <td class="receipt"><?php echo @$acd_year[0]->academic_year;?></td>
                        <td><?php echo @$course_name[0]->course_name;?></td>
                        <td><?php echo @$acd_year[0]->class_name;?></td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo '';
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo '';
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo '';
                            }

                            else
                            {
                                echo @$subject_name[0]->subject_name;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo 'Exam Fess';
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo 'Reg Fees';
                            }
                            else if($rc->payment_head_name == "Discount")
                            {
                                echo $rc->add_payment_head_name;
                            }
                            else if($rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->add_payment_head_name;
                            }
                            else
                            {
                                echo @$payment_head_name[0]->payment_head_name;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_fee;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_reg_fee;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_fee;
                            }
                            else
                            {
                                echo $rc->payment_head_amt;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_vat;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_fee_vat;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_vat;
                            }
                            else
                            {
                                echo $rc->payment_head_vat;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_tot_amt;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_vat_tot_amt;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_tot_amt;
                            }
                            else
                            {
                                echo $rc->payment_head_tot_amt;
                            }
                            ?>
                        </td>
                    </tr>

                <?php } ?>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>
                    <td>&nbsp</td>

                    <td COLSPAN="2"><b>GRAND TOTAL</b></td>
                    <td><b><?php echo $total_fees;?></b></td>
                    <td><b><?php echo $total_vat_amt;?></b></td>
                    <td><b><?php echo $total_amt;?></b></td>
                </tr>
                <tr>
                    <td colspan="2" class="receipt">Payment Mode: <?php if($rc->payment_mode == 'cash'){echo 'Cash';}else if($rc->payment_mode == 'chaque'){echo 'Cheque';} else {echo 'Credit/Debit Card';} ;?>
                        <?php if($rc->payment_mode == "chaque"){ ?>
                    <td colspan="2">check no:<?php echo $rc->check_no;?></td>
                    <td colspan="2">check Status:<?php if($rc->check_status == '1'){echo 'Cleared';}else if($rc->check_status == '2'){echo 'Bounced';}else{echo 'In Process';}?></td>
                    <td colspan="2">Bank : <?php echo $rc->bank_name;?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="8"><hr></td>
                </tr>
            </table>
            <table width="100%" class="tbl_size">
                <tr>
                    <td class="receipt">*&nbsp;This receipt is subject to realisation of cheque.</td>
                </tr>
                <tr>
                    <td class="receipt">*&nbsp;This receipt should be carefully preserved and must be produced on demand</td>
                    <td >student/parent<br>signature</td>
                    <td>Authorised<br>signature</td>
                </tr>
                <tr>
                    <td class="receipt">Fees once paid are not refundable/transferable in any circumstance.</td>
                </tr>

            </table>
        </div>
    </center>
    <br><br>

    <center>
        <div style="border: 1px solid black;width: 100%">
            <table class="tbl" width="100%" >
                <tr>
                    <td align="center" colspan="3"><b>FEE RECEIPT</b><span class="re_copy">(ADMIN COPY)</span><hr></td>
                </tr>
                <tr>
                    <td width="31%"><img src="<?php echo base_url();?>front_design/images/logo.png" width="200px" height="83px"></td>
                    <td ><b>Partha Educational Institutions</b><br><span class="content">salt lake sec 1 KOL 64<br>+91-9163833903<br>www.parthaedu.com</span></td>
                    <td style="font-size: 11px"> PAN No. AAL TS 9367F<br>
                        Service Tax No. AALTS9367FSD001</td>
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
            </table>

            <table width="100%" class="tbl_font_size">
                <?php //foreach($rec_details as $rd){

                ?>
                <tr><td colspan="5"><center><b><span style="font-size:20px">CANCELED</span></b></center></td></tr>
                <tr>
                    <?php foreach($rec_details as $rc){
                        $student_id = $rc->student_id;
                        $subject_id = $rc->subject_id;
                        $course_id = $rc->course_id;
                        $st_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                        $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                        @$course_name_id = $acd_year[0]->course_name;
                        $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);


                        @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                        @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                    }
                    ?>
                    <td class="receipt" colspan="2">Receipt No:<?php echo $rc->recepit_no;?></td>
                    <td class="date" colspan="2">Payment Date : <?php echo $rc->payment_date;?> </td>


                </tr>
                <tr>
                    <td class="receipt" colspan="2">Received from : <?php echo $st_details[0]->first_name." ".$st_details[0]->last_name;; ?></td>
                    <td class="date" colspan="2">Registration No :<?php echo $st_details[0]->reg_no;?></td>
                </tr>
                <tr>
                    <td class="receipt">Academic Year : <?php echo @$acd_year[0]->academic_year;?></td>
                    <td>Course : <?php echo @$course_name[0]->course_name;?> </td>
                    <td>Class : <?php echo @$acd_year[0]->class_name;?></td>
                    <!--<td>Subject : <?php /*if($rc->payment_head_name == 'Exam Fees'){echo '';}if($rc->payment_head_name == 'Reg Fees'){echo '';}else{echo @$subject_name[0]->subject_name;}*/?></td>-->
                </tr>
                <tr>
                    <td colspan="4" class="receipt">Total Amount Received:<?php echo $total_amt." (".convert_number_to_words($total_amt).")"; ?></td>
                </tr>

            </table>
            <table width="100%" class="des">
                <tr>
                    <td class="receipt"><span style="font-size:14px;"><b>Academic Year</b></span></td>
                    <td><span style="font-size:14px;"><b>Course</b></span></td>
                    <td><span style="font-size:14px;"><b>Class</b></span></td>
                    <td><span style="font-size:14px;"><b>Subject</b></span></td>
                    <td><span style="font-size:14px;"><b>Decsription</b></span></td>
                    <td><span style="font-size:14px;"><b>Amount</b></span></td>
                    <td><span style="font-size:14px;"><b>Stax</b></span></td>
                    <td><span style="font-size:14px;"><b>Total Amount</b></span></td>
                </tr>
                <?php
                $total_fees =0;
                $total_vat_amt =0;
                $total_amt =0;

                foreach($rec_details as $rc)
                {

                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $payment_head_fee = $rc->exam_fee;
                    } else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $payment_head_fee = $rc->course_reg_fee;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $payment_head_fee = $rc->discount_fee;
                    }
                    else
                    {
                        $payment_head_fee = $rc->payment_head_amt;
                    }

                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $vat_fee = $rc->exam_vat_fee;
                    } else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $vat_fee = $rc->course_fee_vat_amt;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $vat_fee = $rc->discount_vat_amt;
                    }
                    else
                    {
                        $vat_fee = $rc->payment_head_vat_amt;
                    }


                    if ($rc->payment_head_name == 'Exam Fees')
                    {
                        $tot_fee = $rc->exam_tot_amt;
                    }
                    else if ($rc->payment_head_name == 'Reg Fees')
                    {
                        $tot_fee = $rc->course_vat_tot_amt;
                    }
                    else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                    {
                        $tot_fee = $rc->discount_tot_amt;
                    }
                    else
                    {
                        $tot_fee = $rc->payment_head_tot_amt;
                    }
                    $total_fees += $payment_head_fee;
                    $total_vat_amt += $vat_fee;
                    $total_amt += $tot_fee;



                    $subject_id = $rc->subject_id;
                    $course_id = $rc->course_id;
                    @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$course_name_id = $acd_year[0]->course_name;
                    @$acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                    @$payment_head_id = $rc->payment_head_name;
                    @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);


                    @$course_name = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
                    @$subject_name = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                    ?>
                    <tr>
                        <td class="receipt"><?php echo @$acd_year[0]->academic_year;?></td>
                        <td><?php echo @$course_name[0]->course_name;?></td>
                        <td><?php echo @$acd_year[0]->class_name;?></td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo '';
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo '';
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo '';
                            }

                            else
                            {
                                echo @$subject_name[0]->subject_name;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo 'Exam Fess';
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo 'Reg Fees';
                            }
                            else if($rc->payment_head_name == "Discount")
                            {
                                echo $rc->add_payment_head_name;
                            }
                            else if($rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->add_payment_head_name;
                            }
                            else
                            {
                                echo @$payment_head_name[0]->payment_head_name;
                            }
                            ?>
                        </td>
                        <td>







                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_fee;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_reg_fee;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_fee;
                            }
                            else
                            {
                                echo $rc->payment_head_amt;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_vat;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_fee_vat;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_vat;
                            }
                            else
                            {
                                echo $rc->payment_head_vat;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($rc->payment_head_name == 'Exam Fees')
                            {
                                echo $rc->exam_tot_amt;
                            }
                            else if($rc->payment_head_name == 'Reg Fees')
                            {
                                echo $rc->course_vat_tot_amt;
                            }
                            else if($rc->payment_head_name == "Discount" || $rc->payment_head_name == "Add_fee")
                            {
                                echo $rc->discount_tot_amt;
                            }
                            else
                            {
                                echo $rc->payment_head_tot_amt;
                            }
                            ?>
                        </td>
                    </tr>

                <?php } ?>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>
                    <td>&nbsp</td>

                    <td COLSPAN="2"><b>GRAND TOTAL</b></td>
                    <td><b><?php echo $total_fees;?></b></td>
                    <td><b><?php echo $total_vat_amt;?></b></td>
                    <td><b><?php echo $total_amt;?></b></td>
                </tr>
                <tr>
                    <td colspan="2" class="receipt">Payment Mode: <?php if($rc->payment_mode == 'cash'){echo 'Cash';}else if($rc->payment_mode == 'chaque'){echo 'Cheque';} else {echo 'Credit/Debit Card';} ;?>
                        <?php if($rc->payment_mode == "chaque"){ ?>
                    <td colspan="2">check no:<?php echo $rc->check_no;?></td>
                    <td colspan="2">check Status:<?php if($rc->check_status == '1'){echo 'Cleared';}else if($rc->check_status == '2'){echo 'Bounced';}else{echo 'In Process';}?></td>
                    <td colspan="2">Bank : <?php echo $rc->bank_name;?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="8"><hr></td>
                </tr>
            </table>
            <table width="100%" class="tbl_size">
                <tr>
                    <td class="receipt">*&nbsp;This receipt is subject to realisation of cheque.</td>
                </tr>
                <tr>
                    <td class="receipt">*&nbsp;This receipt should be carefully preserved and must be produced on demand</td>
                    <td >student/parent<br>signature</td>
                    <td>Authorised<br>signature</td>
                </tr>
                <tr>
                    <td class="receipt">Fees once paid are not refundable/transferable in any circumstance.</td>
                </tr>

            </table>
        </div>


    </center>
</div>


