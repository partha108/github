<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	
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
				if($this->user_role!=1)
				{
					$this->load->library('permission_lib');
					 $permit=$this->permission_lib->permit($this->user_id,$this->user_role);
				}
			}
			else
			{
				redirect('authenticate', 'refresh');
			}
	}
	
	public function index()
	{
		$date = time();				 
		$data['best_sellers']=0;
		$data['mostactivemember_list']=0;
		$data['last_7days_stat']=0;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/dashboard_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	function dashboard(){
		$date = time();				 
		$data['best_sellers']=0;
		$data['mostactivemember_list']=0;
		$data['last_7days_stat']=0;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/dashboard_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	function deleteitem(){
		$id=$_GET['id'];
		$table=$_GET['table'];	
		$column=$_GET['column'];	
		$page=$_GET['page'];
		
		$this->common_model->delete_data($table,$column,$id);
		redirect($page,'refresh');
	}
	
	//------------------------------------------------Role------------------------------------------------------------------------
	public function role_list()
	{
		$data['roles']=$this->common_model->selectAll('role');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/rolelist_view',$data);
		$this->load->view('admin/template/admin_footer');
	}
	
	
	//----------------------------------------End Role-------------------------------------------------------------------------
	
	
	function aboutus(){
		$data['aboutus']=$this->common_model->selectAll('about_us');
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/about_us_view',$data);
		$this->load->view('admin/template/admin_footer');	
	}
	function edit_aboutus()
	{
		$id=$this->input->post('id');
		$data['aboutus']=$this->fees_model->select_all('about_us','id',$id,'','','','');
		$edit_aboutus=array();
		if(count($data['aboutus'])>0){
			foreach($data['aboutus'] as $item){
				$edit_aboutus=array(
					'content'=>$item->content,
					'route_direction'=>$item->route_direction,
					'name'=>$item->name,
					'logo'=>$item->logo,
					'phone'=>$item->phone,
					'email'=>$item->email
					
				);
			}
		}
		echo json_encode(array("edit_aboutus"=>$edit_aboutus));
	}
	
	function edit_aboutus_post(){
		$id=$this->input->post('id');
		$edit_content=trim($this->input->post('edit_content'));
		$edit_route=trim($this->input->post('edit_route'));
		$name=trim($this->input->post('school_name')); 
		$phone=trim($this->input->post('phone')); 
		$email=trim($this->input->post('email')); 
		
		$image="";
		$original_image="";
		/*---------------------------start file upload code------------------------------*/
						
						//==========Start:resize Item image======================//
						$new_name = str_replace(".","",microtime());						
						$config['upload_path'] ='./uploads/school_logo/temp/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';				
						$config['file_name']=$new_name;		
						$this->load->library('upload', $config);		
						//==========end:resize body_part image======================			
						$field_name = "school_logo";	
						
						$file=$this->fees_model->select_all('about_us','id',$id,'','','','');
					
						if(count($file)>0 ){
							foreach($file as $f_item){
							$image=$f_item->logo;
							$original_image=$f_item->logo;
							}
						}
				
						if($this->upload->do_upload($field_name))
						{	
								
							$file_info = $this->upload->data();
							$original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
							$file_size=$file_info['file_size'];
							$this->image_lib->clear();  			
							$image =$file_info['raw_name'].$file_info['file_ext'];
											
								if($original_image!="")		
								{	
									if(file_exists('./uploads/school_logo/big_images/'.$original_image)){
										unlink('./uploads/school_logo/big_images/'.$original_image);}
									
									if(file_exists('./uploads/school_logo/small_images/'.$original_image)){
										unlink('./uploads/school_logo/small_images/'.$original_image);
									}
									if(file_exists('./uploads/school_logo/temp/'.$original_image)){
									unlink('./uploads/school_logo/temp/'.$original_image);
									
									}
								}
								
								
						//-------------------------IMAGE RESIZE---------------------------
						$img_config_3['image_library'] = 'gd2';
						$img_config_3['source_image'] = './uploads/school_logo/temp/'.$file_info['file_name'];
						$img_config_3['maintain_ratio'] = FALSE;
						$img_config_3['width'] = 200;
						$img_config_3['height'] = 200;    
						$img_config_3['new_image'] ='./uploads/school_logo/small_images/'.$image; 
						$this->image_lib->initialize($img_config_3);
						$this->image_lib->resize();	
						$this->image_lib->clear();
						
						//-------------------------IMAGE RESIZE---------------------------
						$img_config_4['image_library'] = 'gd2';
						$img_config_4['source_image'] = './uploads/school_logo/temp/'.$file_info['file_name'];
						$img_config_4['maintain_ratio'] = FALSE;
						$img_config_4['width'] = 550;
						$img_config_4['height'] = 300;    
						$img_config_4['new_image'] ='./uploads/school_logo/big_images/'.$image; 
						$this->image_lib->initialize($img_config_4);
						$this->image_lib->resize();	
						$this->image_lib->clear();
				
						
					}
		
		$data=array(
			'content'=>$edit_content ,
			'route_direction'=>$edit_route,
			'name'=>$name,
			'logo'=>$image,
			'phone'=> $phone,
			'email'=>$email
			);
			
		$this->fees_model->update_data($id,$data,'about_us','id');
		//echo $this->db->last_query();	exit;
		redirect('admin/aboutus','refresh');
	}
	
	
	
	
	
	
	
	
	
	
	public function news()
{
	//$this->common_model->delete_expire_news();
	$data['news']=$this->common_model->news_model();
	$this->load->view('admin/template/admin_header');
	$this->load->view('admin/template/admin_leftmenu');
	$this->load->view('admin/news_view',$data);
	$this->load->view('admin/template/admin_footer');
}
	
 public function add_news()
 {
	$today = date("Y-m-d H:i:s");	
	$title=trim($this->input->post('add_title'));
	$des=trim($this->input->post('add_description'));
	if($this->input->post('add_status')!="")
	{
		$status=trim($this->input->post('add_status'));
	}else
	{
		$status="active";
	}
 
 if($this->input->post('add_end_date')!=""){
		$enddate=date("Y-m-d",strtotime($this->input->post('add_end_date')));
	}else{
		$enddate=NULL;
	}
 
 //---------------------------start file upload code------------------------------
		
		//==========Start:resize Item image======================//
		$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='./uploads/news/temp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';				
		$config['file_name']=$new_name;		
		$this->load->library('upload', $config);		
		//==========end:resize body_part image======================			
		$field_name = "add_image";	

		$image=NULL;
		if($this->upload->do_upload($field_name))
		{			
			$file_info = $this->upload->data();
			$original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
			$file_size=$file_info['file_size'];
			$this->image_lib->clear();  			
			$image =$file_info['raw_name'].$file_info['file_ext'];

			//-------------------------IMAGE RESIZE---------------------------
						$img_config_3['image_library'] = 'gd2';
						$img_config_3['source_image'] = './uploads/news/temp/'.$file_info['file_name'];
						$img_config_3['maintain_ratio'] = FALSE;
						$img_config_3['width'] = 200;
						$img_config_3['height'] = 200;    
						$img_config_3['new_image'] ='./uploads/news/small_images/'.$image; 
						$this->image_lib->initialize($img_config_3);
						$this->image_lib->resize();	
						$this->image_lib->clear();
		//-------------------------IMAGE RESIZE---------------------------
						$img_config_4['image_library'] = 'gd2';
						$img_config_4['source_image'] = './uploads/news/temp/'.$file_info['file_name'];
						$img_config_4['maintain_ratio'] = FALSE;
						$img_config_4['width'] = 550;
						$img_config_4['height'] = 300;    
						$img_config_4['new_image'] ='./uploads/news/big_images/'.$image; 
						$this->image_lib->initialize($img_config_4);
						$this->image_lib->resize();	
						$this->image_lib->clear();
		}
		
		// ---------------------------end file upload code--------------------------------	
 
        
		$data=array(
		'title'=>$title,
		'description'=>$des,
		'status'=>$status,
		'exp_date_time'=>$enddate,
		'event_date'=>$today,
		'image'=>$image
		);
		
		$this->common_model->insert_data($data,'news');
	$data_id=$this->common_model->news_model();
	
	//echo "<pre>";print_r($data_id);exit;
	redirect('admin/news','refresh');
}

function edit_news()
	{
		$id = trim($this->input->post('id'));				
		$edit_news = $this->common_model->get_news($id);
		//echo "<pre>";print_r($edit_news);exit;		
		echo json_encode(array("edit_news" => $edit_news)) ;	
	}
	
	function edit_news_post()
	{
		$today = date("Y-m-d H:i:s");
		$id=trim($this->input->post('id'));
		$title=trim($this->input->post('title'));
		$description=trim($this->input->post('description'));
		if($this->input->post('status')!="")
		{
			$status=trim($this->input->post('status'));
		}else
		{
			$status="active";
		}
		
		
	if($this->input->post('end_date')!=""){
		$enddate=date("Y-m-d",strtotime($this->input->post('end_date')));
	}else{
		$enddate=NULL;
	}	
				
		//$image=trim($this->input->post('image'));		
		
		
		/*---------------------------start file upload code------------------------------*/
						
						//==========Start:resize Item image======================//
						$new_name = str_replace(".","",microtime());						
						$config['upload_path'] ='./uploads/news/temp/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';				
						$config['file_name']=$new_name;		
						$this->load->library('upload', $config);		
						//==========end:resize body_part image======================			
						$field_name = "edit_image";	
						
						$file=$this->common_model->get_news($id);	
						
						$image=$file[0]['image'];
						$original_image=$file[0]['image'];
				
						if($this->upload->do_upload($field_name))
						{	
								
							$file_info = $this->upload->data();
							$original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
							$file_size=$file_info['file_size'];
							$this->image_lib->clear();  			
							$image =$file_info['raw_name'].$file_info['file_ext'];				
								if($original_image!="")		
								{	
									if(file_exists('./uploads/news/big_images/'.$original_image)){
										unlink('./uploads/news/big_images/'.$original_image);}
									
									if(file_exists('./uploads/news/small_images/'.$original_image)){
										unlink('./uploads/news/small_images/'.$original_image);
									}
									if(file_exists('./uploads/news/temp/'.$original_image)){
									unlink('./uploads/news/temp/'.$original_image);
									
									}
								}
								
								
						//-------------------------IMAGE RESIZE---------------------------
						$img_config_3['image_library'] = 'gd2';
						$img_config_3['source_image'] = './uploads/news/temp/'.$file_info['file_name'];
						$img_config_3['maintain_ratio'] = FALSE;
						$img_config_3['width'] = 200;
						$img_config_3['height'] = 200;    
						$img_config_3['new_image'] ='./uploads/news/small_images/'.$image; 
						$this->image_lib->initialize($img_config_3);
						$this->image_lib->resize();	
						$this->image_lib->clear();
						
						//-------------------------IMAGE RESIZE---------------------------
						$img_config_4['image_library'] = 'gd2';
						$img_config_4['source_image'] = './uploads/news/temp/'.$file_info['file_name'];
						$img_config_4['maintain_ratio'] = FALSE;
						$img_config_4['width'] = 550;
						$img_config_4['height'] = 300;    
						$img_config_4['new_image'] ='./uploads/news/big_images/'.$image; 
						$this->image_lib->initialize($img_config_4);
						$this->image_lib->resize();	
						$this->image_lib->clear();
				
						
					}
						/*---------------------------end file upload code--------------------------------*/	
		
		
		$data=array(
			'title'=>$title,
			'description'=>$description,
			'status'=>$status,
			'exp_date_time'=>$enddate,
			'event_date'=>$today,
			'image'=>$image
			);
			
			//print_r($data);exit;
		$this->common_model->edit_newspost_model($id,$data);
		redirect('admin/news','refresh');
	}
	
	function block_unblock_news(){
		$id=$_GET['id'];
		$status=$_GET['status'];
		$this->common_model->blockUnblock_news($id,$status);
		redirect('admin/news','refresh');
	}
	
	function delete_news()
	{
		$id=$_GET['id'];		
		$this->common_model->delete_news_model($id);
		redirect('admin/news','refresh');
	}
	
	
	
function department(){
	$data['department']=$this->common_model->selectAll('department');
	 //echo "<pre>";print_r($data);exit; 
	$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/department_view',$data);
		$this->load->view('admin/template/admin_footer');	
}	
	
	function add_department()
{
	$department=trim($this->input->post('department'))	;
	$data=array('department'=>$department);
	$this->common_model->insert_data($data,'department');
	redirect('admin/department','refresh');
}
	
	function edit_department()
{
	$id=trim($this->input->post('id'));
	$edit_department=$this->common_model->selectOne('department','id',$id);	
	echo json_encode(array("edit_department" => $edit_department)) ;
	
}

function edit_department_post()
{
	$id=trim($this->input->post('id'));
	$department=trim($this->input->post('edit_department'))	;
	$data=array('department'=>$department);
	$this->common_model->update_data($data,'department','id',$id);
	redirect('admin/department','refresh');
}
function delete_department()
{
	$id=trim($_GET['id']);
	$this->common_model->delete_data('department','id',$id);	
	redirect('admin/department','refresh');
}
	
	
	
	public function classes()
	{
		$data['Classes']= $this->common_model->getAllClasses();
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/classes_view',$data );
		$this->load->view('admin/template/admin_footer');
	}
	
	function add_class_post(){
		$table='tblclass';
		
		if(isset($_POST['id']))
		{	
			$id=trim($this->input->post('id')); 
			$name=trim($this->input->post('edit_name'));
			$status=trim($this->input->post('status'));
			
			$data=array('name'=>$name,'status'=>$status);			
			//$columnID='id';
			$this->common_model->update_data($data,$table,'id',$id);
		}else{
			$name=trim($this->input->post('name'));
			$status='active';
			$class_id=$this->common_model->max_id('tblclass','id');
			$data=array(
				'name'=>$name,
				'status'=>$status,
				'id'=>$class_id+1
			);		
			$this->common_model->insert_data($data,'tblclass');
			
		}
		redirect('admin/classes','refresh');
		
	}
	
	
	function edit_Class(){
		$id=trim($this->input->post('id')); 
	$edit_class=$this->common_model->selectOne('tblclass','id',$id);    
	echo json_encode(array("edit_class"=>$edit_class));
	}
	
	function class_fees(){
	$class_id=$this->input->post('class_id');
	$fees=$this->fees_model->select_all('fees','class_id',$class_id,'','','','');
	echo json_encode(array("fees"=>$fees));		
	}
	
function block_unblock()
	{
		
		$columnvalue=trim($_GET['columnvalue']);
		$setColumn=trim($_GET['setColumn']);
		$id=trim($_GET['id']);
		$column=trim($_GET['column']);
		$table=trim($_GET['table']);
		$page=trim($_GET['page']);
		
		$data=array($setColumn =>$columnvalue );
		//echo "<pre>";print_r($data); exit;
		$this->common_model->blockUnblock($data,$id,$column,$table);
		redirect($page,'refresh');	
	}



public function section()
	{
		$data['Classes']= $this->common_model->selectAll('tblclass');
		$data['section']=$this->common_model->selectAll('tblsection');
			//echo "<pre>";print_r($data); exit;
		$this->load->view('admin/template/admin_header');
		$this->load->view('admin/template/admin_leftmenu');
		$this->load->view('admin/section_view',$data );
		$this->load->view('admin/template/admin_footer');
	}


function add_section_post(){
		$table='tblsection';
		
		if(isset($_POST['id']))
		{	
			$id=trim($this->input->post('id')); 
			$name=trim($this->input->post('edit_name'));
			$status=trim($this->input->post('status'));
			
			$data=array('name'=>$name,'status'=>$status);			
			$columnID='id';
			//$this->common_model->update_data($id,$data,$table,$columnID);
			$this->common_model->update_data($data,$table,'id',$id);
		}else{
			$name=trim($this->input->post('name'));
			$status='active';
			$data=array('name'=>$name,'status'=>$status);
			
			//$this->common_model->insert_data($data,$table);
			$this->common_model->insert_data($data,'tblsection');
		}
		redirect('admin/section','refresh');
		
	}
	
	function edit_section(){
		$id=trim($this->input->post('id')); 
	//$edit_class=$this->common_model->selectOne($id,'tblsection'); 
	$edit_class=$this->common_model->selectOne('tblsection','id',$id);       
	echo json_encode(array("edit_class"=>$edit_class));
	}




}
?>