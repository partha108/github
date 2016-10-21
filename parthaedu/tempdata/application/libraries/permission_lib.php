<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class permission_lib{
		
		function permit($userid,$roleid)
		{
			$CI=& get_instance();
			 $path_link=$CI->uri->uri_string(); 
			if($path_link!='admin/dashboard')
			{		
				$string='select page_link from tblpage inner join permission on tblpage.page_id=permission.page_id where permission.user_id = '.$userid;
				$string.=' and permission.role_id = '.$roleid.' and tblpage.page_link = "'.$path_link.'"';
				$pages=$CI->common_model->sql_string($string);
				$page_name=$CI->common_model->single_value('tblpage','page_name','page_link = "'.$path_link.'"');
				
				if(isset($pages[0]->page_link))
				{
					if($pages[0]->page_link==$path_link)
					{
						return true;
					}else{
						$CI->session->set_flashdata('permission','<span style="color:red">Access Denied For The Page '.$page_name.'</span>');
						redirect('admin/dashboard');
					}
				}else{
					$CI->session->set_flashdata('permission','<span style="color:red">Access Denied For The Page '.$page_name.'</span>');
					redirect('admin/dashboard');
				}
			}
			else{
				return true;
			}
			
		}
		
		
		
		
	}
?>