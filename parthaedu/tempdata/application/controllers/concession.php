<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class concession extends CI_Controller {
	
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
			$this->load->library('concession_lib');
			$this->load->library('year_month_lib');
			
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
		$data['concession']=$this->fees_model->select_all('concession','','','','','','');
		//$data['monthlist']=$this->monthdropdown();
		$data['yearlist']=$this->year_month_lib->yeardropdown();
		$data['monthlist']=$this->year_month_lib->monthdropdown();
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/concession_view',$data);
		$this->load->view('admin/template/admin_footer');
	}

	function add_concession_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		if((isset($_POST['concession_type'])) && (isset($_POST['concession_amount']))){
			
			$concession_type=$this->input->post('concession_type');
			$concession_amount=$this->input->post('concession_amount');
			if($_POST['start_date']==''){ $start='0000-00-00';}else{ $start=$_POST['start_date'];}
			if($_POST['end_date']==''){ $end='0000-00-00';}else{ $end=$_POST['end_date'];}
			
			if($concession_type!='' && $concession_amount!=''){
				$data=array(
					'concession_type'=>$concession_type,
					'concession_amount'=>$concession_amount,
					'concession_status'=>$_POST['concession_status'],
					'start_date'=>$start,
					'end_date'=>$end
					);
				$this->fees_model->insert_data($data,'concession');
				redirect('concession','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during add.</span>");
				redirect('concession','refresh');
			}
		}
		elseif((isset($_POST['edit_concession_type'])) && (isset($_POST['edit_concession_amount']))){
			$id=$this->input->post('id');
			$concession_type=$this->input->post('edit_concession_type');
			$concession_amount=$this->input->post('edit_concession_amount');
			
			if($_POST['start_date']==''){ $start='0000-00-00';}else{ $start=$_POST['start_date'];}
			if($_POST['end_date']==''){ $end='0000-00-00';}else{ $end=$_POST['end_date'];}
			
			if($concession_type!='' && $concession_amount!=''){
				$data=array(
					'concession_type'=>$concession_type,
					'concession_amount'=>$concession_amount,
					'concession_status'=>$_POST['concession_status'],
					'start_date'=>$start,
					'end_date'=>$end
					
					);
				$this->fees_model->update_data($id,$data,'concession','id');
				redirect('concession','refresh');
			}
			else{
				$this->session->set_flashdata('message',"<span style='color:red;'>Fields should not be empty during edit.</span>");
				redirect('concession','refresh');
			}
			
		}else{
			
			redirect('concession','refresh');	
		}
		
	}
	
	function concession_data_byId(){
		$id=$this->input->post('id');
		$data['concession']=$this->fees_model->select_all('concession','id',$id,'','','','');
		$list=array();
		if(count($data['concession'])>0){
			foreach($data['concession'] as $row){
				$list[]=array(
					'id'=>$row->id,
					'concession_type'=>$row->concession_type ,
					'concession_amount'=>$row->concession_amount,
					'concession_status'=>$row->concession_status,
					'start_date'=>$row->start_date,
					'end_date'=>$row->end_date
					);
			}
		}
		echo json_encode(array('edit'=>$list));
	}
	
	function concessionandspecial()
	{
		$data['class']= $this->fees_model->select_all('tblclass','status','active','','','','');
		$data['concession']= $this->fees_model->select_all('concession','','','','','','');
			if(isset($_GET['class_id']))
			{
				$data['class_id']=$_GET['class_id'];
			}
			else if(isset($_POST['class']))
			{
				$data['class_id']=$_POST['class'];
			}
			else{
				$data['class_id']=1;
			}
			$whereclause='class_id = '.$data['class_id'].' ORDER BY id DESC';			
			$data['user_list']=$this->common_model->selectWhere('student',$whereclause);			
			
			$whereclause='class_id = '.$data['class_id'].' and year(updated_date) = '.(int)date("Y",strtotime(date("Y-m-d")));		
					//$data['user_list']=$this->common_model->selectWhere('student',$whereclause);
				$data['user_list']=$this->common_model->selectWhere('fees_user_class',$whereclause);
				
			foreach($data['user_list'] as $row)
			{
				$row->concession=0;
				$row->concession_efective='0000-00-00';
				
				$whereconcession='user_id = '.$row->user_id.' and Month(effective_month) = '.(int)date("m",strtotime(date("Y-m-d")));
				$whereconcession.=' and Year(effective_month) = '.(int)date("Y",strtotime(date("Y-m-d"))).' order by id DESC' ;					
				$data_conce=$this->common_model->selectWhere('concession_user',$whereconcession);					
					if(count($data_conce)>0)
					{
						$row->concession=$data_conce[0]->amount;	
						$row->concession_efective=$data_conce[0]->effective_month;				
					}								
				$row->specialfee=0;
				$row->specialfee_efective='0000-00-00';
				
				$where_special='user_id = '.$row->user_id.' and Month(effective_month) = '.(int)date("m",strtotime(date("Y-m-d")));
				$where_special.=' and Year(effective_month) = '.(int)date("Y",strtotime(date("Y-m-d"))).' order by id DESC' ;
				$data_spe=$this->common_model->selectWhere('specialfees_user',$where_special);
				if(count($data_spe)>0)
				{
					$row->specialfee=$data_spe[0]->amount;
					$row->specialfee_efective=$data_spe[0]->effective_month;
				}
				
				$name=$this->common_model->selectColmnWhere('student','first_name,middle_name,last_name,registration_no','id = '.$row->user_id);
				if(isset($name[0]))
				{
					$row->name=$name[0]->first_name.' '.$name[0]->last_name;
					$row->registration_no=$name[0]->registration_no;
				}
			}			
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/concession_special_view',$data);
			$this->load->view('admin/template/admin_footer');
		}
		
		function userforconcession_add()
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
				'concession_id'=>$_POST['ad_concession_list'],
				'amount'=>$_POST['ad_concession_amount_modal'],
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
				redirect('concession/concession_user_id?id='.$_POST['userid'],'refresh');
			}
			
			
			$concessionuser_id=$this->common_model->insert_data($data,'concession_user');
			$this->session->set_flashdata('change_con','Added...');
			redirect('concession/concession_user_id?id='.$_POST['userid'],'refresh');
		}
		
		function concession_post()
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
				$endmonth=$_POST['effective_month'];
			}else{
				$endmonth='0000-00-00';
			}
			
			$data=array(
				'concession_id'=>$_POST['concession_list'],
				'amount'=>$_POST['concession_amount_modal'],
				'effective_month'=>$_POST['effective_month'],
				'endmonth'=>$endmonth
			);
			$orig_where='user_id = '.$_POST['uid'].' and paid_month = '.(int)date("m",strtotime($_POST['orig_effective_month']));
			$orig_where.=' and paid_year = '.(int)date("Y",strtotime($_POST['orig_effective_month']));
			$orig_exists=$this->common_model->selectWhere('payment',$orig_where);
			if(count($orig_exists)>0)
			{
				$this->session->set_flashdata('change_con','Payment is already paid for this month. Please add another concession.');
				redirect('concession/concession_user_id?id='.$_POST['uid'],'refresh');
			}
			$where='user_id = '.$_POST['uid'].' and paid_month = '.(int)date("m",strtotime($_POST['effective_month']));
			$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['effective_month']));
			$exists=$this->common_model->selectWhere('payment',$where);
			if(count($exists)>0)
			{
				$this->session->set_flashdata('change_con','Payment is already paid for this month.');
				redirect('concession/concession_user_id?id='.$_POST['uid'],'refresh');
			}
			if(count($exists)==0 && count($orig_exists)==0)
			{
				$this->session->set_flashdata('change_con','Updated...');
				$this->common_model->update_data($data,'concession_user','id',$_POST['concessionuser_id']);
				redirect('concession/concession_user_id?id='.$_POST['uid'],'refresh');
			}
		}
	
	function concession_user_id()
	{
		$concession_userid='';
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
		
		$concession_userid=$this->concession_lib->concession_enabled_id($userid,(int)date("m",strtotime(date("Y-m-d"))),(int)date("Y",strtotime(date("Y-m-d"))));
				
		$data['concession_user']=$this->common_model->selectWhere('concession_user','user_id = '.$userid.' order by effective_month DESC');
		foreach($data['concession_user'] as $row)
		{
			$this->load->library('specialfees_lib');
			$row->enable=$this->specialfees_lib->_status($row->effective_month,$row->id,$concession_userid);
			$row->registration=$data['registration'];
			$row->name=$data['name'];		
			
		}
		$data['class']= $this->common_model->selectWhere('tblclass','status = "active"');
		$data['concession']= $this->common_model->selectWhere('concession','');
		//echo "<pre>"; print_r($data['class']); exit;		
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/concession_user_view',$data);
			$this->load->view('admin/template/admin_footer');
	}
	
	function concessionuser_id()
	{
		if(isset($_POST['concessionuser_id']))
		{
			$concession_user=$this->common_model->selectWhere('concession_user','id = '.$_POST['concessionuser_id']);
			echo json_encode(array('edit'=>$concession_user));
		}
	}
	
	function monthdropdown(){
		$months = array();
		$currentMonth = (int)date('m');
		$m=1;
		for($x = $currentMonth; $x < $currentMonth+12; $x++) 
		{
			$month = date('F', mktime(0, 0, 0, $x, 1));
			if($x>=13)	{
			$months[$m] = $month;
			 $m++;
			}
			else{
			$months[$x] = $month;	
			}
		
		}return $months;
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