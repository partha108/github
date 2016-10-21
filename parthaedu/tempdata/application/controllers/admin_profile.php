<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_profile extends CI_Controller {
	  
	 private $user_id='';
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
			$this->load->library('permission_lib');
			
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
				/*if($this->user_role!=1)
				{
					$this->session->set_flashdata('logoutmsg','<span style="color:red">Only Administrator have access.</span>');
					redirect('authenticate', 'refresh');
				}*/
			}
			else
			{
				redirect('authenticate', 'refresh');
			}
	}
	
	public function index()
	{
		$data['userdata']=$this->common_model->selectWhere('user','username = "'.$this->user_name.'" and role_id = '.$this->user_role);
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/profile_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
											
							
	public function update()
	{
		if($_POST['first_name']!='' && $_POST['last_name']!='' && $_POST['email']!=''){
			$data=array(
				'first_name'=>$_POST['first_name'],
				'last_name'=>$_POST['last_name'],
				'email'=>$_POST['email'],
				'phone'=>$_POST['phone']
				);
				
			$this->common_model->update_data($data,'user','id',$_POST['editid']);			
		}else{
			$this->session->set_flashdata('insert_message',"<span style='color:red;'>Name and Email should not be empty.</span>");
			redirect('admin_profile','refresh');
		}
		redirect('admin_profile','refresh');	
	}
							
							
	function changepassword()
	{
		if($this->user_role==1)
		{		
			
			if($_POST['newpass']!=''){
			$data=array(
				'password'=>$_POST['newpass']
				);
			$this->common_model->update_data($data,'user','id',$_POST['edit_id']);
			redirect('admin_profile','refresh');
			}else{
				$this->session->set_flashdata('insert_message',"<span style='color:red;'>Password should not be empty.</span>");					
				redirect('admin_profile','refresh');
			}
		}else{
			$this->session->set_flashdata('insert_message',"<span style='color:red;'>You have not Access.</span>");					
			redirect('admin_profile','refresh');
		}
			
	}	
	
	
	
}
?>