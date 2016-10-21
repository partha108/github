<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authenticate extends CI_Controller {

 function __construct()
 {
	parent::__construct();
	//$this->load->helper(array('form', 'url'));
	$this->load->database();
	$this->load->library('session');
	$this->load->helper('form');
	$this->load->model('common_model');
	$this->load->helper('url');
	$this->load->library('form_validation');	
	$this->load->library('email');

}

 function index()
 {   
    $data['page_title'] = 'Login';
   $this->load->view('authenticate/login_view',$data); 
  
 }
  
   
 function user_login()
 {
	 $username= $this->input-> post('username');
	 $password = $this->input-> post('password');
	 $user_data = array(
			 'username'=> $username,
	 		 'password' => $password
 				);
				
	$data_fromdatabase=$this->common_model->selectWhere('user', $user_data) ;
	//echo "<pre>";print_r ($data_fromdatabase);exit();
	if(count($data_fromdatabase) >0)
	{
		$this->common_model->update_logondateTime($username);
		$this->session->set_userdata('schoolbolpur_admin',$data_fromdatabase);
				redirect('admin/dashboard','refresh');
	}else{
		redirect('authenticate','refresh');
	}
	
 }
 
 function logout()
 {
	
	if($this->session->userdata('schoolbolpur_admin') )
	{
		$this->session->unset_userdata('schoolbolpur_admin');
		$this->session->set_flashdata('logoutmsg','<span style="color:red">Successfully logged out.</span>');
		redirect('authenticate');
	}else{
		$this->session->set_flashdata('logoutmsg','<span style="color:red">"schoolbolpur_admin" session is not cleared.</span>');
		redirect('authenticate');
	}
	
 }
 
 	
	
	
}

?>