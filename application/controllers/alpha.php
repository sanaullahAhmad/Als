<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alpha extends CI_Controller {
	
	var $data;
	var $alpha_id;
	var $access_level;

	public function __construct(){

		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		
		$this->alpha_id=$this->session->userdata('alpha_id');
		$this->access_level=$this->session->userdata('access_level');
		$this->load->model('Alpha_model');
		$this->load->model('General_model');
		$this->load->model('encrypt_model');
	}
	
	public function index()
	{
	
 		if($this->session->userdata('alpha_id')!=""){
			redirect('alpha/dashboard');
		}
		
		
		$this->data['title']='Alpha | Log in';
		$this->load->view('alpha/login',$this->data);
	}
	
	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	//Login Check
	public function check_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Alpha_model->user_authentication_login($email, $password)){
			if($this->Alpha_model->active_account_check($email, $password)){
				echo 'active';
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
			if ( $this->Alpha_model->email_exists($field, $this->input->post($field), $table) == FALSE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}
	
	//Check Email existance
	public function check_premium_ads_count(){
		if($_POST['ad_type']=='Premium')
		{
			if ( $this->General_model->get_data_all_like_using_where_count('advertisements', "ad_type='Premium'") > 1 ) {
				if(isset($_POST['ad_type_saved']) && $_POST['ad_type_saved']=='Premium')
				{
					echo json_encode(TRUE);
				}
				else
				{
					echo json_encode(FALSE);
				}
			} else {
				echo json_encode(TRUE);
			}
		}
		else
		{
			echo json_encode(TRUE);
		}
		
	}
	
	//Check Password(MD5) existance
	public function check_data_exists_md5($field, $table){
		if (array_key_exists($field,$_POST)) {
			if ( $this->Alpha_model->data_exists_md5($field, $this->input->post($field), $table) == TRUE ) {
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
		
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha');
		}
		
		$this->data['title']='Alpha | Dashboard';
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['view']='alpha/dashboard';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function add_condo()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_condo'));
		}
		
		if(isset($_POST['add_condo_btn'])){
			$date_time = date('Y-m-d H:i:s');
			
			$name 				= $this->input->post('name');
			$code 				= $this->input->post('code');
			$email 				= $this->input->post('email');
			$phone 				= $this->input->post('phone');
			$mobile 			= $this->input->post('mobile');
			$address 			= $this->input->post('address');
			$areas 				= $this->input->post('areas');
			$state 				= $this->input->post('state');
			$post_code 			= $this->input->post('post_code');
			$privacy 			= $this->input->post('privacy');
			$logo_url 			= $this->input->post('logo');
			$condoimg_url 		= $this->input->post('condoimg');
	
			 //For file upload
			$this->load->library('upload');
			
			//For Condo Logo
			$files = $_FILES;
			$cpt = $_FILES['logo']['name'];
			$original_filename = '';
			if($_FILES['logo']['name']!= ''){
			     $upload_path = "uploads/condos/condo_logos/";
			     $file_type = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				
				if($this->upload->do_upload('logo')){
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
				   } 
				} else {
					$original_filename =  $this->upload->display_errors();
				}
				
			//For Condo Pictures
			$files_condo = $_FILES;
			$cpt_condo = $_FILES['condoimg']['name'];
			$original_filename_condo = '';
			if($_FILES['condoimg']['name']!= ''){
			     $upload_path_condo = "uploads/condos/condo_pictures/";
			     $file_type_condo = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path_condo, $file_type_condo));
				
				if($this->upload->do_upload('condoimg')){
					$uploaddata_condo = $this->upload->data();
					$result_condo['filename'] = $uploaddata_condo['file_name'];
					$original_filename_condo = $result_condo['filename'];
				   } 
				} else {
					$original_filename_condo =  $this->upload->display_errors();
				}
			
 		$DbFieldsArray 		= array('name', 'code', 'email','phone', 'mobile', 'address', 'areas', 
									'state', 'postcode', 'privacy', 'logo', 'condo_picture', 'registered_on', 'status');
		
		$DataArray = array($name, $code, $email, $phone, $mobile, $address, $areas, $state, $post_code, $privacy, $original_filename, $original_filename_condo, $date_time, '1');
		$last_inserted_id = $this->General_model->addData_InsertID($DbFieldsArray,$DataArray,'condos');
		
			if($last_inserted_id != ''){
				$verify_email_code = md5($email);
				$DbFieldsArray_condoadmins 		= array('condo_id', 'full_name', 'email', 'password', 'verify_code', 'registered_on', 
									 'status', 'role', 'is_primary_manager');
				$pass = rand();	
				$DataArray_condoadmins = array($last_inserted_id, 'USER', $email, md5($pass), $verify_email_code, $date_time, '0', '1', '1');
				$last_inserted_id_condoadmins = $this->General_model->addData_InsertID($DbFieldsArray_condoadmins,$DataArray_condoadmins,'condo_admins');
				
				//Add Condo Settings
				//Setting 1
				$DbFieldsArray_settings1 		= array('condo_id', 'name', 'key_id', 'value', 'added_date', 
									 'access_level_id', 'updated_by');
				$DataArray_settings1 = array($last_inserted_id, 'Merchant ID', 'merchant_id', '', date('Y-m-d H:i:s'), '1', $this->alpha_id);
				$this->General_model->addData_InsertID($DbFieldsArray_settings1,$DataArray_settings1,'condo_settings');
				
				//Setting 2
				$DbFieldsArray_settings2 		= array('condo_id', 'name', 'key_id', 'value', 'added_date', 
									 'access_level_id', 'updated_by');
				$DataArray_settings2 = array($last_inserted_id, 'Verification Key', 'verify_key', '', date('Y-m-d H:i:s'), '1', $this->alpha_id);
				$this->General_model->addData_InsertID($DbFieldsArray_settings2,$DataArray_settings2,'condo_settings');
				
				//Setting 3
				$DbFieldsArray_settings3 		= array('condo_id', 'name', 'key_id', 'value', 'added_date', 
									 'access_level_id', 'updated_by');
				$DataArray_settings3 = array($last_inserted_id, 'Condo Logo', 'condo_logo', 0, date('Y-m-d H:i:s'), '1', $this->alpha_id);
				$this->General_model->addData_InsertID($DbFieldsArray_settings3,$DataArray_settings3,'condo_settings');
								
				//Setting 4
				/*$DbFieldsArray_settings4 		= array('condo_id', 'name', 'key_id', 'value', 'added_date', 
									 'access_level_id', 'updated_by');
				$DataArray_settings4 = array($last_inserted_id, 'Processing Fee', 'processing_fee', '', date('Y-m-d H:i:s'), '1', $this->alpha_id);
				$this->General_model->addData_InsertID($DbFieldsArray_settings4,$DataArray_settings4,'condo_settings');*/
					
				//Grab Condo info
				$condo_info = $this->General_model->get_data_by_id($last_inserted_id,'condos');
				$condo_alpha_name = $condo_info->name;
				$condo_alpha_email = $condo_info->email;
				
				//Grab Condo Admin info
				$condo_info_admins = $this->General_model->get_data_by_id($last_inserted_id_condoadmins,'condo_admins');
				$condo_alpha_name_admins = $condo_info_admins->full_name;
				$condo_alpha_email_admins = $condo_info_admins->email;
				
				$verification_code_id = base64_encode($last_inserted_id_condoadmins);
				$verification_code_email = md5($condo_alpha_email_admins);
				$verification_link = base_url()."alpha/verify_user/".$verification_code_id."/".$verification_code_email;
				
			//first email
				//Collect Email Data
				$subject_first = "Welcome to ALIA - Your Life Style & Property Solutions";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$condo_alpha_name.", <br /><br />

				Welcome to the ALIA community.<br />
				We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br />
				Our mission is to help you on your property management matters so that you can get things done with less work.<br /><br />
				</div>";
				//Send Welcome Email
				$this->email($condo_alpha_email, $condo_alpha_name, $subject_first, $message_first);
				
			//second email
				$subject_second = "New Registration – Please verify your account";
				$message_second = "<div style='".$this->config->item('style')."'>Dear <".$condo_alpha_name.">,  <br /><br />
                Thank you for registering with ALIA. Please click on link below to verify your email address.<br/>
				".$verification_link."<br/><br/>
				Once your account is verified, please use the credentials below to login to the system.<br/>
				Email    : ".$condo_alpha_email_admins."<br/>
				Password : ".$pass."<br/><br/>
				";
				//Send Email to Condo Admin
				$this->email($condo_alpha_email, $condo_alpha_name, $subject_second, $message_second);
				redirect('alpha/condos'); 
			}
		}
		$this->data['title']='Alpha | Add Condo';
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['view']='alpha/add_condo';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function view_condo($id){
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/view_condo'));
		}
		
		
		$this->data['title']='Alpha | View Condo';
		$action = "id = '$id'";
		$this->data['condo_info']= $this->General_model->get_data_row_using_where('condos', $action);
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['view']='alpha/view_condo';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function edit_condo($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_condo/'.$id));
		}
		
		if(isset($_POST['edit_condo_btn'])){
			$date_time = date('Y-m-d H:i:s');
			
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			$phone 				= $this->input->post('phone');
			$mobile 			= $this->input->post('mobile');
			$address 			= $this->input->post('address');
			$city 				= $this->input->post('areas');
			$state 				= $this->input->post('state');
			$post_code 			= $this->input->post('post_code');
			$privacy 			= $this->input->post('privacy');
			$logo_url 			= $this->input->post('logo');
			$status 			= $this->input->post('status');
			$condoimg_url 		= $this->input->post('condoimg');
	
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = $_FILES['logo']['name'];
			$original_filename = '';
			if($_FILES['logo']['name']!= ''){
			     $upload_path = "uploads/condos/condo_logos/";
			     $file_type = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				
				if($this->upload->do_upload('logo')){
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
				   } 
				} else {
					$original_filename =  $this->General_model->get_value_by_id_empty('condos', $id, 'logo');
				}
				
				//For Condo Pictures
			$files_condo = $_FILES;
			$cpt_condo = $_FILES['condoimg']['name'];
			$original_filename_condo = '';
			if($_FILES['condoimg']['name']!= ''){
			     $upload_path_condo = "uploads/condos/condo_pictures/";
			     $file_type_condo = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path_condo, $file_type_condo));
				
				if($this->upload->do_upload('condoimg')){
					$uploaddata_condo = $this->upload->data();
					$result_condo['filename'] = $uploaddata_condo['file_name'];
					$original_filename_condo = $result_condo['filename'];
				   } 
				} else {
					$original_filename_condo =  $this->General_model->get_value_by_id_empty('condos', $id, 'condo_picture');
				}
				
		/*if($city != ''){
			$city_value =  $this->input->post('city');
		} else {
			$city_value = $this->General_model->get_value_by_id_empty('condos', $id, 'city');
		}*/
			
 		$DbFieldsArray 		= array('name','phone', 'mobile', 'address', 'areas', 
									'state', 'postcode', 'privacy', 'logo', 'condo_picture', 'registered_on', 'status');
		
		$DataArray = array($name, $phone, $mobile, $address, $city, $state, $post_code, $privacy, $original_filename, $original_filename_condo, $date_time, $status);
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condos');
		redirect('alpha/condos'); 
		
		}
		
		if(isset($_POST['edit_condomodules_btn'])){
			$id 				= $this->input->post('id');
			if(isset($_POST['quick_pay'])){$is_quick_pay=1;}else{$is_quick_pay=0;}
			if(isset($_POST['facility'])){$is_facility=1;}else{$is_facility=0;}
			if(isset($_POST['services'])){$is_services=1;}else{$is_services=0;}
			if(isset($_POST['visitors_delivery'])){$is_visitors_delivery=1;}else{$is_visitors_delivery=0;}
			if(isset($_POST['noticeboard'])){$is_noticeboard=1;}else{$is_noticeboard=0;}
			if(isset($_POST['incident'])){$is_incident=1;}else{$is_incident=0;}
			if(isset($_POST['useful_links'])){$is_useful_links=1;}else{$is_useful_links=0;}
			if(isset($_POST['community_wall'])){$is_community_wall=1;}else{$is_community_wall=0;}
			if(isset($_POST['advertisement'])){$is_advertisement=1;}else{$is_advertisement=0;}
			if(isset($_POST['house_rules_froms'])){$is_house_rules_froms=1;}else{$is_house_rules_froms=0;}
			
			$condo_module_count = $this->General_model->get_data_all_like_using_where_count('condo_modules', "condo_id = '$id'");
			if($condo_module_count > 0){

			$DbFieldsArray_modules 		= array('condo_id','quick_pay','facility','services','visitors','noticeboard','incident','useful_links','community_wall','advertisement','house_rules_froms');
			$DataArray_modules = array($id, $is_quick_pay, $is_facility, $is_services, $is_visitors_delivery, $is_noticeboard,$is_incident, $is_useful_links, $is_community_wall,$is_advertisement,$is_house_rules_froms);
			$this->General_model->updateData($id,'condo_id',$DbFieldsArray_modules,$DataArray_modules,'condo_modules');
			} else {
				$DbFieldsArray_modules 		= array('condo_id','quick_pay','facility','services','visitors','noticeboard','incident','useful_links','community_wall','advertisement');
			$DataArray_modules = array($id, $is_quick_pay, $is_facility, $is_services, $is_visitors_delivery, $is_noticeboard,$is_incident, $is_useful_links, $is_community_wall,$is_advertisement);
			
		$last_inserted_id = $this->General_model->addData_InsertID($DbFieldsArray_modules,$DataArray_modules,'condo_modules');
			}
			redirect('alpha/edit_condo/'.$id.'#tab_15_2'); 
		}
		
		//Condo Settings
		if(isset($_POST['edit_settings_btn'])){
		    $data=$this->General_model->get_data_all_using_Multiwhere("access_level_id='1' and condo_id='$id'", "condo_settings");
			foreach($data as $d){
				$val=$d['key_id'];
			    $data=array(
			  		'value'         =>   $_POST["$val"],
					'updated_date'	=>   date('Y-m-d H:i:s'),
					'updated_by'	=>   $this->alpha_id
				);

		     $this->db->where("key_id",$d['key_id']);
			 $this->db->where("condo_id",$id);
		     $this->db->update('condo_settings',$data);
			 $this->db->flush_cache();	
			}
			redirect('alpha/edit_condo/'.$id.'#tab_15_3');
			$this->data['msg']='Condo Settings updated successfully.';
		}
		$this->data['condo_settings']=$this->General_model->get_data_all_using_Multiwhere("access_level_id='1' and condo_id='$id'", "condo_settings");
	
		$this->data['title']='Alpha | Edit Condo';
		$this->data['view']='alpha/edit_condo';
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['condo_info']= $this->General_model->get_data_by_id($id, 'condos');
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	//Add Add Contact
	public function announcement()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/announcement/'));
		}
		if(isset($_POST['send_resident_email']))
		{
			$condo =  $this->input->post('condo');
			$subject =  $this->input->post('subject');
			//Collect Email Data
			
			if($condo=='all')
			{
				$residents=$this->General_model->get_data_all('residents');
			}
			else
			{
				$residents=$this->General_model->get_data_all_like_using_where('residents',"condo_id=".$condo);
			}
			
			if($this->input->post('images_names')!=''){
				foreach($_POST['images_names'] as $image){
					$attachment =  $_SERVER["DOCUMENT_ROOT"]."/uploads/email_attachement/".$image;
				}
			}
			else
			{
				$attachment =  "";
			}
			
			if(sizeof($residents>0))
			{
				foreach($residents as $resident)
				{
					//Send Welcome Email
					$message = "<div style='".$this->config->item('style')."'>Hello ".$resident["name"].", <br />".$this->input->post('message');
					$this->email($resident["email"], $resident["name"], $subject, $message, $attachment);
					$this->email->clear(TRUE);
				}
			}
			$this->session->set_flashdata('message', 'Email sent succussfully.');
			redirect('alpha/announcement'); 
		}
		$this->data['condos']=$this->General_model->get_data_all_like_using_where('residents',"condo_id!=0 group by condo_id  order by name ASC");
		$this->data['title']='Alpha | Announcement';
		$this->data['view']='alpha/announcement';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function verify_user($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		$action = "status = 1";
		if($this->General_model->update_data_using_multiwhere($where, $action, 'condo_admins')){
			$this->data['verify_data'] = 'VERIFIED';
			$row = $this->General_model->get_data_row_using_where('condo_admins', $action);
			//second email
				$subject_second = "Your community platform is created - Successful Registration";
				$message_second = "<div style='".$this->config->item('style')."'>Hi ".$row->name."!  <br /><br />
				
                Thank you for signing up with ALIA.<br/><br/>
				
				We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br/><br/>
				
				Our mission is to help you simplify your property management matters so that you can get things done with less work.<br/><br/>
				
				<h3>GETTING STARTED</h3> <br/><br/>

				Training will be provided to your management team so that they fully understand and utilize the<br/>
				benefits of ALIA. We invite you to complete the following details and confirm your training<br/>
				session with us as soon as possible. Please reply via email to marrcuss.lim@als.com.my or you<br/>
				can call 03-26315655 to confirm your training. <br/><br/>
				
				<h3>System Training (for Residence Managers and Admin)</h3> <br/><br/>

				Date and Time 			: 			<br/>
				(Preferably within 7 days from today)<br/>
				Venue					: 			<br/>
				Number of people attending		:	<br/><br/>
				
				
				<h4>Please prepare the following before the training:</h4><br/>
				1.	You must bring your own laptop or computer.<br/>
				2.	Please make sure you have the following images (jpeg,png format only):<br/>
				•	Residence Profile Picture<br/>
				•	Residence Logo<br/>
				•	Pictures of Residence Facilities<br/>
				•	Residents list (unit, name, email, contact number)<br/><br/>
				
				Kindly ensure all relevant Residence Managers and Admin persons attend this training because<br/>
				this training is only provided ONCE. The training will take approximately 2 hours.<br/><br/>
				
				
				<h3>Training Agenda:</h3> <br/><br/>
				1.	Account Setup <br/>
				2.	Residence Settings – Blocks, Levels, Units<br/>
				3.	We will guide you how to use each service.<br/>
				4.	Run through simulations to make sure you know how to use each function.<br/><br/>
				
				We appreciate all attendees to come on time so that we can provide you with the best training <br/>
				experience and benefit from your community platform.<br/><br/>
				
				Thank you and we look forward to seeing everyone at the training.<br/><br/>
				";
				//Send Email to Condo Admin
				$this->email($condo_alpha_email, $condo_alpha_name, $subject_second, $message_second);
		} else {
			$this->data['verify_data'] = 'PROBLEM';
		}
		
		
		$this->data['title']='Alpha | Verify User';
		$this->load->view('alpha/verify_user',$this->data);
	}
	
	public function test(){
	/*$verification_code = base64_encode('ronnie@getranked.com.my');
	$verification_link = base_url()."alpha/verify_user/".$verification_code;
	echo $verification_link;*/

		$subject = "Welcome to ALIA";
		$message = "<div style='".$this->config->item('style')."'>Hello User, <br /><br />

Welcome to the ALIA community.<br />
We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br />
Our mission is to help you on your property management matters so that you can get things done with less work.<br /><br />
Regards,<br/>
ALIA Team
				";
				
			$this->email('ronnie@getranked.com.my', 'Ronnie', $subject, $message);
	}
	
	public function change_password(){
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/change_password'));
		}
		
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'admin');
		redirect('alpha/change_password'); 
		}
		
		$this->data['title']='Alpha | Change Password';
		$action = "id = '$this->alpha_id'";
		$this->data['alpha_info']= $this->General_model->get_data_row_using_where('admin', $action);
		$this->data['view']='alpha/change_password';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email'";
				$condo_info_admins = $this->General_model->get_data_row_using_where('admin',$action);
				$condo_alpha_name_id = $condo_info_admins->id;
				$condo_alpha_name_admins = $condo_info_admins->full_name;
				
				$DbFieldsArray 		= array('forgot_pass_count');
				$DataArray = array('0');
				$this->General_model->updateData($email,'email',$DbFieldsArray,$DataArray,'admin');
				
				$verification_code_id = base64_encode($condo_alpha_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."alpha/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Reset Password Link";
				$message = "<div style='".$this->config->item('style')."'>Dear ".$condo_alpha_name_admins.", <br /><br />
				You have requested to reset your password.<br/><br/>

				Click on the link below to change your password.<br/>
				".$verification_link."<br/><br/>
				
				</div>
				";

				//Send Forgot Password Link
				$this->email($email, $condo_alpha_name_admins, $subject, $message);
				echo 'LINKSENT';
				}
		
	}
	
	public function forgot_password_change($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		//Grab Condo Admin Forgot Password Link Count info
		$action = "id = '$verification_code_id_decode'";
		$condo_info_admins = $this->General_model->get_data_row_using_where('admin',$action);
		$condo_forgot_pass_count = $condo_info_admins->forgot_pass_count;
		
		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";
		if($get_key_id = $this->General_model->update_data_using_multiwhere_custom($where, $action_to_be_filled, 'admin')){
			$this->data['verify_data'] = $get_key_id;
		} else {
			$this->data['verify_data'] = 'USED';
		}
		
		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'admin');
		redirect('alpha'); 
		}
		
		$this->data['title']='Alpha | Forgot Password Change';
		$this->load->view('alpha/forgot_password_change',$this->data);
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
		if($attachment!=''){ $this->email->attach($attachment); 
		}	
		$this->email->send();
	}
	
	public function condos()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/condos'));
		}
		//$this->data['condos']=$this->General_model->get_data_all_like_using_where('condos','status=1');
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['title']='Alpha | Condo List';
		$this->data['view']='alpha/condos';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	public function services()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/services'));
		}

		$this->data['condos']=$this->General_model->get_data_all('services_categories');
		$this->data['title']='Alpha | Services List';
		$this->data['view']='alpha/services';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function incident_reporting()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/incident_reporting'));
		}

		$this->data['condos']=$this->General_model->get_data_all('incident_reporting');
		$this->data['title']='Alpha | Report List';
		$this->data['view']='alpha/incident_reporting';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	public function category($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/category'));
		}

		$this->data['condos']=$this->General_model->get_data_all_using_where('category_id',$id,'services');
		$this->data['title']='Alpha | Services Category';
		$this->data['view']='alpha/category';
		$this->load->view('alpha/template/main_copy',$this->data);
	}
	
	
	
	
	public function add_service_category()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_service_category'));
		}
		if(isset($_POST['add_servicecategory_btn'])){
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt   = $_FILES['imagefile']['name'];
			if($_FILES['imagefile']['name']!= ''){
				
			$upload_path = "uploads/service_categories/";
		    $file_type = "gif|jpg|jpeg|png";
		    $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('imagefile')){
			$uploaddata = $this->upload->data();
			$result['filename'] = $uploaddata['file_name'];
			$original_filename = $result['filename'];
					$data=array(	  
					  'name'          =>	$this->input->post('name'),
					  'image_url'	  =>    $original_filename,
					  );
							$get_email_data = $this->General_model->addData_array($data, 'services_categories');
					//$get_email_data = $this->General_model->add_service_category($original_filename);
					$result['msg']		=	"success";
					redirect("alpha/service_categories");
					
			} else {
				//echo $this->data['error'] = $this->upload->display_errors();
				$result['msg']		=	$this->upload->display_errors();
				redirect("alpha/service_categories");
			}
		}
		}
		

		$this->data['title']='Alpha | Add Service Category ';
		$this->data['view']='alpha/add_service_category';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function edit_service_category($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_service_category/'.$id));
		}
		if(isset($_POST['edit_servicecategory_btn'])){
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = $_FILES['imagefile']['name'];
			if($_FILES['imagefile']['name']!= '')
			{
					$upload_path = "uploads/service_categories/";
						 $file_type = "gif|jpg|jpeg|png";
						 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
					
					if($this->upload->do_upload('imagefile')){
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
							$updat_data = array('name' => $_POST['name'], 'image_url' => $original_filename);
							$get_email_data = $this->General_model->updateData_array($updat_data, 'services_categories', $id);
							$result['msg']		=	"success";
							redirect("alpha/service_categories");
							
					} else {
						//echo $this->data['error'] = $this->upload->display_errors();
						$result['msg']		=	$this->upload->display_errors();
						redirect("alpha/service_categories");
					}
			}
		else
		{
			$updat_data = array('name' => $_POST['name']);
			$get_email_data = $this->General_model->updateData_array($updat_data, 'services_categories', $id);
			$result['msg']		=	"success";
			redirect("alpha/service_categories");
		}
		}
		
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'services_categories');
		$this->data['title']='Alpha | Edit Service Category ';
		$this->data['view']='alpha/edit_service_category';
		$this->load->view('alpha/template/main',$this->data);
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

	public function update_data()
	{
		$wherefield=$_POST['wherefield'];
		$wherevalue=$_POST['wherevalue'];
		$whereClouse = "$wherefield=$wherevalue";
		$updateDbFieldsAry = array($_POST['changefield']);
		$updateInfoAry = array($_POST['changeuvalue']);
		$get_email_data = $this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, $_POST['table']);
	}
	
	
	public function confirm_user($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('admin',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Confirmed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('1');
			$whereClouse = "verify_code='$verify_code'";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'admin');
		}
		else
		{
			$this->data['message']='Email Not Confirmed';
		}
		 
		
		if(isset($_POST['change_password_btn'])){
			$new_password 		= $this->input->post('password');
			
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($verify_code,'verify_code',$DbFieldsArray,$DataArray,'admin');
			//
			$this->db->where('verify_code',$verify_code);
			$this->db->where('password',md5($new_password));		
			$query=$this->db->get('admin');
			if($query->num_rows==1)
			{
				$row = $query->row();
				$data = array(
                    'alpha_id'     => $row->id,
					'email'       => $row->email,
					'full_name'   => $row->full_name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('alpha');  
		}
		
		$this->data['title']='Alpha | Confirm Manager';
		$this->load->view('alpha/confirm_user',$this->data);
	}
	public function add_user()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_user'));
		}
		
		if(isset($_POST['add_user_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'full_name'           =>	$this->input->post('full_name'),
					  'access_level'        =>	1/*$this->input->post('access_level')*/,
					  'email'          		=>	$this->input->post('email'),
					  'verify_code'         =>	md5($this->input->post('email')),
					  'password'        	=>	md5($password),
					  'register_on'         =>	date('Y-m-d')
					  );
					$get_email_data = $this->General_model->addData_array($data, 'admin');
					
					
					
					
					//Collect Email Data
				$subject_first = "ALIA - User Account Creation";
				$message_first = "<div style='".$this->config->item('style')."'>Dear ".$this->input->post('full_name').", <br /><br/>

				We are pleased to inform you that your account has been created. Please check your credentials below:<br />
				
				Your Email is ".$this->input->post('email')."<br />
				
				Your password is ".$password.".<br />
				
				<a href='".base_url()."alpha/confirm_user/".md5($this->input->post('email'))."'>Click here</a> to Confirm And login .<br /><br />
				</div>";
				
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
				redirect("alpha/users");
		}
		
		$this->data['title']='Alpha | Add User ';
		$this->data['view']='alpha/add_user';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function add_closing_account_option()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_closing_account_option'));
		}
		
		if(isset($_POST['add_user_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'name'           =>	$this->input->post('name'),
					  );
					$get_email_data = $this->General_model->addData_array($data, 'closing_account_options');
				redirect("alpha/closing_account_options");
		}
		
		$this->data['title']='Alpha | Add Closing Account Option ';
		$this->data['view']='alpha/add_closing_account_option';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function edit_user($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_user/'.$id));
		}
		
		if(isset($_POST['edit_user_btn'])){
			$data=array(	  
					  'full_name'           =>	$this->input->post('full_name'),
					  'access_level'        =>	1/*$this->input->post('access_level')*/,
					  'email'          		=>	$this->input->post('email'),
					  );
					  if($_POST['password']!='')
					  {
						  $data['password']= md5($this->input->post('password'));
					  }
					$get_email_data = $this->General_model->updateData_array($data, 'admin', $id);
					$result['msg']		=	"success";
					redirect("alpha/users");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'admin');
		$this->data['title']='Alpha | Update User ';
		$this->data['view']='alpha/edit_user';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function reported_posts()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/reported_posts'));
		}

		$this->data['reported_posts']	=$this->General_model->get_data_all_like_using_where('reported_posts',"is_resolved=0 order by id DESC");
		$this->data['title']	='Alpha | Reported Posts';
		$this->data['view']		='alpha/reported_posts';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function view_profile($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/profile/'.$id));
		}
		$action = "id =".$id;
		//Resident Info
		$this->data['resident_info']= $this->General_model->get_data_row_using_where('residents', $action);
		//Resident Info
		$action_posts = "posted_by =".$id;
		$this->data['posts']= $this->General_model->get_data_all_like_using_where('posts', $action_posts);
		//Resident Info
		$action_posts_comments = "commented_by =".$id;
		$this->data['comments']= $this->General_model->get_data_all_like_using_where('posts_comments', $action_posts_comments);


		$this->data['title']='Alpha | View Profile';		
		$this->data['view']='alpha/view_profile';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function show_popup_ad(){
		 $ad_id = $this->input->post('ad_id');
		 echo $ad_id;
	}
	
	public function edit_advertisement($id){
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_advertisement/'.$id));
		}
		
		$id=$this->encrypt_model->decode($id);

		if(isset($_POST['editadvertisementsub'])){
			if(isset($_POST['images_names']))
			{
				foreach($_POST['images_names'] as $image_name)
				{
					$ad_type 			= $this->input->post('ad_type');
					$ad_category        = $this->input->post('ad_category');
					$title 				= $this->input->post('title');
					$link 				= $this->input->post('link');
					$description 		= $this->input->post('description');
					//$add_link 		= $this->input->post('add_link');
					$display_settings 	= $this->input->post('display_settings');
					$start_date 		= $this->input->post('start_date');
					$end_date 			= $this->input->post('end_date');
					
					$DbFieldsArray 		= array('ad_type', 'ad_category','title','link','ad_text','ad_img','user_id','date_created','start_date','end_date','display_all','created_by','status');
					$DataArray 			= array($ad_type, $ad_category, $title, $link, $description, $image_name, '0', date('Y-m-d H:i:s'), $start_date, $end_date, $display_settings, $this->alpha_id, '1');
					if(isset($_POST['images_names']) && $_POST['images_names'] != "")
					{
						array_push($DbFieldsArray,'ad_img');
						array_push($DataArray,$_POST['images_names'][0]);
					}
			        //print_r($DbFieldsArray); print_r($DataArray);exit;
					//Get all areas from the selected state
					

					$this->General_model->updateData($id, 'id',$DbFieldsArray,$DataArray,'advertisements');
					$ad_id = $id;
					if($display_settings == 0){
						$states 			= $this->input->post('states');
						$areas = $this->General_model->get_data_all_like_using_where('areas',"state_id=$states");
						if($_POST['areas'][0]=='all'){
							foreach($areas as $area){
								$ad_display 			= array('ad_id', 'state_id', 'area_id');
								$ad_display_values 		= array($ad_id, $states, $area['id']);	
								$this->General_model->delete_data_using_where('ad_id',$ad_id,'ad_display');				
								$this->General_model->addData_InsertID($ad_display,$ad_display_values,'ad_display');
							}
							
						} else {
							foreach($_POST['areas'] as $areas){
								$ad_display 			= array('ad_id', 'state_id', 'area_id');
								$ad_display_values 		= array($ad_id, $states, $areas);
								$this->General_model->delete_data_using_where('ad_id',$ad_id,'ad_display');						
								$this->General_model->addData_InsertID($ad_display,$ad_display_values,'ad_display');
							}
						}
					}
					elseif($display_settings == 2) {
						$con = "0";	
						foreach($_POST['condos'] as $condo){
							$con .= ",".$condo;						
							$this->General_model->update_data_using_multiwhere("id=".$ad_id, "condos='".$con."'", 'advertisements');
						}
					}
					else
					{
						//delete the previous entries related to that ad from ad_display table.
						$this->General_model->delete_data_using_where('ad_id',$ad_id,'ad_display');		
					}
				}
			}
			//exit;
			$this->session->set_flashdata('message', 'Advertisement Edited.');
			redirect('alpha/advertisements'); 
		}
		$this->data['states']= $this->General_model->get_data_all('states','name','ASC');
		$this->data['advert']= $this->General_model->get_data_by_id($id,'advertisements');
		$this->data['title']='Alpha | Edit Advertisement';
		$this->data['view']='alpha/edit_advertisement';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function load_areas()
	{
		 
		$id = $_POST['id'];
		$select = '';
		$areas = $this->General_model->get_data_all_like_using_where('areas',"state_id=$id");
		if(sizeof($areas)>0)
		{
            $select.='<div class="form-group">
                <label class="col-md-3 control-label">Select Areas</label>
                <div class="col-md-9">
                    <select name="areas[]" multiple class="form-control">
						<option selected value="all">All</option>';
							foreach($areas as $area)
							{
								$select.='<option value="'.$area['id'].'">'.$area['name'].'</option>';
							}
						   
						  $select.='</select>
                    <span class="error_individual help-block" id="areas_validate"></span>
                </div>
              </div>';
          
		}
		echo $select;
	}
	
	public function upload_ad_image()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['file_upload']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['file_upload']['name']!= '' )
		{
			 $upload_path = "uploads/advertisement_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('file_upload'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				//$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'incident_images');
				//$image_url = $this->General_model->get_value_by_id('incident_images', $id, 'image_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$original_filename, 'extension'=>pathinfo($original_filename, PATHINFO_EXTENSION),'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
				//resize image if size much big
				if(pathinfo($original_filename, PATHINFO_EXTENSION)!='pdf')
				{
				  list($width, $height) = getimagesize("uploads/advertisement_images/".$original_filename);
				  if($width > "1000" || $height > "1000") 
				  {
					   $config = array('image_library'	=>'gd2',
									   'source_image'	=>'uploads/advertisement_images/'.$original_filename,
									   'maintain_ratio'	=>TRUE,
									   'width'			=>'1000',
									   'height'			=>'1000',);
					   $this->load->library('image_lib', $config); 
					   $this->image_lib->initialize($config);
					   $this->image_lib->resize();
				  }
				}
				//resizeimage ends
			} 
			else
			{
				$posts = array();
				$posts[] = array('name'=>'Invalid file type.','valid_file'=>'no');
				echo json_encode(array('files'=>$posts));
			}
		}
		else 
		{
			$posts = array();
			$posts[] = array('name'=>'No file selected.','valid_file'=>'no');
			echo json_encode(array('files'=>$posts));
		}
	}
	
	
	
	public function single_advertisement($id)
	{
		$id=$this->encrypt_model->decode($id);
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/single_advertisement/'.$id));
		}
		$this->data['post_details']= $this->General_model->get_data_row_using_where('adverts',"id=$id");
		$this->data['title']='ALPHA | Advertisement';		
		$this->data['view']='alpha/single_advertisement';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function uploadify_advert_images()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/advertisement_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'adverts_images');
				$image_url = $this->General_model->get_value_by_id('adverts_images', $id, 'image_url' );
				echo $image_url;
				
				//resize image if size much big
				list($width, $height) = getimagesize("uploads/advertisement_images/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/advertisement_images/'.$original_filename,
									 'maintain_ratio'=>TRUE,
									 'width'=>'1000',
									 'height'=>'1000',);
					 $this->load->library('image_lib', $config); 
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
				}
				//resizeimage ends
			} 
			
		}
		else 
		{
			echo 'Invalid file type.';
		}
	}
	
	public function advertisement_featured_image()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/advertisement_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'adverts_images');
				$image_url = $this->General_model->get_value_by_id('adverts_images', $id, 'image_url' );
				echo $image_url;
				
				//resize image if size much big
				list($width, $height) = getimagesize("uploads/advertisement_images/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/advertisement_images/'.$original_filename,
									 'maintain_ratio'=>TRUE,
									 'width'=>'1000',
									 'height'=>'1000',);
					 $this->load->library('image_lib', $config); 
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
				}
				//resizeimage ends
				
				$size = 262;
				$config = $this->resize_image("uploads/advertisement_images/", $original_filename, $size, $size);
				$this->load->library('image_lib', $config); 
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			} 
			
		}
		else 
		{
			echo 'Invalid file type.';
		}
	}
	
	
	public function resize_image($upload_path, $original_filename, $width, $height){   
		//resizing image
		$config['image_library'] = 'gd2';
		$config['source_image']	= $upload_path.$original_filename;
		$ext 	  = pathinfo($original_filename, PATHINFO_EXTENSION);
		$filename = pathinfo($original_filename, PATHINFO_FILENAME);
		$config['new_image'] = $upload_path.$filename.'_'.$width.'_'.$height.'.'.$ext;
		$config['maintain_ratio'] = FALSE;
		$config['width']	= $width;
		$config['height']	= $height;
 		$config['quality']     = '100%';
		//resizing image End
		return $config;
	}
	//Advertisements
	public function advertisements()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/advertisements/'));
		}
		//AND role='1'//as both manager and security will recive email
		$this->data['adverts'] = $this->General_model->get_data_all('advertisements');
		$this->data['title']='Alpha | Advertisements';
		$this->data['view']='alpha/advertisements';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	//Advertisements
	public function modules()
	{	
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/modules/'));
		}
		//AND role='1'//as both manager and security will recive email
		$this->data['title']='Alpha | Modules';
		$this->data['page_title']='Modules';
		$this->data['view']='alpha/modules';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	
	public function add_advertisement(){
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_advertisement/'));
		}
		if(isset($_POST['addadvertisementsub'])){
			
			/*if(isset($_POST['condos']))
			{
				//$DbFieldsArray['condo_id']=$_POST['condos'];
				array_push($DbFieldsArray, 'condo_id');
				array_push($DataArray, $_POST['condos']);
			}
			$id = $this->General_model->addData_InsertID($DbFieldsArray,$DataArray,'adverts');*/
			if(isset($_POST['images_names']))
			{
				foreach($_POST['images_names'] as $image_name)
				{
					$ad_type 			= $this->input->post('ad_type');
					$ad_category        = $this->input->post('ad_category');
					$title 				= $this->input->post('title');
					$link 				= $this->input->post('link');
					$description 		= $this->input->post('description');
					//$add_link 		= $this->input->post('add_link');
					$display_settings 	= $this->input->post('display_settings');
					$start_date 		= $this->input->post('start_date');
					$end_date 			= $this->input->post('end_date');
					
					$DbFieldsArray 		= array('ad_type', 'ad_category','title','link','ad_text','ad_img','user_id','date_created','start_date','end_date','display_all','created_by','status');
					$DataArray 			= array($ad_type, $ad_category, $title, $link, $description, $image_name, '0', date('Y-m-d H:i:s'), $start_date, $end_date, $display_settings, $this->alpha_id, '1');
			
					//Get all areas from the selected state
					

					$ad_id = $this->General_model->addData_InsertID($DbFieldsArray,$DataArray,'advertisements');
					if($display_settings == 0){
						$states 			= $this->input->post('states');
						$areas = $this->General_model->get_data_all_like_using_where('areas',"state_id=$states");
						if($_POST['areas'][0]=='all'){
							foreach($areas as $area){
								$ad_display 			= array('ad_id', 'state_id', 'area_id');
								$ad_display_values 		= array($ad_id, $states, $area['id']);					
								$this->General_model->addData_InsertID($ad_display,$ad_display_values,'ad_display');
							}
							
						} elseif($display_settings == 1) {
							foreach($_POST['areas'] as $areas){
								$ad_display 			= array('ad_id', 'state_id', 'area_id');
								$ad_display_values 		= array($ad_id, $states, $areas);						
								$this->General_model->addData_InsertID($ad_display,$ad_display_values,'ad_display');
							}
						}
					}elseif($display_settings == 2) {
							$con = "0";	
							foreach($_POST['condos'] as $condo){
								$con .= ",".$condo;						
								$this->General_model->update_data_using_multiwhere("id=".$ad_id, "condos='".$con."'", 'advertisements');
							}
						}
				}
			}
			//exit;
			$this->session->set_flashdata('message', 'Advertisement Added.');
			redirect('alpha/advertisements'); 
		}
		$this->data['states']= $this->General_model->get_data_all('states','name','ASC');
		$this->data['title']='Alpha | Add Advertisement';
		$this->data['view']='alpha/add_advertisement';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function residents()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/reported_posts'));
		}
		$this->data['condos']=$this->General_model->get_data_all_like_using_where('residents',"condo_id!=0 group by condo_id  order by name ASC");
		if(isset($_POST['search_residents_btn']))
		{
			$action="";
			$arr='0';
			foreach($_POST['condos'] as $post)
			{
				$arr.=','.$post;
			}
			$action .= "condo_id IN (".$arr.")";
			if(isset($_POST['block']) && $_POST['block']!=''){  $action .= " AND block='".$_POST['block']."'"; }
			if(isset($_POST['floors']) && $_POST['floors']!=''){  $action .= " AND floor='".$_POST['floors']."'"; }
			if(isset($_POST['unit']) && $_POST['unit']!=''){  $action .= " AND unit='".$_POST['unit']."'"; }
			$this->data['residents']	=$this->General_model->get_data_all_like_using_where('residents',$action);
		}
		else
		{
			$this->data['residents']	=$this->General_model->get_data_all('residents','name','ASC');
		}
		$this->data['title']	='Alpha | Residents';
		$this->data['view']		='alpha/residents';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function chang_block_residnets()
	{
		$arr='0';
		foreach($_POST as $post)
		{
			$arr.=','.$post;
		}
		$blocks=$this->General_model->get_data_all_like_using_where('residents',"condo_id IN (".$arr.") group by block  order by name ASC");
		?>
		<select id="block" name="block" onchange="change_floors_alpha(this.value)" class="form-control">
                <option value="">
                    Block
                </option>
                <?php
                  if(sizeof($blocks)>0)
                  {
                      foreach($blocks as $block)
                      {
                          ?>
                          <option value="<?php echo $block['block']?>" ><?php echo $this->General_model->get_value_by_id('blocks',$block['block'],'name')?></option>
                          <?php
                      }
                  }
                  else
                  {
                      ?>
                          <option value="" >No blocks available</option>
                      <?php
                  }
              ?>
            </select>
		<?php
	}
	
	public function change_floors_alpha()
	{
		$arr='0';
		foreach($_POST as $post)
		{
			if($post!='id')
			{
				$arr.=','.$post;
			}
		}
		$id = $this->input->post('id');
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id IN (".$arr.") AND block=$id group by floor  order by name ASC");
		?>
		<select  name="floors" class="form-control valid" aria-invalid="false" onchange="change_unit_alpha(this.value)">
        	<option value="">
                Floor
            </option>
        <?php if(sizeof($floors)>0){foreach($floors as $floor){?>
             <option value="<?php echo $floor['floor']?>"><?php echo $floor['floor']?></option>
        <?php }}?>
        </select>
		<?php
	}
	
	public function change_unit_alpha()
	{
		$arr='0';
		foreach($_POST as $post)
		{
			if($post!="block_id" || $post!="floor_id")
			{
				$arr.=','.$post;
			}
		}
		$block_id = $this->input->post('block_id');
		$floor_id = explode('"',$this->input->post('floor_id'));
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id IN (".$arr.") AND block='$block_id'  AND floor='".$floor_id[1]."' group by unit  order by name ASC");
		?>
		<select  name="unit" class="form-control valid" aria-invalid="false">
        	<option value="">
                Unit
            </option>
        <?php if(sizeof($floors)>0){foreach($floors as $floor){?>
             <option value="<?php echo $floor['unit']?>"><?php echo $floor['unit']?></option>
        <?php }}?>
        </select>
		<?php
	}
	public function activate_resident()
	{
		$whereClouse = "id=".$_POST['id'];
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array('1');
		$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, $_POST['table']);
		echo true;
		
		//email
		$subject_admin = "Account Activated";
		$message_admin = "<div style=''>Hello  ".$this->General_model->get_value_by_id('residents',$_POST['id'],'name').", <br />
		Your Account Activated.  ";
		$message_admin.= "<br /><br /></div>";
		$this->email($this->General_model->get_value_by_id('residents',$_POST['id'],'email') , $this->General_model->get_value_by_id('residents',$_POST['id'],'name'), $subject_admin, $message_admin);
	}
	
	public function suspend_resident()
	{
		$whereClouse = "id=".$_POST['id'];
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array('0');
		$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, $_POST['table']);
		echo true;
		
		//email
		$subject_admin = "Account suspended";
		$message_admin = "<div style=''>Hello  ".$this->General_model->get_value_by_id('residents',$_POST['id'],'name').", <br />
		Your Account Suspended.  ";
		$message_admin.= "<br /><br /></div>";
		$this->email($this->General_model->get_value_by_id('residents',$_POST['id'],'email') , $this->General_model->get_value_by_id('residents',$_POST['id'],'name'), $subject_admin, $message_admin);
	}
	
	public function view_post($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/view_post/'.$id));
		}
		
		if(isset($_POST['delet_post_btn'])){
		  $this->General_model->delete_data($this->input->post('post_id'), "posts");
		  //$this->General_model->delete_data_using_where('post_id', $this->input->post('post_id'), "reported_posts");
		  $this->General_model->update_data_using_multiwhere("id=$id", "is_resolved=1", "reported_posts");
		  $this->session->set_flashdata('message','Post Deleted');
		  redirect("alpha/reported_posts");
		}
		if(isset($_POST['suspend_account_btn'])){
		  $post_id = $this->input->post('post_id');
		  //$this->General_model->delete_data($this->input->post('post_id'), "posts");
		  //$this->General_model->delete_data_using_where('post_id', $this->input->post('post_id'), "reported_posts");
		  $action="id='$post_id' ";
		  $post_detail = $this->General_model->get_data_row_using_where('posts',$action);
		  $this->General_model->update_data_using_multiwhere("id=".$post_detail->posted_by, "status=0", "residents");
		  		$subject_admin = "Account suspended";
				$message_admin = "<div style=''>Hello  ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name').", <br />
				Your Account Suspended. Please do check. 
				<br> Description: ".$post_detail->description."
				<br> Posted By: ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name')."<br>";
				$posts_images=$this->General_model->get_data_all_using_where('post_id',$post_id,'posts_images');
				if(sizeof($posts_images)>0)
				{
					foreach($posts_images as $posts_image)
					{
					  $message_admin.= '<img src="'.base_url().'uploads/post_images/'.$posts_image['image_url'].'" style="max-width:300px;"/>';
					}
				}	
				$message_admin.= "<br /><br /></div>";
				$this->email($this->General_model->get_value_by_id('residents',$post_detail->posted_by,'email') , $this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name'), $subject_admin, $message_admin);
				//
		  $this->session->set_flashdata('message','Account Suspended');
		  redirect("alpha/reported_posts");
		}
		if(isset($_POST['send_warning_btn'])){
		  $post_id = $this->input->post('post_id');
		  $action="id='$post_id' ";//AND role='1'//as both manager and security will recive email
		  $post_detail = $this->General_model->get_data_row_using_where('posts',$action);
		  //print_r($post_detail);exit;
				$subject_admin = "Last Warning for inappropriate posts";
				$message_admin = "<div style=''>Hello  ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name').", <br />
				
				This is Last Warning for inappropriate posts. Please do check. 
				
				<br> Description: ".$post_detail->description."
				<br> Posted By: ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name')."<br>";
				
				$posts_images=$this->General_model->get_data_all_using_where('post_id',$post_id,'posts_images');
				if(sizeof($posts_images)>0)
				{
					foreach($posts_images as $posts_image)
					{
					  $message_admin.= '<img src="'.base_url().'uploads/post_images/'.$posts_image['image_url'].'" style="max-width:300px;"/>';
					}
				}	
				
				$message_admin.= "<br /><br /></div>";
				//Send Welcome Email
				$this->email($this->General_model->get_value_by_id('residents',$post_detail->posted_by,'email') , $this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name'), $subject_admin, $message_admin);
		  $this->session->set_flashdata('message','Warning Sent');
		  redirect("alpha/reported_posts");
		}
		$this->data['post_details']= $this->General_model->get_data_by_id($id,'reported_posts');
		$this->data['title']='Alpha | View Post';
		$this->data['view']='alpha/view_post';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function send_email()
	{
		$post_id = $this->input->post('post_id');
		$action="id='$post_id' ";//AND role='1'//as both manager and security will recive email
		$post_detail = $this->General_model->get_data_row_using_where('posts',$action);
		//print_r($post_detail);exit;
		$subject_admin = "Email regarding your post";
		$message_admin = "<div style=''>Hello  ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name').", <br />
		
		This is Email from Alpha. Please do check. 
		
		<br> Description: ".$this->input->post('email')." ";
		
		$message_admin.= "<br /><br /></div>";
		//Send Welcome Email
		$this->email($this->General_model->get_value_by_id('residents',$post_detail->posted_by,'email') , $this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name'), $subject_admin, $message_admin);
		
	}
	public function reset_password($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/reset_password'));
		}
		
		if(isset($_POST['table'])){
			$data=array(	  
					  'password'          		=>	md5($this->input->post('password'))
					  );
							$get_email_data = $this->General_model->updateData_array($data, 'admin', $id);
					$result['msg']		=	"success";
					redirect("alpha/users");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'admin');
		$this->data['title']='Alpha | Update Password ';
		$this->data['view']='alpha/reset_password';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	public function add_service()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_service'));
		}
		if(isset($_POST['add_service_btn'])){
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = $_FILES['imagefile']['name'];
			if($_FILES['imagefile']['name']!= ''){
				$upload_path = "uploads/service_categories/";
			     $file_type = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('imagefile')){
			$uploaddata = $this->upload->data();
			$result['filename'] = $uploaddata['file_name'];
			$original_filename = $result['filename'];
					$data=array(	  
					  'name'          =>	$this->input->post('name'),
					  'category_id'   =>	$this->input->post('category'),
					  'image_url'	  =>    $original_filename,
					  );
							$get_email_data = $this->General_model->addData_array($data, 'services');
					//$get_email_data = $this->General_model->add_service_category($original_filename,'services');
					$result['msg']		=	"success";
					redirect("alpha/services");
					
			} else {
				//echo $this->data['error'] = $this->upload->display_errors();
				$result['msg']		=	$this->upload->display_errors();
				redirect("alpha/services");
			}
		}
		}
		

		$this->data['title']='Alpha | Add Service ';
		$this->data['view']='alpha/add_service';
		$this->load->view('alpha/template/main',$this->data);
	}	
	
	public function edit_service($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_service/'.$id));
		}
		if(isset($_POST['edit_service_btn'])){
			 //For file upload
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = $_FILES['imagefile']['name'];
			if($_FILES['imagefile']['name']!= '')
			{
				 $upload_path = "uploads/service_categories/";
			     $file_type = "gif|jpg|jpeg|png";
			     $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			  
				if($this->upload->do_upload('imagefile')){
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				$updat_data = array('name' => $_POST['name'], 'image_url' => $original_filename, 'category_id' => $_POST['category']);
				$get_email_data = $this->General_model->updateData_array($updat_data, 'services', $id);
				$result['msg']		=	"success";
				redirect("alpha/services");
					  
			  } else {
				//echo $this->data['error'] = $this->upload->display_errors();
				$result['msg']		=	$this->upload->display_errors();
				redirect("alpha/services");
			  }
		   }
		   else
			{
				$updat_data = array('name' => $_POST['name'],'category_id' => $_POST['category']);
				$get_email_data = $this->General_model->updateData_array($updat_data, 'services', $id);
				$result['msg']		=	"success";
				redirect("alpha/services");
			}
		}
		

		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'services');
		$this->data['title']='Alpha | Update Service ';
		$this->data['view']='alpha/edit_service';
		$this->load->view('alpha/template/main',$this->data);
	}	
	public function add_report()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_report'));
		}
		if(isset($_POST['addservicecategoryubbutton']))
		{
			$post_data = array('reported_by' => $this->input->post('reported_by'),
							   'description' => $this->input->post('description'),
							   'condo_id' => $this->input->post('condo'),);
			$get_email_data = $this->General_model->addData_array($post_data,'incident_reporting');
			redirect("alpha/incident_reporting");
		}
		

		$this->data['title']='Alpha | Add Report ';
		$this->data['view']='alpha/add_report';
		$this->load->view('alpha/template/main',$this->data);
	}	
	
	
	public function edit_report($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_report/'.$id));
		}
		if(isset($_POST['addservicecategoryubbutton']))
		{
			$post_data = array('reported_by' => $this->input->post('reported_by'),
							   'description' => $this->input->post('description'),
							   'condo_id' => $this->input->post('condo'),);
			$get_email_data = $this->General_model->updateData_array($post_data,'incident_reporting', $id);
			redirect("alpha/incident_reporting");
		}
		

		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'incident_reporting');
		$this->data['title']='Alpha | Edit Report ';
		$this->data['view']='alpha/edit_report';
		$this->load->view('alpha/template/main',$this->data);
	}	
	
	public function service_categories()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/service_categories'));
		}

		$this->data['condos']=$this->General_model->get_data_all('services_categories');
		$this->data['title']='Alpha | Services Categories';
		$this->data['view']='alpha/service_categories';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function users()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/users'));
		}

		$this->data['users']=$this->General_model->get_data_all('admin');
		$this->data['title']='Alpha | Users';
		$this->data['view']='alpha/users';
		$this->load->view('alpha/template/main_copy',$this->data);
	}
	public function closing_account_options()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/closing_account_options'));
		}

		$this->data['closing_account_options']=$this->General_model->get_data_all('closing_account_options');
		$this->data['title']='Alpha | Closing Account Options ';
		$this->data['view']='alpha/closing_account_options';
		$this->load->view('alpha/template/main_copy',$this->data);
	}
	public function vendors()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/vendors'));
		}

		$this->data['vendors']=$this->General_model->get_data_all('vendors');
		$this->data['title']='Alpha | Vendors';
		$this->data['view']='alpha/vendors';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function add_vendor()
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/add_vendor'));
		}
		if(isset($_POST['add_vendor_btn'])){
			//upload image
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['Filedata']['name'];
			$original_filename = '';
			if($_FILES['Filedata']['name']!= '')
			{
				 $upload_path = "uploads/vendor_images/";
				 $file_type = "gif|jpg|jpeg|png";
				 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				
				if($this->upload->do_upload('Filedata'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					//resize image if size much big
					list($width, $height) = getimagesize("uploads/vendor_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'	=>	'gd2',
										 'source_image'		=>	'uploads/vendor_images/'.$original_filename,
										 'maintain_ratio'	=>	TRUE,
										 'width'			=>	'1000',
										 'height'			=>	'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					//resizeimage ends
				} 
			}
			else 
			{
				echo 'Invalid file type.';
			}
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'name'           		=>	$this->input->post('name'),
					  'company_name'        =>	$this->input->post('company_name'),
					  'description'         =>	$this->input->post('description'),
					  'phone'          		=>	$this->input->post('phone'),
					  'address'         	=>	$this->input->post('address'),
					  /*'suburb'         		=>	$this->input->post('suburb'),*/
					  'email'         		=>	$this->input->post('email'),
					  'state'         		=>	$this->input->post('state'),
					  'areas'         		=>	$this->input->post('areas'),
					  'verify_code'         =>	md5($this->input->post('email')),
					  'password'        	=>	md5($password),
					  'date_registered'     =>	date('Y-m-d'),
					  'image_url'     		=>	$original_filename
					  );
				$get_email_data = $this->General_model->addData_array($data, 'vendors');
				//Collect Email Data
				$subject_first = "Vendor Account Creation – Verification Required";
				$message_first = "<div style='".$this->config->item('style')."'>Dear ".$this->input->post('name')."(demo), <br /><br/>
				We are pleased to inform you that your account has been created. Kindly verify your account.<br />
				Your Email is ".$this->input->post('email')."<br />
				<a href='".base_url()."/vendor/confirm_vendor/".md5($this->input->post('email'))."'>Click here</a> to verify your account.
				<br /><br />
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
					
				redirect("alpha/vendors");
		}
		
		$this->data['title']='Alpha | Add Vendor ';
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['view']='alpha/add_vendor';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	
	public function edit_vendor($id)
	{
		if($this->session->userdata('alpha_id')==""){
			//echo "success";exit;
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_vendor/'.$id));
		}
		
		if(isset($_POST['edit_vendor_btn'])){
			$details= $this->General_model->get_data_by_id($id,'vendors');
			//upload image
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['Filedata']['name'];
			$original_filename = $details->image_url;
			if($_FILES['Filedata']['name']!= '')
			{
				 $this->upload->initialize(array( 'upload_path'   => 'uploads/vendor_images/',
												  'allowed_types' => 'gif|jpg|jpeg|png',
												  'overwrite'     => FALSE));
				
				if($this->upload->do_upload('Filedata'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					//resize image if size much big
					list($width, $height) = getimagesize("uploads/vendor_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'=>'gd2',
										 'source_image'=>'uploads/vendor_images/'.$original_filename,
										 'maintain_ratio'=>TRUE,
										 'width'=>'1000',
										 'height'=>'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					//resizeimage ends
				} 
			}
			$data=array(	  
					  'name'           		=>	$this->input->post('name'),
					  'company_name'        =>	$this->input->post('company_name'),
					  'description'         =>	$this->input->post('description'),
					  'phone'          		=>	$this->input->post('phone'),
					  'address'         	=>	$this->input->post('address'),
					  'state'         		=>	$this->input->post('state'),
					  'areas'         		=>	$this->input->post('areas'),
					  /*'suburb'         		=>	$this->input->post('suburb'),*/
					  'email'         		=>	$this->input->post('email'),
					  'image_url'     		=>	$original_filename
					  );
					  if($_POST['password']!='')
					  {
						  $data['password']= md5($this->input->post('password'));
					  }
					$get_email_data = $this->General_model->updateData_array($data, 'vendors', $id);
					$result['msg']		=	"success";
					redirect("alpha/vendors");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'vendors');
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['title']='Alpha | Update Vendor ';
		$this->data['view']='alpha/edit_vendor';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	
	public function vendor_services($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/vendor_services/'));
		}
		if(isset($_POST['services_submit_btn']))
		{
			/*Delete previous recods first*/ 
			$this->General_model->delete_data_using_where('vendor_id',$id, 'vendor_services');
			/*Now add new ones */
			$no_save = array('state','city','services_submit_btn','condo');
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('service_id'=>$val, 'vendor_id'=>$id), 'vendor_services');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Services Saved");
			redirect('alpha/vendors');
		}
		$this->data['service_categories']=$this->General_model->get_data_all('services_categories');
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['title']='Alpha | Vendor Services';
		$this->data['view']='alpha/vendor_services';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function service_condo_subsc($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/service_condo_subsc/'));
		}
		if(isset($_POST['services_submit_btn']))
		{
			/*Delete previous recods first*/ 
			$this->General_model->delete_data_using_where('vendor_id',$id, 'sp_services_subscription');
			/*Now add new ones */
			$no_save = array('state','city','services_submit_btn','condo');
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('service_id'=>$val, 'vendor_id'=>$id), 'sp_services_subscription');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Services Saved");
			redirect('alpha/vendors');
		}
		if(isset($_POST['condominiums_submit_btn']))
		{
			/*Delete previous recods first*/ 
			$this->General_model->delete_data_using_where('vendor_id',$id, 'sp_condos_subscription');
			/*Now add new ones */
			$no_save = array('state','city','condominiums_submit_btn',);
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('condo_id'=>$val, 'vendor_id'=>$id), 'sp_condos_subscription');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Condominiums Saved");
			redirect('alpha/vendors');
		}
		$this->data['service_categories']=$this->General_model->get_data_all('services_categories');
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['condos_list']	= $this->General_model->get_data_all('condos');
		$this->data['title']='Alpha | Services And Condo Subscription';
		$this->data['view']='alpha/service_condo_subsc';
		$this->load->view('alpha/template/main',$this->data);
	}
	
	public function vendor_condominiums($id)
	{
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/vendor_condominiums/'));
		}
		if(isset($_POST['condominiums_submit_btn']))
		{
			/*Delete previous recods first*/ 
			$this->General_model->delete_data_using_where('vendor_id',$id, 'vendor_condos');
			/*Now add new ones */
			$no_save = array('state','city','condominiums_submit_btn',);
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('condo_id'=>$val, 'vendor_id'=>$id), 'vendor_condos');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Condominiums Saved");
			redirect('alpha/vendors');
		}
		$this->data['states']		= $this->General_model->get_data_all('states');
		$this->data['condos_list']	= $this->General_model->get_data_all('condos');
		$this->data['title']		= 'Alpha | Vendor Condominiums';
		$this->data['view']			= 'alpha/vendor_condominiums';
		$this->load->view('alpha/template/main',$this->data);
	}
	public function check_category_exist()
	{
		if(isset($_POST['current_name']) && $_POST['current_name']== $this->input->post('name'))
		{
			if($_POST['table']=='incident_categories')
			{
				$this->General_model->addData_array( array('name' => $this->input->post('name')), $this->input->post('table'));
			}
			echo "not exists";
		}
		elseif($this->General_model->check_category_exist($this->input->post('table'),$this->input->post('name')))
		{
			echo "Name Already Exists.";
		}
		else
		{
			if($_POST['table']=='incident_categories')
			{
				$this->General_model->addData_array( array('name' => $this->input->post('name')), $this->input->post('table'));
			}
			echo "not exists";
		}
		
	}
	
	public function set_upload_options($upload_path, $file_type){   
		// upload image options
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $file_type;
		$config['overwrite']     = FALSE;
		return $config;
	}
	
	
	public function do_logout(){
        $this->session->sess_destroy();
		$this->session->unset_userdata('user_id');    
		redirect('alpha');
    }
	
	public function edit_field()
	{
		$select = '';
		$select.='<form method="post" action="'.base_url().'admin/edit_field_value" >';
		$select.='<input type="text" name="changed_name" class="form-control" value="'.$_POST['current_value'].'" ';
		$select.='onblur="edit_field_value(&#39;'.$_POST['id'].'&#39;, &#39;'.$_POST['field'].'&#39;, this.value, &#39;'.$_POST['table'].'&#39;, &#39;'.$_POST['current_value_id'].'&#39;';
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
	
	public function condo_copy(){
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['title']='Alpha | condo ';
		//$this->data['view']='alpha/condo_copy';
		$this->load->view('alpha/condo_copy',$this->data);
	}
	
	//Get city list from State
	public function get_city_from_state(){
			$state=$_REQUEST['state'];

			$results=$this->General_model->get_data_all_using_where('state_id', $state, 'areas');
			
			$data='';
			$data.='
			<option value="">Select Area</option>';
			foreach($results as $city_name){
				$data.='
				<option value="'.$city_name['id'].'">'.$city_name['name'].'</option>';
				}
			$result['values'] = $data;
			echo json_encode($result);
		
	}
	
	
	//Get city list from State Edit
	public function get_city_from_state_edit(){
			$state=$_REQUEST['state'];

			$results=$this->General_model->get_data_all_using_where('state_id', $state, 'areas');
			$reg_are=$this->General_model->get_data_fields('condos','areas');
			$reg_areas = array();
			foreach($reg_are as $area)
			{
				array_push($reg_areas,$area['areas']);
			}
			
			//echo json_encode($reg_areas);
			$data='';
			$data.='
			<option value="">Select Area</option>';
			foreach($results as $city_name){
				/*if(in_array($city_name['id'], $reg_areas))
				{*/
					$data.='
					<option value="'.$city_name['id'].'">'.$city_name['name'].'</option>';
				/*}*/
			}
			$result['values'] = $data;
			echo json_encode($result);
		
	}
	/******************************************************************************************/
	//////////////////////////////////////// SETTINGS //////////////////////////////////////////
	/******************************************************************************************/
	
	public function import_states(){
		if($this->session->userdata('alpha_id')==""){
			redirect('alpha'.'?next='.urlencode(base_url().'alpha/edit_vendor'));
		}
		
		if(isset($_POST["submit_states"])) {

			$target_dir = "uploads/state_area_list/";

			$target_file = $target_dir . basename($_FILES["filetoupload_states"]["name"]);

			$uploadOk = 0;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			 if (move_uploaded_file($_FILES["filetoupload_states"]["tmp_name"], $target_file)) {

				 $file = fopen($target_file, 'r');

				 $n=0;
						 
					while (($line = fgetcsv($file)) !== FALSE){
						if ( $this->General_model->data_exists('name', $line[0], 'states') == TRUE ) {
								$data=array(	  
									'name'           =>	$line[0]
								);
							$this->General_model->addData_array($data, 'states');
							$n++;	
						}
					} 
					fclose($file);

				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			} else {

				$this->session->set_flashdata("failure_message", "Sorry, there was an error uploading your file.");

			}
			//$this->session->set_flashdata('success_message', "$n Rows are Added");
			redirect('alpha/import_states');

		}
		
		if(isset($_POST["submit_areas"])) {

			$target_dir = "uploads/state_area_list/";

			$target_file = $target_dir . basename($_FILES["filetoupload_areas"]["name"]);

			$uploadOk = 0;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			 if (move_uploaded_file($_FILES["filetoupload_areas"]["tmp_name"], $target_file)) {

				 $file = fopen($target_file, 'r');

				 $n=0;
						 
					while (($line = fgetcsv($file)) !== FALSE){
						if ( $this->General_model->data_exists('name', $line[0], 'areas') == TRUE ) {
							$state_name = $line[1];
							$action = "name='$state_name'";
							$get_state_id = $this->General_model->get_data_value_using_where('states',$action,'id');
							if($get_state_id == '0'){
								if ( $this->General_model->data_exists('name', $line[1], 'states') == TRUE ) {
									$data_add_state = array(
										'name'=>$line[1],
									);
									
									$DbFieldsArray 		= array('name');
				
									$DataArray = array($line[1]);
									$last_id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray, 'states');
									
									//Update area with last id
									$data_area = array(
										'name'=>$line[0],
										'state_id'=>$last_id
									);
									$this->General_model->addData_array($data_area, 'areas');
								}
							} else {
								$data = array(
									'name'=>$line[0],
									'state_id'=>$get_state_id
								);
						
							
								$this->General_model->addData_array($data, 'areas');
								$n++;	
								}
							}
					} 
					fclose($file);

				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			} else {

				$this->session->set_flashdata("failure_message", "Sorry, there was an error uploading your file.");

			}
			//$this->session->set_flashdata('success_message', "$n Rows are Added");
			redirect('alpha/import_states');

		}
		$this->data['title']='Alpha | Import States';
		$this->data['view']='alpha/import_states';
		$this->load->view('alpha/template/main',$this->data);
		
	}
	
	/******************************************************************************************/
	/////////////////////////////////////// END SETTINGS ///////////////////////////////////////
	/******************************************************************************************/
} 