
        <div class="page-content">
          <div class="header">
            <h2><strong>Add Video</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
              
                <li><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="active">Video Gallery</li>
              </ol>
            </div>
          </div>
        
          <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-file-excel-o"></i> <strong>Add Video</strong> </h3>
                </div>
                <div class="panel-content">
               
             <div class="col-md-12">
                <?php echo form_open_multipart("admin/admin/add_video",array("class"=>"form-horizontal"));?>
                  
                    <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Enter Title" />
                    </div>
                    <div class="form-group">
                    <input type="url" name="url" class="form-control" placeholder="Enter URL or Upload Video Below" />
                    </div>
                     <div class="form-group">
                    <input type="file" name="file" class="form-control" placeholder="" />
                    <small class="text-success">Upload only mp4 File</small>
                    </div>
                    
                    
                  
                
                  
                   <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Add Video</button>
                  
                  </div>
                <?php echo form_close();?>
			  </div>

                 
               
           <hr/>
                  <div class="filter">
                    <table class="table table-dynamic">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>File URL</th>
                           
                          <!--<th>Upload Date</th>-->
                          
                        
                         
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i=1;foreach($video as $stud){?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $stud->title;?></td>
                        <td><?php if($stud->url=="")
						{
							echo $stud->url;
						}
						else
						{
							echo "Video File";
						}?></td>
                    	 
                         
                         
                          <td>
                          
                          <a href="<?php echo $stud->id;?>" class="btn btn-sm btn-danger resdelete"><i class="fa fa-trash-o"></i></a></td>
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
    <div id="quickview-sidebar">
      <div class="quickview-header">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
          <li><a href="#notes" data-toggle="tab">Notes</a></li>
          <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
        </ul>
      </div>
      <div class="quickview">
        <div class="tab-content">
          <div class="tab-pane fade active in" id="chat">
            <div class="chat-body current">
              <div class="chat-search">
                <form class="form-inverse" action="#" role="search">
                  <div class="append-icon">
                    <input type="text" class="form-control" placeholder="Search contact...">
                    <i class="icon-magnifier"></i>
                  </div>
                </form>
              </div>
              <div class="chat-groups">
                <div class="title">GROUP CHATS</div>
                <ul>
                  <li><i class="turquoise"></i> Favorites</li>
                  <li><i class="turquoise"></i> Office Work</li>
                  <li><i class="turquoise"></i> Friends</li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FAVORITES</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar13.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On the road again...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar5.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">Alexa Johnson</div>
                      <div class="user-txt">Still at the beach</div>
                    </div>
                    <div class="user-status">
                      <i class="away"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar10.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On stage...</div>
                    </div>
                    <div class="user-status">
                      <i class="busy"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FRIENDS</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar7.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">James Miller</div>
                      <div class="user-txt">At work...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar11.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Fred Smith</div>
                      <div class="user-txt">Waiting for tonight</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar8.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Ben Addams</div>
                      <div class="user-txt">On my way to NYC</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="chat-conversation">
              <div class="conversation-header">
                <div class="user clearfix">
                  <div class="chat-back">
                    <i class="icon-action-undo"></i>
                  </div>
                  <div class="user-details">
                    <div class="user-name">James Miller</div>
                    <div class="user-txt">On the road again...</div>
                  </div>
                </div>
              </div>
              <div class="conversation-body">
                <ul>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:38pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Hi you!</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:45pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Are you there?</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:51pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Send me a message when you come back.</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="conversation-message">
                <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
                <div class="item-footer clearfix">
                  <div class="footer-actions">
                    <i class="icon-rounded-marker"></i>
                    <i class="icon-rounded-camera"></i>
                    <i class="icon-rounded-paperclip-oblique"></i>
                    <i class="icon-rounded-alarm-clock"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="notes">
            <div class="list-notes current withScroll">
              <div class="notes ">
                <div class="row">
                  <div class="col-md-12">
                    <div id="add-note">
                      <i class="fa fa-plus"></i>ADD A NEW NOTE
                    </div>
                  </div>
                </div>
                <div id="notes-list">
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="detail-note note-hidden-sm">
              <div class="note-header clearfix">
                <div class="note-back">
                  <i class="icon-action-undo"></i>
                </div>
                <div class="note-edit">Edit Note</div>
                <div class="note-subtitle">title on first line</div>
              </div>
              <div id="note-detail">
                <div class="note-write">
                  <textarea class="form-control" placeholder="Type your note here"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings">
            <div class="settings">
              <div class="title">ACCOUNT SETTINGS</div>
              <div class="setting">
                <span> Show Personal Statut</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Picture</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="title">CHAT</div>
              <div class="setting">
                <span> Show User Image</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Fullname</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Unread Count</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="title">STATISTICS</div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 1</div>
                  <div class="chart-number">82%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
                </div>
              </div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 2</div>
                  <div class="chart-number">43%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
                </div>
              </div>
              <div class="m-t-30" style="width:100%">
                <canvas id="setting-chart" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN SEARCH -->
    
    <!-- END SEARCH -->
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script>
		$(document).ready(function(){
			$(".resdelete").click(function(e){ e.preventDefault();
				var id=$(this).attr('href');
				$(this).closest("tr").remove();
				 $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/admin/admin/class_del/"+id,
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