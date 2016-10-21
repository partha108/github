<div class="span2 main-menu-span">
  <div class="well nav-collapse sidebar-nav">
    <ul class="nav nav-tabs nav-stacked main-menu">
      <li class="nav-header hidden-tablet">Administrator</li>
      <li><a class="ajax-link" href="<?php echo base_url();?>admin/"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
     <!--------------------------------------------------Permission------------------------------------------------- -->
        <li><a class="ajax-link" href="<?php echo base_url();?>add_sub_admin"><i class="icon-star"></i><span class="hidden-tablet"> Add sub admin</span></a></li>
       <!-- <li><a class="ajax-link" href="<?php /*echo base_url();*/?>index.php/add_controller"><i class="icon-star"></i><span class="hidden-tablet"> Add controller</span></a></li>-->

    <li><a class="ajax-link" href="<?php echo base_url();?>permission"><i class="icon-star"></i><span class="hidden-tablet"> Permission</span></a></li>
    <li><a class="ajax-link" href="<?php echo base_url();?>setemail"><i class="icon-wrench"></i><span class="hidden-tablet"> Email Management</span></a></li>
 
    
    <!-- ------------------------------------------------Manage Search------------------------------------------------- -->
      <li class="nav-header hidden-tablet">Manage Search</li>
     <li><a class="ajax-link" href="<?php echo base_url();?>search"><i class="icon-user"></i><span class="hidden-tablet"> Search</span></a></li>

        <!-- ------------------------------------------------Manage Course------------------------------------------------- -->
        <li class="nav-header hidden-tablet">Manage Academic Year</li>
        <li><a class="ajax-link" href="<?php echo base_url();?>academic_year_module"><i class="icon-user"></i>
                <span class="hidden-tablet">Academic Year</span></a>
        </li>

        <li class="nav-header hidden-tablet">Manage Payment Head</li>
        <li><a class="ajax-link" href="<?php echo base_url();?>payment_head"><i class="icon-user"></i>
                <span class="hidden-tablet">Payment Head</span></a>
        </li>

        <li class="nav-header hidden-tablet">Total Amount</li>
       <!-- <li><a class="ajax-link" href="<?php /*echo base_url();*/?>total_amount"><i class="icon-user"></i>
                <span class="hidden-tablet">Total Amount</span></a>
        </li>-->
        <li><a class="ajax-link" href="<?php echo base_url();?>pending_cheque"><i class="icon-user"></i>
                <span class="hidden-tablet">Pending Cheque</span></a>
        </li>

        <li class="nav-header hidden-tablet">Pending Payment</li>
        <li><a class="ajax-link" href="<?php echo base_url();?>pending_list"><i class="icon-user"></i>
                <span class="hidden-tablet">Pending Payment</span></a>
        </li>


        <!-- ------------------------------------------------Manage Course------------------------------------------------- -->
       <li class="nav-header hidden-tablet">Manage Course</li>
     <li><a class="ajax-link" href="<?php echo base_url();?>course_module"><i class="icon-user"></i><span class="hidden-tablet"> Course</span></a></li>

      <!-- -------------------------------Manage Subject------------------------------------------------- -->    
       <li class="nav-header hidden-tablet">Manage Subject</li>
     <li><a class="ajax-link" href="<?php echo base_url();?>subject_module"><i class="icon-user"></i><span class="hidden-tablet"> Subject</span></a></li>
 
	<!-- ------------------------------------------------Manage Students------------------------------------------------ -->         
     <li class="nav-header hidden-tablet">Manage Student</li>
   	 <li><a class="ajax-link" href="<?php echo base_url();?>addstudent"><i class="icon-user"></i></i><span class="hidden-tablet">Add Student</span></a></li>
<!--        <!--<li><a class="ajax-link" href="--><?php /*//echo base_url();*/?><!--addstudent/multiple_registration_view"><i class="icon-user"></i></i><span class="hidden-tablet">Add Multiple Student</span></a></li>-->
     <li><a class="ajax-link" href="<?php echo base_url();?>studentlist"><i class="icon-user"></i></i><span class="hidden-tablet">Student List</span></a></li>
     <!--  <li><a class="ajax-link" href="<?php echo base_url();?>student_registration_error"><i class="icon-user"></i></i>
     <span class="hidden-tablet">Mutiple Student Registration Error</span></a></li>
      <li class="nav-header hidden-tablet">Student Payment Management</li> 
      <li><a class="ajax-link" href="<?php echo base_url();?>fees"><i class="icon-briefcase"></i><span class="hidden-tablet">Student Payment</span></a></li>
  <li><a class="ajax-link" href="<?php echo base_url();?>reports/studentdue"><i class="icon-star"></i><span class="hidden-tablet">Student Payment Due</span></a></li>
  
   -->    <!-- <li class="nav-header hidden-tablet">Student Fees Management</li>    
   <li><a class="ajax-link" href="<?php echo base_url();?>fees_module"><i class="icon-star"></i><span class="hidden-tablet">Student Fees</span></a></li>
   <li><a class="ajax-link" href="<?php echo base_url();?>concession"><i class="icon-star"></i><span class="hidden-tablet">Concession</span></a></li>
   <li><a class="ajax-link" href="<?php echo base_url();?>specialfees"><i class="icon-star"></i><span class="hidden-tablet">Special Fees</span></a></li>
  <li><a class="ajax-link" href="<?php echo base_url();?>latepayment"><i class="icon-star"></i><span class="hidden-tablet">Fine For latepayment</span></a></li>
   <li><a class="ajax-link" href="<?php echo base_url();?>concession/concessionandspecial">
    <i class="icon-star"></i></i><span class="hidden-tablet">Concession And Special Fees</span></a></li>   
    <li class="nav-header hidden-tablet">Manage Additional charges</li>
   <li><a class="ajax-link" href="<?php echo base_url();?>sessioncharge"><span class="hidden-tablet">Additional Charge</span></a></li>
    
    <li class="nav-header hidden-tablet">Manage Teacher</li>     
     <li><a class="ajax-link" href="<?php echo base_url();?>addteacher"><i class="icon-user"></i></i><span class="hidden-tablet">Add Teacher</span></a></li>
     <li><a class="ajax-link" href="<?php echo base_url();?>teachertlist"><i class="icon-user"></i></i><span class="hidden-tablet">Teacher List</span></a></li>
      <li><a class="ajax-link" href="<?php echo base_url();?>subadmin"><i class="icon-star"></i><span class="hidden-tablet"> Staff List</span></a></li>
 	<li class="nav-header hidden-tablet">Teacher Payment Management</li>   
   <li><a class="ajax-link" href="<?php echo base_url();?>salary"><i class="icon-briefcase"></i><span class="hidden-tablet">Salary </span></a></li>
  
   <li><a class="ajax-link" href="<?php echo base_url();?>reports/salarydue"><i class="icon-star"></i><span class="hidden-tablet">Salary Due</span></a></li>
 <li><a class="ajax-link" href="<?php echo base_url();?>deductionandincentive">
   <i class="icon-star"></i></i><span class="hidden-tablet">Teacher Deduction And Incentive</span></a></li>  -->
   
    
   
   
  
    <!-- ------------------------------------------------Payment------------------------------------------------- --> 
   
   
   <!--  <li class="nav-header hidden-tablet">Credit Debit</li>   
   <li><a class="ajax-link" href="<?php echo base_url();?>reports/credit_debit"><i class="icon-briefcase"></i><span class="hidden-tablet">Credit Debit </span></a></li>  -->
  
    
  	<!-- ------------------------------------------------Manage Department------------------------------------------------ -->     
    <?php /*?> <li class="nav-header hidden-tablet">Manage Department</li>
      <li><a class="ajax-link" href="<?php echo base_url();?>admin/department"><i class="icon-folder-open"></i><span class="hidden-tablet">Department</span></a></li>
  <?php */?> 
  	<!-- ------------------------------------------------Manage Class------------------------------------------------- -->     
     <li class="nav-header hidden-tablet">Manage Classes</li>
     <li><a class="ajax-link" href="<?php echo base_url();?>class_module"><i class="icon-folder-open"></i><span class="hidden-tablet"> Classes</span></a></li>
     <li><a class="ajax-link" href="<?php echo base_url();?>batch_module"><i class="icon-folder-open"></i><span class="hidden-tablet"> Batch</span></a></li>
    <?php /*?> <li><a class="ajax-link" href="<?php echo base_url();?>admin/section"><i class="icon-folder-open"></i><span class="hidden-tablet"> Section</span></a></li><?php */?>
 
	 <!-- ------------------------------------------------Manage Result------------------------------------------------ -->         
      <!--<li class="nav-header hidden-tablet">Manage Result</li>
     <li><a class="ajax-link" href="<?php //echo base_url();?>admin/result"><i class="icon-folder-open"></i></i><span class="hidden-tablet">Result</span></a></li>-->
     
  
           
    </ul>
  </div>
  <!--/.well --> 
</div>
<!--/span--> 
<!-- left menu ends -->

<noscript>
<div class="alert alert-block span10">
  <h4 class="alert-heading">Warning!</h4>
  <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>
