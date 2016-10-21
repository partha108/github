<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class addteacher extends CI_Controller {
	
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
		$data['department']=$this->common_model->selectAll('department');
	
		$data['roles']=$this->common_model->getAllRoles();
		
		$data['country']=$this->common_model->get_country();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();		
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/addteacher_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	
	public function registration_post()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		
		$firstname = trim($this->input->post('firstname'));
		$middle_name = trim($this->input->post('middle_name')); 
		$lastname = trim($this->input->post('lastname'));
		$username='';
		if( $username=='')
		{
			$username=$firstname.$lastname;
			}
			
		$date_of_birth = trim($this->input->post('date_of_birth')); if($date_of_birth==''){ $date_of_birth=date("Y-m-d");} 
		$birth_place = trim($this->input->post('birth_place')); 
		$email = trim($this->input->post('email')); 
		$phonenumber = trim($this->input->post('phonenumber')); 
		$address = trim($this->input->post('address'));  
		$gender = trim($this->input->post('gender'));
		if($gender=='')
		{ 
			$gender='female';
		} 
		$department = trim($this->input->post('department'));
		$qualification = trim($this->input->post('qualification'));
		$position = trim($this->input->post('position'));
		$salary = trim($this->input->post('salary'));  
		$mother_tongue = trim($this->input->post('mother_tongue')); 
		$religion = trim($this->input->post('religion')); 
		$country = trim($this->input->post('country')); 
		$state = trim($this->input->post('state')); 
		$city = trim($this->input->post('city')); 
		$dist_city = trim($this->input->post('dist_city')); 
		$blood_group = trim($this->input->post('blood_group')); 
		$postal_code = trim($this->input->post('postal_code')); 
		$mobile = trim($this->input->post('mobile')); 
		$status = trim($this->input->post('status')); 
		if($status=='')
		{ 
			$status='active' ;
		}
		//---------------------------start file upload code------------------------------
		
		//==========Start:resize Item image======================//
		$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='./uploads/profile_image/temp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';				
		$config['file_name']=$new_name;		
		$this->load->library('upload', $config);		
		//==========end:resize body_part image======================			
		$field_name = "profile_image";	

		$profile_image=NULL;
		if($this->upload->do_upload($field_name))
		{			
			$file_info = $this->upload->data();
			$original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
			$file_size=$file_info['file_size'];
			$this->image_lib->clear();  			
			$profile_image =$file_info['raw_name'].$file_info['file_ext'];

			//-------------------------IMAGE RESIZE---------------------------
						$img_config_3['image_library'] = 'gd2';
						$img_config_3['source_image'] = './uploads/profile_image/temp/'.$file_info['file_name'];
						$img_config_3['maintain_ratio'] = FALSE;
						$img_config_3['width'] = 200;
						$img_config_3['height'] = 200;    
						$img_config_3['new_image'] ='./uploads/profile_image/small_images/'.$profile_image; 
						$this->image_lib->initialize($img_config_3);
						$this->image_lib->resize();	
						$this->image_lib->clear();
		//-------------------------IMAGE RESIZE---------------------------
						$img_config_4['image_library'] = 'gd2';
						$img_config_4['source_image'] = './uploads/profile_image/temp/'.$file_info['file_name'];
						$img_config_4['maintain_ratio'] = FALSE;
						$img_config_4['width'] = 550;
						$img_config_4['height'] = 300;    
						$img_config_4['new_image'] ='./uploads/profile_image/big_images/'.$profile_image; 
						$this->image_lib->initialize($img_config_4);
						$this->image_lib->resize();	
						$this->image_lib->clear();
		// ---------------------------end file upload code--------------------------------
		}	
		$datetime = date('Y-m-d H:i:s'); 
		$role_id = 3;
		$id='';
		if($salary!='' || $firstname!='' || $phonenumber!='')
		{ 
			$data = array(
				'username'=>$username,
				'first_name'=>$firstname,
				'middle_name'=>$middle_name,
				'last_name'=>$lastname,
				'date_of_birth'=>$date_of_birth,
				'birth_place'=>$birth_place,
				'email'=>$email,
				'phone'=>$phonenumber,
				'address'=>$address,
				'gender'=>$gender,
				'department_id'=>$department,
				'qualification'=>$qualification,
				'position'=>$position,
				'salary'=>$salary,
				'mother_tongue'=>$mother_tongue,
				'religion'=>$religion,
				'country_name'=>$country,
				'state'=>$state,
				'city'=>$city,
				'city_dist'=>$dist_city,
				'blood_group'=>$blood_group,
				'postal_code'=>$postal_code,
				'mobile'=>$mobile,
				'status'=>$status,
				'lastlogon_datetime'=>$datetime,
				'registration_date'=>$datetime,
				'profile_image'=>$profile_image,
				'role_id' =>$role_id				
			);
			$table='teacher';
			 $id =$this->common_model->insert_data($data,$table);
			 if($id!='')
			 {
				$data_pass = array (
							'password'=> $username.$id
				);
				$this->common_model->update_data($data_pass,$table,'id',$id);		
				$data_salary=array(
					'salary' => $salary,
					'user_id'=>$id,
					'updated_date'=>date('Y-m-d H:i:s'),
					'created_date'=>date('Y-m-d H:i:s')
					);
				$this->common_model->insert_data($data_salary,'salary_teacher');
			 }
		}
		 if($id !='')
		{
			$this->session->set_flashdata("insert_message","Information has been added Successfully");
		}else{
				$this->session->set_flashdata("insert_message","Information has not been added.");
			}
		
		redirect('teachertlist');
	}
	
	function multiple_registration()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
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
		
		//echo count($role_id); echo "<pre>";  print_r($role_id);
		if($registration[0]!=='first_name' && $registration[1]!=='middle_name' && $registration[2]!=='last_name' && $registration[3]!=='salary' )
			{
				$this->session->set_flashdata('error_message',"The first column name of the sheet should be 'first_name'. Please follow the sample sheet. ");
				redirect("addteacher","refresh");
			}else{
							
					foreach($data['csvData'] as $field)
					{	
								
					if($field['gender']=='')
					{ 
						$field['gender']='female';
					}
					if($field['salary']=='')
					{ 
						$field['salary']='0.00';
					}
					
						
						if($field['blood_group']=='')
					{ 
						$field['blood_group']='unknown';
					}
						if($field['status']=='')
					{ 
						$field['status']='active';
					}
						if($field['date_of_birth']=='')
					{ 
						$field['date_of_birth']='0000-00-00';
					}else {
						$field['date_of_birth']=date("Y-m-d", strtotime($field['date_of_birth']));
						}
						
						$username='';
					if( $username=='')
					{
						$username=$field['first_name'].$field['last_name'];
						}
						
						if ( $field['first_name'] =='' && $field['last_name']=='' || $field['mobile'] == '')
						{
							echo "Please follow the sample sheet . ";
							echo "<br>Please Enter First Name and Last Name ";
							echo "<br>Please Enter Mobile Number  ";
						}
						else {
							$name_str='first_name = "'.$field['first_name'].'" and middle_name = "'.$field['middle_name'].'" and last_name = "'.$field['last_name'].'"';
							$email_str=' and email = "'.$field['email'].'"';
							$salary_str=' and salary = "'.$field['salary'].'"';
							$exists=$this->common_model->selectWhere('teacher',$name_str.$email_str.$salary_str);
							if(count($exists)==0)
							{
								if($field['salary']!='')
								{	
									$data = array(
									'username' => $username,
									'first_name'=>$field['first_name'],
									'middle_name'=>$field['middle_name'],
									'last_name'=>$field['last_name'],
									'salary'=>$field['salary'],
									'department_id'=>$field['department_id'],
									'qualification'=>$field['qualification'],
									'position'=>$field['position'],
									'date_of_birth'=> $field['date_of_birth'],
									'birth_place'=> $field['birth_place'],
									'gender'=>$field['gender'],
									'mother_tongue'=>$field['mother_tongue'],
									'religion'=>$field['religion'],
									'address'=>$field['address'],
									'blood_group'=>$field['blood_group'],
									'country_name'=>$field['country_name'],
									'city'=>$field['city'],
									'state'=>$field['state'],
									'city_dist'=>$field['city_dist'],
									'postal_code'=>$field['postal_code'],
									'phone'=>$field['phone'],
									'lastlogon_datetime'=>date('Y-m-d H:i:s'),
									'mobile'=>$field['mobile'],
									'status'=>$field['status'],
									'email' => $field['email'],
									'registration_date'=>date('Y-m-d H:i:s'),
									'role_id' =>3									
									);
							
								  $table='teacher';
								  $id=$this->common_model->insert_data($data,$table);		
									if($id!='')
									 {
										$data_pass = array (
													'password'=> $username.$id
										);
										$this->common_model->update_data($data_pass,$table,'id',$id);		
										$data_salary=array(
											'salary' =>$field['salary'],
											'user_id'=>$id,
											'updated_date'=>date('Y-m-d H:i:s'),
											'created_date'=>date('Y-m-d H:i:s')
											);
										$this->common_model->insert_data($data_salary,'salary_teacher');
									 }
								}
							}
						
						}
					}
				}
	
			}
			
			redirect('teachertlist');
		}
		
		
	
	
	
}?>