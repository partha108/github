<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Receive Payment</a> </li>
        </ul
    ></div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Receive Payment</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <form method="post" action="<?php echo base_url('index.php/studentlist/receive_payment_status') ?>">
                    <input type="hidden" name="payment_id" value="<?php echo $this->uri->segment(3);?>">
                    <input type="hidden" name="receipt_id" value = "<?php echo rand(000,999).microtime().$this->uri->segment(3);?>">
                    <table class="table table-striped table-bordered">
                    
                    <?php
                        $check_rec_no = $rec_no+1;
                   //echo "rec ".$check_rec_no;
                        $chk_ack_no = $ak_no+1;

					    if(strlen($check_rec_no) == 1 )
					    {
					?>
						    <input type="text"  name="recipt_no" value="<?php echo "436".$check_rec_no;?>">

					<?php
					    }
					        else if(strlen($check_rec_no) == 2)
					        {
					?>
						        <input type="hidden"  name="recipt_no" value="<?php echo "43".$check_rec_no;?>">
					<?php
				        	}
                            else if(strlen($check_rec_no) == 3)
				            {
						?>
					            <input type="hidden"  name="recipt_no" value="<?php echo "4".$check_rec_no;?>">
					<?php
	        				}
			        		else if(strlen($check_rec_no) >= 4)
					        {
					?>
        						<input type="hidden"  name="recipt_no" value="<?php echo $check_rec_no;?>">
        			<?php
		        			}
					?>
                    <?php
                            if(strlen($chk_ack_no) == 1)
                            {
                     ?>
                                <input type="hidden"  name="ack_no" value="<?php echo "123".$chk_ack_no;?>">

                     <?php
                            }
                            else if(strlen($chk_ack_no) == 2)
                            {
                     ?>
                               <input type="hidden"  name="ack_no" value="<?php echo "12".$chk_ack_no;?>">
                     <?php
                           }
                            else if(strlen($chk_ack_no) == 3)
                            {
                     ?>
                               <input type="hidden"  name="ack_no" value="<?php echo $chk_ack_no;?>">
                     <?php
                             }
                             else if(strlen($chk_ack_no) >= 4)
                            {
                    ?>
                                <input type="hidden"  name="ack_no" value="<?php echo $chk_ack_no;?>">
                    <?php
                            }
                    foreach($details as $update_payment_details)
                    {
                        //print_r($update_payment_details);
                        $check_no = $update_payment_details[0]->check_no;
                        $bank_name = $update_payment_details[0]->bank_name;
                        $payment_mode = $update_payment_details[0]->payment_mode;
                        $check_status = $update_payment_details[0]->check_status;
                    }
                    ?>

                    <tr>
                            <th>Payment Receive Date</th>
                            <th>Payment Mode</th>
                            <th class="chk_detail">Check Details</th>
                            <th class="chk_detail">Check Status</th>
                        </tr>
                        <tr>
                            <td>
                               <input type="text" name="payment_receive_date" id="payment_receive_date" class="payment_receive_date" value="<?php echo date('Y/m/d'); ?>">
                            <td>
                                <select id="payment_mode" name="payment_mode" onchange="dis_field(this);">
                                    <option value="0">Select Payment Mode</option>
                                    <option value="paid" id="1">Cash</option>
                                    <option value="paid" id="2" <?php if($payment_mode == 'chaque'){echo "selected";}?>>Cheque</option>
                                    <option value="paid" id="3">Credit/Debit Card</option>
                                </select>
                                
                            </td>

                            <td class="chk_detail">
                                <input type="text" name="check_no" placeholder="check number" maxlength="6" value="<?php echo $check_no;?>">
                                <input type="text" name="bank_name" placeholder="Bank Name" value="<?php echo $bank_name;?>">

                            </td>

                            <td class="chk_detail">
                                <select id="check_status" name="check_status">
                                    <option value="0">Select Status</option>
                                    <option value="3" <?php if($check_status == '3'){echo "selected";}?>>In Process</option>
                                    <option value="2" <?php if($check_status == '1'){echo "selected";}?>>Bounced</option>
                                    <option value="1">Cleared</option>
                                </select></td>
                        </tr>
                    </table>
                    <table class="table table-striped table-bordered">
                        <tr>
                          
                            <th>Fees</th>
                            <th>Service Tax Amt</th>
                            <th>Total Amount</th>

                        </tr>


                            <?php
                            $count = count($details);
                            $total_fees =0;
                            $total_vat_amt =0;
                            $total_amt =0;
                           // echo "<pre>";
                           // print_r($details);

                            foreach($details as $payment_details)
							{
                                //echo "<pre>";print_r($payment_details);
                                if($payment_details[0]->payment_head_name == 'Exam Fees')
                                {
                                    $payment_head_fee = $payment_details[0]->exam_fee;
                                }
                                else if($payment_details[0]->payment_head_name == 'Reg Fees')
                                {
                                    $payment_head_fee = $payment_details[0]->course_reg_fee;
                                }
                                else if($payment_details[0]->payment_head_name == "Discount" || $payment_details[0]->payment_head_name == "Add_fee")
                                {
                                    $payment_head_fee = $payment_details[0]->discount_fee;
                                }
                                else
                                {
                                    $payment_head_fee = $payment_details[0]->payment_head_amt;
                                }


                                if($payment_details[0]->payment_head_name == 'Exam Fees')
                                {
                                    $vat_fee =  $payment_details[0]->exam_vat_fee;
                                }
                                else if($payment_details[0]->payment_head_name == 'Reg Fees')
                                {
                                    $vat_fee= $payment_details[0]->course_fee_vat_amt;
                                }
                                else if($payment_details[0]->payment_head_name == "Discount" || $payment_details[0]->payment_head_name == "Add_fee")
                                {
                                    $vat_fee = $payment_details[0]->discount_vat_amt;
                                }
                                else
                                {
                                    $vat_fee =  $payment_details[0]->payment_head_vat_amt;
                                }



                                if($payment_details[0]->payment_head_name == 'Exam Fees')
                                {
                                    $tot_fee = $payment_details[0]->exam_tot_amt;
                                }
                                else if($payment_details[0]->payment_head_name == 'Reg Fees')
                                {
                                    $tot_fee = $payment_details[0]->course_vat_tot_amt;
                                }
                                else if($payment_details[0]->payment_head_name == "Discount" || $payment_details[0]->payment_head_name == "Add_fee")
                                {
                                    $tot_fee = $payment_details[0]->discount_tot_amt;
                                }
                                else
                                {
                                    $tot_fee = $payment_details[0]->payment_head_tot_amt;
                                }
                                $total_fees +=$payment_head_fee;
                                $total_vat_amt +=$vat_fee;
                                $total_amt +=$tot_fee;
                                ?>
                                <tr>


                            <td><input type="text" readonly name="fee" value="<?php echo $payment_head_fee; ?>"></td>
                            <td><input type="text" readonly name="vat" value="<?php echo $vat_fee; ?>"></td>
                            <td><input type="text" readonly name="vat_amt" value="<?php echo $tot_fee;?>"></td>

                            </tr>
                            <?php }?>
                        <tr><td><?php echo $total_fees;?></td>
                        <td><?php echo $total_vat_amt;?></td>
                        <td><?php echo $total_amt;?></td>
                       </tr>


                        </div>



                    </table>

                    <input type="submit" value="Save">
                    <input type="button" value="Back" onclick="javascript: window.history.back();">

                </form>

            </div>



        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>



<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<style>
    .removee{cursor:pointer;}
</style>

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- Javascript -->

<script type="text/javascript">
    $(function() {

        $(document).on("click",".payment_receive_date",function(){

            $(this).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            }).datepicker("show");
        });

    });

    function dis_field(s) {
       var id = $("#payment_mode option:selected").text();
        if(id == "Cash" || id ==  "Credit/Debit Card" )
        {
            $('.chk_detail').hide();
        }
        else {
            $('.chk_detail').show();
        }


    }



</script>

