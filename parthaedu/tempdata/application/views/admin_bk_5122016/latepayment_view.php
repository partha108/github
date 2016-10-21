<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Late Payment </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Late Payment</h2>
      </div>
      <div class="box-content">
      <!-- <div><a href="javascript:void(0);" onclick="myaddModal()" class="btn btn-primary">Add</a></div>--> 
      
      <div><?php echo $this->session->flashdata('message'); ?></div>
            
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr> 
               <th>Amount</th>
               <th>Last Date</th>   
               <th>Process</th>      
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
				if(isset($latepayment))
				{
					foreach($latepayment as $row){
			?>
            <tr>            
              <td><?php echo $row->amount ;?></td>
              <td><?php echo $row->end_date ;?></td>
              <td><?php echo $row->process ;?></td>               
              <td>                         
              <a class="btn btn-info" 
          href="javascript:void(0)" onclick="myConcessionModal('<?php echo $row->id;?>','<?php echo $row->amount;?>','<?php echo $row->end_date?>','<?php echo $row->process?>')" 
                  > Edit</a>  
                 <?php /*?> <a class="btn btn-danger" 
                  href="javascript:void(0)" onclick="deleteitem('<?php echo $row->id;?>')" 
                  > Delete</a><?php */?>                                         
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


<!--------------------------------------------------------------------Other charge --------------------------------------------------------->
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('latepayment/latepayment_post', array('class' => 'form-horizontal', 'id' => 'add')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
              <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Amount</label>
              <div class="controls">
              <input type="text" id="amount" name="amount"  />              
              </div>
            </div>
           
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">End Date</label>
              <div class="controls">
                <select id="end_date" name="end_date">
                <option value="0">Select Date</option>
                <?php for($i=1; $i<=28;$i++){ ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
                </select>
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Process</label>
              <div class="controls">
               <select id="process" name="process">
                <option value="perday">Per Day</option>
                <option value="permonth">Per Month</option>
               </select>             
              </div>
            </div>
            
             
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  >Add</button>
  </div>
  </form>
</div>

<!----------------------------------------------------------------Concession------------------------------------------------------------>
<div class="modal hide fade" id="myConcessionModal" style="width:1000px; left:40%"> 
 <?php echo form_open_multipart('latepayment/latepayment_post', array('class' => 'form-horizontal', 'id' => '')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
              <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Amount</label>
              <div class="controls">
              	<input type="text" id="editamount" name="amount"  />
                <input type="hidden" id="editid" name="editid"  />              
              </div>
            </div>
           
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">End Date</label>
              <div class="controls">               
              <select id="editend_date" name="end_date">
                <option value="0">Select Date</option>
                <?php for($i=1; $i<=28;$i++){ ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
               </div>
            </div>
            
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Process</label>
              <div class="controls">
               <select id="editprocess" name="process">
                <option value="perday">Per Day</option>
                <option value="permonth">Per Month</option>
               </select>             
              </div>
            </div>
            
                        
           </div> 
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary"  onclick="validation_();" >Save</button>
  </div>
  </form>
</div>

<script src="<?php echo base_url();?>custom_script/common_validation.js"></script>
<script language="javascript" type="text/javascript">
	function myConcessionModal(id,amount,enddate,process)
	{
		$('#editid').val(id);
		$("#editamount").val(amount);	
		$("#editend_date option[value='"+enddate+"']").attr("selected", "selected");		 
		 $("#editprocess option[value='"+process+"']").attr("selected", "selected");
		$('#myConcessionModal').modal('show');
	}
	
	function myaddModal()
	{
		$('#myAddModal').modal('show');
	}
	
	function deleteitem(id)
{
	var base_url='<?php echo base_url();?>'; 
	var id=id;
	var tablename='latepayment';
	var column='id';
	var page='latepayment';
	if(confirm('Are you sure do you want to Delete it?')){
			window.location = base_url+'index.php/latepayment/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
		}
	
}
	
</script>