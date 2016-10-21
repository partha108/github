
            <div class="page-content">

                <div class="page page-profile">

                   
                            <div class="col-md-4">

                                <!-- tile -->
                                <section class="tile tile-simple">

                                    <!-- tile widget -->
                                    <div class="tile-widget p-30 text-center">

                                        <div class="thumb thumb-xl">
                                            <img class="img-circle" src="../../../partheducation/images/logo-head.png" alt="">
                                        </div>
                                        <h4 class="mb-0"><strong>Partha</strong> Education</h4>
                                        <span class="text-muted">Admin</span>
                                        

                                    </div>
                                    <!-- /tile widget -->

                                    <!-- tile body -->
                                    <div class="tile-body text-center bg-blue p-0">

                                        <ul class="list-inline tbox m-0">
                                            <li class="tcol p-10">
                                                <h2 class="m-0">4</h2>
                                                <span class="text-transparent-white">Courses</span>
                                            </li>
                                            <li class="tcol bg-blue dker p-10">
                                                <h2 class="m-0">1000</h2>
                                                <span class="text-transparent-white">Students</span>
                                            </li>
                                            <li class="tcol p-10">
                                                <h2 class="m-0">300</h2>
                                                <span class="text-transparent-white">Results</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- /tile body -->

                                </section>
                                <!-- /tile -->


                                <!-- tile -->
                                
                                <!-- /tile -->

                                <!-- tile -->
                                
                                <!-- /tile -->

                                <!-- tile -->
                                
                                <!-- /tile -->


                            </div>
                            <!-- /col -->






                            <!-- col -->
                            <div class="col-md-8">

                                <!-- tile -->
                                <section class="tile tile-simple">

                                    <!-- tile body -->
                                    <div class="tile-body p-0">

                                        <div role="tabpanel">

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs tabs-dark" role="tablist">
                                                <li role="presentation" class="active"><a href="#feedTab" aria-controls="feedTab" role="tab" data-toggle="tab">Change Password</a></li>
                                                <li role="presentation"><a href="#feedTab1" aria-controls="feedTab" role="tab" data-toggle="tab">Modal Setting</a></li>
                                                <li role="presentation"><a href="#feedTab3" aria-controls="feedTab" role="tab" data-toggle="tab">Slider Images</a></li>
                                                
                                                  <li role="presentation"><a href="#feedTab5" aria-controls="feedTab" role="tab" data-toggle="tab">Index Gallery slider</a></li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">

                                                <div role="tabpanel" class="tab-pane active" id="feedTab">
<h3>Change Your Admin Password </h3>
                                                    <form method="post" action="" id="changepass">
                    <div class="form-group">
                      <label class="sr-only" for="inputName">Name</label>
                      <input type="password" class="form-control" id="old" name="old" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="inputEmail">Email</label>
                      <input type="password" class="form-control"  name="new" id="new" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="inputPassword">Password</label>
                      <input type="password" class="form-control" name="cnew" id="cnew"
                      placeholder="Confirm Password"><br/>
                        <b class="text-danger" id="error"></b>
                    </div>
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Change Password</button>
                  </form>

                                                </div>
                                                
                                                <div role="tabpanel" class="tab-pane" id="feedTab1">
                                                
                                                
<h3>Change Your ModalBox Front Display Image</h3>

                     <?php echo form_open_multipart("admin/admin/changemodal");?>
                 
                    <div class="form-group">
                    
                      <label class="sr-only" for="inputPassword">Change Modal Image</label>
                      <input <?php if($m->status=="yes"){echo 'checked';}?> type="checkbox" name="show" value="show" /> Show/Hide Modal Box Image <hr/>
                      <input type="file" class="form-control" name="file"><br/>
                      <input type="hidden" name="oldfile" value="<?php echo $m->image;?>" /><br/>
                       <img class="img img-responsive" src="<?php echo base_url();?>images/<?php echo $m->image;?>" style="width:20%; height:20%;" />  
                    </div>
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Change Image</button>
                  <?php echo form_close();?>
                                                </div>

                                                 <div role="tabpanel" class="tab-pane" id="feedTab3">
                                                
                                                
<h3>Slider Images</h3>
			
                     <?php echo form_open_multipart("admin/admin/bannerchange");?>
                 
                    <div class="form-group">
                    
                      
                      <img class="img img-responsive" src="<?php echo base_url();?>images/<?php echo $banner1->image;?>" style="width:20%; height:20%;" />
                      <input type="file" class="form-control" name="slide1"><small class="text-success">Banner Image 1</small><br/>
                       <img class="img img-responsive" src="<?php echo base_url();?>images/<?php echo $banner2->image;?>" style="width:20%; height:20%;" />
                       <input type="file" class="form-control" name="slide2"><small class="text-success">Banner Image 2</small><br/>
                        <img class="img img-responsive" src="<?php echo base_url();?>images/<?php echo $banner3->image;?>" style="width:20%; height:20%;" />
                        <input type="file" class="form-control" name="slide3"><small class="text-success">Banner Image 3</small><br/>
                      <input type="hidden" name="oldfile1" value="<?php echo $banner1->image;?>" />  
                       <input type="hidden" name="oldfile2" value="<?php echo $banner2->image;?>" />  
                        <input type="hidden" name="oldfile3" value="<?php echo $banner3->image;?>" />  
                    </div>
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Change Image</button>
                  <?php echo form_close();?>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="feedTab4">
                                                
                                                
<h3>Change Your ModalBox Front Display Image</h3>

                     <?php echo form_open_multipart("admin/admin/sidebarimage");?>
                 
                    <div class="form-group">
                    
                      <label class="sr-only" for="inputPassword">Change Modal Image</label>
                      
                      <input type="file" class="form-control" name="file"><br/>
                      <img class="img img-responsive" style="width:20%; height:20%;" src="<?php echo base_url();?>images/<?php echo $sidebar->image;?>" />
                      <input type="hidden" name="sidebarold" value="<?php echo $sidebar->image;?>" />  
                    </div>
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Change Image</button>
                  <?php echo form_close();?>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="feedTab5">
                                                
                                                
<h3>Slider Images</h3>
			
                     <?php echo form_open_multipart("admin/admin/indexslider");?>
                 
                    <div class="form-group">
                    
                      
                      
                       <input type="file" class="form-control" name="afile[]"><small class="text-success">(800 by 600)</small><br/>
                       
                     
                      
                    </div>
                    
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add Image</button>
                  <?php echo form_close();?>
                    <table class="table table-condensed">
                    	<thead><tr><th>S.No.</th><th></th><th>Remove</th></tr></thead>
                        <tbody>
                        <?php $u=1;foreach($frontslider as $sl){?>
                        <tr><td><?php echo $u;?></td>
         <td><img style="width:20%; height:10%;" class="img img-responsive" src="<?php echo base_url();?>album/<?php echo $sl->image;?>" /></td>
         <td><a class="rdelete" href="<?php echo $sl->id;?>"><i class="fa fa-trash-o"></i></a></td></tr>
                        <?php $u++;}?>
                        </tbody>
                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /tile body -->

                                </section>
                                <!-- /tile -->

                            </div>
                            <!-- /col -->











                       

                </div>
                
            </div>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->














        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
    <script>
		$(document).ready(function(){ //alert("afs");
		
			$(".rdelete").click(function(e){ e.preventDefault();
				var id=$(this).attr('href');
				$(this).closest("tr").remove();
				 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/frontsliderdelete/"+id,
                        data: { id : id } 
                    }).done(function(data){
                   //  alert(data);
						//$("#streams").html(data);	
                    });			
			});
			
			$(".showw").click(function(){ alert("fsads");
				
			});
			$("#changepass").submit(function(e){ e.preventDefault();
				if($("#new").val()!=$("#cnew").val())
				{
					$("#error").html("Your Password Doesnot Match.");
					return false;
				}
				var formdata=$(this).serialize();
				$.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/changepass.php",
                        data: { formdata : formdata} 
                    }).done(function(data){
                      // alert(data);
						$("#error").html(data);	
                   });
			});
		});
	</script>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    
    <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="<?php echo base_url();?>assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="<?php echo base_url();?>assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="<?php echo base_url();?>assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="<?php echo base_url();?>assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="<?php echo base_url();?>assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="<?php echo base_url();?>assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="<?php echo base_url();?>assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="<?php echo base_url();?>assets/plugins/charts-chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/builder.js"></script> <!-- Theme Builder -->
    <script src="<?php echo base_url();?>assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="<?php echo base_url();?>assets/js/application.js"></script> <!-- Main Application Script -->
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="<?php echo base_url();?>assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="<?php echo base_url();?>assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="<?php echo base_url();?>assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPTS -->
    <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="<?php echo base_url();?>assets/js/pages/table_dynamic.js"></script>
    <!-- END PAGE SCRIPTS -->
  </body>
</html>