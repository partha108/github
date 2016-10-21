<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class course_module extends CI_Controller {
	
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
			$this->load->library('encrypt');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->library('image_lib');
			$this->load->helper('email');
			$this->load->model('fees_model');
			$this->load->model('common_model');			
			$this->load->helper('date_dropdown_helper');
			
			if($this->session->userdata('schoolbolpur_admin'))
			{
				$session_data = $this->session->userdata('schoolbolpur_admin');
				if(isset($session_data[0]))
				{
					$session_data=$session_data[0];
					$this->user_name = $session_data->username;
					$this->user_fullname = $session_data->first_name.' '. $session_data->last_name;
					$this->user_role = $session_data->role_id;
					$this->user_email =$session_data->email;
					$this->user_id = $session_data->id;
				}	
			}
			else
			{
				redirect('authenticate', 'refresh');
			}
	}

	public function course_class($id)
	{
		//echo $id;

		$data['class'] = $this->common_model->course_class($id);
		$this->load->view('admin/course_class_ajax',$data);


	}
	public function course_class_ul($id)
	{
		//echo $id;
		
		$data['class'] = $this->common_model->course_class($id);
		$this->load->view('admin/course_ajax_ul',$data);
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

		$data['class']= $this->common_model->getAllClasses();
		//$data['course']=$this->common_model->selectAll('tbl_course');
		$data['academic_year']=$this->common_model->selectAll('academic_year');

		// $data['payment_details']=$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_status','pending');
		$data['course']= @$this->common_model->common($table_name='tbl_course',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start=$start,$end=$per_page,$where_in_array=array());
		$data['payment_det_count']= @$this->common_model->common($table_name='tbl_course',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
		$count=count($data['payment_det_count']);
		$data['count']=$count;
		$show_data=count($data['course']);

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



		//$data['class']= $this->common_model->selectAll('tblclass');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/course_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}

	function show_vat($id)
	{
		$acc_value = $_REQUEST['acc_value'];
		@$data_tax=$this->common_model->common($table_name='academic_year',$field=array('service_tax'), $where=array(), $where_or=array(),$like=array('academic_year'=>$acc_value),$like_or=array(),$order=array());
		@$tax=$data_tax[0]->service_tax;
		echo json_encode(array("amount" =>$tax));

	}
	
	function add_course()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}

		$academic_year=trim($this->input->post('add_academic_year'));	
	 	$course_name=trim($this->input->post('add_course_name'));
		$re_course_name = str_replace(' ', '', $course_name);

		$reg_fee = trim($this->input->post('add_reg_fee'));
		$vat =trim($this->input->post('add_service_tax'));
		$vat_amt = trim($this->input->post('vat_amt'));
		$total_amt = trim($this->input->post('add_total_amt'));
		$class_name = $this->input->post('chkbox');
		$new_class_name = implode(",",$class_name);
		//$new_class_name = explode(",",$class_name);
	 	$status = $this->input->post('add_status');


		$data=array(
				'academin_year'=>$academic_year,
				'course_name'=>$course_name,
				'class_name' => $new_class_name,
				'course_reg_fee'=>$reg_fee,
				'vat'=>$vat,
				'vat_amt'=>$vat_amt,
				'total_amt'=>$total_amt,
				'course_status'	=>$status,
				'replace_course'=>$re_course_name
				);
//print_r($data);
			$this->common_model->insert_data($data,'tbl_course');
			redirect('course_module','refresh');
}
	function edit_course_view($id)
	{
		/*echo $course_id = $this->input->post('edit_course_name');
		echo $acy = $this->input->post('academic_year');*/
		$data['edit_course']=$this->common_model->selectOne('tbl_course','course_id',$id);
		$ac_year=$data['edit_course'][0]->academin_year;
		$data['academic_year']=$this->common_model->selectAll('academic_year');
		$data['class']= $this->common_model->getAllClasses_course($ac_year);
		//print_r($data['class']);exit;

		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/edit_course_view',$data);//,$data);
		$this->load->view('admin/template/admin_footer');

	}

function edit_course()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('course_id'));
	$edit_academic_year=trim($this->input->post('edit_academic_year'));
	$edit_course_name=trim($this->input->post('edit_course_name'));
	$edit_reg_fee = trim($this->input->post('edit_reg_fees'));
	$edit_class_name = $this->input->post('course_class');
	$vat =trim($this->input->post('edit_service_tax'));
	$vat_amt = trim($this->input->post('edit_service_tax_amt'));
	$total_amt = trim($this->input->post('tot_amt'));
	$edit_re_course_name = str_replace(' ', '', $edit_course_name);
	if($edit_class_name=="")
	{
		$edit_class_name = $this->input->post('course_class1');
	}
	//print_r($edit_class_name);exit;
	$new_edit_class_name = @implode(",",$edit_class_name);
	
		$data=array(				
			'academin_year'=>$edit_academic_year,
			'course_name'=>$edit_course_name,
			'course_reg_fee' => $edit_reg_fee,
			'class_name' => $new_edit_class_name,
			'vat'=>$vat,
			'vat_amt'=>$vat_amt,
			'total_amt'=>$total_amt,
			'replace_course'=>$edit_re_course_name
			);
//print_r($data);exit;

		$this->common_model->update_data($data,'tbl_course','course_id',$id);
	
	redirect('course_module','refresh');
}

function edit_fees()
{
	$id=trim($this->input->post('id'));
	$edit_fees=$this->common_model->selectOne('tbl_course','course_id',$id);	
	echo json_encode(array("edit_fees" => $edit_fees)) ;
}

function delete_course()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('deleteid'));
	$this->common_model->delete_data('tbl_course','course_id',$id);
	$this->common_model->delete_data('tbl_add_course_subject_to_student','course_id',$id);
	$this->common_model->delete_data('tbl_add_course_to_student','add_subject_id',$id);
	$this->common_model->delete_data('tbl_add_course_to_student_payment_details','course_id',$id);



	redirect('course_module','refresh');
}
	
	
}
?>