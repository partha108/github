<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class fees extends CI_Controller {
	
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
	
	public function index()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
				
		$data['class']= $this->fees_model->select_all('tblclass','status','active','','','','');
		$data['monthly']=array();
		$data['user_list']=array();		
		$value=0;
		$class_id=1;
		$date=date("Y-m-d"); 
		$month=(int)date('m');
		$data['month_value']=$month;
		$year=date("Y");
		$data['year_value']=$year;
		
		//----------------P O S T And  G E T date-----------
			if(isset($_POST['month'])){
				$month=$_POST['month'];
				$data['month_value']=$_POST['month'];
			}
			else{
				$month=0;
			}			
			if(isset($_GET['month']))
			{
				$month=$_GET['month'];
				$data['month_value']=$_GET['month'];
			}			
			if(isset($_POST['year'])){
				$year=$_POST['year'];
				$data['year_value']=$_POST['year'];
			}			
			if(isset($_GET['year'])){
				$year=$_GET['year'];
				$data['year_value']=$_GET['year'];
			}
			//------------------Get Post Class---------								
			if(isset($_POST['class']) || isset($_GET['class']) ){
				if(isset($_POST['class'])){
					$class_id=$this->input->post('class');}
				else{ $class_id=$this->input->get('class'); }						
			}
		//-------------------------------------------------		
			$data['class_id']= $class_id; 
			$data['year']=$this->year_month_lib->yeardropdown();
		$data['months']=$this->year_month_lib->monthdropdown();
		
		//-----------------------U S E R -------L I S T	--------------	
			$role_id=2;
			if(isset($_GET['payuser']) )
			{
				$data['user_id']=$_GET['payuser']; 
				$data['class_fees']=0;	
				$name=$this->payment_lib->studentlist($data['user_id'],$data['month_value'],$data['year_value'],$class_id);				
				if(isset($name[0]))
				{
					$data['name']=$name[0]->first_name.' '.$name[0]->last_name;
					$data['registration_no']=$name[0]->registration_no;
					$data['class_fees']=$name[0]->class_fees;
				}				
				//echo "<pre>"; print_r($data['user_list']); exit;	
			
			
			if(isset($_GET['month_status']) )
		{	
			if($_GET['month_status']=='no')
			{			
	$data['user_list']=$this->payment_lib->user_paymentlist($data['name'],$data['registration_no'],$data['user_id'],$data['month_value'],$data['month_value'],$data['year_value'],$class_id,$role_id,$data['class_fees']);
			}
			
			if($_GET['month_status']=='all')
			{			
	$data['user_list']=$this->payment_lib->user_paymentlist($data['name'],$data['registration_no'],$data['user_id'],1,12,$data['year_value'],$class_id,$role_id,$data['class_fees']);
			}
			
		}else{
			
$data['user_list']=$this->payment_lib->user_paymentlist($data['name'],$data['registration_no'],$data['user_id'],1,12,$data['year_value'],$class_id,$role_id,$data['class_fees']);
			}
			
			
			
			
			
			
			
			}else{				
				$data['user_list']=$this->payment_lib->paymentlist('',$data['month_value'],$data['month_value'],$data['year_value'],$class_id);	
			}
			
			
			
			//----------------------Pay List For Payment------------------------------------------------------------		
				
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		if(isset($_GET['payuser']) )
		{
			$this->load->view('admin/user_payment_view',$data);
		}else{
				$this->load->view('admin/payment_view',$data);
			}
		$this->load->view('admin/template/admin_footer');
		
	}
	
	
	
	
	function payment_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}				
		$payable=trim($this->input->post('payable'));    if($payable==''){$payable=0;}
		$amount=trim($this->input->post('amount'));    if($amount==''){$amount=0;}
		$due_amount=trim($this->input->post('due_amount'));  if($due_amount==''){$due_amount=0;}
		$due_reason=trim($this->input->post('due_reason')); if($due_reason==''){$due_reason="";}
		$paid_amount=trim($this->input->post('paid_amount'));  if($paid_amount==''){$paid_amount=0;}
		$paid_month=$this->input->post('paid_month'); if($paid_month=='' || $paid_month==0){ $paid_month=(int)date("m"); }		
		$paid_year=$this->input->post('paid_year'); if($paid_year=='' || $paid_year==0){ $paid_year=(int)date("Y"); }		
		$user_id=trim($this->input->post('user_id'));
		$class_id=trim($this->input->post('class_id'));		 
		 $feesmonth=trim($this->input->post('feesmonth'));
		
		$charge_name='Medical'; //trim($this->input->post('charge_name'));   
		$charge_amount=trim($this->input->post('medicalcrg')); 
		
		$role_id=$_POST['role_id'];
		$where_='user_id ='.$user_id.' and role_id = '.$role_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year;
		$tblpaid_amount=$this->common_model->selectColmnWhere('payment','sum(paid) as paid',$where_);
		
		$latefine=trim($this->input->post('paidlatefine'));  if($latefine==''){$latefine=0;}
		if($role_id==3)
		{
			$latefine=0;
		}
		 $tofeesmonth=$feesmonth+$latefine+$charge_amount;
		$status='unpaid';
		/*if(isset($tblpaid_amount[0]->paid))
		{
			
			if(number_format(($tofeesmonth),2) == number_format(($amount + $tblpaid_amount[0]->paid),2))
			{
				$status='paid';
			}
		}else{
			if(number_format(($tofeesmonth),2) == number_format(($amount),2))
			{
				$status='paid';
			}			
		}	*/	
		if(isset($tblpaid_amount[0]->paid))
		{
			$due_=($tofeesmonth-(($amount + $tblpaid_amount[0]->paid)));
		}else{
			$due_=$tofeesmonth-$amount;
		}
		
		if(round($due_)==0)
		{
			$status='paid';
		}
		
		if($due_amount==$due_)
		{
			$due_amount=$due_;	
		}
					
		if($user_id!=''){			
			
			if($amount!=0)
			{				
				//------------------Payment update I N S E R T------------------
				/*$whrpayment='user_id = '.$user_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year;			
				$payment_amount_list=$this->common_model->selectWhere('payment',$whrpayment);	
				*/
				if($role_id==2)
				{
				$cls_id=$this->common_model->single_value('fees_user_class','class_id','user_id = '.$user_id.' and year(updated_date) = '.$paid_year);
				}else{
					$cls_id=0;
				}
				
				$data=array(
					'user_id'=>$user_id,
					'class_id'=>$cls_id,
					'role_id'=>$role_id,
					'totalamount'=>$feesmonth,
					'latefine'=>$latefine,
					'paid'=>$amount,
					'due'=>$due_amount,
					'due_reason'=>$due_reason,
					'paid_month'=>$paid_month,
					'paid_year'=>$paid_year,
					'payment_date'=>date("Y-m-d H:i:s"),
					'invoice_no'=>$user_id.date("Y").date("m").date("d"),
					'status'=>$status
					);					
					//echo "<pre>";print_r($data);exit;					
					$this->common_model->insert_data($data,'payment');
					$auto_id=$this->db->insert_id();
					$invoice=date("Y").date("m").date("y").$role_id.$user_id.$auto_id;
								$data_invoice_no=array(
										'invoice_no'=>$invoice
												);
					$this->common_model->update_data($data_invoice_no,'payment','id',$auto_id);						
						
					if($status=='paid')
					{
						$data_status=array("month_status"=>'paid');
						$where_update='user_id = '.$user_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year;
						$this->common_model->update_data_where($data_status,'payment',$where_update);
					}
				$paid_medical=$this->common_model->single_value('tblcharge','charge_amount','user_id = '.$user_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year); 	
				if($paid_medical==0)
				{
					if($charge_amount!=0 && $charge_name!='')
					{	
						$data_charges=array(
							'user_id'=>$user_id,
							'invoice_number'=>$invoice,
							'charge_name'=>$charge_name,
							'charge_amount'=>$charge_amount,
							'paid_month'=>$paid_month,
							'paid_year'=>$paid_year
							);
						$this->common_model->insert_data($data_charges,'tblcharge');					
					}
				}
				//----------------------Credit Debit----------------
				 $frm_path=$this->uri->uri_string();
				$this->credit_debit($paid_month,$paid_year,$amount,$frm_path,$role_id)	;
				
				$admin_email=$this->common_model->selectOne('tblemail','email_id',1);
				$fromemail=$admin_email[0]->from_email;
				$tomail=$admin_email[0]->receive_email;
				$this->sendtomail($invoice,$fromemail,$tomail);	
				if($role_id==2){
					$email=$this->common_model->single_value('student','email','id = '.$user_id);
					if($email!='')
					{
						$this->sendtomail($invoice,$fromemail,$email);
					}
					redirect('fees?payuser='.$user_id.'&class='.$class_id.'&month='.$paid_month.'&year='.$paid_year.'&month_status=no','refresh');
				}else
				{
					$email=$this->common_model->single_value('teacher','email','id = '.$user_id);
					if($email!='')
					{
						$this->sendtomail($invoice,$fromemail,$email);
					}
					redirect('salary?payuser='.$user_id.'&month='.$paid_month.'&year='.$paid_year.'&month_status=no','refresh');
				}				
					
			}
			else{
					$this->session->set_flashdata('amount',"Amount must not be zero(0)");
			}
				
		}
		if($role_id==2)
		{
			redirect('fees?payuser='.$user_id.'&class='.$class_id.'&month='.$paid_month.'&year='.$paid_year,'refresh');
		}else
		{
			redirect('salary?payuser='.$user_id.'&month='.$paid_month.'&year='.$paid_year,'refresh');
		}
	}
	
	function sendtomail($invoice,$fromemail,$tomail)
	{
		$data=$this->invoicedata($invoice);
		 $message=$this->load->view('admin/voucher',$data,true);
		//echo $fromemail; echo $tomail;	
		$config = array (
					  'charset'  => 'utf-8',
				  'wordwrap' => TRUE,
				  'mailtype' => 'html',
				  'priority' => '1'
				);
				
	   $this->email->initialize($config);	
	   $this->email->from($fromemail,'Tauhid Mission');
	   $this->email->to($tomail,'Tauhid Mission'); 
	   $this->email->subject('Payment');
	   $this->email->message($message);
	   @$result=$this->email->send();
	}
	
	
	function payment($month,$role_id,$deptColName,$c_id,$per_month){
		$column="MONTH( `payment_date` )";
		$columnvalu="MONTH( CURRENT_DATE - INTERVAL ". $month ." MONTH )";
		$list=$this->fees_model->select_payment_sql('payment',$column,$columnvalu,$role_id,$deptColName,$c_id,'');
		
		return $list;
	}
	
	function credit_debit($paid_month,$paid_year,$amount,$frm_path,$role_id){
		
		$whr_credit='paid_month = '.$paid_month.' and paid_year = '.$paid_year.' and role_id = 2';
		 $credit_list=$this->common_model->selectColmnWhere('payment','sum(paid) as paid',$whr_credit);
		
		$whr_debit='paid_month = '.$paid_month.' and paid_year = '.$paid_year.' and role_id NOT IN (2)';
		 $debit_list=$this->common_model->selectColmnWhere('payment','sum(paid) as paid',$whr_debit);
		$credit=0;
		$debit=0;

		if(count($credit_list)>0){
			foreach($credit_list as $cl){
				$credit=$credit+$cl->paid;
			}
		}
		if(count($debit_list)>0){
			foreach($debit_list as $dl){
				$debit=$debit+$dl->paid;
			}
		}
	$data_credit_debit=array(
			'credit'=>$credit,
			'debit'=>$debit,
			'profit'=>$credit-$debit,
			'frm_path'=>$frm_path,
			'by_whom'=>$this->user_email,
			'for_why'=>$role_id,
			'paid_month'=>$paid_month,
			'paid_year'=>$paid_year,
			'created_date'=>date("Y-m-d H:i:s")
			);		
		$whr_cridt_debit='paid_month = '.$paid_month.' and paid_year = '.$paid_year;
		$tabl_credit_debit=$this->common_model->selectWhere('credit_debit',$whr_cridt_debit);
		if(count($tabl_credit_debit)>0){
			foreach($tabl_credit_debit as $itm)
			{
				$this->common_model->update_data($data_credit_debit,'credit_debit','id',$itm->id);
			}			
		}else{
				$this->common_model->insert_data($data_credit_debit,'credit_debit');	
		}
		
			
	}
	
	function invoicedata($invoice)
	{
		$roleid='';	
			$data['invoice_data']=$this->common_model->selectWhere('payment','invoice_no = '.$invoice);
			foreach($data['invoice_data'] as $row)
			{
				$roleid=$row->role_id;
				if($row->role_id==2)
				{					
					$row->name='';
					$user=$this->payment_lib->studentlist($row->user_id,$row->paid_month,$row->paid_year,$row->class_id);
					foreach($user as $rowuser)
					{					
						$row->name=$rowuser->first_name;
						if($rowuser->middle_name!='')
						{
							$row->name.=' '.$rowuser->middle_name;
						}
						$row->name.=' '.$rowuser->last_name;
						}
					$row->registration_no=$rowuser->registration_no;
					$row->classname='';
					if($row->class_id!='' || $row->class_id!=0)
					{
						$row->classname=$this->common_model->single_value('tblclass','name','id = '.$row->class_id);
					}
					$row->studentfees=$rowuser->class_fees;	
					$row->session_charge=$this->payment_lib->session_charge($row->user_id,$row->paid_month,$row->paid_year,$row->class_id);				
					$row->security_deposit=$this->payment_lib->security_deposit($row->user_id,$row->paid_month,$row->paid_year,$row->class_id);				
					$paid_permonth=$this->payment_lib->paid_permonth($row->user_id,$row->paid_month,$row->paid_year,$row->class_id,$row->role_id);
					foreach($paid_permonth as $rowy)
					{
						$row->paid=$rowy->paid;					
					}				
					$row->totconcession=$this->payment_lib->concession_per_user($row->user_id,$row->paid_month,$row->paid_year,'');
					$row->totspecialfees=$this->payment_lib->charge_per_user($row->user_id,$row->paid_month,$row->paid_year,'');
					$totfees=( $row->studentfees + $row->totspecialfees + $row->session_charge + $row->security_deposit ) - $row->totconcession ;
					$row->totfees=number_format(($totfees),2);
					$row->due=$totfees-$row->paid;
					$row->nowdue=number_format(($row->due),2);
					$row->concession_arr=array();
					$row->specialfees_arr=array();
					$concession_arr=$this->payment_lib->concession_per_user($row->user_id,$row->paid_month,$row->paid_year,'data');
					if(count($concession_arr)>0)
					{
						$row->concession_arr=$concession_arr;
					}
					$specialfees_arr=$this->payment_lib->charge_per_user($row->user_id,$row->paid_month,$row->paid_year,'data');
					if(count($specialfees_arr)>0)
					{
						$row->specialfees_arr=$specialfees_arr;
					}
										
				   }				
			}
						
			if($roleid==3)
			{
				foreach($data['invoice_data'] as $row)
				{
					$row->salaryamount=0;
					$this->load->library('salary_payment_lib');
					$salary=$this->salary_payment_lib->studentlist($row->user_id,$row->paid_month,$row->paid_year);
					if(isset($salary[0]->salary))
					{
						$row->salaryamount=$salary[0]->salary;
						$row->name=$salary[0]->first_name;
						if($salary[0]->middle_name!='')
						{
							$row->name.=' '.$salary[0]->middle_name;
						}
						$row->name.=' '.$salary[0]->last_name;
						
					}
					$paid_permonth=$this->salary_payment_lib->paid_permonth($row->user_id,$row->paid_month,$row->paid_year,$row->role_id);
					foreach($paid_permonth as $rowy)
					{
						$row->paid=$rowy->paid;					
					}	
					
					$row->totconcession=$this->salary_payment_lib->concession_per_user($row->user_id,$row->paid_month,$row->paid_year,'');
					$row->totspecialfees=$this->salary_payment_lib->charge_per_user($row->user_id,$row->paid_month,$row->paid_year,'');
					
					$totfees=($row->salaryamount + $row->totspecialfees ) - $row->totconcession ;
					
					$row->totfees=number_format(($totfees),2);
					$row->due=$totfees-$row->paid;
					$row->nowdue=number_format(($row->due),2);
					$row->concession_arr=array();
					$row->specialfees_arr=array();
					$concession_arr=$this->salary_payment_lib->concession_per_user($row->user_id,$row->paid_month,$row->paid_year,'data');
					if(count($concession_arr)>0)
					{
						$row->concession_arr=$concession_arr;
					}
					$specialfees_arr=$this->salary_payment_lib->charge_per_user($row->user_id,$row->paid_month,$row->paid_year,'data');
					if(count($specialfees_arr)>0)
					{
						$row->specialfees_arr=$specialfees_arr;
					}
				}				
			}			
			return $data;
	}
	
	function deleteitem()
	{
						
			$id=$_GET['id'];
			$table=$_GET['table'];	
			$column=$_GET['column'];	
			 $page=$_GET['page'];
			 $classid=0;
			 if(isset($_GET['classid']))
			 {
				$classid=$_GET['classid'];
			 }
			 $month=$_GET['month'];
			  $year=$_GET['year'];	
			   $uid=$_GET['uid'];
		if($this->user_role=1)
		{	
			$this->common_model->delete_data($table,$column,$id);
			$this->common_model->delete_data('fees_user_class','user_id',$id);
			
			 $exist_payment=$this->common_model->selectWhere('payment','invoice_no = "'.$id.'" and role_id=2 and paid_month = '.$month.' and paid_year = '.$year);
			if(count($exist_payment)==0)
			{
				$this->common_model->delete_whereclause('tblcharge','user_id = '.$uid.' and paid_month = '.$month.' and paid_year = '.$year);
				
			}
			
		}else{
			$this->session->set_flashdata('message','Only Admin will do it.');
		}
			if(isset($_GET['classid']))
			 {
				redirect($page.'&class='.$classid.'&month='.$month.'&year='.$year,'refresh');
			 }else{
				 redirect($page.'&month='.$month.'&year='.$year,'refresh');
			 }
		
	}	
	
	
}
?>