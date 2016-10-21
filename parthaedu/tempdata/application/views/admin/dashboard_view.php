
<div id="content" class="span10"> 
  <!-- content starts -->
  
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Home</a> <span class="divider">/</span> </li>
      <li> <a href="#">Dashboard</a> </li>
    </ul>
  </div>
  
  
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Dashboard</h2>
      </div>
      <div class="box-content">
      <div>
      	<?php echo $this->session->flashdata('permission');?>
      </div>
        
      </div>
    </div>
    <!--/span--> 
    
  </div>
  
</div>
