<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class academic_year_module extends CI_Controller {

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
        $this->load->library('image_lib');
        $this->load->helper('email');
        $this->load->model('fees_model');
        $this->load->model('common_model');
        $this->load->helper('date_dropdown_helper');

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
        $data['sub']=$this->common_model->selectAll('academic_year');

        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/academic_year_view',$data);
        $this->load->view('admin/template/admin_footer');
    }

    function add_academic()
    {
        if($this->user_role!=1)
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id,$this->user_role);
        }

        $academic_year=trim($this->input->post('add_academin_year'));
        $new_str = str_replace(' ', '', $academic_year);
        $service_tax = trim($this->input->post('add_service_tax'));

        $status = trim($this->input->post('add_status'));

        $data=array(
            'academic_year' =>$new_str,
            'service_tax'=>$service_tax,
            'academic_status' => $status
        );
        //print_r($data);exit;

        $this->common_model->insert_data($data,'academic_year');
        redirect('academic_year_module','refresh');
    }

    function edit_academic()
    {
        if($this->user_role!=1)
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id,$this->user_role);
        }

        $id=trim($this->input->post('id'));
        $edit_academic_name=trim($this->input->post('edit_academin_year'));
        $new_str = str_replace(' ', '', $edit_academic_name);
        $edit_service_tax = trim($this->input->post('edit_service_tax'));

        $edit_academic_status = trim($this->input->post('edit_status'));

        $data=array(
            'academic_year'=>$new_str,
            'service_tax'=>$edit_service_tax,
            'academic_status'=>$edit_academic_status,

        );
        $this->common_model->update_data($data,'academic_year','academic_year_id',$id);
        $tbl_sub = $this->common_model->common($table_name = 'tbl_subject', $field = array(), $where = array('academic_year' => $edit_academic_name), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
        for($i=0;$i<count($tbl_sub);$i++)
        {
           $subject_id  =   $tbl_sub[$i]->subject_id;
           $course_fee  =   $tbl_sub[$i]->course_fee;
           $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
           $tot_amt     =   ($course_fee + $vat_amt);
           $data =  array(
               'course_vat'=>$edit_service_tax,
               'course_vat_amt'=>$vat_amt,
               'course_tot_amt'=>$tot_amt
           );
            $this->common_model->update_data($data,'tbl_subject','subject_id',$subject_id);
        }

        $tbl_course = $this->common_model->common($table_name = 'tbl_course', $field = array(), $where = array('academin_year' => $edit_academic_name), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
        for($i=0;$i<count($tbl_course);$i++)
        {
            $course_id  =   $tbl_course[$i]->course_id;
            $course_fee  =   $tbl_course[$i]->course_reg_fee;
            $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
            $tot_amt     =   ($course_fee + $vat_amt);
            $data =  array(
                'vat'=>$edit_service_tax,
                'vat_amt'=>$vat_amt,
                'total_amt'=>$tot_amt
            );
            $this->common_model->update_data($data,'tbl_course','course_id',$course_id);
        }

        $tbl_class = $this->common_model->common($table_name = 'tbl_class', $field = array(), $where = array('class_academic_year' => $edit_academic_name), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
        for($i=0;$i<count($tbl_class);$i++)
        {
            $course_id  =   $tbl_class[$i]->class_id;
            $course_fee  =   $tbl_class[$i]->exam_fee;
            $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
            $tot_amt     =   ($course_fee + $vat_amt);
            $data =  array(
                'vat'=>$edit_service_tax,
                'vat_amt'=>$vat_amt,
                'tot_amt'=>$tot_amt
            );
            $this->common_model->update_data($data,'tbl_class','class_id',$course_id);
        }

        $tbl_add_course_to_student = $this->common_model->common($table_name = 'tbl_add_course_to_student', $field = array(), $where = array('academic_year' => $edit_academic_name), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());

        for($i=0;$i<count($tbl_add_course_to_student);$i++)
        {
            $student_add_course_id = $tbl_add_course_to_student[$i]->add_course_id;
            $tbl_add_course_to_student_payment_details = $this->common_model->common($table_name = 'tbl_add_course_to_student_payment_details', $field = array(), $where = array('course_id' => $student_add_course_id), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
            for($j=0;$j<count($tbl_add_course_to_student_payment_details);$j++)
            {
                $rec_no = $tbl_add_course_to_student_payment_details[$j]->recepit_no;
                $ack_no =   $tbl_add_course_to_student_payment_details[$j]->ack_no;
                $payment_status =   $tbl_add_course_to_student_payment_details[$j]->payment_status;
                if($payment_status == "pending" && $rec_no == "" && $ack_no == "" )
                {
                    $payment_id  =   $tbl_add_course_to_student_payment_details[$j]->payment_id;
                    $payment_head_name =  $tbl_add_course_to_student_payment_details[$j]->payment_head_name;
                    if($payment_head_name == "Exam Fees")
                    {
                        $course_fee  =   $tbl_add_course_to_student_payment_details[$j]->exam_fee;
                        $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
                        $tot_amt     =   ($course_fee + $vat_amt);
                        $data =  array(
                            'exam_vat'=>$edit_service_tax,
                            'exam_vat_fee'=>$vat_amt,
                            'exam_tot_amt'=>$tot_amt
                        );
                        $this->common_model->update_data($data,'tbl_add_course_to_student_payment_details','payment_id',$payment_id);
                    }
                    else if($payment_head_name == "Reg Fees")
                    {
                        $course_fee  =   $tbl_add_course_to_student_payment_details[$j]->course_reg_fee;
                        $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
                        $tot_amt     =   ($course_fee + $vat_amt);
                        $data =  array(
                            'course_fee_vat'=>$edit_service_tax,
                            'course_fee_vat_amt'=>$vat_amt,
                            'course_vat_tot_amt'=>$tot_amt
                        );
                        $this->common_model->update_data($data,'tbl_add_course_to_student_payment_details','payment_id',$payment_id);
                    }
                    else if($payment_head_name == "Discount" || $payment_head_name == "Add_fee")
                    {

                    }
                    else
                    {
                        $course_fee  =   $tbl_add_course_to_student_payment_details[$j]->payment_head_amt;
                        $vat_amt     =   ($course_fee * $edit_service_tax) / 100;
                        $tot_amt     =   ($course_fee + $vat_amt);
                        $data =  array(
                            'payment_head_vat'=>$edit_service_tax,
                            'payment_head_vat_amt'=>$vat_amt,
                            'payment_head_tot_amt'=>$tot_amt
                        );
                        $this->common_model->update_data($data,'tbl_add_course_to_student_payment_details','payment_id',$payment_id);
                    }
                }
            }
        }

        redirect('academic_year_module','refresh');
    }

    function edit_fees()
    {
        $id=trim($this->input->post('id'));
        $edit_fees=$this->common_model->selectOne('academic_year','academic_year_id',$id);
        echo json_encode(array("edit_fees" => $edit_fees)) ;
    }

    function delete_academic()
    {
        if($this->user_role!=1)
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id,$this->user_role);
        }

        $id=trim($this->input->post('deleteid'));
        $this->common_model->delete_data('academic_year','academic_year_id',$id);
        
        
        redirect('academic_year_module','refresh');
    }

    function sub_admin_active_inactive()
    {
        $value=$this->input->post('value');
        $id=$this->input->post('id');
        $data_sub_admin_active_inactive=array(
            'academic_status'=>$value
        );
        //echo $value;
        $this->db->where('academic_year_id', $id);
        $this->db->update('academic_year',$data_sub_admin_active_inactive);
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
                'academic_status'=>'active'
            );
            //echo $value;
            $this->db->where('academic_year_id', $sub_admin_id);
            $this->db->update('academic_year',$data_sub_admin_active_inactive);
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
                'academic_status'=>'inactive'
            );
            //echo $value;
            $this->db->where('academic_year_id', $sub_admin_id);
            $this->db->update('academic_year',$data_sub_admin_active_inactive);
        }

        //$id=$this->input->post('id');

    }


}
?>