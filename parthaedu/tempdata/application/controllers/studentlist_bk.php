<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class studentlist extends CI_Controller {
	
	 private $user_name='';
	 private $user_fullname='';
	 private $user_role = 0;
	 private $user_email='';
	 private $user_id='';
	 
	 public function __construct()
	 {
		 parent::__construct();
		 $this->load->database();
		 $this->load->library('session');
		 $this->load->model('pagination_model');
		 $this->load->library('encrypt');
		 $this->load->helper('url');
		 $this->load->helper('form');
		 $this->load->library('form_validation');
		 $this->load->library('email');
		 $this->load->model('fees_model');
		 $this->load->library('image_lib');
		 $this->load->helper('email');
		 $this->load->model('common_model');
		 $this->load->library('pagination');
		 $this->load->library('encrypt');
		 $this->load->library('dompdf_gen');
		 $this->load->library('excel');

		 if ($this->session->userdata('schoolbolpur_admin')) {
			 $session_data = $this->session->userdata('schoolbolpur_admin');
			 if (isset($session_data[0])) {
				 $session_data = $session_data[0];
				 $this->user_name = $session_data->username;
				 $this->user_fullname = $session_data->first_name . ' ' . $session_data->last_name;
				 $this->user_role = $session_data->role_id;
				 $this->user_email = $session_data->email;
				 $this->user_id = $session_data->id;
			 }
		 } else {
			 redirect('authenticate', 'refresh');
		 }
	 }
	
	public function index()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}

		$url='';
		$search='';
		$search='';
		$str='';
		$and='&';

		@$page=$this->input->get('page');
		if($page>0)
		{
			$str.='page='.$page;
			$data['page']=$page;
			$data['page_str']='page='.$page;
		}
		else
		{
			$page = 1;
			$str.='page='.$page;
			$data['page']=$page;
			$data['page_str']='page='.$page;


		}


		$per_page=$this->input->get('per_page');
		if($per_page>0)
		{
			if(trim($str))
			{
				//$str.=$and.'per_page='.$per_page;
				$data['per_page']=$per_page;
				$data['per_page_str']='&per_page='.$per_page;

			}
			else
			{
				//$str.='per_page='.$per_page;
				$data['per_page']=$per_page;
				$data['per_page_str']='&per_page='.$per_page;
			}
		}
		else
		{
			$per_page =100;
			if(trim($str))
			{

				// $str.=$and.'per_page='.$per_page;
				$data['per_page']=$per_page;
				$data['per_page_str']='&per_page='.$per_page;

			}
			else
			{
				// $str.=$and.'per_page='.$per_page;
				$data['per_page']=$per_page;
				$data['per_page_str']='&per_page='.$per_page;
			}

		}

		$cur_page = $page;
		$page -= 1;
		$per_page =  $per_page;
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$start = $page * $per_page;
		$str1='';


		// $data['payment_details']=$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_status','pending');
		$data['student_detail']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start=$start,$end=$per_page,$where_in_array=array());
		$data['payment_det_count']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
		$count=count($data['payment_det_count']);
		$data['count']=$count;
		$show_data=count($data['payment_det_count']);

		if(count($count)>0)
		{

			/* --------------------------------------------- */
			$no_of_paginations = ceil($count / $per_page);
			/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
			$msg='';
			if ($cur_page >= 7)
			{
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
					$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6)
				{
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				}
				else
				{
					$end_loop = $no_of_paginations;
				}
			}
			else
			{
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
			/* ----------------------------------------------------------------------------------------------------------- */
			$msg .= "<div class='pagination1'><ul>";

			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1)
			{
				$msg .= "<a href='$url?page=1&per_page=$per_page$str1'><li p='1' class='active'  onclick='page_func(1)'>First</li>";
			}
			else if ($first_btn)
			{
				$msg .= "<li class='inactive'>First</li>";
			}

			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1)
			{
				$pre = $cur_page - 1;
				$msg .= "<a href='$url?page=$pre&per_page=$per_page$str1'><li p='$pre' class='active'  onclick='page_func($pre)'>Previous</li></a>";
			}
			else if ($previous_btn)
			{
				$msg .= "<li class='inactive'>Previous</li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++)
			{

				if ($cur_page == $i)
					$msg .= "<a href='$url?page=$i&per_page=$per_page$str1'><li p='$i' style='color:#fff;background-color:#2BB34B;' class='active'  onclick='page_func($i)'>{$i}</li></a>";
				else
					$msg .= "<a href='$url?page=$i&per_page=$per_page$str1'><li p='$i' class='active'  onclick='page_func($i)'>{$i}</li></a>";
			}

			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations)
			{
				$nex = $cur_page + 1;
				$msg .= "<a href='$url?page=$nex&per_page=$per_page$str1'><li p='$nex' class='active' onclick='page_func($nex)'>Next</li></a>";
			}
			else if ($next_btn)
			{
				$msg .= "<li class='inactive'>Next</li>";
			}

			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations)
			{
				$msg .= "<a href='$url?page=$no_of_paginations&per_page=$per_page$str1'><li p='$no_of_paginations' class='active'  onclick='page_func($no_of_paginations)'>Last</li></a>";
			}
			else if ($last_btn)
			{
				$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
			}
			/*$goto = "";
            $total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
            $total_string.= "<span class='total'>Showing ".$count ." of ".$show_data ." entries-<b></span>";
            $msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination*/
			$data['msg']=$msg;
		}

			//$data['student_detail']=	$this->common_model->selectAll('tbl_student');
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/studentlist_view',$data);
			$this->load->view('admin/template/admin_footer');

	}

	function add_course_model($id)
	{
		@$data['s'] = $this->common_model->course($id);
		$this->load->view('admin/add_subject_course_ajax',$data);

	}
	function add_class($id)
	{
		$ac_year = $_REQUEST['acc_value'];

		$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('course_reg_fee'), $where=array(),
			$where_or=array(),
			$like=array(
				'academin_year'=>$ac_year,
				'replace_course'=>$id
			),
			$like_or=array(),$order=array());
		$tax=$data_tax[0]->course_reg_fee;
		echo json_encode(array("amount" =>$tax));

		@$data['s'] = $this->common_model->add_class_model($id,$ac_year);
		$this->load->view('admin/add_student_course_class_ajax',$data);

	}

	function add_subject($id)
	{
		echo $acc_year = $_REQUEST['acc_value'];
		echo $course_value = $_REQUEST['course_value'];

		@$data['s'] = $this->common_model->add_subject_model($id,$acc_year,$course_value);
		$this->load->view('admin/add_student_course_subject_ajax',$data);
	}

	function add_batch($id)
	{
		$acc_year = $_REQUEST['acc_value'];
		$course_value = $_REQUEST['course_value'];
		@$data['s'] = $this->common_model->add_batch_model($id,$acc_year,$course_value);
		$this->load->view('admin/add_student_course_batch_ajax',$data);
	}

	function add_subject_fees($id)
	{
		$acc_year = $_REQUEST['acc_value'];
		$course_value = $_REQUEST['course_value'];
		$class_value = $_REQUEST['class_value'];
	}

	function add_reg_amount()
	{
		$reg_amount = 	$_REQUEST['course_id'];
		$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('course_reg_fee'), $where=array(),
						$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->course_reg_fee;
		echo json_encode(array("amount" =>$tax));
	}
	


	function add_reg_amt_vat()
	{
		$reg_amount = 	$_REQUEST['course_id'];
		$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('vat'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->vat;
		echo json_encode(array("amount" =>$tax));
	}

	function add_reg_vat_amt()
	{
		$reg_amount = 	$_REQUEST['course_id'];
		$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('vat_amt'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->vat_amt;
		echo json_encode(array("amount" =>$tax));
	}
	function add_reg_total_amt()
	{
		$reg_amount = 	$_REQUEST['course_id'];
		$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('total_amt'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->total_amt;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_fee()
	{
		$class_id = 	$_REQUEST['class_id'];
		$acc_year = $_REQUEST['acc_value'];


		$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('exam_fee'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->exam_fee;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_vat()
	{
		$class_id = 	$_REQUEST['class_id'];
		$acc_year = $_REQUEST['acc_value'];


		$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('vat'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->vat;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_vat_amt()
	{
		$class_id = 	$_REQUEST['class_id'];
		$acc_year = $_REQUEST['acc_value'];


		$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('vat_amt'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->vat_amt;
		echo json_encode(array("amount" =>$tax));

	}

	function add_exam_tot_amt()
	{

		$class_id = 	$_REQUEST['class_id'];
		$acc_year = $_REQUEST['acc_value'];


		$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('tot_amt'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->tot_amt;
		echo json_encode(array("amount" =>$tax));
	}

	function subject_amount()
	{
		$subject_name 		= 	$_REQUEST['sub_id'];
		$acc_year			=	$_REQUEST['acc_value'];
		$course_id			=	$_REQUEST['course_value'];
		$class_id			=	$_REQUEST['class_value'];

		$new_sub_name = explode(",",$subject_name);
		for($i=0;$i<count(array_filter($new_sub_name));$i++)
		{
			$data_tax	=	$this->common_model->common($table_name='tbl_subject',$field=array('subject_fees'), $where=array(),
							$where_or=array(),$like=array('subject_id'=>$new_sub_name[$i],'academic_year'=>$acc_year,'course_name_by_subject'=>$course_id,'class_name'=>$class_id),
							$like_or=array(),$order=array());
			$tax		=	$data_tax[0]->subject_fees;
			echo json_encode(array("total_amount" =>$tax));
		}

	}


	function subject_payment_details()
	{
		$subject_name 		= 	$_REQUEST['sub_id'];
		$data_tax_payment_head	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head'), $where=array(),
									$where_or=array(),$like=array('subject_id'=>$subject_name),
									$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head);
	}

	function add_subject_id()
	{
		$subject_name 			= 	$_REQUEST['sub_id'];
		$data_tax_subject_id	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('subject_id'), $where=array(),
			$where_or=array(),$like=array('subject_id'=>$subject_name),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_subject_id);
	}

	function subject_payment_details_amt()
	{
		$subject_name 				= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_amt'), $where=array(),
										$where_or=array(),$like=array('subject_id'=>$subject_name),
										$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt);
	}

	function subject_payment_details_vat()
	{
		$subject_name 					= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_amt_vat	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_vat'), $where=array(),
			$where_or=array(),$like=array('subject_id'=>$subject_name),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_vat);
	}

	function subject_payment_details_vat_amt()
	{
		$subject_name 						= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_amt_vat_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_vat_amt'), $where=array(),
			$where_or=array(),$like=array('subject_id'=>$subject_name),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_vat_amt);
	}

	function subject_payment_details_total_amt()
	{
		$subject_name 						= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_amt_tot_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('	payment_head_total_amt'), $where=array(),
			$where_or=array(),$like=array('subject_id'=>$subject_name),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_tot_amt);
	}


	function subject_payment_details_to_date()
	{
		$subject_name 					= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_to_date	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_to_dt'), $where=array(),
											$where_or=array(),$like=array('subject_id'=>$subject_name),
											$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_to_date);

	}

	function subject_payment_details_frm_date()
	{
		$subject_name 					= 	$_REQUEST['sub_id'];
		$data_tax_payment_head_frm_date	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_frm_dt'), $where=array(),
											$where_or=array(),$like=array('subject_id'=>$subject_name),
											$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_frm_date);
	}

	public function add_course_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$data['academic_year']=$this->common_model->selectAll('academic_year');
		$data['course']=$this->common_model->selectAll('tbl_course');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_course_to_student',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function add_student_to_course_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$student_id = $id;
		@$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student','student_id',$student_id);

		@$data['stu_details'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		//$data['course_details'] = $this->common_model->add_course_data('tbl_course','course_id',$course_id);
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_course_to_student_view',$data);
		$this->load->view('admin/template/admin_footer');

	}

	public function add_course_to_student()
	{
		$id = $this->input->post('id');
		$acc_year = $this->input->post('add_ac_year');
		$course = $this->input->post('add_course');
		$reg_fee = $this->input->post('reg_fee');
		$reg_fee_vat=$this->input->post('reg_fee_vat');
		$reg_fee_vat_amt= $this->input->post('reg_fee_vat_amt');
		$reg_fee_tot_amt = $this->input->post('reg_fee_tot_amt');
		$class = $this->input->post('add_class');

		$subject = $this->input->post('add_subject');
		$sub_name = implode(',',$subject);
		$new_sub = explode(',',$sub_name);
		$sub_fee = $this->input->post('subject_fee');
		$sub_exam_fee = $this->input->post('exam_reg_fee');
		$sub_exam_vat = $this->input->post('exam_fee_vat');
		$sub_exam_vat_amt = $this->input->post('exam_fee_vat_amt');
		$sub_exam_tot_amt = $this->input->post('exam_fee_tot_amt');

		$batch = $this->input->post('batch_id');
		$p_head_amt= implode(",",$subject);
		$new_payment_amount = explode(",",$p_head_amt);

		$payment_head_detail = $this->input->post('payment_detail');
		$p_head_details= implode(",",$payment_head_detail);
		$new_head_details = explode(",",$p_head_details);
		//print_r($new__head_details);
		$sub_subject_id = $this->input->post('subject_id_detail');
		$payment_head_amt = $this->input->post('payment_detail_amt');
		$payment_head_vat = $this->input->post('payment_detail_vat');
		$payment_head_vat_amt = $this->input->post('payment_detail_vat_amt');
		$payment_head_tot_amt = $this->input->post('payment_detail_tot_amt');

		$payment_head_to_date = $this->input->post('payment_detail_to_date');
		$payment_head_frm_date = $this->input->post('payment_detail_frm_date');


		$data = array(
						'academic_year'=>$acc_year,
						'student_id'=>$id,
						'course_name'=>$course,
						'course_reg_fee'=>$reg_fee,
						'course_fee_vat'=>$reg_fee_vat,
						'course_fee_vat_amt'=>$reg_fee_vat_amt,
						'course_vat_tot_amt'=>$reg_fee_tot_amt,
						'class_name'=>$class,
						'exam_fee'=>$sub_exam_fee,
						'exam_vat'=>$sub_exam_vat,
						'exam_vat_fee'=>$sub_exam_vat_amt,
						'exam_tot_amt'=>$sub_exam_tot_amt
					);

		$this->common_model->insert_data($data,'tbl_add_course_to_student');
		$course_id = $course;

		for($j=0;$j<count(array_filter($new_payment_amount));$j++)
		{
			$data=array(
				//'sub_fee' => $sub_fee[$j],
				'subject_name'=>$subject[$j],
				'batch_name'=>$batch[$j],
				'student_id'=>$id,
				'add_course_id'=>$course_id,

			);
			$this->common_model->insert_data($data,'tbl_add_course_subject_to_student');
		}

		$exam_name = 'Exam Fees';
		$today =  date('Y-m-d');
		$after =  date('Y-m-d', strtotime("+15 days"));


			$data = array(
				'payment_head_name' => $exam_name,
				'exam_fee' => $sub_exam_fee,
				'exam_vat' => $sub_exam_vat,
				'exam_vat_fee' => $sub_exam_vat_amt,
				'exam_tot_amt' => $sub_exam_tot_amt,
				'student_id' => $id,

				'course_id' => $course_id,
				'payment_head_to_date'=>$today,
				'payment_head_frm_date'=>$after,
				'payment_status	' => 'pending'
			);

		$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		$course_name = 'Reg Fees';

			$data = array(
				'payment_head_name' => $course_name,
				'course_reg_fee' => $reg_fee,
				'course_fee_vat' => $reg_fee_vat,
				'course_fee_vat_amt' => $reg_fee_vat_amt,
				'course_vat_tot_amt' => $reg_fee_tot_amt,
				'student_id' => $id,

				'course_id' => $course_id,
				'payment_head_to_date'=>$today,
				'payment_head_frm_date'=>$after,
				'payment_status	' => 'pending'
			);

		$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');


		for ($k = 0; $k < count(array_filter($new_head_details)); $k++)
		{
			$data = array(
					'payment_head_name' 	=> 	$payment_head_detail[$k],
					'payment_head_amt' 		=> 	$payment_head_amt[$k],
					'payment_head_vat' 		=> 	$payment_head_vat[$k],
					'payment_head_vat_amt' 	=> 	$payment_head_vat_amt[$k],
					'payment_head_tot_amt' 	=> 	$payment_head_tot_amt[$k],
					'payment_head_to_date' 	=> 	$payment_head_to_date[$k],
					'payment_head_frm_date' => 	$payment_head_frm_date[$k],
					'student_id' 			=> 	$id,
					'subject_id' 			=> 	$sub_subject_id[$k],
					'course_id' 			=> 	$course_id,
					'payment_status' 		=> 	'pending',
					//'id'=>$last_id
				);

			$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		}

		redirect('studentlist');

	}

	function add_student_edit_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$student_id = $id;
		$data['max_id']				= 	$this->common_model->max_id('tbl_student','student_id');
		$data['student_data'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		$data['class']= $this->common_model->getAllClasses();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();
		$data['student_pro_img'] = $this->common_model->add_course_data('student_profile_image','student_id',$student_id);
		$data['student_mark_sheet_img'] = $this->common_model->add_course_data('mark_sheet_image','student_id',$student_id);

		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_student_edit_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	function edit_student()
	{
		$student_id = $this->input->post('student_id');
		$reg_no = $this->input->post('student_reg_no');
		$roll_no = $this->input->post('student_roll_no');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$student_mobile_number = $this->input->post('student_mobile_number');

		$stream = $this->input->post('stream');
		$gender = $this->input->post('gender');
		$category = $this->input->post('category');
		$dob = $this->input->post('dob');
		$addmission_class = $this->input->post('addmission_class');
		$student_study_status = $this->input->post('student_status');

		$school_name = $this->input->post('school_name');
		$school_timing = $this->input->post('school_timing');
		$week_day = $this->input->post('week_day');
		$board = $this->input->post('board');
		$total_marks = $this->input->post('total_marks');
		$math_marks = $this->input->post('math_marks');
		$phy_marks = $this->input->post('phy_marks');
		$che_marks = $this->input->post('che_marks');
		$bio_marks = $this->input->post('bio_marks');
		$science_marks = $this->input->post('science_marks');
		$school_address = $this->input->post('school_address');

		$father_name = $this->input->post('father_name');
		$father_occupation = $this->input->post('father_occupation');
		$mother_name = $this->input->post('mother_name');
		$mother_occupation = $this->input->post('mother_occupation');
		$father_mobile_no = $this->input->post('father_mobile_no');
		$mother_mobile_no = $this->input->post('mother_mobile_no');

		$address1 = $this->input->post('address1');
		$address2 = $this->input->post('address2');
		$state_name = $this->input->post('state');
		$city = $this->input->post('city');
		$pincode = $this->input->post('pincode');
		$home_number = $this->input->post('home_number');
		$last_logon_time = date('Y-m-d H:i:s');
		$student_status = $this->input->post('student_status');
		$user_name = $first_name . substr($student_mobile_number, 6);
		$img_id = $this->input->post('img_id');
		$img_chk = $this->input->post('mark_sheet');
		$data = array(
			'reg_no' => $reg_no,
			'roll_no' => $roll_no,
			'username' => $user_name,
			'password' => $student_mobile_number,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'student_email' => $email,
			'student_phone_no' => $student_mobile_number,
			'stream' => $stream,
			'gender' => $gender,
			'category' => $category,
			'dob' => date('Y-m-d', strtotime($dob)),
			'enrollment_date' => date('Y-m-d'),
			'addmission_class' => $addmission_class,
			'studying' => $student_study_status,
			'school_name' => $school_name,
			'school_timing' => $school_timing,
			'school_weekoff_day	' => $week_day,
			'board' => $board,
			'total_marks' => $total_marks,
			'che_marks' => $che_marks,
			'math_marks' => $math_marks,
			'bio_marks' => $bio_marks,
			'phy_marks' => $phy_marks,
			'science_marks' => $science_marks,
			'school_address' => $school_address,
			'father_name' => $father_name,
			'father_occupation' => $father_occupation,
			'mother_name' => $mother_name,
			'mother_occupation' => $mother_occupation,
			'guardian_mobile_no' => $father_mobile_no,
			'guardian_phone_no' => $mother_mobile_no,
			'address1' => $address1,
			'address2' => $address2,
			'state' => $state_name,
			'city' => $city,
			'pincode' => $pincode,
			'landline_no' => $home_number,
			'status' => $student_status,
			'last_logon_time' => $last_logon_time,
			'student_list_date' => date('Y-m-d'),
		);
		//print_r($data);exit;
		$this->common_model->update_data($data, 'tbl_student', 'student_id', $student_id);
		//print_r();exit;
		foreach ($_FILES['profile_pic']['tmp_name'] as $key => $value) {
			$file_name[] = $key . $_FILES['profile_pic']['name'][$key];
			$file = $key . $_FILES['profile_pic']['name'][$key];
			$file_size = $_FILES['profile_pic']['size'][$key];
			$file_tmp = $_FILES['profile_pic']['tmp_name'][$key];
			$file_type = $_FILES['profile_pic']['type'][$key];
			$new_name1 = str_replace(".", "", microtime());
			$new_name = str_replace(" ", "_", $new_name1);
			$ext = substr(strrchr($file, '.'), 1);
			if ($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif") {
				move_uploaded_file($file_tmp, "uploads/profile_image/" . $new_name . "." . $ext);
				if (($_FILES['profile_pic']['name'][$key])) {
					$original_image_file_name = $new_name . "." . $ext;
					$jobseeker_id = $this->session->userdata('jobseeker_id');
					$doc_data = array(
						"student_id" => $student_id,
						"img_name" => $new_name . "." . $ext,
						//"upload_date"=>date("Y-m-d"),
					);
					$this->common_model->update_data($doc_data, 'student_profile_image', 'student_id', $student_id);

				} else {
					$this->session->set_flashdata("message", "Field Is Missing !");
					//redirect('index.php/user_management/doctor_list');
				}
			} else {
				$this->session->set_flashdata("message", "Only .jpeg, .jpg, .gif, .png File Supported !Field Is Missing !");
				//redirect('index.php/user_management/doctor_list');
			}
		}
		//print_r($_FILES['mark_sheet']);exit;
		if($img_chk != "") {
			$this->common_model->delete_img_data('mark_sheet_image', 'student_id', $student_id, 'mark_sheet_image_id', $img_id);
		}
		foreach($_FILES['mark_sheet']['tmp_name'] as $key => $value )
		{

			$file_name[] = $key.$_FILES['mark_sheet']['name'][$key];
			$file=$key.$_FILES['mark_sheet']['name'][$key];
			$file_size =$_FILES['mark_sheet']['size'][$key];
			$file_tmp =$_FILES['mark_sheet']['tmp_name'][$key];
			$file_type=$_FILES['mark_sheet']['type'][$key];
			$new_name1 = str_replace(".","",microtime());
			$new_name=str_replace(" ","_",$new_name1);
			$ext=substr(strrchr($file,'.'),1);
			if($ext=="jpeg" || $ext=="jpg" || $ext=="png" || $ext=="gif")
			{
				move_uploaded_file($file_tmp,"uploads/".$new_name.".".$ext);
				if(($_FILES['mark_sheet']['name'][$key]))
				{
					$original_image_file_name =$new_name.".".$ext;
					$jobseeker_id=$this->session->userdata('jobseeker_id');
					$doc_data=array(
						"student_id"=>$student_id,
						"marks_sheet_name"=>$new_name.".".$ext,
						//"upload_date"=>date("Y-m-d"),
					);
					echo "<pre>";print_r($doc_data);
					$this->common_model->insert_data($doc_data,'mark_sheet_image','student_id',$student_id);


				}
				else
				{
					$this->session->set_flashdata("message","Field Is Missing !");
					//redirect('index.php/user_management/doctor_list');
				}
			}
			else
			{
				$this->session->set_flashdata("message","Only .jpeg, .jpg, .gif, .png File Supported !Field Is Missing !");
				//redirect('index.php/user_management/doctor_list');
			}
		}

		redirect('studentlist');
	}


	function add_student_to_payment_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$student_id = $id;

		@$data['stu_details'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		//print_r($data['stu_details']);exit;
		@$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','student_id',$student_id);
		//echo $data['details'][0]->payment_status;
		//echo $data['details'][0]->payment_id;
		//print_r($data['details']);
		//$data['st_d']= $this->common_model->add_course_data('tbl_add_course_to_student','student_id',$student_id)	;
//print_r($data['st_d']);


		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_student_to_payment_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function receive_payment_model($id)
	{
		$student_id = $id;

		$st_id 				= 	explode('_',$student_id);
		$data['rec_no']		=	$this->common_model->max_id('tbl_add_course_to_student_payment_details','recepit_no');
		$data['ak_no']		= 	$this->common_model->max_id('tbl_add_course_to_student_payment_details','ack_no');

		for($i=0;$i<count(array_filter($st_id));$i++)
		{
			//echo "<pre>";
			@$data['details'][] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_id',$st_id[$i]);
			@$rec_status =  $data['details'][$i][0]->payment_status;
			@$mode_status =  $data['details'][$i][0]->check_status;
			//done

		}
		if($rec_status == 'paid' || $mode_status == '1' )
		{
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/receive_status_student_payment');
			$this->load->view('admin/template/admin_footer');
		}
		// not done
		else if($rec_status != 'paid' || $mode_status != '1' )
		{
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/receive_student_payment', $data);
			$this->load->view('admin/template/admin_footer');
		}

	//payment done


	}

	function receive_payment_status()
	{
		$mal_data['email_data'] = $this->common_model->selectAll('tblemail');
		$admin_mail = $mal_data['email_data'][0]->from_email;
		$id = $this->input->post('payment_id');

		$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
		$rec_no = $st_data['st_detail'][0]->recepit_no;
		$student_id = $st_data['st_detail'][0]->student_id;
		$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
		//print_r($st_data['st_detail']);
		$student_email = $st_data['st_detail'][0]->student_email;
		$iid = explode("_", $id);
		//print_r($iid);
		$payment_date = $this->input->post('payment_receive_date');
		$payment_mode = $this->input->post('payment_mode');
		$payment_check_no = $this->input->post('check_no');
		$payment_bank_name = $this->input->post('bank_name');
		$payment_check_status = $this->input->post('check_status');
		$receipt_no = $this->input->post('recipt_no');
		$ack_no = $this->input->post('ack_no');
		if ($payment_mode == 'paid' && $payment_check_status == '0')
		{
			for ($i = 0; $i < count($iid); $i++)
			{
				$data = array(
					'payment_date' => $payment_date,
					'payment_mode' => 'cash',
					'check_no' => $payment_check_no,
					'bank_name' => $payment_bank_name,
					'check_status' => $payment_check_status,
					'recepit_no' => $receipt_no,
					'payment_status' => 'paid'
				);
				//print_r($data);
				$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $receipt_no);
			$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/confirmation', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			$this->email->from('admin@parthaedu.com');
			$this->email->to($student_email);
			$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			echo $this->email->print_debugger();

		}
		//clear
		if ($payment_mode == 'paid' && $payment_check_status == '1')
		{
			for ($i = 0; $i < count($iid); $i++)
			{
				$data = array(
					'payment_date' => $payment_date,
					'payment_mode' => 'chaque',
					'check_no' => $payment_check_no,
					'bank_name' => $payment_bank_name,
					'check_status' => $payment_check_status,
					'recepit_no' => $receipt_no,
					'payment_status' => 'paid'
				);
				//print_r($data);
				$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $receipt_no);
			$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/confirmation', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			$this->email->from('admin@parthaedu.com');
			$this->email->to($student_email);
			$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			echo $this->email->print_debugger();
		}
	//inprocess
		if ($payment_mode == 'paid' && $payment_check_status == '3')
		{
			//inprocess
			for ($i = 0; $i < count($iid); $i++)
			{
				$data = array(
						'payment_date' => $payment_date,
						'payment_mode' => 'chaque',
						'check_no' => $payment_check_no,
						'bank_name' => $payment_bank_name,
						'check_status' => $payment_check_status,
						'ack_no' => $ack_no,
						'payment_status' => 'pending'
					);
				//print_r($data);
				$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','ack_no',$ack_no);
			$this->email->set_mailtype("html");
				//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/inprocess', $st_data, true);
				//echo "<pre>";print_r($html_subscriber_user);exit;
			$this->email->from('admin@parthaedu.com');
			$this->email->to($student_email);
			$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			echo $this->email->print_debugger();
		} //bounced
		if ($payment_mode == 'paid' && $payment_check_status == '2')
		{
			for ($i = 0; $i < count($iid); $i++)
			{
				$data = array(
					'payment_date' => $payment_date,
					'payment_mode' => 'chaque',
					'check_no' => $payment_check_no,
					'bank_name' => $payment_bank_name,
					'check_status' => $payment_check_status,
					'payment_status' => 'pending'
				);
				//print_r($data);
				$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/bounced', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			$this->email->from($admin_mail);
			$this->email->to($student_email);
			$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			echo $this->email->print_debugger();
		}
exit;
		redirect('studentlist');
	}

	function payment_receipt($id)
	{
		 $payment_id = $id;

		$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_id',$payment_id);
		$rec_no = $data['details'][0]->recepit_no;
		$ack_no = $data['details'][0]->ack_no;
		$data['rec_details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
		$data['ack_details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','ack_no',$ack_no);
		
		

		$rec_no = $data['rec_details'][0]->recepit_no;
		if($rec_no != '')
		{
		$data['details'][0]->recepit_no;
		$this->load->view('admin/payment_receipt_bk',$data);
		}
		else
		{
			$data['details'][0]->ack_no;
		$this->load->view('admin/ack_inprocess_status',$data);
		}
		
	}

	function edit_student_course_view($id)

	{
		@$data['st_data']       =   $this->common_model->selectOne('tbl_add_course_to_student','add_course_id',$id);
		@$data['sub_data']       =   $this->common_model->selectOne('tbl_add_course_subject_to_student','add_course_id',$id);
		@$acc_year               	=   $data['st_data'][0]->academic_year;
		@$course_by              	=   $data['st_data'][0]->course_name;
		@$class_name               	=   $data['st_data'][0]->class_name;
		@$sub_name					=	$data['sub_data'][0]->subject_name;
		@$student_id = $data['sub_data'][0]->student_id;
		@$course_id = $data['sub_data'][0]->add_course_id;

		@$data['academic_year']  =   $this->common_model->selectAll('academic_year');
		@$data['course']         =   $this->common_model->course_edit_subject($acc_year);
		@$data['Classes']        =   $this->common_model->getAllClasses_edit_subject_view($course_by);
		@$data['subject_name']        =   $this->common_model->subject_view($class_name);
		@$data['payment_details'] = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','student_id',$student_id,'course_id',$course_id);
		@$data['sub_details'] = $this->common_model->payment_head_detail('tbl_add_course_subject_to_student','student_id',$student_id,'add_course_id',$course_id);
		//$sub_id = $data['sub_details'][0]->subject_name;
		@$data['s'] = $this->common_model->edit_batch_view($acc_year,$course_by,$class_name);
		//print_r($data['s'] = $this->common_model->edit_batch_view($student_id,$course_id));


		//echo "<pre>";print_r($data['s']);exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/edit_course_to_student',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function edit_course_to_student()
	{
		$id = $this->input->post('student_id');
		$acc_year = $this->input->post('add_ac_year');

		$course = $this->input->post('add_course');
		$reg_fee = $this->input->post('reg_fee');
		$reg_fee_vat = $this->input->post('reg_fee_vat');
		$reg_fee_vat_amt = $this->input->post('reg_fee_vat_amt');
		$reg_fee_tot_amt = $this->input->post('reg_fee_tot_amt');

		$class = $this->input->post('add_class');
		$exam_fee = $this->input->post('exam_reg_fee');
		$exam_fee_vat = $this->input->post('exam_fee_vat');
		$exam_fee_vat_amt = $this->input->post('exam_fee_vat_amt');
		$exam_fee_tot_amt = $this->input->post('exam_fee_tot_amt');

		$subject = $this->input->post('add_subject');
		$sub_name = implode(',',$subject);
		$new_sub = explode(',',$sub_name);

		$sub_id = $this->input->post('subject_id_detail');
		$payment_head_name = $this->input->post('payment_detail');
		$payment_head_amt = $this->input->post('payment_detail_amt');
		$payment_head_vat = $this->input->post('payment_detail_vat');
		$payment_head_vat_amt = $this->input->post('payment_detail_vat_amt');
		$payment_head_tot_amt = $this->input->post('payment_detail_tot_amt');
		$payment_head_to_date = $this->input->post('payment_detail_to_date');
		$payment_head_frm_date = $this->input->post('payment_detail_frm_date');
		$batch = $this->input->post('batch_id');
		$sub_fee = $this->input->post('subject_fee');

		$payment_head_detail = $this->input->post('payment_detail');
		$p_head_details= implode(",",$payment_head_detail);
		$new_head_details = explode(",",$p_head_details);

		$p_head_amt= implode(",",$subject);
		$new_payment_amount = explode(",",$p_head_amt);

		$this->common_model->delete_data('tbl_add_course_to_student','student_id',$id);
		$this->common_model->delete_data('tbl_add_course_subject_to_student','student_id',$id);
		$this->common_model->delete_data('tbl_add_course_to_student_payment_details','student_id',$id);

		$data = array(
			'academic_year'=>$acc_year,
			'student_id'=>$id,
			'course_name'=>$course,
			'course_reg_fee'=>$reg_fee,
			'course_fee_vat'=>$reg_fee_vat,
			'course_fee_vat_amt'=>$reg_fee_vat_amt,
			'course_vat_tot_amt'=>$reg_fee_tot_amt,
			'class_name'=>$class,
			'exam_fee'=>$exam_fee,
			'exam_vat'=>$exam_fee_vat,
			'exam_vat_fee'=>$exam_fee_vat_amt,
			'exam_tot_amt'=>$exam_fee_tot_amt
		);
		//echo "<pre>";print_r($data);
		$this->common_model->insert_data($data,'tbl_add_course_to_student');
		$course_id = $this->db->insert_id();

		for($j=0;$j<count(array_filter($new_payment_amount));$j++)
		{
			$data=array(
				//'sub_fee' => $sub_fee[$j],
				'subject_name'=>$subject[$j],
				'batch_name'=>$batch[$j],
				'student_id'=>$id,
				'add_course_id'=>$course_id,

			);
			//echo "<pre>";print_r($data);


			$this->common_model->insert_data($data,'tbl_add_course_subject_to_student');
		}


		$exam_name = 'Exam Fees';
		$today =  date('Y-m-d');
		$after =  date('Y-m-d', strtotime("+15 days"));


		for($i=0;$i<count(array_filter($new_sub));$i++)
		{
			$data = array(
				'payment_head_name' => $exam_name,
				'exam_fee'=>$exam_fee,
				'exam_vat'=>$exam_fee_vat,
				'exam_vat_fee'=>$exam_fee_vat_amt,
				'exam_tot_amt'=>$exam_fee_tot_amt,
				'student_id' => $id,
				'subject_id' => $subject[$i],
				'course_id' => $course_id,
				'payment_head_to_date'=>$today,
				'payment_head_frm_date'=>$after,
				'payment_status	' => 'pending'
			);
			//echo "<pre>";print_r($data);
			$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');
		}
		$course_name = 'Reg Fees';
		for($l=0;$l<count(array_filter($new_sub));$l++)
		{
			$data = array(
				'payment_head_name' => $course_name,
				'course_reg_fee' => $reg_fee,
				'course_fee_vat' => $reg_fee_vat,
				'course_fee_vat_amt' => $reg_fee_vat_amt,
				'course_vat_tot_amt' => $reg_fee_tot_amt,
				'student_id' => $id,
				'subject_id' => $subject[$l],
				'course_id' => $course_id,
				'payment_head_to_date'=>$today,
				'payment_head_frm_date'=>$after,
				'payment_status	' => 'pending'
			);
			//echo "<pre>";print_r($data);
			$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');
		}


		for ($k = 0; $k < count(array_filter($new_head_details)); $k++)
		{
			$data = array(
				'payment_head_name' 	=> 	$payment_head_detail[$k],
				'payment_head_amt' 		=> 	$payment_head_amt[$k],
				'payment_head_vat' 		=> 	$payment_head_vat[$k],
				'payment_head_vat_amt' 	=> 	$payment_head_vat_amt[$k],
				'payment_head_tot_amt' 	=> 	$payment_head_tot_amt[$k],
				'payment_head_to_date' 	=> 	$payment_head_to_date[$k],
				'payment_head_frm_date' => 	$payment_head_frm_date[$k],
				'student_id' 			=> 	$id,
				'subject_id' 			=> 	$sub_id[$k],
				'course_id' 			=> 	$course_id,
				'payment_status' 		=> 	'pending',
				//'id'=>$last_id
			);
			//echo "<pre>";print_r($data);
			$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		}

		//exit;

		redirect('studentlist');
	}

	function delete_student_course($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}

		$id=trim($this->input->post('deleteid'));
		$this->common_model->delete_data('tbl_add_course_to_student','add_course_id',$id);
		$this->common_model->delete_data('tbl_add_course_subject_to_student','add_course_id',$id);
		$this->common_model->delete_data('tbl_add_course_to_student_payment_details','course_id',$id);


		redirect('studentlist/add_student_to_course_view','refresh');

	}

	function deleteitem()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$id=$_GET['id'];
		$table=$_GET['table'];
		$column=$_GET['column'];
		$page=$_GET['page'];
		$this->common_model->delete_data($table,$column,$id);
		$this->common_model->delete_data('fees_user_class','user_id',$id);
		redirect($page,'refresh');
	}

	function checkuseremailavailability()
	{
		$data=$this->common_model->selectWhere('student','email = "'.$_POST['email'].'"');
		echo json_encode(array('exists'=>$data));
		
	}
	
	function checkregistration()
	{
		$data=$this->common_model->selectWhere('student','registration_no = "'.$_POST['registration_no'].'"');
		echo json_encode(array('exists'=>$data));
		
	}
	
	function sessionupdate()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$userid = trim($this->input->post('userid'));
		$class = trim($this->input->post('class'));
		$year = trim($this->input->post('year'));
		$session = trim($this->input->post('session'));
		$this->load->library('payment_lib');
		$already_paid=$this->payment_lib->paid_permonth($userid,1,$year,$class,2);
		if(isset($already_paid[0]->paid)=='')
		{
		
		$data_salary=array(
				'session_charge' =>$session,
				'class_id'=>$class,
				'created_date'=>date('Y-m-d H:i:s')
				);
		$this->common_model->update_data($data_salary,'session_charge','user_id',$userid);	
		}else{
			$this->session->set_flashdata('amount','<span style="color:red">Session charge for this year has been paid.</span>');
		}
	
		redirect('fees','refresh');
	}


	function delete_academic()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}

		$id=trim($this->input->post('deleteid'));
		$this->common_model->delete_data('tbl_student','student_id',$id);
		$this->common_model->delete_data('student_profile_image','student_id',$id);
		$this->common_model->delete_data('mark_sheet_image','student_id',$id);
		$this->common_model->delete_data('tbl_add_course_to_student','student_id',$id);
		$this->common_model->delete_data('tbl_add_course_subject_to_student','student_id',$id);
		$this->common_model->delete_data('tbl_add_course_to_student_payment_details','student_id',$id);
		redirect('studentlist','refresh');
	}

	function sub_admin_active_inactive()
	{
		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_sub_admin_active_inactive=array(
			'status'=>$value
		);
		//echo $value;
		$this->db->where('student_id', $id);
		$this->db->update('tbl_student',$data_sub_admin_active_inactive);
	}



	function studying_student()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'studying'
			);
			//echo $value;
			$this->db->where('student_id', $sub_admin_id);
			$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}

	function passout_student()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'passout'
			);
			//echo $value;
			$this->db->where('student_id', $sub_admin_id);
			$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}

	function dropout_student()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'dropout'
			);
			//echo $value;
			$this->db->where('student_id', $sub_admin_id);
			$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}




//payment Received

	function payment_active_inactive()
	{
		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_sub_admin_active_inactive=array(
			'payment_status'=>$value
		);
		//echo $value;
		$this->db->where('payment_id', $id);
		$this->db->update('tbl_add_course_to_student_payment_details',$data_sub_admin_active_inactive);
	}



	function payment_active_more_than_one_id()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'payment_status'=>'paid'
			);
			//echo $value;
			$this->db->where('payment_id', $sub_admin_id);
			$this->db->update('tbl_add_course_to_student_payment_details',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}

	function payment_in_active_more_than_one_id()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'payment_status'=>'pending'
			);
			//echo $value;
			$this->db->where('payment_id', $sub_admin_id);
			$this->db->update('tbl_add_course_to_student_payment_details',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}


























	function edit()
	{
		$data['userid']=$_GET['userid'];
		$data['stud_list']=$this->common_model->selectOne('student','id',$_GET['userid']);
		foreach($data['stud_list'] as $row)
		{
			$row->generalfees=0;
			$row->generalfees=$this->common_model->single_value('fees','total','class_id = '.$row->class_id);
			$row->concessionuser_id=0;
			$row->specialuser_id=0;
			$row->curnt_class_id=$this->common_model->single_value('fees_user_class','class_id','user_id = '.$_GET['userid']);
			$row->curnt_class=$this->common_model->single_value('tblclass','name','id = '.$row->curnt_class_id);
		}
			$data['concessionamout']=0;
			$data['concession_id']=0;
		 $data['concessionuser']=$this->common_model->SelectData('','','concession_user','','','user_id = '.$_GET['userid'],'id','DESC');
		
		 if(isset($data['concessionuser'][0]))
		 {
			$data['concessionamout']=$data['concessionuser'][0]->amount;
			$data['concession_id']=$data['concessionuser'][0]->id; 
		 }		 
		 $data['specialamout']=0;
		 $data['specialfees_id']=0;
		 $data['specialuser']=$this->common_model->SelectData('','','specialfees_user','','','user_id = '.$_GET['userid'],'id','DESC');
		 if(isset($data['specialuser'][0]))
		 {
			$data['specialamout']=$data['specialuser'][0]->amount;
			$data['specialfees_id']=$data['specialuser'][0]->id;  
		 }		
		$data['class']=	$this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('section');
		$data['roles']=$this->common_model->getAllRoles();
		$data['country']=$this->common_model->get_country();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();
		$data['concession']=$this->common_model->selectAll('concession');
		$data['specialfees']=$this->common_model->selectAll('specialfees');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/editstudent_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	function update()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$class = trim($this->input->post('class')); if($class==''){ $class=0;}		
		$generalfees = trim($this->input->post('fees'));
		if($generalfees==''){ $generalfees=0;}
		$fees = trim($this->input->post('totalfees'));
		if($fees==''){ $fees=$generalfees;}
		
		$concession_id = trim($this->input->post('concession_id'));
		if($concession_id==''){ $concession_id=0;}
		$specialfees_id = trim($this->input->post('specialfees_id'));
		if($specialfees_id==''){ $specialfees_id=0;}
		
		$concessionamount = trim($this->input->post('concessionamount'));
		if($concessionamount==''){ $concessionamount=0;}
		$specialamount = trim($this->input->post('specialamount'));
		if($specialamount==''){ $specialamount=0;}
		
		$concessionuser_id = trim($this->input->post('concessionuser_id'));
		if($concessionuser_id==''){ $concessionuser_id=0;}
		$specialuser_id = trim($this->input->post('specialuser_id'));
		if($specialuser_id==''){ $specialuser_id=0;}
		
		$section=trim($this->input->post('section')); if($section==''){ $section=0;}
		$password = trim($this->input->post('password')); 		
		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));					
		$email = trim($this->input->post('email'));
		$phonenumber = trim($this->input->post('phonenumber'));		
		$address = trim($this->input->post('address'));
		$date_of_birth = trim($this->input->post('date_of_birth')); if($date_of_birth==''){ $date_of_birth=date("Y-m-d");}
		$birth_place = trim($this->input->post('birth_place'));
		$middle_name = trim($this->input->post('middle_name'));
		$gender = trim($this->input->post('gender'));
		if($gender=='')
		{ 
			$gender='female';
		}
		$mother_tongue = trim($this->input->post('mother_tongue'));
		$religion = $this->input->post('religion');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$city_dist=trim($this->input->post('dist_city'));
		$country_name = trim($this->input->post('country'));
		$blood_group = trim($this->input->post('blood_group'));
		$postal_code = trim($this->input->post('postal_code'));
		$mobile = trim($this->input->post('mobile'));
		$status =trim($this->input->post('status'));
		if($status=='')
		{ 
			$status='active' ;
		}
		$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='./uploads/profile_image/temp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';				
		$config['file_name']=$new_name;	
			
		$field_name = "profile_image";
		$filename='';
		if($field_name!='')
		{
			$new_name=str_replace(' ', '_', $new_name);
			$ext = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
			$filename=$new_name.".".$ext;
			move_uploaded_file($_FILES["profile_image"]["tmp_name"],'./uploads/profile_image/temp/'.$_FILES["profile_image"]["name"]);
			//rename ('./uploads/profile_image/temp/'.$_FILES["profile_image"]["name"], './uploads/profile_image/temp/'.$filename);
			
			if(file_exists('./uploads/profile_image/temp/'.$filename))
			{
				$img_config_3['image_library'] = 'gd2';
				$img_config_3['source_image'] = './uploads/profile_image/temp/'.$filename;
				$img_config_3['maintain_ratio'] = FALSE;
				$img_config_3['width'] = 200;
				$img_config_3['height'] = 200;    
				$img_config_3['new_image'] ='./uploads/profile_image/small_images/'.$filename; 
				$this->image_lib->initialize($img_config_3);
				$this->image_lib->resize();	
				$this->image_lib->clear();
				
				//-------------------Big Image--------------------//
				
				$img_config_4['image_library'] = 'gd2';
				$img_config_4['source_image'] = './uploads/profile_image/temp/'.$filename;
				$img_config_4['maintain_ratio'] = FALSE;
				$img_config_4['width'] = 550;
				$img_config_4['height'] = 300;    
				$img_config_4['new_image'] ='./uploads/profile_image/big_images/'.$filename; 
				$this->image_lib->initialize($img_config_4);
				$this->image_lib->resize();	
				$this->image_lib->clear();
			}
			if(file_exists('./uploads/profile_image/temp/'.$filename))
			{
				unlink('./uploads/profile_image/temp/'.$filename);
			}
			
			if(file_exists('./uploads/profile_image/small_images/'.$_POST['org_profile_image']))
			{
				unlink('./uploads/profile_image/small_images/'.$_POST['org_profile_image']);
			}
			if(file_exists('./uploads/profile_image/big_images/'.$_POST['org_profile_image']))
			{
				unlink('./uploads/profile_image/big_images/'.$_POST['org_profile_image']);
			}
			
			
		}
		
		$datetime = date('Y-m-d H:i:s');
		$id=$this->input->post('userid');
		
		
		if( $class!='0' && $fees!='0')
		{ 
		$data = array(
			'first_name'=>  $firstname,
			'last_name' => $lastname,
			'middle_name' => $middle_name,
			'email'=> $email,
			'phone'=> $phonenumber,
			'address' => $address,						
			'status'=>$status,
			'country_name' => $country_name,
			'state' => $state,	
			'city' => $city,
			'city_dist'=>$city_dist,	
			'religion' => $religion,
			'blood_group' => $blood_group,
			'mother_tongue' => $mother_tongue,
			'postal_code' => $postal_code,
			'mobile' => $mobile,
			'gender' => $gender,
			'date_of_birth' => $date_of_birth,
			'birth_place' => $birth_place,	
			'class_id' =>$class	,
			'profile_image' =>$filename	
		);
		
		$table='student';		
			$this->common_model->update_data($data,$table,'id',$id);
			$this->session->set_flashdata("insert_message","Student Information has been Updated Successfully"); 
		}else{
			$this->session->set_flashdata("insert_message","Student Information has not been Updated Successfully"); 	
		}
			redirect('studentlist/edit?userid='.$id,'refresh'); 
		}



















	/*function passout_student()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'passout'
			);
			//echo $value;
			$this->db->where('student_id', $sub_admin_id);
			$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}*/

	public function excel_download($id)
	{
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Countries');
		//set cell A1 content with some text
		//$this->excel->getActiveSheet()->setCellValue('A1', 'SL NO');

		$this->excel->getActiveSheet()->setCellValue('A1', 'REG NO');
		$this->excel->getActiveSheet()->setCellValue('B1', 'ROLL NO');
		$this->excel->getActiveSheet()->setCellValue('C1', 'FIRST NAME');
		$this->excel->getActiveSheet()->setCellValue('D1', 'LAST NAME');
		$this->excel->getActiveSheet()->setCellValue('E1', 'STUDENT EMAIL');
		$this->excel->getActiveSheet()->setCellValue('F1', 'STUDENT PHONE NO');
		$this->excel->getActiveSheet()->setCellValue('G1', 'GENDER');
		$this->excel->getActiveSheet()->setCellValue('H1', 'STREAM');
		$this->excel->getActiveSheet()->setCellValue('I1', 'CATEGORY');
		$this->excel->getActiveSheet()->setCellValue('J1', 'DOB');
		$this->excel->getActiveSheet()->setCellValue('K1', 'ENROLLMENT DATE');
		$this->excel->getActiveSheet()->setCellValue('L1', 'ADDMISSION CLASS');
		$this->excel->getActiveSheet()->setCellValue('M1', 'STUDYING');
		$this->excel->getActiveSheet()->setCellValue('N1', 'SCHOOL NAME');
		//$this->excel->getActiveSheet()->setCellValue('O1', 'SCHOOL TIMING');

		//$this->excel->getActiveSheet()->setCellValue('P1', 'SCHOOL WEEKOFF DAY');
		$this->excel->getActiveSheet()->setCellValue('O1', 'BOARD');
		$this->excel->getActiveSheet()->setCellValue('P1', 'TOTAL MARKS');
		$this->excel->getActiveSheet()->setCellValue('Q1', 'CHE MARKS');
		$this->excel->getActiveSheet()->setCellValue('R1', 'MATH MARKS');
		$this->excel->getActiveSheet()->setCellValue('S1', 'BIO MARKS');
		$this->excel->getActiveSheet()->setCellValue('T1', 'PHY MARKS');
		$this->excel->getActiveSheet()->setCellValue('U1', 'SCIENCE MARKS');
		$this->excel->getActiveSheet()->setCellValue('V1', 'FATHER NAME');
		$this->excel->getActiveSheet()->setCellValue('W1', 'MOTHER NAME');
		$this->excel->getActiveSheet()->setCellValue('X1', 'FATHER MOBILE NO');
		$this->excel->getActiveSheet()->setCellValue('Y1', 'MOTHER MOBILE NO');


		//merge cell A1 until C1
		// $this->excel->getActiveSheet()->mergeCells('A1:C1');
		//set aligment to center for that merged cell (A1 to C1)
		//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//make the font become bold
		//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('C'); $col++){
			//set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
			//change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		//retrive contries table data

		$sub_admin_id_all=$id;
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++) {
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			/*$this->db->select('SD.reg_no,SD.roll_no,SD.first_name,SD.last_name,SD.student_email,SD.student_phone_no,SD.gender,SD.stream,SD.category,SD.dob,SD.enrollment_date,SD.addmission_class,SD.studying,SD.school_name,SD.board,SD.che_marks,SD.math_marks,SD.bio_marks,SD.phy_marks,SD.father_name,SD.mother_name,SD.guardian_mobile_no,SD.guardian_phone_no,science_marks,PD.payment_date,PD.check_no,PD.bank_name');
			$this->db->from('tbl_add_course_to_student_payment_details PD');
			$this->db->join('tbl_student SD','SD.student_id = PD.student_id','left');
			//$this->db->join('tbl_add_course_subject_to_student', 'tbl_add_course_subject_to_student.add_course_id = tbl_add_course_to_student.add_course_id','left');
			$this->db->group_by('PD.check_no');
			$this->db->select('SUM(`payment_head_tot_amt`)+SUM(`exam_tot_amt`)+SUM(`course_vat_tot_amt`)');
			$this->db->where('SD.student_id', $sub_admin_id);*/

		$this->db->select('reg_no, roll_no, first_name,last_name,student_email,student_phone_no,gender,stream,category,dob,enrollment_date,addmission_class,studying,school_name,board,total_marks,che_marks,math_marks,bio_marks,phy_marks,science_marks,father_name,mother_name,guardian_mobile_no,guardian_phone_no');
		$this->db->where('student_id', $sub_admin_id);
		$rs = $this->db->get('tbl_student');
			//$rs = $this->common_model->tbl_selected_st_join($sub_admin_id);
		$exceldata="";
			foreach ($rs->result_array() as $row){
				$exceldata[] = $row;
			}
		}
		//Fill data
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='STUDENTLIST.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

	}

	


}
	
	
?>