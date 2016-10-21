<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class deductionandincentive extends CI_Controller {
	
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
			$this->load->library('specialfees_lib');
			$this->load->library('payment_lib');
			
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
	
	function index()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$this->load->library('salary_payment_lib');
		
		$year=(int)date("Y",strtotime(date("Y-m-d")));
		$month=4;//(int)date("m",strtotime(date("Y-m-d")));
		$where='';
		$data['user_list']=$this->common_model->selectColmnWhere('salary_teacher','user_id,salary','year(updated_date) = '.$year.$where);			
		foreach($data['user_list'] as $row)
		{
			$row->concession=0;
			$row->concession_efective='0000-00-00';
			$row->endmonth='0000-00-00';
				$data_conce=$this->salary_payment_lib->concession($row->user_id,$month,$year);					
					if(count($data_conce)>0)
					{
						$row->concession=$data_conce[0]->amount;	
						$row->concession_efective=$data_conce[0]->effective_month;	
						$row->endmonth=$data_conce[0]->endmonth;				
					}								
				$row->specialfee=0;
				$row->specialfee_efective='0000-00-00';
				$row->specialfee_endmonth='0000-00-00';
				$data_spe=$this->salary_payment_lib->special($row->user_id,$month,$year);				
				if(count($data_spe)>0)
				{
					$row->specialfee=$data_spe[0]->amount;
					$row->specialfee_efective=$data_spe[0]->effective_month;
					$row->specialfee_endmonth=$data_spe[0]->endmonth;
				}
				
				$name=$this->common_model->selectColmnWhere('teacher','first_name,middle_name,last_name','id = '.$row->user_id);
				if(isset($name[0]))
				{
					$row->name=$name[0]->first_name;
					if($name[0]->middle_name!='')
					{
						$row->name.=$name[0]->middle_name;
					}
					$row->name.=$name[0]->last_name;
				}				
			}
			
			$this->load->view('admin/template/admin_header');
			$this->load->view('admin/template/admin_leftmenu');
			$this->load->view('admin/deduct_incentive_view',$data);
			$this->load->view('admin/template/admin_footer');
	}
	
	function deduction()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$data['concession']=$this->fees_model->select_all('concession','concession_status','individual','','','','');		
		$this->load->library('salary_payment_lib');
		if(isset($_GET['id']))
		{
			$userid=$_GET['id'];
		}else{
			$userid='';
		}
		$data['for']='Deduction';
		
		$year=(int)date("Y",strtotime(date("Y-m-d")));
		$month=(int)date("m",strtotime(date("Y-m-d")));
		$data['namee']='';
		$name=$this->common_model->selectColmnWhere('teacher','first_name,middle_name,last_name','id = '.$userid);
				if(isset($name[0]))
				{
					$data['namee']=$name[0]->first_name;
					if($name[0]->middle_name!='')
					{
						$data['namee'].=$name[0]->middle_name;
					}
					$data['namee'].=$name[0]->last_name;
					$data['for']='Deduction of '.$data['namee'];
				}	
				
		$data['user_list']=$this->salary_payment_lib->concession($userid,'',$year);					
		if(count($data['user_list'])>0)
		{
			foreach($data['user_list'] as $row)
			{
				$row->name=$data['namee'];		
			}
		}
		$data['model']='concession_control';
		//echo "<pre>"; print_r($data); exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/deduction_n_incentive_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	
	
	function incentive()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$data_conce['concession']=$this->fees_model->select_all('specialfees','sp_status','individual','','','','');
		
		$this->load->library('salary_payment_lib');
		if(isset($_GET['id']))
		{
			$userid=$_GET['id'];
		}else{
			$userid='';
		}
		$data_conce['for']='Incentive';
		$data['namee']='';
		$name=$this->common_model->selectColmnWhere('teacher','first_name,middle_name,last_name','id = '.$userid);
				if(isset($name[0]))
				{
					$data['namee']=$name[0]->first_name;
					if($name[0]->middle_name!='')
					{
						$data['namee'].=$name[0]->middle_name;
					}
					$data['namee'].=$name[0]->last_name;
					$data_conce['for']='Deduction of '.$data['namee'];
				}	
				
		$year=(int)date("Y",strtotime(date("Y-m-d")));
		$month=(int)date("m",strtotime(date("Y-m-d")));
		
		$data_conce['user_list']=$this->salary_payment_lib->special($userid,'',$year);
							
		if(count($data_conce['user_list'])>0)
		{
			foreach($data_conce['user_list'] as $row)
			{
				$row->name=$data['namee'];
					$data_conce['for']='Incentive of '.$row->name;					
							
			}
		}
		$data_conce['model']='special_control';
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/deduction_n_incentive_view',$data_conce);
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
			}
			else if(isset($_POST['end_month']))
			{
				$endmonth=$_POST['end_month'];
			}			
			else{
				$endmonth='0000-00-00';
			}
			
			if(isset($_POST['ad_effective_month']))
			{
				$effective=$_POST['ad_effective_month'];
			}
			else if(isset($_POST['effective_month']))
			{
				$effective=$_POST['effective_month'];
			}			
			else{
				$effective='0000-00-00';
			}
			
			if(isset($_POST['userid']))
			{
				$userid=$_POST['userid'];
			}
			else if(isset($_POST['uid']))
			{
				$userid=$_POST['uid'];
			}else{	
				$userid='';
			}
			
			if(isset($_POST['ad_concession_list']))
			{
				$ad_concession=$_POST['ad_concession_list'];
			}
			else if(isset($_POST['concession_list']))
			{
				$ad_concession=$_POST['concession_list'];
			}else{	
				$ad_concession='';
			}
			
			if(isset($_POST['ad_concession_amount_modal']))
			{
				$ad_concession_amount=$_POST['ad_concession_amount_modal'];
			}
			else if(isset($_POST['concession_amount_modal']))
			{
				$ad_concession_amount=$_POST['concession_amount_modal'];
			}else{	
				$ad_concession_amount=0.00;
			}
			
			if(isset($_POST['concessionuser_id']))
			{
				$concessionuser_id=$_POST['concessionuser_id'];
			}else{	
				$concessionuser_id='';
			}
			
			if(isset($_POST['userid'])!='' )
			{		
				$data=array(
					'user_id'=>$_POST['userid'],
					'concession_id'=>$ad_concession,
					'amount'=>$ad_concession_amount,
					'effective_month'=>$effective,
					'endmonth'=>$endmonth,
					'created_date'=>date("Y-m-d H:i:s")
				);
				
				//echo "<pre>"; print_r($data);print_r($_POST);exit;
			}else{
				$data=array(
					'user_id'=>$userid,
					'concession_id'=>$ad_concession,
					'amount'=>$ad_concession_amount,
					'effective_month'=>$effective,
					'endmonth'=>$endmonth
				);
			}
			
			if(isset($_POST['ad_effective_month']))
			{
				$where='user_id = '.$_POST['userid'].' and role_id NOT IN (2) and paid_month = '.(int)date("m",strtotime($_POST['ad_effective_month']));
				$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['ad_effective_month']));
				$exists=$this->common_model->selectWhere('payment',$where);
				if(count($exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month.');
					redirect('deductionandincentive/deduction?id='.$_POST['userid'],'refresh');
				}
				$where='user_id = '.$_POST['userid'].' and Month(effective_month) = '.(int)date("m",strtotime($_POST['ad_effective_month']));
				$where.=' and Year(effective_month) = '.(int)date("Y",strtotime($_POST['ad_effective_month']));
				$add_exists=$this->common_model->selectWhere('concession_teacher',$where);
				if(count($add_exists)>0)
				{
					$this->session->set_flashdata('change_con','Already Added Set With The effective Month For The User.');
					redirect('deductionandincentive/deduction?id='.$_POST['userid'],'refresh');
				}
								
				$concessionuser_id=$this->common_model->insert_data($data,'concession_teacher');
				$this->session->set_flashdata('change_con','Added...');
				redirect('deductionandincentive/deduction?id='.$_POST['userid'],'refresh');
			}
			
			if(isset($_POST['orig_effective_month']))
			{
				$orig_where='user_id = '.$_POST['uid'].' and role_id NOT IN (2) and paid_month = '.(int)date("m",strtotime($_POST['orig_effective_month']));
				$orig_where.=' and paid_year = '.(int)date("Y",strtotime($_POST['orig_effective_month']));
				$orig_exists=$this->common_model->selectWhere('payment',$orig_where);
				if(count($orig_exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month. Please add another concession.');
					redirect('deductionandincentive/deduction?id='.$_POST['uid'],'refresh');
				}
				$where='user_id = '.$_POST['uid'].' and role_id NOT IN (2) and paid_month = '.(int)date("m",strtotime($_POST['effective_month']));
				$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['effective_month']));
				$exists=$this->common_model->selectWhere('payment',$where);
				if(count($exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month.');
					redirect('deductionandincentive/deduction?id='.$_POST['uid'],'refresh');
				}
				if(count($exists)==0 && count($orig_exists)==0)
				{
					$this->session->set_flashdata('change_con','Updated...');
					$this->common_model->update_data($data,'concession_teacher','con_id',$_POST['concessionuser_id']);
					redirect('deductionandincentive/deduction?id='.$_POST['uid'],'refresh');
				}
			}
		}
		
	function userincentive()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}	
		if(isset($_POST['ad_end_month']))
			{
				$endmonth=$_POST['ad_end_month'];
			}
			else if(isset($_POST['end_month']))
			{
				$endmonth=$_POST['end_month'];
			}			
			else{
				$endmonth='0000-00-00';
			}
			
			if(isset($_POST['ad_effective_month']))
			{
				$effective=$_POST['ad_effective_month'];
			}
			else if(isset($_POST['effective_month']))
			{
				$effective=$_POST['effective_month'];
			}			
			else{
				$effective='0000-00-00';
			}
			
			if(isset($_POST['userid']))
			{
				$userid=$_POST['userid'];
			}
			else if(isset($_POST['uid']))
			{
				$userid=$_POST['uid'];
			}else{	
				$userid='';
			}
			
			if(isset($_POST['ad_special_list']))
			{
				$ad_concession=$_POST['ad_special_list'];
			}
			else if(isset($_POST['special_list']))
			{
				$ad_concession=$_POST['special_list'];
			}else{	
				$ad_concession='';
			}
			
			if(isset($_POST['ad_concession_amount_modal']))
			{
				$ad_concession_amount=$_POST['ad_concession_amount_modal'];
			}
			else if(isset($_POST['concession_amount_modal']))
			{
				$ad_concession_amount=$_POST['concession_amount_modal'];
			}else{	
				$ad_concession_amount='';
			}
			
			if(isset($_POST['concessionuser_id']))
			{
				$concessionuser_id=$_POST['concessionuser_id'];
			}else{	
				$concessionuser_id='';
			}
			
			if(isset($_POST['userid']))
			{		
				$data=array(
					'user_id'=>$userid,
					'specialfees_id'=>$ad_concession,
					'amount'=>$ad_concession_amount,
					'effective_month'=>$effective,
					'endmonth'=>$endmonth,
					'created_date'=>date("Y-m-d H:i:s")
				);
			}else{
				$data=array(
					'user_id'=>$userid,
					'specialfees_id'=>$ad_concession,
					'amount'=>$ad_concession_amount,
					'effective_month'=>$effective,
					'endmonth'=>$endmonth
				);
				
				//echo "<pre>"; print_r($_POST); print_r($data); exit;
			}
			
			if(isset($_POST['ad_effective_month']))
			{
				$where='user_id = '.$_POST['userid'].' and role_id NOT IN (2) and paid_month = '.(int)date("m",strtotime($_POST['ad_effective_month']));
				$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['ad_effective_month']));
				$exists=$this->common_model->selectWhere('payment',$where);
				if(count($exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month.');
					redirect('deductionandincentive/incentive?id='.$_POST['userid'],'refresh');
				}	
				
				$where='user_id = '.$_POST['userid'].'  and Month(effective_month) = '.(int)date("m",strtotime($_POST['ad_effective_month']));
				$where.=' and Year(effective_month) = '.(int)date("Y",strtotime($_POST['ad_effective_month']));
				$add_exists=$this->common_model->selectWhere('specialfees_teacher',$where);
				if(count($add_exists)>0)
				{
					$this->session->set_flashdata('change_con','Already Added Set With The effective Month For The User.');
					redirect('deductionandincentive/incentive?id='.$_POST['userid'],'refresh');
				}			
				$concessionuser_id=$this->common_model->insert_data($data,'specialfees_teacher');
				$this->session->set_flashdata('change_con','Added...');
				redirect('deductionandincentive/incentive?id='.$_POST['userid'],'refresh');
			}
			
			if(isset($_POST['orig_effective_month']))
			{
				$orig_where='user_id = '.$_POST['uid'].' and role_id NOT IN (2) and paid_month = '.(int)date("m",strtotime($_POST['orig_effective_month']));
				$orig_where.=' and paid_year = '.(int)date("Y",strtotime($_POST['orig_effective_month']));
				$orig_exists=$this->common_model->selectWhere('payment',$orig_where);
				if(count($orig_exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month. ');
					redirect('deductionandincentive/incentive?id='.$_POST['uid'],'refresh');
				}
				$where='user_id = '.$_POST['uid'].' and paid_month = '.(int)date("m",strtotime($_POST['effective_month']));
				$where.=' and paid_year = '.(int)date("Y",strtotime($_POST['effective_month']));
				$exists=$this->common_model->selectWhere('payment',$where);
				if(count($exists)>0)
				{
					$this->session->set_flashdata('change_con','Payment is already paid for this month.');
					redirect('deductionandincentive/incentive?id='.$_POST['uid'],'refresh');
				}
				if(count($exists)==0 && count($orig_exists)==0)
				{
					$this->session->set_flashdata('change_con','Updated...');
					$this->common_model->update_data($data,'specialfees_teacher','special_id',$_POST['concessionuser_id']);
					redirect('deductionandincentive/incentive?id='.$_POST['uid'],'refresh');
				}
			}
		}
		
	function deductionby_id()
	{
		if(isset($_POST['con_id']))
		{
			$concession_user=$this->common_model->selectWhere('concession_teacher','con_id = '.$_POST['con_id']);
			echo json_encode(array('edit'=>$concession_user));
		}
		
	}
	function incentiveby_id()
	{
		if(isset($_POST['con_id']))
		{
			$concession_user=$this->common_model->selectWhere('specialfees_teacher','special_id = '.$_POST['con_id']);
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
	
	function yeardropdown(){
		$year=array();
		$curntYear=date("Y");
		$start=2011;
		$last=$curntYear+6;
		$count=0;
		for($i=$start; $i<=$last; $i++){
			$year[$count]=$i;
			$count++;
		}
		return $year;
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
	
	
}
?>