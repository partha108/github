<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Payment </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
         
        <?php if($this->uri->uri_string()=='reports/salarydue')
			{?>
       		 <h2>Salary Due </h2>
             <div style="float:right"><a id="" href="<?php echo base_url()?>index.php/salary/download_file/salary_due.xls">Export As Excel Sheet </a></div>
           <?php }else{ ?>
            <h2>Payment Due </h2>
            <div style="float:right"><a id="" href="<?php echo base_url()?>index.php/salary/download_file/student_due.xls">Export As Excel Sheet </a></div>
           <?php } ?>        
       
      </div>
      
      <div class="box-content">
     
      <?php if($this->uri->uri_string()=='reports/salarydue')
			{
     		 echo form_open_multipart('reports/salarydue', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 			 
			}else{
				echo form_open_multipart('reports/studentdue', array('class' => 'form-horizontal', 'id' => 'showUserFrm')); 
			}
				?> 
       
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
                <span class="help-inline" id="user_message" style="display:none;"></span> </div>
            </div>
            
             <?php if($this->uri->uri_string()!='reports/salarydue')
			{?>
             <div class="control-group" id="user_control">
                  <label class="control-label" for="user">Select Class</label>
                  
                  <div class="controls">
                         <select id="class"  name="class"  onchange="onChangeClass()">
                      <option value="0">--Select Class--</option>
                      <?php  foreach($classlist as $classinfo):?>
                      <option value="<?php echo $classinfo->id;?>" <?php if($class_id==$classinfo->id){ echo "selected";}?>><?php echo $classinfo->name;?></option>
                      <?php endforeach;?>
                    </select>
               </div>
           </div>
           
           <?php } ?>
                                
         
        </form> 
        <span style="color:red;"><?php echo $this->session->flashdata('amount'); ?></span>
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
        
              <th>Sr. No</th>
              <th>Registration No</th>
              <th>Name</th>
              <th>Total Amount</th> 
              <th>Total Paid</th> 
              <th>Total Due</th>             
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
                   
            <?php $count=0; foreach($user as $row){ $count++;?>
            <tr>
              <td><?php echo $count;?></td>
              <td><?php echo $row->registration_no;?></td>
              <td><?php echo $row->name;?></td>
               <td><?php echo number_format(($row->yearly_fees),2);?></td>
              <td><?php echo number_format(($row->paid),2);?></td>
              <td><?php echo number_format(($row->yearlydue),2);?></td>
               <td>
               	<?php if($class_id==0){?>
               <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/salary?payuser=<?php echo $row->user_id?>&year=<?php echo $year?>" > 
      	
      Show Details </a>
      <?php }else{?>
      <a class="btn btn-info" 
      href="<?php echo base_url();?>index.php/fees?payuser=<?php echo $row->user_id?>&class=<?php echo $class_id?>&year=<?php echo $year?>&month_status=all" > 
      	
      Show Details </a>
      <?php }?>
               </td>
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