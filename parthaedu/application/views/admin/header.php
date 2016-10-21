<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
     <link rel="shortcut icon" href="<?php echo base_url();?>partheducation/images/favicon.ico">
    <title>ParthaEdu Admin</title>
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/ui.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="<?php echo base_url();?>assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/maps-amcharts/ammap/ammap.min.css" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <script src="<?php echo base_url();?>assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
  </head>
  <!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
  <!-- LAYOUT: Apply "sidebar-collapsed" class to body element to have collapsed sidebar -->
  <!-- LAYOUT: Apply "sidebar-top" class to body element to have sidebar on top of the page -->
  <!-- LAYOUT: Apply "sidebar-hover" class to body element to show sidebar only when your mouse is on left / right corner -->
  <!-- LAYOUT: Apply "submenu-hover" class to body element to show sidebar submenu on mouse hover -->
  <!-- LAYOUT: Apply "fixed-sidebar" class to body to have fixed sidebar -->
  <!-- LAYOUT: Apply "fixed-topbar" class to body to have fixed topbar -->
  <!-- LAYOUT: Apply "rtl" class to body to put the sidebar on the right side -->
  <!-- LAYOUT: Apply "boxed" class to body to have your page with 1200px max width -->

  <!-- THEME STYLE: Apply "theme-sdtl" for Sidebar Dark / Topbar Light -->
  <!-- THEME STYLE: Apply  "theme sdtd" for Sidebar Dark / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltd" for Sidebar Light / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltl" for Sidebar Light / Topbar Light -->
  
  <!-- THEME COLOR: Apply "color-default" for dark color: #2B2E33 -->
  <!-- THEME COLOR: Apply "color-primary" for primary color: #319DB5 -->
  <!-- THEME COLOR: Apply "color-red" for red color: #C9625F -->
  <!-- THEME COLOR: Apply "color-green" for green color: #18A689 -->
  <!-- THEME COLOR: Apply "color-orange" for orange color: #B66D39 -->
  <!-- THEME COLOR: Apply "color-purple" for purple color: #6E62B5 -->
  <!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <img class="img img-responsive" src="../../../images/logo-head.png">
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
           
           
          </div>
          <div class="menu-title">
             
           
          </div>
          <ul class="nav nav-sidebar">
            <li class="nav-active active"><a href="<?php echo base_url();?>index.php/admin/admin/dashboard"><i class="icon-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
            <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/notice"><i class="fa fa-bell"></i><span data-translate="dashboard">Notice</span></a></li>
            <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/exam"><i class="fa fa-bell"></i><span data-translate="dashboard">Exam Notice</span></a></li>
            <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/team"><i class="fa fa-users"></i><span data-translate="dashboard">Team/Faculty</span></a></li>
      <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/album"><i class="fa fa-picture-o"></i><span data-translate="dashboard">Album</span></a></li>
             <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/front_gallery"><i class="fa fa-picture-o"></i><span data-translate="dashboard">Front Gallery</span></a></li>
            <li class="nav-active"><a href="<?php echo base_url();?>index.php/admin/admin/classes"><i class="fa fa-tag"></i><span data-translate="dashboard">Add Class/Course</span></a></li>
            <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/testimonials"><i class="fa fa-comment-o"></i><span data-translate="dashboard"> Testimonials</span></a></li>
            
            <li class="nav-parent nav-active">
              <a href="#"><i class="icon-puzzle"></i><span data-translate="builder">Upload Result</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="<?php echo base_url();?>index.php/admin/admin/test_result">Test Results</a></li>
                
                <li><a href="<?php echo base_url();?>index.php/admin/admin/results">Achievement Results</a></li>
              
              </ul>
            </li>
            
            <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/alumini"><i class="fa fa-user"></i><span data-translate="dashboard"> Alumini</span></a></li>
             <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/time_table"><i class="fa fa-edit"></i><span data-translate="dashboard"> Time-Table</span></a></li>
             <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/newsletter"><i class="fa fa-envelope-o"></i><span data-translate="dashboard"> NewsLetter Subscription</span></a></li>
             <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/contact"><i class="fa fa-question"></i><span data-translate="dashboard"> Contact Enquiries</span></a></li>
             <li class="nav-active">
            <a href="<?php echo base_url();?>index.php/admin/admin/video"><i class="fa fa-file-video-o"></i><span data-translate="dashboard"> Video Gallery</span></a></li>
           
            </ul>
          </div>
          
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <!--<ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
              </ul>-->
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN USER DROPDOWN -->
              <!--<li class="dropdown" id="language-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-globe"></i>
                <span data-translate="Language">Language</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#" data-lang="en"><img src="<?php //echo base_url();?>assets/images/flags/usa.png" alt="flag-english"> <span>English</span></a>
                  </li>
                  <li>
                    <a href="#" data-lang="es"><img src="<?php //echo base_url();?>assets/images/flags/spanish.png" alt="flag-english"> <span>Español</span></a>
                  </li>
                  <li>
                    <a href="#" data-lang="fr"><img src="<?php //echo base_url();?>assets/images/flags/french.png" alt="flag-english"> <span>Français</span></a>
                  </li>
                </ul>
              </li>-->
              <!-- END USER DROPDOWN -->
              <!-- BEGIN NOTIFICATION DROPDOWN -->
              <!--<li class="dropdown" id="notifications-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <span class="badge badge-danger badge-header">6</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left">12 Pending Notifications</p>
                  </li>
                  <li>
                    <ul class="dropdown-menu-list withScroll" data-height="220">
                      <li>
                        <a href="#">
                        <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                        Steve have rated your photo
                        <span class="dropdown-time">Just now</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-heart p-r-10 f-18 c-red"></i>
                        John added you to his favs
                        <span class="dropdown-time">15 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-file-text p-r-10 f-18"></i>
                        New document available
                        <span class="dropdown-time">22 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">40 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-bell p-r-10 f-18 c-orange"></i>
                        Meeting in 1 hour
                        <span class="dropdown-time">1 hour</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-bell p-r-10 f-18"></i>
                        Server 5 overloaded
                        <span class="dropdown-time">2 hours</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-comment p-r-10 f-18 c-gray"></i>
                        Bill comment your post
                        <span class="dropdown-time">3 hours</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">2 days</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="#" class="pull-left">See all notifications</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li>-->
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN MESSAGES DROPDOWN -->
              <!--<li class="dropdown" id="messages-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                8
                </span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left">
                      You have 8 Messages
                    </p>
                  </li>
                  <li class="dropdown-body">
                    <ul class="dropdown-menu-list withScroll" data-height="220">
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo base_url();?>alumini/userpic.jpg" alt="avatar 3">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>Alexa Johnson</strong> 
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo base_url();?>assets/images/avatars/avatar4.png" alt="avatar 4">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>Admin</strong> 
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo base_url();?>assets/images/avatars/avatar5.png" alt="avatar 5">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>Bobby Brown</strong>  
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="<?php echo base_url();?>assets/images/avatars/avatar6.png" alt="avatar 6">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>James Miller</strong> 
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="mailbox.html" class="pull-left">See all messages</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li>-->
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="<?php echo base_url();?>alumini/userpic.jpg" alt="user image">
                <span class="username">Hi, Admin</span>
                </a>
                <ul class="dropdown-menu">
                 <!-- <li>
                    <a href="<?php //echo base_url();?>index.php/admin/admin/profile"><i class="icon-user"></i><span>My Profile</span></a>
                  </li>-->
                
                  <li>
                    <a href="<?php echo base_url();?>index.php/admin/admin/logout"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
             <!-- <li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>-->
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->