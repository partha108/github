<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class report_module extends CI_Controller
{
    private $user_name = '';
    private $user_fullname = '';
    private $user_role = 0;
    private $user_email = '';
    private $user_id = '';

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
        $this->load->library('excel');

        if ($this->session->userdata('schoolbolpur_admin'))
        {
            $session_data = $this->session->userdata('schoolbolpur_admin');
            if (isset($session_data[0])) 
            {
                $session_data = $session_data[0];
                $this->user_name = $session_data->username;
                $this->user_fullname = $session_data->first_name . ' ' . $session_data->last_name;
                $this->user_role = $session_data->role_id;
                $this->user_email = $session_data->email;
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
        if ($this->user_role != 1) 
        {
            $this->load->library('permission_lib');
            $this->permission_lib->permit($this->user_id, $this->user_role);
        }

        $url = '';
        $search = '';
        $search = '';
        $str = '';
        $and = '&';

        @$page = $this->input->get('page');
        if ($page > 0)
        {
            $str .= 'page=' . $page;
            $data['page'] = $page;
            $data['page_str'] = 'page=' . $page;
        }
        else
        {
            $page = 1;
            $str .= 'page=' . $page;
            $data['page'] = $page;
            $data['page_str'] = 'page=' . $page;
        }

        $per_page = $this->input->get('per_page');
        if ($per_page > 0)
        {
            if (trim($str))
            {
                //$str.=$and.'per_page='.$per_page;
                $data['per_page'] = $per_page;
                $data['per_page_str'] = '&per_page=' . $per_page;

            }
            else
            {
                //$str.='per_page='.$per_page;
                $data['per_page'] = $per_page;
                $data['per_page_str'] = '&per_page=' . $per_page;
            }
        }
        else
        {
            $per_page = 500;
            if (trim($str))
            {
                // $str.=$and.'per_page='.$per_page;
                $data['per_page'] = $per_page;
                $data['per_page_str'] = '&per_page=' . $per_page;

            }
            else
            {
                // $str.=$and.'per_page='.$per_page;
                $data['per_page'] = $per_page;
                $data['per_page_str'] = '&per_page=' . $per_page;
            }
        }

        $cur_page = $page;
        $page -= 1;
        $per_page = $per_page;
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        $start = $page * $per_page;
        $str1 = '';

        $data['payment_details'] = $this->common_model->cleared_check('tbl_add_course_to_student_payment_details', 'check_status', '1', 'payment_status', 'paid','payment_status', '0');
        $data['payment_det_count'] = $this->common_model->common($table_name = 'tbl_add_course_to_student_payment_details', $field = array(), $where = array('check_status' => '1', 'payment_status' => 'paid'), $where_or = array(), $like = array(), $like_or_array = array(), $order = array(), $start = '', $end = '', $where_in_array = array());
        $data['payment_amt_count'] = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','payment_status','0');
        $count = count($data['payment_det_count']);
        $data['count'] = $count;
        $show_data = count($data['payment_details']);

        if (count($count) > 0)
        {
            /* --------------------------------------------- */
            $no_of_paginations = ceil($count / $per_page);
            /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
            $msg = '';
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
            $data['msg'] = $msg;
        }

        $data['a']=$this->common_model->search_field('tbl_student');
        foreach($data['a'] as $row)
        {
            $abc[]=$row->first_name ;
            //$abc[]=$row->roll_no ;
            //$abc[]=$row->reg_no ;
        }
        $data['abc'] = $abc;
        $data['b']=$this->common_model->search_field1('tbl_add_course_to_student_payment_details');
        foreach($data['b'] as $row1)
        {
            $xyz[]=$row1->recepit_no ;
            $xyz[]=$row1->check_no ;
            //$abc[]=$row->roll_no ;
            //$abc[]=$row->reg_no ;
        }
        $data['xyz'] = $xyz;
        $data['str_val'] = '';

       

        $data['payment_head']=$this->common_model->selectAll('tbl_payment_head');
        @$data['academic_year']=$this->common_model->selectAll('academic_year');
        @$data['course']=$this->common_model->selectAll('tbl_course');

        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/report_service_tax_collection', $data);
        $this->load->view('admin/template/admin_footer');
        echo ob_get_clean();
        flush();
        ob_start();
    }

    function receive_payment_model($id)
    {

        @$payment_id = $id;
        @$st_id = explode('_', $payment_id);
        @$id = $this->common_model->max_id('tbl_add_course_to_student_payment_details', 'recepit_no');
        @$mal_data['email_data'] = $this->common_model->selectAll('tblemail');
        @$admin_mail = $mal_data['email_data'][0]->from_email;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
        @$rec_no = $st_data['st_detail'][0]->recepit_no;
        @$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $rec_no);
        @$student_id = $st_data['st_detail'][0]->student_id;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
        @$student_email = $st_data['st_detail'][0]->student_email;
        @$payment_date = date('Y-m-d');

        for ($i = 0; $i < count(array_filter($st_id)); $i++) {
            if (strlen($id) == 1) {
                $rec_no = "111" . $id + 1;
            } else if (strlen($id) == 2) {
                $rec_no = "11" . $id + 1;
            } else if (strlen($id) == 3) {
                $rec_no = "1" . $id + 1;
            } else {
                $rec_no = $id + 1;
            }
            //echo $rec_no;

            @$data['details'][] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $st_id[$i]);
            @$rec_status = $data['details'][$i][0]->payment_status;


            $data = array(
                'payment_date' => $payment_date,
                'payment_status' => 'paid',
                'recepit_no' => $rec_no,
                'check_status' => '1'
            );
            //print_r($data);
            @$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'check_no', $st_id[$i]);

            @$this->email->set_mailtype("html");
            //print_r($st_data);
            @$html_subscriber_user = $this->load->view('admin/mail_template/check_clear', $st_data, true);
            //echo "<pre>";print_r($html_subscriber_user);exit;
            @$this->email->from('admin@parthaedu.com');
            @$this->email->to($student_email);
            @$this->email->subject('Payment Received');
            @$this->email->message($html_subscriber_user);
            @$result = $this->email->send();
            // echo $this->email->print_debugger();
        }
        // exit;
        redirect('pending_cheque');
    }

    public function excel()
    {
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Countries');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Receipt no');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Status');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Receiving Date');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Cheque Number');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Bank Name');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Reg No');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Student Name');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Course');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Class');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Batch');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Subject');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Payment Head Name');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Subject Fee');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Service Amt');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Total');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Sum');

        $payment_details = $this->common_model->cleared_check('tbl_add_course_to_student_payment_details', 'check_status', '1', 'payment_status', 'paid','payment_status', '0');
        $count = 2;
            foreach (@$payment_details as $pd)
            {
                @$student_id = $pd->student_id;
                @$payment_head_id = $pd->payment_head_name;
                @$course_id = $pd->course_id;
                $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$student_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
                @$payment_head_details = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
                @$std_course_id = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
                @$course_name_id =  $std_course_id[0]->course_name;
                @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);

                @$subject_id = $pd->subject_id;
                @$sub_details = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
                @$batch_details = $this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);

                //$count = $count+1;
                $rec_no = $pd->recepit_no;
                @$pay_rec_details = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);

                @$payment_tot_amt = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
                @$payment_head_id = $pd->payment_head_name;
                @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);

                @$total_fees = 0;
                @$total_vat_amt = 0;
                @$total_amt = 0;


                $rec_no = $pd->recepit_no;
                if(@$pd->check_status == '1')
                {
                    $status =  "Cleared";
                }
                $rec_date = date('d-m-Y',strtotime(@$pd->payment_date));
                $chk_no = $pd->check_no;
                $bank_name =  @$pd->bank_name;
                $acc_year =  @$acd_year[0]->academic_year;
                $reg_no = @$student_details[0]->reg_no;
                $student_name = @$student_details[0]->first_name." ".@$student_details[0]->last_name;
                $course_name = @$course_details[0]->course_name;
                $class_name = @$acd_year[0]->class_name;
                $batch_name = @$batch_details[0]->batch_name;
                $sub_name = @$sub_details[0]->subject_name;

                if($pd->payment_head_name == 'Exam Fees')
                {
                    $payment_head_name = "Exam_fee";
                }
                else if($pd->payment_head_name == 'Reg Fees')
                {
                    $payment_head_name =  "Reg fee";
                }
                else if($pd->payment_head_name == "Discount")
                {
                    $payment_head_name =  "Discount Fee";
                }
                else if($pd->payment_head_name == "Add_fee")
                {
                    $payment_head_name =  "Additional Fee";
                }
                else
                {
                    $payment_head_name =   $payment_head_name[0]->payment_head_name;
                }


                if($pd->payment_head_name == 'Exam Fees')
                {
                    $head_fee = $pd->exam_fee;
                }
                else if($pd->payment_head_name == 'Reg Fees')
                {
                    $head_fee =  $pd->course_reg_fee;
                }
                else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                {
                    $head_fee =  $pd->discount_fee;
                }
                else
                {
                    $head_fee =  $pd->payment_head_amt;
                }

                if($pd->payment_head_name == 'Exam Fees')
                {
                    $head_vat =   $pd->exam_vat_fee;
                }
                else if($pd->payment_head_name == 'Reg Fees')
                {
                    $head_vat =  $pd->course_fee_vat_amt;
                }
                else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                {
                    $head_vat =  $pd->discount_vat_amt;
                }
                else
                {
                    $head_vat =   $pd->payment_head_vat_amt;
                }

                if($pd->payment_head_name == 'Exam Fees')
                {
                    $head_tot =  $pd->exam_tot_amt;
                }
                else if($pd->payment_head_name == 'Reg Fees')
                {
                    $head_tot = $pd->course_vat_tot_amt;
                }
                else if($pd->payment_head_name == "Discount" || $pd->payment_head_name == "Add_fee")
                {
                    $head_tot = $pd->discount_tot_amt;
                }
                else
                {
                    $head_tot = $pd->payment_head_tot_amt;
                }

                foreach($payment_tot_amt as $pending_payment_details)
                {
                    if($pending_payment_details->payment_head_name == 'Exam Fees')
                    {
                        $payment_head_fee = $pending_payment_details->exam_fee;
                    }
                    else if($pending_payment_details->payment_head_name == 'Reg Fees')
                    {
                        $payment_head_fee = $pending_payment_details->course_reg_fee;
                    }
                    else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                    {
                        $payment_head_fee = $pending_payment_details->discount_fee;
                    }
                    else
                    {
                        $payment_head_fee = $pending_payment_details->payment_head_amt;
                    }

                    if($pending_payment_details->payment_head_name == 'Exam Fees')
                    {
                        $vat_fee =  $pending_payment_details->exam_vat_fee;
                    }
                    else if($pending_payment_details->payment_head_name == 'Reg Fees')
                    {
                        $vat_fee= $pending_payment_details->course_fee_vat_amt;
                    }
                    else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                    {
                        $vat_fee = $pending_payment_details->discount_vat_amt;
                    }
                    else
                    {
                        $vat_fee =  $pending_payment_details->payment_head_vat_amt;
                    }


                    if($pending_payment_details->payment_head_name == 'Exam Fees')
                    {
                        @$tot_fee = $pending_payment_details->exam_tot_amt;
                    }
                    else if($pending_payment_details->payment_head_name == 'Reg Fees')
                    {
                        @$tot_fee = $pending_payment_details->course_vat_tot_amt;
                    }
                    else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                    {
                        $tot_fee = $pending_payment_details->discount_tot_amt;
                    }
                    else
                    {
                        @$tot_fee = $pending_payment_details->payment_head_tot_amt;
                    }
                    @$total_fees +=$payment_head_fee;
                    @$total_vat_amt +=$vat_fee;
                    @$total_amt +=$tot_fee;
                }

                $this->excel->getActiveSheet()->setCellValue("A" . $count, $rec_no);
                $this->excel->getActiveSheet()->setCellValue("B" . $count, $status);
                $this->excel->getActiveSheet()->setCellValue("C" . $count, $rec_date);
                $this->excel->getActiveSheet()->setCellValue("D" . $count, $chk_no);
                $this->excel->getActiveSheet()->setCellValue("E" . $count, $bank_name);
                $this->excel->getActiveSheet()->setCellValue("F" . $count, $acc_year);
                $this->excel->getActiveSheet()->setCellValue("G" . $count, $reg_no);
                $this->excel->getActiveSheet()->setCellValue("H" . $count, $student_name);
                $this->excel->getActiveSheet()->setCellValue("I" . $count, $course_name);
                $this->excel->getActiveSheet()->setCellValue("J" . $count, $class_name);
                $this->excel->getActiveSheet()->setCellValue("K" . $count, $batch_name);
                $this->excel->getActiveSheet()->setCellValue("L" . $count, $sub_name);
                $this->excel->getActiveSheet()->setCellValue("M" . $count, $payment_head_name);
                $this->excel->getActiveSheet()->setCellValue("N" . $count, $head_fee);
                $this->excel->getActiveSheet()->setCellValue("O" . $count, $head_vat);
                $this->excel->getActiveSheet()->setCellValue("P" . $count, $head_tot);
                $this->excel->getActiveSheet()->setCellValue("Q" . $count, $total_amt);

        $count++;
            }


        $filename = date('d/m/Y').'clearcheque.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    function delete_cheque($id)
    {
        @$payment_id = $id;
        @$st_id = explode('_', $payment_id);
        @$id = $this->common_model->max_id('tbl_add_course_to_student_payment_details', 'recepit_no');
        @$mal_data['email_data'] = $this->common_model->selectAll('tblemail');
        @$admin_mail = $mal_data['email_data'][0]->from_email;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
        @$rec_no = $st_data['st_detail'][0]->recepit_no;
        @$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $rec_no);
        @$student_id = $st_data['st_detail'][0]->student_id;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
        @$student_email = $st_data['st_detail'][0]->student_email;


        for ($i = 0; $i < count(array_filter($st_id)); $i++)
        {
            $data = array(
                'payment_status' => 'pending',
                'check_no' => '',
                'bank_name' => '',
                'check_status' => '',
                'recepit_no' => '',
                'ack_no' => '',
                'payment_mode' => '',

            );
            //print_r($data);
            @$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'check_no', $st_id[$i]);

        }

        redirect('pending_cheque');
    }

    function search()
    {
       $name = $this->input->post('txt_search_data');
       $to_date = $this->input->post('to_date');
       $frm_date = $this->input->post('frm_date');
       $payment_head = $this->input->post('payment_head');
       $rec_no = $this->input->post('txt_rec_no');
       $data = array(
           'name'   =>$name,
           'to_date'=>$to_date,
           'frm_date'=>$frm_date,
           'drp_payment_head'=>$payment_head,
           'rec_no' => $rec_no,
           
       );
        @$data['academic_year']=$this->common_model->selectAll('academic_year');
       if($name == "")
       {
           @$data['search'] = $this->common_model->search_data('tbl_add_course_to_student_payment_details', $to_date, $frm_date, 'paid', $payment_head, $rec_no);
           $data['a']=$this->common_model->search_field('tbl_student');
           foreach($data['a'] as $row)
           {
               $abc[]=$row->first_name ;
               //$abc[]=$row->roll_no ;
               //$abc[]=$row->reg_no ;
           }
           $data['abc'] = $abc;
           $data['b']=$this->common_model->search_field1('tbl_add_course_to_student_payment_details');
           foreach($data['b'] as $row1)
           {
               $xyz[]=$row1->recepit_no ;
               $xyz[]=$row1->check_no ;
               //$abc[]=$row->roll_no ;
               //$abc[]=$row->reg_no ;
           }
           $data['xyz'] = $xyz;
           $data['b']=$this->common_model->search_field('tbl_add_course_to_student_payment_details');
           foreach($data['b'] as $row1)
           {
               $xyz[]=$row1->recepit_no ;
               //$abc[]=$row->roll_no ;
               //$abc[]=$row->reg_no ;
           }
           $data['xyz'] = $xyz;
           //print_r($xyz);
           $data['str_val'] = '';
           $data['payment_head']=$this->common_model->selectAll('tbl_payment_head');
           $this->load->view('admin/template/admin_header');
           $this->load->view('admin/template/admin_leftmenu');
           $this->load->view('admin/search_result_service_tax_collection',$data);
           $this->load->view('admin/template/admin_footer');
       }
       else
       {
           $data['search_by_name'] = $this->common_model->search_data_by_name($name);
           $st_id = $data['search_by_name'][0]->student_id;
           $data['search_by_id'] = $this->common_model->get_search_data('tbl_add_course_to_student_payment_details','student_id',$st_id,$payment_head,$to_date,$frm_date,$rec_no);
           //print_r($data['search_by_id']);
           //exit;
           $data['a']=$this->common_model->search_field('tbl_student');
           foreach($data['a'] as $row)
           {
               $abc[]=$row->first_name ;
           }
           $data['abc'] = $abc;
           $data['b']=$this->common_model->search_field1('tbl_add_course_to_student_payment_details');
           foreach($data['b'] as $row1)
           {
               $xyz[]=$row1->recepit_no ;
               $xyz[]=$row1->check_no ;
               //$abc[]=$row->roll_no ;
               //$abc[]=$row->reg_no ;
           }
           $data['xyz'] = $xyz;
           $data['str_val'] = '';
           $data['payment_head']=$this->common_model->selectAll('tbl_payment_head');
           $this->load->view('admin/template/admin_header');
           $this->load->view('admin/template/admin_leftmenu');
           $this->load->view('admin/search_result_service_tax_collection_by_name',$data);
           $this->load->view('admin/template/admin_footer');
       }
    }

    function search_excel()
    {
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('search_data');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Receipt no');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Status');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Receiving Date');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Cheque Number');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Bank Name');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Reg No');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Student Name');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Course');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Class');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Batch');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Subject');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Payment Head Name');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Subject Fee');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Service Amt');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Total');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Sum');

        $st_payment_data 	    =	$this->input->post('txt_rec_no');
        $to_date 		        = 	$this->input->post('to_date');
        $frm_date 		        = 	$this->input->post('frm_date');
        $payment_head_detail    =   $this->input->post('payment_head');

       /* $st_payment_data 	    =	$_REQUEST['st_payment_data'];
        $to_date 		        = 	$_REQUEST['to_date'];
        $frm_date 		        = 	$_REQUEST['frm_date'];
        $payment_head_detail    =   $_REQUEST['payment_head_detail'];*/

        $abc_payment_details        =   $this->common_model->search_data('tbl_add_course_to_student_payment_details', $to_date, $frm_date, 'paid', $payment_head_detail, $st_payment_data);
       // print_r($abc_payment_details);
        $count = 2;
        foreach (@$abc_payment_details as $abc_pd)
        {
            $student_id                =   @$abc_pd->student_id;
            $payment_head_id           =   @$abc_pd->payment_head_name;
            $course_id                 =   @$abc_pd->course_id;
            $acd_year                   =  @$this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            $student_details           =   @$this->common_model->add_course_data('tbl_student','student_id',$student_id);
            $payment_head_details      =   @$this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
            $std_course_id             =   @$this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            $course_name_id            =   @$std_course_id[0]->course_name;
            $course_details            =   @$this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
            $subject_id                =   @$abc_pd->subject_id;
            $sub_details               =   @$this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
            $batch_details             =   @$this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);
            $rec_no                     =  @$abc_pd->recepit_no;
            $pay_rec_details           =   @$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
            $payment_tot_amt           =   @$this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
            $payment_head_id           =   @$abc_pd->payment_head_name;
            $payment_head_name         =   @$this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);

            $total_fees                =   0;
            $total_vat_amt             =   0;
            $total_amt                 =   0;
            $rec_no                    =   $abc_pd->recepit_no;
            if(@$abc_pd->check_status == '1')
            {
                $status =  "Cleared";
            }
            $rec_date       =   date('d-m-Y',strtotime(@$abc_pd->payment_date));
            $chk_no         =   @$abc_pd->check_no;
            $bank_name      =   @$abc_pd->bank_name;
            $acc_year       =   @$acd_year[0]->academic_year;
            $reg_no         =   @$student_details[0]->reg_no;
            $student_name   =   @$student_details[0]->first_name." ".@$student_details[0]->last_name;
            $course_name    =   @$course_details[0]->course_name;
            $class_name     =   @$acd_year[0]->class_name;
            $batch_name     =   @$batch_details[0]->batch_name;
            $sub_name       =   @$sub_details[0]->subject_name;

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $payment_head_name = "Exam_fee";
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $payment_head_name =  "Reg fee";
            }
            else if($abc_pd->payment_head_name == "Discount")
            {
                $payment_head_name =  "Discount Fee";
            }
            else if($abc_pd->payment_head_name == "Add_fee")
            {
                $payment_head_name =  "Additional Fee";
            }
            else
            {
                $payment_head_name =   @$payment_head_name[0]->payment_head_name;
            }


            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_fee = @$abc_pd->exam_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_fee =  @$abc_pd->course_reg_fee;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_fee =  @$abc_pd->discount_fee;
            }
            else
            {
                $head_fee =  @$abc_pd->payment_head_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_vat =   @$abc_pd->exam_vat_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_vat =  @$abc_pd->course_fee_vat_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_vat =  @$abc_pd->discount_vat_amt;
            }
            else
            {
                $head_vat =   @$abc_pd->payment_head_vat_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_tot =  @$abc_pd->exam_tot_amt;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_tot = @$abc_pd->course_vat_tot_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_tot = @$abc_pd->discount_tot_amt;
            }
            else
            {
                $head_tot = @$abc_pd->payment_head_tot_amt;
            }

            foreach($payment_tot_amt as $pending_payment_details)
            {
                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $payment_head_fee = @$pending_payment_details->exam_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $payment_head_fee = @$pending_payment_details->course_reg_fee;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $payment_head_fee = @$pending_payment_details->discount_fee;
                }
                else
                {
                    $payment_head_fee = @$pending_payment_details->payment_head_amt;
                }

                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $vat_fee =  @$pending_payment_details->exam_vat_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $vat_fee= @$pending_payment_details->course_fee_vat_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $vat_fee = @$pending_payment_details->discount_vat_amt;
                }
                else
                {
                    $vat_fee =  @$pending_payment_details->payment_head_vat_amt;
                }


                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $tot_fee = @$pending_payment_details->exam_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $tot_fee = @$pending_payment_details->course_vat_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $tot_fee = @$pending_payment_details->discount_tot_amt;
                }
                else
                {
                    $tot_fee = @$pending_payment_details->payment_head_tot_amt;
                }
                $total_fees +=$payment_head_fee;
                $total_vat_amt +=$vat_fee;
                $total_amt +=$tot_fee;
            }

            $this->excel->getActiveSheet()->setCellValue("A" . $count, $rec_no);
            $this->excel->getActiveSheet()->setCellValue("B" . $count, $status);
            $this->excel->getActiveSheet()->setCellValue("C" . $count, $rec_date);
            $this->excel->getActiveSheet()->setCellValue("D" . $count, $chk_no);
            $this->excel->getActiveSheet()->setCellValue("E" . $count, $bank_name);
            $this->excel->getActiveSheet()->setCellValue("F" . $count, $acc_year);
            $this->excel->getActiveSheet()->setCellValue("G" . $count, $reg_no);
            $this->excel->getActiveSheet()->setCellValue("H" . $count, $student_name);
            $this->excel->getActiveSheet()->setCellValue("I" . $count, $course_name);
            $this->excel->getActiveSheet()->setCellValue("J" . $count, $class_name);
            $this->excel->getActiveSheet()->setCellValue("K" . $count, $batch_name);
            $this->excel->getActiveSheet()->setCellValue("L" . $count, $sub_name);
            $this->excel->getActiveSheet()->setCellValue("M" . $count, $payment_head_name);
            $this->excel->getActiveSheet()->setCellValue("N" . $count, $head_fee);
            $this->excel->getActiveSheet()->setCellValue("O" . $count, $head_vat);
            $this->excel->getActiveSheet()->setCellValue("P" . $count, $head_tot);
            $this->excel->getActiveSheet()->setCellValue("Q" . $count, $total_amt);

            $count++;
        }

//exit;
        $filename = date('d/m/Y').'clearcheque.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function bounced_cheque($id)
    {
        @$payment_id = $id;
        @$st_id = explode('_', $payment_id);
        @$id = $this->common_model->max_id('tbl_add_course_to_student_payment_details', 'recepit_no');
        @$mal_data['email_data'] = $this->common_model->selectAll('tblemail');
        @$admin_mail = $mal_data['email_data'][0]->from_email;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'payment_id', $id);
        @$rec_no = $st_data['st_detail'][0]->recepit_no;
        @$st_data['rec_detail'] = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details', 'recepit_no', $rec_no);
        @$student_id = $st_data['st_detail'][0]->student_id;
        @$st_data['st_detail'] = $this->common_model->add_course_data('tbl_student', 'student_id', $student_id);
        @$student_email = $st_data['st_detail'][0]->student_email;


        for ($i = 0; $i < count(array_filter($st_id)); $i++)
        {
            $data = array(
                'payment_status' => 'pending',
                'check_status' => '2',

            );
            //print_r($data);
            @$this->common_model->update_data($data, 'tbl_add_course_to_student_payment_details', 'check_no', $st_id[$i]);

            /* @$this->email->set_mailtype("html");
            //print_r($st_data);
            @$html_subscriber_user = $this->load->view('admin/mail_template/check_clear', $st_data, true);
            //echo "<pre>";print_r($html_subscriber_user);exit;
            @$this->email->from('admin@parthaedu.com');
            @$this->email->to($student_email);
            @$this->email->subject('Payment Received');
            @$this->email->message($html_subscriber_user);
            @$result = $this->email->send();
            // echo $this->email->print_debugger();*/
        }

        // exit;
        redirect('pending_cheque');
    }

   

    function search_by_class()
    {
        $acc_year = $this->input->post('add_ac_year');
        $course = $this->input->post('add_course');
        $class = $this->input->post('add_class');
        $sub = $this->input->post('add_subject');        
        $batch = $this->input->post('batch_id');
        
        $data = array(
            'acc_year'=>$acc_year,
            'course'=>$course,
            'class'=>$class,
            'sub'=>$sub,
            'batch_name' => $batch
        );
        $data['a']=$this->common_model->search_field('tbl_student');
        foreach($data['a'] as $row)
        {
            $abc[]=$row->first_name ;
        }
        $data['abc'] = $abc;
        $data['b']=$this->common_model->search_field1('tbl_add_course_to_student_payment_details');
        foreach($data['b'] as $row1)
        {
            $xyz[]=$row1->recepit_no ;
            $xyz[]=$row1->check_no ;
            //$abc[]=$row->roll_no ;
            //$abc[]=$row->reg_no ;
        }
        $data['xyz'] = $xyz;
        @$data['search']= @$this->common_model->stax_search_data($acc_year,$course,$class,$sub,$batch);

        //echo $this->db->last_query();
       //echo "<pre>";print_r($data['search']);exit;
        @$data['academic_year']=$this->common_model->selectAll('academic_year');
        @$data['course_detail']= @$this->common_model->getdetail('tbl_course','academin_year',$acc_year);

        $this->load->view('admin/template/admin_header');
        $this->load->view('admin/template/admin_leftmenu');
        $this->load->view('admin/stax_search_by_name',@$data);
        $this->load->view('admin/template/admin_footer');
    }

    function excel_search_by_class()
    {
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('search_data');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Receipt no');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Status');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Receiving Date');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Cheque Number');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Bank Name');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Reg No');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Student Name');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Course');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Class');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Batch');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Subject');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Payment Head Name');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Subject Fee');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Service Amt');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Total');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Sum');

        $st_name                =   $this->input->post('txt_search_data');
        $st_payment_data 	    =	$this->input->post('txt_rec_no');
        $to_date 		        = 	$this->input->post('to_date');
        $frm_date 		        = 	$this->input->post('frm_date');
        $payment_head_detail    =   $this->input->post('payment_head');

        $data['search_by_name'] = $this->common_model->search_data_by_name($st_name);
        $st_id = $data['search_by_name'][0]->student_id;
        $abc_payment_details = $this->common_model->get_search_data('tbl_add_course_to_student_payment_details','student_id',$st_id,$payment_head_detail,$to_date,$frm_date,$st_payment_data);
        // print_r($abc_payment_details);
        $count = 2;
        foreach (@$abc_payment_details as $abc_pd)
        {
            $student_id                =   @$abc_pd->student_id;
            $payment_head_id           =   @$abc_pd->payment_head_name;
            $course_id                 =   @$abc_pd->course_id;
            $acd_year                   =  @$this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            $student_details           =   @$this->common_model->add_course_data('tbl_student','student_id',$student_id);
            $payment_head_details      =   @$this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
            $std_course_id             =   @$this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            $course_name_id            =   @$std_course_id[0]->course_name;
            $course_details            =   @$this->common_model->add_course_data('tbl_course','course_id',$course_name_id);
            $subject_id                =   @$abc_pd->subject_id;
            $sub_details               =   @$this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
            $batch_details             =   @$this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);
            $rec_no                     =  @$abc_pd->recepit_no;
            $pay_rec_details           =   @$this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);
            $payment_tot_amt           =   @$this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
            $payment_head_id           =   @$abc_pd->payment_head_name;
            $payment_head_name         =   @$this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);

            $total_fees                =   0;
            $total_vat_amt             =   0;
            $total_amt                 =   0;
            $rec_no                    =   $abc_pd->recepit_no;
            if(@$abc_pd->check_status == '1')
            {
                $status =  "Cleared";
            }
            $rec_date       =   date('d-m-Y',strtotime(@$abc_pd->payment_date));
            $chk_no         =   @$abc_pd->check_no;
            $bank_name      =   @$abc_pd->bank_name;
            $acc_year       =   @$acd_year[0]->academic_year;
            $reg_no         =   @$student_details[0]->reg_no;
            $student_name   =   @$student_details[0]->first_name." ".@$student_details[0]->last_name;
            $course_name    =   @$course_details[0]->course_name;
            $class_name     =   @$acd_year[0]->class_name;
            $batch_name     =   @$batch_details[0]->batch_name;
            $sub_name       =   @$sub_details[0]->subject_name;

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $payment_head_name = "Exam_fee";
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $payment_head_name =  "Reg fee";
            }
            else if($abc_pd->payment_head_name == "Discount")
            {
                $payment_head_name =  "Discount Fee";
            }
            else if($abc_pd->payment_head_name == "Add_fee")
            {
                $payment_head_name =  "Additional Fee";
            }
            else
            {
                $payment_head_name =   @$payment_head_name[0]->payment_head_name;
            }


            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_fee = @$abc_pd->exam_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_fee =  @$abc_pd->course_reg_fee;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_fee =  @$abc_pd->discount_fee;
            }
            else
            {
                $head_fee =  @$abc_pd->payment_head_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_vat =   @$abc_pd->exam_vat_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_vat =  @$abc_pd->course_fee_vat_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_vat =  @$abc_pd->discount_vat_amt;
            }
            else
            {
                $head_vat =   @$abc_pd->payment_head_vat_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_tot =  @$abc_pd->exam_tot_amt;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_tot = @$abc_pd->course_vat_tot_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_tot = @$abc_pd->discount_tot_amt;
            }
            else
            {
                $head_tot = @$abc_pd->payment_head_tot_amt;
            }

            foreach($payment_tot_amt as $pending_payment_details)
            {
                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $payment_head_fee = @$pending_payment_details->exam_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $payment_head_fee = @$pending_payment_details->course_reg_fee;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $payment_head_fee = @$pending_payment_details->discount_fee;
                }
                else
                {
                    $payment_head_fee = @$pending_payment_details->payment_head_amt;
                }

                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $vat_fee =  @$pending_payment_details->exam_vat_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $vat_fee= @$pending_payment_details->course_fee_vat_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $vat_fee = @$pending_payment_details->discount_vat_amt;
                }
                else
                {
                    $vat_fee =  @$pending_payment_details->payment_head_vat_amt;
                }


                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $tot_fee = @$pending_payment_details->exam_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $tot_fee = @$pending_payment_details->course_vat_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $tot_fee = @$pending_payment_details->discount_tot_amt;
                }
                else
                {
                    $tot_fee = @$pending_payment_details->payment_head_tot_amt;
                }
                $total_fees +=$payment_head_fee;
                $total_vat_amt +=$vat_fee;
                $total_amt +=$tot_fee;
            }

            $this->excel->getActiveSheet()->setCellValue("A" . $count, $rec_no);
            $this->excel->getActiveSheet()->setCellValue("B" . $count, $status);
            $this->excel->getActiveSheet()->setCellValue("C" . $count, $rec_date);
            $this->excel->getActiveSheet()->setCellValue("D" . $count, $chk_no);
            $this->excel->getActiveSheet()->setCellValue("E" . $count, $bank_name);
            $this->excel->getActiveSheet()->setCellValue("F" . $count, $acc_year);
            $this->excel->getActiveSheet()->setCellValue("G" . $count, $reg_no);
            $this->excel->getActiveSheet()->setCellValue("H" . $count, $student_name);
            $this->excel->getActiveSheet()->setCellValue("I" . $count, $course_name);
            $this->excel->getActiveSheet()->setCellValue("J" . $count, $class_name);
            $this->excel->getActiveSheet()->setCellValue("K" . $count, $batch_name);
            $this->excel->getActiveSheet()->setCellValue("L" . $count, $sub_name);
            $this->excel->getActiveSheet()->setCellValue("M" . $count, $payment_head_name);
            $this->excel->getActiveSheet()->setCellValue("N" . $count, $head_fee);
            $this->excel->getActiveSheet()->setCellValue("O" . $count, $head_vat);
            $this->excel->getActiveSheet()->setCellValue("P" . $count, $head_tot);
            $this->excel->getActiveSheet()->setCellValue("Q" . $count, $total_amt);

            $count++;
        }

//exit;
        $filename = date('d/m/Y').'clearcheque.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }


    function excel_search_by_name()
    {
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('search data');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Receipt no');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Status');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Receiving Date');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Cheque Number');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Bank Name');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Reg No');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Student Name');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Course');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Class');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Batch');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Subject');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Payment Head Name');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Subject Fee');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Service Amt');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Total');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Sum');

        $name                   =
        $st_payment_data 	    =	$_REQUEST['st_payment_data'];
        $to_date 		        = 	$_REQUEST['to_date'];
        $frm_date 		        = 	$_REQUEST['frm_date'];
        $payment_head_detail    =   $_REQUEST['payment_head_detail'];

        $data['search_by_name'] = $this->common_model->search_data_by_name($name);
        $st_id = $data['search_by_name'][0]->student_id;
        $abc_payment_details = $this->common_model->get_search_data('tbl_add_course_to_student_payment_details','student_id',$st_id,$st_payment_data,$to_date,$frm_date,$rec_no);


        
        $count = 2;
        foreach (@$abc_payment_details as $abc_pd)
        {
            @$student_id = $abc_pd->student_id;
            @$payment_head_id = $abc_pd->payment_head_name;
            @$course_id = $abc_pd->course_id;
            $acd_year = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            @$student_details = $this->common_model->add_course_data('tbl_student','student_id',$student_id);
            @$payment_head_details = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);
            @$std_course_id = $this->common_model->add_course_data('tbl_add_course_to_student','add_course_id',$course_id);
            @$course_name_id =  $std_course_id[0]->course_name;
            @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name_id);

            @$subject_id = $abc_pd->subject_id;
            @$sub_details = $this->common_model->add_course_data('tbl_subject','subject_id',$subject_id);
            @$batch_details = $this->common_model->add_course_data('tbl_add_course_subject_to_student','student_id',$student_id);

            //$count = $count+1;
            $rec_no = $abc_pd->recepit_no;
            @$pay_rec_details = $this->common_model->add_course_data('tbl_add_course_to_student_payment_details','recepit_no',$rec_no);

            @$payment_tot_amt = $this->common_model->payment_head_detail('tbl_add_course_to_student_payment_details','check_status','1','recepit_no',$rec_no);
            @$payment_head_id = $abc_pd->payment_head_name;
            @$payment_head_name = $this->common_model->add_course_data('tbl_payment_head','payment_id',$payment_head_id);

            @$total_fees = 0;
            @$total_vat_amt = 0;
            @$total_amt = 0;


            $rec_no = $abc_pd->recepit_no;
            if(@$abc_pd->check_status == '1')
            {
                $status =  "Cleared";
            }
            $rec_date = date('d-m-Y',strtotime(@$abc_pd->payment_date));
            $chk_no = $abc_pd->check_no;
            $bank_name =  @$abc_pd->bank_name;
            $acc_year =  @$acd_year[0]->academic_year;
            $reg_no = @$student_details[0]->reg_no;
            $student_name = @$student_details[0]->first_name." ".@$student_details[0]->last_name;
            $course_name = @$course_details[0]->course_name;
            $class_name = @$acd_year[0]->class_name;
            $batch_name = @$batch_details[0]->batch_name;
            $sub_name = @$sub_details[0]->subject_name;

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $payment_head_name = "Exam_fee";
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $payment_head_name =  "Reg fee";
            }
            else if($abc_pd->payment_head_name == "Discount")
            {
                $payment_head_name =  "Discount Fee";
            }
            else if($abc_pd->payment_head_name == "Add_fee")
            {
                $payment_head_name =  "Additional Fee";
            }
            else
            {
                $payment_head_name =   $payment_head_name[0]->payment_head_name;
            }


            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_fee = $abc_pd->exam_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_fee =  $abc_pd->course_reg_fee;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_fee =  $abc_pd->discount_fee;
            }
            else
            {
                $head_fee =  $abc_pd->payment_head_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_vat =   $abc_pd->exam_vat_fee;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_vat =  $abc_pd->course_fee_vat_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_vat =  $abc_pd->discount_vat_amt;
            }
            else
            {
                $head_vat =   $abc_pd->payment_head_vat_amt;
            }

            if($abc_pd->payment_head_name == 'Exam Fees')
            {
                $head_tot =  $abc_pd->exam_tot_amt;
            }
            else if($abc_pd->payment_head_name == 'Reg Fees')
            {
                $head_tot = $abc_pd->course_vat_tot_amt;
            }
            else if($abc_pd->payment_head_name == "Discount" || $abc_pd->payment_head_name == "Add_fee")
            {
                $head_tot = $abc_pd->discount_tot_amt;
            }
            else
            {
                $head_tot = $abc_pd->payment_head_tot_amt;
            }

            foreach($payment_tot_amt as $pending_payment_details)
            {
                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $payment_head_fee = $pending_payment_details->exam_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $payment_head_fee = $pending_payment_details->course_reg_fee;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $payment_head_fee = $pending_payment_details->discount_fee;
                }
                else
                {
                    $payment_head_fee = $pending_payment_details->payment_head_amt;
                }

                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    $vat_fee =  $pending_payment_details->exam_vat_fee;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    $vat_fee= $pending_payment_details->course_fee_vat_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $vat_fee = $pending_payment_details->discount_vat_amt;
                }
                else
                {
                    $vat_fee =  $pending_payment_details->payment_head_vat_amt;
                }


                if($pending_payment_details->payment_head_name == 'Exam Fees')
                {
                    @$tot_fee = $pending_payment_details->exam_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == 'Reg Fees')
                {
                    @$tot_fee = $pending_payment_details->course_vat_tot_amt;
                }
                else if($pending_payment_details->payment_head_name == "Discount" || $pending_payment_details->payment_head_name == "Add_fee")
                {
                    $tot_fee = $pending_payment_details->discount_tot_amt;
                }
                else
                {
                    @$tot_fee = $pending_payment_details->payment_head_tot_amt;
                }
                @$total_fees +=$payment_head_fee;
                @$total_vat_amt +=$vat_fee;
                @$total_amt +=$tot_fee;
            }

            $this->excel->getActiveSheet()->setCellValue("A" . $count, $rec_no);
            $this->excel->getActiveSheet()->setCellValue("B" . $count, $status);
            $this->excel->getActiveSheet()->setCellValue("C" . $count, $rec_date);
            $this->excel->getActiveSheet()->setCellValue("D" . $count, $chk_no);
            $this->excel->getActiveSheet()->setCellValue("E" . $count, $bank_name);
            $this->excel->getActiveSheet()->setCellValue("F" . $count, $acc_year);
            $this->excel->getActiveSheet()->setCellValue("G" . $count, $reg_no);
            $this->excel->getActiveSheet()->setCellValue("H" . $count, $student_name);
            $this->excel->getActiveSheet()->setCellValue("I" . $count, $course_name);
            $this->excel->getActiveSheet()->setCellValue("J" . $count, $class_name);
            $this->excel->getActiveSheet()->setCellValue("K" . $count, $batch_name);
            $this->excel->getActiveSheet()->setCellValue("L" . $count, $sub_name);
            $this->excel->getActiveSheet()->setCellValue("M" . $count, $payment_head_name);
            $this->excel->getActiveSheet()->setCellValue("N" . $count, $head_fee);
            $this->excel->getActiveSheet()->setCellValue("O" . $count, $head_vat);
            $this->excel->getActiveSheet()->setCellValue("P" . $count, $head_tot);
            $this->excel->getActiveSheet()->setCellValue("Q" . $count, $total_amt);

            $count++;
        }


        $filename = date('d/m/Y').'search_data.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }


}
?>