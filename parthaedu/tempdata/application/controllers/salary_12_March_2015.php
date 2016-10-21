<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class salary extends CI_Controller {
	
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
			$this->load->library('salary_payment_lib');
			$this->load->library('year_month_lib');
			
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
			$role_id=3;
			if(isset($_GET['payuser']) )
			{
				$data['user_id']=$_GET['payuser']; 
				$data['class_fees']=0;	
				$name=$this->salary_payment_lib->studentlist($data['user_id'],$data['month_value'],$data['year_value']);				
				if(isset($name[0]))
				{
					$data['name']=$name[0]->first_name.' '.$name[0]->last_name;
					$data['registration_no']=$data['user_id'];
					$data['class_fees']=$name[0]->salary;
				}				
				$data['user_list']=$this->salary_payment_lib->user_paymentlist($data['name'],$data['user_id'],1,12,$data['year_value'],'',$role_id,$data['class_fees']);
				//echo "<pre>"; print_r($data['user_list']); exit;	
			}else{				
				$data['user_list']=$this->salary_payment_lib->paymentlist('',$data['month_value'],$data['month_value'],$data['year_value']);	
			}
			//echo "<pre>"; print_r($data['user_list']); exit;						
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
	
			
	/*function payment_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		$payable=trim($this->input->post('payable'));    if($payable==''){$payable=0;}
		$latefine=trim($this->input->post('latefine'));    if($latefine==''){$latefine=0;}
		$amount=trim($this->input->post('amount'));    if($amount==''){$amount=0;}
		$due_amount=trim($this->input->post('due_amount'));  if($due_amount==''){$due_amount=0;}
		$due_reason=trim($this->input->post('due_reason')); if($due_reason==''){$due_reason="";}
		$paid_amount=trim($this->input->post('paid_amount'));  if($paid_amount==''){$paid_amount=0;}
		$paid_month=$this->input->post('paid_month'); if($paid_month=='' || $paid_month==0){ $paid_month=(int)date("m"); }		
		$paid_year=$this->input->post('paid_year'); if($paid_year=='' || $paid_year==0){ $paid_year=(int)date("Y"); }		
		$user_id=trim($this->input->post('user_id'));
		$class_id=trim($this->input->post('class_id'));		 
		$feesmonth=trim($this->input->post('feesmonth'));
		
		$role_id=$_POST['role_id'];
		$where_='user_id ='.$user_id.' and role_id = '.$role_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year;
		$tblpaid_amount=$this->common_model->selectColmnWhere('payment','sum(paid) as paid',$where_);
		
		//$tblpaid_amount=$this->common_model->selectColmnWhere('payment','sum(paid) as paid','user_id ='.$user_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year);
		
		$status='unpaid';
		if(isset($tblpaid_amount[0]->paid))
		{
			if(number_format(($feesmonth),2) == number_format(($amount + $tblpaid_amount[0]->paid),2))
			{
				$status='paid';
			}
		}else{
			if(number_format(($feesmonth),2) == number_format(($amount),2))
			{
				$status='paid';
			}			
		}		
		
		$due_=number_format($feesmonth-number_format(($amount + $tblpaid_amount[0]->paid),2),2);
		if($due_amount==$due_)
		{
			$due_amount=$due_;	
		}
					
		if($user_id!=''){			
			
			if($amount!=0)
			{				
				//------------------Payment update I N S E R T------------------
				$whrpayment='user_id = '.$user_id.' and paid_month = '.$paid_month.' and paid_year = '.$paid_year;			
				$payment_amount_list=$this->common_model->selectWhere('payment',$whrpayment);	
				
				$data=array(
					'user_id'=>$user_id,
					'class_id'=>$this->common_model->single_value('fees_user_class','class_id','user_id = '.$user_id),
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
						$this->common_model->insert_data($data,'payment');
						$auto_id=$this->db->insert_id();
						$invoice=$user_id.$auto_id.date("Y").date("m").date("y");
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
					
			}
			else{
					$this->session->set_flashdata('amount',"Amount must not be zero(0)");
			}
				//----------------------Credit Debit----------------
				 $frm_path=$this->uri->uri_string();
				$this->credit_debit($paid_month,$paid_year,$amount,$frm_path,2)	;				
							
		}
		redirect('fees?payuser='.$user_id.'&class='.$class_id.'&month='.$paid_month.'&year='.$paid_year,'refresh');
	}
	*/
	
	
	
	function payment($month,$role_id,$deptColName,$c_id,$per_month){
		$column="MONTH( `payment_date` )";
		$columnvalu="MONTH( CURRENT_DATE - INTERVAL ". $month ." MONTH )";
		$list=$this->fees_model->select_payment_sql('payment',$column,$columnvalu,$role_id,$deptColName,$c_id,'');
		
		return $list;
	}
	
	function credit_debit($paid_month,$paid_year,$amount,$frm_path,$role_id){
		
		$whr_credit='paid_month = '.$paid_month.' and paid_year = '.$paid_year.' and role_id = 2';
		$credit_list=$this->common_model->selectWhere('payment',$whr_credit);
		
		$whr_debit='paid_month = '.$paid_month.' and paid_year = '.$paid_year.' and role_id NOT IN (2)';
		$debit_list=$this->common_model->selectWhere('payment',$whr_debit);
			
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
			'created_date'=>date("Y-m-d H:i:s")
			);
	//echo "<pre>"; echo $this->db->last_query(); print_r( $debit_list);	print_r( $credit_list); echo $credit; echo $debit;  exit;	
		
		$whr_cridt_debit='MONTH(created_date) = '.$paid_month.' and YEAR(created_date) = '.$paid_year;
		$tabl_credit_debit=$this->common_model->selectWhere('credit_debit',$whr_cridt_debit);
		
		if(count($tabl_credit_debit)>0){
			foreach($tabl_credit_debit as $itm){

				$this->common_model->update_data($data_credit_debit,'credit_debit','id',$itm->id);
			}			
		}else{
				$this->common_model->insert_data($data_credit_debit,'credit_debit');	
		}		
	}
	
	function download_file()
	{
		$file=$this->uri->segment(3);
		$file_name = './uploads/report/'.$file;
		$mime = 'application/force-download';
		header('Pragma: public');    
		header('Expires: 0');        
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name);    
		exit();
		
	}
	
	
}
?>