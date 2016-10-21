<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Current Deduction And Incentive </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Current Deduction and Incentive</h2>
      </div>
      <div class="box-content">
           
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>              
              <th>User ID</th> 
              <th>Name</th>             
              <!-- <th>Incentive</th>
               <th>Deduction</th>-->             
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($user_list))
				{
					foreach($user_list as $row){
			?>
            <tr>
             <td><?php echo $row->user_id ;?></td>
             <td><?php echo $row->name;?></td>
             <?php /*?> <td><?php echo $row->specialfee ;?></td>
              <td><?php echo $row->concession ;?></td><?php */?>
              <td>             
                  <a class="btn btn-info" 
                  href="<?php echo base_url();?>index.php/deductionandincentive/deduction?id=<?php echo $row->user_id;?>" >
                   Deduction</a> 
                  <a class="btn btn-info" 
                  href="<?php echo base_url();?>index.php/deductionandincentive/incentive?id=<?php echo $row->user_id;?>" >
                   Incentive </a>  
                   </td>
            </tr>
            <?php } } ?>
            
          </tbody>
        </table>
      </div>
    </div>
    <!--/span--> 
  </div>
  <!--/row--> 
  <!-- content ends --> 
</div>



<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>

<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">
	

</script>