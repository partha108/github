<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sub_admin_list_manage extends CI_Controller
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
        $this->load->model('sub_admin_mange_list_model');

        //START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
        $this->session_check_and_session_data->session_check();
        //END LOGIN CHECK++++++++++++++++++++++++++++++++++++++
    }


    function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }

    function index()
    {
        $admin_details=$this->session_check_and_session_data->admin_session_data();
        if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin_list_manage')=='Y' || $admin_details[0]->role_id==1)
        {
            $default=$this->uri->segment(1);
            $active_inactive_value=$this->uri->segment(2);
            $data['active_inactive_value']=$active_inactive_value;


            if($active_inactive_value=='active')
            {
                $data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing_by_filter($active_inactive_value);
            }
            else if($active_inactive_value=='in-active')
            {
                $data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing_by_filter($active_inactive_value);
            }
            else
            {
                $data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing();
            }




            //echo "<pre>";print_r($data['sub_admin_list']);exit();
            //echo 'test';exit();

            $this->load->view('template/admin_header');
            $this->load->view('template/admin_leftmenu');
            $this->load->view('sub_admin_listing_view',$data);
            $this->load->view('template/admin_footer');
        }
        else
        {
            $this->session->set_flashdata('message','Access Denied.');
            redirect('index.php/','refresh');
        }
    }

    function sub_admin_delete()
    {
        $admin_details=$this->session_check_and_session_data->admin_session_data();
        if(@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('sub_admin_list_manage/sub_admin_delete')=='Y' || $admin_details[0]->role_id==1)
        {
            $id=$this->uri->segment(3);
            $this->db->where('id', $id);
            $this->db->delete('tbluser');

            $this->session->set_flashdata('message','Delete action is successfull...');
            redirect('index.php/sub_admin_list_manage','refresh');
        }
        else
        {
            $this->session->set_flashdata('message','Access Denied.');
            redirect('index.php/','refresh');
        }
    }

    function sub_admin_active_inactive()
    {
        $value=$this->input->post('value');
        $id=$this->input->post('id');
        $data_sub_admin_active_inactive=array(
            'status'=>$value
        );
        //echo $value;
        $this->db->where('id', $id);
        $this->db->update('tbluser',$data_sub_admin_active_inactive);
    }



    function sub_admin_active_more_than_one_id()
    {
        $sub_admin_id_all=$this->input->post('sub_admin_id');
        $sub_admin_id_array=explode(",",$sub_admin_id_all);
        for($i=0;$i<count($sub_admin_id_array);$i++)
        {
            //echo $product_id_all;
            $sub_admin_id=trim($sub_admin_id_array[$i]);
            $data_sub_admin_active_inactive=array(
                'status'=>'active'
            );
            //echo $value;
            $this->db->where('id', $sub_admin_id);
            $this->db->update('tbluser',$data_sub_admin_active_inactive);
        }

        //$id=$this->input->post('id');

    }

    function sub_admin_in_active_more_than_one_id()
    {
        $sub_admin_id_all=$this->input->post('sub_admin_id');
        $sub_admin_id_array=explode(",",$sub_admin_id_all);
        for($i=0;$i<count($sub_admin_id_array);$i++)
        {
            //echo $product_id_all;
            $sub_admin_id=trim($sub_admin_id_array[$i]);
            $data_sub_admin_active_inactive=array(
                'status'=>'inactive'
            );
            //echo $value;
            $this->db->where('id', $sub_admin_id);
            $this->db->update('tbluser',$data_sub_admin_active_inactive);
        }

        //$id=$this->input->post('id');

    }




}?>