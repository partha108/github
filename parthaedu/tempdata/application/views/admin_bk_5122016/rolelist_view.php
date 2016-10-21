<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Role"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Role"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>Role Id</th>
              <th>Role Name</th>
             </tr>
          </thead>
          <tbody>
            <?php foreach($roles as $user):?>
             
            <tr>
              <td><?php echo $user->id;?></td>
              <td ><?php echo $user->role_name?></td>              
                </tr>
            <?php endforeach;?>           
          </tbody>
        </table>        
      </div>
    </div>
     
  </div>
</div>


