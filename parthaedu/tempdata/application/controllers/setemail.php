<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class setemail extends CI_Controller {	
	
	private $user_role='';
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
			$this->load->library('year_month_lib');
			$this->load->library('payment_lib');
			
			
			if($this->session->userdata('schoolbolpur_admin'))
			{
				$session_data = $this->session->userdata('schoolbolpur_admin');
				if(isset($session_data[0]))
				{
					$session_data=$session_data[0];
					$this->user_id = $session_data->id;
					$this->user_role = $session_data->role_id;
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
		$data['fromemail']=$this->common_model->selectAll('tblemail');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/email_management_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
			
		
	function emailUpdate_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		 $email=trim($this->input->post('email_change'));
		 $id=trim($this->input->post('email_id'));
		 $table=trim($this->input->post('table'));
		 $changecolumn=trim($this->input->post('changecolumn'));	
		 $data=array($changecolumn=>$email);
		 if($table=='tblemail'){
			$this->common_model->update_data($data,'tblemail','email_id',$id);
		 }
		 redirect('setemail','refresh');
	}
	
}
?>