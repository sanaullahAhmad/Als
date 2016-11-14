<?php 
class Home_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function user_authentication_login($email, $password){
		$this->db->where('id',$email);
		$this->db->where('password',md5($password));		
		$query=$this->db->get('outlets');
			if($query->num_rows==1){
				$row = $query->row();
				$data = array(
                    'userID'     		=> $row->id,
					'manager_email'     => $row->email,
					'outlet_name'       => $row->outlet_name
                    );
                 $this->session->set_userdata($data);
				 
				 //Try setting expiry session time for specific reasons
				 /*$this->session->sess_expiration = '32140800'; //~ one year 86400 ~ one day
    			 $this->session->sess_expire_on_close = 'false';
				 
				 OR
				 //Dynamically wherever you want
				  $this->config->set_item('sess_expiration', '900');  //15 minutes
				 */
	
				 return true;
			}else{
            return false;	
	      }
	}
	
	//Check for active account
	public function active_account_check($email, $password){
		$this->db->where('id',$email);
		$this->db->where('password',md5($password));
		$this->db->where('status', '1');

		$query = $this->db->get('outlets');
			
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
				'userID'     => '',
				'manager_email'       => '',
				);
            $this->session->unset_userdata($data);
			return false;
		}
	}
	
	//Check if Passport ID Exists
	public function check_passport_id_exists($passport_id){
		$this->db->where('ic_number',$passport_id);
		$query = $this->db->get('customers');
			
		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	
	public function  get_existing_customers($phone_search_val){
		$this->db->where('phone', $phone_search_val);
		$query = $this->db->get('customers');
		$result=$query->result_array();
		return $result;
	}
	
	
	
	public function get_value_by_id($table,$id,$value){
		$this->db->where("id", $id);
		$query = $this->db->get($table);
		if($query->num_rows()>0){
		$row = $query->row();

		return $row->$value;
		}else{
			return "N/A";
		}
	}
	
	public function get_data_by_id($id,$table){
		$this->db->where("id", $id);
		$query = $this->db->get($table);
		return $row = $query->row();
	}
	
	

	
	
	
	
	
	
	/*public function signup(){
	   $data=array(
			  'username'		    =>	$this->input->post('username'),
			  'email'		        =>	$this->input->post('email'),
			  'password'		    =>	md5($this->input->post('password')),
			  'register_on'	        =>	date('Y-m-d'),
			  'status'				=>  1
			  );
	  $this->db->insert('tbl_users',$data);	
	  return true;
	}

	


	public function get_data_all($table){
		$query = $this->db->get($table);
		$result=$query->result_array();
		return $result;
	}

	public function get_data_all_using_where($where_attr,$where_val,$table){
	    $this->db->where($where_attr, $where_val);
		$query = $this->db->get($table);
		$result=$query->result_array();
		return $result;
	}

	public function delete_data_using_where($attr,$attr_val,$table){
		$this->db->where($attr, $attr_val);
		$this->db->delete($table);
	}

	public function get_data_by_id($id,$table){
		$this->db->where("id", $id);
		$query = $this->db->get($table);
		return $row = $query->row();
	}
	
	/********************************/
	/*public function notify($to,$module_id,$module,$action){
	  $data=array(
			'from'		   =>  $this->session->userdata('userID'),
			'to'	       =>  $to,
			'module_id'	   =>  $module_id,
			'module'	   =>  $module,
			'action'       =>  $action,
			'is_read'	   =>  0,
			'date_time'	   =>  time()
			);
	  $this->db->insert('tbl_notifications',$data);
	}
	public function update_profile($picture){
		if($picture==''){
		  if($this->input->post('old_pic')==''){
			   $picture='';
			 }else{	
			  $picture=$this->input->post('old_pic');
			}
		}
	  $data=array(
			  'username'		    =>	$this->input->post('username')?$this->input->post('username'):$this->input->post('old_username'),
			  'fullname'		    =>	$this->input->post('fullname'),
			  'email'		        =>	$this->input->post('email'),
			  'country'		        =>	$this->input->post('country'),
			  'password'		    =>	$this->input->post('pass')?md5($this->input->post('pass')):$this->input->post('old_pass'),
			  'about'		        =>	$this->input->post('about'),
			  'picture'             =>  $picture,
			  );
			  $this->db->where('id',$this->input->post('id'));
	  $this->db->update('tbl_users',$data);	
	  return true;
	}
	public function ajax_ask_question(){
		$obj = json_decode($_POST['json_data']);
		if($obj->security==1){
		  $security_id=$obj->security_id;
		}else{
		  $security_id=0;
		}
		$data=array(
			'question'		  => $obj->question,
			'category_id'     => $obj->category_id,
			'description'     => $obj->desc,
			'asked_by'		  => $this->session->userdata('userID'),
			'security'        => $security_id,
			'date_asked'	  => time(),
			'status'    	  => 1
		);
		$this->db->insert('tbl_questions',$data);
		return true;
	}
	
	public function ajax_post_comment(){
		$obj = json_decode($_POST['json_data']);
		$data=array(
			'comment'		  => $obj->txt_comment,
			'question_id'     => $obj->question_id,
			'ans_id'     	  => $obj->ans_id,
			'commented_by'	  => $this->session->userdata('userID'),
			'date_commented'  => date('Y-m-d'),
			'date_timestamp'  => date('Y-m-d H:i:s'),
			'status'    	  => 1
		);
		$this->db->insert('tbl_comments',$data);
		return true;
	}
	
	public function get_questions_data(){
		if($this->session->userdata('userID')==""){
		$sql="SELECT q.*,c.category_name,u.username FROM `tbl_questions` q
				INNER JOIN `tbl_categories` as c on c.id = q.category_id
				INNER JOIN `tbl_users` as u on u.id = q.asked_by order by q.id desc";
		}else{
		  $sql="SELECT q.*,c.category_name,u.username FROM `tbl_questions` q
				INNER JOIN `tbl_categories` as c on c.id = q.category_id
				INNER JOIN `tbl_users` as u on u.id = q.asked_by order by q.security desc,q.id desc";
		}
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_recent_questions_user(){
		$user_id=$this->session->userdata('userID');
		$sql="SELECT * from tbl_questions where asked_by=$user_id ORDER BY id DESC LIMIT 2";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_questions_data_by_category_id($cate_id){
		$sql="SELECT q.*,c.category_name,u.username FROM `tbl_questions` q
				INNER JOIN `tbl_categories` as c on c.id = q.category_id
				INNER JOIN `tbl_users` as u on u.id = q.asked_by
				WHERE category_id=$cate_id";
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function ajax_get_question_by_sorting(){
		$obj = json_decode($_POST['json_data']);
		if($obj->sort_by=='newst'){
			$sql="SELECT * FROM `tbl_questions` ORDER by id DESC";
		}else{
		  $sql="SELECT
         p.*,
         c.postcount
    FROM tbl_questions as p
    INNER JOIN (SELECT
                question_id,
                count(*) AS postcount
                FROM tbl_answers
                GROUP BY question_id) as c
    on p.id = c.question_id
    Order by c.postcount DESC";
		}
				
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_question_likes($qid){
	    $this->db->where("question_id", $qid);
		$query = $this->db->get('tbl_question_likes');
		if($query->num_rows()>0){
			return $row = $query->row();
		}else{
			return array();
		}
	}
	public function get_answer_likes($answer_id){
	    $this->db->where("answer_id", $answer_id);
		$query = $this->db->get('tbl_answer_likes');
		if($query->num_rows()>0){
			return $row = $query->row();
		}else{
			return array();
		}
	}
	public function get_user_friends($user_id){
	    $this->db->where("user_id", $user_id);
		$query = $this->db->get('tbl_users_list');
		if($query->num_rows()>0){
			return $row = $query->row();
		}else{
			return array();
		}
	}
	
	
	//Get comments
	public function get_all_comments($id){
		$sql="SELECT * from tbl_comments where ans_id = $id";
	
		$query = $this->db->query($sql);
		return $result=$query->result_array();
	}
	
	
	public function ajax_like_question(){
		$obj = json_decode($_POST['json_data']);
		$data=$this->get_question_likes($obj->qid);
		if(count($data)>0){
			$myArray = explode(',', $data->liked_by);
			$myArray[]=$this->session->userdata('userID');
		    $ids=implode(',',$myArray);
			$data=array(
			'liked_by'		   =>$ids
			);
			$this->db->where("question_id", $obj->qid);
			$this->db->update('tbl_question_likes',$data);
		}else{
			
			$data=array(
			'question_id'		   =>$obj->qid,
			'liked_by'		   =>$this->session->userdata('userID')
			);
			$this->db->insert('tbl_question_likes',$data);
		}
		return true;
	}
	public function ajax_unlike_question(){
		$obj = json_decode($_POST['json_data']);
		$data=$this->get_question_likes($obj->qid);
		$myArray = explode(',', $data->liked_by);
	    $pos = array_search($this->session->userdata('userID'), $myArray);
	    unset($myArray[$pos]);
		$ids=implode(',',$myArray);
		   $data=array(
			'liked_by'		   =>$ids
			);
			$this->db->where("question_id", $obj->qid);
			$this->db->update('tbl_question_likes',$data);
	}
	public function ajax_like_answer(){
		$obj = json_decode($_POST['json_data']);
		$data=$this->get_answer_likes($obj->ans_id);
		if(count($data)>0){
			$myArray = explode(',', $data->liked_by);
			$myArray[]=$this->session->userdata('userID');
		    $ids=implode(',',$myArray);
			$data=array(
			'liked_by'		   =>$ids
			);
			$this->db->where("answer_id", $obj->ans_id);
			$this->db->update('tbl_answer_likes',$data);
		}else{
			$data=array(
			'answer_id'		   =>$obj->ans_id,
			'liked_by'		   =>$this->session->userdata('userID')
			);
			$this->db->insert('tbl_answer_likes',$data);
		}
		return true;
	}
	public function ajax_follow_user(){
		$obj = json_decode($_POST['json_data']); 
		$data=$this->get_user_friends($this->session->userdata('userID'));
		if(count($data)>0){
			$myArray = explode(',', $data->friends_list);
			$myArray[]=$obj->user_id;
		    $ids=implode(',',$myArray);
			$data=array(
			'friends_list'		   =>$ids
			);
			$this->db->where("user_id", $this->session->userdata('userID'));
			$this->db->update('tbl_users_list',$data);
		}else{
			$data=array(
			'user_id'		   =>  $this->session->userdata('userID'),
			'friends_list'	   =>  $obj->user_id
			);
			$this->db->insert('tbl_users_list',$data);
		}
		return true;
	}
	public function ajax_unfollow_user(){
		$obj = json_decode($_POST['json_data']);
		$data=$this->get_user_friends($this->session->userdata('userID'));
		if(count($data)>0){
			if($data->friends_list=='' || $data->friends_list==','){
				  $this->delete_data_using_where("user_id",$this->session->userdata('userID'),"tbl_users_list");
				}else{
		  $myArray = explode(',', $data->friends_list);
		  if(count($myArray)>1){
	      $pos = array_search($obj->user_id, $myArray);
	      unset($myArray[$pos]);
		  $ids=implode(',',$myArray);
		   $data=array(
			'friends_list'		   =>$ids
			);
			$this->db->where("user_id", $this->session->userdata('userID'));
			$this->db->update('tbl_users_list',$data);
		  }else{
			    $this->delete_data_using_where("user_id",$this->session->userdata('userID'),"tbl_users_list");
			 }
		  }
		}
	
	}
	
	public function ajax_unlike_answer(){
		$obj = json_decode($_POST['json_data']);
		$data=$this->get_answer_likes($obj->ans_id);
		if(count($data)>0){
			if($data->liked_by=='' || $data->liked_by==','){
				  $this->delete_data_using_where("answer_id",$obj->ans_id,"tbl_answer_likes");
				}else{
		  $myArray = explode(',', $data->liked_by);
		  if(count($myArray)>1){
	      $pos = array_search($this->session->userdata('userID'), $myArray);
	      unset($myArray[$pos]);
		  $ids=implode(',',$myArray);
		   $data=array(
			'liked_by'		   =>$ids
			);
			$this->db->where("answer_id", $obj->ans_id);
			$this->db->update('tbl_answer_likes',$data);
		  }else{
			    $this->delete_data_using_where("answer_id",$obj->ans_id,"tbl_answer_likes");
			 }
		  }
		}
	}
	public function count_likes($qid){
		$data=$this->get_question_likes($qid);
		if(count($data)>0){
			$myArray = explode(',', $data->liked_by);
		    return count($myArray);
		}else{
		    return 0;
		}
	}
	public function count_answer_likes($answer_id){
		$data=$this->get_answer_likes($answer_id);
		if(count($data)>0){
		      $myArray = explode(',', $data->liked_by);
		      return count($myArray);
		}else{
		    return 0;
		}
	
	}
	public function post_answer($question_id,$answer,$image_name,$segment_id, $selected_ckbox_val){
		$data=array(
			'question_id'		   =>$question_id,
			'answered_by'		   =>$this->session->userdata('userID'),
			'date_answered'		   =>time(),
			'answer'		   	   =>$answer,
			'answer_image'         => $image_name,
			'private'              => $selected_ckbox_val,
			'status'		       => 0,
			'answer_segment'	   =>$segment_id
			);
			$this->db->insert('tbl_answers',$data);
	}
	public function get_question_image($question_id){
	    $sql="SELECT * from tbl_answers where question_id=$question_id order by id asc";
		$query = $this->db->query($sql);
		$row = $query->row();
		if($query->num_rows()>0){
		  return $row->answer_image;
		}else{
		  return "";
		}
	}
	public function get_friends_list($user_id){
		$this->db->where("user_id", $user_id);
		$query = $this->db->get('tbl_users_list');
		if($query->num_rows()>0){
		$row = $query->row();
		return $row->friends_list;
		}else{
			return '';
		}
	}
	public function get_data_by_friends(){
		$user_id=$this->session->userdata('userID');
		$list=$this->home_model->get_friends_list($user_id);
		if($list==''){
	      $sql="SELECT * from tbl_answers";
		}else{
		   $sql="SELECT * from tbl_answers where answered_by in($list)";
		}
		$query = $this->db->query($sql);
		return $result=$query->result_array();
	}
	public function mark_as_read(){
		 $data=array(
			'is_read'	   =>  1
			);
	  $this->db->where('to',$this->session->userdata('userID'));
	  $this->db->update('tbl_notifications',$data);
	  return true;
	}*/
}