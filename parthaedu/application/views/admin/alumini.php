        <div class="page-content">
          <div class="header">
            <h2><strong>Alumini Registrations</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
              
                <li><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="active">Alumini</li>
              </ol>
            </div>
          </div>
        
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-user"></i> <strong>Alumini</strong> </h3>
                </div>
                <div class="panel-content">
                <?php if($this->session->flashdata('msg')){?>
                <div class="alert alert-info"><p><?php echo $this->session->flashdata('msg');?></p></div>
                <?php }?>
                <?php if($this->uri->segment(4)){?>
                <h2>update information for <strong class="text-success"><?php echo $one->name;?></strong></h2>
                <div id="regform">
								<?php echo form_open_multipart('admin/admin/alumini_edit/'.$this->uri->segment(4),array("class"=>"form-horizontal"));?>
									  <div class="form-group">
										<input type="text" value="<?php echo $one->name;?>" class="form-control" style="height: 35px;" name="name" placeholder="Name:" required>
									</div>
                                      
                                     <div class="form-group">
                                    <b class="text-success">Select Gender</b>&nbsp;&nbsp;&nbsp;
										<input class="form-control" <?php if($one->gender=="male"){echo "checked";}?> type="radio"  name="gender" value="male" required> Male&nbsp;&nbsp;&nbsp;
                                        <input class="form-control" <?php if($one->gender=="male"){echo "checked";}?> type="radio"  name="gender" value="female" required> Female
									</div>
                                  
								  <div class="form-group">
										<input class="form-control" value="<?php echo $one->dob;?>" type="date"  style="border:1px solid #FC6;height: 35px; width:100%;" name="dob" required>
                                        <small class="text-success">Date Of Birth</small>
									</div>
                                    
                                      <div class="form-group">
										<input class="form-control" value="<?php echo $one->email;?>" type="text" style="height: 35px;" name="email" required placeholder="Email:">
									</div>
                                    <div class="form-group">
										<input class="form-control" value="<?php echo $one->mobile;?>" type="text" maxlength="10" style="height: 35px;" required name="mobile" placeholder="Mobile:">
									</div>
                                      <div class="form-group">
										<input class="form-control" type="file" style="height: 35px;" name="file">
                                        <input type="hidden" name="oldfile" value="<?php echo $one->image;?>" />
                                        <small class="text-success">Upload Profile Image</small>
									</div>
                                   
									  <div class="form-group">
										<!-- Single button -->
										<select  style="height: 35px;" name="year" required>
                                       <option value="">Year of Completing XII</option>
                                       <option value="<?php echo $one->com_year;?>" selected="selected"><?php echo $one->com_year;?></option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                         
                                             <option value="2015">2015</option>
                                              <option value="2014">2014</option>
                                               <option value="2013">2013</option>
                                               <option value="2012">2012</option>
                                               <option value="2011">2011</option>
                                                 
                                           
                                        </select>
									</div>
									<!-- EDU2 DROP DOWN DES END -->
									  <div class="form-group">
										<input class="form-control" value="<?php echo $one->cur_address;?>" type="text" name="cur_address" required style="height: 35px;" placeholder="Current Address">
									</div>
                                      <div class="form-group">
										<input class="form-control" value="<?php echo $one->res_address;?>" type="text" name="res_address" required style="height: 35px;" placeholder="Residential Address">
									</div>
                                    <h5>Educational Details</h5>
                                      <div class="form-group">
										<input class="form-control" value="<?php echo $one->ins_afterten;?>" type="text" name="after_ten" style="height: 35px;" placeholder="Institute Joined After XII">
									</div>
                                     <div class="form-group">
										<input class="form-control" value="<?php echo $one->course;?>" type="text" name="course_taken" style="height: 35px;" required placeholder="Course Taken">
									</div>
                                     <div class="form-group">
										<input class="form-control" value="<?php echo $one->school;?>" type="text" name="school" style="height: 35px;" required placeholder="School From Which XII completed">
									</div>
                                     <div class="form-group">
										<input class="form-control" value="<?php echo $one->board;?>" type="text" name="board" style="height: 35px;" required placeholder="Board">
									</div>
                                      <div class="form-group">
										<input class="form-control" type="text" value="<?php echo $one->percent;?>" name="percent" style="height: 35px;" placeholder="% Marks Obtained in XII">
									</div>
                                    <h5>Personal Details</h5>
                                     <div class="form-group">
										<input class="form-control" type="text" value="<?php echo $one->father;?>" name="father" style="height: 35px;" placeholder="Father Name">
									</div>
                                      <div class="form-group">
										<input class="form-control" type="text" name="foc" value="<?php echo $one->father_oc;?>" style="height: 35px;" placeholder="Father Occupation">
									</div>
                                      <div class="form-group">
										<input class="form-control" type="text" name="mother" value="<?php echo $one->mother;?>" style="height: 35px;" placeholder="Mother Name">
									</div>
                                      <div class="form-group">
										<input class="form-control" value="<?php echo $one->mother_oc;?>" type="text" name="moc" style="height: 35px;" placeholder="Mother Occupation">
									</div>
                                     <div class="form-group">
										<textarea name="about" rows="3" required placeholder="Remarks About Partha" style="width:100%;border:1px solid #FC6;"><?php echo $one->remark;?></textarea>
									</div>
                                    
                                  
                                     <div class="form-group">
										<textarea name="message" rows="5"  placeholder="Write Your Message(Please mention your name , Mobile no in the context)" style="width:100%; border:1px solid #FC6;"><?php echo $one->message;?></textarea>
									</div>
                                    
									<button type="submit" class="btn btn-warning" style="height: 40px; padding:5px 13px;" name="submit">Update</button>
								<?php echo form_close();?>
                                </div>
                <?php }?>
                <h4>Send Message</h4>
             <?php 
			   echo form_open("admin/admin/contact_msg_alu",array("class"=>"form-horizontal"));?>
                  
                    <div class="form-group">
                     <select name="mobile[]" multiple="multiple" class="form-control">
                    	
                         <option value="">Select One or Multiple Contacts</option>
                    <?php foreach($alum as $stu){
						?><option value="<?php echo $stu->mobile;?>"><?php echo $stu->name." [". $stu->mobile."]";?></option>
                        <?php }?>
                    </select>
                    </div>
                  
                    
                     <div class="form-group">
                    <textarea rows="3" class="form-control" name="message" placeholder="type message here"></textarea>
                    </div>
                  
                
                  
                   <div class="form-group">
                   <button type="submit" name="submit" class="btn btn-default">Send Message</button>
                  
                  </div>
                <?php echo form_close();?>
               <hr/>
                             

                 
               
          
                  <div class="filter-left">
                    <table class="table table-dynamic">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Thumb</th>
                          <th>Name/DOB</th>
                         
                          <th>Email</th>
                           <th>Mobile</th>
                          <!--<th>Upload Date</th>-->
                          <th>XII Compl.Year</th>
                          
                         
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i=1;foreach($alum as $stud){?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td style="width:100px;"><img class="img img-responsive" src="<?php echo base_url();?>alumini/<?php echo $stud->image;?>" /></td>
                        <td><?php echo $stud->name;?><br/>
                     DOB- <?php echo $stud->dob;?></td>
                          <td><?php echo $stud->email;?></td>
                          <td><?php echo $stud->mobile;?></td>
                        
                         <td><?php echo $stud->com_year;?></td>
                          <td> 
                          <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal<?php echo $i;?>">
                          View</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $i;?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $stud->name;?> Details</h4>
        </div>
        <div class="modal-body">
          <table class="table table-condensed">
          	<tbody>
            	<tr><th>Current Address</th><td><?php echo $stud->cur_address;?></td></tr>
                <tr><th>Residential Address</th><td><?php echo $stud->res_address;?></td></tr>
                <tr><th>Inst Joined After XII</th><td><?php echo $stud->ins_afterten;?></td></tr>
                <tr><th>Course Applied</th><td><?php echo $stud->course;?></td></tr>
                <tr><th>School/Board</th><td><?php echo $stud->school."<br/>".$stud->board;?></td></tr>
                <tr><th>Percent Scored</th><td><?php echo $stud->percent;?></td></tr>
                <tr><th>Father Name/Occupation</th><td><?php echo $stud->father."<br/>".$stud->father_oc;?></td></tr>
                <tr><th>Mother Name/Occupation</th><td><?php echo $stud->mother."<br/>".$stud->mother_oc;?></td></tr>
                <tr><th>Remark About Partha</th><td><?php echo $stud->remark;?></td></tr>
                <tr><th>Message</th><td><?php echo $stud->message;?></td></tr>
                
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<a href="<?php echo base_url();?>index.php/admin/admin/alumini/<?php echo $stud->id;?>" class="btn btn-sm btn-warning">Edit</a>
                          <?php if($stud->status=="" || $stud->status=="unapprove"){?>
                            <a href="<?php $stud->id;?>" class="btn btn-sm btn-success approve">approve</a> <?php }else{?>
                            <a href="<?php echo $stud->id;?>" class="btn btn-sm btn-warning approve">unapprove</a> <?php }?><a href="<?php echo $stud->id;?>" class="btn btn-sm btn-danger resdelete"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                <?php $i++;}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2016 </span>
                <span>ParthaEducation</span>.
                <span>All rights reserved. </span>
              </p>
              <!--<p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>-->
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN BUILDER -->
      
      <!-- END BUILDER -->
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
    
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN SEARCH -->
    
    <!-- END SEARCH -->
    <!-- BEGIN PRELOADER -->
    
    <!-- END PRELOADER -->
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script>
		$(document).ready(function(){ 
			
			$(".approve").click(function(e){ e.preventDefault();
				var id=$(this).attr('href');
				if($(this).text()=="approve")
				{
					$(this).text("unapprove");
					var st="approve";
					$.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/alumini_approve/"+id+"/"+st,
                        data: { id : id } 
                    }).done(function(data){
                    /// alert(data);
						//$("#streams").html(data);	
                    });	
				}
				else
				{
					$(this).text("approve");
					var st="unapprove";
					$.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/alumini_approve/"+id+"/"+st,
                        data: { id : id } 
                    }).done(function(data){
                   // alert(data);
						//$("#streams").html(data);	
                    });	
				}
				
				
			});
			
			$(".resdelete").click(function(e){ e.preventDefault();
				var id=$(this).attr('href');
				$(this).closest("tr").remove();
				 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/alumini_delete/"+id,
                        data: { id : id } 
                    }).done(function(data){
                   //  alert(data);
						//$("#streams").html(data);	
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