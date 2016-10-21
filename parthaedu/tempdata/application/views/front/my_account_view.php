<div class="my_account_bg">
  <div class="container">
   <div class="my_account_box clearafter">
   <div class="search_year">
   <label>Select Year :</label>
    
    <?php echo form_open_multipart('home/my_account', array('class' => 'form-horizontal', 'id' => 'showUserFrm'));?>
          <select id="year" name="year" onchange="changeYear(this.value);" >
           <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($year); $y++){  
				  ?>
            <option value="<?php echo $year[$y];?>" <?php if($year[$y]== $crnt_year){echo "selected"; } ?> ?> <?php echo $year[$y];?></option>
                 <?php }?>
           </select>  
        </form>
        </div><!--search_year-->
 
<div class="account_table"> 
         
   <table >
          <thead>
            <tr class="table_head">
               <th>No.</th>
               <th>Month</th>              
               <th>Total Amount</th>               
               <th>Paid</th>
               <th>Due</th>
               <th>Due Reason</th>
               <th>Salary Slip</th> 
               <th>Payment Date</th> 
               <th>Payable</th> 
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table_tbody">
            <?php 
				$count=0; //echo "<pre>"; print_r($user_list);exit;
				
					foreach($user_list as $row){
						$count++;
			?>
           
            <tr >
             <td><?php echo $count ;?></td>
            <td><?php echo $row['full_month'] ;?></td>
              <td><?php echo number_format(($row['totfees']),2) ;?></td>
              <td><?php echo $row['paid'] ;?></td>
              <td><?php echo $row['due']; ?></td>
               <td><?php echo $row['due_reason']; ?></td>
              <td><?php echo $row['invoice_no']; if($row['invoice_no']!=''){?>
              <a href="javascript:void(0)" onclick="print_window('<?php echo base_url();?>index.php/home/invoice_print/<?php echo $row['invoice_no']?>')"
               title="Print" target="_blank" >
              <img src="<?php echo base_url();?>admin_design/print.png"  height="20px" width="20px"/>
              </a>
              <a href="<?php echo base_url();?>index.php/reports/invoice_generate/<?php echo $row['invoice_no']?>"
               title="Export As Doc" target="_blank" >
              <img src="<?php echo base_url();?>uploads/document/img_download.jpg"  height="20px" width="20px"/>
              </a>
              <?php } ?>
              </td>
               <td><?php echo $row['payment_date'] ;?></td>
                <td><?php echo number_format(($row['payable']),2) ;?></td>
              <td>
              </td>
              
            </tr>
            <?php } ?>
                      
          </tbody>
        </table>
   </div><!--account_table-->
   
 
   
   <script>
  	function print_window(url)
	{
		var divToPrint=document.getElementById("printoption");
	   newWin= window.open(url);
	   newWin.document.write(divToPrint.outerHTML);
	   newWin.print();
	   newWin.close();	
	}

	function changeYear(year){
			
		document.getElementById("showUserFrm").submit();
	}

   </script>
   
   
   </div><!--login_box-->
  </div><!--container-->
</div>
<!-- END BANNER --> 
