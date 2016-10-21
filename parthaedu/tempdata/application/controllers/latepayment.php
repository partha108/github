<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class latepayment extends CI_Controller {
	
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
		$data['latepayment']=$this->common_model->selectAll('latepayment');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/latepayment_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function latepayment_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$month=(int)date("m",strtotime(date("Y-m-d")));
		$year=(int)date("Y",strtotime(date("Y-m-d")));
		$day=(int)date("Y",strtotime(date("Y-m-d")));
		
		$lateamount=$this->common_model->single_value('latepayment','amount','');
		$paid_lateamount=$this->payment_lib->paid_latepayment($lateamount,$year,$month);
		if(count($paid_lateamount)==0)
		{
		
			if((isset($_POST['editid'])))
			{			
				$amount=$this->input->post('amount');
				$end_date=$this->input->post('end_date');
				$process=$this->input->post('process');			
				
				if($amount!='' && $end_date!=''){
					$data=array(
						'amount'=>$amount,
						'end_date'=>$end_date,
						'process'=>$process
						);
					$this->common_model->update_data($data,'latepayment','id',$_POST['editid']);
					redirect('latepayment','refresh');
				}
				else{
					$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during edit.</span>");
					redirect('latepayment','refresh');
				}
			}
			else{
				$amount=$this->input->post('amount');
				$end_date=$this->input->post('end_date');
				$process=$this->input->post('process');
				
				if($amount!='' && $end_date!=''){
					$data=array(
						'amount'=>$amount,
						'end_date'=>$end_date,
						'process'=>$process
						);	
					//echo "<pre>"; print_r($data);exit;			
					$this->common_model->insert_data($data,'latepayment');				
					redirect('latepayment','refresh');
				}
				else{
					$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during add.</span>");
					redirect('latepayment','refresh');
				}
				
			}
		}else{
			$this->session->set_flashdata('message',"<span style='color:red;'>It has been paid already with the amount.So it is not possible to change the amount.<br>Please change the amount on next month within the last date.</span>");
			redirect('latepayment','refresh');
			
		}
		
	}
	
	/*function data_byId(){
		$id=$this->input->post('id');
		$data=$this->common_model->selectWhere('latepayment','id = '.$id);
		$list=array();
		if(count($data)>0){
			foreach($data as $row){
				$list[]=array(
					'id'=>$row->id,
					'amount'=>$row->amount,
					'end_date'=>$row->end_date
					);
			}
		}
		echo json_encode(array('edit'=>$list));
	}*/	
		
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
		$data['fine_pay']=$this->payment_lib->late_payment($_POST['userid'],$_POST['month'],$_POST['year'],$_POST['class'],2);
		$data['fine']='';
		$exist='';
		if(count($data['fine_pay'])==0)
		{	
			$exist=0;
			$data['fine']=$this->payment_lib->latepayment($_POST['month'],$_POST['year']);
		}else{
			$exist=1;
			$data['fine']=$this->payment_lib->latepayment($_POST['month'],$_POST['year']);
		}
		echo json_encode(array('fine'=>$data['fine'],'exists'=>$exist));
	}
	
	
	
	
	
}?>