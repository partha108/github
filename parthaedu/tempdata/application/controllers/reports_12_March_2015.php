<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reports extends CI_Controller {
	
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
	
	public function studentdue()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
				
		$data['classlist']=$this->common_model->selectAll('tblclass');
		$data['yearlist']=$this->year_month_lib->yeardropdown();
		$data['monthlist']=$this->year_month_lib->monthdropdown();
		$data['class_id']=1;
		$data['year']=date("Y",strtotime(date("Y-m-d")));
		
		if(isset($_POST['class']))
		{
			$data['class_id']=$_POST['class'];
		}
		
		if(isset($_POST['year']))
		{
			$data['year']=$_POST['year'];
		}
		$due_class=array();
		$due_user=array();		
		$data['user']=$this->payment_lib->yearlydue($data['class_id'],$data['year'],1,12);
		$table= '<table border="1">';
		$table.= '<caption> Payment Due - '.$data['year'].' Class-'.$data['class_id'].'</caption>';
					$table.= '<tr>';
						$table.= '<th>Registration No</th>';
						$table.= '<th>Name </th>';
						$table.= '<th>Total Amount</th>';
						$table.= '<th>Total Paid</th>';
						$table.= '<th>Total Due</th>';
					$table.= '</tr>';
		if(count($data['user'])>0)
		{
			foreach($data['user'] as $row)
			{
				$table.= '<tr>';
				$table.='<td>'.$row->registration_no.'</td>';
				$table.='<td>'.$row->name.'</td>';
				$table.='<td>'.number_format(($row->yearly_fees),2).'</td>';
				$table.='<td>'.number_format(($row->paid),2).'</td>';
				$table.='<td>'.number_format(($row->yearlydue),2).'</td>';								
				$table.= '</tr>';					
			}
		}		
		$table.= '</table>';
		if(file_exists('./uploads/report/student_due.xls'))
		{
			unlink('./uploads/report/student_due.xls');
		}	
			$fp = fopen('./uploads/report/student_due.xls', "a");
			fwrite($fp, $table);
			fclose($fp);
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/report_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}
	
	public function salarydue()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
				
		$data['classlist']=$this->common_model->selectAll('tblclass');
		$data['yearlist']=$this->year_month_lib->yeardropdown();
		$data['monthlist']=$this->year_month_lib->monthdropdown();
		$data['class_id']=0;
		$data['year']=date("Y",strtotime(date("Y-m-d")));
		
		if(isset($_POST['class']))
		{
			$data['class_id']=$_POST['class'];
		}
		
		if(isset($_POST['year']))
		{
			$data['year']=$_POST['year'];
		}
		$due_class=array();
		$due_user=array();
		
		$data['user']=$this->salary_payment_lib->yearlydue('',$data['year'],1,12);
		$table= '<table border="1">';
		$table.= '<caption> Salary Due - '.$data['year'].'</caption>';
					$table.= '<tr>';
						$table.= '<th>Registration No</th>';
						$table.= '<th>Name </th>';
						$table.= '<th>Total Amount</th>';
						$table.= '<th>Total Paid</th>';
						$table.= '<th>Total Due</th>';
					$table.= '</tr>';
		if(count($data['user'])>0)
		{
			foreach($data['user'] as $row)
			{
				$table.= '<tr>';
				$table.='<td>'.$row->registration_no.'</td>';
				$table.='<td>'.$row->name.'</td>';
				$table.='<td>'.number_format(($row->yearly_fees),2).'</td>';
				$table.='<td>'.number_format(($row->paid),2).'</td>';
				$table.='<td>'.number_format(($row->yearlydue),2).'</td>';								
				$table.= '</tr>';					
			}
		}		
		$table.= '</table>';
		if(file_exists('./uploads/report/salary_due.xls'))
		{
			unlink('./uploads/report/salary_due.xls');
		}	
			$fp = fopen('./uploads/report/salary_due.xls', "a");
			fwrite($fp, $table);
			fclose($fp);
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/report_view',$data);
		$this->load->view('admin/template/admin_footer');		
	}
	
	
	
	function credit_debit()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
				
		if(isset($_POST['year']))
		{
			$data['year']=$_POST['year'];
		}else{
			$data['year']=(int)(date('Y-m-d'));
		}
		
		if(isset($_POST['toyear']))
		{
			$data['toyear']=$_POST['toyear'];
		}else{
			$data['toyear']=(int)(date('Y',strtotime(date("Y-m-d"))));
		}
		
		if(isset($_POST['month']))
		{
			$data['month']=$_POST['month'];
		}else{
			$data['month']=(int)(date('m',strtotime(date("Y-m-d"))));
		}
		
		if(isset($_POST['tomonth']))
		{
			$data['tomonth']=$_POST['tomonth'];
		}else{
			 $data['tomonth']=(int)(date('m',strtotime(date("Y-m-d"))));
		}
		
		$data['yearlist']=$this->year_month_lib->yeardropdown();
		$data['monthlist']=$this->year_month_lib->monthdropdown();
		$where='year(created_date) between '.$data['year'].' and '.$data['toyear'];
		$where.=' and month(created_date) between '.$data['month'].' and '.$data['tomonth'].' order by month(created_date) DESC';
		$data['credit_debit']=$this->common_model->selectWhere('credit_debit',$where);
		
		$data['totalcredit_debit']=$this->common_model->selectColmnWhere('credit_debit','sum(credit) as totcredit,sum(debit) as totdebit,sum(profit) as totprofit',$where);
		
		$table= '<table border="1">';
					$table.= '<tr>';
					$table.= '<th>Credit</th>';
					$table.= '<th>Debit</th>';
					$table.= '<th>Profit</th>';
					$table.= '<th>Payment For The Month</th>';
					$table.= '<th>Collected Month</th>';						
					$table.= '</tr>';
		if(count($data['credit_debit'])>0)
		{
			foreach($data['credit_debit'] as $row)
			{
				$month=date("m",strtotime($row->created_date));
				
				$table.= '<tr>';
				$table.='<td>'.number_format(($row->credit),2).'</td>';
				$table.='<td>'.number_format(($row->debit),2).'</td>';
				$table.='<td>'.number_format(($row->profit),2).'</td>';	
				$table.='<td>'.date('F', mktime(0, 0, 0, $row->paid_month, 1)).'</td>';	
				$table.='<td>'.date('F', mktime(0, 0, 0, $month, 1)).'</td>';
				$table.= '</tr>';					
			}
		}
		
		if(isset($data['totalcredit_debit'][0]))
		{
			$table.= '<tr>';
			$table.= '<th>Total Credit</th>';
			$table.= '<th>Total Debit</th>';
			$table.= '<th>Total Profit</th>';
		$table.= '</tr>';
			
				$table.= '<tr>';
				$table.='<td>'.number_format(($data['totalcredit_debit'][0]->totcredit),2).'</td>';
				$table.='<td>'.number_format(($data['totalcredit_debit'][0]->totdebit),2).'</td>';
				$table.='<td>'.number_format(($data['totalcredit_debit'][0]->totprofit),2).'</td>';								
				$table.= '</tr>';
				
		}
		
		$table.= '</table>';
		if(file_exists('./uploads/report/credit_debit.xls'))
		{
			unlink('./uploads/report/credit_debit.xls');
		}	
		$fp = fopen('./uploads/report/credit_debit.xls', "a");
		fwrite($fp, $table);
		fclose($fp);
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/credit_debit_report_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	function invoice_generate()
	{
		$invoice=$this->uri->segment(3); 
		if($invoice!='')
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
					$row->totfees=$totfees;
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
			$table='';
			if($roleid==2)
			{
				$table.='<table  width="100%">';
				$table.='<tr >';
   				$table.='<td colspan="2" align="center">';
   				$table.='<table align="center"  width="100%" > ';
                $table.='<tr>';
                $table.='<td width="100%" align="center">TAUHID MISSION</td> ';                          
                $table.='</tr>';
                $table.='<tr>';
                $table.='<td width="100%" align="center">Registered Under Indian Trust Act</td>';                             
                $table.='</tr>';
                $table.='<tr>';
                $table.='<td width="100%" align="center">Govt. Regd. No. : 00194 of 2010</td> ';                            
                 $table.='</tr> ';
				$table.=' <tr><td width="100%" align="center">Ukta Pichkuri&nbsp; P.O: Pichkuri &nbsp; Dist:Burdwan</td></tr>';				
				$table.='</table></td></tr>';
				$table.='<tr><td colspan="2" height="5"></td></tr>';
								
				$table.='<tr><td width="20%"></td><td align="left" width="60%"> ';
				$table.='<table  width="100%" id="printoption"> ';
				$table.='<tr>   <td align="left" valign="top" style="font-size:12px;"><strong>';
				$table.= strtoupper(date('F',strtotime($data['invoice_data'][0]->paid_month ))).' '.$data['invoice_data'][0]->paid_year;
				$table.='</strong></td>  <td align="left" valign="top" >Invoice No. ';
				$table.=$data['invoice_data'][0]->invoice_no;
				$table.='</td> <td  align="left" valign="top" style="font-size:12px;color:#ff0000">';
				$table.=' </td>  </tr> <tr> <td colspan="3" align="left" valign="top" height="2"></td>';
				$table.='</tr>  <tr> <td align="left" valign="top" style=" font-size:14px">Name:</td><td  align="left" valign="top" style=" font-size:14px">';
				$table.=ucfirst($data['invoice_data'][0]->name) ;
				$table.='</td> <td align="left" valign="top">&nbsp;</td></tr> <tr> <td  align="left" valign="top" style=" font-size:14px">Registration No.:</td>';
				$table.=' <td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->registration_no.'</td>';
				$table.='  <td align="left" valign="top">&nbsp;</td>  </tr> <tr> <td  align="left" valign="top" style=" font-size:14px">Class:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->classname.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td>  </tr> <tr>  <td  align="left" valign="top" style=" font-size: 14px">Payment Date:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">';
				$table.= date('d-m-Y', strtotime( $data['invoice_data'][0]->payment_date));
				$table.='</td> <td align="left" valign="top">&nbsp;</td> </tr><tr><td  align="left" valign="top" style=" font-size: 14px">Student Fees:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">';
				$table.=$data['invoice_data'][0]->studentfees;
				$table.='</td> <td align="left" valign="top">&nbsp;</td> </tr><tr><td  align="left" valign="top" style=" font-size: 14px">Session Charge:</td>';
				$table.=' <td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->session_charge.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td> </tr> <tr>  <td  align="left" valign="top" style=" font-size: 14px">Security Deposit:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->security_deposit.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td>';
				$table.=' </tr>';
				if(count($row->concession_arr)>0)
				{
					foreach($row->concession_arr as $rowco)
					{
						$table.=' <tr>';
						$table.='<td  align="left" valign="top" style=" font-size: 14px">';
						if($rowco['chrg_name']!='')
						{ 
							$table.=$rowco['chrg_name'];
						}else{
							$table.='Other Concession';
						}
						$table.=':</td>';
						$table.='<td  align="left" valign="top" style=" font-size:14px">'.$rowco['chrg_amount'].'</td>';
						$table.=' <td align="left" valign="top">&nbsp;</td></tr>';
					}
					
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Total Concession:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totconcession.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}else{
					$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Concession:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totconcession.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';	
					
				}
				
				if(count($row->specialfees_arr)>0)
				{
					foreach($row->specialfees_arr as $rowco)
					{
						$table.=' <tr>';
						$table.='<td  align="left" valign="top" style=" font-size: 14px">';
						if($rowco['chrg_name']!='')
						{
							$table.=$rowco['chrg_name'];
						}else{
							$table.='Other Charges';
						}						
						$table.=':</td>';
						$table.='<td  align="left" valign="top" style=" font-size:14px">'.$rowco['chrg_amount'];'</td>';
						$table.=' <td align="left" valign="top">&nbsp;</td></tr>';
					}					
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Total Charges:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totspecialfees.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}
				else{
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Charges:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totspecialfees.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}
				$table.=' <tr><td walign="left" valign="top" style=" font-size: 14px">Late Fine:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->latefine.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td></tr>';
				
				$table.='<tr><td walign="left" valign="top" style=" font-size: 14px">Total:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.number_format(($data['invoice_data'][0]->totfees + $data['invoice_data'][0]->latefine),2) .'</td>';
				
				$table.='<td align="left" valign="top">&nbsp;</td></tr> <tr><td  align="left" valign="top" style=" font-size: 14px">Paid:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->paid.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td> </tr> <tr><td  align="left" valign="top" style=" font-size: 14px">Due:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->nowdue.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td></tr></table>';
				
				$table.='</td><td width="20%"></td></tr></table>';
			}
			
			if($roleid==3)
			{
				foreach($data['invoice_data'] as $row)
				{
					$row->salaryamount=0;
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
					
					$row->totfees=$totfees;
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
				$table.='<table  width="100%">';
				$table.='<tr>';
  				$table.='<td></td>';
   				$table.=' <td  colspan="2" ><img src="'.base_url().'images/logo_print.png" class="print_logo" /></td>';
  				$table.=' </tr>';
				$table.='<tr >';
   				$table.='<td colspan="2" align="center">';
   				$table.='<table align="center"  width="100%" > ';
                $table.='<tr>';
                $table.='<td width="100%" align="center">TAUHID MISSION</td> ';                          
                $table.='</tr>';
                $table.='<tr>';
                $table.='<td width="100%" align="center">Registered Under Indian Trust Act</td>';                             
                $table.='</tr>';
                $table.='<tr>';
                $table.='<td width="100%" align="center">Govt. Regd. No. : 00194 of 2010</td> ';                            
                $table.='</tr> ';
				$table.=' <tr><td width="100%" align="center">Ukta Pichkuri&nbsp; P.O: Pichkuri &nbsp; Dist:Burdwan</td></tr>';				
				$table.='</table></td></tr>';
				$table.='<tr><td colspan="2" height="5"></td></tr>';
				
				$table.='<tr><td width="20%"></td><td align="left" width="60%"> ';
				$table.='<table width="100%" id="printoption"> ';
				$table.='<tr>   <td  align="left" valign="top" style="font-size:12px;"><strong>';
				$table.= strtoupper(date('F',strtotime($data['invoice_data'][0]->paid_month ))).' '.$data['invoice_data'][0]->paid_year;
				$table.='</strong></td>  <td  align="left" valign="top" >Invoice No. ';
				$table.=$data['invoice_data'][0]->invoice_no;
				$table.='</td> <td  align="left" valign="top" style="font-size:12px;color:#ff0000">';
				$table.=' </td></tr> <tr> <td colspan="3" align="left" valign="top" height="2"></td>';
				$table.='</tr>  <tr> <td align="left" valign="top" style=" font-size:14px">Name:</td><td  align="left" valign="top" style=" font-size:14px">';
				$table.=ucfirst($data['invoice_data'][0]->name) ;
				$table.='</td> <td align="left" valign="top">&nbsp;</td></tr>';
				$table.=' <tr>  <td  align="left" valign="top" style=" font-size: 14px">Payment Date:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">';
				$table.= date('d-m-Y', strtotime( $data['invoice_data'][0]->payment_date));
				$table.='</td> <td align="left" valign="top">&nbsp;</td> </tr><tr><td  align="left" valign="top" style=" font-size: 14px">Student Fees:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">';
				$table.=$data['invoice_data'][0]->salaryamount;
				$table.='</td> <td align="left" valign="top">&nbsp;</td> </tr>';
				if(count($data['invoice_data'][0]->concession_arr)>0)
				{
					foreach($data['invoice_data'][0]->concession_arr as $rowco)
					{
						$table.=' <tr>';
						$table.='<td  align="left" valign="top" style=" font-size: 14px">'.$rowco['chrg_name'].':</td>';
						$table.='<td  align="left" valign="top" style=" font-size:14px">'.$rowco['chrg_amount'].'</td>';
						$table.=' <td align="left" valign="top">&nbsp;</td></tr>';
					}
					
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Total Concession:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totconcession.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}else{
					$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Concession:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totconcession.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';	
					
				}
				
				if(count($data['invoice_data'][0]->specialfees_arr)>0)
				{
					foreach($data['invoice_data'][0]->specialfees_arr as $rowco)
					{
						$table.=' <tr>';
						$table.='<td  align="left" valign="top" style=" font-size: 14px">'.$rowco['chrg_name'].':</td>';
						$table.='<td  align="left" valign="top" style=" font-size:14px">'.$rowco['chrg_amount'].'</td>';
						$table.=' <td align="left" valign="top">&nbsp;</td></tr>';
					}					
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Total Charges:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totspecialfees.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}
				else{
				$table.=' <tr>';
				$table.='<td  align="left" valign="top" style=" font-size: 14px">Charges:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->totspecialfees.'</td>';
				$table.=' <td align="left" valign="top">&nbsp;</td> </tr> ';
				}
				
				$table.=' <tr><td walign="left" valign="top" style=" font-size: 14px">Total:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.number_format(($data['invoice_data'][0]->totfees),2).'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td></tr> <tr><td  align="left" valign="top" style=" font-size: 14px">Paid:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->paid.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td> </tr> <tr><td  align="left" valign="top" style=" font-size: 14px">Due:</td>';
				$table.='<td  align="left" valign="top" style=" font-size:14px">'.$data['invoice_data'][0]->nowdue.'</td>';
				$table.='<td align="left" valign="top">&nbsp;</td></tr></table>';
				
				$table.='</td><td width="20%"></td></tr></table>';
			}
			
		if(file_exists('./uploads/report/invoice.doc'))
		{
			unlink('./uploads/report/invoice.doc');
		}
		$fp = fopen('./uploads/report/invoice.doc', "a");
		fwrite($fp, $table);
		fclose($fp);
		
		$file_name = './uploads/report/invoice.doc';
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
			
		}else{
			$data['path']= $this->session->userdata('inv_path');
			redirect($data['path']);
		}
	}
	
	function invoice_print()
	{
		$invoice=$this->uri->segment(3); 
		if($invoice!='')
		{
			$data=$this->invoicedata($invoice);
		
		$this->load->view('admin/voucher',$data);
		}else{
			$data['path']= $this->session->userdata('inv_path');
			redirect($data['path']);
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
					$row->totfees=$totfees;
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
					
					$row->totfees=$totfees;
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
	
	
	
	
	
	
	
}
?>