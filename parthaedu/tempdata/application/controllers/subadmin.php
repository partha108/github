<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class subadmin extends CI_Controller {
	
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
			$this->load->model('common_model'); 
			$this->load->library('payment_lib');
			$this->load->library('permission_lib');
			
			if($user_data = $this->session->userdata('schoolbolpur_admin'))
			{
				$session_data = $this->session->userdata('schoolbolpur_admin');	
				if(isset($session_data[0]))
				{
					$session_data=$session_data[0];					
					$this->user_id = $session_data->id;	
					$this->user_role= $session_data->role_id;					
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
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$data['subadmin']=$this->common_model->selectWhere('user','role_id = 5');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/subadmin_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function subadmin_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
			if(isset($_POST['editid']))
			{				
				$phone=$_POST['phone'];
				$salary=$_POST['salary'];
				
				if($_POST['first_name']!='' && $_POST['last_name']!='' && $_POST['email']!=''){
					$data=array(
						'role_id'=>5,
						'first_name'=>$_POST['first_name'],
						'last_name'=>$_POST['last_name'],
						'email'=>$_POST['email'],
						'phone'=>$phone,
						'salary'=>$salary
						);
					$this->common_model->update_data($data,'user','id',$_POST['editid']);
					redirect('subadmin','refresh');
				}
				else{
					$this->session->set_flashdata('message',"<span style='color:red;'>Name And Email should not be empty.</span>");
					redirect('subadmin','refresh');
				}
			}
			else{
				$first_name=$this->input->post('first_name');
				$last_name=$this->input->post('last_name');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$salary=$this->input->post('salary');
				
				$maxid=$this->common_model->max_id('user','id');
				if($first_name!='' || $last_name!=''){
					$username=($maxid+1).(substr($first_name,0,2).substr($last_name,0,2));     //username is unique.
				}else{
					$this->session->set_flashdata('message',"<span style='color:red;'>Name should not be empty.</span>");
					redirect('subadmin','refresh');
				}
								
				if($first_name!='' && $last_name!='' && $email!=''){
					$data=array(
						'role_id'=>5,
						'username'=>$username,
						'password'=>$username,
						'first_name'=>$first_name,
						'last_name'=>$last_name,
						'email'=>$email,
						'phone'=>$phone,
						'salary'=>$salary,
						'lastlogon_datetime'=>date("Y-m-d H:i:s"),
						'registration_date'=>date("Y-m-d H:i:s")
						);
					$this->common_model->insert_data($data,'user');
					redirect('subadmin','refresh');
				}
				else{
					$this->session->set_flashdata('message',"<span style='color:red;'>Name And Email should not be empty.</span>");
					redirect('subadmin','refresh');
				}
				
			}
		
		
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
		redirect($page,'refresh');
	}
	
	function count_late_fine()
	{		
		$this->load->library('payment_lib');			
		$data['fine']=$this->payment_lib->latepayment($_POST['month'],$_POST['year']);
		echo json_encode(array('fine'=>$data['fine']));
	}
	
	function changepassword()
	{
		if($this->user_role!=1)
		{
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		if($_POST['newpass']!=''){
		$data=array(
			'password'=>$_POST['newpass']
			);
		$this->common_model->update_data($data,'user','id',$_POST['edit_id']);
		redirect('subadmin','refresh');
		}else{
			$this->session->set_flashdata('message',"<span style='color:red;'>Password should not be empty.</span>");					
			redirect('subadmin','refresh');
		}
			
	}
	
	
	
}?>