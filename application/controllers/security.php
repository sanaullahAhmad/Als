<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {
	
	var $data;
	var $security_id;

	public function __construct(){

		parent::__construct();
		
		$protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
		$this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->security_id=$this->session->userdata('security_id');
		$this->condo_id=$this->session->userdata('condo_id');
		$this->load->model('Authentication_model');
		$this->load->model('General_model');
	}
	
	public function index()
	{
 		if($this->session->userdata('security_id')!=""){
			redirect('security/dashboard');
		}
		$this->data['title']='Security | Log in';
		$this->load->view('security/login',$this->data);
	}
	
	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	//Login Check
	public function check_login(){
		//echo 'success';
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Authentication_model->security_authentication_login($email, $password)){
			if($this->Authentication_model->security_active_account_check($email, $password)){
			  if($this->Authentication_model->security_condo_active_check($email, $password)){
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
			if ( $this->Authentication_model->data_exists_md5_security($field, $this->input->post($field), $table) == TRUE ) {
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
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests',"(date(deliverydatetime) = CURDATE() || date(deliverydatetime) = CURDATE() + INTERVAL 1 DAY) AND condo_id=".$this->condo_id."  AND status=1 ORDER BY deliverydatetime DESC");
		//For getting visitor requests and delivery requests
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where('visitor_requests',"(date(visitdatetime) = CURDATE() || date(visitdatetime) = CURDATE() + INTERVAL 1 DAY) AND condo_id=".$this->condo_id." ORDER BY visitdatetime DESC");
		
		
		// print_r($this->data['delivery_requests']);exit;
		$this->data['title']='Security | Dashboard';
		//$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['view']='security/dashboard';
		$this->load->view('security/template/main_copy',$this->data);
	}
	
	public function condo()
	{
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
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
			
 		$DbFieldsArray 		= array('name','phone', 'mobile', 'address', 'city', 
									'state', 'postcode', 'condo_picture', 'registered_on', 'status');
		
		$DataArray = array($name, $phone, $mobile, $address, $city, $state, $post_code, $original_filename, $date_time, '1');
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condos');
		redirect('manager/condo'); 
		
		}
		
		$this->data['title']='Security | Condo Profile';
		$this->data['view']='security/condo';
		$this->load->view('security/template/main',$this->data);
	}
	
	public function profile(){
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		
		if(isset($_POST['manprofsubmit'])){
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			
		$DbFieldsArray 		= array('full_name');
		$DataArray = array($name);
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condo_admins');
		redirect('security/profile'); 
		}
		
		$this->data['title']='Security | Profile';
		$action = "id = '$this->security_id'";
		$this->data['security_info']= $this->General_model->get_data_row_using_where('condo_admins', $action);
		$this->data['view']='security/profile';
		$this->load->view('security/template/main',$this->data);
	}
	
	public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email' and role ='2'";
				$condo_info_admins = $this->General_model->get_data_row_using_where('condo_admins',$action);
				$condo_alpha_name_id = $condo_info_admins->id;
				$condo_alpha_name_admins = $condo_info_admins->full_name;
				
				
				$where = "email='$email' AND role='2'";
				$action = "forgot_pass_count='0'";
				$this->General_model->update_data_using_multiwhere($where,$action,'condo_admins');
				
				$verification_code_id = base64_encode($condo_alpha_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."security/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Forgot Password Link";
				$message = "Dear ".$condo_alpha_name_admins.", <br />
				You have requested for Forgot Password Option.<br/><br/>

				Click the below link to change your password.<br/>
				".$verification_link."<br/><br/>
				";

				//Send Forgot Password Link
				$this->email($email, $condo_alpha_name_admins, $subject, $message);
				echo 'LINKSENT';
				}
		
	}
	
	public function forgot_password_change($verification_code_id, $verification_code_email){
		$verification_code_id_decode = base64_decode($verification_code_id);
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email' and role = '2'";
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
			
		$new_password = md5($new_password);
		$where = "id='$id' AND role='2'";
		$action = "password='$new_password'";
		$this->General_model->update_data_using_multiwhere($where,$action,'condo_admins');
		redirect('security'); 
		}
		
		$this->data['title']='Security | Forgot Password Change';
		$this->load->view('security/forgot_password_change',$this->data);
	}
	
	public function change_password(){
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'condo_admins');
		redirect('security/change_password'); 
		}
		
		$this->data['title']='Security | Change Password';
		$action = "id = '$this->security_id'";
		$this->data['security_info']= $this->General_model->get_data_row_using_where('condo_admins', $action);
		$this->data['view']='security/change_password';
		$this->load->view('security/template/main',$this->data);
	}
	
	public function set_upload_options($upload_path, $file_type){   
		// upload image options
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $file_type;
		$config['overwrite']     = FALSE;
		return $config;
	}
	
	public function confirm_user($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('condo_admins',"verify_code='$verify_code' AND role =2");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Confirmed';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('1');
			$whereClouse = "verify_code='$verify_code' AND role =2";
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
					'security_id'     	  => $row->id,
					'security_email'       => $row->email,
					'condo_id'       		 => $row->condo_id,
					'security_name'        => $row->full_name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('security');  
		}
		
		$this->data['title']='Security | Confirm Security';
		$this->load->view('security/confirm_security',$this->data);
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
		redirect('security');
    }
	public function checkintime(){
        $field 				= $this->input->post('field');
        $visitor_request_id = $this->input->post('visitor_request_id');
        $table 				= $this->input->post('table');
		$ver =$this->General_model->update_data_using_multiwhere("id=$visitor_request_id", " $field='".date('Y-m-d H:i:s')."'", $table);
		echo $field;
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
	
	
	
	
	public function add_visitor_delivery()
	{
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		
		if(isset($_POST['add_visitor_delivery_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);	  
			$resident       =	$this->input->post('resident');
			$type        	=	$this->input->post('type');
			$data = array(
                    'resident_del_vis_id'     	  => $resident
                    );
            $this->session->set_userdata($data);
			redirect("security/add_entry_".$type);
		}
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Security | Add Visitor / Delivery ';
		$this->data['view']='security/add_visitor_delivery';
		$this->load->view('security/template/main',$this->data);
	}
	
	
	public function add_entry_visitor()
	{
		
		if($this->session->userdata('resident_del_vis_id')==""){
			redirect('security');
		}
		
		if(isset($_POST['addvisitersubmit'])){
			$description 	= $this->input->post('description');
			$vehicle_no 	= $this->input->post('vehicle_no');
			$visitor_name 	= $this->input->post('visitor_name');
			$date 			= $this->input->post('date');
			$resident_del_vis_id= $this->input->post('resident_del_vis_id');
			$time 			= $this->delivery_time_format($this->input->post('time'));
			//echo "$date $time";exit;
			$DbFieldsArray 		= array('visitor_name', 'visitor_for', 'visitor_reason', 'vehicle_no', 'condo_id', 'visitdatetime');
			$DataArray = array($visitor_name, $resident_del_vis_id, $description, $vehicle_no, $this->condo_id, "$date $time");
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'visitor_requests');
			
			$data = array(
                    'resident_del_vis_id'     	  => ''
                    );
            $this->session->set_userdata($data);
			$this->session->set_flashdata('message', 'Visitor Record Saved.');
			redirect("security/dashboard");
		}
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Security | Add Entry Visitor';
		$this->data['view']='security/add_entry_visitor';
		$this->load->view('security/template/main',$this->data);
	}
	
	public function add_entry_delivery()
	{
		
		if($this->session->userdata('resident_del_vis_id')==""){
			redirect('security');
		}
		
		if(isset($_POST['adddeliverysubmit'])){
			$description 	= $this->input->post('description');
			$company_name 	= $this->input->post('company_name');
			$icid_number 	= $this->input->post('icid_number');
			$driver_name 	= $this->input->post('driver_name');
			$resident_del_vis_id= $this->input->post('resident_del_vis_id');
			$DbFieldsArray 	= array('delivery_for', 'description', 'condo_id', 'deliverydatetime','company_name','driver_name','icid_number');
			$DataArray 		= array($resident_del_vis_id, $description, $this->condo_id, date('Y-m-d H:i:s'),$company_name, $driver_name,$icid_number);
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'delivery_requests');
			
			
			$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						$subject_admin = "Delivery Request";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
						
						A new Delivery Request has been registered under you condo. Please do check. The details are as follows:<br />
						description: ".$this->input->post('description')."<br />
						company name: ".$this->input->post('company_name')."<br />
						icid_number: ".$this->input->post('icid_number')."<br />
						driver_name: ".$this->input->post('driver_name')."<br />
						Delivery date:".date('Y-m-d')."<br />
						Delivery time: ".date('h:i A')."
						
						<br /><br /></div>
						
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					}
				}
			
			
			$data = array(
                    'resident_del_vis_id'     	  => ''
                    );
            $this->session->set_userdata($data);
			$this->session->set_flashdata('message', 'Delivery Record Saved.');
			redirect("security/dashboard");
		}
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Security | Add Entry Delivery';
		$this->data['view']='security/add_entry_delivery';
		$this->load->view('security/template/main',$this->data);
	}
	public function delivery_time_format($delivery_time)
	{
			$endtime='';
			$delivery_time_ends  = explode(' ',$delivery_time);
			$delivery_time_ends2 = explode(':',$delivery_time);
			if($delivery_time_ends[1]=='PM')
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$hour = $hour+12;
				$minut = substr($delivery_time_ends2[1],0,2);
				if($hour==24){$hour='00';}
				$endtime = "$hour:$minut:00";
			}
			else
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$minut = substr($delivery_time_ends2[1],0,2);
				$endtime = "$hour:$minut:00";
			}
			return $endtime;
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
		 
		
		if(isset($_POST['forgotpasssubbutton'])){
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($verify_code,'verify_code',$DbFieldsArray,$DataArray,'residents');
		redirect('manager'); 
		}
		
		$this->data['title']='Manager | Confirm Resident';
		$this->load->view('manager/confirm_resident_change',$this->data);
	}
	
	public function add_resident()
	{
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
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
					
					//Collect Email Data
				$subject_first = "Welcome to ALIA - Your Life Style & Property Solutions";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />

				Welcome to the ALIA community.<br />
				
				Your Email is ".$this->input->post('email')."<br />
				
				Your password is ".$password.".<br />
				
				<a href='".base_url()."manager/confirm_resident/".md5($this->input->post('email'))."'>Click here</a> to Confirm And login .<br /><br />We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br /><br />Our mission is to help you on your property management matters so that you can get things done with less work.<br /><br />
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
				redirect("manager/residents");
		}
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$condo_id = $this->session->userdata('condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Manager | Add Resident ';
		$this->data['view']='security/add_resident';
		$this->load->view('security/template/main',$this->data);
	}
	

	public function change_floors()
	{
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		$id = $this->input->post('id');
		$condos=$this->General_model->get_data_row_using_where('blocks',"id = $id");
		echo json_encode($condos);
		//echo $condos->floors;
	}
	
	public function search_resident()
	{
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
		}
		$block = $this->input->post('blocks');
		$floor = $this->input->post('floors');
		$unit = $this->input->post('units');
		$resident=$this->General_model->get_data_row_using_where('residents',"block = '$block' AND floor = '$floor' AND unit = '$unit'");
		if($resident!="")
		{
			echo json_encode($resident);
		}
		else
		{
			echo json_encode(array('id'=>'','name'=>'No Resident Found'));
		}
		//echo $condos->floors;
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
		$this->data['view']='security/reset_password';
		$this->load->view('security/template/main',$this->data);
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
		
		if($this->session->userdata('security_id')==""){
			redirect('security'."?next=".$this->url);
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
				$this->data['view']='security/send_sms';
				$this->load->view('security/template/main',$this->data);
	}
	
} 