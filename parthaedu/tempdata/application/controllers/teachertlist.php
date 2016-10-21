<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class teachertlist extends CI_Controller {
	
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
		$data['roles']=$this->common_model->getAllRoles();
		$value=0;
		$data['stud_list']=$this->common_model->selectAll('teacher');
		foreach($data['stud_list'] as $teacher_row)
		{
			$teacher_row->up_salary=$this->common_model->single_value('salary_teacher','salary','user_id = '.$teacher_row->id);
		}			
		$data['class']=	$this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('section');
		
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/teacherlist_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	function edit()
	{
		$data['class']=	$this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('section');
		$data['department']=$this->common_model->selectAll('department');
		$data['country']=$this->common_model->get_country();
		$data['city']=$this->common_model->get_city();
		$data['state']=$this->common_model->get_state();
		$data['userid']=$_GET['userid'];
		$data['teacher']=$this->common_model->selectOne('teacher','id',$_GET['userid']);
		foreach($data['teacher'] as $teacher_row)
		{
			$teacher_row->up_salary=$this->common_model->single_value('salary_teacher','salary','user_id = '.$teacher_row->id);
		}
		
		//echo "<pre>"; print_r($data['teacher']);	exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/editteacher_view',$data);
		$this->load->view('admin/template/admin_footer');
			
		
	}
	function update()
	{
		if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					$this->permission_lib->permit($this->user_id,$this->user_role);
				}
		$userid = trim($this->input->post('userid'));
		$firstname = trim($this->input->post('firstname'));
		$middle_name = trim($this->input->post('middle_name')); 
		$lastname = trim($this->input->post('lastname'));		
			
		$date_of_birth = trim($this->input->post('date_of_birth')); 
		$birth_place = trim($this->input->post('birth_place')); 
		$email = trim($this->input->post('email')); 
		$phonenumber = trim($this->input->post('phonenumber')); 
		$address = trim($this->input->post('address'));  
		$gender = trim($this->input->post('gender'));
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
		
		$role_id = 3;
		$data = array(			
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
			//'salary'=>$salary,
			'mother_tongue'=>$mother_tongue,
			'religion'=>$religion,
			'country_name'=>$country,
			'state'=>$state,
			'city'=>$city,
			'city_dist'=>$dist_city,
			'blood_group'=>$blood_group,
			'postal_code'=>$postal_code,
			'mobile' =>$mobile,
			'status' =>$status			
		);
		$table='teacher';
		$this->common_model->update_data($data,$table,'id',$userid);		
		$exist_id=$this->common_model->single_value('salary_teacher','user_id','user_id = '.$userid);	
		if($exist_id=='')
		{
			$data_salary=array(
				'salary' => $salary,
				'user_id'=>$userid,
				'updated_date'=>date('Y-m-d H:i:s')
				);
			$this->common_model->insert_data($data_salary,'salary_teacher','user_id',$userid);	
		}
		redirect('teachertlist/edit?userid='.$userid,'refresh');
		}
		
	function salary()
	{
		if($this->user_role!=1)
		{
			$this->load->library('permission_lib');
			$this->permission_lib->permit($this->user_id,$this->user_role);
		}
		$userid = trim($this->input->post('userid'));
		$salary = trim($this->input->post('salary'));
		$data_salary=array(
				'salary' => $salary,
				'updated_date'=>date('Y-m-d H:i:s')
				);
		
		$this->common_model->update_data($data_salary,'salary_teacher','user_id',$userid);	
		$data_salary_teacher=array(
				'salary' => $salary,
				'id'=>$userid
				);
		
		$this->common_model->update_data($data_salary_teacher,'teacher','id',$userid);	
		redirect('teachertlist','refresh');
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
		$this->common_model->delete_data('salary_teacher','user_id',$id);
		redirect($page,'refresh');
	}
	
	
}
?>