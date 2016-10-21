<?php
class common_model extends CI_Model {


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function sum_insurance($pay_id)
	{
		$this->db->select_sum('payment_head_amt');
		$this->db->from('tbl_subject_patment_head_detail');
		$this->db->where('payment_head',$pay_id);
		$query=$this->db->get();

		return $query->result();

	}


	function sum_payment_head_amt($table,$sum_column_name,$column_name,$column_value,$column_name_status,$column_value_status_value,$col_name,$col_value)
	{
		$this->db->select_sum($sum_column_name);
		$this->db->from($table);
		$this->db->where($column_name,$column_value);
		$this->db->where($column_name_status,$column_value_status_value);
		$this->db->or_where_in($col_name,$col_value);

		$query=$this->db->get();

		return $query->result();

	}
	function payment_head_detail($table,$column_name,$column_value,$column_name_status,$column_value_status_value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column_name,$column_value);
		$this->db->where($column_name_status,$column_value_status_value);

		$query=$this->db->get();

		return $query->result();

	}
	function student_payment_paid_details($table,$column_name,$column_value,$column_name_status,$column_value_status_value)
	{
		$this->db->select('*');
		$this->db->from($table);
		
		$this->db->where($column_name_status,$column_value_status_value);
		$this->db->or_where('payment_status','3');
		$this->db->where($column_name,$column_value);
		$query=$this->db->get();
		return $query->result();
	}
	
	function student_payment_unpaid_details($table,$column_name,$column_value,$column_name_status,$column_value_status_value)
	{
		$this->db->select('*');
		$this->db->from($table);
		
		$this->db->where($column_name_status,$column_value_status_value);
		$this->db->or_where('payment_status','2');
		//$this->db->or_where('payment_status','1');
		$this->db->where($column_name,$column_value);
		$query=$this->db->get();
		return $query->result();
	}
	
	

	function sum_reg($table)
	{
		$this->db->select_sum('course_reg_fee');
		$this->db->from($table);		
		$query=$this->db->get();
		return $query->result();
	}

	function sum_exam($table)
	{
		$this->db->select_sum('exam_fee');
		$this->db->from($table);		
		$query=$this->db->get();
		return $query->result();
	}


	function createtable()
	{
		$str='ALTER TABLE `tblcharge` ADD `paid_month` INT(11) NOT NULL AFTER `charge_amount`, ADD `paid_year` INT(11) NOT NULL AFTER `paid_month`';
		$query = $this->db->query($str);
	}

	

	public function course($id)
	{

		$this->db->select('*');
		$this->db->from('tbl_course');
		$this->db ->where('academin_year',$id);
		//$this->db ->where('academin_year',$id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	public function add_class_model($id,$acc_value)
	{
		$this->db->distinct();
		$this->db->select('class_name');
		$this->db->from('tbl_course');
		$this->db ->where('course_id',$id);
		$this->db->like('academin_year',$acc_value);
		//$this->db->distinct();
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function add_subject_edit_model($id)
	{
		$this->db->distinct();
		$this->db->select('subject_name');
		$this->db->from('tbl_subject');
		$this->db ->where('course_name_by_subject',$id);

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function add_subject_edit_view_model($id)
	{
		$this->db->distinct();
		$this->db->select('subject_name');
		$this->db->from('tbl_subject');
		$this->db ->where('course_name_by_subject',$id);

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function edit_subject_payment_details_model($table,$column_name,$id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db ->where($column_name,$id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	public function edit_subject_payment_details_modelll($table,$column_name,$id,$column_namee,$idd)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db ->where($column_name,$id);
		$this->db ->where($column_namee,$idd);

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function add_subject_model($id,$acc_year,$course_value)
	{

		$this->db->select('*');
		$this->db->from('tbl_subject');
		$this->db->like('course_name_by_subject',$course_value);
		$this->db ->like('academic_year',$acc_year);
		$this->db ->where('class_name',$id);
		//$this->db->distinct();
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function add_batch_model($id,$course_value,$acc_year)
	{

		$this->db->select('*');
		$this->db->from('tbl_batch');
		$this->db->like('course_name',$course_value);
		$this->db ->like('session',$acc_year);
		$this->db ->where('batch_class_name',$id);
		//$this->db->distinct();
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function update_logondateTime($username)
	{
		$datetime = date('Y-m-d H:i:s');
		$ip=$this->input->ip_address();
		if($ip=="")
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		$data = array(
			'lastlogon_datetime' => $datetime,
			'logged_ip' => $ip,
		);
		$this -> db -> where('username = ' . "'" . $username . "'");
		$this->db->update("user",$data);
	}
	public function edit_batch_model($batch_name,$acc_year,$course_by)
	{
		$this->db->select('*');
		$this->db->from('tbl_batch');
		$this->db->like('course_name',$course_by);
		$this->db ->like('session',$acc_year);
		$this->db ->where('batch_class_name',$batch_name);
		//$this->db->distinct();
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}



	public function getAllClasses_course($acy)
	{

		$this->db->select('*');
		$this->db->from('tbl_class');
		$this->db->where('class_academic_year',$acy);

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function course_edit_subject($course_by_year)
	{

		$this->db->select('*');
		$this->db->from('tbl_course');
		$this->db ->where('academin_year',$course_by_year);
		//$this->db ->where('academin_year',$course_by_year);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}


	function blockUnblock($data,$id,$column,$table){
		$this -> db -> where($column,$id );
		$this->db->update($table,$data);
		$str=$this->db->last_query();
	}
	function checkuseremail_availability($email)
	{
		$this -> db -> select('*');
		$this -> db -> from('student');
		$this -> db -> where('email = ' . "'" . $email . "'");
		$query = $this -> db -> get();
		if($query -> num_rows() > 0 )
			return FALSE;
		else
			return TRUE;
	}


	function delete_data($table,$columname,$columnvalue){
		$this->db->where($columname,$columnvalue);
		$this->db->delete($table);
		//echo $this->db->last_query();exit;
	}

	function delete_data_subject($table,$columname1,$columnvalue1,$columname2,$columnvalue2,$columname3,$columnvalue3){
		$this->db->where($columname1,$columnvalue1);
		$this->db->where($columname2,$columnvalue2);
		$this->db->where($columname3,$columnvalue3);
		$this->db->delete($table);
		//echo $this->db->last_query();exit;
	}


	function delete_img_data($table,$columname,$columnvalue,$columname1,$columnvalue1){
		$this->db->where($columname,$columnvalue);
		$this->db->where($columname1,$columnvalue1);
		$this->db->delete($table);
		//echo $this->db->last_query();exit;
	}

	function delete_whereclause($table,$whereclause){
		$this->db->where($whereclause);
		$this->db->delete($table);
		//echo $whereclause;echo $this->db->last_query();exit;
	}

	function update_data($data,$table,$columname,$columnvalue){
		$this->db->where($columname,$columnvalue);
		$this->db->update($table,$data);
	}

	function update_img_data($data,$table,$columname,$columnvalue,$columname1,$columnvalue1){
		$this->db->where($columname,$columnvalue);
		$this->db->where($columname1,$columnvalue1);
		$this->db->update($table,$data);
	}
	function update_data_where($data,$table,$whereclause){
		$this->db->where($whereclause);
		$this->db->update($table,$data);
	}


	function insert_data($data,$table){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	//function insert_($data,$table,$id){	
//	$this -> db -> where($table,$id );
//		$this->db->update($table,$data);	
//		return $this->db->insert_id();		
//	}
	function sql_string($str)
	{
		$query=$this->db->query($str);
		return $query->result();
	}

	function selectAllSort($table,$limit,$start,$orderBy_column,$orderBy_attr){
		$this -> db -> select('*')-> from($table);
		if($limit!=''){
			$this->db->limit($limit, $start);
		}
		if($orderBy_column!=''){
			$this->db->order_by($orderBy_column,$orderBy_attr);
		}
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}
		return $list;
	}


	function selectAll($table){
		$this -> db -> select('*');
		$this -> db -> from($table);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	function selectsubject($table,$col_name,$c_name,$c_val)
	{
		$this->db->distinct();
		$this->db->select($col_name);
		$this->db->from($table);
		$this->db->where($c_name,$c_val);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	function selectsub($table)
	{

		$this->db->select('*');
		$this->db->from($table);

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}



	function getAllClasses(){
		$this->db->distinct();
		$this->db->select('class_name');
		$query=$this->db->get('tbl_class');
		$result=$query->result();
		return $result;

	}

	function getAllClasses_edit_subject_view($course_by){
		//$this->db->distinct();
		$this->db->select('class_name');
		$this->db->where('course_id',$course_by);
		$query=$this->db->get('tbl_course');
		$result=$query->result();
		return $result;

	}
	
	
	function getAlldata($table,$colum_name,$student_id){
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->where($colum_name,$student_id);
		$query=$this->db->get($table);
		$result=$query->result();
		return $result;

	}

	function getAlldata_subject($table,$colum_name1,$student_id1,$colum_name2,$student_id2,$colum_name3,$student_id3){
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->where($colum_name1,$student_id1);
		$this->db->where($colum_name2,$student_id2);
		$this->db->where($colum_name3,$student_id3);
		$query=$this->db->get($table);
		$result=$query->result();
		return $result;

	}

	function subject_view($sub_name){
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->where('class_name',$sub_name);
		$query=$this->db->get('tbl_subject');
		$result=$query->result();
		return $result;

	}
	
	

	function edit_batch_view($acc_year,$course_by,$class_name){
		$this->db->distinct();

		$this->db->select('batch_name');
		$this -> db -> from('tbl_batch');
		$this->db->where('session',$acc_year);
		$this->db->where('course_name',$course_by);
		$this->db->where('batch_class_name',$class_name);
		$query=$this->db->get();
		$result=$query->result();
		return $result;

	}

	function edit_repbatch_view($acc_year,$course_by,$class_name){
		$this->db->distinct();

		$this->db->select('rep_batch_name');
		$this -> db -> from('tbl_batch');
		$this->db->where('session',$acc_year);
		$this->db->where('course_name',$course_by);
		$this->db->where('batch_class_name',$class_name);
		$query=$this->db->get();
		$result=$query->result();
		return $result;

	}
/*function edit_batch_view($student_id,$course_id){
		$this->db->distinct();

		$this->db->select('batch_name');
		$this -> db -> from('tbl_add_course_subject_to_student');
		$this->db->where('student_id',$student_id);
		$this->db->where('add_course_id',$course_id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;

	}*/

	/*$this->db->select('*');
    $this->db->from('tbl_batch');
    $this->db->like('course_name',$course_by);
    $this->db ->like('session',$acc_year);
    $this->db ->where('batch_class_name',$batch_name);
        //$this->db->distinct();
    $query=$this->db->get();
    $result=$query->result();
    return $result;*/



	function getAllclass_classname(){
		$this -> db -> select('*');
		$this -> db -> from('tbl_class');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}


	function getAllbatch(){
		$this -> db -> select('*');
		$this -> db -> from('tbl_batch');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	function get_where_class_status()
	{
		$this -> db -> select('*');
		$this -> db -> from('tbl_class');
		$this->db->where('class_status','active');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}






	function selectOne($table,$columnname,$columnvalue){
		$this -> db -> select('*')-> from($table)->where($columnname,$columnvalue);
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}
		return $list;
		//print_r($list()); 
	}



	function selectWhere($table,$where){
		$this -> db -> select('*')-> from($table);
		if($where!='')
		{
			$this -> db ->where($where);
		}
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}
		return $list;
	}

	function selectColmnWhere($table,$column,$where){
		if($column!='')
		{
			$this -> db -> select($column);
		}else{
			$this -> db -> select('*');
		}
		$this->db-> from($table);
		if($where!='')
		{
			$this -> db ->where($where);
		}
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}
		return $list;
	}



	function single_value($table,$columname,$whereclause){
		$columnvalue='';
		$this->db->select($columname);
		if($whereclause!='')
		{
			$this->db->where($whereclause);
		}
		$query = $this->db->get($table);
		//echo $this->db->last_query();
		//print_r($query->result()); 
		if($query -> num_rows > 0  )
		{

			foreach($query->result() as $row)
			{
				$columnvalue=$row->$columname;
			}
		}

		return $columnvalue;
	}




	function selectDistinct($table,$column,$columnname,$columnvalue){
		$this->db->distinct();
		$this -> db -> select($column)-> from($table);
		if($columnname!=''){
			$this -> db ->where($columnname,$columnvalue);
		}

		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}
		return $list;
	}


	function SelectData($limit,$start,$table1,$table2,$join,$where,$orderBy_column,$orderBy_attr)
	{
		$this->db->select('*')->from($table1);
		if($join!=''){
			$this -> db -> join($table2,$join);
		}
		if($where!=''){
			$this -> db -> where($where);
		}

		if($limit!=''){
			$this->db->limit($limit, $start);
		}
		if($orderBy_column!=''){
			$this->db->order_by($orderBy_column,$orderBy_attr);
		}
		$query=$this->db->get();

		$list=array();

		if($query->num_rows>0)
		{
			return $query->result();
		}
		return $list;
	}



	function max_id($table,$columname){
		$last_id=0;
		$this->db->select_max($columname);
		$query = $this->db->get($table);
		if($query -> num_rows > 0  )
		{
			foreach($query->result() as $row)
			{
				if( $row->$columname!=NULL)
				{
					$last_id=$row->$columname;
				}
			}

		}

		return $last_id;
	}

	function get_country()
	{
		$this -> db -> select('*');
		$this -> db -> from('country');
		//$this -> db -> where("");
		$query = $this -> db -> get();
		if($query -> num_rows()){

			foreach($query->result() as $row)
			{
				$country[] = array(
					'country_id' => $row->id,
					'country_name'=> $row->country_name,
					'country_code'=> $row->country_code_short
				);
			}
		}
		//echo "<pre>";print_r($country);exit;
		return $country;
	}

	function get_city()
	{
		$this -> db -> select('*');
		$this -> db -> from('city');
		$query = $this -> db -> get();
		if($query -> num_rows()){

			foreach($query->result() as $row)
			{
				$city[] = array(
					'city_id' => $row->city_id,
					'city'=> $row->city,
					'state_code'=>$row->state_code
				);
			}
		}
		return $city;
	}

	function get_state()
	{
		$this -> db -> select('*');
		$this -> db -> from('state');
		$query = $this -> db -> get();
		$result=$query->result();
		return $result;
	}

	public function city($id)
	{

		$this->db->select('*');
		$this->db->from('city');
		$this->db ->like('state_code',$id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	public function course_class($id)
	{

		$this->db->select('*');
		$this->db->from('tbl_class');
		$this->db ->like('class_academic_year',$id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}


	//--------------------------------------------------------------News---------------------------------------------    
	function news_model()
	{
		$this->db->select('*');
		$this->db->from('news');
		$query=$this->db->get();
		$news=array();
		if($query->num_rows>0)
		{
			foreach($query->result() as $rows)
			{
				$news[]=array(
					'id'=>$rows->id,
					'title'=>$rows->title,
					'description'=>$rows->description,
					'exp_date_time'=>$rows->exp_date_time,
					'status'=>$rows->status,
					'image'=>$rows->image
				);
			}
		}
		return $news;
	}

	function add_news_model($data)
	{
		$this->db->insert("news",$data);
	}

	function delete_expire_news()
	{
		$today=date("Y-m-d H:i:s");
		$sql = "DELETE from news where exp_date_time<'".$today."'";
		$query = $this->db->query($sql);
	}

	function delete_news_model($id)
	{
		$sql = "DELETE from news where id=".$id;
		$query = $this->db->query($sql);
	}

	function get_news($id)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('id',$id);
		$query=$this->db->get();
		$getnews=array();
		if($query->num_rows>0)
		{
			foreach($query->result() as $rows)
			{
				$getnews[]=array(
					'id'=>$rows->id,
					'title'=>$rows->title,
					'description'=>$rows->description,
					'image'=>$rows->image,
					'status'=>$rows->status,
					'end_date'=>date('Y-m-d',strtotime($rows->exp_date_time))
				);
			}
		}
		return $getnews;
	}

	function edit_newspost_model($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('news',$data);
	}

	function blockUnblock_news($id,$status)
	{
		$data=array( 'status'=>$status );
		$this->db->where('id', $id);
		$this->db->update('news',$data);
	}


	function get_user_list_view($role_id){
		$this -> db -> select('*');
		$this -> db -> from('user');
		$this -> db -> where("user.username !='' ");
		$this->db->where('user.role_id',$role_id);
		$query = $this -> db -> get();
		$student=array();
		if($query -> num_rows>0){
			foreach($query->result() as $row)
			{
				$student[] = array(
					'id'=>$row->id,
					'username' => $row->username,
					'first_name'=>  $row->first_name,
					'middle_name'=>$row->middle_name,
					'last_name' => $row->last_name
				);
			}
		}
		return $student;
	}


	function getPermitedPages($userid,$roleid)
	{
		$this -> db -> select('*');
		$this -> db -> from('permission');
		$this->db->where('user_id = '.$userid.' and role_id = '.$roleid);
		$this->db->order_by('page_id','ASC');
		$query = $this -> db -> get();
		$permission = array();
		if($query -> num_rows()>0)
		{
			foreach($query->result() as $row)
			{
				$permission[] = array(
					'id'=>trim($row->permission_id),
					'user_id'=>trim($row->user_id),
					'page_id'=>trim($row->page_id)
				);
			}
		}
		return $permission;
	}

	function getAllRoles()
	{
		$this -> db -> select('*');
		$this -> db -> from(' role a');
		$query = $this -> db -> get();
		$roles = array();
		if($query -> num_rows > 0)
		{
			foreach($query->result() as $row)
			{
				$roles[] = array(
					'role_id'=> $row->id,
					'role_name'=>  $row->role_name
				);
			}
		}
		return $roles;
	}
	function check_username_availability($registration_no){
		$this -> db -> select('*');
		$this -> db -> from('student');
		$this -> db -> where("registration_no",$registration_no);
		$query = $this -> db -> get();
		if($query -> num_rows() > 0 )
			return FALSE;
		else
			return TRUE;
	}
	function get_concession_specialfees($student_id){
		$current_date=date('Y-m-d');
		$this -> db -> select('*');
		$this -> db -> from('concession_user');
		$this -> db -> where("user_id",$student_id);
		$this -> db -> where("endmonth >=",$current_date);
		$query = $this -> db -> get();

		$this -> db -> select('*');
		$this -> db -> from('specialfees_user');
		$this -> db -> where("user_id",$student_id);
		$this -> db -> where("endmonth >=",$current_date);
		$query2 = $this -> db -> get();
		//echo $this->db->last_query();
		//echo $query -> num_rows()."|".$query2 -> num_rows();exit;
		if($query -> num_rows() > 0  || $query2 -> num_rows() > 0 )
			return FALSE;
		else
			return TRUE;
	}

	function login_availability($username,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_student');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('status','active');
		//$this->db->or_where('role_id', 2); 
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}


	function payment_status($columnvalue1,$columnvalue2)
	{
		$this->db->select('*');
		$this->db->from('tbl_add_course_to_student_payment_details');
		$this->db->where('student_id',$columnvalue1);
		$this->db->where('course_id',$columnvalue2);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	





















	public function common($table_name='',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array())
	{
		if(trim($table_name))
		{
			if(count($field)>0)
			{
				$field=implode(',',$field);
			}
			else
			{
				$field='*';
			}

			$this->db->select($field);
			$this->db->from($table_name);

			if(count($where)>0)
			{

				foreach($where as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->where($key,$val);
					}
				}

			}


			if(count($where_or)>0)
			{
				foreach($where_or as $key=>$val)
				{


					if(trim($val))
					{

						$this->db->or_where($key,$val);
					}
				}
			}

			if(count($order)>0)
			{

				foreach($order as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->order_by($key,$val);
					}
				}

			}

			if(count($like)>0)
			{

				foreach($like as $key=>$val)
				{
					if($val)
					{
						$this->db->like($key,$val);

					}
				}

			}


			if($end)
			{

				$this->db->limit($end,$start);
			}

			if(count($where_in_array)>0)
			{

				$this->db->where_in('user_id', $where_in_array);
			}

			$query = $this->db->get();
			$resultResponse=$query->result();
			return $resultResponse;

		}
		else
		{
			echo 'Table name should not be empty';exit;
		}

	}


	function getdetail($table,$column_name,$column_value){
		$this -> db -> select('*');
		$this -> db -> from($table);
		$this->db->where($column_name,$column_value);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}



	/*function tbl_join($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_student');
		$this->db->join('tbl_add_course_to_student', 'tbl_add_course_to_student.student_id = tbl_student.student_id','left');
		$this->db->join('tbl_add_course_subject_to_student', 'tbl_add_course_subject_to_student.add_course_id = tbl_add_course_to_student.add_course_id','left');

		$this->db->where('tbl_student.student_id', $id);
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}*/

	function add_course_data($table,$column_name,$column_value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column_name,$column_value);
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}

	function add_payment_data($table,$column_name,$column_value,$col_name,$col_val)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column_name,$column_value);
		$this->db->where($col_name,$col_val);
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}
	
	
	
	
	function pending_check($table,$column_name,$column_value,$column_name_status,$column_value_status_value)
	{
		$this->db->select('*');
		$this->db->from($table);

		$this->db->where($column_name,$column_value);
		$this->db->where($column_name_status,$column_value_status_value);
		$this->db->group_by('check_no');
		$this->db->order_by("ack_no", "desc");
		$query = $this->db->get();
		$result=$query->result();
		return $result;

	}

	function cleared_check($table,$column_name,$column_value,$col_name,$col_value,$column_name_status,$column_value_status_value)
	{
		$this->db->select('*');
		$this->db->from($table);


		$this->db->where($column_name,$column_value);
		$this->db->or_where_in($col_name,$col_value);
		$this->db->where($column_name_status,$column_value_status_value);
		//$this->db->group_by('check_no');
		$this->db->order_by("recepit_no", "desc");
		$query = $this->db->get();
		$result=$query->result();
		return $result;

	}

	function add_total_amt_data($table,$name,$column_name,$column_value,$col_name,$col_value)
	{
		$this->db->select_sum($name);
		//$this->db->from('tbl_student');
		//$this->db->join('tbl_add_course_to_student', 'tbl_add_course_to_student.student_id = tbl_student.student_id','left');
		//$this->db->where('tbl_student.student_id',$student_id);

		$this->db->from($table);
		//$this->db->join('tbl_add_course_to_student', 'tbl_add_course_to_student.student_id = tbl_student.student_id','left');
		$this->db->where($column_name,$column_value);
		$this->db->or_where_in($col_name,$col_value);
		$query = $this->db->get();
		$result=$query->result();
		return $result;

	}

	function add_total_sub_data($table,$name,$column_name,$column_value,$col_name,$col_value)
	{
		$this->db->select($name);
		//$this->db->from('tbl_student');
		//$this->db->join('tbl_add_course_to_student', 'tbl_add_course_to_student.student_id = tbl_student.student_id','left');
		//$this->db->where('tbl_student.student_id',$student_id);

		$this->db->from($table);
		//$this->db->join('tbl_add_course_to_student', 'tbl_add_course_to_student.student_id = tbl_student.student_id','left');
		$this->db->where($column_name,$column_value);
		$this->db->or_where_in($col_name,$col_value);
		$query = $this->db->get();
		$result=$query->result();
		return $result;

	}






	function tbl_join()
	{
		$this->db->select('SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,PD.payment_date,PD.check_no,PD.bank_name,PD.ack_no');
		$this->db->from('tbl_add_course_to_student_payment_details PD');
		$this->db->join('tbl_student SD','SD.student_id = PD.student_id','left');
		//$this->db->join('tbl_add_course_subject_to_student', 'tbl_add_course_subject_to_student.add_course_id = tbl_add_course_to_student.add_course_id','left');
		$this->db->group_by('PD.check_no');
		$this->db->select('SUM(`payment_head_tot_amt`)+SUM(`exam_tot_amt`)+SUM(`course_vat_tot_amt`)');
		$this->db->where('PD.payment_status', 'pending');
		$this->db->where('PD.check_status', '3');
		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}
	function tbl_selected_st_join($sub_admin_id)
	{

		$this->db->select('SD.reg_no,SD.roll_no,SD.first_name,SD.last_name,SD.student_email,SD.student_phone_no,SD.gender,SD.stream,SD.category,SD.dob,SD.enrollment_date,SD.addmission_class,SD.studying,SD.school_name,SD.board,SD.che_marks,SD.math_marks,SD.bio_marks,SD.phy_marks,SD.father_name,SD.mother_name,SD.guardian_mobile_no,SD.guardian_phone_no,science_marks,PD.payment_date,PD.check_no,PD.bank_name');
		$this->db->from('tbl_add_course_to_student_payment_details PD');
		$this->db->join('tbl_student SD','SD.student_id = PD.student_id','left');
		//$this->db->join('tbl_add_course_subject_to_student', 'tbl_add_course_subject_to_student.add_course_id = tbl_add_course_to_student.add_course_id','left');
		$this->db->group_by('PD.check_no');
		$this->db->select('SUM(`payment_head_tot_amt`)+SUM(`exam_tot_amt`)+SUM(`course_vat_tot_amt`)');
		$this->db->where('SD.student_id', $sub_admin_id);
		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}

	function excel_join_student_data($sub_admin_id)
	{

		$this->db->select('SD.reg_no,SD.roll_no,SD.first_name,SD.last_name,SD.student_email,SD.student_phone_no,SD.gender,SD.stream,SD.category,SD.dob,SD.enrollment_date,SD.addmission_class,SD.studying,SD.father_name,SD.mother_name,SD.guardian_mobile_no,SD.guardian_phone_no,TC.course_name,TS.subject_name');
		$this->db->from('tbl_student SD');
		$this->db->join('tbl_add_course_to_student_payment_details PD','PD.student_id = SD.student_id','left');
		$this->db->join('tbl_course TC','PD.course_id = TC.course_id','left');
		$this->db->join('tbl_subject TS','PD.subject_id = TS.subject_id','left');
		$names = array($sub_admin_id);
		$this->db->where_in('SD.student_id', $names);
		$this->db->order_by("SD.student_id", "desc");
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}

	//for pending amount........


	//advance search

	//,ADS.class_name,SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,TC.course_name,TS.subject_name,CSD.batch_name

	/*function adv_search($acc_year,$course,$class,$sub,$batch)
	{

		$this->db->select('ADS.academic_year,ADS.class_name,SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,TC.course_name,TS.subject_name,CSD.batch_name');
		$this->db->from('tbl_add_course_to_student ADS,tbl_student SD,tbl_course TC,tbl_subject TS,tbl_add_course_subject_to_student CSD');

		$this->db->like('ADS.academic_year',$acc_year,'both');
		/*$this->db->or_like('ADS.class_name',$class);
		$this->db->or_like('TC.course_name',$course);
		$this->db->or_like('TS.subject_name',$sub);
		$this->db->or_like('CSD.batch_name',$batch);*/
		//$this->db->where('ADS.student_id','SD.student_id');
		//$query = $this->db->get();
		//$result=$query->result();
		//return $result;
	//}*/

	function adv_search1($acc_year,$course,$class,$sub,$batch)
	{

		/*$query = $this->db->query("SELECT DISTINCT
										ACS.academic_year,ACS.class_name,ACS.course_name,
    									SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,
    									CSD.batch_name
    									
									FROM
										tbl_add_course_to_student ACS,
										tbl_student SD,
										tbl_course TC,
										tbl_subject TS,
										tbl_add_course_subject_to_student CSD,
										
								where
									ACS.student_id = SD.student_id									
									AND 
									CSD.subject_name = TS.subject_id
									AND 
									ACS.academic_year LIKE '%$acc_year%'
									AND 
									ACS.course_name = '$course'
									AND 
									ACS.class_name = '$class'
									AND 
									CSD.subject_name = '$sub'
									AND 
									CSD.batch_name = '$batch'
									");
		$result=$query->result();
		return $result;*/

		$this->db->select('ACS.academic_year,SD.roll_no,SD.first_name,SD.last_name,SD.student_phone_no,SD.guardian_mobile_no,SD.guardian_phone_no,ACS.course_name,TS.subject_name,ACS.class_name,ASS.batch_name');
		$this->db->from('tbl_student SD');
		$this->db->join('tbl_add_course_to_student ACS','ACS.student_id = SD.student_id','left');
		$this->db->join('tbl_add_course_subject_to_student ASS','ASS.student_id = ACS.student_id','left');
		//$this->db->join('tbl_add_course_to_student_payment_details PD','PD.student_id = SD.student_id','left');
		$this->db->join('tbl_course TC','ACS.course_name = TC.course_id','left');
		$this->db->join('tbl_subject TS','ASS.subject_name = TS.subject_id','left');
		//$names = array($sub_admin_id);
		$this->db->like('ACS.academic_year',$acc_year);
		$this->db->like('TC.course_id',$course);
		if($sub != 0)
		{
			$this->db->like('TS.subject_id',$sub);
		}
		if($class != 0)
		{
			$this->db->like('ACS.class_name',$class);
		}
		if($batch != 0)
		{
			$this->db->where('ASS.batch_name',$batch);
		}


		//$this->db->order_by("SD.student_id", "desc");
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}
	function adv_search2($acc_year,$course)
	{

		$query = $this->db->query("SELECT
										ADS.academic_year,ADS.class_name,
    									SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,
    									TC.course_name,
    									TS.subject_name,
    									CSD.batch_name
									FROM
										tbl_add_course_to_student ADS,
										tbl_student SD,
										tbl_course TC,
										tbl_subject TS,
										tbl_add_course_subject_to_student CSD
								where
									ADS.student_id = SD.student_id
									AND
									ADS.course_name = TC.course_id
									AND
									CSD.subject_name = TS.subject_id
									AND
									ADS.academic_year LIKE '%$acc_year%'
									AND
									TC.course_id LIKE '%$course%'
									
									");
		$result=$query->result();
		return $result;
	}
	function adv_search3($acc_year,$course,$class)
	{

		$query = $this->db->query("SELECT
										ADS.academic_year,ADS.class_name,
    									SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,
    									TC.course_name,
    									TS.subject_name,
    									CSD.batch_name
									FROM
										tbl_add_course_to_student ADS,
										tbl_student SD,
										tbl_course TC,
										tbl_subject TS,
										tbl_add_course_subject_to_student CSD
								where
									ADS.student_id = SD.student_id
									AND
									ADS.course_name = TC.course_id
									AND
									CSD.subject_name = TS.subject_id
									AND
									ADS.academic_year LIKE '%$acc_year%'
									AND
									ADS.class_name LIKE '%$class%'
																
									");
		$result=$query->result();
		return $result;
	}
	function adv_search4($acc_year,$course,$class,$sub)
	{

		$query = $this->db->query("SELECT
										ADS.academic_year,ADS.class_name,
    									SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,
    									TC.course_name,
    									TS.subject_name,
    									TB.batch_name
									FROM
										tbl_add_course_to_student ADS,
										tbl_student SD,
										tbl_course TC,
										tbl_subject TS,
										tbl_batch TB,
										tbl_add_course_subject_to_student CSD
								where
									ADS.student_id = SD.student_id
									AND
									TC.course_id LIKE '%$course%' = TC.course_id
									AND
									CSD.subject_name LIKE '%$sub%' = TS.subject_id
									AND
									ADS.academic_year LIKE '%$acc_year%'
									
									AND 
									TS.subject_name LIKE '%$sub%'									
									
									");
		$result=$query->result();
		return $result;
	}
	function adv_search5($acc_year,$course,$class,$sub,$batch)
	{

		$query = $this->db->query("SELECT
										ADS.academic_year,ADS.class_name,
    									SD.roll_no,SD.reg_no,SD.first_name,SD.last_name,
    									TC.course_name,
    									TS.subject_name,
    									CSD.batch_name
									FROM
										tbl_add_course_to_student ADS,
										tbl_student SD,
										tbl_course TC,
										tbl_subject TS,
										tbl_add_course_subject_to_student CSD
								where
									ADS.student_id = SD.student_id
									AND
									ADS.course_name = TC.course_id
									AND
									CSD.subject_name = TS.subject_id
									AND
									ADS.academic_year LIKE '%$acc_year%'
									AND
									TC.course_id LIKE '%$course%'
									AND 
									TC.course_id LIKE '%$class%'									
									AND 
									ADS.class_name LIKE '%$sub%'
									AND 
									CSD.batch_name LIKE '%$batch%'
									
									");
		$result=$query->result();
		return $result;
	}

	function excel_pending_list()
	{

		$this->db->select('ACS.academic_year,
		SD.reg_no,SD.roll_no,SD.first_name,SD.last_name,SD.student_email,SD.student_phone_no,SD.father_name,SD.mother_name,SD.guardian_mobile_no,SD.guardian_phone_no,
		PHN.payment_head_name,
		TC.course_name,
		TS.subject_name,
		TSPA.payment_head_amt,TSPA.payment_head_vat_amt,TSPA.payment_head_total_amt,');

		$this->db->from('tbl_add_course_to_student ACS');
		$this->db->join('tbl_student SD','SD.student_id = ACS.student_id','left');
		$this->db->join('tbl_add_course_to_student_payment_details PHD','PHD.student_id = ACS.student_id','left');
		$this->db->join('tbl_payment_head PHN','TSPA.subject_id = PHD.payment_head_name','left');
		$this->db->join('tbl_course TC','TC.course_id = ACS.course_name','left');
		$this->db->join('tbl_subject TS','TS.subject_id = PHD.subject_id','left');
		$this->db->join('tbl_subject_patment_head_detail TSPA','TSPA.subject_id = PHD.payment_head_name','left');

				$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}
	///////////////////////////////////////////////////////////

	function admin_details_by_email($email)
	{
		$this->db->select('*');
		$this->db->from('tbl_student');
		$this->db->where('student_email',$email);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	function search_field($table){
		$this -> db -> select('*')-> from($table);
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}

		return $list;
	}


	function sub_name($table,$col_name1,$col_value1,$col_name2,$col_value2,$col_name3,$col_value3)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name1,$col_value1);
		$this->db->where($col_name2,$col_value2);
		$this->db->where($col_name3,$col_value3);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	function get_total_col_name($search_field)
	{

		$fields = $this->db->list_fields('tbl_student');

		foreach ($fields as $field)
		{
			//$this->db->select("CONCAT($field)");
			$this->db->or_like($field,$search_field,'before');
		}
		$query=$this->db->get('tbl_student');
		$result=$query->result();
		return $result;
	}


	/*function bounced_check($table,$data,$column_name,$column_value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->group_by('check_no');
		$this->db->update($table, $data);

		$this->db->where($column_name,$column_value);
		
		$query = $this->db->get();
		$result=$query->result();
		return $result;

	}*/

	function search_data($table,$start_date,$end_date,$status)
	{
		echo $status;

		$this->db->where('payment_date BETWEEN  "'. $start_date. '" and "'. $end_date.'"' );
		$this->db->where('payment_status',$status);
		/*$this->db->like('payment_date >= ', $start_date);
		$this->db->like('payment_date <= ',$end_date);*/
		$query=$this->db->get($table);
		$result=$query->result();
		return $result;
	}

	/*function clear_check()
	{
		$this->db->select('PHD.recepit_no,PHD.payment_status,PHD.payment_date,PHD.check_no,PHD.bank_name,
							ACS.academic_year
							SD.roll_no,SD.first_name,SD.last_name,
							PHN.payment_head_name,
							TC.course_name,
							TS.subject_name,
							TSPA.payment_head_amt,TSPA.payment_head_vat_amt,TSPA.payment_head_total_amt,');

		$this->db->from('tbl_add_course_to_student ACS');
		$this->db->join('tbl_student SD','SD.student_id = ACS.student_id','left');
		$this->db->join('tbl_add_course_to_student_payment_details PHD','PHD.student_id = ACS.student_id','left');
		$this->db->join('tbl_payment_head PHN','TSPA.subject_id = PHD.payment_head_name','left');
		$this->db->join('tbl_course TC','TC.course_id = ACS.course_name','left');
		$this->db->join('tbl_subject TS','TS.subject_id = PHD.subject_id','left');
		$this->db->join('tbl_subject_patment_head_detail TSPA','TSPA.subject_id = PHD.payment_head_name','left');

		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}*/
}
?>