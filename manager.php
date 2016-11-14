<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	
	
	var $data;
	var $url;
	var $manager_id;
	var $access_level;

	public function __construct(){

		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
		$this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->manager_id=$this->session->userdata('manager_id');
		$this->access_level=$this->session->userdata('access_level');
		$this->condo_id=$this->session->userdata('condo_id');
		$this->load->model('Authentication_model');
		$this->load->model('General_model');
	}
	
	public function index()
	{
	
 		if($this->session->userdata('manager_id')!=""){
			redirect('manager/dashboard');
		}
		
		
		$this->data['title']='Manager| Log in';
		$this->load->view('manager/login',$this->data);
	}
	
	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	
	
	public function check_login(){
		//echo 'success';
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Authentication_model->user_authentication_login($email, $password)){
			if($this->Authentication_model->active_account_check($email, $password)){
			  if($this->Authentication_model->manager_condo_active_check($email, $password)){
				echo 'active';
			  }
			  else
			  {
				  echo 'condo inactive';
			  }
			} else {
				echo 'notactive';
			}
		} else {
			echo 'fail';
		}
	}
	//Check Email existance
	public function check_data_exists($field, $table){
		if(isset($_POST['current_name']) && $_POST['current_name']==$_POST[$field])
		{
			echo json_encode(TRUE);
		}
		elseif (array_key_exists($field,$_POST)) {
			if ( $this->Authentication_model->data_exists($field, $this->input->post($field), $table) == FALSE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}
	
	//Check Password(MD5) existance
	public function check_data_exists_md5($field, $table){
		if (array_key_exists($field,$_POST)) {
			if ( $this->Authentication_model->data_exists_md5($field, $this->input->post($field), $table) == TRUE ) {
				echo json_encode(TRUE);
			} else {
				echo json_encode(FALSE);
			}
		}
	}
	
	//Check email existance for forgot password
	public function check_data_exists_forgot_pass($field, $table){
		if (array_key_exists($field,$_POST)) {
			if ( $this->Authentication_model->data_exists_forgot_pass($field, $this->input->post('email_forgot'), $table) == TRUE ) {
				echo json_encode(TRUE);
			} else {
				echo json_encode(FALSE);
			}
		}
	}

	/******************************************************************************************/
	//////////////////////////////////////// END LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	
	
	public function dashboard()
	{
		
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		$this->data['residents']=$this->General_model->get_data_all_like_using_where('residents',"status=0 AND condo_id=".$this->condo_id);
		$this->data['adverts']=$this->General_model->get_data_all_like_using_where('adverts',"payment_status=1");
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts',"status=1 AND condo_id=".$this->condo_id);
		$action = " between '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59') AND condo_id=$this->condo_id";
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests', "(deliverydatetime".$action);
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where('visitor_requests', "(visitdatetime".$action);
		
		$this->data['title']='Manager | Dashboard';
		$this->data['view']			='manager/dashboard';
		//$this->load->view('manager/template/main',$this->data);
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function approve_resident()
	{
		
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$ver = $this->General_model->get_data_all_like_using_where('residents',"id='$id'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Approved';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array($status);
			$whereClouse = "id='$id'";
			
			//
			//Collect Email Data
				$subject_first = "ALIA - Application approved";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"name").", <br />

				Welcome to the ALIA community.<br />";
				if($status =='1')
				{
					$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
					//
					$message_first.= "Your Email is ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"email")."<br />
					We are happy to have you on this journey towards building a smarter, safer, and sustainable 
					community.<br /><br />Our mission is to help you on your property management matters so that you can get things done with less 
					work.<br /><br />
					<a href='".base_url()."home/confirm_resident/".$this->General_model->get_data_value_using_where('residents',$whereClouse,"verify_code")."'>Click here</a> to Confirm And login.";
					$message_first.= "<br /><br />
				</div>
					";
					echo "Approved";
				}
				else
				{
					$ver =$this->General_model->delete_data($id, 'residents');
					//
					$message_first.= "Soory your account not approved.<br /><br />
				</div>";
					echo "DissApproved";
				}
				
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',$whereClouse,"email"), $this->General_model->get_data_value_using_where('residents',$whereClouse,"name"), $subject_first, $message_first);
			
		}
		else
		{
			echo 'Email Not Approved';
		}
	}
	
	public function incident_status()
	{
		
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$updateDbFieldsAry = array('status','resolved_date');
		$updateInfoAry = array($status, date('Y-m-d H:i:s'));
		$whereClouse = "id='$id'";
		$upd =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'incident_reporting');
		
		$ver =$this->General_model->get_data_row_using_where('incident_reporting',"id='$id'");
			$this->data['message']='Complaint Resolved';
			//
			//Collect Email Data
				$subject_first = "ALIA - Complaint Resolved";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',"id=$ver->reported_by","name").", <br />

				Welcome to the ALIA community.<br />
				
				
				Your Complaint Has been Resolved Now. Thank you for using ALIA.<br /><br />
				Complain Details: $ver->description<br><br>
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',"id=$ver->reported_by","email"), $this->General_model->get_data_value_using_where('residents',"id=$ver->reported_by","name"), $subject_first, $message_first);
	}
	public function approve_post()
	{
		
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array($status);
		$whereClouse = "id='$id'";
		$upd =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'posts');
		
		$ver =$this->General_model->get_data_row_using_where('posts',"id='$id'");
			$this->data['message']='Post Approved';
			if($status==1){ $app = "Approved Now";} else{ $app = "DisApproved";}
			//
			//Collect Email Data
				$subject_first = "ALIA - Post $app";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',"id=$ver->posted_by","name").", <br />

				Welcome to the ALIA community.<br />
				
				
				Your Post Has been $app. Thank you for using ALIA.<br /><br />
				Post Details: $ver->description<br><br>
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',"id=$ver->posted_by","email"), $this->General_model->get_data_value_using_where('residents',"id=$ver->posted_by","name"), $subject_first, $message_first);
	}

	
	public function incident_log()
	{
		
		$id =  $this->input->post('id');
		$ver =$this->General_model->get_data_row_using_where('incident_reporting',"id='$id'");
		echo $ver->incident_log;
	}
	
	public function incident_log_sub()
	{
		
		$incident_id =  $this->input->post('incident_id');
		$incident_log =  $this->input->post('incident_log');
		
		$updateDbFieldsAry = array('incident_log');
		$updateInfoAry = array($incident_log);
		$whereClouse = "id='$incident_id'";
		$upd =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'incident_reporting');
	}
	
	public function close_account($verify_code)
	{
		$ver =$this->General_model->get_data_all_like_using_where('residents',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Account Closed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('2');
			$whereClouse = "verify_code='$verify_code'";
			//
			//Collect Email Data
				$subject_first = "ALIA - Account Closed";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"name").", <br />

				Welcome to the ALIA community.<br />
				
				
				Your Account has been closed Now. Thank you for using ALIA.<br /><br />
				
				Your Email is ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"email")."<br /><br />
				
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',$whereClouse,"email"), $this->General_model->get_data_value_using_where('residents',$whereClouse,"name"), $subject_first, $message_first);
				
			$ver =$this->General_model->delete_data_using_where('verify_code', $verify_code, 'residents');
			
		}
		else
		{
			$this->data['message']='Account Not closed';
		}
		 
		
		
		$this->data['title']='Manager | Close Account';
		$this->load->view('manager/close_account',$this->data);
	}
	public function condo()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['editcondoprof'])){
			$date_time = date('Y-m-d H:i:s');
			
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			$phone 				= $this->input->post('phone');
			$mobile 			= $this->input->post('mobile');
			$address 			= $this->input->post('address');
			$city 				= $this->input->post('city');
			$state 				= $this->input->post('state');
			$post_code 			= $this->input->post('post_code');
			$condo_picture_url 	= $this->input->post('condo_picture');
	
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = $_FILES['condo_picture']['name'];
			$original_filename = '';
			if($_FILES['condo_picture']['name']!= ''){
			     $upload_path = "uploads/condos/condo_pictures/";
			     $file_type = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				
				if($this->upload->do_upload('condo_picture')){
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
				   } 
			} else {
				$original_filename =  $this->General_model->get_value_by_id_empty('condos', $id, 'condo_picture');
			}
			
 		$DbFieldsArray 		= array('name','phone', 'mobile', 'address', 'areas', 
									'state', 'postcode', 'condo_picture', 'registered_on', 'status');
		
		$DataArray = array($name, $phone, $mobile, $address, $city, $state, $post_code, $original_filename, $date_time, '1');
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condos');
		redirect('manager/condo'); 
		
		}
		
		$this->data['title']='Manager | Condo Profile';
		$this->data['view']='manager/condo';
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function profile(){
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['manprofsubmit'])){
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			$phone 				= $this->input->post('phone');
			
		$DbFieldsArray 		= array('full_name', 'phone');
		$DataArray = array($name, $phone);
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condo_admins');
		redirect('manager/profile'); 
		}
		
		$this->data['title']='Manager | Profile';
		$action = "id = '$this->manager_id'";
		$this->data['manager_info']= $this->General_model->get_data_row_using_where('condo_admins', $action);
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['view']='manager/profile';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email'";
				$condo_info_admins = $this->General_model->get_data_row_using_where('condo_admins',$action);
				$condo_alpha_name_id = $condo_info_admins->id;
				$condo_alpha_name_admins = $condo_info_admins->full_name;
				
				$DbFieldsArray 		= array('forgot_pass_count');
				$DataArray = array('0');
				$this->General_model->updateData($email,'email',$DbFieldsArray,$DataArray,'condo_admins');
				
				$verification_code_id = base64_encode($condo_alpha_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."manager/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Forgot Password Link";
				$message = "Dear ".$condo_alpha_name_admins.", <br />
				You have requested for Forgot Password Option.<br/><br/>

				Click the below link to change your password.<br/>
				".$verification_link."<br/><br/>
				";

				//Send Forgot Password Link
				/*if($condo_info_admins->notification_alert==2)
				{
					$this->load->library('clickatel');
					$this->clickatel->send_sms($condo_info_admins->phone, $message);
				}
				else
				{*/
					$this->email($email, $condo_alpha_name_admins, $subject, $message);
				/*}*/
				echo 'LINKSENT';
				}
		
	}
	
	public function forgot_password_change($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		//Grab Condo Admin Forgot Password Link Count info
		$action = "id = '$verification_code_id_decode'";
		$condo_info_admins = $this->General_model->get_data_row_using_where('condo_admins',$action);
		$condo_forgot_pass_count = $condo_info_admins->forgot_pass_count;
		
		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";
		if($get_key_id = $this->General_model->update_data_using_multiwhere_custom($where, $action_to_be_filled, 'condo_admins')){
			$this->data['verify_data'] = $get_key_id;
		} else {
			$this->data['verify_data'] = 'USED';
		}
		
		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condo_admins');
		redirect('manager'); 
		}
		
		$this->data['title']='Manager | Forgot Password Change';
		$this->load->view('manager/forgot_password_change',$this->data);
	}
	
	public function change_password(){
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condo_admins');
		redirect('manager/change_password'); 
		}
		
		$this->data['title']='Manager | Change Password';
		$action = "id = '$this->manager_id'";
		$this->data['manager_info']= $this->General_model->get_data_row_using_where('condo_admins', $action);
		$this->data['view']='manager/change_password';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function set_upload_options($upload_path, $file_type){   
		// upload image options
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $file_type;
		$config['overwrite']     = FALSE;
		return $config;
	}
	
	public function email($to_email, $to_name, $subject, $message, $attachment=''){
	
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$msg_append = $message;
		$msg_append.=$this->config->item('email_footer');
		$this->data['view_data'] = $msg_append;
		$this->email->from($this->config->item('email_from'), $this->config->item('email_from_name'));
        $this->email->to($to_email); 
		$this->email->subject($subject);
		$msg = $this->load->view('alpha/email_template/main',$this->data, TRUE);
		$this->email->message($msg);	
		$this->email->send();
	}
	
	public function do_logout(){
        $this->session->sess_destroy();
		$this->session->unset_userdata('manager_id');    
		redirect('manager');
    }
	public function delete_data()
	{
		$get_email_data = $this->General_model->delete_data($_POST['id'],$_POST['table']);
		if(isset($_POST['image_url']))
		{
			$file = dirname(dirname(dirname(__FILE__)))."/uploads/".$_POST['image_url'];
			if (!unlink($file))
			  {
			  echo ("Error deleting $file");
			  }
			else
			  {
			  echo ("Deleted $file");
			  }
		}
		
	}
	
	public function confirm_resident($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('residents',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Confirmed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('1');
			$whereClouse = "verify_code='$verify_code'";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
		}
		else
		{
			$this->data['message']='Email Not Confirmed';
		}
		 
		
		if(isset($_POST['change_password_btn'])){
			$new_password 		= $this->input->post('password');
			
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($verify_code,'verify_code',$DbFieldsArray,$DataArray,'residents');
			//
			$this->db->where('verify_code',$verify_code);
			$this->db->where('password',md5($new_password));		
			$query=$this->db->get('residents');
			if($query->num_rows==1)
			{
				$row = $query->row();
				$data = array(
                    'resident_id'     => $row->id,
					'email'           => $row->email,
					'type'            => $row->type,
					'name'   	      => $row->name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('resident');  
		}
		
		$this->data['title']='Manager | Confirm Resident';
		$this->load->view('manager/confirm_resident_change',$this->data);
	}
	public function residents()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//$this->data['residents']=$this->General_model->get_data_all('residents');
		$thismanager = $this->General_model->get_data_all_like_using_where('condo_admins',"id=".$this->session->userdata('manager_id'));
		if(sizeof($thismanager)>0){$thismanagerCondo= $thismanager[0]['condo_id'];}else{$thismanagerCondo= 0;}
		$this->data['residents']=$this->General_model->get_data_all_like_using_where('residents',"condo_id=".$thismanagerCondo);
		//
		$this->data['title']='Manager | Residents';
		$this->data['view']='manager/residents';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function add_resident()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['add_resident_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'name'           =>	$this->input->post('name'),
					  'condo_id'       =>	$this->session->userdata('condo_id'),
					  'email'          =>	$this->input->post('email'),
					  'phone'          =>	$this->input->post('phone'),
					  'verify_code'    =>	md5($this->input->post('email')),
					  'type'           =>	$this->input->post('type'),
					  'block'          =>	$this->input->post('block'),
					  'floor'          =>	$this->input->post('floor'),
					  'unit'           =>	$this->input->post('unit'),
					  'date_registered'=>	date('Y-m-d'),
					  'password'       =>	md5($password)
					  );
					  $get_email_data = $this->General_model->addData_array($data, 'residents');
					
				
				$subject_second = "Welcome to ALIA - Your Life Style & Property Solutions";
				$message_second = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />

				Welcome to the ALIA community.<br />
				
				Your Email is ".$this->input->post('email')."<br />
				You will be Soon Notified Once you are approved by Admin.<br /><br />
				</div>
				";
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_second, $message_second);
				
				redirect("manager/residents");
		}
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Manager | Add Resident ';
		$this->data['view']='manager/add_resident';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function edit_resident($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['edit_resident_btn'])){
			$data=array(	  
					  'name'           =>	$this->input->post('name'),
					  'condo_id'       =>	$this->session->userdata('condo_id'),
					  'email'          =>	$this->input->post('email'),
					  'phone'          =>	$this->input->post('phone'),
					  'type'           =>	$this->input->post('type'),
					  'block'          =>	$this->input->post('block'),
					  'floor'          =>	$this->input->post('floor'),
					  'unit'           =>	$this->input->post('unit'),
					  );
					  if($_POST['password']!='')
					  {
						  $data['password']= md5($this->input->post('password'));
					  }
					$get_email_data = $this->General_model->updateData_array($data, 'residents', $id);
					$result['msg']		=	"success";
					redirect("manager/residents");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'residents');
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Manager | Update Resident ';
		$this->data['view']='manager/edit_resident';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function change_floors()
	{
		
		$id = $this->input->post('id');
		$condos=$this->General_model->get_data_row_using_where('blocks',"id = $id");
		echo json_encode($condos);
		//echo $condos->floors;
	}
	public function import_residents()

	{

		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}

		$lead_html='';

		// Check if image file is a actual image or fake image

		if(isset($_POST["submit"])) {

			$target_dir = "uploads/";

			$target_file = $target_dir . basename($_FILES["filetoupload"]["name"]);

			$uploadOk = 0;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			 if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {

				 $file = fopen($target_file, 'r');

				 $n=0;
						 $lead_html.='<tr><td colspan="7"> Following Rows are Added</td></tr>';
						 $lead_html.='<tr><td>Name</td><td>Email</td><td>Phone</td><td>block</td><td>floor</td><td>unit</td><td>type</td></tr>';
					while (($line = fgetcsv($file)) !== FALSE) 
					{
						
						if ( $this->Authentication_model->data_exists('email', $line[1], 'residents') == TRUE ) 
							{
							  $data=array(	  
								'name'           =>	$line[0],
								'condo_id'       =>	$this->session->userdata('condo_id'),
								'email'          =>	$line[1],
								'verify_code'    =>	md5($line[1]),
								'phone'          =>	$line[2],
								'block'          =>	$line[3],
								'floor'          =>	$line[4],
								'unit'           =>	$line[5],
								'type'           =>	$line[6],
								'date_registered'=>	date('Y-m-d'),
								);
								  $get_email_data = $this->General_model->addData_array($data, 'residents');
							  
								 //Collect Email Data
								  $subject_first = "Welcome to ALIA - Your Life Style & Property Solutions";
								  $message_first = "<div style='".$this->config->item('style')."'>Hello ".$line[0].", <br />
				  
								  Welcome to the ALIA community.<br /><br />
								  
								  Your Email is ".$line[1]."<br /><br />
								  
								  <a href='".base_url()."manager/confirm_resident/".md5($line[1])."'>Click here</a> to Confirm And login .<br />
								  We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br />
								  Our mission is to help you on your property management matters so that you can get things done with less work.
								  <br /><br /></div>
								  ";
								  
								  //Send Welcome Email
								  $this->email($line[1], $line[0], $subject_first, $message_first);
								  //Show Inserted Rows
								  
								  $lead_html.='<tr><td>'.$line[0].'</td><td>'.$line[1].'</td><td>'.$line[2].'</td><td>'.$line[3].'</td><td>'.$line[4].'</td><td>'.$line[5].'</td><td>'.$line[6].'</td></tr>';
								$n++;
							}
							
					} 
					fclose($file);

				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			} else {

				$this->session->set_flashdata("failure_message", "Sorry, there was an error uploading your file.");

			}
			$this->session->set_flashdata('success_message', "$n Rows are Added");
			redirect('manager/residents');

		}

		//exit;
		$this->data['import_residents']=$lead_html;
		$this->data['title']='Manager | Import';
		$this->data['view']='manager/import_residents';
		$this->load->view('manager/template/main',$this->data);

	}
	
	
	public function users()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$this->data['users']=$this->General_model->get_data_all_using_where('condo_id',$this->condo_id,'condo_admins');
		//
		$this->data['title']='Manager | Users';
		$this->data['view']='manager/users';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function incidents()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$action = "condo_id=$this->condo_id";// AND status=0
		$this->data['reports']=$this->General_model->get_data_all_like_using_where('incident_reporting', $action);
		//
		$this->data['title']='Manager | Incidents';
		$this->data['view']='manager/incidents';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function posts()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$action = "condo_id=$this->condo_id AND status=0";// 
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);
		//
		$this->data['title']='Manager | Posts';
		$this->data['view']='manager/posts';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function confirm_user($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('condo_admins',"verify_code='$verify_code' AND role =1");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Confirmed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('1');
			$whereClouse = "verify_code='$verify_code' AND role =1";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'condo_admins');
		}
		else
		{
			$this->data['message']='Email Not Confirmed';
		}
		 
		
		if(isset($_POST['change_password_btn'])){
			$new_password 		= $this->input->post('password');
			
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($verify_code,'verify_code',$DbFieldsArray,$DataArray,'condo_admins');
			//
			$this->db->where('verify_code',$verify_code);
			$this->db->where('password',md5($new_password));		
			$query=$this->db->get('condo_admins');
			if($query->num_rows==1)
			{
				$row = $query->row();
				$data = array(
                    'manager_id'     => $row->id,
					'email'           => $row->email,
					'type'            => $row->role,
					'full_name'   	  => $row->full_name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('manager'."?next=".$this->url);  
		}
		
		$this->data['title']='Manager | Confirm Manager';
		$this->load->view('manager/confirm_user',$this->data);
	}
	public function add_user()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['add_user_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'full_name'           =>	$this->input->post('full_name'),
					  'condo_id'        	=>	$this->condo_id,
					  'email'          		=>	$this->input->post('email'),
					  'role'          		=>	$this->input->post('role'),
					  'status'          	=>	'0',
					  'verify_code'         =>	md5($this->input->post('email')),
					  'password'        	=>	md5($password),
					  'registered_on'       =>	date('Y-m-d')
					  );
					  $get_email_data = $this->General_model->addData_array($data, 'condo_admins');
					
					//Collect Email Data
				if($this->input->post('role')==1){ $controller = 'manager';}else{$controller = 'security';}
				$subject_first = "Welcome to ALIA - Your Life Style & Property Solutions";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />

				Welcome to the ALIA community.<br /><br />
				
				Your Email is ".$this->input->post('email')."<br /><br />
				
				Your password is ".$password.".<br /><br />
				
				<a href='".base_url().$controller."/confirm_user/".md5($this->input->post('email'))."'>Click here</a> to Confirm And login .<br /><br />
				We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br /><br />
				Our mission is to help you on your property management matters so that you can get things done with less work.<br /><br />
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
				redirect("manager/users");
		}
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['title']='Manager | Add User ';
		$this->data['view']='manager/add_user';
		$this->load->view('manager/template/main',$this->data);
	}
	public function notification_alert()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['add_notification_alert_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'notification_alert' =>	$this->input->post('notification_alert')
					  );
			    $this->General_model->updateData_array($data, 'condo_admins', $this->session->userdata('manager_id'));
				redirect("manager/notification_alert");
		}
		if(isset($_POST['add_delivery_time_btn'])){
			$delivery_time_starts  = explode(' ',$this->input->post('delivery_time_starts'));
			$delivery_time_starts2 = explode(':',$this->input->post('delivery_time_starts'));
			if($delivery_time_starts[1]=='PM')
			{
				$hour = substr($delivery_time_starts2[0],0,2);
				$hour = $hour+12;
				$minut = substr($delivery_time_starts2[1],0,2);
				$starttime = "$hour:$minut:00";
			}
			else
			{
				$hour = substr($delivery_time_starts2[0],0,2);
				$minut = substr($delivery_time_starts2[1],0,2);
				$starttime = "$hour:$minut:00";
			}
			//
			//End time calculations
			$delivery_time_ends  = explode(' ',$this->input->post('delivery_time_ends'));
			$delivery_time_ends2 = explode(':',$this->input->post('delivery_time_ends'));
			if($delivery_time_ends[1]=='PM')
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$hour = $hour+12;
				$minut = substr($delivery_time_ends2[1],0,2);
				$endtime = "$hour:$minut:00";
			}
			else
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$minut = substr($delivery_time_ends2[1],0,2);
				$endtime = "$hour:$minut:00";
			}
			$data=array(	  
					  'delivery_time_starts' =>	$starttime,
					  'delivery_time_ends' =>	$endtime
					  );
				//echo "<pre>";print_r($data);
			    $this->General_model->updateData_array($data, 'condo_admins', $this->session->userdata('manager_id'));
				redirect("manager/notification_alert");
		}
		$this->data['title']='Manager | Notification Alert ';
		$this->data['view']='manager/notification_alert';
		$this->load->view('manager/template/main',$this->data);
	}
	public function edit_user($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['edit_user_btn'])){
			$data=array(	  
			  'full_name'           =>	$this->input->post('full_name'),
			  'condo_id'        =>	$this->input->post('condo'),
			  'email'          		=>	$this->input->post('email'),
			  'role'          		=>	$this->input->post('role'),
			  );
			  if($_POST['password']!='')
			  {
				  $data['password']= md5($this->input->post('password'));
			  }
			$get_email_data = $this->General_model->updateData_array($data, 'condo_admins', $id);
			$result['msg']		=	"success";
			redirect("manager/users");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'condo_admins');
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['title']='Manager | Update User ';
		$this->data['view']='manager/edit_user';
		$this->load->view('manager/template/main',$this->data);
	}
	public function reset_password($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('manager');
		}
		
		if(isset($_POST['reset_password_btn'])){
			$data=array(	  
					  'password'          		=>	md5($this->input->post('password'))
					  );
							$get_email_data = $this->General_model->updateData_array($data, 'admin', $id);
					$result['msg']		=	"success";
					redirect("manager/users");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'admin');
		$this->data['title']='Manager | Update Password ';
		$this->data['view']='manager/reset_password';
		$this->load->view('manager/template/main',$this->data);
	}
	public function blocks()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}

		$this->data['condo_blocks']=$this->General_model->get_data_all_using_where('condo_id',$this->condo_id,'blocks');
		$this->data['title']='Manager | Blocks';
		$this->data['view']='manager/blocks';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function blocks_copy()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}

		$this->data['condo_blocks']=$this->General_model->get_data_all_using_where('condo_id',$this->condo_id,'blocks');
		$this->data['title']='Manager | Blocks';
		$this->data['view']='manager/blocks_copy';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function add_block()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if(isset($_POST['add_block_btn']))
		{
			$post_data = array('name' => $this->input->post('name'),
							   'condo_id' => $this->session->userdata('condo_id'),
							   'floors' => $this->input->post('floors'),
							   'units' => $this->input->post('units'));
			$get_email_data = $this->General_model->addData_array($post_data,'blocks');
			redirect("manager/blocks");
		}
		

		$this->data['title']='Manager | Add Block ';
		$this->data['view']='manager/add_block';
		$this->load->view('manager/template/main',$this->data);
	}	
	
	
	public function edit_block($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if(isset($_POST['edit_block_btn']))
		{
			$post_data = array('name' => $this->input->post('name'),
			   /*'condo_id' => $this->session->userdata('condo_id'),*/
			   'floors' => $this->input->post('floors'),
			   'units' => $this->input->post('units'));
			$get_email_data = $this->General_model->updateData_array($post_data,'blocks', $id);
			redirect("manager/blocks");
		}
		

		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'blocks');
		$this->data['title']='Manager | Edit Block ';
		$this->data['view']='manager/edit_block';
		$this->load->view('manager/template/main',$this->data);
	}	
	
	public function edit_field()
	{
		$select = '';
		$select.='<form method="post" action="'.base_url().'admin/edit_field_value" >';
		$select.='<input type="text" name="changed_name" class="form-control" value="'.$_POST['current_value'].'" ';
		$select.='onblur="edit_field_value(&#39;'.$_POST['id'].'&#39;, &#39;'.$_POST['field'].'&#39;, this.value, &#39;'.$_POST['table'].'&#39;';
		$select.=')">';
		$select.='<input type="hidden" name="id" value="'.$_POST['id'].'">';
		$select.='<input type="hidden" name="field" value="'.$_POST['field'].'">';
		$select.='<input type="hidden" name="table" value="'.$_POST['table'].'">';
		$select.='</form>';
		echo $select;
	}
	public function edit_field_value()
	{
		$id 				= $this->input->post('id');
		$field         		= $this->input->post('field');
		$changed_name       = $this->input->post('changed_name');
		$table       = $this->input->post('table');
		$this->General_model->edit_lead_doubleclick($id, $field, $changed_name, $table);
		echo $changed_name;
	}
	
	//Testing Send SMS
	public function send_sms()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		$this->data['last_sms_id'] = '';
		$this->load->library('clickatel');
		if(isset($_POST['send_sms_btn'])){
			$number = $this->input->post('number');
			if($number != ''){
				
		
				// Send the message
				$this->clickatel->send_sms($number, 'This is a test message');
		
				// Get the reply
				$this->data['last_sms_id'] = $this->clickatel->last_reply();
				
				
			}
		}
		
		$this->data['title']='Manager | Send SMS';
				$this->data['view']='manager/send_sms';
				$this->load->view('manager/template/main',$this->data);
	}
	
	
	
} 