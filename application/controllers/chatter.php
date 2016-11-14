<?php defined('BASEPATH') OR exit('No direct script access allowed');

class chatter extends CI_Controller {
	
	
	var $data;
	

	public function __construct(){

		parent::__construct();
		$this->load->model('General_model');
		$this->resident_id = $this->session->userdata('resident_id');
		//$this->output->enable_profiler(TRUE);
	}
	
	/////////////////////////////////////////////////////////////////
	//////////////////POSTS COMMENTS - LONG POLLING//////////////////
	/////////////////////////////////////////////////////////////////
	
	public function index(){
		$this->load->view('dashboard',$this->data);
	}
	
	public function start_poll(){
		$mode = $this->fetch('mode');
			
			switch($mode){
				case 'get':
					$this->getMessage();
					break;
				case 'post':
					$this->postMessage();
					break;
				default:
					$this->output(false, 'Wrong mode.');
					break;
			}
			//return;
	}
	
	public function getMessage(){
			$endtime = time() + 20;
			$lasttime = $this->fetch('lastTime');
			$curtime = null;
					
			while(time() <= $endtime){
				$rs = $this->db->query("
					SELECT *
					FROM posts_comments
					ORDER BY insertDate desc LIMIT 0,5
					
				");
				
				if($rs){
					$messages = array();
						foreach($rs->result_array() as $rr){
							$commented_by = $rr['commented_by'];
						$messages[] = array(
							'user' => $rr['commented_by'],
							'postID' => $rr['post_id'],
							'commentID' => $rr['id'],
							'text' => substr($rr['comment'],0,90),
							'seemore_text' => substr($rr['comment'],90,1000),
							'pic' => $this->General_model->get_value_by_id('residents',$commented_by,'image_url'),
							'name' => $this->General_model->get_value_by_id('residents',$commented_by,'name'),
							'time' => $rr['insertDate'],
							'nicetime'=>$this->General_model->nicetime2($rr['insertDate'])
						);
						
					}
					
					$curtime = strtotime($messages[0]['time']);
					$ppid = $messages[0]['postID'];
				}
				
				if(!empty($messages) && $curtime != $lasttime){
					$this->output(true, '', array_reverse($messages), $curtime, $ppid);
					break;
				}
				else{
					sleep(1);
				}
			}
		}
		
		public function postMessage(){
			$user = $this->fetch('user');
			$text = urldecode($this->fetch('text'));
			$postID = $this->fetch('postID');
			$condoID = $this->fetch('condoID');

			if(empty($text)){
				$this->output(false, '');
			}
			else{
				$rs = $this->db->query("
					INSERT INTO posts_comments(
						id,
						commented_by,
						post_id,
						comment,
						insertDate
					)
					VALUES(
						'',
						'$user',
						$postID,
						'$text',
						CURRENT_TIMESTAMP
					)
				");
				$post_user_id = $this->General_model->get_value_by_id('posts',$postID,'posted_by');
				//Notification
				$curr_time = time();
				$rs_noti = $this->db->query("
					INSERT INTO notifications(
						id,
						session_id,
						person_id,
						code,
						condo_id,
						insertDate,
						msg_time
					)
					VALUES(
						'',
						'$post_user_id',
						'$this->resident_id',
						'New Comment',
						'$condoID',
						CURRENT_TIMESTAMP,
						'$curr_time'
					)
				");
				
				if($rs && $rs_noti){
					$this->output(true, '');
				}
				else{
					$this->output(false, 'Chat posting failed. Please try again.');
				}
			}
		}
		
		public function fetch($name){
			$val = isset($_POST[$name]) ? $_POST[$name] : '';
			return $val;
		}
		
		public function output($result, $output, $message = null, $latest = null, $ppid=null){
			echo json_encode(array(
				'result' => $result,
				'message' => $message,
				'output' => $output,
				'latest' => $latest,
				'ppid' => $ppid
			));
		}
		
		
	/////////////////////////////////////////////////////////////////
	////////////////SERVICE QUOTES COMMENTS - RESIDENT///////////////
	/////////////////////////////////////////////////////////////////
	
	public function start_poll_quote_comments(){
		$mode = $this->fetch_quote_comments('mode');
			
			switch($mode){
				case 'get':
					$this->getMessage_quote_comments();
					break;
				case 'post':
					$this->postMessage_quote_comments();
					break;
				default:
					$this->output_quote_comments(false, 'Wrong mode.');
					break;
			}
			return;
	}
	
	public function getMessage_quote_comments(){
			$endtime = time() + 20;
			$lasttime = $this->fetch_quote_comments('lastTime');
			$curtime = null;
					
			while(time() <= $endtime){
				$rs = $this->db->query("
					SELECT *
					FROM service_quotes_comments
					ORDER BY insertDate desc
					
				");
				
				if($rs){
					$messages = array();
						foreach($rs->result_array() as $rr){
							$commented_by = $rr['sender'];
							//Set Actor ID
							if($rr['actor'] == 'resident'){
								$actorName = $this->General_model->get_value_by_id('residents',$commented_by,'name');
								$actorImg_fetch = $this->General_model->get_value_by_id('residents',$commented_by,'image_url');
								if($actorImg_fetch == ''){
									$actorImg = base_url().'assets/front/global/img/no-image.jpg';
								} else {
									$actorImg = base_url().'uploads/profile_pictures/'.$actorImg_fetch;
								}
							} else if($rr['actor'] == 'vendor'){
								$actorName = $this->General_model->get_value_by_id('vendors',$commented_by,'name');
								$actorImg_fetch = $this->General_model->get_value_by_id('vendors',$commented_by,'image_url');
								if($actorImg_fetch == ''){
									$actorImg = base_url().'assets/front/global/img/no-image.jpg';
								} else {
									$actorImg = base_url().'uploads/vendor_images/'.$actorImg_fetch;
								}

							} else {
								$actorName = '';
								$actorImg = '';
							}
									
							$messages[] = array(
								'user' => $rr['sender'],
								'service_qoute_id' => $rr['service_qoute_id'],
								'text' => $rr['comment'],
								'pic' => $actorImg,
								'name' => $actorName,
								'actor' => $rr['actor'],
								'time' => $rr['insertDate'],
								'nicetime'=>$this->General_model->nicetime2($rr['insertDate'])
							);	
					}
					
					$curtime = strtotime($messages[0]['time']);
				}
				
				if(!empty($messages) && $curtime != $lasttime){
					$this->output_quote_comments(true, '', array_reverse($messages), $curtime);
					break;
				}
				else{
					sleep(1);
				}
			}
		}
		
		public function postMessage_quote_comments(){
			$user = $this->fetch_quote_comments('user');
			$text = urldecode($this->fetch_quote_comments('text'));
			$actor = $this->fetch_quote_comments('actor');
			$serviceID = $this->fetch_quote_comments('serviceID');
			//Set Actor ID
			if($actor == 'resident'){
				$actorID = $this->General_model->get_value_by_id('service_quotes
	',$serviceID,'quoted_by');
			} else if($actor == 'vendor'){
				$serviceRequestID = $this->General_model->get_value_by_id('service_quotes
	',$serviceID,'service_request_id');
				$actorID = $this->General_model->get_value_by_id('service_requests
	',$serviceRequestID,'requested_by');
			} else {
				$actorID = 0;
			}
			
			if(empty($text)){
				$this->output_quote_comments(false, '');
			}
			else{
				$rs = $this->db->query("
					INSERT INTO service_quotes_comments
(
						id,
						comment,
						sender,
						receiver,
						service_qoute_id,
						actor,
						insertDate
					)
					VALUES(
						'',
						'$text',
						'$user',
						'$actorID',
						'$serviceID',
						'$actor',
						CURRENT_TIMESTAMP
					)
				");
				
				//Notification
				$curr_time_for_vendor = time();
				$rs_noti_for_vendor = $this->db->query("
					INSERT INTO notifications(
						id,
						session_id,
						person_id,
						code,
						condo_id,
						insertDate,
						msg_time
					)
					VALUES(
						'',
						'$actorID',
						'$user',
						'New Chat',
						'0',
						CURRENT_TIMESTAMP,
						'$curr_time_for_vendor'
					)
				");
				
				if($rs){
					$this->output_quote_comments(true, '');
				}
				else{
					$this->output_quote_comments(false, 'Chat posting failed. Please try again.');
				}
			}
		}
		
		public function fetch_quote_comments($name){
			$val = isset($_POST[$name]) ? $_POST[$name] : '';
			return $val;
		}
		
		public function output_quote_comments($result, $output, $message = null, $latest = null, $ppid=null){
			echo json_encode(array(
				'result' => $result,
				'message' => $message,
				'output' => $output,
				'latest' => $latest
			));
		}
	
	
	/////////////////////////////////////////////////////////////////
	////////////////SERVICE QUOTES COMMENTS - VENDOR///////////////
	/////////////////////////////////////////////////////////////////
	
	public function start_poll_quote_comments_vendor(){
		$mode = $this->fetch_quote_comments_vendor('mode');
			
			switch($mode){
				case 'get':
					$this->getMessage_quote_comments_vendor();
					break;
				case 'post':
					$this->postMessage_quote_comments_vendor();
					break;
				default:
					$this->output_quote_comments_vendor(false, 'Wrong mode.');
					break;
			}
			//return;
	}
	
	public function getMessage_quote_comments_vendor(){
			$endtime = time() + 20;
			$lasttime = $this->fetch_quote_comments_vendor('lastTime');
			$curtime = null;
					
			while(time() <= $endtime){
				$rs = $this->db->query("
					SELECT *
					FROM service_quotes_comments
					ORDER BY insertDate desc
					
				");
				
				if($rs){
					$messages = array();
						foreach($rs->result_array() as $rr){
							$commented_by = $rr['sender'];
							//Set Actor ID
							if($rr['actor'] == 'resident'){
								$actorName = $this->General_model->get_value_by_id('residents',$commented_by,'name');
								$actorImg_fetch = $this->General_model->get_value_by_id('residents',$commented_by,'image_url');
								if($actorImg_fetch == ''){
									$actorImg = base_url().'assets/front/global/img/no-image.jpg';
								} else {
									$actorImg = base_url().'uploads/profile_pictures/'.$actorImg_fetch;
								}

							} else if($rr['actor'] == 'vendor'){
								$actorName = $this->General_model->get_value_by_id('vendors',$commented_by,'name');
								$actorImg_fetch = $this->General_model->get_value_by_id('vendors',$commented_by,'image_url');
								if($actorImg_fetch == ''){
									$actorImg = base_url().'assets/front/global/img/no-image.jpg';
								} else {
									$actorImg = base_url().'uploads/vendor_images/'.$actorImg_fetch;
								}

							} else {
								$actorName = '';
								$actorImg = '';
							}
									
							$messages[] = array(
								'user' => $rr['sender'],
								'service_qoute_id' => $rr['service_qoute_id'],
								'text' => $rr['comment'],
								'pic' => $actorImg,
								'name' => $actorName,
								'actor' => $rr['actor'],
								'time' => $rr['insertDate'],
								'nicetime'=>$this->General_model->nicetime2($rr['insertDate'])
							);	
					}
					
					$curtime = strtotime($messages[0]['time']);
				}
				
				if(!empty($messages) && $curtime != $lasttime){
					$this->output_quote_comments_vendor(true, '', array_reverse($messages), $curtime);
					break;
				}
				else{
					sleep(1);
					//$this->output_quote_comments_vendor(true, '', array_reverse($messages), $curtime);
					//break;
				}
			}
		}
		
		public function postMessage_quote_comments_vendor(){
			$user = $this->fetch_quote_comments_vendor('user');
			$text = $this->fetch_quote_comments_vendor('text');
			$actor = $this->fetch_quote_comments_vendor('actor');
			$serviceID = $this->fetch_quote_comments_vendor('serviceID');
			//Set Actor ID
			if($actor == 'resident'){
				$actorID = $this->General_model->get_value_by_id('service_quotes
	',$serviceID,'quoted_by');
			} else if($actor == 'vendor'){
				$serviceRequestID = $this->General_model->get_value_by_id('service_quotes
	',$serviceID,'service_request_id');
				$actorID = $this->General_model->get_value_by_id('service_requests
	',$serviceRequestID,'requested_by');
			} else {
				$actorID = 0;
			}
			
			if(empty($text)){
				$this->output_quote_comments_vendor(false, '');
			}
			else{
				$rs = $this->db->query("
					INSERT INTO service_quotes_comments
(
						id,
						comment,
						sender,
						receiver,
						service_qoute_id,
						actor,
						insertDate
					)
					VALUES(
						'',
						'$text',
						'$user',
						'$actorID',
						'$serviceID',
						'$actor',
						CURRENT_TIMESTAMP
					)
				");
				
				
				if($rs){
					$this->output_quote_comments_vendor(true, '');
				}
				else{
					$this->output_quote_comments_vendor(false, 'Chat posting failed. Please try again.');
				}
			}
		}
		
		public function fetch_quote_comments_vendor($name){
			$val = isset($_POST[$name]) ? $_POST[$name] : '';
			return $val;
		}
		
		public function output_quote_comments_vendor($result, $output, $message = null, $latest = null, $ppid=null){
			echo json_encode(array(
				'result' => $result,
				'message' => $message,
				'output' => $output,
				'latest' => $latest
			));
		}
		
	/////////////////////////////////////////////////////////////////
	/////////////////////NOTIFICATIONS - LONG POLLING////////////////
	/////////////////////////////////////////////////////////////////
	
	
	public function stream_comments(){
		$timestamp = (int) trim( $_GET['timestamp'] );
		$sess_id = (int) trim( $_GET['sess_id'] );
		$condo_id = (int) trim( $_GET['condo_id'] );
		$lastId = isset( $_GET['lastId'] ) && !empty( $_GET['lastId'] ) ? $_GET['lastId'] : 0;

		if( empty( $timestamp ) ){
			die( json_encode( array( 'status' => 'error' ) ) );
		}

		$time_wasted = 0;
		$lastIdQuery = '';
		if( !empty( $lastId ) ){
			$lastIdQuery = ' AND id > ' . $lastId;
		}

		$new_messages_check = $this->db->query("SELECT * FROM notifications WHERE condo_id=$condo_id  and msg_time >= {$timestamp}" . $lastIdQuery ." AND read_noti=0 ORDER BY id DESC");// AND session_id=".$this->session->userdata('resident_id')."
		$num_rows = $new_messages_check->num_rows();
		if($num_rows <=0){
		
			while( $num_rows <= 0 ){
				if( $num_rows <= 0 ){
					
					// 40 Seconds are enough to forbid the request and send another one
					if( $time_wasted >= 60 ){
						die( json_encode( array( 'status' => 'no-results', 'lastId' => 0, 'timestamp' => time() ) ) );
						exit;
					}
					
					sleep( 1 );
					$new_messages_check = $this->db->query("SELECT * FROM notifications WHERE condo_id=$condo_id and msg_time >= {$timestamp}" . $lastIdQuery . " AND read_noti=0 ORDER BY id DESC");// AND session_id=".$this->session->userdata('resident_id')."
					$num_rows = $new_messages_check->num_rows();
					$time_wasted += 1;
				}
			}
		}

		$new_messages = array();
		if( $num_rows >= 1){
			foreach($new_messages_check->result_array() as $row){
				$noti_id = $row['id'];
				$curr_session_id = $row['session_id'];
				$posted_by = $row['person_id'];
				$log_content = $row['code'];
				$facility_id = $this->General_model->get_value_by_id('condo_facilities', $row['facility_id'], 'name');
				
				$display_field_actor = '';
				if($curr_session_id == $sess_id){
					$display_field_actor = 'your';
				} else if($curr_session_id == $posted_by){
					$display_field_actor = 'his/her';
				} else {
					$display_field_actor = $this->General_model->get_value_by_id('residents', $curr_session_id, 'name').'\'s';			}
				if($posted_by == 0){
					$actor = '';	
				} else {
					$actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
				}
					
					
				//if($posted_by!=$sess_id){
					$new_messages[] = array( 
						'id' 			 		=> $row['id'],
						'person_id' 	  		 => $posted_by,  
						'session_id' 	        => $curr_session_id,
						'facility_id'  	       => $facility_id,
						'display_field_actor'   => $display_field_actor,
						'actor'   				 => $actor,
						'code'  		          => $log_content,
						'insertDate'  	        => $row['insertDate'],
						'icount'                => $num_rows
					 );
				//}
			}
		}
		$last_msg = end( $new_messages );
		$last_id = $last_msg['id'];
		
		die( json_encode( array( 'status' => 'results', 'timestamp' => time(), 'lastId' => $last_id, 'data' => $new_messages ) ) );
	}
	
	
	
	public function stream_vendor_notification(){
		$timestamp = (int) trim( $_GET['timestamp'] );
		$sess_id = (int) trim( $_GET['sess_id'] );
		$lastId = isset( $_GET['lastId'] ) && !empty( $_GET['lastId'] ) ? $_GET['lastId'] : 0;

		if( empty( $timestamp ) ){
			die( json_encode( array( 'status' => 'error' ) ) );
		}

		$time_wasted = 0;
		$lastIdQuery = '';
		if( !empty( $lastId ) ){
			$lastIdQuery = ' AND id > ' . $lastId;
		}

		$new_messages_check = $this->db->query("SELECT * FROM notifications WHERE session_id=$sess_id and code='New Chat' and msg_time >= {$timestamp}" . $lastIdQuery ." ORDER BY id DESC");
		$num_rows = $new_messages_check->num_rows();
		if($num_rows <=0){
		
			while( $num_rows <= 0 ){
				if( $num_rows <= 0 ){
					
					// 40 Seconds are enough to forbid the request and send another one
					if( $time_wasted >= 60 ){
						die( json_encode( array( 'status' => 'no-results', 'lastId' => 0, 'timestamp' => time() ) ) );
						exit;
					}
					
					sleep( 1 );
					$new_messages_check = $this->db->query("SELECT * FROM notifications WHERE session_id=$sess_id and code='New Chat' and msg_time >= {$timestamp}" . $lastIdQuery ." ORDER BY id DESC");
					$num_rows = $new_messages_check->num_rows();
					$time_wasted += 1;
				}
			}
		}

		$new_messages = array();
		if( $num_rows >= 1){
			foreach($new_messages_check->result_array() as $row){
				$noti_id = $row['id'];
				$curr_session_id = $row['session_id'];
				$posted_by = $row['person_id'];
				$log_content = $row['code'];
				
				$display_field_actor = '';
											
				$display_field_actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
			
				$display_field ='';
				  if($log_content == 'New Chat'){
					  $display_field = 'sent you a new message';
				  } 
					
				//if($posted_by!=$sess_id){
					$new_messages[] = array( 
						'id' 			 		=> $row['id'],
						'person_id' 	  		 => $posted_by,  
						'session_id' 	        => $curr_session_id,
						'display_field_actor'   => $display_field_actor,
						'code'  		          => $display_field,
						'insertDate'  	        => $row['insertDate'],
						'icount'                => $num_rows
					 );
				//}
			}
		}
		$last_msg = end( $new_messages );
		$last_id = $last_msg['id'];
		
		die( json_encode( array( 'status' => 'results', 'timestamp' => time(), 'lastId' => $last_id, 'data' => $new_messages 		) ) );
	}
	
}
	
	//new Chatter();