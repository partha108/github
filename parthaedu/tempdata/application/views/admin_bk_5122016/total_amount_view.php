<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Total Amount</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Total Amount</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
        <?php if(!empty($payment_head)){ ?>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
          <thead>
            <tr>
            <th>Sl No</th>
            <th>Payment Head</th>
            <th>Total Amount</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
            </tr>
          </thead>
          <tbody>
          <tr>
           <th>1</th>
           <th>Exam Fees</th>
           <td><?php
                  foreach ($exam_fee as $ef) {
                      @$total_amount =  $ef->exam_fee;

                      foreach($paid as $p_amt){
                      @$paid_amout = $p_amt->exam_fee;
                      echo $total_amount;
                      @$due_amount= $total_amount - $p_amt->exam_fee;
                }}?>
            </td>
              <td><?php if($paid_amout == ''){echo '0';}else{echo $paid_amout; }?></td>
              <td><?php echo @$due_amount; ?></td>
           </tr>

           <tr>
           <th>2</th>
           <th>Reg Fees</th>
           <td><?php
                  foreach ($reg_fee as $ref) {
                      @$total_amount = $ref->course_reg_fee;
                      foreach($reg_paid as $r_paid){
                     @$paid_amout = $r_paid->course_reg_fee;
                      echo @$total_amount;
                          @$due_amount= $total_amount - $r_paid->course_reg_fee;

                }}?>
            </td>
               <td><?php if($paid_amout == ''){echo '0';}else{echo $paid_amout; } ?></td>
               <td><?php echo @$due_amount; ?></td>
           </tr>

         <tr>
           <?php
           $count = 2;
           foreach($payment_head as $ph)
           {

           echo     @$payment_id = $ph->payment_id;
                @$pa = $this->common_model->add_course_data('tbl_subject_patment_head_detail','payment_head',$payment_id);
                @$ins = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_head_name',$payment_id);
           //print_r($ins);
               @$p_id = $ins[0]->payment_head_name;
                @$ins_sum_result = $this->common_model->sum_payment_head_amt('tbl_add_course_to_student_payment_details','payment_head_amt','payment_head_name',$p_id,'payment_status','paid','payment_status','1');
           @$sub_result = $this->common_model->add_total_sub_data('tbl_add_course_to_student_payment_details','*','payment_id',$payment_id,'payment_status','paid','payment_status','1');
         echo $sub_amt = $sub_result[0]->payment_head_amt;
          // print_r($ins_sum_result);
           //$data['ist'] = $this->common_model->add_total_amt_data('tbl_add_course_to_student_payment_details','payment_head_amt','payment_status','paid');
               // print_r($pa);
                @$count = $count+1;
                @$ammount=$this->common_model->sum_insurance($ph->payment_id);
             // print_r($ammount);
          ?>
          <td><?php echo $count; ?></td>

          <th><?php echo $ph->payment_head_name;?></th>
              <td>
                  <?php
                  if($ammount[0]->payment_head_amt)
                  {
                    $total_amount = $ammount[0]->payment_head_amt;
                    $due_amount= 0;
                    
                    echo $total_amount;
                  }
                  else
                      {echo '0';}
                  ?>
              </td>
             <td><?php if($ins_sum_result[0]->payment_head_amt == ''){echo '0';}else {echo $ins_sum_result[0]->payment_head_amt;} ?></td>
             <td><?php echo $total_amount - $sub_amt; ?></td>
          </tr>      
           
          <?php
           }}else{
          ?>
          <table class="table table-striped table-bordered bootstrap-datatable">
              <thead>
              <tr>
                  <th>Sl No</th>
                  <th>Payment Head</th>
                  <th>Total Amount</th>
                  <th>Paid Amount</th>
                  <th>Due Amount</th>
              </tr>
              </thead></table>
<?php
}?>

           
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

