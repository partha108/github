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

		@$per_page=$this->input->get('per_page');
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
			$per_page =500;
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

		@$cur_page = $page;
		@$page -= 1;
		@$per_page =  $per_page;
		@$previous_btn = true;
		@$next_btn = true;
		@$first_btn = true;
		@$last_btn = true;
		@$start = $page * $per_page;
		@$str1='';

		// $data['payment_details']=$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_status','pending');
		@$data['student_detail']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start=$start,$end=$per_page,$where_in_array=array());
		@$data['payment_det_count']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
		@$count=count($data['payment_det_count']);
		@$data['count']=$count;
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
			$data['msg']=$msg;
		}

		$data['a']=$this->common_model->search_field('tbl_student');
		foreach($data['a'] as $row)
		{
			$where[]=$row->first_name ;
			$where[]=$row->roll_no ;
			$where[]=$row->reg_no ;
		}

		@$data['where']=$where;
		@$data['str_val'] = '';
		//$data['student_detail']=	$this->common_model->selectAll('tbl_student');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/studentlist_view',$data);
		$this->load->view('admin/template/admin_footer');
		echo ob_get_clean();
		flush();
		ob_start();

	}
	
	function search_result()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$search_field = $this->input->post('search');
		@$data['str_val'] = $search_field;

		if($search_field == "")
		{ echo "<script>alert('Please Enter a keyword');</script>";
			redirect('studentlist');
		}
		else
		{
			$search_field1 = $this->input->post('search');
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
			$per_page =500;
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
		//@$data['student_detail']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start=$start,$end=$per_page,$where_in_array=array());
		@$data['payment_det_count']= @$this->common_model->common($table_name='tbl_student',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
		@$count=count($data['payment_det_count']);
		@$data['count']=$count;
		@$show_data=count($data['payment_det_count']);

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
			$data['student_detail'] = $this->common_model->get_total_col_name($search_field);
			$data['a']=$this->common_model->search_field('tbl_student');
			foreach($data['a'] as $row)
			{
				$where[]=$row->first_name ;
				$where[]=$row->last_name ;
				$where[]=$row->roll_no ;
				$where[]=$row->reg_no ;

			}

			$data['where']=$where;
			//print_r($data['tot']);
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/studentlist_view',$data);
			$this->load->view('admin/template/admin_footer');
			echo ob_get_clean();
			flush();
			ob_start();
		}
	}

	function add_course_model($id)
	{
		@$data['s'] = $this->common_model->course($id);
		$this->load->view('admin/add_subject_course_ajax',$data);
	}

	function add_class($id)
	{
		@$ac_year = $_REQUEST['acc_value'];
		@$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('course_reg_fee'), $where=array(),
			$where_or=array(),
			$like=array(
				'academin_year'=>$ac_year,
				'replace_course'=>$id
			),
			$like_or=array(),$order=array());
		@$tax=$data_tax[0]->course_reg_fee;
		echo json_encode(array("amount" =>$tax));

		@$data['s'] = $this->common_model->add_class_model($id,$ac_year);
		$this->load->view('admin/add_student_course_class_ajax',$data);
	}

	function add_subject($id)
	{
		@$acc_year = $_REQUEST['acc_value'];
		@$course_value = $_REQUEST['course_value'];

		@$data['s'] = $this->common_model->add_subject_model($id,$acc_year,$course_value);
		$this->load->view('admin/add_student_course_subject_ajax',$data);
	}

	function add_batch($id)
	{
		@$acc_year = $_REQUEST['acc_value'];
		@$course_value = $_REQUEST['course_value'];
		@$data['s'] = $this->common_model->add_batch_model($id,$acc_year,$course_value);
		$this->load->view('admin/add_student_course_batch_ajax',$data);
	}

	function add_subject_fees($id)
	{
		@$acc_year = $_REQUEST['acc_value'];
		@$course_value = $_REQUEST['course_value'];
		@$class_value = $_REQUEST['class_value'];
	}

	function add_reg_amount()
	{
		@$reg_amount = 	$_REQUEST['course_id'];
		@$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('course_reg_fee'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->course_reg_fee;
		echo json_encode(array("amount" =>$tax));
	}

	function add_reg_amt_vat()
	{
		@$reg_amount = 	$_REQUEST['course_id'];
		@$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('vat'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->vat;
		echo json_encode(array("amount" =>$tax));
	}

	function add_reg_vat_amt()
	{
		@$reg_amount = 	$_REQUEST['course_id'];
		@$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('vat_amt'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->vat_amt;
		echo json_encode(array("amount" =>$tax));
	}

	function add_reg_total_amt()
	{
		@$reg_amount = 	$_REQUEST['course_id'];
		@$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('total_amt'), $where=array(),
			$where_or=array(),$like=array('course_id'=>$reg_amount),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->total_amt;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_fee()
	{
		@$class_id = 	$_REQUEST['class_id'];
		@$acc_year = $_REQUEST['acc_value'];


		@$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('exam_fee'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->exam_fee;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_vat()
	{
		@$class_id = 	$_REQUEST['class_id'];
		@$acc_year = $_REQUEST['acc_value'];


		@$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('vat'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->vat;
		echo json_encode(array("amount" =>$tax));
	}

	function add_exam_vat_amt()
	{
		@$class_id = 	$_REQUEST['class_id'];
		@$acc_year = $_REQUEST['acc_value'];


		@$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('vat_amt'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->vat_amt;
		echo json_encode(array("amount" =>$tax));

	}

	function add_exam_tot_amt()
	{

		@$class_id = 	$_REQUEST['class_id'];
		@$acc_year = $_REQUEST['acc_value'];


		@$data_tax	=	$this->common_model->common($table_name='tbl_class',$field=array('tot_amt'), $where=array(),
			$where_or=array(),$like=array('class_academic_year'=>$acc_year,'rep_cls_name'=>$class_id),$like_or=array(),$order=array());
		@$tax		=	$data_tax[0]->tot_amt;
		echo json_encode(array("amount" =>$tax));
	}

	function subject_amount()
	{
		@$subject_name 		= 	$_REQUEST['sub_id'];
		@$acc_year			=	$_REQUEST['acc_value'];
		@$course_id			=	$_REQUEST['course_value'];
		@$class_id			=	$_REQUEST['class_value'];

		$new_sub_name = explode(",",$subject_name);
		for($i=0;$i<count(array_filter($new_sub_name));$i++)
		{
			@$data_tax	=	$this->common_model->common($table_name='tbl_subject',$field=array('subject_fees'), $where=array(),
				$where_or=array(),$like=array('subject_id'=>$new_sub_name[$i],'academic_year'=>$acc_year,'course_name_by_subject'=>$course_id,'class_name'=>$class_id),
				$like_or=array(),$order=array());
			@$tax		=	$data_tax[0]->subject_fees;
			echo json_encode(array("total_amount" =>$tax));
		}

	}

	function subject_payment_details()
	{
		@$subject_name 		= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head'), $where=array('subject_id'=>$subject_name),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head);
	}

	function add_subject_id()
	{
		@$subject_name 			= 	$_REQUEST['sub_id'];
		@$data_tax_subject_id	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('subject_id'), $where=array('subject_id'=>$subject_name),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_subject_id);
	}

	function subject_payment_details_amt()
	{
		@$subject_name1 				= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_amt'), $where=array('subject_id'=>$subject_name1),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt);
	}

	function subject_payment_details_vat()
	{
		@$subject_name2 					= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_amt_vat	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_vat'), $where=array('subject_id'=>$subject_name2),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_vat);
	}

	function subject_payment_details_vat_amt()
	{
		@$subject_name3 						= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_amt_vat_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_vat_amt'), $where=array('subject_id'=>$subject_name3),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_vat_amt);
	}

	function subject_payment_details_total_amt()
	{
		@$subject_name4 						= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_amt_tot_amt	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('	payment_head_total_amt'), $where=array('subject_id'=>$subject_name4),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_amt_tot_amt);
	}

	function subject_payment_details_to_date()
	{
		@$subject_name5 					= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_to_date	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_to_dt'), $where=array('subject_id'=>$subject_name5),
			$where_or=array(),$like=array(),
			$like_or=array(),$order=array());
		echo json_encode($data_tax_payment_head_to_date);

	}

	function subject_payment_details_frm_date()
	{
		@$subject_name6 					= 	$_REQUEST['sub_id'];
		@$data_tax_payment_head_frm_date	=	$this->common_model->common($table_name='tbl_subject_patment_head_detail',$field=array('payment_head_frm_dt'), $where=array('subject_id'=>$subject_name6),
			$where_or=array(),$like=array(),
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
		@$data['academic_year']=$this->common_model->selectAll('academic_year');
		@$data['course']=$this->common_model->selectAll('tbl_course');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_course_to_student',$data);
		$this->load->view('admin/template/admin_footer');
		echo ob_get_clean();
		flush();
		ob_start();
	}

	function view_course_details($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
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
		//print_r($data['sub_details']);
		//echo count($data['sub_details']);
		for($i=0;$i<count($data['sub_details']);$i++)
		{
			@$data['batch_name']= $data['sub_details'][0]->batch_name;
		}
		//echo count($data['sub_details'][0]->add_course_id);
		//$batch_id = $data['sub_details'][0]->batch_name;
		@$data['batch_detail'] = $this->common_model->edit_repbatch_view($acc_year,$course_by,$class_name);
		//print_r($data['s']);




		@$data['subject_data'] = $this->common_model->sub_name('tbl_add_course_to_student','academic_year',$acc_year,'course_name',$course_by,'class_name',$class_name);
		//$sub_id = $data['sub_details'][0]->subject_name;
		@$data['s'] = $this->common_model->edit_batch_view($acc_year,$course_by,$class_name);
		//print_r($data['s'] = $this->common_model->edit_batch_view($student_id,$course_id));
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/view_course_details',$data);
		$this->load->view('admin/template/admin_footer');
		echo ob_get_clean();
		flush();
		ob_start();
	}

	function add_student_to_course_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		@$student_id = $id;
		@$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student','student_id',$student_id);

		@$data['stu_details'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		//$data['course_details'] = $this->common_model->add_course_data('tbl_course','course_id',$course_id);
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_course_to_student_view',$data);
		$this->load->view('admin/template/admin_footer');
		echo ob_get_clean();
		flush();
		ob_start();

	}

	public function add_course_to_student()
	{
		@$id = $this->input->post('id');
		@$acc_year = $this->input->post('add_ac_year');
		@$course = $this->input->post('add_course');
		@$reg_fee = $this->input->post('reg_fee');
		@$reg_fee_vat=$this->input->post('reg_fee_vat');
		@$reg_fee_vat_amt= $this->input->post('reg_fee_vat_amt');
		@$reg_fee_tot_amt = $this->input->post('reg_fee_tot_amt');
		@$class = $this->input->post('add_class');

		@$subject = $this->input->post('add_subject');
		@$sub_name = implode(',',$subject);
		$new_sub = explode(',',$sub_name);
		$sub_fee = $this->input->post('subject_fee');
		@$sub_exam_fee = $this->input->post('exam_reg_fee');
		@$sub_exam_vat = $this->input->post('exam_fee_vat');
		@$sub_exam_vat_amt = $this->input->post('exam_fee_vat_amt');
		@$sub_exam_tot_amt = $this->input->post('exam_fee_tot_amt');

		@$batch = $this->input->post('batch_id');
		@$p_head_amt= implode(",",$subject);
		@$new_payment_amount = explode(",",$p_head_amt);
		//$total_fee = $this->input->post('add_subject_fees');


		// Payment head

		@$payment_head_detail = $this->input->post('payment_detail');
		@$p_head_details= implode(",",$payment_head_detail);
		@$new_head_details = explode(",",$p_head_details);
		//print_r($new__head_details);
		@$sub_subject_id = $this->input->post('subject_id_detail');
		@$payment_head_amt = $this->input->post('payment_detail_amt');
		@$payment_head_vat = $this->input->post('payment_detail_vat');
		@$payment_head_vat_amt = $this->input->post('payment_detail_vat_amt');
		@$payment_head_tot_amt = $this->input->post('payment_detail_tot_amt');

		@$payment_head_to_date = $this->input->post('payment_detail_to_date');
		@$payment_head_frm_date = $this->input->post('payment_detail_frm_date');


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

		@$this->common_model->insert_data($data,'tbl_add_course_to_student');
		@$course_id = $this->db->insert_id();

		for($j=0;$j<count(array_filter($new_payment_amount));$j++)
		{
			$data=array(
				//'sub_fee' => $sub_fee[$j],
				'subject_name'=>$subject[$j],
				'batch_name'=>$batch[$j],
				'student_id'=>$id,
				'add_course_id'=>$course_id,

			);


			@$this->common_model->insert_data($data,'tbl_add_course_subject_to_student');
		}

		@$exam_name = 'Exam Fees';
		@$today =  date('Y-m-d');
		@$after =  date('Y-m-d', strtotime("+15 days"));


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

		@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		@$course_name = 'Reg Fees';

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

		@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		if(count(array_filter($new_head_details)) == 0)
		{
			$data = array(
					'payment_head_name' => '',
					'payment_head_amt' => '',
					'payment_head_vat' => '',
					'payment_head_vat_amt' => '',
					'payment_head_tot_amt' => '',
					'payment_head_to_date' => '',
					'payment_head_frm_date' => '',
					'student_id' => $id,
					'subject_id' => '',
					'course_id' => $course_id,
					'payment_status' => 'pending',
			);

			@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

		}

		else {

			for ($k = 0; $k < count(array_filter($new_head_details)); $k++) {
				$data = array(
					'payment_head_name' => $payment_head_detail[$k],
					'payment_head_amt' => $payment_head_amt[$k],
					'payment_head_vat' => $payment_head_vat[$k],
					'payment_head_vat_amt' => $payment_head_vat_amt[$k],
					'payment_head_tot_amt' => $payment_head_tot_amt[$k],
					'payment_head_to_date' => $payment_head_to_date[$k],
					'payment_head_frm_date' => $payment_head_frm_date[$k],
					'student_id' => $id,
					'subject_id' => $sub_subject_id[$k],
					'course_id' => $course_id,
					'payment_status' => 'pending',
					//'id'=>$last_id
				);

				@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');

			}
		}
		redirect('studentlist/add_student_to_course_view/'.$id,'refresh');
		//redirect('studentlist');

	}
	
	function edit_student_course_view($id)

	{
		///echo $id;
		@$data['st_data']       	=   $this->common_model->selectOne('tbl_add_course_to_student','add_course_id',$id);
		@$data['sub_data']       	=   $this->common_model->selectOne('tbl_add_course_subject_to_student','add_course_id',$id);
		@$acc_year               	=   $data['st_data'][0]->academic_year;
		@$course_by              	=   $data['st_data'][0]->course_name;
		@$class_name               	=   $data['st_data'][0]->class_name;
		@$sub_name					=	$data['sub_data'][0]->subject_name;
		@$student_id 				= 	$data['sub_data'][0]->student_id;
		@$course_id 				= 	$data['sub_data'][0]->add_course_id;

		@$data['academic_year']  	=   $this->common_model->selectAll('academic_year');
		@$data['course']         	=   $this->common_model->course_edit_subject($acc_year);
		@$data['Classes']        	=   $this->common_model->getAllClasses_edit_subject_view($course_by);
		@$data['subject_name']      =   $this->common_model->subject_view($class_name);
		@$data['payment_details'] 	= 	$this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','student_id',$student_id,'course_id',$course_id);
		@$data['sub_details'] 		= 	$this->common_model->payment_head_detail('tbl_add_course_subject_to_student','student_id',$student_id,'add_course_id',$course_id);

		@$data['subject_data'] 		= $this->common_model->sub_name('tbl_add_course_to_student','academic_year',$acc_year,'course_name',$course_by,'class_name',$class_name);
		//$sub_id = $data['sub_details'][0]->subject_name;
		//@$data['s'] = $this->common_model->edit_batch_view($acc_year,$course_by,$class_name);
		@$data['batch_detail'] 		= $this->common_model->edit_repbatch_view($acc_year,$course_by,$class_name);
		//print_r($data['s'] = $this->common_model->edit_batch_view($student_id,$course_id));
		//echo "<pre>";print_r($data['s']);exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/edit_course_to_student',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	function delete_subject()
	{
		@$id=trim($this->input->post('deleteid'));
		@$sub_data = $this->common_model->getAlldata('tbl_add_course_subject_to_student','add_subject_id',$id);
		@$sub_name = $sub_data[0]->subject_name;
		@$student_id = $sub_data[0]->student_id;
		@$course_id = $sub_data[0]->add_course_id;
		
		@$rec_data = $this->common_model->getAlldata_subject('tbl_add_course_to_student_payment_details','student_id',$student_id,'course_id',$course_id,'subject_id',$sub_name);
		@$rec_no = $rec_data[0]->recepit_no;
		@$ack_no = $rec_data[0]->ack_no;
		//print_r($rec_data);exit;
		if(@$rec_no == "" && @$ack_no == ""){
			@$this->common_model->delete_data_subject('tbl_add_course_to_student_payment_details','student_id',$student_id,'course_id',$course_id,'subject_id',$sub_name);
			@$this->common_model->delete_data('tbl_add_course_subject_to_student','add_subject_id',$id);
			echo "Subject Is Deleted Successfully";
		}
		else
		{
			echo "This Subject Payment Was Received So You Can't Deleted..";
		}

	}

	function edit_course_to_student()
	{
		@$st_course_id 					= $this->input->post('id');
		@$student_id 					= $this->input->post('student_id');

		@$acc_year 						=		$this->input->post('add_ac_year');
		@$course 						=		$this->input->post('add_course');
		@$reg_fee 						=		$this->input->post('reg_fee');
		@$reg_vat	     				=		$this->input->post('reg_fee_vat');
		@$reg_vat_amt					=		$this->input->post('reg_fee_vat_amt');
		@$reg_tot_amt					=		$this->input->post('reg_fee_tot_amt');

		@$class 							=		$this->input->post('add_class');
		@$exam_fee 						=		$this->input->post('exam_reg_fee');
		@$exam_vat 						=		$this->input->post('exam_fee_vat');
		@$exam_vat_amt 					=		$this->input->post('exam_fee_vat_amt');
		@$exam_tot_amt 					=		$this->input->post('exam_fee_tot_amt');

		@$edit_sub_id					=		$this->input->post('sub_id');
		@$old_sub_payment_id_detail		=		$this->input->post('old_payment_id_detail');
		//echo "<pre>";
		//print_r($old_sub_payment_id_detail);
		@$old_sub 						=		$this->input->post('add_subject');
		@$sub_id 						=		$this->input->post('old_subject_id_detail');
		//echo "<pre>";
		//print_r($sub_id);exit;
		@$payment_head					=		$this->input->post('old_payment_detail');
		@$payment_head_amt				=		$this->input->post('old_payment_detail_amt');
		@$payment_head_vat				=		$this->input->post('old_payment_detail_vat');
		@$payment_head_vat_amt			=		$this->input->post('old_payment_detail_vat_amt');
		@$payment_head_tot_amt			=		$this->input->post('old_payment_detail_tot_amt');
		@$payment_head_to_date			=		$this->input->post('old_payment_detail_to_date');
		@$payment_head_form_date			=		$this->input->post('old_payment_detail_frm_date');

		@$old_batch						=		$this->input->post('batch_id');

		@$new_sub 						=		$this->input->post('add_new_subject');

		@$new_sub_id 					=		$this->input->post('subject_id_detail');
		@$new_payment_head				=		$this->input->post('payment_detail');
		@$new_payment_head_amt			=		$this->input->post('payment_detail_amt');
		@$new_payment_head_vat			=		$this->input->post('payment_detail_vat');
		@$new_payment_head_vat_amt		=		$this->input->post('payment_detail_vat_amt');
		@$new_payment_head_tot_amt		=		$this->input->post('payment_detail_tot_amt');
		@$new_payment_head_to_date		=		$this->input->post('payment_detail_to_date');
		@$new_payment_head_form_date		=		$this->input->post('payment_detail_frm_date');

		@$new_batch						=		$this->input->post('new_batch_id');
		//echo count($new_sub_id);exit;
		//print_r($new_payment_head);exit;
		@$sub_data = $this->common_model->getAlldata('tbl_add_course_subject_to_student','add_course_id',$st_course_id);
		@$sub_name = $sub_data[0]->subject_name;
		@$student_id = $sub_data[0]->student_id;
		@$course_id = $sub_data[0]->add_course_id;
		@$rec_data = $this->common_model->getAlldata_subject('tbl_add_course_to_student_payment_details','student_id',$student_id,'course_id',$course_id,'subject_id',$sub_name);
		$rec_no = $rec_data[0]->recepit_no;
		$ack_no = $rec_data[0]->ack_no;
		//echo "<pre>";
		//print_r($rec_data);
		//exit;

		$data = array(
						'academic_year'=>$acc_year,
						'course_name'=>$course,
						'class_name'=>$class,
						'course_reg_fee'=>$reg_fee,
						'course_fee_vat'=>$reg_vat,
						'course_fee_vat_amt'=>$reg_vat_amt,
						'course_vat_tot_amt'=>$reg_tot_amt,
						'exam_fee'=>$exam_fee,
						'exam_vat'=>$exam_vat,
						'exam_vat_fee'=>$exam_vat_amt,
						'exam_tot_amt'=>$exam_tot_amt
		);
		//print_r($data);
		@$this->common_model->update_data($data, 'tbl_add_course_to_student', 'add_course_id', $st_course_id);
		//echo count($old_sub);



			for ($j = 0; $j < count(array_filter($old_sub)); $j++)
			{

				$data = array(
					'subject_name' => $old_sub[$j],
					'batch_name' => $old_batch[$j],
				);
				//echo $j;
				//echo $st_course_id[$j];
				//echo "<pre>";print_r($data);
				@$this->common_model->update_data($data, 'tbl_add_course_subject_to_student', 'add_subject_id', $edit_sub_id[$j]);

			}
//e			echo count($sub_id);
			for ($t = 0; $t < count(array_filter($sub_id)); $t++)
			{
				$data = array(
					'payment_head_name' => $payment_head[$t],
					'payment_head_amt' => $payment_head_amt[$t],
					'payment_head_vat' => $payment_head_vat[$t],
					'payment_head_vat_amt' => $payment_head_vat_amt[$t],
					'payment_head_tot_amt' => $payment_head_tot_amt[$t],
					'payment_head_to_date' => $payment_head_to_date[$t],
					'payment_head_frm_date' => $payment_head_form_date[$t],
					'student_id' => $student_id,
					'subject_id' => $sub_id[$t],
					'course_id' => $st_course_id,
					//'payment_status' => 'pending',
					//'id'=>$last_id
				);
				//echo "<pre>";print_r($data);
				//echo "<pre>";
				//print_r($data);
				@$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $old_sub_payment_id_detail[$t]);
			}





		if(!empty($new_sub))
		{	//echo count($new_sub_id); exit;


			for ($k = 0; $k < count(array_filter($new_sub_id)); $k++)
			{
				$data = array(
					'payment_head_name' => $new_payment_head[$k],
					'payment_head_amt' => $new_payment_head_amt[$k],
					'payment_head_vat' => $new_payment_head_vat[$k],
					'payment_head_vat_amt' => $new_payment_head_vat_amt[$k],
					'payment_head_tot_amt' => $new_payment_head_tot_amt[$k],
					'payment_head_to_date' => $new_payment_head_to_date[$k],
					'payment_head_frm_date' => $new_payment_head_form_date[$k],
					'student_id' => $student_id,
					'subject_id' => $new_sub_id[$k],
					'course_id' => $st_course_id,
					'payment_status' => 'pending',
					//'id'=>$last_id
				);
				//echo "<pre>";print_r($data);
				//echo "<pre>";
				//print_r($data);
				@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');
			}
			for ($i = 0; $i < count(array_filter($new_sub)); $i++)
			{
				$data = array(
					//'sub_fee' => $sub_fee[$j],
					'subject_name' => $new_sub[$i],
					'add_course_id' => $st_course_id,
					'batch_name' => $new_batch[$i],
					'student_id' => $student_id,
				);
				//echo "<pre>";
				//print_r($data);
				@$this->common_model->insert_data($data,'tbl_add_course_subject_to_student');

			}

		}


		//exit;
		redirect('studentlist/edit_student_course_view/'.$st_course_id,'refresh');
		//redirect('studentlist');
	}

	function add_student_edit_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$student_id = $id;
		@$data['max_id']				= 	$this->common_model->max_id('tbl_student','roll_no');
		@$data['student_data'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		@$data['class']= $this->common_model->getAllClasses();
		@$data['city']=$this->common_model->get_city();
		@$data['state']=$this->common_model->get_state();
		@$data['student_pro_img'] = $this->common_model->add_course_data('student_profile_image','student_id',$student_id);
		@$data['student_mark_sheet_img'] = $this->common_model->add_course_data('mark_sheet_image','student_id',$student_id);

		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_student_edit_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function edit_student()
	{
		@$student_id = $this->input->post('student_id');
		@$reg_no = $this->input->post('student_reg_no');
		@$roll_no = $this->input->post('student_roll_no');
		@$first_name = $this->input->post('first_name');
		@$last_name = $this->input->post('last_name');
		@$email = $this->input->post('email');
		@$student_mobile_number = $this->input->post('student_mobile_number');

		@$stream = $this->input->post('stream');
		@$gender = $this->input->post('gender');
		@$category = $this->input->post('category');
		@$dob = $this->input->post('dob');
		@$addmission_class = $this->input->post('addmission_class');
		@$student_study_status = $this->input->post('student_status');

		@$school_name = $this->input->post('school_name');
		@$school_timing = $this->input->post('school_timing');
		@$week_day = $this->input->post('week_day');
		@$board = $this->input->post('board');
		@$total_marks = $this->input->post('total_marks');
		@$math_marks = $this->input->post('math_marks');
		@$phy_marks = $this->input->post('phy_marks');
		@$che_marks = $this->input->post('che_marks');
		@$bio_marks = $this->input->post('bio_marks');
		@$science_marks = $this->input->post('science_marks');
		@$school_address = $this->input->post('school_address');

		@$father_name = $this->input->post('father_name');
		@$father_occupation = $this->input->post('father_occupation');
		@$mother_name = $this->input->post('mother_name');
		@$mother_occupation = $this->input->post('mother_occupation');
		@$father_mobile_no = $this->input->post('father_mobile_no');
		@$mother_mobile_no = $this->input->post('mother_mobile_no');

		@$address1 = $this->input->post('address1');
		@$address2 = $this->input->post('address2');
		@$state_name = $this->input->post('state');
		@$city = $this->input->post('city');
		@$pincode = $this->input->post('pincode');
		@$home_number = $this->input->post('home_number');
		@$last_logon_time = date('Y-m-d H:i:s');
		@$student_status = $this->input->post('student_status');
		@$user_name = $first_name . substr($student_mobile_number, 6);
		@$img_id = $this->input->post('img_id');
		@$img_chk = $this->input->post('mark_sheet');
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
		@$this->common_model->update_data($data, 'tbl_student', 'student_id', $student_id);
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
					@$this->common_model->insert_data($doc_data,'mark_sheet_image','student_id',$student_id);


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
//exit;
		redirect('studentlist');
	}

	function add_student_to_payment_view($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		@$student_id = $id;
		@$data['academic_year']=$this->common_model->selectAll('academic_year');
		@$data['stu_details'] = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
		@$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','student_id',$student_id);
		/*$data['details']= $this->common_model->tbl_join_course_data($student_id);
		echo "<pre>";
		print_r($data['details']);exit;*/
		@$course_id = $data['details'][0]->course_id;
		@$data['details_sub_name'] = $this->common_model->payment_head_detail('tbl_add_course_subject_to_student','add_course_id',$course_id,'student_id',$student_id);
		//print_r($details_sub_name);exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/add_student_to_payment_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function receive_payment_model($id)
	{
		@$student_id = $id;

		@$st_id 				= 	explode('_',$student_id);
		@$data['rec_no']		=	$this->common_model->max_id('tbl_add_course_to_student_payment_details','recepit_no');
		//print_r($data['rec_no']);
		//$data['rec_no'] = '4367';

		@$data['ak_no']		= 	$this->common_model->max_id('tbl_add_course_to_student_payment_details','ack_no');

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
		@$mal_data['email_data'] = $this->common_model->selectAll('tblemail');
		@$admin_mail = $mal_data['email_data'][0]->from_email;
		@$id = $this->input->post('payment_id');

		@$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
		$rec_no = $st_data['st_detail'][0]->recepit_no;
		@$student_id = $st_data['st_detail'][0]->student_id;
		@$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
		//print_r($st_data['st_detail']);
		@$student_email = $st_data['st_detail'][0]->student_email;
		@$iid = explode("_", $id);
		//print_r($iid);
		@$payment_date 			= $this->input->post('payment_receive_date');
		@$payment_mode 			= $this->input->post('payment_mode');
		@$payment_check_no 		= $this->input->post('check_no');
		@$payment_bank_name 		= $this->input->post('bank_name');
		@$payment_check_status 	= $this->input->post('check_status');
		@$receipt_no 			= $this->input->post('recipt_no');
		@$ack_no 				= $this->input->post('ack_no');
		if ($payment_mode == 'paid' && $payment_check_status == '0')
		{
			for ($i = 0; $i < count($iid); $i++)
			{
				$data = array(
					'payment_date' => $payment_date,
					'payment_mode' => 'cash',
					'check_no' => $payment_check_no,
					'bank_name' => $payment_bank_name,
					'check_status' => '0',
					'recepit_no' => $receipt_no,
					'payment_status' => 'paid'
				);

				$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			@$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $receipt_no);
			$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/confirmation', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			$this->email->from('admin@parthaedu.com');
			$this->email->to($student_email);
			$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			//echo $this->email->print_debugger();

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
					'check_status' => '1',
					'recepit_no' => $receipt_no,
					'payment_status' => 'paid'
				);
				//print_r($data);
				@$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			@$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $receipt_no);
			@$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/confirmation', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			@$this->email->from('admin@parthaedu.com');
			@$this->email->to($student_email);
			@$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			//echo $this->email->print_debugger();
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
					'check_status' => '3',
					'ack_no' => $ack_no,
					'payment_status' => 'pending'
				);
				//print_r($data);

				//print_r($data);
				@$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			@$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','ack_no',$ack_no);
			@$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/inprocess', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			@$this->email->from('admin@parthaedu.com');
			@$this->email->to($student_email);
			@$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			//echo $this->email->print_debugger();
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
					'check_status' => '2',
					'payment_status' => 'pending'
				);
				//print_r($data);
				@$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'payment_id', $iid[$i]);
			}
			@$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/bounced', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			@$this->email->from($admin_mail);
			@$this->email->to($student_email);
			@$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			//echo $this->email->print_debugger();
		}
		redirect('studentlist/add_student_to_payment_view/'.$student_id,'refresh');
		//redirect('studentlist');
	}

	function payment_receipt($id)
	{
		$payment_id = $id;

		@$data['details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_id',$payment_id);
		@$rec_no = $data['details'][0]->recepit_no;
		@$ack_no = $data['details'][0]->ack_no;
		@$data['rec_details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
		@$data['ack_details'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','ack_no',$ack_no);

		@$rec_no = $data['rec_details'][0]->recepit_no;
		@$pay_status = $data['rec_details'][0]->payment_status;
		if($pay_status == 'paid' && $rec_no != '')
		{
			$data['details'][0]->recepit_no;
			$this->load->view('admin/payment_receipt_bk',$data);
		}
		else if($pay_status == '0' && $rec_no != '')
		{
			$data['details'][0]->recepit_no;
			$this->load->view('admin/refund_fee_statement',$data);
		}
		
		else
		{
			@$data['details'][0]->ack_no;
			$this->load->view('admin/ack_inprocess_status',$data);
		}

	}

	function delete_student_course($id)
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}

		$id=trim($this->input->post('deleteid'));
		@$this->common_model->delete_data('tbl_add_course_to_student','add_course_id',$id);
		@$this->common_model->delete_data('tbl_add_course_subject_to_student','add_course_id',$id);
		@$this->common_model->delete_data('tbl_add_course_to_student_payment_details','course_id',$id);

		//redirect('studentlist/add_student_to_course_view','refresh');

	}

	function deleteitem()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		@$id=$_GET['id'];
		@$table=$_GET['table'];
		@$column=$_GET['column'];
		@$page=$_GET['page'];
		@$this->common_model->delete_data($table,$column,$id);
		@$this->common_model->delete_data('fees_user_class','user_id',$id);
		redirect($page,'refresh');
	}

	function checkuseremailavailability()
	{
		@$data=$this->common_model->selectWhere('student','email = "'.$_POST['email'].'"');
		echo json_encode(array('exists'=>$data));

	}

	function checkregistration()
	{
		@$data=$this->common_model->selectWhere('student','registration_no = "'.$_POST['registration_no'].'"');
		echo json_encode(array('exists'=>$data));

	}

	function sessionupdate()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		@$userid = trim($this->input->post('userid'));
		@$class = trim($this->input->post('class'));
		@$year = trim($this->input->post('year'));
		@$session = trim($this->input->post('session'));
		@$this->load->library('payment_lib');
		@$already_paid=$this->payment_lib->paid_permonth($userid,1,$year,$class,2);
		if(isset($already_paid[0]->paid)=='')
		{
			$data_salary=array(
				'session_charge' =>$session,
				'class_id'=>$class,
				'created_date'=>date('Y-m-d H:i:s')
			);
			@$this->common_model->update_data($data_salary,'session_charge','user_id',$userid);
		}
		else
		{
			@$this->session->set_flashdata('amount','<span style="color:red">Session charge for this year has been paid.</span>');
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

		@$id=trim($this->input->post('deleteid'));
		@$this->common_model->delete_data('tbl_student','student_id',$id);
		@$this->common_model->delete_data('student_profile_image','student_id',$id);
		@$this->common_model->delete_data('mark_sheet_image','student_id',$id);
		@$this->common_model->delete_data('tbl_add_course_to_student','student_id',$id);
		@$this->common_model->delete_data('tbl_add_course_subject_to_student','student_id',$id);
		@$this->common_model->delete_data('tbl_add_course_to_student_payment_details','student_id',$id);
		redirect('studentlist','refresh');
	}

	function sub_admin_active_inactive()
	{
		@$value=$this->input->post('value');
		@$id=$this->input->post('id');
		@$data_sub_admin_active_inactive=array(
			'status'=>$value
		);
		//echo $value;
		@$this->db->where('student_id', $id);
		@$this->db->update('tbl_student',$data_sub_admin_active_inactive);
	}

	function studying_student()
	{
		//$student_id = $_REQUEST['abc'];
		@$sub_admin_id_all=$_REQUEST['abc'];//$this->input->post('sub_admin_id');
		
		@$sub_admin_id_array=explode(",",$sub_admin_id_all);
		
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			$sub_admin_id					=	trim($sub_admin_id_array[$i]);
			$student_details				= 	@$this->common_model->common($table_name='tbl_student',$field=array(),$where=array('student_id'=>$sub_admin_id),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
			@$sub_admin_id					=	trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive	=	array(
					'studying'=>'studying'
				);
			//print_r($data_sub_admin_active_inactive);
			@$this->db->where('student_id', $sub_admin_id);
			@$this->db->update('tbl_student',$data_sub_admin_active_inactive);
			@$student_email = $student_details[0]->student_email;
			@$user_name = $student_details[0]->username;
			@$password =  $student_details[0]->password;
			@$guardian_phone_no =  $student_details[0]->guardian_phone_no;
			@$this->email->from('admin@parthaedu.com');
			@$this->email->to($student_email,$guardian_phone_no);
			@$this->email->bcc('admin@parthaedu.com');

			@$this->email->subject('Your Username & Password');
			@$this->email->message('username :'.$user_name."<br>".'password :'.$password);
			@$result = $this->email->send();
			//echo $this->email->print_debugger();


		}
		redirect('studentlist','refresh');
	}

	function passout_student()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			@$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'passout'
			);
			//echo $value;
			@$this->db->where('student_id', $sub_admin_id);
			@$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}

	function dropout_student()
	{
		@$sub_admin_id_all=$this->input->post('sub_admin_id');
		@$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'studying'=>'dropout'
			);
			//echo $value;
			@$this->db->where('student_id', $sub_admin_id);
			@$this->db->update('tbl_student',$data_sub_admin_active_inactive);
		}

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

	public function excel_download()
	{
		$student_id = $_REQUEST['abc'];

		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('student_list');
		$this->excel->getActiveSheet()->setCellValue('A1', 'REG NO');
		$this->excel->getActiveSheet()->setCellValue('B1', 'ROLL NO');
		$this->excel->getActiveSheet()->setCellValue('C1', 'FIRST NAME');
		$this->excel->getActiveSheet()->setCellValue('D1', 'LAST NAME');
		$this->excel->getActiveSheet()->setCellValue('E1', 'STUDENT EMAIL');
		$this->excel->getActiveSheet()->setCellValue('F1', 'STUDENT PHONE NO');

		$this->excel->getActiveSheet()->setCellValue('G1', 'FATHER NAME');
		$this->excel->getActiveSheet()->setCellValue('H1', 'FATHER MOBILE NO');
		$this->excel->getActiveSheet()->setCellValue('I1', 'MOTHER NAME');
		$this->excel->getActiveSheet()->setCellValue('J1', 'MOTHER MOBILE NO');
		$this->excel->getActiveSheet()->setCellValue('K1', 'ACADEMIN YEAR');
		$this->excel->getActiveSheet()->setCellValue('L1', 'COURSE NAME');
		$this->excel->getActiveSheet()->setCellValue('M1', 'CLASS NAME');
		$this->excel->getActiveSheet()->setCellValue('N1', 'SUBJECT NAME');
		$this->excel->getActiveSheet()->setCellValue('O1', 'BATCH NAME');

		//retrive contries table data

		$sub_admin_id_all = $student_id;
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		$excel_id = 2;
		for($counter=0;$counter<count($sub_admin_id_array);$counter++)
		{
			$st_id = $counter;
			$sub_admin_id					=	trim($sub_admin_id_array[$st_id]);
			$student_details				= 	@$this->common_model->common($table_name='tbl_student',$field=array(),$where=array('student_id'=>$sub_admin_id),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());

			$course_details_by_id['c_id']	= 	@$this->common_model->common($table_name='tbl_add_course_to_student',$field=array(),$where=array('student_id'=>$sub_admin_id),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
			$sub_details_by_id['s_id']	= @$this->common_model->common($table_name='tbl_add_course_subject_to_student',$field=array(),$where=array('student_id'=>$sub_admin_id),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());


			$student_reg_no 				= 	$student_details[0]->reg_no;
			$student_roll_no 				= 	$student_details[0]->roll_no;
			$student_first_name 			= 	$student_details[0]->first_name;
			$student_last_name 				= 	$student_details[0]->last_name;
			$student_email 					= 	$student_details[0]->student_email;
			$student_phone_no 				= 	$student_details[0]->student_phone_no;
			$student_fathe_name 			= 	$student_details[0]->father_name;
			$student_mother_name 			= 	$student_details[0]->mother_name;
			$father_mobile_no 				= 	$student_details[0]->guardian_mobile_no;
			$mother_mobile_no 				= 	$student_details[0]->guardian_phone_no;

			$this->excel->getActiveSheet()->setCellValue("A" . $excel_id, $student_reg_no);
			$this->excel->getActiveSheet()->setCellValue("B" . $excel_id, $student_roll_no);
			$this->excel->getActiveSheet()->setCellValue("C" . $excel_id, $student_first_name);
			$this->excel->getActiveSheet()->setCellValue("D" . $excel_id, $student_last_name);
			$this->excel->getActiveSheet()->setCellValue("E" . $excel_id, $student_email);
			$this->excel->getActiveSheet()->setCellValue("F" . $excel_id, $student_phone_no);
			$this->excel->getActiveSheet()->setCellValue("G" . $excel_id, $student_fathe_name);
			$this->excel->getActiveSheet()->setCellValue("H" . $excel_id, $student_mother_name);
			$this->excel->getActiveSheet()->setCellValue("I" . $excel_id, $father_mobile_no);
			$this->excel->getActiveSheet()->setCellValue("J" . $excel_id, $mother_mobile_no);

			$con_id = $excel_id;
			if(!empty($course_details_by_id['c_id']))
			{
				foreach ($course_details_by_id['c_id'] as $c)
				{
					//print_r($c);
					@$course_id = $c->course_id;
					//@$sub_id = $c->subject_id;

					@$course_details_id = @$this->common_model->common($table_name = 'tbl_add_course_to_student', $field = array(), $where = array('add_course_id' => $course_id, 'student_id' => $sub_admin_id), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
					@$c_name = $course_details_id[0]->course_name;
					@$acc_year = $course_details_id[0]->academic_year;
					@$cls_name = $course_details_id[0]->class_name;
					@$course_details_by_name = @$this->common_model->common($table_name = 'tbl_course', $field = array('course_name'), $where = array('course_id' => $c_name), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
					@$course_name = $course_details_by_name[0]->course_name;


					$this->excel->getActiveSheet()->setCellValue("K" . $excel_id, $acc_year);
					$this->excel->getActiveSheet()->setCellValue("L" . $excel_id, $course_name);
					$this->excel->getActiveSheet()->setCellValue("M" . $excel_id, $cls_name);


				}
				foreach ($sub_details_by_id['s_id'] as $s_id)
				{
					//echo "<pre>";
					//echo $excel_id;
					//print_r($s_id);
					$sub_id = $s_id->subject_name;
					$batch_id = $s_id->batch_name;

					@$subject_details_by_name = @$this->common_model->common($table_name = 'tbl_subject', $field = array('subject_name'), $where = array('subject_id' => $sub_id), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
					@$subject_name = $subject_details_by_name[0]->subject_name;
					$this->excel->getActiveSheet()->setCellValue("N" . $excel_id, $subject_name);
					$this->excel->getActiveSheet()->setCellValue("O" . $excel_id, $batch_id);
					$excel_id++;
				}

			}
			else
			{
				$excel_id++;
			}
		}
//exit;
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
	
	function add_payment_head()
	{
		$st_id = $this->input->post('st_id');
		//$acc_year = $this->input->post('add_academic_year');
		$discount_fee = $this->input->post('discount_fee');
		$payment_head_name = $this->input->post('payment_head_name');
		$txt_payment_head_name = $this->input->post('txt_payment_head_name');

		$service_tax = $this->input->post('discount_service_vat');
		$service_tax_amt = $this->input->post('discount_service_vat_amt');
		$discount_tot_amt = $this->input->post('discount_tot_amt');


		if($payment_head_name == 'Discount')
		{
			$data = array(
				'student_id' => $st_id,
				'payment_head_name' => $payment_head_name,
				'add_payment_head_name' => $txt_payment_head_name,
				'discount_vat' => $service_tax,
				'discount_vat_amt' => $service_tax_amt * -1,
				'discount_tot_amt' => $discount_tot_amt * -1,
				'discount_fee' => $discount_fee * -1,
				'payment_head_frm_date'=> date('Y-m-d')
			);
			//print_r($data);

			//echo $this->input->get('last_url');
			//exit;
			@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');
			redirect('studentlist/add_student_to_payment_view/'.$st_id,'refresh');
			//redirect($this->input->get('last_url'));
		}
		else
		{
			$data = array(
				'student_id' => $st_id,
				'payment_head_name' => $payment_head_name,
				'add_payment_head_name' => $txt_payment_head_name,
				'discount_vat' => $service_tax,
				'discount_vat_amt' => $service_tax_amt,
				'discount_tot_amt' => $discount_tot_amt,
				'discount_fee' => $discount_fee,
				'payment_head_frm_date'=> date('Y-m-d')
			);
			//print_r($data);
			@$this->common_model->insert_data($data, 'tbl_add_course_to_student_payment_details');
			redirect('studentlist/add_student_to_payment_view/'.$st_id,'refresh');
		}

	}

	function refund_fee($id)
	{
		@$payment_id = $id;
		@$st_id = explode('_', $payment_id);
		//print_r($st_id);exit;
		@$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $id);
		@$rec_no 	= 	$st_data['st_detail'][0]->recepit_no;
		@$st_id		=	$st_data['st_detail'][0]->student_id;
		@$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $rec_no);
		//echo "<pre>";print_r($st_data['rec_detail']);
		@$student_id = $st_data['st_detail'][0]->student_id;
		@$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
		@$student_email = $st_data['st_detail'][0]->student_email;

		@$total_fees =0;
		@$total_vat_amt =0;
		@$total_amt =0;
		foreach(@$st_data['rec_detail']  as $pending_payment_details)
		{
			//print_r($pending_payment_details);
			if($pending_payment_details->payment_head_name == 'Exam Fees')
			{
				$payment_head_fee = $pending_payment_details->exam_fee;

			}
			else if($pending_payment_details->payment_head_name == 'Reg Fees')
			{
				$payment_head_fee = $pending_payment_details->course_reg_fee;

			}
			else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
			{
				$payment_head_fee = $pending_payment_details->discount_fee;

			}
			else
			{
				 $payment_head_fee = $pending_payment_details->payment_head_amt;

			}


			if($pending_payment_details->payment_head_name == 'Exam Fees')
			{
				$vat_fee =  $pending_payment_details->exam_vat_fee;
			}
			else if($pending_payment_details->payment_head_name == 'Reg Fees')
			{
				$vat_fee= $pending_payment_details->course_fee_vat_amt;
			}
			else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
			{
				$vat_fee = $pending_payment_details->discount_vat_amt;
			}
			else
			{
				$vat_fee =  $pending_payment_details->payment_head_vat_amt;
			}


			if($pending_payment_details->payment_head_name == 'Exam Fees')
			{
				@$tot_fee = $pending_payment_details->exam_tot_amt;
			}
			else if($pending_payment_details->payment_head_name == 'Reg Fees')
			{
				@$tot_fee = $pending_payment_details->course_vat_tot_amt;
			}
			else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
			{
				$tot_fee = $pending_payment_details->discount_tot_amt;
			}
			else
			{



				@$tot_fee = $pending_payment_details->payment_head_tot_amt;
			}

			$data = array(
				'payment_status' =>	'0',
				'cancel_date'	=>	date('Y-m-d'),
			);
			//print_r($data);
			@$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'recepit_no', $id);
			@$total_fees +=$payment_head_fee;
			@$total_vat_amt +=$vat_fee;
			@$total_amt +=$tot_fee;
		}
		//echo $total_amt;
			/* @$this->email->set_mailtype("html");
			//print_r($st_data);
			@$html_subscriber_user = $this->load->view('admin/mail_template/check_clear', $st_data, true);
			//echo "<pre>";print_r($html_subscriber_user);exit;
			@$this->email->from('admin@parthaedu.com');
			@$this->email->to($student_email);
			@$this->email->subject('Payment Received');
			@$this->email->message($html_subscriber_user);
			@$result = $this->email->send();
			// echo $this->email->print_debugger();*/


		// exit;
		redirect('studentlist/add_student_to_payment_view/'.$st_id,'refresh');
	}
	
	function delete_payment_id($id)
	{
		@$st_data = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
		@$st_id = $st_data[0]->student_id;
		@$rec_no = $st_data[0]->recepit_no;
		//print_r($st_data);
		if($rec_no == "")
		{
			@$this->common_model->delete_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
		}
		else
		{
			echo "<script>alert('Payment Was Received');</script>";
		}
		redirect('studentlist/add_student_to_payment_view/'.$st_id,'refresh');
	}

	//.................Send Sms
	public function send_sms_to_student()
	{
		 $st_id = $this->input->post('chk');
		@$imp = implode("," ,$st_id);
		@$new_st_id = explode(',' , $imp);
		for ($i=0;$i<count($new_st_id);$i++)
		{
			@$st_data = $this->common_model->getAlldata('tbl_student','student_id',$new_st_id[$i]);
			$data['st_detail'][] = $st_data;


		}

		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/send_sms_to_student',$data);
		$this->load->view('admin/template/admin_footer');
	}

	public function sendSms()
	{
		echo $ckh = $this->input->post('rad');
		if($ckh == "student_mobile_no")
		{
			$mo="";
			$mobile_number = $this->input->post("st_mobile");
			$sms_text = $this->input->post("message");
			foreach($mobile_number as $m)
			{
				$mo.=$m.",";
			}
			$bb=substr($mo,0,-1);
			echo $bb;
		}
		else
		{
			$mo="";
			$mobile_number = $this->input->post("p_st_mobile");
			$sms_text = $this->input->post("message");
			foreach($mobile_number as $m)
			{
				$mo.=$m.",";
			}
			$bb=substr($mo,0,-1);
			echo $bb;
		}

		$message = urlencode($sms_text);
		$url='http://smszone.ssas.co.in/submitsms.jsp?';
		$data='user=PARTHA&key=ce9fe6f087XX&mobile='.$bb.'&message='.$message.'&senderid=PARTHA&accusage=1';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		redirect('studentlist');
	}


}


?>