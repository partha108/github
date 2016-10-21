<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class total_amount extends CI_Controller {
	
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

		
		
		$data['payment_head']=$this->common_model->selectAll('tbl_payment_head');

		$data['exam_fee']=$this->common_model->sum_exam('tbl_class');
		$data['reg_fee']=$this->common_model->sum_reg('tbl_course');
		$data['paid'] = $this->common_model->add_total_amt_data('tbl_add_course_to_student_payment_details','exam_fee','payment_status','paid','payment_status','1');
		$data['reg_paid'] = $this->common_model->add_total_amt_data('tbl_add_course_to_student_payment_details','course_reg_fee','payment_status','paid','payment_status','1');

		//print_r($data['ist']);
				
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/total_amount_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}

	
}
?>