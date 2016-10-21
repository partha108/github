<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			
	}

	
	public function index()
	{
		$data['popup']=$this->db->get_where("modal",array("id"=>1))->row();
		$data['banner1']=$this->db->get_where("modal",array("id"=>2))->row();
		$data['banner2']=$this->db->get_where("modal",array("id"=>3))->row();
		$data['banner3']=$this->db->get_where("modal",array("id"=>4))->row();
		$data['sidebar']=$this->db->get_where("modal",array("id"=>5))->row();
		$data['slider']=$this->db->get("frontslider")->result();
		//$data['side1']=$this->db->get_where("modal",array("id"=>6))->row();
		//$data['side2']=$this->db->get_where("modal",array("id"=>7))->row();
		//$thi->db->limit(8);
		$this->db->order_by("id", "desc");
		$data['front']=$this->db->get("front_gallery")->result();
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$data['test']=$this->db->get("testimony")->result();
		$this->db->limit(4);
		$data['notice']=$this->db->get("notice")->result_array();
		$this->db->limit(8);
		$data['album']=$this->db->get("album")->result();
		//print_r($data);exit;
		$this->load->view('header',$data);
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function aboutus()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function directrorsdesk()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('directrorsdesk');
		$this->load->view('footer');
	}
	public function vision()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('vision');
		$this->load->view('footer');
	}
	public function boardjee()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('boardjee');
		$this->load->view('footer');
	}
	
	public function courses()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('courses');
		$this->load->view('footer');
	}
	public function board_jee_courses()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('board_jee_courses');
		$this->load->view('footer');
	}
	
	public function pjace_course()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('pjace_course');
		$this->load->view('footer');
	}
	
	public function foundation()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('foundation');
		$this->load->view('footer');
	} 
	
	public function prefoundation()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('pre_foundation');
		$this->load->view('footer');
	}
	
	public function gallery()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		
		$this->db->group_by('album_name');
		$data['al']=$this->db->get("album")->result();
		$data['album']=$this->db->get('album')->result();
		$this->load->view('header',$data);
		$this->load->view('gallery');
		$this->load->view('footer'); 
	}
	
	
	public function test_results($d=false)
	{
		
		$this->db->group_by('upload_date');
		$this->db->select("upload_date");
		$data['dates']=$this->db->get("test_result")->result();
		
		
		if($d==true)
		{
			$this->db->group_by('for_class');
			$data['tr']=$this->db->get_where("test_result",array("upload_date"=>$d))->result();
		}
		else
		{
		$this->db->group_by('for_class');
		$this->db->order_by("upload_date", "desc"); 
		//$this->db->order_by("for_class", "asc"); 
		$data['tr']=$this->db->get("test_result")->result();
		}
		$this->load->view('header',$data);
		$this->load->view('test-results');
		$this->load->view('footer');
	}
	
	public function time_table($d=false)
	{
		
		$this->db->group_by('upload_date');
		$this->db->select("upload_date");
		$data['dates']=$this->db->get("test_result")->result();
		
		
		if($d==true)
		{
			$this->db->group_by('for_class');
			$data['tr']=$this->db->get_where("test_result",array("upload_date"=>$d))->result();
		}
		else
		{
		$this->db->group_by('for_class');
		$this->db->order_by("upload_date", "desc"); 
		//$this->db->order_by("for_class", "asc"); 
		$data['tr']=$this->db->get("time_table")->result();
		}
		$this->load->view('header',$data);
		$this->load->view('time-table');
		$this->load->view('footer');
	}
	
	
	public function test_result_search()
	{
		
		$this->db->group_by('upload_date');
		$this->db->select("upload_date");
		$data['dates']=$this->db->get("test_result")->result();
		$this->db->group_by('for_class');
		$this->db->order_by("upload_date", "desc"); 
		//$this->db->order_by("for_class", "asc"); 
		$data['tr']=$this->db->get_where("test_result",array("upload_date"=>$this->input->post('searchby')))->result();
		
		$this->load->view('header',$data);
		$this->load->view('test-results');
		$this->load->view('footer');
	}
	
	public function achivements($year=false)
	{
		$this->db->limit(10);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		
		$this->db->order_by('year','desc');
		$this->db->group_by('year');
		$this->db->select("year");
		$data['yr']=$this->db->get("results")->result();
		if($year==true)
		{
			$data['ac']=$this->db->get_where("results",array("year"=>$year))->result();
		}
		else
		{
			$data['ac']=$this->db->get_where("results",array("year"=>date("Y")-1))->result();
		}
			$this->load->view('header',$data);
			$this->load->view('achivements');
			$this->load->view('footer');
		
	}
	
	public function contact()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function alumini()
	{
		
		$this->db->limit(5);
		//$this->db->order_by("com_year");
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->db->order_by("com_year","desc");
		$data['al']=$this->db->get_where("alumini",array("status"=>"approve"))->result();
		$this->load->view('header',$data);
		$this->load->view('alumini');
		$this->load->view('footer');
	}
	
	public function alumini_register()
	{
		$fname="userpic.jpg";
		$ch = curl_init();
			
			if($this->input->post("message")!=""){
			curl_setopt($ch, CURLOPT_URL, "http://smszone.ssas.co.in/submitsms.jsp?user=PARTHA&key=ce9fe6f087XX&mobile=8653416210&message=".$this->input->post("message")."&senderid=PARTHA&accusage=1");
				
			curl_setopt($ch, CURLOPT_HEADER, 0);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
			
			curl_exec($ch);
	}
		if(isset($_FILES['file']))
		{
			$config['upload_path'] = './alumini/';
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
		
		if($this->db->insert("alumini",$alum))
		{
			$this->session->set_flashdata('msg', 'Thank you for Registering.');
		}
		else
		{
			$this->session->set_flashdata('msg', 'Registration couldnot completed.');
		}
		redirect("welcome/alumini");	
	}
	
	
	
	
	public function contact_query()
	{
		$data=array("name"=>$this->input->post("name"),
					"email"=>$this->input->post("email"),
					"phone"=>$this->input->post("phone"),
					"msg"=>$this->input->post("message"),
					"cdate"=>date("Y-m-d"));
					if($this->db->insert("contact",$data))
					{
						$this->session->set_flashdata('msg', 'Thank You for Contacting us.');
					}
					else
					{
						$this->session->set_flashdata('msg', 'Sorry we are unable to receive your message.');
					}
					redirect("Welcome/contact");
	}
	
	public function testimonials()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$data['test']=$this->db->get("testimony")->result();
		$this->load->view('header',$data);
		$this->load->view('testimonials');
		$this->load->view('footer');
	}
	public function parthazeals()
	{
		//$data['test']=$this->db->get("testimony")->result();
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('parthazeals');
		$this->load->view('footer');
	}
	
		public function team()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$data['team']=$this->db->get("team")->result();
		$this->load->view('header',$data);
		$this->load->view('team');
		$this->load->view('footer');
	}
	
		public function whypartha()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$this->load->view('header',$data);
		$this->load->view('whypartha');
		$this->load->view('footer');
	}
	
	
	public function subscribe()
	{
				
				$chk=$this->db->get_where("newsletter",array("email"=>$this->input->post("email")));
				if($chk->num_rows()>0)
				{
					?><script>alert("Your Are Already Subscribed.");</script><?php
					$this->index();
				}
				
				else
				{
					if($this->db->insert("newsletter",array("email"=>$this->input->post("email"))))
					{
						
					
	 $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.parthaedu.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '10';
        $config['smtp_user']    = 'info@parthaedu.com';
        $config['smtp_pass']    = 'partha@11';
      //  $config['charset']    = 'utf-8';
       // $config['newline']    = "\r\n";
       // $config['mailtype'] = 'text'; // or html
      //  $config['validation'] = TRUE; // bool whether to validate email or not  

$this->email->initialize($config); 	
				$this->email->from("info@parthaedu.com", 'NewsLetter Subscription');
				$this->email->to("info@parthaedu.com"); 
				//$this->email->cc('another@another-example.com'); 
				//$this->email->bcc('them@their-example.com'); 
				
				$this->email->subject('NewsLetter Subscription');
				
				
				$message ="The E-Mail id ".$this->input->post("email")." Subscribed for Your Newsletter.";
				///$message .= base_url()."index.php/front/user_email_verify/".$status;
				$this->email->message($message);	
				
				if($this->email->send()==true)
				{
					?><script>alert("Thank You for Newsletter Subscription.");</script><?php
				}
				else
				{
					?><script>alert("Could not subscribe. Please Try Later.");</script><?php
				}
				//exit;
				}$this->index();
				}
				
	}
	
	public function notice()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$data['notice']=$this->db->get("notice")->result_array();
		$this->load->view('header',$data);
		$this->load->view('notices');
		$this->load->view('footer');
	}
	
	public function exam()
	{
		$this->db->limit(5);
		$this->db->group_by('upload_date');
		$data['tr']=$this->db->get_where("test_result")->result();
		$data['exam']=$this->db->get("exam")->result_array();
		$this->load->view('header',$data);
		$this->load->view('exam');
		$this->load->view('footer');
	}
	
	public function video()
	{
		$data['video']=$this->db->get('video')->result();
		$this->load->view('header',$data);
		$this->load->view('video'); 
		$this->load->view('footer'); 
	}
	
}
