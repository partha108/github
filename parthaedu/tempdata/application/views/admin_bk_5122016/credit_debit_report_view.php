<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Credit Debit</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Credit Debit</h2>
       
         <div style="float:right"><a id="" href="<?php echo base_url()?>index.php/salary/download_file/credit_debit.xls" > Export As Excel Sheet </a></div>
      </div>
      <div class="box-content">
      
     <?php echo form_open_multipart('reports/credit_debit', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); ?> 
       
       <div class="control-group" id="user_control">
              <label class="control-label" for="user">Select Year</label>
              <div class="controls">
                  <select id="year" name="year" onchange="onChangeClass()"  >
                  <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($yearlist); $y++){  
				  ?>
                  <option value="<?php echo $yearlist[$y];?>" <?php if($yearlist[$y]== $year){echo "selected"; } ?> > 
				 		 <?php echo $yearlist[$y];?>
                  </option>
                 <?php }?>
                </select>    
                
                  <select id="month" name="month" onchange="onChangeClass()"  >
                  <option value="0">--Select Month--</option>
                  <?php  for($y=1; $y<=count($monthlist); $y++){  
				  ?>
                  <option value="<?php echo $y;?>" <?php if($y== $month){echo "selected"; } ?> > 
				 		 <?php echo $monthlist[$y];?>
                  </option>
                 <?php }?>
                </select>
                </div>    
                
            </div>
             <div class="control-group" id="user_control">
                  <label class="control-label" for="">To</label>
                  
                  <div class="controls">
                     <select id="toyear" name="toyear" onchange="onChangeClass()"  >
                  <option value="0">--Select Year--</option>
                  <?php  for($y=0; $y<count($yearlist); $y++){  
				  ?>
                  <option value="<?php echo $yearlist[$y];?>" <?php if($yearlist[$y]== $toyear){echo "selected"; } ?> > 
				 		 <?php echo $yearlist[$y];?>
                  </option>
                 <?php }?>
                </select>            
               
               
                <select id="tomonth" name="tomonth" onchange="onChangeClass()"  >
                  <option value="0">--Select Month--</option>
                  <?php  for($y=1; $y<=count($monthlist); $y++){  
				  ?>
                  <option value="<?php echo $y;?>" <?php if($y== $tomonth){echo "selected"; } ?> > 
				 		 <?php echo $monthlist[$y];?>
                  </option>
                 <?php }?>
                </select>  
                
                </div>  
                
           </div>
        </form> 
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable" id="printdiv">
          <thead>
            <tr>
        	  <th>Sr No.</th>
              <th>Credit</th>
              <th>Debit</th>
              <th>Profit</th>
            <!--  <th>Payment For The Month</th>
              <th>Collected Month</th>-->
            </tr>
          </thead>
          <tbody>  
            <?php $count=0;
				foreach($credit_debit as $row){ 
				$count++; 
				$month=date("m",strtotime($row->created_date));
				?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo number_format(($row->credit),2);?></td>
              <td><?php echo number_format(($row->debit),2);?></td>
              <td><?php echo number_format(($row->profit),2);?></td> 
              <?php /*?><td><?php echo date('F', mktime(0, 0, 0, $row->paid_month, 1)); ?></td>              
              <td><?php echo date('F', mktime(0, 0, 0, $month, 1)); ?></td><?php */?>                          
             </tr>             
             <?php } ?>
             
              <?php if(isset($totalcredit_debit[0]))
			{ ?>
            <tr> 
            	 <td></td>
            	<td ><strong>Total Credit</strong></td>
                <td ><strong>Total Debit</strong></td>
                <td ><strong>Total Profit</strong></td>
                <td colspan="2"></td>
            </tr>
            <tr>
              <td></td>
              <td ><?php echo number_format(($totalcredit_debit[0]->totcredit),2);?></td>
              <td><?php echo number_format(($totalcredit_debit[0]->totdebit),2);?></td>
              <td><?php echo number_format(($totalcredit_debit[0]->totprofit),2);?></td> 
              <td colspan="2"></td>              
                                       
             </tr>
            <?php } ?>
             
             
             
             
          </tbody>
        </table>
        
        
       
        
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>
<script>
function onChangeClass()
{	
	$("#showUserFrm").submit();	
}



</script>