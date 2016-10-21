<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class class_module extends CI_Controller {
	
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

		//$data['class']= $this->common_model->getAllclass_classname();
		$data['academic_year']=$this->common_model->selectAll('academic_year');
		//$data['course']=$this->common_model->selectAll('tbl_course');


		// $data['payment_details']=$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','payment_status','pending');
		$data['class']= @$this->common_model->common($table_name='tbl_class',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start=$start,$end=$per_page,$where_in_array=array());
		$data['payment_det_count']= @$this->common_model->common($table_name='tbl_class',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or_array=array(),$order=array(),$start='',$end='',$where_in_array=array());
		$count=count($data['payment_det_count']);
		$data['count']=$count;
		$show_data=count($data['class']);

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
		$this->load->view('admin/class_list_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}

	function course($id)
	{
		@$data['s'] = $this->common_model->course($id);
		$this->load->view('admin/course_ajax',$data);

	}

	function add_reg_total_amt()
	{
		$reg_amount = 	$_REQUEST['course_id'];
		$data_tax	=	$this->common_model->common($table_name='academic_year',$field=array('service_tax'), $where=array(),
			$where_or=array(),$like=array('academic_year'=>$reg_amount),$like_or=array(),$order=array());
		$tax		=	$data_tax[0]->service_tax;
		echo json_encode(array("amount" =>$tax));
	}
	
	function edit_course_model($id)
	{
		@$data['s'] = $this->common_model->course($id);
		$this->load->view('admin/edit_course_ajax',$data);
	}

	function add_class()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$academic_year = $this->input->post('add_academic_year');	

		$class_name=$this->input->post('add_class');	
		//$new_class_name = explode(",",$class_name);
		$new_sub = str_replace(' ', '', $class_name);

		$exam_fee = $this->input->post('add_exam_fee');
		//$new_exam_fee = explode(",",$exam_fee);
		$vat = $this->input->post('add_vat');
		$vat_amt = $this->input->post('add_vat_amt');
		$tot_amt = $this->input->post('add_tot_amt');

		$class_status = $this->input->post('add_status');
		//print_r($new_class_name);
		//print_r($new_exam_fee);
		//exit;
	 	$status = trim($this->input->post('add_status'));



			$data=array(
				'class_academic_year' => $academic_year,
				'class_name' =>$class_name,
				'rep_cls_name'	=>	$new_sub,
				'exam_fee' => $exam_fee,
				'vat'=>$vat,
				'vat_amt'=>$vat_amt,
				'tot_amt'=>$tot_amt,
				'class_status' => $status
			);
			//echo "<pre>";print_r($data);
			$this->common_model->insert_data($data,'tbl_class');


	//$this->common_model->insert_data($data,'tbl_class');
	redirect('class_module','refresh');
}

function edit_class()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('id'));
	$edit_class_name=trim($this->input->post('edit_class_name'));
	$new_sub = str_replace(' ', '', $edit_class_name);
	$edit_fees = trim($this->input->post('edit_exam_fee'));
	
	$edit_class_status = trim($this->input->post('edit_status'));
	$vat = $this->input->post('edit_vat');
	$vat_amt = $this->input->post('edit_vat_amt');
	$tot_amt = $this->input->post('edit_tot_amt');
	
		$data=array(				
			'class_name'=>$edit_class_name,
			'rep_cls_name'	=>	$new_sub,
			'exam_fee' => $edit_fees,
			'vat'=>$vat,
			'vat_amt'=>$vat_amt,
			'tot_amt'=>$tot_amt,
			'class_status'=>$edit_class_status,
							
			);	
		$this->common_model->update_data($data,'tbl_class','class_id',$id);
	
	redirect('class_module','refresh');	
}

function edit_fees()
{
	$id=trim($this->input->post('id'));
	$edit_fees=$this->common_model->selectOne('tbl_class','class_id',$id);	
	echo json_encode(array("edit_fees" => $edit_fees)) ;
}

function delete_class()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('deleteid'));
	$this->common_model->delete_data('tbl_class','class_id',$id);
	redirect('class_module','refresh');
}

/*function active_more_than_one_subject()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
			'class_status'=>'active'
			);
			//echo $value;
			$this->db->where('class_id', $sub_admin_id);
			$this->db->update('tbl_class',$data_sub_admin_active_inactive);
			redirect('class_module','refresh');
		}

		//$id=$this->input->post('id');

	}

	function in_active_more_than_one_subject()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
			'class_status'=>'inactive'
			);
			//echo $value;
			$this->db->where('class_id', $sub_admin_id);
			$this->db->update('tbl_class',$data_sub_admin_active_inactive);
			redirect('class_module','refresh');
		}

		//$id=$this->input->post('id');

	}*/
	function sub_admin_active_inactive()
	{
		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_sub_admin_active_inactive=array(
			'class_status'=>$value
		);
		//echo $value;
		$this->db->where('class_id', $id);
		$this->db->update('tbl_class',$data_sub_admin_active_inactive);
	}



	function sub_admin_active_more_than_one_id()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'class_status'=>'active'
			);
			//echo $value;
			$this->db->where('class_id', $sub_admin_id);
			$this->db->update('tbl_class',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}

	function sub_admin_in_active_more_than_one_id()
	{
		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
				'class_status'=>'inactive'
			);
			//echo $value;
			$this->db->where('class_id', $sub_admin_id);
			$this->db->update('tbl_class',$data_sub_admin_active_inactive);
		}

		//$id=$this->input->post('id');

	}



}
?>