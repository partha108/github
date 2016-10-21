<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pending_list extends CI_Controller {

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
        $this->load->library('excel');
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
        $url='';
        $search='';
        $search='';
        $str='';
        $and='&';
                
        @$page=$this->input->get('page');
       // echo $page;
        if($page>0)
        {
            $str.='page='.$page;
            $data['page']=$page;
            $data['page_str']='page='.$page;
        }
        else
        {
            $page = 1;
            $str.='page='.$page;
            $data['page']=$page;
            $data['page_str']='page='.$page;
        }
        $per_page=$this->input->get('per_page');
        //echo $per_page;
        if($per_page>0)
        {
            if(trim($str))
            {
                $data['per_page']=$per_page;
                $data['per_page_str']='&per_page='.$per_page;
            }
            else
            {
                $data['per_page']=$per_page;
                $data['per_page_str']='&per_page='.$per_page;
            }
        }
        else
        {
            $per_page =10;
            if(trim($str))
            {
                 $data['per_page']=$per_page;
                 $data['per_page_str']='&per_page='.$per_page;
            }
            else
            {
                 $data['per_page']=$per_page;
                 $data['per_page_str']='&per_page='.$per_page;
            }
        }
        $cur_page = $page;
        $page -= 1;
        $per_page =  $per_page;
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        $start = $page * $per_page;
        $str1='';
        $data['payment_details']= @$this->common_model->pending_data_list_limit($start,$per_page);
       /*echo "<pre>";
        print_r( $data['payment_details']);
        exit;*/
        $data['payment_det_count']= @$this->common_model->pending_data_list();
        $count=count($data['payment_det_count']);
        //echo $count; exit;
        $data['count']=$count;
        $show_data=count($data['payment_details']);
        //print_r($data['ist']);
        if(count($count)>0)
        {
            
                /* --------------------------------------------- */
                $no_of_paginations = ceil($count / $per_page);
                /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
                $msg='';
                if ($cur_page >= 7) 
                {
                    $start_loop = $cur_page - 3;
                    if ($no_of_paginations > $cur_page + 3)
                        $end_loop = $cur_page + 3;
                    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
                    {
                        $start_loop = $no_of_paginations - 6;
                        $end_loop = $no_of_paginations;
                    }
                    else 
                    {
                        $end_loop = $no_of_paginations;
                    }
                } 
                else 
                {
                    $start_loop = 1;
                    if ($no_of_paginations > 7)
                        $end_loop = 7;
                    else
                        $end_loop = $no_of_paginations;
                }
                /* ----------------------------------------------------------------------------------------------------------- */
                $msg .= "<div class='pagination1'><ul>";
                
                // FOR ENABLING THE FIRST BUTTON
                if ($first_btn && $cur_page > 1) 
                {
                    $msg .= "<a href='$url?page=1&per_page=$per_page$str1'><li p='1' class='active'  onclick='page_func(1)'>First</li>";
                }
                else if ($first_btn) 
                {
                    $msg .= "<li class='inactive'>First</li>";
                }
                
                // FOR ENABLING THE PREVIOUS BUTTON
                if ($previous_btn && $cur_page > 1) 
                {
                    $pre = $cur_page - 1;
                    $msg .= "<a href='$url?page=$pre&per_page=$per_page$str1'><li p='$pre' class='active'  onclick='page_func($pre)'>Previous</li></a>";
                } 
                else if ($previous_btn) 
                {
                    $msg .= "<li class='inactive'>Previous</li>";
                }
                for ($i = $start_loop; $i <= $end_loop; $i++)
                {
                
                    if ($cur_page == $i)
                        $msg .= "<a href='$url?page=$i&per_page=$per_page$str1'><li p='$i' style='color:#fff;background-color:#2BB34B;' class='active'  onclick='page_func($i)'>{$i}</li></a>";
                    else
                        $msg .= "<a href='$url?page=$i&per_page=$per_page$str1'><li p='$i' class='active'  onclick='page_func($i)'>{$i}</li></a>";
                }
                
                // TO ENABLE THE NEXT BUTTON
                if ($next_btn && $cur_page < $no_of_paginations) 
                {
                    $nex = $cur_page + 1;
                    $msg .= "<a href='$url?page=$nex&per_page=$per_page$str1'><li p='$nex' class='active' onclick='page_func($nex)'>Next</li></a>";
                } 
                else if ($next_btn) 
                {
                    $msg .= "<li class='inactive'>Next</li>";
                }
                
                // TO ENABLE THE END BUTTON
                if ($last_btn && $cur_page < $no_of_paginations)
                {
                  $msg .= "<a href='$url?page=$no_of_paginations&per_page=$per_page$str1'><li p='$no_of_paginations' class='active'  onclick='page_func($no_of_paginations)'>Last</li></a>";
                } 
                else if ($last_btn)
                {
                   $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
                }
                /*$goto = "";
                $total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                $total_string.= "<span class='total'>Showing ".$count ." of ".$show_data ." entries-<b></span>";
                $msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination*/
                $data['msg']=$msg;

                
            
        }
        //print_r($msg);exit;
        @$data['academic_year']=$this->common_model->selectAll('academic_year');
        @$data['course']=$this->common_model->selectAll('tbl_course');
        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/pending_list_view',$data);
        $this->load->view('admin/template/admin_footer');
    }


    public function excel()
    {
        $payment_details= @$this->common_model->pending_data_list();
        $count = 2;

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('pending_list');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'ACADEMIC YEAR');
        $this->excel->getActiveSheet()->setCellValue('B1', 'STUDENT ROLL NO');
        $this->excel->getActiveSheet()->setCellValue('C1', 'STUDENT REG NO');
        $this->excel->getActiveSheet()->setCellValue('D1', 'STUDENT FIRST NAME');
        $this->excel->getActiveSheet()->setCellValue('E1', 'STUDENT LAST NAME');
        $this->excel->getActiveSheet()->setCellValue('F1', 'STUDENT EMAIL ID');
        $this->excel->getActiveSheet()->setCellValue('G1', 'STUDENT MOBILE NO');
        $this->excel->getActiveSheet()->setCellValue('H1', 'FATHER NAME');
        $this->excel->getActiveSheet()->setCellValue('I1', 'MOTHER NAME');
        $this->excel->getActiveSheet()->setCellValue('J1', 'FATHER MOBILE NO');
        $this->excel->getActiveSheet()->setCellValue('K1', 'MOTHER MOBILE NO');
        $this->excel->getActiveSheet()->setCellValue('L1', 'PAYMENT HEAD NAME');
        $this->excel->getActiveSheet()->setCellValue('M1', 'COURSE');
        $this->excel->getActiveSheet()->setCellValue('N1', 'CLASSS NAME');
        $this->excel->getActiveSheet()->setCellValue("O1",'SUBJECT NAME');
        $this->excel->getActiveSheet()->setCellValue('P1', 'FEES');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'SERVICE AMT');
        $this->excel->getActiveSheet()->setCellValue('R1', 'TOTAL AMT');


        foreach($payment_details as $pd)
        {
            //print_r($pd);

            $student_id =   $pd->student_id;
            $subject_id =   $pd->subject_id;
            $course_id  =   $pd->course_id;
            $payment_head_id    =   $pd->payment_head_name;

            $student_details = $this->common_model->common($table_name='tbl_student',$field=array(),$where=array('student_id'=>$student_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
            $subject_details = $this->common_model->common($table_name='tbl_subject',$field=array(),$where=array('subject_id'=>$subject_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
            $course_details = $this->common_model->common($table_name='tbl_add_course_to_student',$field=array(),$where=array('add_course_id'=>$course_id,'student_id'=>$student_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
            $course_name_id = $course_details[0]->course_name;
            $course_name_by_id = $this->common_model->common($table_name='tbl_course',$field=array(),$where=array('course_id'=>$course_name_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
            $payment_head_name = $this->common_model->common($table_name='tbl_payment_head',$field=array(),$where=array('payment_id'=>$payment_head_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());



            $acc_year = @$course_details[0]->academic_year;
            $roll_no = @$student_details[0]->roll_no;
            $reg_no = @$student_details[0]->reg_no;
            $first_name = @$student_details[0]->first_name;
            $last_name = @$student_details[0]->last_name;
            $student_email = @$student_details[0]->student_email;
            $student_mobile_no = @$student_details[0]->student_phone_no;
            $father_name = @$student_details[0]->father_name;
            $mother_name = @$student_details[0]->mother_name;
            $father_mobile_no = @$student_details[0]->guardian_mobile_no;
            $mother_mobile_no = @$student_details[0]->guardian_phone_no;

            if ($pd->payment_head_name == 'Exam Fees')
            {
                $payment_head_name = "Exam Fee";
            }
            else if ($pd->payment_head_name == 'Reg Fees')
            {
                $payment_head_name = "Reg Fee";
            }
            else
            {
                $payment_head_name = @$payment_head_name[0]->payment_head_name;
            }

            $course_name = @$course_name_by_id[0]->course_name;
            $class_name = @$course_details[0]->class_name;
            if ($pd->payment_head_name == 'Exam Fees')
            {
                $sub_name = "";
            }
            else if ($pd->payment_head_name == 'Reg Fees')
            {
               $sub_name = "";
            }
            else
            {
                $sub_name = $subject_details[0]->subject_name;
            }

            if ($pd->payment_head_name == 'Exam Fees')
            {
                $paynemt_fee = $pd->exam_fee;
            }
            else if ($pd->payment_head_name == 'Reg Fees')
            {
                $paynemt_fee = $pd->course_reg_fee;
            }
            else
            {
                $paynemt_fee = $pd->payment_head_amt;
            }

            if ($pd->payment_head_name == 'Exam Fees')
            {
                $payment_vat = $pd->exam_vat_fee;
            }
            else if ($pd->payment_head_name == 'Reg Fees')
            {
                $payment_vat = $pd->course_fee_vat_amt;
            }
            else
            {
                $payment_vat = $pd->payment_head_vat;
            }

            if ($pd->payment_head_name == 'Exam Fees')
            {
                $tot_amt = $pd->exam_tot_amt;
            }
            else if ($pd->payment_head_name == 'Reg Fees')
            {
                $tot_amt = $pd->course_vat_tot_amt;
            }
            else
            {
                $tot_amt = $pd->payment_head_tot_amt;
            }

            $this->excel->getActiveSheet()->setCellValue("A" . $count, $acc_year);
            $this->excel->getActiveSheet()->setCellValue("B" . $count, $roll_no);
            $this->excel->getActiveSheet()->setCellValue("C" . $count, $reg_no);
            $this->excel->getActiveSheet()->setCellValue("D" . $count, $first_name);
            $this->excel->getActiveSheet()->setCellValue("E" . $count, $last_name);
            $this->excel->getActiveSheet()->setCellValue("F" . $count, $student_email);
            $this->excel->getActiveSheet()->setCellValue("G" . $count, $student_mobile_no);
            $this->excel->getActiveSheet()->setCellValue("H" . $count, $father_name);
            $this->excel->getActiveSheet()->setCellValue("I" . $count, $mother_name);
            $this->excel->getActiveSheet()->setCellValue("J" . $count, $father_mobile_no);
            $this->excel->getActiveSheet()->setCellValue("K" . $count, $mother_mobile_no);

            $this->excel->getActiveSheet()->setCellValue("L" . $count, $payment_head_name);
            $this->excel->getActiveSheet()->setCellValue("M" . $count, $course_name);
            $this->excel->getActiveSheet()->setCellValue("N" . $count, $class_name);
            $this->excel->getActiveSheet()->setCellValue("O" . $count, $sub_name);
            $this->excel->getActiveSheet()->setCellValue("P" . $count, $paynemt_fee);
            $this->excel->getActiveSheet()->setCellValue("Q" . $count, $payment_vat);
            $this->excel->getActiveSheet()->setCellValue("R" . $count, $tot_amt);
        $count++;
        }
//exit;
        $filename='pendinglist.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function search()
    {

        $acc_year = $this->input->post('add_ac_year');
        $course = $this->input->post('add_course');
        $class = $this->input->post('add_class');
        $sub = $this->input->post('add_subject');
        $batch = $this->input->post('batch_id');
        $string = str_replace(' ', '', $batch);

        $data = array(
            'batch_name' => $string
        );

        @$data['search_details']= @$this->common_model->pending_search_data($acc_year,$course,$class,$sub,$string);
        //echo $this->db->last_query();
        //echo "<pre>";print_r($data['search_details']);exit;
        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/pending_check_search_result',@$data);
        $this->load->view('admin/template/admin_footer');






    }

}
?>