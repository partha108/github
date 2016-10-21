<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sub_admin extends CI_Controller 
{ 
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
			$this->load->model('admin_model');
			$this->load->model('search_model');
			$this->load->model('unit_model');
			$this->load->model('sub_admin_model');
			
			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
	 }
	 function add_sub_admin()
	 {
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/add_sub_admin')=='Y' || $admin_details[0]->role_id==1) 
		{
		$this->load->view('template/admin_header');
		$this->load->view('template/admin_leftmenu');
		$this->load->view('sub_admin_add_view');
		$this->load->view('template/admin_footer');	
		}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		}
	 }
	 
	 function add_sub_admin_action()
	 {
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/add_sub_admin_action')=='Y' || $admin_details[0]->role_id==1) 
		{
		$sub_admin_full_name=trim($this->input->post('sub_admin_full_name')); 
		$user_name=trim($this->input->post('user_name')); 
		$sub_admin_email=trim($this->input->post('sub_admin_email')); 
		$sub_admin_password=trim($this->input->post('sub_admin_password')); 
		
		$this->session->set_flashdata('sub_admin_full_name',$sub_admin_full_name);
		$this->session->set_flashdata('user_name',$user_name);
		$this->session->set_flashdata('sub_admin_email',$sub_admin_email);
		$this->session->set_flashdata('sub_admin_password',$sub_admin_password);
		//echo $sub_admin_password;exit;

		  $data['sub_admin_edit_details_by_user_name']=$this->sub_admin_model->sub_admin_edit_details_by_user_name($this->input->post('user_name'));
		  $data['sub_admin_edit_details_by_email']=$this->sub_admin_model->sub_admin_edit_details_by_email($this->input->post('sub_admin_email'));
		  
		  $sub_admin_edit_details_by_user_name=$data['sub_admin_edit_details_by_user_name'];
		  $sub_admin_edit_details_by_email=$data['sub_admin_edit_details_by_email'];
		//print_r( $data['unit_edit_details']);exit;
		 if(count($sub_admin_edit_details_by_user_name)<=0 && count($sub_admin_edit_details_by_email)<=0)
		 {
			 //echo 'test';exit();
			$sub_admin_data=array
					(
						'user_full_name'=>$sub_admin_full_name,
						'username'=>$user_name,
						'email'=>$sub_admin_email,
						'password'=>$sub_admin_password,
						'status'=>'inactive',
						'role_id'=>2,
						'created_time_stamp'=>time(),
						'logged_ip' => ""
					);
			if($this->db->insert('tbluser',$sub_admin_data))
			{
			  
			  $this->email->from('exprolab@gmail.com');
			  $this->email->to($sub_admin_email);			  
			  $this->email->subject('Sub Admin Login Info.');
			  $this->email->message('Dear ' . $sub_admin_full_name . ' Your Username: '. $user_name .' And Password: '. $sub_admin_password .' For The Role Of Sub Admin. Thanks! ');
			  
			  $this->email->send();
			}
		    $this->session->set_flashdata('message','Sub-Admin ['.$this->input-> post('user_name').'] has been Added successfully.');
			redirect('index.php/sub_admin_list_manage','refresh');
		
		 }
		 else
		 {
			 if(count($sub_admin_edit_details_by_user_name)>0 && count($sub_admin_edit_details_by_email)>0)
			 {
				 $this->session->set_flashdata('message','Sub-Admin [USER-NAME:'.$user_name.'] & [EMAIL:'.$sub_admin_email.'] Is Already Exist.');
			 }
			 else if(count($sub_admin_edit_details_by_user_name)>0 )
			 {
				  $this->session->set_flashdata('message','Sub-Admin [USER-NAME:'.$user_name.'] Is Already Exist.');
			 }
			 else if(count($sub_admin_edit_details_by_email)>0)
			 {
				 $this->session->set_flashdata('message','Sub-Admin [EMAIL:'.$sub_admin_email.'] Is Already Exist.'); 
			 }
			
			redirect('index.php/sub_admin/add_sub_admin','refresh');
			
		 }
		 }
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		}
	 }

	 function sub_admin_edit()
	 {
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/sub_admin_edit')=='Y' || $admin_details[0]->role_id==1) 
		{
		    
		    $id=$this->uri->segment(3);
			if($id)
			{
				
				$data['sub_admin_edit_details']=$this->sub_admin_model->sub_admin_edit_details($id);
				
				if(count($data['sub_admin_edit_details'])>0)
				{
					$this->load->view('template/admin_header');
					$this->load->view('template/admin_leftmenu');
					$this->load->view('sub_admin_edit_view', $data);
					$this->load->view('template/admin_footer');	
				}
				else
				{
					$data_user['page_tag']='UNIT EDIT';
					$this->load->view('template/admin_header');
					$this->load->view('template/admin_leftmenu');
					$this->load->view('no_record_found');
					$this->load->view('template/admin_footer');	
				}
			}
			else
			{
				    $data_user['page_tag']='UNIT EDIT';
					$this->load->view('template/admin_header');
					$this->load->view('template/admin_leftmenu');
					$this->load->view('invalid_url');
					$this->load->view('template/admin_footer');	
			}
			}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		}
	 } 
	 function sub_admin_edit_action()
	 {
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/sub_admin_edit_action')=='Y' || $admin_details[0]->role_id==1) 
		{
		 
		  $id=$this->input->post('id'); 
		  
		  $sub_admin_password=trim($this->input->post('sub_admin_password'));
		  $sub_admin_full_name=trim($this->input->post('sub_admin_full_name')); 
		  $user_name=trim($this->input->post('user_name')); 
		  $sub_admin_email=trim($this->input->post('sub_admin_email')); 
		  $sub_admin_password=trim($this->input->post('sub_admin_password')); 
		  $data['sub_admin_edit_details_by_user_name']=$this->sub_admin_model->sub_admin_edit_details_by_user_name($this->input->post('user_name'));
		  $data['sub_admin_edit_details_by_email']=$this->sub_admin_model->sub_admin_edit_details_by_email($this->input->post('sub_admin_email'));
		  
		  $sub_admin_edit_details_by_user_name=$data['sub_admin_edit_details_by_user_name'];
		 
		  
		
		  $sub_admin_edit_details_by_email=$data['sub_admin_edit_details_by_email'];
		  
		
		 if(count($sub_admin_edit_details_by_user_name)>0 || count($sub_admin_edit_details_by_email)>0)
		 {
			if(count($sub_admin_edit_details_by_email)>0)
			{
			  	$sub_admin_edit_details_by_email_id=$sub_admin_edit_details_by_email[0]->id;
			}
			else
			{
				$sub_admin_edit_details_by_email_id='';
			}
			
			if(count($sub_admin_edit_details_by_user_name)>0)
			{
			  	$sub_admin_edit_details_by_user_name_id=$sub_admin_edit_details_by_user_name[0]->id;
			}
			else
			{
				$sub_admin_edit_details_by_user_name_id='';
			}
			//echo $sub_admin_edit_details_by_user_name_id.' '.$sub_admin_edit_details_by_email_id;exit;
			 
			
			  if($id==$sub_admin_edit_details_by_user_name_id && $id==$sub_admin_edit_details_by_email_id)
			  {
					$sub_admin_data=array
					(
						'user_full_name'=>$sub_admin_full_name,
						'username'=>$user_name,
						'email'=>$sub_admin_email,
						'password'=>$sub_admin_password,
						'role_id'=>2,
						//'edited_time_stamp'=>time()
					);
					$this->db->where('id',$id);
					$this->db->update('tbluser',$sub_admin_data);
					$this->session->set_flashdata('message','Sub admin has been updated successfully.');
					
					redirect('index.php/sub_admin_list_manage','refresh');
					
			  }
			  else if($id==$sub_admin_edit_details_by_email_id && count($sub_admin_edit_details_by_user_name)<=0)
			  {
				   $sub_admin_data=array
					(
						'user_full_name'=>$sub_admin_full_name,
						'username'=>$user_name,
						'email'=>$sub_admin_email,
						'password'=>$sub_admin_password,
						'role_id'=>2,
						//'edited_time_stamp'=>time()
					);
					$this->db->where('id',$id);
					$this->db->update('tbluser',$sub_admin_data);
					$this->session->set_flashdata('message','Sub admin has been updated successfully.');
					redirect('index.php/sub_admin_list_manage','refresh');
			  }
			  else if($id==$sub_admin_edit_details_by_user_name_id && count($sub_admin_edit_details_by_email)<=0)
			  {
				    $sub_admin_data=array
					(
						'user_full_name'=>$sub_admin_full_name,
						'email'=>$sub_admin_email,
						'username'=>$user_name,
						'password'=>$sub_admin_password,
						'role_id'=>2,
						//'edited_time_stamp'=>time()
					);
					$this->db->where('id',$id);
					$this->db->update('tbluser',$sub_admin_data);
					$this->session->set_flashdata('message','Sub admin has been updated successfully.');
					redirect('index.php/sub_admin_list_manage','refresh');
				  
			  }
			  else
			  {
				  if(count($sub_admin_edit_details_by_user_name)>0 && count($sub_admin_edit_details_by_email)>0 && $id!=$sub_admin_edit_details_by_user_name_id && $id!=$sub_admin_edit_details_by_email_id)
				  {
						$this->session->set_flashdata('message','Sub admin [USER-NAME:'.$user_name.'] & [EMAIL:'.$sub_admin_email.']  Is Already Exist.');
				  }
				  else if(count($sub_admin_edit_details_by_user_name)>0 && $id!=$sub_admin_edit_details_by_user_name_id)
				  {
					   $this->session->set_flashdata('message','Sub admin [USER-NAME:'.$user_name.']  Is Already Exist.');
				  }
				  else if(count($sub_admin_edit_details_by_email)>0 && $id!=$sub_admin_edit_details_by_email_id)
				  {
					   $this->session->set_flashdata('message','Sub admin [EMAIL:'.$sub_admin_email.'] Is Already Exist.');
				  }
				   redirect('index.php/sub_admin/sub_admin_edit/'.$id,'refresh');
			  }
		 }
		 else
		 { 
				$sub_admin_data=array
				(
					'user_full_name'=>$sub_admin_full_name,
					'username'=>$user_name,
					'email'=>$sub_admin_email,
					'password'=>$sub_admin_password,
					'role_id'=>2,
					//'edited_time_stamp'=>time()
				);
				$this->db->where('id',$id);
				$this->db->update('tbluser',$sub_admin_data);
				$this->session->set_flashdata('message','Sub admin has been updated successfully.');
				redirect('index.php/sub_admin_list_manage','refresh');
		 }
		 	}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		}
		  
	 }
	 function activity_jobseeker($id)
	 {
		  $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/activity_jobseeker')=='Y' || $admin_details[0]->role_id==1) 
		{
		
		$data["subadmin_jobseeker_detail"]=$this->admin_model->subadmin_jobseeker($id);		
		$this->load->view('template/admin_header');
		$this->load->view('template/admin_leftmenu');
		$this->load->view('subadmin_jobseeker',$data);
		$this->load->view('template/admin_footer');
			}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		} 
	 }
	 function activity_resume($id)
	 {
		  $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/activity_resume')=='Y' || $admin_details[0]->role_id==1) 
		{		
			
		$data["subadmin_resume_detail"]=$this->admin_model->subadmin_resume($id);	
		$this->load->view('template/admin_header');
		$this->load->view('template/admin_leftmenu');
		$this->load->view('subadmin_resume',$data);
		$this->load->view('template/admin_footer');
			}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		} 
	 }
	 function activity_doc($id)
	 {
		  $admin_details=$this->session_check_and_session_data->admin_session_data();
 		if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin/activity_doc')=='Y' || $admin_details[0]->role_id==1) 
		{
		
		$data["subadmin_doc_detail"]=$this->admin_model->subadmin_doc($id);
		$this->load->view('template/admin_header');
		$this->load->view('template/admin_leftmenu');
		$this->load->view('subadmin_doc',$data);
		$this->load->view('template/admin_footer');
			}
		else
		{
			$this->session->set_flashdata('message','Access Denied.');
			 redirect('index.php/','refresh');
		} 
	 }
}

?>