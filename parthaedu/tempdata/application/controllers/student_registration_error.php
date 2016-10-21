<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class student_registration_error extends CI_Controller {
	
	 private $user_name='';
	 private $user_fullname='';
	 private $user_role = 0;
	 private $user_email='';
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
			$this->load->model('fees_model');
			$this->load->library('image_lib');			
			$this->load->helper('email');			
			$this->load->model('common_model');
			
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
				}
			}
			else
			{
				redirect('authenticate', 'refresh');
			}
	}
	
	public function index()
	{	
		$data['roles']=$this->common_model->getAllRoles();
		$value=0;
		$data['stud_error']=$this->common_model->selectAll('student_registration_error');	
		
		$data['class']=	$this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('section');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/stu_registration_error_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	
	function edit()
	{
		
		$data['stud_list']=$this->common_model->selectOne('student','id',$_GET['userid']);
		echo "<pre>"; print_r($data['stud_list']);	
	}
	
	
}?>