<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sessioncharge extends CI_Controller {
	
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
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$data['latepayment']=$this->common_model->selectAll('sessioncharge');
		foreach($data['latepayment'] as $row)
		{
			$row->classname=$this->common_model->single_value('tblclass','name','id = '.$row->class_id);
		}
		
		$data['class']=$this->common_model->selectWhere('tblclass','status = "active"');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/sessioncharge_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function sessioncharge_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		if((isset($_POST['editid'])))
		{			
			$amount=$this->input->post('amount');
			$class=$this->input->post('class');
			$caution_amount=$this->input->post('caution_amount');
			
			
			if($amount!='' ){
				$data=array(
					'amount'=>$amount,
					'caution_amount'=>$caution_amount,
					'class_id'=>$class,
					'created_date'=>date("Y-m-d H:i:s")
					);
				$this->common_model->update_data($data,'sessioncharge','id',$_POST['editid']);
				redirect('sessioncharge','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during edit.</span>");
				redirect('sessioncharge','refresh');
			}
		}
		else{
			$amount=$this->input->post('amount');
			$class=$this->input->post('class');
			$caution_amount=$this->input->post('caution_amount');
			if($amount!=''){
				$data=array(
					'amount'=>$amount,
					'caution_amount'=>$caution_amount,
					'class_id'=>$class,
					'created_date'=>date("Y-m-d H:i:s")
					);	
				$this->common_model->insert_data($data,'sessioncharge');				
				redirect('sessioncharge','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during add.</span>");
				redirect('sessioncharge','refresh');
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
	
	
}?>