<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function indexslider()
	{
			
	{
		//echo "hey";exit;
		if($this->session->userdata('logged_in')){
			
		
		if(!empty($_FILES['afile']['tmp_name']))
				{
					$allf="";
					if(count($_FILES["afile"]['name'])>0)
					 { 
						 $GLOBALS['msg'] = ""; //initiate the global message
						  for($j=0; $j < count($_FILES["afile"]['name']); $j++)
						 { 
						   $filen = $_FILES["afile"]['name']["$j"]; //file name
						   //$filen;
						   $path = './album/'.$filen; //generate the destination path
						   if(move_uploaded_file($_FILES["afile"]['tmp_name']["$j"],$path)) 
						   {
							$datas=array("image"=>$filen);
								if($this->db->insert("frontslider",$datas))
								{
									//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
								}
								else
								{
									//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
								}
						   }
						 }
						 
					}
				}
		
		
		
		//$fname="teacher.png";
		
		//$config['upload_path'] = './album/';
//		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
//		$config['max_size']	= '1000000';
//		//$config['max_width']  = '1024';
//		//$config['max_height']  = '768';
//
//		$this->load->library('upload', $config);
//
//		if (!$this->upload->do_upload('afile'))
//		{
//			echo $this->upload->display_errors();
//		}
//		else
//		{
//			
//			$pic = $this->upload->data();
//			$fname=$pic['file_name'];
//		}
		
		
			
		redirect("admin/admin/dashboard");
		}else
		{
		
			redirect("admin/admin");
		}
	
	}
	}
	public function index()
	{
		if(!$this->session->userdata('logged_in')){
		$this->load->view('admin/admin_login');
		}
		else
		{
			$this->dashboard();
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/admin/');
		
	}
	
	public function login()
	{
		//echo "hey";exit;
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$chk=$this->db->get_where('pr_admin',array('username'=>$this->input->post('username'),
														'password'=>$this->input->post('password')
														));
			if($chk->num_rows()>0){
			$result=$chk->row();
			//print_r($result);exit;
			$newdata = array(
                   'username'  => $result->username,
                   'email'     => $result->email,
                   'logged_in' => TRUE
               );
			//print_r($newdata);exit;
			$this->session->set_userdata($newdata);
			$this->dashboard();
			}
			else
			{
				$this->load->view('admin/admin_login',$error="Invalid Username/Password");
			}
			//$this->load->view('dashboard');
		}
	}
	
	public function dashboard()
	{
		if($this->session->userdata('logged_in')){
		
		$data['banner1']=$this->db->get_where("modal",array("id"=>2))->row();
		$data['banner2']=$this->db->get_where("modal",array("id"=>3))->row();
		$data['banner3']=$this->db->get_where("modal",array("id"=>4))->row();
		$data['sidebar']=$this->db->get_where("modal",array("id"=>5))->row();
		$data['m']=$this->db->get("modal")->row();
		//$data['side1']=$this->db->get_where("modal",array("id"=>6))->row();
		$data['frontslider']=$this->db->get("frontslider")->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/dashboard');
		}else
		{
			$this->index();
		}
	}
	
	public function profile()
	{
		if($this->session->userdata('logged_in')){
		$this->load->view('admin/header');
		$this->load->view('admin/profile');
		}else
		{
			$this->index();
		}
	}
	
	public function results()
	{
		$data['cl']=$this->db->get("classes")->result();	
		if($this->session->userdata('logged_in')){
			
		$data['result']=$this->db->get("results")->result();	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/results');
		}else
		{
		
			$this->index();
		}
	}
	
	public function more_add($id)
	{
		
		if($this->session->userdata('logged_in')){
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '1000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('rfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		$ims=$this->db->get_where("results",array("id"=>$id))->row();
		$moreimages=$ims->file.",".$fname;
									
							$datas=array("file"=>$moreimages);
								$this->db->where("id",$id);
								if($this->db->update("results",$datas))
								{
									//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
								}
								else
								{
									//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
								}
		
			
		redirect("admin/admin/result_edit/".$id);
		}else
		{
		
			redirect("admin/admin");
		}
	
	
	}
	
	public function result_edit($id)
	{
		//$data['cl']=$this->db->get_where("classes",array("id"=>$id))->row();	
		if($this->session->userdata('logged_in'))
		{
		$data['result']=$this->db->get_where("results",array("id"=>$id))->row();	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/result_edit');
		//print_r($data);exit;
		}else
		{
			$this->index();
		}
	}
	public function result_upload()
	{
		if($this->session->userdata('logged_in')){
		
				if(!empty($_FILES['rfile']['tmp_name']))
				{
					$allf="";
					if(count($_FILES["rfile"]['name'])>0)
					 { 
					//check if any file uploaded
					 $GLOBALS['msg'] = ""; //initiate the global message
					  for($j=0; $j < count($_FILES["rfile"]['name']); $j++)
					 { //loop the uploaded file array
					   $filen = $_FILES["rfile"]['name']["$j"]; //file name
					   $allf.=",".$filen;
					   $path = './uploads/'.$filen; //generate the destination path
					   if(move_uploaded_file($_FILES["rfile"]['tmp_name']["$j"],$path)) 
					{
						
					   //upload the file
						//$GLOBALS['msg'] .= "File# ".($j+1)." ($filen) uploaded successfully<br>";
						//Success message
					   }
					  }
					 }
					 else {
					  $GLOBALS['msg'] = "No files found to upload"; //No file upload message 
					}
					$eximg = substr($allf, 1);
					//$up=mysql_query("update products set extra_images='".$eximg."' where id='$inid'");
				}


		$datas=array("for_class"=>$this->input->post("class"),
					"file"=>$eximg,
					"year"=>$this->input->post("year"),
					"upload_date"=>date("Y-m-d"));
			if($this->db->insert("results",$datas))
			{
				$this->session->set_flashdata('msg', 'Result File Uploaded Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Result File Could not be Uploaded.');
			}
			
		$this->results();
		}else
		{
		
			$this->index();
		}
	}
	
	
	public function ach_result_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('results'); 
	}
	public function pic_delete($id)
	{
		$this->db->where('picid', $id);
		$this->db->delete('album_images'); 
	}
	
	public function frontsliderdelete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('frontslider'); 
	}
	
	
	public function front_gallery_delete($id)
	{
		echo $id;
		$this->db->where('id', $id);
		$this->db->delete('front_gallery'); 
	}
	public function ach_result_delete1($id,$file)
	{
		//$this->db->where('id', $id);
		$filename = str_replace("%20"," ",$file);
	//	$prod_id = $id;
		
		$ims=$this->db->get_where("results",array("id"=>$id))->row();
		
		echo $prod_img = $ims->file;echo "<br/>";
		$mm=explode(',',$prod_img);
		$n = "";
		foreach($mm as $m)
		{
			if($m!=$filename)
			{
				$n.=",".$m;
			}
		}
		$remfile = substr($n,1);
	//	echo $remfile;exit;
		unlink("./uploads/".$filename);
		$datas=array("file"=>$remfile);
		$this->db->where('id', $id);
		$this->db->update('results', $datas);
				
	}
	
	public function test_result_upload()
	{
		
		if($this->session->userdata('logged_in')){
			
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['max_size']	= '1000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('rfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		$datas=array("for_class"=>$this->input->post("class"),
					"filename"=>$fname,
					"test_name"=>$this->input->post("exam"),
					
					"upload_date"=>date("Y-m-d"));
			if($this->db->insert("test_result",$datas))
			{
				$this->session->set_flashdata('msg', 'Result File Uploaded Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Result File Could not be Uploaded.');
			}
			
		$this->test_result();
		}else
		{
		
			redirect("test_result");
		}
	
	}
	public function time_table_upload()
	{
		
		if($this->session->userdata('logged_in')){
			
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['max_size']	= '1000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('rfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		$datas=array("for_class"=>$this->input->post("class"),
					"filename"=>$fname,
					"test_name"=>$this->input->post("exam"),
					
					"upload_date"=>date("Y-m-d"));
			if($this->db->insert("time_table",$datas))
			{
				$this->session->set_flashdata('msg', 'Time Table Uploaded Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Time Table Could not be Uploaded.');
			}
			
		redirect("admin/admin/time_table");
		}else
		{
		
			redirect("test_result");
		}
	
	}
	
	public function test_result()
	{
		if($this->session->userdata('logged_in')){
			
		$data['result']=$this->db->get("test_result")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/testresult');
		}else
		{
		
			$this->index();
		}
	}
	
	public function time_table()
	{
		if($this->session->userdata('logged_in')){
			
		$data['result']=$this->db->get("time_table")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/timetable');
		}else
		{
			$this->index();
		}
	}
	
	
	public function add_testimonials()
	{
		
		if($this->session->userdata('logged_in')){
			
		$config['upload_path'] = './uploads/testimonials/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '1000000
';
		
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('rfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		$datas=array("usertype"=>$this->input->post("usertype"),
					 "username"=>$this->input->post("username"),
					 "comment"=>$this->input->post("comment"),
					"image"=>$fname,
					"add_date"=>date("Y-m-d"));
			if($this->db->insert("testimony",$datas))
			{
				$this->session->set_flashdata('msg', 'Testimony added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Testimony Could not be added.');
			}
			
		redirect("admin/admin/testimonials");
		}else
		{
		
			redirect("admin/admin");
		}
	
	}
	
	
	public function testimonials()
	{
		if($this->session->userdata('logged_in')){
			
		$data['result']=$this->db->get("testimony")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/testimonials');
		}else
		{
		
			$this->index();
		}
	}
	
	public function add_notice()
	{
		
		if($this->session->userdata('logged_in')){
			
		$datas=array("title"=>$this->input->post("title"),
					 "content"=>$this->input->post("content"),
					"add_date"=>date("Y-m-d"));
			if($this->db->insert("notice",$datas))
			{
				$this->session->set_flashdata('msg', 'Notice added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Notice Could not be added.');
			}
			
		redirect("admin/admin/notice");
		}else
		{
		
			redirect("admin/admin/index");
		}
	
	}
	public function add_exam()
	{
		
		
		if($this->session->userdata('logged_in')){
			
		$datas=array("title"=>$this->input->post("title"),
					 "content"=>$this->input->post("content"),
					"edate"=>date("Y-m-d"));
			if($this->db->insert("exam",$datas))
			{
				$this->session->set_flashdata('msg', 'Exam Notice added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Exam Notice Could not be added.');
			}
			
		redirect("admin/admin/exam");
		}else
		{
		
			redirect("admin/admin/index");
		}
	
	
	}
	
	
	public function notice($id=false)
	{
		
		if($this->session->userdata('logged_in')){
			
			if($id==true)
			{
				$data['not']=$this->db->get_where("notice",array("id"=>$id))->row();
			}	
		$data['result']=$this->db->get("notice")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/notice');
		}else
		{
		
			$this->index();
		}
	}
	public function exam($id=false)
	{
		
		
		if($this->session->userdata('logged_in')){
			
			if($id==true)
			{
				$data['not']=$this->db->get_where("exam",array("id"=>$id))->row();
			}	
		$data['result']=$this->db->get("exam")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/exam');
		}else
		{
		
			$this->index();
		}
	
	}
	
	public function add_class()
	{
		
		if($this->session->userdata('logged_in')){
			
		$datas=array("class_name"=>$this->input->post("class"));
			if($this->db->insert("classes",$datas))
			{
				$this->session->set_flashdata('msg', 'Class added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Class Could not be added.');
			}
			
		redirect("admin/admin/classes");
		}else
		{
		
			redirect("admin/admin/index");
		}
	
	}
	
	public function classes()
	{
		if($this->session->userdata('logged_in')){	
		$data['result']=$this->db->get("classes")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/classes');
		}else
		{
		
			$this->index();
		}
	}
	
	
	
	public function changepass()
	{
		parse_str($_POST['formdata'],$form);

		$sql=$this->db->get_where("pr_admin",array("password"=>md5($form['old'])));
		//echo "select * from admin where id=1 and password='".md5($form['old'])."'";
		if($sql->num_rows()>0)
		{
			$change=$this->db->query("update pr_admin set password='".md5($form['new'])."' where id='1'");
			if($change)
			{
				echo "Password Changed Successfully";
			}
			else
				{
					echo "Password Could not Change.";
				}
			
			
		}
		else
		{
			echo "Incorrect Password.";
		}
	}
	
	public function notice_del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('notice'); 
	}
	public function exam_del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('exam'); 
	}
	public function alumini_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('alumini'); 
	}
	public function class_del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('classes'); 
	}
	public function news_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('newsletter'); 
	}
	public function contactq($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('contact'); 
	}
	public function testi_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('testimony'); 
	}
	public function testr_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('test_result'); 
	}
	public function timetabledelete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('time_table'); 
	}
	public function team_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('team'); 
	}
	public function album_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('album'); 
	}
	public function album_deletefull($id)
	{
		$id=str_replace("%20"," ",$id);
		//$img=str_replace("%20"," ",$id);
		$this->db->where('album_name',$id);
		$this->db->delete('album');
		//echo $this->db->last_query();
	}
	
	public function update_team($id)
	{
		$fname=$this->input->post("oldfile");
		if(!empty($_FILES['tfile']['name']))
			{
		$config['upload_path'] = './team/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['max_size']	= '1000000';

		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('tfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		}
		
		$datas=array("name"=>$this->input->post("name"),
					"image"=>$fname,
					"position"=>$this->input->post("position"),
					"education"=>$this->input->post("edu"));
		$this->db->where('id', $id);
		$this->db->update('team', $datas);
		redirect("admin/admin/team");
		
	}
	public function team($id=false)
	{
		if($id==true)
		{
			$data['eid']=$this->db->get_where("team",array("id"=>$id))->row();
		}
		$data['team']=$this->db->get('team')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/team'); 
	}
	public function add_faculty()
	{
		if($this->session->userdata('logged_in')){
		$fname="teacher.png";
		if(!empty($_FILES['tfile']['name']))
			{
		$config['upload_path'] = './team/';
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['max_size']	= '0';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('tfile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		}
		$datas=array("name"=>$this->input->post("name"),
					"image"=>$fname,
					"position"=>$this->input->post("position"),
					
					"education"=>$this->input->post("edu"));
			if($this->db->insert("team",$datas))
			{
				$this->session->set_flashdata('msg', 'Faculty added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Faculty  Could not be added.');
			}
			
		redirect("admin/admin/team");
		}else
		{
		
			redirect("admin/admin");
		}
	
	}
	
	public function add_album_images($id)
	{
		//$this->db->group_by('album_name');
		$data['pictures']=$this->db->get_where("album_images",array("alb_id"=>$id))->result();
		//$data['album']=$this->db->get('album')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/add_album_images'); 
	}
	
	public function add_album()
	{
		if($this->session->userdata('logged_in')){
			$datas=array("album_name"=>$this->input->post("name"));
				if($this->db->insert("album",$datas))
				{
					//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
				}
				else
				{
					//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
				}
			
		redirect("admin/admin/album");
		}
		else
		{
			redirect("admin/admin");
		}
	}
	
	public function add_album1()
	{
		
		if($this->session->userdata('logged_in')){
			
		
		//$fname="teacher.png";
		
		$config['upload_path'] = './album/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		//$config['max_size']	= '1000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('afile'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			
			$pic = $this->upload->data();
			$fname=$pic['file_name'];
		}
		$datas=array("album_name"=>$this->input->post("alname"),
										"image"=>$fname);
								if($this->db->insert("album",$datas))
								{
									//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
								}
								else
								{
									//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
								}
		
			
		redirect("admin/admin/album2/".$this->input->post("alname"));
		}else
		{
		
			redirect("admin/admin");
		}
	
	
	}
	
	public function albumpic_add()
	{
		
		if($this->session->userdata('logged_in')){
			
		if(!empty($_FILES['afile']['tmp_name']))
				{
					$allf="";
					if(count($_FILES["afile"]['name'])>0)
					 { 
						 $GLOBALS['msg'] = ""; //initiate the global message
						  for($j=0; $j < count($_FILES["afile"]['name']); $j++)
						 { 
						   $filen = $_FILES["afile"]['name']["$j"]; //file name
						   //$filen;
						   $path = './album/'.$filen; //generate the destination path
						   if(move_uploaded_file($_FILES["afile"]['tmp_name']["$j"],$path)) 
						   {
							$datas=array("image"=>$filen,"alb_id"=>$this->input->post("alb_id"));
								if($this->db->insert("album_images",$datas))
								{
									//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
								}
								else
								{
									//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
								}
						   }
						 }
						 
					}
				}
		
			
		redirect("admin/admin/add_album_images/".$this->input->post("alb_id"));
		}else
		{
		
			redirect("admin/admin");
		}
	
	}
	
	public function front_gallery_add()
	{
		//echo "hey";exit;
		if($this->session->userdata('logged_in')){
			
		
		if(!empty($_FILES['afile']['tmp_name']))
				{
					$allf="";
					if(count($_FILES["afile"]['name'])>0)
					 { 
						 $GLOBALS['msg'] = ""; //initiate the global message
						  for($j=0; $j < count($_FILES["afile"]['name']); $j++)
						 { 
						   $filen = $_FILES["afile"]['name']["$j"]; //file name
						   //$filen;
						   $path = './album/'.$filen; //generate the destination path
						   if(move_uploaded_file($_FILES["afile"]['tmp_name']["$j"],$path)) 
						   {
							$datas=array("image"=>$filen);
								if($this->db->insert("front_gallery",$datas))
								{
									//$this->session->set_flashdata('msg', 'Album Image added Successfully.');
								}
								else
								{
									//$this->session->set_flashdata('msg', 'Album Image  Could not be added.');
								}
						   }
						 }
						 
					}
				}
		
		
		
		//$fname="teacher.png";
		
		//$config['upload_path'] = './album/';
//		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
//		$config['max_size']	= '1000000';
//		//$config['max_width']  = '1024';
//		//$config['max_height']  = '768';
//
//		$this->load->library('upload', $config);
//
//		if (!$this->upload->do_upload('afile'))
//		{
//			echo $this->upload->display_errors();
//		}
//		else
//		{
//			
//			$pic = $this->upload->data();
//			$fname=$pic['file_name'];
//		}
		
		
			
		redirect("admin/admin/front_gallery");
		}else
		{
		
			redirect("admin/admin");
		}
	
	}
	
	public function album()
	{
		$this->db->group_by('album_name');
		$data['al']=$this->db->get("album")->result();
		//$data['album']=$this->db->get('album')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/album'); 
	}
	
	public function front_gallery()
	{
		//$this->db->group_by('album_name');
		$data['al']=$this->db->get("front_gallery")->result();
		//$data['album']=$this->db->get('album')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/frontgallery'); 
	}
	
	public function album2($alname)
	{
		$img=str_replace("%20"," ",$alname);
		//$this->db->group_by('album_name');
		$data['album']=$this->db->get_where("album",array("album_name"=>$img))->result();
	//	print_r($data);exit;
		//$data['album']=$this->db->get('album')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/album2'); 
	}
	
	public function changemodal()
	{
		if(isset($_POST['show']))
		{
			$show="yes";
		}
		else
		{
			$show="no";
		}
		$fname=$_POST['oldfile'];
		if(!empty($_FILES['file']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '100000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('file'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname=$pic['file_name'];
			}
				}
			$data = array('image' => $fname,'status'=>$show);

		$this->db->where('id', 1);
		$this->db->update('modal', $data);
		
		redirect("admin/admin/dashboard");
		
	}
	
	public function sidebarimage()
	{
		
		$fname=$_POST['oldfile'];
		if(!empty($_FILES['file']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '0';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('file'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname=$pic['file_name'];
			}
				}
			$data = array('image' => $fname);

		$this->db->where('id', 5);
		if($this->db->update('modal', $data))
		{
			?><script>alert("Image/status Updated Successfully.");</script><?php 
		}
		else
		{
			?><script>alert("Image/status Could not be updated.");</script><?php 
		}
		redirect("admin/admin/dashboard");
		
	}
	
	public function bannerchange()
	{
		
		$fname1=$_POST['oldfile1'];
		$fname2=$_POST['oldfile2'];
		$fname3=$_POST['oldfile3'];
		if(!empty($_FILES['slide1']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '0';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('slide1'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname1=$pic['file_name'];
			}
				}
				
				if(!empty($_FILES['slide2']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '0';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('slide2'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname2=$pic['file_name'];
			}
				}
				
				if(!empty($_FILES['slide3']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '0';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('slide3'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname3=$pic['file_name'];
			}
				}
			$data1 = array('image' => $fname1);
			$data2 = array('image' => $fname2);
			$data3 = array('image' => $fname3);
		$this->db->where('id', 2);
		if($this->db->update('modal', $data1))
		{
			//$session->set->
		}
		else
		{
			
		}
		$this->db->where('id', 3);
		if($this->db->update('modal', $data2))
		{
			
		}
		else
		{
			
		}
		$this->db->where('id', 4);
		if($this->db->update('modal', $data3))
		{
			
		}
		else
		{
			
		}
		redirect("admin/admin/dashboard");
		
	}
	public function middleimages()
	{
		
		$fname1=$_POST['oldfile1'];
		$fname2=$_POST['oldfile2'];
		
		if(!empty($_FILES['slide1']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '0';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('slide1'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname1=$pic['file_name'];
			}
				}
				
				if(!empty($_FILES['slide2']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '1000000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('slide2'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname2=$pic['file_name'];
			}
				}
				
				
			$data1 = array('image' => $fname1);
			$data2 = array('image' => $fname2);
			
		$this->db->where('id', 6);
		if($this->db->update('modal', $data1))
		{
			//$session->set->
		}
		else
		{
			
		}
		$this->db->where('id', 7);
		if($this->db->update('modal', $data2))
		{
			
		}
		else
		{
			
		}
		
		redirect("admin/admin/dashboard");
		
	}
	
	public function alumini($id=false)
	{
		if($id==true)
		{
			$data['one']=$this->db->get_where("alumini",array("id"=>$id))->row();
		}
		if($this->session->userdata('logged_in')){
			
		$data['alum']=$this->db->get("alumini")->result();;	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/alumini');
		}else
		{
		
			$this->index();
		}
	
	}
	
	public function alumini_approve($id,$st)
	{
	//	echo $id."/".$st;
		$data=array("status"=>$st);
		$this->db->where('id', $id);
		if($this->db->update('alumini', $data))
		{
			
		}
	}
	public function newsletter()
	
	{
		$data['news']=$this->db->get('newsletter')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/newsletter'); 
	}
	
	public function contact()
	
	{
		$data['contact']=$this->db->get('contact')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/contact'); 
	}
	public function video()
	
	{
		$data['video']=$this->db->get('video')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/video'); 
	}
	public function alumini_edit($id)
	{
		$fname=$this->input->post("oldfile");
		$ch = curl_init();
			
			//if($this->input->post("message")!=""){}
		if(isset($_FILES['file']))
		{
			$config['upload_path'] = './alumini/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '1000000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('file'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname=$pic['file_name'];
			}
		}
		$alum=array("name"=>$this->input->post("name"),
					"gender"=>$this->input->post("gender"),
					"dob"=>$this->input->post("dob"),
					"email"=>$this->input->post("email"),
					"mobile"=>$this->input->post("mobile"),
					"image"=>$fname,
					"com_year"=>$this->input->post("year"),
					"course"=>$this->input->post("course_taken"),
					"cur_address"=>$this->input->post("cur_address"),
					"res_address"=>$this->input->post("res_address"),
					"ins_afterten"=>$this->input->post("after_ten"),
					"school"=>$this->input->post("school"),
					"board"=>$this->input->post("board"),
					"percent"=>$this->input->post("percent"),
					"father"=>$this->input->post("father"),
					"father_oc"=>$this->input->post("foc"),
					"mother"=>$this->input->post("mother"),
					"mother_oc"=>$this->input->post("moc"),
					"message"=>$this->input->post("message"),
					"remark"=>$this->input->post("about"));
		
		$this->db->where('id',$id);
		if($this->db->update('alumini', $alum))
		{
			$this->session->set_flashdata('msg', 'Student Details updated successfully.');
		}
		else
		{
			$this->session->set_flashdata('msg', 'Details couldnot be completed.');
		}
		redirect("admin/admin/alumini");	
	}
	
		public function add_video()
	{
		$url="";
		$fname="";
		if(isset($_POST['url']))
		{
			$url=$_POST['url'];
		}
		else
		{
			
		
		//$fname=$_POST['oldfile'];
		if(!empty($_FILES['file']['tmp_name']))
				{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '1000000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('file'))
			{
				echo $this->upload->display_errors();
			}
			else
			{
				
				$pic = $this->upload->data();
				$fname=$pic['file_name'];
			}
				}
				}
			$data = array('vfile' => $fname,'url'=>$url,'upload_date'=>date("Y-m-d"),'title'=>$this->input->post("title"));

		//$this->db->where('id', 1);
		if($this->db->insert('video', $data))
		{
			$this->session->set_flashdata('msg', 'Video Added Successfully.');
			
		}
		else
		{
			$this->session->set_flashdata('msg', 'Video Couldnot be Added.');
			
		}
		redirect("admin/admin/video");
		
	}
	public function update_notice($id)
	{
		
		$datas=array("title"=>$this->input->post("title"),
					"content"=>$this->input->post("content"));
		$this->db->where('id', $id);
		$this->db->update('notice', $datas);
		redirect("admin/admin/notice");
		
	}
	public function update_exam($id)
	{
		
		$datas=array("title"=>$this->input->post("title"),
					"content"=>$this->input->post("content"));
		$this->db->where('id', $id);
		$this->db->update('exam', $datas);
		redirect("admin/admin/exam");
		
	}
	
	public function alumini_msg()
	{
		                          //   http://premium.ssas.co.in/composeapi/?userid=ParthaInst&pwd=Pi$@325&route=2&senderid=customid&destination=".$mobile."&message=".$msg."


		$mobile=$this->input->post("mobile");
			$msg=$this->input->post("message");
			$ch = curl_init();
			
			//curl_setopt($ch, CURLOPT_URL, "http://smszone.ssas.co.in/submitsms.jsp?user=PARTHA&key=ce9fe6f087XX&mobile=".$mobile."&message=".$msg."&senderid=PARTHA&accusage=1");


		curl_setopt($ch, CURLOPT_URL, "http://premium.ssas.co.in/composeapi/?userid=ParthaInst&pwd=Pi$@325&route=2&senderid=PARTHA&destination=".$mobile."&message=".$msg."");

		curl_setopt($ch, CURLOPT_HEADER, 0);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
			
			curl_exec($ch);
			redirect("admin/admin/alumini");
		
	}
	public function contact_msg()
	{
		
			$mo="";
			foreach($this->input->post("mobile") as $m)
			{
				$mo.=$m.",";
			}
			$bb=substr($mo,0,-1);
			echo $bb;//exit;
			//$mobile="";
//			if($this->input->post("message")!="all")
//			{
//				$mobile=$this->input->post("mobile");
//			}
//			else if($this->input->post("message")=="all")
//			{
//				$cons=$this->db->get("contact")->result();
//				foreach($cons as $cons){
//				$mobile.=$cons->phone;
//				}
//				substr($mobile,1);
//			}
			
			$msg=$this->input->post("message");
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "http://premium.ssas.co.in/composeapi/?userid=ParthaInst&pwd=Pi$@325&route=2&senderid=PARTHA&destination=".$mobile."&message=".$msg."");
				
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
			
			curl_exec($ch);

			redirect("admin/admin/contact");
		
	}
	public function contact_msg_alu()
	{
		
			$mo="";
			foreach($this->input->post("mobile") as $m)
			{
				$mo.=$m.",";
			}
			$bb=substr($mo,0,-1);
			echo $bb;//exit;
			//$mobile="";
//			if($this->input->post("message")!="all")
//			{
//				$mobile=$this->input->post("mobile");
//			}
//			else if($this->input->post("message")=="all")
//			{
//				$cons=$this->db->get("contact")->result();
//				foreach($cons as $cons){
//				$mobile.=$cons->phone;
//				}
//				substr($mobile,1);
//			}
			
			$msg=$this->input->post("message");
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "http://premium.ssas.co.in/composeapi/?userid=ParthaInst&pwd=Pi$@325&route=2&senderid=PARTHA&destination=".$mobile."&message=".$msg."");
				
			curl_setopt($ch, CURLOPT_HEADER, 0);
 

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
			
			curl_exec($ch);

			redirect("admin/admin/alumini");
		
	}
	
	public function send_newsemail()
	{
				


 		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.parthaedu.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '10';
        $config['smtp_user']    = 'info@parthaedu.com';
        $config['smtp_pass']    = 'partha@11';
      $config['charset']    = 'utf-8';
       $config['newline']    = "\r\n";
       $config['mailtype'] = 'html'; // or html
      //  $config['validation'] = TRUE; // bool whether to validate email or not  

		$this->email->initialize($config); 				
		$this->email->from("info@parthaedu.com", 'Newsletter.');
				
			//$mo="";
			foreach($this->input->post("email") as $m)
			{
				//$mo.=$m.",";
				$this->email->to($m); 
			}
			//$bb=substr($mo,0,-1);
				//$this->email->to($this->input->post("email")); 
				//$this->email->cc('another@another-example.com'); 
				//$this->email->bcc('them@their-example.com'); 
				
				$this->email->subject($this->input->post("subject"));
				
				$message='<img style="width:50%; height=50%;" src="'.base_url().'"partheducation/images/logo-head.png"><br/>';
				$message .=$this->input->post("message");
				///$message .= base_url()."index.php/front/user_email_verify/".$status;
				$this->email->message($message);	
				
				if($this->email->send())
				{
					
				}
				else
				{
					
				}
				redirect("admin/admin/contact");
	}
	public function send_contact()
	{
				$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.parthaedu.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '10';
        $config['smtp_user']    = 'info@parthaedu.com';
        $config['smtp_pass']    = 'partha@11';
      $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
       $config['mailtype'] = 'html'; // or html
      // $config['validation'] = TRUE; // bool whether to validate email or not  

		$this->email->initialize($config); 			
		
				$this->email->from("info@parthaedu.com", 'Contact Enquiry Reply.');
				$this->email->to($this->input->post("email")); 
				//$this->email->cc('another@another-example.com'); 
				//$this->email->bcc('them@their-example.com'); 
				
				$this->email->subject($this->input->post("subject"));
				
				
				$message =$this->input->post("message");
				///$message .= base_url()."index.php/front/user_email_verify/".$status;
				$this->email->message($message);	
				
				if($this->email->send())
				{
					
				}
				else
				{
					
				}
				redirect("admin/admin/contact");
	}
	
	
}