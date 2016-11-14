<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resident extends CI_Controller {
	
	var $data;
	var $url;
	//var $manager_id;

	public function __construct(){

		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		
		$protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
		$this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->load->model('Authentication_model');
		$this->load->model('General_model');
		$this->resident_id=$this->session->userdata('resident_id');
	}
	
	public function index()
	{
		if($this->session->userdata('resident_id')!=""){
			redirect('resident/dashboard');
		}
		$this->data['title']='ALIA | Your Lifestyle & Property Solutions';
		$this->load->view('index',$this->data);
	}
	
	public function molpay(){
		//Load the library file
		$InpageMolpay  = $this->load->library('InpageMolpay');

//'require_once '../MOLPay/distribution/InpageMolpay.php';

//Instantiate the library

//Important - checking if the page should redirect to the real return URL
//$this->InpageMolpay->checkReturn();

//Define the parameters by using attribute initialize
$this->InpageMolpay->merchantID = 'molpaytech';
/*$this->InpageMolpay->orderID = 'DEMO1045';
$this->InpageMolpay->amount = 1.10;
$this->InpageMolpay->bill_name = 'MOLPay demo';
$this->InpageMolpay->bill_email = 'demo@molpay.com';
$this->InpageMolpay->bill_mobile = '0355218438';
$this->InpageMolpay->bill_description = 'testing by MOLPay';
$this->InpageMolpay->country = 'MY';
$this->InpageMolpay->returnURL = 'processing.php';
$this->InpageMolpay->vcode = '0d72ceec9ee3848f4721697f5dca166e';
$this->InpageMolpay->currency = 'MYR';
$this->InpageMolpay->langcode = 'en';
$this->InpageMolpay->payment_type = 'fpx.php';

//Generate the inpage code and save it into the variables
$InpageMolpay = $this->InpageMolpay->trigger();
echo $InpageMolpay;*/
	}
	
	
	
	
	public function test_pdf(){
		if(!empty($_POST['data'])){
			$data = $_POST['data'];
			$fname = "test.pdf"; // name the file
			$file = fopen(base_url()."uploads/state_area_list/".$fname, 'w'); // open the file path
			fwrite($file, $data); //save data
			fclose($file);
		} else {
			echo "No Data Sent";
		}
	}
	
	
	public function print_item() { 
	// load library 
	$this->load->library('pdf'); 
	$pdf = $this->pdf->load(); 
	// retrieve data from model 
	//$data['all_itemreport'] = $this->itemreport->get_items(); 
	/*$html = '
	<div id="invoice" class="invoice" style="background:#FFF;border:none">
                    <div class="row">
					 <div class="col-xs-12">
                    	<div class="col-xs-6">
                        	DFG
						</div>
                        
                        <div class="col-xs-6 ">
                        	<span class="pull-right">
                             <p> #0000
                                <span class="muted"> Invoice </span>
                            </p>
                            </span>
						</div>
                        </div>
					</div>
	
	'; */
	ini_set('memory_limit', '256M'); 
	// boost the memory limit if it's low ;) 
	$html = $this->load->view('resident/add_resident', $data, true); 
	// render the view into HTML 
	$pdf->WriteHTML($html); 
	// write the HTML into the PDF 
	$output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf'; 
	$pdf->Output("$output", 'I'); 
	// save to file because we can 
	exit(); 
	} 
	
	
	public function dashboard()
	{
		
		/*if($this->session->userdata('resident_id')==""){
			redirect('resident/login'."?next=".$this->url);
		}
*/		
//Load the library file
/*require_once 'MOLPay/distribution/InpageMolpay.php';

//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();

$molpay->checkReturn();

//Define the parameters by using attribute initialize
$molpay->merchantID = 'test7441';
$molpay->orderID = 'DG873';
$molpay->amount = 1.10;
$molpay->bill_name = 'MOLPay demo';
$molpay->bill_email = 'demo@molpay.com';
$molpay->bill_mobile = '0355218438';
$molpay->bill_description = 'testing by MOLPay';
$molpay->country = 'MY';
$molpay->returnURL = 'http://als.com.my/v2/resident/processing';
$molpay->vcode = 'e1d4bf3aa8dfd96f7bd89aefdd1e9be6';
$molpay->currency = 'MYR';
$molpay->langcode = 'en';
$molpay->payment_type = 'fpx.php';
	$molpay_inpage = $molpay->trigger();*/

		$this->data['title']='Resident | Dashboard';
		$this->load->view('resident/dashboard',$this->data);
	}
	
	public function processing(){
		 		$this->load->view('resident/profile',$this->data);

	}
	
	public function login()
	{
	
 		if($this->session->userdata('resident_id')!=""){
			redirect('resident/dashboard');
		}
		
		
		$this->data['title']='Resident | Log in';
		$this->load->view('resident/login',$this->data);
	}
	//Login Check
	public function check_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		 if($this->Authentication_model->resident_authentication_login($email, $password)){
			if($this->Authentication_model->resident_active_account_check($email, $password)){
				echo 'active';
			} else {
				echo 'notactive';
			}
		} else {
			echo 'fail';
		}
	}
	public function change_password(){
	
		
		
		
		//$this->data['view']='resident/change_password';
		$this->load->view('resident/change_password',$this->data);
	}
	//Check Password(MD5) existance
	public function check_data_exists_md5($field, $table){
		if (array_key_exists($field,$_POST)) {
			if ( $this->Authentication_model->data_exists_md5_id($field, $this->input->post($field), $table, $this->resident_id) == TRUE ) {
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
	public function forgot_password(){
				$email 		= $this->input->post('email_forgot');
			
			if($email!=""){
				//Grab Condo Admin info
				$action = "email = '$email'";
				$condo_info_admins = $this->General_model->get_data_row_using_where('residents',$action);
				$condo_alpha_name_id = $condo_info_admins->id;
				$condo_alpha_name_admins = $condo_info_admins->name;
				
				$DbFieldsArray 		= array('forgot_pass_count');
				$DataArray = array('0');
				$this->General_model->updateData($email,'email',$DbFieldsArray,$DataArray,'residents');
				
				$verification_code_id = base64_encode($condo_alpha_name_id);
				$verification_code_email = md5($email);
				$verification_link = base_url()."resident/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
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
		$where = "id = '$verification_code_id_decode' and verify_code = '$verification_code_email'";
		//Grab Condo Admin Forgot Password Link Count info
		$action = "id = '$verification_code_id_decode'";
		$condo_info_admins = $this->General_model->get_data_row_using_where('residents',$action);
		$condo_forgot_pass_count = $condo_info_admins->forgot_pass_count;
		
		$condo_forgot_pass_final_count = $condo_forgot_pass_count + 1;
		$action_to_be_filled = "forgot_pass_count = '$condo_forgot_pass_final_count'";
		if($get_key_id = $this->General_model->update_data_using_multiwhere_custom($where, $action_to_be_filled, 'residents')){
			$this->data['verify_data'] = $get_key_id;
		} else {
			$this->data['verify_data'] = 'USED';
		}
		
		if(isset($_POST['forgotpasssubbutton'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
		$DbFieldsArray 		= array('password');
		$DataArray = array(md5($new_password));
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'residents');
		redirect('resident'); 
		}
		
		$this->data['title']='Resident | Forgot Password Change';
		$this->load->view('resident/forgot_password_change',$this->data);
	}
	public function fetch_condos()
	{
		
		$obj = json_decode($_POST['json_data']);
		$condo_lists = $obj->keyword;
		if($obj->keyword != '') {
			$action = "name like '" . $obj->keyword . "%' ORDER BY name DESC";
			$results = $this->General_model->get_data_all_like_using_where('condos', $action);
			$condo_lists='';
			$condo_lists.='<ul>';
			if(count($results)>0){
				 
					foreach($results as $condo_list){
						$id = $condo_list["id"];
						$condo_name = $condo_list["name"];
						$condo_logo = $condo_list["condo_picture"];
						$condo_address = $condo_list["address"];
						$condo_city = $condo_list["areas"];
						$condo_state = $condo_list["state"];
					    $condo_lists.='<li>
						<a onclick="checkalert(\'' .$condo_name. '\')" href="#">
						
						<img  src="'.base_url().'uploads/condos/condo_pictures/'.$condo_logo.'" width="75" height="75">
						<span>'.$condo_name.'<br/>'.$condo_address.'<br/>'.$condo_city.'<br/>'.$condo_state.'</span>
						</a>
						<a class="live-here" href="javascript:;" onclick="add_resident('.$condo_list["id"].')"> I live here </a>
						
						</li>';	
					}
				}else{
				$condo_lists.='
						<li>
							No Such Condo found. Click here to inform us.
						</li>';
				}
			 $condo_lists.='</ul>';
			 $result['condo_lists']=$condo_lists;
			 echo json_encode($result);
		} else {
			 $condo_lists.='
						';
			 $result['condo_lists']=$condo_lists;
			 echo json_encode($result);
		}
	}
	public function add_resident_session()
	{
		$set_Data = array('link_condo_id'=>$this->input->post('link_condo_id'));
		$this->session->set_userdata($set_Data);
	}
	
	public function add_resident()
	{
		if($this->session->userdata('link_condo_id')==""){
			redirect(base_url());
		}
		$condo_id = $this->session->userdata('link_condo_id');
		//echo $condo_id;exit;
		if(isset($_POST['add_resident_btn'])){
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'name'           =>	$this->input->post('name'),
					  'condo_id'       =>	$condo_id,
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
				//Send Email to condo Admin
				$action="condo_id='$condo_id' AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						if($this->input->post('type')==1){ $tyype = "Tenant";} else { $tyype = "Owner";}
						$subject_admin = "Welcome to ALIA - Your Life Style & Property Solutions";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello ".$admin['full_name'].", <br />
						A new Resident has been registered under you condo. Please do check and approve. The details are as follows:
						Name: ".$this->input->post('name')."<br />
						Email: ".$this->input->post('email')."<br />
						Phone:".$this->input->post('phone')."<br />
						Type: ".$tyype."<br />
						Unit:".$this->General_model->get_value_by_id('blocks', $this->input->post('block'), 'name')."
						-".$this->input->post('floor')."-".$this->input->post('unit')."<br />
						
						<a href='".base_url()."resident/approve_resident/".md5($this->input->post('email'))."'>Click here</a> to approve. 
						<br /><br /></div>
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
						
						
						
						
						//Send Email To this user
						$subject_first = "Welcome to ALIA - Your Life Style & Property Solutions";
						$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />
		
						Welcome to the ALIA community.<br />
						
						Your Email is ".$this->input->post('email')."<br />
						You will be Soon Notified Once you are approved by Admin.<br /><br />
				</div>
						";
						//Send Welcome Email
						$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
						
						
					}
				}
				$unsetData = array(
					 'link_condo_id' => ''
					);
				$this->session->set_userdata($unsetData);
				redirect("success");
		}
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');
		$this->data['title']='Resident | Add Resident ';
		$this->data['view']='resident/add_resident';
		$this->load->view('resident/template/main_no_sidebar',$this->data);
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
			redirect('resident/dashboard');  
		}
		
		$this->data['title']='Resident | Confirm Resident';
		$this->load->view('resident/confirm_resident_change',$this->data);
	}
	public function approve_resident($verify_code)
	{
		
		$ver =$this->General_model->get_data_all_like_using_where('residents',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Approved';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('2');
			$whereClouse = "verify_code='$verify_code'";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
			//
			//Collect Email Data
				$subject_first = "ALIA - Application approved";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"name").", <br />

				Welcome to the ALIA community.<br />
				
				
				We are happy to have you on this journey towards building a smarter, safer, and sustainable community.<br /><br />
				Our mission is to help you on your property management matters so that you can get things done with less work.<br /><br />
				
				Your Email is ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"email")."<br /><br />
				
				
				<a href='".base_url()."home/confirm_resident/".$verify_code."'>Click here</a> to Confirm And login .<br /><br />
				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',$whereClouse,"email"), $this->General_model->get_data_value_using_where('residents',$whereClouse,"name"), $subject_first, $message_first);
			
		}
		else
		{
			$this->data['message']='Email Not Approved';
		}
		 
		
		
		$this->data['title']='Manager | Approve Resident';
		$this->load->view('resident/approve_resident',$this->data);
	}
	public function change_floors()
	{
		
		$id = $this->input->post('id');
		$condos=$this->General_model->get_data_row_using_where('blocks',"id = $id");
		echo json_encode($condos);
		//echo $condos->floors;
	}
	public function do_logout(){
        $this->session->sess_destroy();
		$this->session->unset_userdata('resident_id');    
		redirect('resident');
    }
	
	public function profile(){
		
		if($this->session->userdata('resident_id')==""){
			redirect('resident/login'."?next=".$this->url);
		}
		
		if(isset($_POST['resiprofsubmit'])){
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			
		$DbFieldsArray 		= array('name');
		$DataArray = array($name);
		$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'residents');
		redirect('resident/profile'); 
		}
		
		$this->data['title']='Resident | Profile';
		$action = "id =".$this->session->userdata('resident_id');
		$this->data['resident_info']= $this->General_model->get_data_row_using_where('residents', $action);
		$this->data['view']='resident/profile';
		$this->load->view('resident/template/main',$this->data);
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
	
	public function test_email(){
		$this->load->library('email');
		$this->load->helper('path');
		
		$this->email->from('ronnie@getranked.com.my', 'Ronnie');
		$this->email->to('sdsuresh22@hotmail.com'); 
		
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.'); 
		
		/* This function will return a server path without symbolic links or relative directory structures. */
		$path = set_realpath('uploads/invoice_files/');
		$this->email->attach($path . 'invoice_1468213876.pdf');  /* Enables you to send an attachment */
		
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}


	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	
} 