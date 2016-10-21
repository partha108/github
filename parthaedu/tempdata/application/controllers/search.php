<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class search extends CI_Controller {

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
        $this->load->library('pagination');
        $this->load->library('encrypt');
        $this->load->library('dompdf_gen');
        $this->load->library('excel');

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
        $data=$this->common_model->search_field('tbl_student');
        foreach($data as $row)
        {
            $where[]=$row->first_name ;
            $where[]=$row->roll_no ;
            $where[]=$row->reg_no ;
        }

        $data['where']=$where;
        @$data['academic_year']=$this->common_model->selectAll('academic_year');
        @$data['course']=$this->common_model->selectAll('tbl_course');
        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/search_view',$data);
        $this->load->view('admin/template/admin_footer');
    }

    function add_course_model($id)
    {
        @$data['s'] = $this->common_model->course($id);
        $this->load->view('admin/adv_subject_course_ajax',$data);
    }

    function add_class($id)
    {
        $data['class_detail'] = @$this->common_model->getAllClasses();
        $this->load->view('admin/adv_search_class_view',$data);
    }
    function add_class_course($id)
    {
        @$ac_year = $_REQUEST['acc_value'];
        @$data_tax	=	$this->common_model->common($table_name='tbl_course',$field=array('course_reg_fee'), $where=array(),
            $where_or=array(),
            $like=array(
                'academin_year'=>$ac_year,
                'replace_course'=>$id
            ),
            $like_or=array(),$order=array());
        @$tax=$data_tax[0]->course_reg_fee;
        echo json_encode(array("amount" =>$tax));

        @$data['s'] = $this->common_model->add_class_model($id,$ac_year);
        $this->load->view('admin/adv_search_student_course_class_ajax',$data);
    }
    function add_subject($id)
    {
        $data['sub_detail'] = @$this->common_model->selectsubject('tbl_subject','subject_name','academic_year',$id);

        $this->load->view('admin/adv_search_sub_view',$data);
    }
    function add_batch($id)

    {
        $data['batch_detail'] = @$this->common_model->selectsubject('tbl_batch','batch_name','session',$id);
        $this->load->view('admin/adv_search_batch_view',$data);
    }
    
    

    function result()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $acc_year = $this->input->post('search_acc_year');
        $course = $this->input->post('search_course');
        $class = $this->input->post('search_class');
        $sub = $this->input->post('search_subject');
        $batch = $this->input->post('search_batch');
        $string = str_replace(' ', '', $batch);

        @$data['search_details']= @$this->common_model->adv_search1($acc_year,$course,$class,$sub,$string);
        //echo "<pre>";print_r($data['search_details']);exit;
        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/search_result',@$data);
        $this->load->view('admin/template/admin_footer');




    }

    
}


?>