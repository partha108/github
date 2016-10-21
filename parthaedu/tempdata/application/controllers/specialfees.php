<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class specialfees extends CI_Controller {
	
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
			$this->load->model('common_model');
			$this->load->library('image_lib');			
			$this->load->model('fees_model'); 
			$this->load->library('year_month_lib');
			$this->load->library('specialfees_lib');
			
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
					$this->user_id =$session_data->id;
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
		
		$data['concession']=$this->fees_model->select_all('specialfees','','','','','','');
		$data['yearlist']=$this->year_month_lib->yeardropdown();
		$data['monthlist']=$this->year_month_lib->monthdropdown();
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/specialfees_view',$data);
		$this->load->view('admin/template/admin_footer');
		
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
	
	function add_specialfees_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		if((isset($_POST['concession_type'])) && (isset($_POST['concession_amount'])))
		{			
			$concession_type=$this->input->post('concession_type');
			$concession_amount=$this->input->post('concession_amount');
			if($_POST['start_date']==''){ $start='0000-00-00';}else{ $start=$_POST['start_date'];}
			if($_POST['end_date']==''){ $end=$start;}else{ $end=$_POST['end_date'];}
			
			if($concession_type!='' && $concession_amount!=''){
				$data=array(
					'specialfees'=>$concession_type,
					'specialamount'=>$concession_amount,
					'sp_status'=>$_POST['concession_status'],
					'start_date'=>$start,
					'end_date'=>$end
					);
				$this->fees_model->insert_data($data,'specialfees');
				redirect('specialfees','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during add.</span>");
				redirect('specialfees','refresh');
			}
		}
		elseif((isset($_POST['edit_concession_type'])) && (isset($_POST['edit_concession_amount']))){
			$id=$this->input->post('id');
			$concession_type=$this->input->post('edit_concession_type');
			$concession_amount=$this->input->post('edit_concession_amount');
			
			if($_POST['start_date']==''){ $start='0000-00-00';}else{ $start=$_POST['start_date'];}
			if($_POST['end_date']==''){ $end=$start;}else{ $end=$_POST['end_date'];}
			
			if($concession_type!='' && $concession_amount!=''){
				$data=array(
					'specialfees'=>$concession_type,
					'specialamount'=>$concession_amount,
					'sp_status'=>$_POST['concession_status'],
					'start_date'=>$start,
					'end_date'=>$end					
					);
				$this->fees_model->update_data($id,$data,'specialfees','id');
				redirect('specialfees','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during edit.</span>");
				redirect('specialfees','refresh');
			}
			
		}else{			
			redirect('specialfees','refresh');	
		}
		
	}
	
	function userforspecialfees_add()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
			if(isset($_POST['ad_end_month']))
			{
				$endmonth=$_POST['ad_end_month'];
			}else{
				$endmonth='0000-00-00';
			}
			
			if(isset($_POST['ad_effective_month']))
			{
				$effective=$_POST['ad_effective_month'];
			}else{
				$effective='0000-00-00';
			}
		
			$data=array(
				'user_id'=>$_POST['userid'],
				'specialfees_id'=>$_POST['ad_specialfees_list'],
				'amount'=>$_POST['ad_specialfees_amount_modal'],
				'effective_month'=>$effective,
				'endmonth'=>$endmonth,
				'created_date'=>date("Y-m-d H:i:s")
			);
			
			$where='user_id = '.$_POST['userid'].' and paid_month = '.(int)date("m",strtotime($_POST['ad_effective_month']));
			$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['ad_effective_month']));
			$exists=$this->common_model->selectWhere('payment',$where);
			if(count($exists)>0)
			{
				$this->session->set_flashdata('change_con','Payment is already paid for this month.');
				redirect('specialfees/special_user_id?id='.$_POST['userid'],'refresh');
			}
			
			
			$concessionuser_id=$this->common_model->insert_data($data,'specialfees_user');
			$this->session->set_flashdata('change_con','Added...');
			redirect('specialfees/special_user_id?id='.$_POST['userid'],'refresh');
		}
	
		function specialfees_post()
		{
			if($this->user_role!=1)
			{
				$this->load->library('permission_lib');
				$this->permission_lib->permit($this->user_id,$this->user_role);
			}
			
			if(isset($_POST['end_month']))
			{
				$endmonth=$_POST['end_month'];
			}else{
				$endmonth='0000-00-00';
			}
			
			if(isset($_POST['effective_month']))
			{
				$effective=$_POST['effective_month'];
			}else{
				$effective='0000-00-00';
			}
		
			$data=array(
				'specialfees_id'=>$_POST['special_list'],
				'amount'=>$_POST['special_amount_modal'],
				'effective_month'=>$effective,
				'endmonth'=>$endmonth
			);
			$orig_where='user_id = '.$_POST['uid'].' and paid_month = '.(int)date("m",strtotime($_POST['orig_effective_month']));
			$orig_where.=' and paid_year = '.(int)date("Y",strtotime($_POST['orig_effective_month']));
			$orig_exists=$this->common_model->selectWhere('payment',$orig_where);
			if(count($orig_exists)>0)
			{
				$this->session->set_flashdata('change_con','Payment is already paid for this month. Please add another concession.');
				redirect('specialfees/special_user_id?id='.$_POST['uid'],'refresh');
			}
			$where='user_id = '.$_POST['uid'].' and paid_month = '.(int)date("m",strtotime($_POST['effective_month']));
			$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['effective_month']));
			$exists=$this->common_model->selectWhere('payment',$where);
			if(count($exists)>0)
			{
				$this->session->set_flashdata('change_con','Payment is already paid for this month.');
				redirect('specialfees/special_user_id?id='.$_POST['uid'],'refresh');
			}
			if(count($exists)==0 && count($orig_exists)==0)
			{
				$this->session->set_flashdata('change_con','Updated...');
				$this->common_model->update_data($data,'specialfees_user','id',$_POST['specialfeesuser_id']);
				redirect('specialfees/special_user_id?id='.$_POST['uid'],'refresh');
			}
		}
	
	function get_specialfee(){
		$id=$this->input->post('id');
		$data['concession']=$this->fees_model->select_all('specialfees','id',$id,'','','','');
		$list=array();
		if(count($data['concession'])>0){
			foreach($data['concession'] as $row){
				$list[]=array(
					'id'=>$row->id,
					'specialfees'=>$row->specialfees,
					'specialamount'=>$row->specialamount,
					'sp_status'=>$row->sp_status,
					'start_date'=>$row->start_date,
					'end_date'=>$row->end_date
					);
			}
		}
		echo json_encode(array('edit'=>$list));
	}
	
	
	function special_user_id()
	{
		$special_userid='';
		$userid='';
		if(isset($_GET['id']))
		{
			$userid=$this->input->get('id');
		}				
		$data['user_list']=array();
		$data['class_id']=0;
		$data['name']='';
		$data['registration']='';
		
		$data['studetails']= $this->common_model->selectWhere('student','id = '.$userid);
			if(count($data['studetails'])>0)
			{
				foreach($data['studetails'] as $rows)
				{
					$data['registration']=$rows->registration_no;
					$data['name']=$rows->first_name.' '.$rows->middle_name.' '.$rows->last_name;
					$data['class_id']=$rows->class_id;
				}			
			}	
		
		$special_userid=$this->specialfees_lib->specialfees_enabled_id($userid,(int)date("m",strtotime(date("Y-m-d"))),(int)date("Y",strtotime(date("Y-m-d"))));
		
		$data['specialfees_user']=$this->common_model->selectWhere('specialfees_user','user_id = '.$userid.' order by id DESC');		
		foreach($data['specialfees_user'] as $row)
		{
			$row->enable=$this->specialfees_lib->_status($row->effective_month,$row->id,$special_userid);		
											
			$row->registration=$data['registration'];
			$row->name=$data['name'];	
		}
		$data['class']= $this->common_model->selectWhere('tblclass','status = "active"');
		$data['specialfees']= $this->common_model->selectWhere('specialfees','');
		
		//echo "<pre>";print_r($data['specialfees']);exit;	
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/special_user_view',$data);
			$this->load->view('admin/template/admin_footer');
	}
	
	
	
	
	function specialuser_id()
	{
		if(isset($_POST['specialfeesuser_id']))
		{
			$concession_user=$this->common_model->selectWhere('specialfees_user','id = '.$_POST['specialfeesuser_id']);
			echo json_encode(array('edit'=>$concession_user));
		}
	}
	
	
}
?>