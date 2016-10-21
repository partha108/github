<?php //print_r($booking_msg); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body style="font-family:arial,sans-serif; font-size:13px; color:#222">
<div style=" width: 100%">
    <div><a href="" width="226" height="81" alt="" /></a></div>
    <div>
        <?php
        $total_fees =0;
        $total_vat_amt =0;
        $total_amt =0;

        foreach($rec_detail as $rc) {         

            if ($rc->payment_head_name == 'Exam Fees') {
                $payment_head_fee = $rc->exam_fee;
            } else if ($rc->payment_head_name == 'Reg Fees') {
                $payment_head_fee = $rc->course_reg_fee;
            } else {
                $payment_head_fee = $rc->payment_head_amt;
            }

            if ($rc->payment_head_name == 'Exam Fees') {
                $vat_fee = $rc->exam_vat_fee;
            } else if ($rc->payment_head_name == 'Reg Fees') {
                $vat_fee = $rc->course_fee_vat_amt;
            } else {
                $vat_fee = $rc->payment_head_vat_amt;
            }


            if ($rc->payment_head_name == 'Exam Fees') {
                $tot_fee = $rc->exam_tot_amt;
            } else if ($rc->payment_head_name == 'Reg Fees') {
                $tot_fee = $rc->course_vat_tot_amt;
            } else {
                $tot_fee = $rc->payment_head_tot_amt;
            }
            $total_fees += $payment_head_fee;
            $total_vat_amt += $vat_fee;
            $total_amt += $tot_fee;
        }
        ?>

        <?php foreach($st_detail as $sd)
        {
            $student_name = $sd->first_name." ".$sd->last_name;
        }?>
        <?php foreach($rec_detail as $spd)
        {
            $bank_name = $spd->bank_name;
            $check_no = $spd->check_no;
            $ack_no = $spd->ack_no;

        }
        ?>
        <p>Dear,<?php echo $student_name;  ?></p>

        <p>We have received amount of <?php echo $total_amt;?>  with check no <?php echo $check_no;?> Bank <?php echo $bank_name;?>. Your Ackonledgement Number <?php echo $ack_no;?> </p>
        <p> Confirmation will be sent when it gets cleared in Bank  and Payment Of Fees will be Complete.</p>
        <p>Thannk You . Partha Educational Institutions</p>

        <p style="border-top: #00b0f0 1px dotted; border-bottom: #00b0f0 1px dotted; padding:10px 0; display:inline-block">Please note: This is an auto generated email. Do not reply</p>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>
