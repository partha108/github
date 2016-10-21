<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class student_newsession extends CI_Controller {
	
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
			$this->load->model('fees_model');
			$this->load->library('image_lib');
			$this->load->model('common_model');
			$this->load->model('newsession_model');
			$this->load->helper('email');
			
			
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
		
		//----------------------get DB_Backup-----as .sql--------
		$this->load->dbutil();
        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'school_bolpur.sql'
              );
        $backup =& $this->dbutil->backup($prefs);
        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = './uploads/DB_backup/'.$db_name;
        $this->load->helper('file');
        write_file($save, $backup);
		
		
		//--------------get DB_backup-----------as .xls---------------
		$this->excel_import();
		
		//--------------------Update Student's Promotion-----------------	
		
		$currnt_date=date('Y-m-d H:i:s');
		$status=1;
		$notpromoted=0;
		$classes=$this->common_model->selectAll('tblclass');
		if(count($classes)>0)
		{
			foreach($classes as $row)
			{	
				$compare_year=date("Y",strtotime($currnt_date))-1;		
				$studentlist=$this->common_model->selectColmnWhere('fees_user_class','user_id','class_id = '.$row->id.' and year(updated_date) = '.$compare_year);
				if(count($studentlist)>0)
				{
					$table= '<table border="1">';
					$table.= '<tr>';
						$table.= '<th>ID</th>';
						$table.= '<th>Registration No</th>';
						$table.= '<th>Name</th>';
						$table.= '<th>Class</th>';
						$table.= '<th>Promotion</th>';
						$table.= '<th>Created Date</th>';
					$table.= '</tr>';
						
					foreach($studentlist as $srow)
					{
						 $status=$this->newsession_model->newYearStart($srow->user_id,$row->id,$currnt_date);
						if($status == 0)
						{
							$notpromoted++;
							$data_notclear=array(
								'stu_id'=>$srow->user_id,
								'class_id'=>$row->id,
								'created_date'=>$currnt_date
							);
						$stu_detail=$this->common_model->selectWhere('student','id = '.$srow->user_id);
						if(count($stu_detail)>0)
						{
							foreach($stu_detail as $stud_det_row)
							{
								$table.= '<tr>';
								$table.='<td>'.$srow->user_id.'</td>';
								$table.='<td>'.$stud_det_row->registration_no.'</td>';
								$table.='<td>'.$stud_det_row->first_name.' '.$stud_det_row->middle_name.''.$stud_det_row->last_name.'</td>';
								$table.='<td>'.$row->id.'</td>';
								$table.='<td>Not Promoted</td>';
								$table.='<td>'.$currnt_date.'</td>';
								$table.= '</tr>';
							}							
							$this->common_model->delete_whereclause('student_notpromoted','stu_id = '.$srow->user_id.' and class_id = '.$row->id);
							$this->common_model->insert_data($data_notclear,'student_notpromoted');
						}
						}
					}
					
					$table.= '</table>';
					if($notpromoted!=0)
					{
						$cls='';
						if($row->id!='')
						{
							$cls=$row->id;
						}
						@mkdir('./uploads/Not_Promoted/report_'.date("Y-m-d"));						
						$fp = fopen('./uploads/Not_Promoted/report_'.date("Y-m-d").'/class_'.$cls.'.xls', "a");
						fwrite($fp, $table);
						fclose($fp);					
						$this->downloadAsExcel($table,'NotPromotedReport_class_'.$cls.date("Y-m-d-H-i-s"));		
					}
				}
			}
		}
		redirect('admin/dashboard','refresh');
	}
	
	function excel_import()
	{
		$tables=$this->db->list_tables();
		for($i=0; $i<count($tables); $i++)
		{
			$tablename=$tables[$i];
			$result=$this->newsession_model->db_backup($tablename);		
			$fields=$this->db->list_fields($tablename);
		
			$table= '<table border="1">';
			$table.= '<tr>';
			foreach($fields as $f)
			{
				$table.= '<th>'.$f.'</th>';
			}
			 $table.= '</tr>';
			 if(count($result)>0)
			 {
				foreach($result as $row_result)
				{ 
				 $table.= '<tr>';
					foreach($fields as $f)
					{
					 $table.= '<td>'.$row_result->$f.'</td>';
					}
				 $table.= '</tr>';
				}
			 }
			$table.= '</table>';
			@mkdir('./uploads/DB_backup/DB_excel_'.date("Y-m-d-H-i-s"));	
			$fp = fopen('./uploads/DB_backup/DB_excel_'.date("Y-m-d-H-i-s").'/'.$tablename.'.xls', "a");
			fwrite($fp, $table);
			fclose($fp);
		}
	}
	
	function downloadAsExcel($html, $filename)
	{
		header("Expires: 0");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type: application/vnd.ms-excel;charset:UTF-8");
		header("Content-Disposition: attachment; filename=".ucwords($filename).".xls");
		print "\n"; // Add a line, unless excel error..
		echo $html;
		
	}
	
	

}
?>