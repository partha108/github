<style type="text/css">
.print_logo{
	margin:0;
	padding:0;
}
</style>


<input type="button" name="button" id="button" value="Print" style="cursor:pointer" 
                onclick="print_window();" />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px" id="printoption">
  <tr>
    <td  colspan="2" height="5">Office copy </td>
   </tr>
   
   
<tr>
  <td></td>
    <td  colspan="2" height="5"><img src="<?php echo base_url();?>images/logo_print.png" class="print_logo" /></td>
   </tr>

   <tr >
   	<td colspan="2" align="center">
    <table align="center"  width="100%" > 
      <tr>
           <td align="center">TAUHID MISSION</td>                           
      </tr>
      
      <tr>
       <td width="100%" align="center">Registered Under Indian Trust Act</td>                             
      </tr>
      <tr>
       <td width="100%" align="center">Govt. Regd. No. : 00194 of 2010</td>                             
      </tr>
       <tr>
       <td width="100%" align="center">Ukta Pichkuri&nbsp; P.O: Pichkuri &nbsp; Dist:Burdwan</td>                             
      </tr>
         	</table>
   	</td>
   </tr>
   
   
  <tr>
  <td ></td>
  <td >
 	<table align="right"  width="100%" >                
          <tr>  
             <td  align="left" valign="top" style="font-size:12px;"><strong><?php              
                echo strtoupper(date('F',strtotime($invoice_data[0]->paid_month ))).' '.$invoice_data[0]->paid_year;?></strong></td>
                 <td align="left" valign="top" >Invoice No. <?php echo $invoice_data[0]->invoice_no;?></td>  
                <td  align="left" valign="top" style="font-size:12px;color:#ff0000"></td>                    
          </tr>
           <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Payment Date:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo date('d-m-Y', strtotime( $invoice_data[0]->payment_date));?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
              <td  colspan="3"></td>       
          </tr>
          <tr>
              <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
               <td colspan="3" align="left" valign="top" height="5"></td>
           </tr>
              <tr>
                <td align="left" valign="top" style=" font-size:14px">Name:</td>
                 <td  align="left" valign="top" style=" font-size:14px">
                    <?php echo ucfirst($invoice_data[0]->name) ;?></td>
                  <td align="left" valign="top">&nbsp;</td>
             </tr>
             <?php if($invoice_data[0]->role_id==2){?>
             <tr>
                <td  align="left" valign="top" style=" font-size:14px">Registration No.:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->registration_no;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
                                              
            <tr>
                <td  align="left" valign="top" style=" font-size:14px">Class:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->classname;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            
           
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Student Fees:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->studentfees;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Session Charge:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->session_charge;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Security Deposit:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->security_deposit;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <?php } ?>
            
            
           <?php
		    if(count($invoice_data[0]->concession_arr)>0)
				{
					foreach($invoice_data[0]->concession_arr as $rowco)
					{?>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px"><?php if($rowco['chrg_name']!=''){echo $rowco['chrg_name'];}else{ echo "Other Concession";}?></td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $rowco['chrg_amount'];?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>            
            <?php }?>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px"> <?php  if(count($invoice_data[0]->concession_arr)>0){ echo "Total ";}?> Concession</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->totconcession;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr> 
            
            <?php }?>
           
         <?php 		
		 if(count($invoice_data[0]->specialfees_arr)>0)
			{
					foreach($invoice_data[0]->specialfees_arr as $rowsp)
					{?>                    
                  <tr>
                    <td  align="left" valign="top" style=" font-size: 14px"><?php if(isset($rowco['chrg_name'])){if($rowco['chrg_name']!=''){echo $rowco['chrg_name'];}}else{ echo "Other Charges";}?></td>
                    <td  align="left" valign="top" style=" font-size:14px"><?php echo $rowsp['chrg_amount'];?></td>
                    <td align="left" valign="top">&nbsp;</td>
                </tr>                       
            <?php }} ?>
            <tr>
                    <td  align="left" valign="top" style=" font-size: 14px"> <?php  if(count($invoice_data[0]->specialfees_arr)>0){ echo "Total ";}?>Charges:</td>
                    <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->totspecialfees;?></td>
                    <td align="left" valign="top">&nbsp;</td>
                </tr> 
                
          <?php if($invoice_data[0]->role_id==2){?>
            <tr>
                <td walign="left" valign="top" style=" font-size: 14px">Late Fine:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->latefine;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
           
           <?php } ?>
                
             <tr>
                <td walign="left" valign="top" style=" font-size: 14px">Total:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo number_format(($invoice_data[0]->totfees + $invoice_data[0]->latefine),2);?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
           
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Paid:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->paid;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
             <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Due:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->nowdue;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
          </table>
        </td>
        </tr>
   <?php if($invoice_data[0]->role_id==2){?>                  
  <tr>
    <td colspan="3" height="350px"></td>   
  </tr>
  <tr>
    <td colspan="3">Student copy</td>   
  </tr>
  <?php }else{ ?>
   <tr>
    <td colspan="3" height="150px">............................................................................................................................................</td>   
  </tr>
  
  <tr>
    <td colspan="3">Teacher copy</td>   
  </tr>
  <?php } ?>
  
  
  
  
  
  
  
  
   <tr>
    <td  > </td>
    <td align="left"><img src="<?php echo base_url();?>images/logo_print.png" class="print_logo" /></td>
   </tr>
   <tr >
   	<td colspan="2" align="center">
    <table align="center"  width="100%" > 
                  <tr>
                       <td width="100%" align="center">TAUHID MISSION</td>                           
                  </tr>
                  <tr>
                   <td width="100%" align="center">Registered Under Indian Trust Act</td>                             
                  </tr>
                  <tr>
                   <td width="100%" align="center">Govt. Regd. No. : 00194 of 2010</td>                             
                  </tr>
                   <tr>
                   <td width="100%" align="center">Ukta Pichkuri&nbsp; P.O: Pichkuri &nbsp; Dist:Burdwan</td>                             
                  </tr>
         	</table>
   	</td>
   </tr>
   
   
  <tr>
  <td width="15%"></td>
  <td  width="40%">
 	<table align="right"  width="100%" >                
          <tr>  
             <td  align="left" valign="top" style="font-size:12px;"><strong><?php              
                echo strtoupper(date('F',strtotime($invoice_data[0]->paid_month ))).' '.$invoice_data[0]->paid_year;?></strong></td>
                 <td align="left" valign="top" >Invoice No. <?php echo $invoice_data[0]->invoice_no;?></td>  
                <td  align="left" valign="top" style="font-size:12px;color:#ff0000"></td>                    
          </tr>
           <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Payment Date:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo date('d-m-Y', strtotime( $invoice_data[0]->payment_date));?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
          <tr>
              <td  colspan="3"></td>       
          </tr>
          <tr>
              <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
               <td colspan="3" align="left" valign="top" height="5"></td>
           </tr>
              <tr>
                <td align="left" valign="top" style=" font-size:14px">Name:</td>
                 <td  align="left" valign="top" style=" font-size:14px">
                    <?php echo ucfirst($invoice_data[0]->name) ;?></td>
                  <td align="left" valign="top">&nbsp;</td>
             </tr>
             <?php if($invoice_data[0]->role_id==2){?>
             <tr>
                <td  align="left" valign="top" style=" font-size:14px">Registration No.:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->registration_no;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
                                              
            <tr>
                <td  align="left" valign="top" style=" font-size:14px">Class:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->classname;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            
           
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Student Fees:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->studentfees;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Session Charge:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->session_charge;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Security Deposit:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->security_deposit;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <?php } ?>
            
            
           <?php
		    if(count($invoice_data[0]->concession_arr)>0)
				{
					foreach($invoice_data[0]->concession_arr as $rowco)
					{?>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px"><?php echo $rowco['chrg_name'];?></td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $rowco['chrg_amount'];?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>            
            <?php }?>
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px"> <?php  if(count($invoice_data[0]->concession_arr)>0){ echo "Total ";}?> Concession</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->totconcession;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr> 
            
            <?php }?>
           
         <?php 		
		 if(count($invoice_data[0]->specialfees_arr)>0)
			{
					foreach($invoice_data[0]->specialfees_arr as $rowsp)
					{?>                    
                  <tr>
                    <td  align="left" valign="top" style=" font-size: 14px"><?php echo $rowsp['chrg_name'];?></td>
                    <td  align="left" valign="top" style=" font-size:14px"><?php echo $rowsp['chrg_amount'];?></td>
                    <td align="left" valign="top">&nbsp;</td>
                </tr>                       
            <?php }} ?>
            <tr>
                    <td  align="left" valign="top" style=" font-size: 14px"> <?php  if(count($invoice_data[0]->specialfees_arr)>0){ echo "Total ";}?>Charges:</td>
                    <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->totspecialfees;?></td>
                    <td align="left" valign="top">&nbsp;</td>
                </tr> 
                
          <?php if($invoice_data[0]->role_id==2){?>
            <tr>
                <td walign="left" valign="top" style=" font-size: 14px">Late Fine:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->latefine;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
           
           <?php } ?>
                
             <tr>
                <td walign="left" valign="top" style=" font-size: 14px">Total:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo number_format(($invoice_data[0]->totfees + $invoice_data[0]->latefine),2);?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
           
            <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Paid:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->paid;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
             <tr>
                <td  align="left" valign="top" style=" font-size: 14px">Due:</td>
                <td  align="left" valign="top" style=" font-size:14px"><?php echo $invoice_data[0]->nowdue;?></td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
          </table>
        </td>
        </tr>
                    
  <tr>
    <td colspan="3">&nbsp;</td>   
  </tr>
  
  
  
  
</table>

<script>
function print_window()
{
	var divToPrint=document.getElementById("printoption");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
  	
}
</script>
