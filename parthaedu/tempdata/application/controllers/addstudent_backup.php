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
			$this->load->model('fees_model');
			$this->load->library('image_lib');
			$this->load->helper('email');
			$this->load->model('common_model');
			
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
		$data['class']=	$this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('section');
	
		$data['roles']=$this->common_model->getAllRoles();
		
		$data['country']=$this->common_model->get_country();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();
		$data['concession']=$this->common_model->selectAll('concession');
		$data['specialfees']=$this->common_model->selectAll('specialfees');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/addstudent_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	
	public function registration_post()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$class = trim($this->input->post('class')); if($class==''){ $class=0;}
		
		
		$fees = trim($this->input->post('fees'));
		if($fees==''){ $fees=0;}
		
		$session_charge = trim($this->input->post('session_charge'));
		if($session_charge==''){ $session_charge=0;}	
		
		$deposit = trim($this->input->post('deposit'));
		if($deposit==''){ $deposit=0;}
		
		$allamount = trim($this->input->post('allamount'));
		if($allamount==''){ $allamount=0;}
		
				
		$concessionamount = trim($this->input->post('concessionamount'));
		if($concessionamount==''){ $concessionamount=0;}
		$specialamount = trim($this->input->post('specialamount'));
		if($specialamount==''){ $specialamount=0;}
		
		$concession_id = trim($this->input->post('concession_id'));
		if($concession_id==''){ $concession_id=0;}
		$specialfees_id = trim($this->input->post('specialfees_id'));
		if($specialfees_id==''){ $specialfees_id=0;}
		
		$section=trim($this->input->post('section')); if($section==''){ $section=0;}
		$password = trim($this->input->post('password')); 		
		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$registration_no = trim($this->input->post('registration_no'));
		if($firstname!='' || $lastname!=''){
			$username=(substr($firstname,0,2).substr($lastname,0,2));     //username is unique.
		}else{
			$username=$firstname;
		}			
		$email = trim($this->input->post('email'));if($email==''){ $email='email@gmail.com';}
		
		$phonenumber = trim($this->input->post('phonenumber'));		
		$address = trim($this->input->post('address'));
		$date_of_birth = trim($this->input->post('date_of_birth')); if($date_of_birth==''){ $date_of_birth=date("Y-m-d");}
		$birth_place = trim($this->input->post('birth_place'));
		$middle_name = trim($this->input->post('middle_name'));
		$gender = trim($this->input->post('gender'));
		if($gender=='')
		{ 
			$gender='female';
		}
		$mother_tongue = trim($this->input->post('mother_tongue'));
		$religion = $this->input->post('religion');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$city_dist=trim($this->input->post('dist_city'));
		$country_name = trim($this->input->post('country'));
		$blood_group = trim($this->input->post('blood_group'));
		$postal_code = trim($this->input->post('postal_code'));
		$mobile = trim($this->input->post('mobile'));
		$status =trim($this->input->post('status'));
		if($status=='')
		{ 
			$status='active' ;
		}
		$role_id=trim($this->input->post('user'));		
		//---------------------------start file upload code------------------------------
		
		//==========Start:resize Item image======================//
		$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='./uploads/profile_image/temp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';				
		$config['file_name']=$new_name;		
		$this->load->library('upload', $config);		
		//==========end:resize body_part image======================			
		$field_name = "profile_image";
		$filename='';
		if($field_name!='')
		{
			$new_name=str_replace(' ', '_', $new_name);
			$ext = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
			 $filename=$new_name.".".$ext;
			move_uploaded_file($_FILES["profile_image"]["tmp_name"],'./uploads/profile_image/temp/'.$_FILES["profile_image"]["name"]);
			rename ('./uploads/profile_image/temp/'.$_FILES["profile_image"]["name"], './uploads/profile_image/temp/'.$filename);
			
			if(file_exists('./uploads/profile_image/temp/'.$filename))
			{
				$img_config_3['image_library'] = 'gd2';
				$img_config_3['source_image'] = './uploads/profile_image/temp/'.$filename;
				$img_config_3['maintain_ratio'] = FALSE;
				$img_config_3['width'] = 200;
				$img_config_3['height'] = 200;    
				$img_config_3['new_image'] ='./uploads/profile_image/small_images/'.$filename; 
				$this->image_lib->initialize($img_config_3);
				$this->image_lib->resize();	
				$this->image_lib->clear();
				
				//-------------------Big Image--------------------//
				
				$img_config_4['image_library'] = 'gd2';
				$img_config_4['source_image'] = './uploads/profile_image/temp/'.$filename;
				$img_config_4['maintain_ratio'] = FALSE;
				$img_config_4['width'] = 550;
				$img_config_4['height'] = 300;    
				$img_config_4['new_image'] ='./uploads/profile_image/big_images/'.$filename; 
				$this->image_lib->initialize($img_config_4);
				$this->image_lib->resize();	
				$this->image_lib->clear();
			}
			if(file_exists('./uploads/profile_image/temp/'.$filename))
			{
				unlink('./uploads/profile_image/temp/'.$filename);
			}
		}
			
				
		$datetime = date('Y-m-d H:i:s'); 
		$data = array(
			'username' =>$username,
			'password'=>$password,
			'first_name'=> $firstname,
			'last_name' =>$lastname,
			'middle_name' =>$middle_name,
			'email'=>$email,
			'phone'=>$phonenumber,
			'address' =>$address,						
			'status'=>$status,
			'country_name' =>$country_name,
			'state' => $state,	
			'city' => $city,
			'city_dist'=>$city_dist,	
			'religion' => $religion,
			'blood_group' => $blood_group,
			'mother_tongue' => $mother_tongue,
			'postal_code' => $postal_code,
			'mobile' => $mobile,
			'gender' => $gender,
			'date_of_birth' => $date_of_birth,
			'birth_place' => $birth_place,	
			'role_id' =>$role_id,	
			'lastlogon_datetime' =>$datetime,
			'profile_image' =>$filename,
			'class_id' =>$class,
			'fees' =>$fees,	
			'section_id'=>$section,
			'registration_no'=>$registration_no,			
			'registration_date'=>$datetime,
			'promotion_date'=>$datetime				
		);
		//echo "<pre>";print_r($data);
		$id='';
		$table='student';
		if($registration_no !='' && $class!='0' && $fees!='0')
		{
			$exist_registration=$this->common_model->selectOne($table,'registration_no',$registration_no);					
			if(count($exist_registration)==0)
			{
				$this->common_model->insert_data($data,$table);
				$id=$this->db->insert_id();          //$id=autoincremeant no
				exit;
			}
			
			if($id!='' && $username!=''){
				if($role_id==2){ 
					$username='S'.$username.$id;       //Student==2
				}
			$data=array('username'=>$username);		
			$this->common_model->update_data($data,$table,'id',$id);
			
			$data_pass = array (
						'password'=> $username.$id
		);
		$this->common_model->update_data($data_pass,$table,'id',$id);
			
			//----------------f e e s user c l a s s-------------------------
			if($id !='')
			{
				$data_fees_user_class = array(
					'user_id' =>$id,
					'class_id'=> $class,
					//'totfees'=>($fees + $specialamount) - $concessionamount ,
					'updated_date'=>date('Y-m-d H:i:s'),
					'created_date'=>date('Y-m-d H:i:s')
				);
				$this->common_model->insert_data($data_fees_user_class,'fees_user_class');				
			
			if($session_charge=='' || $session_charge==0)
			{
				$concession=$this->common_model->selectWhere('sessioncharge','(class_id = '.$class.' OR class_id = 0)');
				if(isset($concession[0]))
				{
					if($concession[0]->amount!='')
					{										
						$session_charge=$concession[0]->amount;
					}
				}
			}
			$session_charge = array(
					'user_id' =>$id,
					'class_id'=> $class,
					'session_charge'=>$session_charge,
					'created_date'=>date('Y-m-d H:i:s')
				);
				$this->common_model->insert_data($session_charge,'session_charge');
			
			$deposit = array(
					'user_id' =>$id,
					'class_id'=> $class,
					'deposit'=>$deposit,
					'created_date'=>date('Y-m-d H:i:s')
				);
				$this->common_model->insert_data($deposit,'security_deposit');
		
			}	
			//---------------------Concession A N D Special Fees------------------
			$concessionuser_id=0;
			$specialuser_id=0;
			if($concession_id !='')
			{
				$data_concession = array(
					'user_id'=> $id,
					'concession_id'=>$concession_id,
					'amount'=>$concessionamount,
					'effective_month'=>date('Y-m-d H:i:s'),
					'endmonth'=>date('Y-m-d H:i:s'),
					'created_date'=>date('Y-m-d H:i:s')
				);
				$this->common_model->insert_data($data_concession,'concession_user');
				$concessionuser_id=$this->common_model->max_id('concession_user','id');
			}		
				if($specialfees_id!='')
				{	
					$data_specialfees = array(
							'user_id'=>$id,
							'specialfees_id'=>$specialfees_id,
							'amount'=>$specialamount,
							'effective_month'=>date('Y-m-d H:i:s'),							
							'endmonth'=>date('Y-m-d H:i:s'),
							'created_date'=>date('Y-m-d H:i:s')
					);
					$this->common_model->insert_data($data_specialfees,'specialfees_user');
					$specialuser_id=$this->common_model->max_id('specialfees_user','id');
				}
				
			}
		}else{
				$this->session->set_flashdata("insert_message","Student Information has not been added.");
			}
		
		if($id !='')
		{
			$this->session->set_flashdata("insert_message","Student Information has been added Successfully");
		}else{
				$this->session->set_flashdata("insert_message","Student Information has not been added.");
			}
		
		 //echo "<pre>";print_r($data);exit;	
		
		redirect('addstudent','refresh');
		
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