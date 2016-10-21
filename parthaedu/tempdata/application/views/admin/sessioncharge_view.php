<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#">Session Charge </a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Additional Charges</h2>
      </div>
      <div class="box-content">
       <div><a href="javascript:void(0);" onclick="myaddModal()" class="btn btn-primary">Add</a></div> 
      
      <div><?php echo $this->session->flashdata('message'); ?></div>
            
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr> 
               <th>Session Charges</th>
                <th>Caution Money</th>
               <th>Class</th>   
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
              <td><?php echo $row->caution_amount ;?></td>
               <td><?php echo $row->classname ;?></td>             
              <td>                         
              <a class="btn btn-info" 
          href="javascript:void(0)" onclick="myConcessionModal('<?php echo $row->id;?>','<?php echo $row->amount;?>','<?php echo $row->caution_amount;?>',<?php echo $row->class_id;?>)" 
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
 <?php echo form_open_multipart('sessioncharge/sessioncharge_post', array('class' => 'form-horizontal', 'id' => 'add')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
          
         	 <div class="control-group" id="">
                  <label class="control-label" for="user">Select Class</label>
                  <div class="controls">
                    <select id="class"  name="class"  onchange="onChangeClass()">
                      <option value="0">--Select Class--</option>
                      <?php  foreach($class as $classinfo):?>
                      <option value="<?php echo $classinfo->id;?>"  >
					  	<?php echo $classinfo->name;?>
                      </option>
                      <?php endforeach;?>
                    </select>
               		</div>
           	 </div>
             
              <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Session Charge</label>
              <div class="controls">
              <input type="text" id="amount" name="amount"  />              
              </div>
            </div>
            <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Caution Money</label>
              <div class="controls">
              <input type="text" id="caution_amount" name="caution_amount"  />              
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
 <?php echo form_open_multipart('sessioncharge/sessioncharge_post', array('class' => 'form-horizontal', 'id' => '')); ?>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Edit
    </h3>
  </div>
  <div class="modal-body">
   
          <div style="width:500px;  float:left;">
          
          <div class="control-group" id="">
                  <label class="control-label" for="user">Select Class</label>
                  <div class="controls">
                    <select id="editclass"  name="class"  onchange="onChangeClass()">
                      <option value="0">--Select Class--</option>
                      <?php  foreach($class as $classinfo):?>
                      <option value="<?php echo $classinfo->id;?>" >
					  	<?php echo $classinfo->name;?>
                      </option>
                      <?php endforeach;?>
                    </select>
               		</div>
           	 </div>
              <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Session Charge</label>
              <div class="controls">
              	<input type="text" id="editamount" name="amount"  />
                <input type="hidden" id="editid" name="editid"  />              
              </div>
            </div>
           <div class="control-group"  id="">
              <label class="control-label" for="inputSuccess">Caution Money</label>
              <div class="controls">
              <input type="text" id="edit_caution_amount" name="edit_caution_amount"  />              
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
	function myConcessionModal(id,amount,caution_amount,classid)
	{
		$('#editid').val(id);
		$("#editamount").val(amount);	
		$("#edit_caution_amount").val(caution_amount);	
		$('#editclass option[value="'+classid+'"]').attr('selected','selected');
		
		$('#myConcessionModal').modal('show');
	}
	
	function myaddModal()
	{
		$('#myAddModal').modal('show');
	}
	
	
	
</script>