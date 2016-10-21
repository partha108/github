<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class add_controller extends CI_Controller {

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
        $this->load->model('pagination_model');
        $this->load->library('encrypt');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('fees_model');
        $this->load->library('image_lib');
        $this->load->helper('email');
        $this->load->model('common_model');
        $this->load->model('sub_admin_model');
        $this->load->library('pagination');
        $this->load->library('encrypt');

        if ($this->session->userdata('schoolbolpur_admin')) {
            $session_data = $this->session->userdata('schoolbolpur_admin');
            if (isset($session_data[0])) {
                $session_data = $session_data[0];
                $this->user_name = $session_data->username;
                $this->user_fullname = $session_data->first_name . ' ' . $session_data->last_name;
                $this->user_role = $session_data->role_id;
                $this->user_email = $session_data->email;
                $this->user_id = $session_data->id;
            }
        } else {
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
        $data['sub_admin_detail']=	$this->sub_admin_model->sub_admin_edit_details('2');

        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/add_controller_view',$data);
        $this->load->view('admin/template/admin_footer');

    }

    public function sub_admin_record()
    {
        $sub_admin_name = $this->input->post('sub_admin_name');
        $sub_admin_user_name = $this->input->post('sub_admin_name_user_name');


            $sub_admin_data = array
            (
                'page_name' => $sub_admin_name,
                'page_link' => $sub_admin_user_name,
            );
            //echo "<pre>";print_r($sub_admin_data);exit;
            $this->db->insert('tblpage', $sub_admin_data);
            redirect('add_controller');
    }



    function edit_academic()
    {
        if($this->user_role!=1)
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id,$this->user_role);
        }

        $id=trim($this->input->post('id'));
        $edit_sub_admin_name=trim($this->input->post('edit_sub_admin_name'));
        $edit_sub_admin_user_name = trim($this->input->post('edit_sub_admin_user_name'));
        $edit_sub_admin_user_email = trim($this->input->post('edit_sub_admin_userl_email'));
        $edit_sub_admin_password = trim($this->input->post('edit_sub_admin_password'));

        $edit_sub_admin_status = trim($this->input->post('edit_status'));
        $logged_ip = $this->input->ip_address();


        $data=array(
            'first_name' => $edit_sub_admin_name,
            'username' => $edit_sub_admin_user_name,
            'email' => $edit_sub_admin_user_email,
            'password' => $edit_sub_admin_password,
            'status' => $edit_sub_admin_status,
            'role_id' => 2,
            'lastlogon_datetime' => date("Y-m-d H:i:s"),
            'created_id' => $logged_ip
        );

        $this->common_model->update_data($data,'user','id',$id);

        redirect('add_sub_admin','refresh');
    }

    function edit_fees()
    {
        $id=trim($this->input->post('id'));
        $edit_fees=$this->common_model->selectOne('user','id',$id);
        // print_r($edit_fees);
        echo json_encode(array("edit_fees" => $edit_fees)) ;
    }

    function delete_sub_admin($id)
    {
        if($this->user_role!=1)
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id,$this->user_role);
        }

        $id=trim($this->input->post('deleteid'));
        $this->common_model->delete_data('user','id',$id);

        redirect('add_sub_admin','refresh');
    }

}


?>