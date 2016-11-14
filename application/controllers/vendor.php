<?php defined('BASEPATH') OR exit('No direct script access allowed');

class vendor extends CI_Controller {
	
	var $data;
	var $vendor_id;
	var $access_level;

	public function __construct(){

		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		
		$protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
		$this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->vendor_id=$this->session->userdata('vendor_id');
		$this->access_level=$this->session->userdata('access_level');
		$this->load->model('General_model');
		$this->load->model('Authentication_model');
		$this->load->model('encrypt_model');
	}
	
	public function index()
	{
	
 		if($this->session->userdata('vendor_id')!=""){
			redirect('vendor/dashboard');
		}
		
		
		$this->data['title']='Vendor| Log in';
		$this->load->view('vendor/login',$this->data);
	}
	
	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	//Login Check
	public function check_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Authentication_model->vendor_authentication_login($email, $password,'vendors')){
			if($this->Authentication_model->vendor_active_account_check($email, $password,'vendors')){
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
			if ( $this->General_model->data_exists($field, $this->input->post($field), $table) == FALSE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}
	
	//Check Password(MD5) existance
	public function check_data_exists_md5($field, $table){
		if (array_key_exists($field,$_POST)) {
			if ( $this->Authentication_model->data_exists_md5_vendor($field, $this->input->post($field), $table) == TRUE ) {
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
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		$services = '0';
		$services_a=$this->General_model->get_data_all_like_using_where('vendor_services',"vendor_id=".$this->session->userdata('vendor_id'));
		foreach($services_a as $service)
		{
			$services.=",".$service['service_id'];
		}
		$this->data['service_requests']=$this->General_model->get_data_all_like_using_where('service_requests',"service_id IN($services) AND id NOT IN(select service_request_id from service_quotes) AND (requested_time  + INTERVAL duration DAY>NOW() )");
		$this->data['vendor_quotes']=$this->General_model->get_data_all_like_using_where('service_quotes',"quoted_by=".$this->session->userdata('vendor_id'));
		$this->data['title']='Vendor | Dashboard';
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['view']='vendor/dashboard';
		$this->load->view('vendor/template/main_copy',$this->data);
	}
	
	public function vendor_quotes()
	{
		
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		$this->data['vendor_quotes']=$this->General_model->get_data_all_like_using_where('service_quotes',"quoted_by=".$this->session->userdata('vendor_id'));
		$this->data['title']='Vendor | Quotes';
		$this->data['view']='vendor/vendor_quotes';
		$this->load->view('vendor/template/main_copy',$this->data);
	}
	public function services_quotes_comments($id)
	{
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		if(isset($_POST['quotation_file_upload'])){
				$this->load->library('upload');
				$files = $_FILES;
				$cpt = $_FILES['quotation_file']['name'];
				$original_filename = '';
				if($_FILES['quotation_file']['name']!= '')
				{
					 $upload_path = "uploads/services_quotes/";
					 $file_type = "gif|jpg|jpeg|png|pdf";
					 $this->upload->initialize(array('upload_path'	=>$upload_path,
													 'allowed_types'=>$file_type,
													 'overwrite'	=>FALSE));
					if($this->upload->do_upload('quotation_file'))
					{
						$uploaddata = $this->upload->data();
						$result['filename'] = $uploaddata['file_name'];
						$original_filename = $result['filename'];
					} 
				}
				else 
				{
					$original_filename =  $this->upload->display_errors();
				}
				/*'amount'        		  =>	$this->input->post('amount'),*/
				$DbFields=array('quotation_file');
				$Dbdata=array($original_filename);
				$update=$this->General_model->updateData($id, 'id', $DbFields,$Dbdata,'service_quotes');
				redirect("vendor/services_quotes_comments/$id");
		}
		$action="service_qoute_id='$id' order by insertDate desc";
		$this->data['quotes_comments'] = $this->General_model->get_data_all_like_using_where('service_quotes_comments', $action);
		$this->data['title']='ALIA | Services Quotes Comments';		
		$this->data['view']='vendor/services_quotes_comments';
		$this->load->view('vendor/template/main_copy',$this->data);
	}
	
	public function quote_request($qoute_id)
	{
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		$checkrows =$this->General_model->get_data_all_like_using_where('service_quotes',"service_request_id='$qoute_id' AND ven_arival_time!='0000-00-00 00:00:00'");
		if(sizeof($checkrows)>0)
		 {
			 $this->session->set_flashdata('success_message', "Quote Already Sent on this request");
			  redirect('vendor/dashboard');
		 }
		if(isset($_POST['qoute_btn'])){
				$this->load->library('upload');
				$files = $_FILES;
				$cpt = $_FILES['quotation_file']['name'];
				$original_filename = '';
				if($_FILES['quotation_file']['name']!= '')
				{
					 $upload_path = "uploads/services_quotes/";
					 $file_type = "gif|jpg|jpeg|png|pdf";
					 $this->upload->initialize(array('upload_path'	=>$upload_path,
													 'allowed_types'=>$file_type,
													 'overwrite'	=>FALSE));
					if($this->upload->do_upload('quotation_file'))
					{
						$uploaddata = $this->upload->data();
						$result['filename'] = $uploaddata['file_name'];
						$original_filename = $result['filename'];
					} 
				}
				else 
				{
					$original_filename =  $this->upload->display_errors();
				}
					  /*'amount'        		  =>	$this->input->post('amount'),*/
					  $DbFields=array('description','quoted_by','service_request_id','quoted_on','min_budget','max_budget', 'quotation_file');
					  $Dbdata=array($this->input->post('description'),$this->session->userdata('vendor_id'),$qoute_id,date('Y-m-d H:i:s'),$this->input->post('min_budget'),$this->input->post('max_budget'),$original_filename);
					   $checkrows = $this->General_model->get_data_all_using_where('service_request_id',$qoute_id, 'service_quotes');
					   //echo sizeof($checkrows);exit;
					   if(sizeof($checkrows)>0)
					   {
						   foreach($checkrows as $row)
						   {
							   $update=$this->General_model->updateData($row['id'], 'id', $DbFields,$Dbdata,'service_quotes');
							   $insert_id=$row['id'];
						   }
					   }
					   else
					   {
						   $insert_id = $this->General_model->addData_InsertID($DbFields, $Dbdata, 'service_quotes');
						   
						   //save in db
				$resident_id = $this->General_model->get_value_by_id('service_requests', $qoute_id, 'requested_by');
				$condo_id = $this->General_model->get_value_by_id('service_requests', $qoute_id, 'condo_id');

				$DbFieldsArray_noti 		= array('session_id', 'person_id', 'facility_id', 'code', 'condo_id', 'insertDate', 'msg_time');
				$DataArray_noti = array($resident_id, 0, 0, 'New Quote', $condo_id, date('Y-m-d H:i:s'), time());
				$this->General_model->addData($DbFieldsArray_noti,$DataArray_noti,'notifications');
					   }
					$reciver = $this->General_model->get_value_by_id('service_requests', $qoute_id, 'requested_by');
					$today=date('Y-m-d H:i:s');
					$CMFields=array('comment','sender','receiver','service_qoute_id','actor','insertDate');
					$CMdata=array($this->input->post('description'), $this->session->userdata('vendor_id'), $reciver,$insert_id,'vendor',$today);	
					$comment_id = $this->General_model->addData_InsertID($CMFields, $CMdata, 'service_quotes_comments');
				//Collect Email Data
				$service_requests =$this->General_model->get_data_by_id($qoute_id,'service_requests');
				$subject_first = "New service quote received";
				$message_first = "<div style='".$this->config->item('style')."'>Hi ".$this->General_model->get_value_by_id('residents',$service_requests->requested_by, 'name').", <br />

				".$this->General_model->get_value_by_id('vendors',$this->session->userdata('vendor_id'), 'name')." has responded to your recent service request.<br /><br />
				
				Description:".$this->input->post('description')."<br /><br />
				Price Estimate (RM): ".$this->input->post('amount')."";
				if($original_filename!='')
				{
					$message_first .="<br /> <br>File: ".base_url()."uploads/services_quotes/".$original_filename;
				}
				if($this->input->post('min_budget')!='')
				{
					$message_first .=" Minimum Budget: ".$this->input->post('min_budget');
				}
				if($this->input->post('max_budget')!='')
				{
					$message_first .=" - Maximum Budget: ".$this->input->post('max_budget');
				}
				$message_first .="<br /><br />
				Please login to your account to accept or reject this service quotation.<br />
				1.	Login to your account at www.als.com.my<br />
				2.	Under Services, click on Requests & Quotes<br />
				3.	Under Quotes, in the Actions column, click on the chat icon to view quotation, <br />
				vendor profile and communicate with the service provider.<br />
				4.	Click on Hire once you have decided to engage your chosen service provider.<br />
				5.	Don't forget to leave a review once the provider has completed the job.<br /><br />

				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_value_by_id('residents',$service_requests->requested_by, 'email'), $this->General_model->get_value_by_id('residents',$service_requests->requested_by, 'name'), $subject_first, $message_first);
				redirect("vendor/dashboard");
		}
		$action="id='$qoute_id'";
		$this->data['request_info'] = $this->General_model->get_data_row_using_where('service_requests', $action);
		$this->data['title']='Vendor | Quote Request ';
		$this->data['view']='vendor/quote_request';
		$this->load->view('vendor/template/main',$this->data);
	}
	
	public function service_feedback($qoute_id)
	{
		$this->data['title']='Vendor | Service Feedback ';
		//$this->data['view']='vendor/service_feedback';
		$this->load->view('vendor/service_feedback',$this->data);
	}
	
	public function add_rating()
	{
		if(!empty($_POST["rating"]) && !empty($_POST["id"])) {
			$DbFieldsArray	= array('feedback','rating');
			$DataArray		= array($_POST["feedback"], $_POST["rating"]);
			$this->General_model->updateData($_POST["id"], 'id', $DbFieldsArray, $DataArray, 'service_requests' );
		}
	}
	
	public function confirm_vendor($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('vendors',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Confirmed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('1');
			$whereClouse = "verify_code='$verify_code'";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'vendors');
			$row =$this->General_model->get_data_row_using_where('vendors', $whereClouse);
			//email
			$subject_first = "Vendor Account Created";
			$message_first = "<div style='".$this->config->item('style')."'>Hi ".$row->name.", <br /><br/>
			Thank you for joining the ALIA.<br /><br/>

			Our mission is to help you connect with residents within our community, and bring the customers to you.<br /><br/>

			<h3>Here's how it works.</h3><br /><br/>

			<h4>1) JOB REQUEST NOTIFICATION</h4><br /><br/>
			•	You will receive a notification when a customer creates a job request<br/>
			•	Each job request will contain details of what needs to be done<br/><br/>
			
			<h4>2) SEND A QUOTE</h4><br /><br/>
			•	If the job request is relevant to you – you can respond by sending a quote.<br/>
			•	Your quote should include a personal message and a price estimate<br/><br/>
			
			<h4>3) GET HIRED</h4><br /><br/>
			•	Customer compares your quote with others and decides who to contact<br/>
			•	You can talk to the customer directly to work out the details of the job<br/>
			•	Once you're hired and get the job done, don't forget to ask the customer to leave a review for you.<br/><br/>
			
			<h3>Tips to get hired.</h3><br /><br/>
			
			<h4>Build an appealing profile</h4><br /><br/>
			•	Highlight your skills and display your credentials and professional licenses<br/>
			•	Include a photo of yourself or your company<br/><br/>
			<h4>Personalized greeting and message</h4><br /><br/>
			•	Provide your full name, and contact details<br/>
			•	Your quote should include a clear and professional message<br/>
			•	Personalized message for the specific Job Request<br/>
			•	Answer the customer's questions in their request<br/>
			•	Always be courteous and professional<br/><br/>
			<h4>Competitive estimate</h4><br /><br/>
			•	Make sure your quote is accurate, don't just quote a low price to get the job. <br/>
			•	Explain why you charge what you charge<br/><br/>
			<h4>Send more Quotes, Quickly!</h4><br /><br/>
			•	Quotations are submitted to the customer on a first come first serve basis.<br/>
			•	The quicker you respond to a service request, the better your chances of getting hired.<br/><br/>
			<h4>Ask for customer's review</h4><br /><br/>
			•	Customers will pay particular attention to the reviews from your previous customers.<br/> 
			•	The more reviews you have, the better your chances of being hired.<br/><br/>
			<h4>Be Persistent!</h4><br /><br/>
			•	ALIA can help bring customers to you, but it's up to you to make use of them. <br/>
			•	Only reply to a Job Request if you are qualified. <br/>
			•	Be persistent and learn how to make ALIA work best for you and watch your business grow.<br/><br/>
			
			
			Let's build a more responsive, reliable, and rewarding community together.


			<br /><br />
			</div>
			";
			$this->email($row->email, $row->name, $subject_first, $message_first);
		}
		else
		{
			$this->data['message']='Email Not Confirmed';
		}
		 
		
		if(isset($_POST['change_password_btn'])){
			$new_password 		= $this->input->post('password');
			
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($verify_code,'verify_code',$DbFieldsArray,$DataArray,'vendors');
			//
			$this->db->where('verify_code',$verify_code);
			$this->db->where('password',md5($new_password));		
			$query=$this->db->get('vendors');
			if($query->num_rows==1)
			{
				$row = $query->row();
				$data = array(
                    'vendor_id'     => $row->id,
					'email'           => $row->email,
					'name'   	      => $row->name
                    );
                 $this->session->set_userdata($data);
			}
			
			redirect('vendor');  
		}
		
		$this->data['title']='Vendor | Confirm Vendor';
		$this->load->view('vendor/confirm_vendor',$this->data);
	}
	
	/*
	public function services()
	{
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		if(isset($_POST['services_submit_btn']))
		{
			//Delete previous recods first
			$this->General_model->delete_data_using_where('vendor_id',$this->session->userdata('vendor_id'), 'vendor_services');
			//Now add new ones 
			$no_save = array('state','city','services_submit_btn','condo');
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					//print_r($value);exit;
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('service_id'=>$val, 'vendor_id'=>$this->session->userdata('vendor_id')), 'vendor_services');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Services Saved");
			redirect('vendor/services');
		}
		$this->data['service_categories']=$this->General_model->get_data_all('services_categories');
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['title']='Vendor | Services';
		$this->data['view']='vendor/services';
		$this->load->view('vendor/template/main',$this->data);
	}
	
	public function condominiums()
	{
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		if(isset($_POST['condominiums_submit_btn']))
		{
			//Delete previous recods first 
			$this->General_model->delete_data_using_where('vendor_id',$this->session->userdata('vendor_id'), 'vendor_condos');
			//Now add new ones 
			$no_save = array('state','city','condominiums_submit_btn',);
			foreach($_POST as $name=>$value)
			{
				if(!in_array($name, $no_save))
				{
					//print_r($value);exit;
					foreach($value as $val)
					{
						$get_email_data = $this->General_model->addData_array(array('condo_id'=>$val, 'vendor_id'=>$this->session->userdata('vendor_id')), 'vendor_condos');
					}
				}
			}  
			$this->session->set_flashdata('success_message', "Condominiums Saved");
			redirect('vendor/condominiums');
		}
		$this->data['states']= $this->General_model->get_data_all('states');
		$this->data['condos_list']= $this->General_model->get_data_all('condos');
		$this->data['title']='Vendor | Condominiums';
		$this->data['view']='vendor/condominiums';
		$this->load->view('vendor/template/main',$this->data);
	}*/
	
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
		$this->session->unset_userdata('vendor_id');    
		redirect('vendor');
    }
	
	public function change_password(){
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'vendors');
		redirect('vendor/change_password'); 
		}
		
		$this->data['title']='Vendors | Change Password';
		$action = "id = '$this->vendor_id'";
		$this->data['alpha_info']= $this->General_model->get_data_row_using_where('vendors', $action);
		$this->data['view']='vendor/change_password';
		$this->load->view('vendor/template/main',$this->data);
	}
public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email'";
				$condo_info_admins = $this->General_model->get_data_row_using_where('vendors',$action);
				$condo_alpha_name_id = $condo_info_admins->id;
				$condo_alpha_name_admins = $condo_info_admins->name;
				
				$DbFieldsArray 		= array('forgot_pass_count','verify_code');
				$DataArray = array('0',md5($email));
				$this->General_model->updateData($email,'email',$DbFieldsArray,$DataArray,'vendors');
				
				$verification_code_id = base64_encode($condo_alpha_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."vendor/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Forgot Password Link";
				$message = "Dear ".$condo_alpha_name_admins.", <br />
				You have requested for Forgot Password Option.<br/><br/>

				Click the below link to change your password.<br/>
				".$verification_link."<br/><br/>
				
				Regards,<br/>
				ALIA
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
		$condo_info_admins = $this->General_model->get_data_row_using_where('vendors',$action);
		$condo_forgot_pass_count = $condo_info_admins->forgot_pass_count;
		
		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";
		if($get_key_id = $this->General_model->update_data_using_multiwhere_custom($where, $action_to_be_filled, 'vendors')){
			$this->data['verify_data'] = $get_key_id;
		} else {
			$this->data['verify_data'] = 'USED';
		}
		
		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'vendors');
		
		//login him
			$this->db->where('id',$id);
			$query=$this->db->get('vendors');
			$row = $query->row();
			$data = array(
				'vendor_id'     	  => $row->id,
				'email'       => $row->email,
				'name'   => $row->name
				);
			 $this->session->set_userdata($data);
		redirect('vendor'); 
		}
		
		$this->data['title']='Vendor | Forgot Password Change';
		$this->load->view('vendor/forgot_password_change',$this->data);
	
	}
	public function profile(){
		if($this->session->userdata('vendor_id')==""){
			redirect('vendor'."?next=".$this->url);
		}
		
		if(isset($_POST['venprofsubmit'])){
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			
		$DbFieldsArray 		= array('name'=>$this->input->post('name'),
									'company_name'=>$this->input->post('company_name'),
									'phone'=>$this->input->post('phone'),
									'mobile'=>$this->input->post('mobile'),
									'address'=>$this->input->post('address'),
									'areas'=>$this->input->post('city'),
									'email'=>$this->input->post('email'));
		$this->General_model->updateData_array($DbFieldsArray,'vendors',$id);
		
		redirect('vendor/profile'); 
		}
		
		$this->data['title']='Vendor | Profile';
		$action = "id = '$this->vendor_id'";
		$this->data['vendor_info']= $this->General_model->get_data_row_using_where('vendors', $action);
		$this->data['areas']= $this->General_model->get_data_all('areas');
		$this->data['view']='vendor/profile';
		$this->load->view('vendor/template/main_copy',$this->data);
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
		//Get city list from State Edit
	public function get_city_from_state_edit(){
			$state=$_REQUEST['state'];
			if($state=='All')
			{
				$results=$this->General_model->get_data_all('areas');
			}
			else
			{
				$results=$this->General_model->get_data_all_using_where('state_id', $state, 'areas');
			}
			$reg_are=$this->General_model->get_data_all('condos');
			$reg_areas = array();
			foreach($reg_are as $area)
			{
				array_push($reg_areas,$area['areas']);
			}
			$reg_condos = array();
			$data_option='';
			$data_option.='<div class="ms-options-wrap" style="position: relative;"><button>Select options</button><div class="ms-options" style="min-height: 200px; overflow: auto; display: block; max-height: 200px;"><ul style="-webkit-column-count: 4; -webkit-column-gap: 0px;">';
			$data='';
			$data.='
			<option value="">Select Area</option>';
			foreach($results as $city_name){
				if(in_array($city_name['id'], $reg_areas))
				{
					$data.='
					<option value="'.$city_name['id'].'">'.$city_name['name'].'</option>';
					array_push($reg_condos,$city_name['id']);
					$data_option.='<li><label for="ms-opt-'.$city_name['id'].'" style="padding-left: 21px;"><input type="checkbox" value="'.$city_name['id'].'" title="'.$city_name['name'].'" id="ms-opt-'.$city_name['id'].'" name="city[]">'.$city_name['name'].'</label></li>';
				}
			}
			$data_option.='</ul></div></div>';
			$result['values_option'] = $data_option;
			$result['values'] = $data;
			//registerd condos of this state
			$condo_data='';
			$condo_data.='
			<option value="">Select Condo</option>';
			foreach($reg_are as $condo_name){
				if(in_array($condo_name['areas'], $reg_condos))
				{
					$condo_data.='
					<option value="'.$condo_name['id'].'">'.$condo_name['name'].'</option>';
				}
			}
			$result['condo_values'] = $condo_data;
			echo json_encode($result);
		
	}
	
} 