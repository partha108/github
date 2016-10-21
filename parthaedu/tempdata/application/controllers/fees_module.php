<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class fees_module extends CI_Controller {
	
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
		
		$data['fees']=$this->common_model->selectAll('fees');
		$data['class']= $this->common_model->selectAll('tblclass');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/fees_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}
	
	function add_fees_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
				
	$class_id=trim($this->input->post('class'));
	
	if($class_id==0)
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Select Class.</span>');
	 	 redirect('fees_module','refresh');	
	 }else{
		$exists=$this->common_model->selectWhere('fees','class_id = '.$class_id); 
		if(count($exists)>0)
		{
			$this->session->set_flashdata('emptypost','<span style="color:red">Fees already exists for the class .</span>');
	 	 	redirect('fees_module','refresh');	
		}
	 }
	$school_fees=trim($this->input->post('school_fees')); 			
	 if($school_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Tution Fees.</span>');
	 	redirect('fees_module','refresh');	
	 }
	$hostel_fees=trim($this->input->post('hostel_fees')); 			
	if($hostel_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Hostel Fees.</span>');
	 	 redirect('fees_module','refresh');	
	 }
	$admission_fees=trim($this->input->post('admission_fees'));		
	if($admission_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Fooding Fees.</span>');
	 	 redirect('fees_module','refresh');	
	 }
	 $electric_charge=0;
	/*$electric_charge=trim($this->input->post('electric_charge'));	
	if($electric_charge=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Electric Charge.</span>');
	 	 redirect('fees_module','refresh');	
	 }*/
	$total=trim($this->input->post('total')); if($total==''){ $total=0;  }
	 $total_sum=	$school_fees+$hostel_fees+$admission_fees+$electric_charge;
	if($total_sum==$total){
		$total=	$total_sum;
		$data=array(
				'class_id'=>$class_id,
				'school_fees'=>$school_fees,
				'hostel_fees'=>$hostel_fees,
				'admission_fees'=>$admission_fees,
				'electric_charge'=>$electric_charge,
				'total'=>$total,
				'created_date'=>date("Y-m-d"),
				'class_id'=>$class_id
							);	
							
		$this->common_model->insert_data($data,'fees');
		redirect('fees_module','refresh');
	}
	else{
		$this->session->set_flashdata('emptypost','<span style="color:red">Please check all fields.</span>');
	 	 redirect('fees_module','refresh');	
	}
	
}

function edit_fees_post()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('id'));
	$class_id=trim($this->input->post('edit_class'));              
	 if($class_id==''){ $class_id=0;  }
	 if($class_id==0)
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Select Class.</span>');
	 	 redirect('fees_module','refresh');	
	 }	
	
	$school_fees=trim($this->input->post('edit_school_fees'));
	 if($school_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please School Fees.</span>');
	 	 redirect('fees_module','refresh');	
	 }
	$hostel_fees=trim($this->input->post('edit_hostel_fees'));
	if($hostel_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Hostel Fees.</span>');
	 	 redirect('fees_module','refresh');	
	 }
	$admission_fees=trim($this->input->post('edit_admission_fees'));
	if($admission_fees=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Admission Fees.</span>');
	 	 redirect('fees_module','refresh');	
	 }
	 $electric_charge=0;
	/*$electric_charge=trim($this->input->post('edit_electric_charge'));
	if($electric_charge=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Please Electric Charge.</span>');
	 	 redirect('fees_module','refresh');	
	 }*/
	$total=trim($this->input->post('edit_total')); 
	if($total=='')
	 { 
		 $this->session->set_flashdata('emptypost','<span style="color:red">Total should not be empty</span>');
	 	 redirect('fees_module','refresh');	
	 }
	$total_sum=	$school_fees+$hostel_fees+$admission_fees+$electric_charge;			
	if($total_sum==$total)
	{
		$total=	$total_sum;
		$data=array(
					'class_id'=>$class_id,
					'school_fees'=>$school_fees,
					'hostel_fees'=>$hostel_fees,
					'admission_fees'=>$admission_fees,
					'electric_charge'=>$electric_charge,
					'total'=>$total
					);
		$this->common_model->update_data($data,'fees','id',$id);
	}
	else{
		$this->session->set_flashdata('emptypost','<span style="color:red">Please check all fields.</span>');
	 	 redirect('fees_module','refresh');	
	}
	redirect('fees_module','refresh');	
}

function edit_fees()
{
	$id=trim($this->input->post('id'));
	$edit_fees=$this->common_model->selectOne('fees','id',$id);	
	echo json_encode(array("edit_fees" => $edit_fees)) ;
}

function delete_fees()
{
	if($this->user_role!=1)
	{
		$this->load->library('permission_lib');
		$this->permission_lib->permit($this->user_id,$this->user_role);
	}
				
	$id=trim($this->input->post('deleteid'));
	$this->common_model->delete_data('fees','id',$id);
	redirect('fees_module','refresh');
}
	
	
}
?>