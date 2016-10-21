<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class addstudent extends CI_Controller {
	
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
				//$this->load->model('fees_model');
				$this->load->library('image_lib');
				$this->load->helper('email');
				$this->load->model('common_model');
		 		$this->load->library('excel');

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
		$data['class']= $this->common_model->getAllClasses();
		@$data['state'] = $this->common_model->get_state();
		$data['section']=$this->common_model->selectAll('section');

		$data['roles']=$this->common_model->getAllRoles();
		
		$data['country']=$this->common_model->get_country();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();
		$data['concession']=$this->common_model->selectAll('concession');
		$data['specialfees']=$this->common_model->selectAll('specialfees');
		$data['max_id']				= 	$this->common_model->max_id('tbl_student','student_id');

		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/addstudent_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	
	public function registration_post()
	{
		$reg_no								=	$this->input->post('student_reg_no');
		$roll_no							=	$this->input->post('student_roll_no');
		$first_name 						= 	$this->input->post('first_name');
		$last_name 							= 	$this->input->post('last_name');
		$email 								= 	$this->input->post('email');
		$student_mobile_number 				= 	$this->input->post('student_mobile_number');

		$stream 							= 	$this->input->post('stream');
		$gender 							= 	$this->input->post('gender');
		$category 							= 	$this->input->post('category');
		$dob 								= 	$this->input->post('dob');
		$addmission_class 					= 	$this->input->post('addmission_class');
		$student_study_status				=	$this->input->post('student_status');

		$school_name 						= 	$this->input->post('school_name');
		$school_timing 						= 	$this->input->post('school_timing');
		$week_day 							=	$this->input->post('week_day');
		$board 								= 	$this->input->post('board');
		$total_marks 						= 	$this->input->post('total_marks');
		$math_marks 						= 	$this->input->post('math_marks');
		$phy_marks 							= 	$this->input->post('phy_marks');
		$che_marks							= 	$this->input->post('che_marks');
		$bio_marks 							= 	$this->input->post('bio_marks');
		$science_marks 						= 	$this->input->post('science_marks');
		$school_address 					= 	$this->input->post('school_address');
		$schoo_pin_code						=	$this->input->post('school_pincode');
		$father_name 						= 	$this->input->post('father_name');
		$father_occupation 					= 	$this->input->post('father_occupation');
		$mother_name 						= 	$this->input->post('mother_name');
		$mother_occupation 					= 	$this->input->post('mother_occupation');
		$father_mobile_no 					= 	$this->input->post('father_mobile_no');
		$mother_mobile_no 				    = 	$this->input->post('mother_mobile_no');

		$address1 							= 	$this->input->post('address1');
		$address2 							= 	$this->input->post('address2');
		$state_name 						= 	$this->input->post('state');
		$city 								= 	$this->input->post('city');
		$pincode 							= 	$this->input->post('pincode');
		$home_number 						= 	$this->input->post('home_number');
		$last_logon_time	 				= 	date('Y-m-d H:i:s');
		$student_status						= 	'active';
		$user_name							=	$first_name.substr($student_mobile_number,8).$roll_no;

		$data = array(
			'reg_no'					=>	$reg_no,
			'roll_no'					=>	$roll_no,
			'username' 					=> 	$user_name,
			'password' 					=> 	$student_mobile_number,
			'first_name' 				=>	$first_name,
			'last_name' 				=>	$last_name,
			'student_email' 			=>	$email,
			'student_phone_no' 			=> 	$student_mobile_number,
			'stream'					=>	$stream,
			'gender' 					=>	$gender,
			'category' 					=> 	$category,
			'dob' 						=>	date('Y-m-d',strtotime($dob)),
			'enrollment_date'			=>	date('Y-m-d'),
			'addmission_class' 			=>	$addmission_class,
			'studying' 					=>	$student_study_status,
			'school_name' 				=>	$school_name,
			'school_timing' 			=>	$school_timing,
			'school_weekoff_day	' 		=>	$week_day,
			'board' 					=> 	$board,
			'total_marks' 				=>	$total_marks,
			'che_marks' 				=>	$che_marks,
			'math_marks' 				=>	$math_marks,
			'bio_marks' 				=> 	$bio_marks,
			'phy_marks' 				=> 	$phy_marks,
			'science_marks' 			=>	$science_marks,
			'school_address' 			=>	$school_address,
			'school_pincode'			=>	$schoo_pin_code,
			'father_name' 				=>	$father_name,
			'father_occupation' 		=>	$father_occupation,
			'mother_name' 				=>	$mother_name,
			'mother_occupation' 		=> 	$mother_occupation,
			'guardian_mobile_no' 		=> 	$father_mobile_no,
			'guardian_phone_no' 		=>	$mother_mobile_no,
			'address1' 					=> 	$address1,
			'address2' 					=>	$address2,
			'state' 					=>	$state_name,
			'city' 						=>	$city,
			'pincode' 					=>	$pincode,
			'landline_no' 				=> 	$home_number,
			'status' 					=>	$student_status,
			'last_logon_time' 			=>	$last_logon_time,
			'student_list_date'			=>	date('Y-m-d'),
		);
		$this->common_model->insert_data($data,'tbl_student');
		@$this->email->set_mailtype("html");
		@$html_email_user = $this->load->view('front/welcome_mail',$data, true);
		@$this->email->from('admin@parthaedu.com');
		@$this->email->to($email);
		@$this->email->subject('Welcome To Partha!');
		@$this->email->message($html_email_user);
		@$result=$this->email->send();

		$id = $this->db->insert_id();

		foreach($_FILES['profile_pic']['tmp_name'] as $key => $value )
		{
			$file_name[] = $key.$_FILES['profile_pic']['name'][$key];
			$file=$key.$_FILES['profile_pic']['name'][$key];
			$file_size =$_FILES['profile_pic']['size'][$key];
			$file_tmp =$_FILES['profile_pic']['tmp_name'][$key];
			$file_type=$_FILES['profile_pic']['type'][$key];
			$new_name1 = str_replace(".","",microtime());
			$new_name=str_replace(" ","_",$new_name1);
			$ext=substr(strrchr($file,'.'),1);
			if($ext=="jpeg" || $ext=="jpg" || $ext=="png" || $ext=="gif")
			{
				move_uploaded_file($file_tmp,"uploads/profile_image/".$new_name.".".$ext);
				if(($_FILES['profile_pic']['name'][$key]))
				{
					$original_image_file_name =$new_name.".".$ext;
					$jobseeker_id=$this->session->userdata('jobseeker_id');
					$doc_data=array(
						"student_id"=>$id,
						"img_name"=>$new_name.".".$ext,
						//"upload_date"=>date("Y-m-d"),
					);
					$this->common_model->insert_data($doc_data,'student_profile_image');
				}
				else
				{
					$this->session->set_flashdata("message","Field Is Missing !");
					//redirect('index.php/user_management/doctor_list');
				}
			}
			else
			{
				$doc_data=array(
					"student_id"=>$id,
					"img_name"=>'no_image.jpg'
					//"upload_date"=>date("Y-m-d"),
				);
				$this->common_model->insert_data($doc_data,'student_profile_image');
				$this->session->set_flashdata("message","Only .jpeg, .jpg, .gif, .png File Supported !Field Is Missing !");
				//redirect('index.php/user_management/doctor_list');
			}
		}


		foreach($_FILES['mark_sheet']['tmp_name'] as $key => $value )
		{

			$file_name[] = $key.$_FILES['mark_sheet']['name'][$key];
			$file=$key.$_FILES['mark_sheet']['name'][$key];
			$file_size =$_FILES['mark_sheet']['size'][$key];
			$file_tmp =$_FILES['mark_sheet']['tmp_name'][$key];
			$file_type=$_FILES['mark_sheet']['type'][$key];
			$new_name1 = str_replace(".","",microtime());
			$new_name=str_replace(" ","_",$new_name1);
			$ext=substr(strrchr($file,'.'),1);
			if($ext=="jpeg" || $ext=="jpg" || $ext=="png" || $ext=="gif")
			{
				move_uploaded_file($file_tmp,"uploads/".$new_name.".".$ext);
				if(($_FILES['mark_sheet']['name'][$key]))
				{
					$original_image_file_name =$new_name.".".$ext;
					$jobseeker_id=$this->session->userdata('jobseeker_id');
					$doc_data=array(
						"student_id"=>$id,
						"marks_sheet_name"=>$new_name.".".$ext,
						//"upload_date"=>date("Y-m-d"),
					);
					$this->common_model->insert_data($doc_data,'mark_sheet_image');
				}
				else
				{
					$this->session->set_flashdata("message","Field Is Missing !");
					//redirect('index.php/user_management/doctor_list');
				}
			}
			else
			{
				$doc_data=array(
					"student_id"=>$id,
					"marks_sheet_name"=>'no_image.jpg',
					//"upload_date"=>date("Y-m-d"),
				);
				$this->common_model->insert_data($doc_data,'mark_sheet_image');
				$this->session->set_flashdata("message","Only .jpeg, .jpg, .gif, .png File Supported !Field Is Missing !");
				//redirect('index.php/user_management/doctor_list');
			}
		}

		redirect('addstudent','refresh');
		
	}

	function multiple_registration_view()
	{
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/excel_view');
		$this->load->view('admin/template/admin_footer');
	}

	public function view()
	{
		$objPHPExcel = new PHPExcel();
		//............Excel File Upload..............................

		$new_name = time().rand(000,999).$_FILES['excelfile']['name'];
		$config['file_name'] = $new_name;
		$config['upload_path'] = 'uploads/csv_file';
		$config['allowed_types'] = 'xlsx';
		$this->load->library('upload', $config);
		$dir = $this->upload->do_upload('excelfile');
		$data_upload_files = $this->upload->data();
		$image = $data_upload_files['file_name'];
		$finename =  $data_upload_files['raw_name'];
		//............................................................
		//...........Read Upload Excel File path with name.......................
		$file = 'uploads/csv_file/'.$new_name;
		//.......................................................................
		//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();


		foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
		{
			$hr = $worksheet->getHighestRow();
			$hc = $worksheet->getHighestColumn ();
			$higestcolumnindex = PHPExcel_Cell::columnIndexFromString($hc);
			//...........Dynamically............................................

			/*for($row = 1; $row <= 1; $row++)//first row is heading
			{
				$first_column = array();
				for($col = 0; $col < $higestcolumnindex; $col++)
				{

					$cell = $worksheet->getCellByColumnAndRow($col,$row);
					$first_column = $cell->getValue();
					$column_name[] = $first_column;

					//echo  $val1;
					echo "<pre>";

					//print_r($val1);
					echo "</pre>";
					//echo $val1[0];
				}
				print_r($column_name);
				//$this->excel_model->createtable($finename,$column_name);


			}*/



			//................end Dynamically........................................

			for($row = 2; $row <= $hr; $row++)//first row is heading
			{
				$val1 = array();
				for($col = 0; $col < $higestcolumnindex; $col++)
				{

					$cell = $worksheet->getCellByColumnAndRow($col,$row);
					$val = $cell->getValue();
					$val1[] = $val;
					
					//$this->excel_model->insert($finename,$val1);
					//echo  $val1;
					echo "<pre>";

					print_r($val1);
					echo "</pre>";
					//echo $val1[0];
				}

				//$this->excel_model->insert($finename,$val1);
			}

			//$this->excel_model->createtable($finename,$column_name,$val1);
			//$this->excel_model->insert($finename,$val1);


		}

		//..........insert excel data into database........................
		//$this->load->view('excel_view');
		//..................................................................
	}
	
	
	function multiple_registration()
	{
		/*if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}*/
		$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='./uploads/csv_file/';
		$config['allowed_types'] = 'csv';				
		$config['file_name']=$new_name;		
		$this->load->library('upload', $config);		
		//==========end:resize body_part image======================			
		$field_name = "student_csv";
		
		if($this->upload->do_upload($field_name))
		{
			$file_info = $this->upload->data();
			$original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
			$file_size=$file_info['file_size'];
			$this->image_lib->clear();
			  
			$csv_file ='./uploads/csv_file/'.$file_info['raw_name'].$file_info['file_ext'];			
			$this->load->library('csvreader');
			$result =   $this->csvreader->parse_file($csv_file);		
			$data['csvData'] =  $result;
			
			foreach($data['csvData'] as $f){
				foreach($f as $fieldna=>$fieldvalue){
					$registration[]=$fieldna;
				}
			break;
			}
			
			
					
			if($registration[0]!=='registration_no' && $registration[1]!=='firstname' && $registration[2]!=='lastname')
			{
				$this->session->set_flashdata('error_message',"The first column name of the sheet should be 'Registration_no'. Please follow the sample sheet. ");
				redirect("addstudent","refresh");
			}else{
							
					foreach($data['csvData'] as $field)
					{	
					
					$feesnotmatch_str='';
					$match_regisno_str='';
					$notAdd_record_msg='';
		
					$match_regisno_str.='<br>Please check registration no- '.$field['registration_no'];
										
						if($field['status']==''){ $status='active';  } else {$status= $field['status'] ;}
						if($field['blood_group']==''){$bloodGroup='unknown'; } else {$bloodGroup=$field['blood_group'];}
						if($field['gender']==''){$gender='female' ;} else{$gender=$field['gender']; }
						if($field['role_id']==''){$role_id='2' ;}else{$role_id=$field['role_id']; }
						$currentdate = date('Y-m-d H:i:s'); 
						if($field['datetime']=='')
						{
							$registrDate=$currentdate; 
							 }
						else{
							$registrDate=$field['datetime'];   
							 }
						$username=(substr($field['firstname'],0,2).substr($field['lastname'],0,2));     //username is unique.
						$class_id='';
						$generalfees=0.0;
						if($field['class']=='')
						{ 
							$notAdd_record_msg.="<br>Class Should Not Be Empty. Please check registration no- ".$field['registration_no'];
							$field['class']=0;
						}else{
							$class_id=$this->common_model->single_value('tblclass','id','name = "'.$field['class'].'"');
							if($class_id=='')
							{
								$notAdd_record_msg.="<br>This Class is not exists in database. Please check registration no- ".$field['registration_no'];
								$field['class']=0;
							}else{
								$generalfees=$this->common_model->single_value('fees','total','class_id = '.$class_id);
							}
						}
						
						if($field['totalfees']=='')
						{ 
							$notAdd_record_msg.="<br>Total Fess Should Not Be Empty. Please check registration no- ".$field['registration_no'];
							$field['totalfees']=0;
						}
						//else{
							/*if($generalfees != $field['totalfees'])
							{
								$feesnotmatch_str.='<br>Total Fees from excel sheet is not matched with Fees which has been set by administrator.';								
								$generalfees=$field['totalfees'];								
							}*/
						//}
						
						//--------------------------------Concession / Special Amount---------------
						$concession_id=0;
						$concessionuser_id=0;
						if($field['concession_amount'] !='')
						{
							$concession_id=$this->common_model->single_value('concession','id','concession_amount = '.$field['concession_amount']);							
							if($concession_id=='')
							{
								$feesnotmatch_str.='<br>Concession Amount is not matched with the aoumnt which has been set by Administrator.';
								$concession_id=0;
							}
						}else{
							$field['concession_amount']=0;
						}							
						
					$specialfees_id=0;	
					$specialuser_id=0;
						if($field['special_fees'] !='')
						{
							$specialfees_id=$this->common_model->single_value('specialfees','id','specialamount = '.$field['special_fees']);
							if($specialfees_id=='')
							{
								$feesnotmatch_str.='<br>Special Fees is not matched with the aoumnt which has been set by Administrator.';
								$specialfees_id=0;
							}
							
						}else{
							$field['special_fees']=0;
						}
						
						if($field['final_fees']=='')
						{ 
							$field['final_fees']=$field['totalfees'];
						}else{
							if($field['final_fees'] != $field['totalfees'])
							{
								$final=( $field['totalfees'] + $field['special_fees'] ) - $field['concession_amount'];
								if($field['final_fees']!=$final)
								{
									$feesnotmatch_str.='<br>Please check concession amount and special fees.Calculation is not matched.';
								}
							}
						}
						
						$data = array(
							'username' => $username,
							'registration_no'=>$field['registration_no'],							
							'first_name'=>  $field['firstname'],
							'last_name' => $field['lastname'],
							'middle_name' => $field['middle_name'],
							'email'=> $field['email'],
							'phone'=> $field['phonenumber'],
							'address' => $field['address'],						
							'status'=>$status,							
							'country_name' => $field['country_name'],
							'state' => $field['state'],	
							'city' => $field['city'],
							'city_dist'=>$field['district'],	
							'religion' => $field['religion'],
							'blood_group' => $bloodGroup,
							'mother_tongue' => $field['mother_tongue'],
							'postal_code' => $field['postal_code'],
							'mobile' => $field['mobile'],
							'gender' => $gender,
							'date_of_birth' => date('Y-m-d',strtotime($field['date_of_birth'])),
							'birth_place' => $field['birth_place'],	
							'role_id' =>$role_id,	
							'lastlogon_datetime' =>date('Y-m-d',strtotime($field['datetime'])),
							//'generalfees'=>$generalfees,
							'class_id'=>$class_id,
							'fees'=>$generalfees,//$field['final_fees'],
							'registration_date'=>date('Y-m-d',strtotime($registrDate)),
							'promotion_date'=>date('Y-m-d',strtotime($registrDate))
												
						);
						
				$id='';
					$table='student';
						if($field['registration_no']!='' && $class_id!='' && $generalfees!=0 )
						{
							$exist_registration=$this->common_model->selectOne($table,'registration_no',$field['registration_no']);					
							if(count($exist_registration)==0)
							{
								$this->common_model->insert_data($data,$table);
								$id=$this->db->insert_id();         //$id=autoincrement no
							}				
							
							$registration_no='';       
							if($id!='' && $username!='')
							{		
								if($role_id==2)
								{
									$username='S'.$username.$id;    //Student==2							
									if($field['registration_no']==''){
											$registration_no='02'.$id; }else{$registration_no=$field['registration_no'];   }
								}
								
								$data=array('username'=>$username,'registration_no'=>$registration_no);
								$this->common_model->update_data($data,'student','id',$id);
								
						//----------------f e e s user c l a s s-------------------------
								$data_fees_user_class = array(
									'user_id' =>$id,
									'class_id'=>$class_id,
									//'totfees'=>($generalfees + trim($field['special_fees'])) - trim($field['concession_amount']),
									'updated_date'=>date('Y-m-d H:i:s'),
									'created_date'=>date('Y-m-d H:i:s')
								);
								$this->common_model->insert_data($data_fees_user_class,'fees_user_class');
								
								$session_charge=0;
								$session=$this->common_model->selectWhere('sessioncharge','(class = '.$class_id.' OR class = 0)');
									if(isset($session[0]->amount))
									{
										if($session[0]->amount!='')
										{										
											$session_charge=$session[0]->amount;
										}
									}
								
								$session_charge_arr = array(
									'user_id' =>$id,
									'class_id'=> $class_id,
									'session_charge'=>$session_charge,
									'created_date'=>date('Y-m-d H:i:s')
								);
								$this->common_model->insert_data($session_charge_arr,'session_charge');
								
								//------------------S T A R T -------concession /special Amount-----------------
								$concessionuser_id=0;
								$specialuser_id=0;
								if($concession_id !=0)
								{
									$data_concession = array(
										'user_id' =>$id,
										'concession_id'=>$concession_id,
										'amount'=>$field['concession_amount'],
										'effective_month'=>date('Y-m-d H:i:s'),
										'endmonth'=>date('Y-m-d H:i:s'),
										'created_date'=>date('Y-m-d H:i:s')
									);
									$this->common_model->insert_data($data_concession,'concession_user');
									$concessionuser_id=$this->common_model->max_id('concession_user','id');
								}		
									if($specialfees_id!=0)
									{	
										$data_specialfees = array(
												'user_id' =>$id,
												'specialfees_id'=>$specialfees_id,
												'amount'=>$field['special_fees'],
												'effective_month'=>date('Y-m-d H:i:s'),
												'endmonth'=>date('Y-m-d H:i:s'),
												'created_date'=>date('Y-m-d H:i:s')
										);
										$this->common_model->insert_data($data_specialfees,'specialfees_user');
										$specialuser_id=$this->common_model->max_id('specialfees_user','id');
									}
									
									
								//-------------------------E N D ------concession /special Amount-----------------						
							
							}				
					
						if($feesnotmatch_str!='' || $notAdd_record_msg!="")
						{
							$data_errormsg=array(
								'user_id'=>$field['registration_no'],
								'error_msg'=>$match_regisno_str.$feesnotmatch_str.$notAdd_record_msg,
								'created_date'=>date('Y-m-d H:i:s')
							);
							$this->common_model->insert_data($data_errormsg,'student_registration_error');	
						}
					}
				}
				$this->session->set_flashdata("insert_message","The file has been Uploaded Successfully.");
			}// end of end condition 
		}
		redirect("addstudent","refresh");		
	}
	function checkusernameavailability(){
		$registration_no = trim($this->input->post('registration_no'));
		//$email ='sirajul@gmail.com';
		$bAvailibility = $this->common_model->check_username_availability($registration_no);
		echo json_encode(array("Available" => $bAvailibility )) ;	
	}
	
	
	
}?>