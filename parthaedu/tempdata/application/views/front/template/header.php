<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from envato.megadrupal.com/html/megacourse/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Feb 2016 05:13:55 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontend_assest/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontend_assest/frontend_assest/frontend_assest/frontend_assest/css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontend_assest/frontend_assest/frontend_assest/css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontend_assest/frontend_assest/css/md-font.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>frontend_assest/css/style.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>Partha Educational Institution</title>
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','../../../connect.facebook.net/en_US/fbevents.js');

fbq('init', '1031554816897182');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1031554816897182&amp;ev=PageView&amp;noscript=1"
/></noscript>
</head>
<body id="page-top" class="home">

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="pre-icon">
            <div class="pre-item pre-item-1"></div>
            <div class="pre-item pre-item-2"></div>
            <div class="pre-item pre-item-3"></div>
            <div class="pre-item pre-item-4"></div>
        </div>
    </div>
    <!-- END / PRELOADER -->

    <!-- HEADER -->
    <header id="header" class="header">
        <div class="container">

            <!-- LOGO -->
            <div class="logo"><a href="#"><img src="<?php echo base_url();?>frontend_assest/images/logo-head.png" alt=""></a></div>
            <!-- END / LOGO -->

            <!-- NAVIGATION -->
            <nav class="navigation">

                <div class="open-menu">
                    <span class="item item-1"></span>
                    <span class="item item-2"></span>
                    <span class="item item-3"></span>
                </div>
                <!-- MENU -->
                <?php
                 if($this->session->userdata('partha'))
                {
                ?>
                <ul class="menu">

                    <li class="current-menu-item"><a href="<?php echo base_url('home');?>">Home</a></li>
                    <li class="menu-item-has-children">
                        <a href="<?php echo base_url();?>home/logout">Logout</a>
                    </li>

                    <!-- <li class="menu-item-has-children">
                        <a href="<?php echo base_url();?>index.php/home/sign_up">Register</a>
                    </li> -->

                </ul>
                
                <?php
            }
            else
            {
            ?>


                <ul class="menu">

                    <li class="<?php if($this->uri->segment(2) == ''){echo 'current-menu-item';} ?>"><a href="<?php echo base_url('index.php/home');?>">Home</a></li>
                    <li class="<?php if($this->uri->segment(2) == 'login'){echo 'current-menu-item';} ?>">
                        <a href="<?php echo base_url();?>home/login">Login</a>
                    </li>
                   
                    <li class="<?php if($this->uri->segment(2) == 'sign_up'){echo 'current-menu-item';} ?>">
                        <a href="<?php echo base_url();?>home/sign_up">Register</a>
                    </li>
                    
                </ul>
                <?php
            }
            ?>
                <!-- END / MENU -->

                <!-- SEARCH BOX -->
                
                <!-- END / SEARCH BOX -->

                <!-- LIST ACCOUNT INFO -->
                <?php 
                            $user_fullname ='';
                           
                            //print_r($this->session->userdata('partha'));

                            if($this->session->userdata('partha'))
                            {
                                $session_data = $this->session->userdata('partha');
                               // print_r($session_data);
                                if(isset($session_data[0]))
                                {
                                    $session_data=$session_data[0];
                                    $user_name = $session_data->student_id;
                                    $pimg = $session_data->profile_image;
                                    $a = $session_data->student_id;
                                    $user_fullname = $session_data->first_name.' '. $session_data->last_name; 
                                }
								 $pro_img = $this->common_model->edit_subject_payment_details_model('student_profile_image','student_id',$a);
                           // echo $user_fullname;
                           

                    
                            ?>
                <ul class="list-account-info">                   

                    <li class="list-item account">
                        <div class="account-info item-click">
                           
               
                    <img src="<?php echo base_url();?>uploads/profile_image/<?php echo $pro_img[0]->img_name;?>">

                        </div>
                        <div class="toggle-account toggle-list">
                            <ul class="list-account">
                                <li><a href="<?php echo base_url('home/st_dashboard'); ?>">
                                <i class="fa fa-tachometer margin-right"></i>Dashboard</a></li>
                                
                            </ul>
                        </div>
                    </li>


                </ul>
                <?php
                }
                    ?>
                <!-- END / LIST ACCOUNT INFO -->

            </nav>
            <!-- END / NAVIGATION -->

        </div>
    </header>
    <!-- END / HEADER -->