<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class corn_jobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
        $this->load->library('email');
    }
    public function index()
    {
        $data = $this->common_model->selectAll('tbl_student');
        for($i=0;$i<count($data);$i++)
        {
            $st_dob = $data[$i]->dob;
            $st_mob = $data[$i]->student_phone_no;
            $st_name = $data[$i]->first_name;
            $st_mm = date(('m-d'),strtotime($st_dob));
           $cur_date = date('m-d');
            if($st_mm == $cur_date)
            {
                $st_mobile[] = $st_mob;

                $stu_name[] = $st_name;
            }
        }
        $new_st_no = implode(',',$st_mobile);
        $new_st_name = implode(',',$stu_name);
        $exp_st_no = explode(",",$new_st_no );
        $exp_name   =   explode(",", $new_st_name);
        for($i=0;$i<count($exp_st_no);$i++)
        {
            //echo $exp_name[$i];
            $bb = $exp_st_no[$i];
            $sms_text = 'Hare Krishna ' . $exp_name[$i] . ' Today on this auspicious day,PARTHA EDUCATIONAL INSTITUTION wishes u a very happy birthday and bright career ahead';
            $message = urlencode($sms_text);
            $url='http://smszone.ssas.co.in/submitsms.jsp?';
            $data='user=PARTHA&key=ce9fe6f087XX&mobile='.$bb.'&message='.$message.'&senderid=PARTHA&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            if ($result === FALSE)
            {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
        }
    }



}