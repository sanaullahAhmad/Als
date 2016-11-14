<?php defined('BASEPATH') OR exit('No direct script access allowed');
class manager extends CI_Controller {
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
		$this->load->model('encrypt_model');
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
	//Check Email existance
	public function check_facility_in_category_exists($table){
		
			$this->db->where('facility_category_id', $_POST['facility_category']);
			$this->db->where('name', $_POST['name']);
			
			$query = $this->db->get($table);
			
			if( $query->num_rows() > 0 ){ 
				if(isset($_POST['saved_name']) && $_POST['saved_name']==$_POST['name'])
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
	//Check Email existance
	public function check_data_primay_owner_exists(){
		if($_POST['type']=='11')
		{
			$this->db->where('block', $_POST['block']);
			$this->db->where('condo_id', $this->condo_id);
			$this->db->where('floor', $_POST['floor']);
			$this->db->where('unit', $_POST['unit']);
			$this->db->where('type', '11');
			$query = $this->db->get('residents');
			if( $query->num_rows() > 0 ){ 
				echo json_encode(FALSE);
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
		$this->data['residents']=$this->General_model->get_data_all_like_using_where('residents',"status=0 AND condo_id=".$this->condo_id." order by id DESC");
		//$this->data['adverts']=$this->General_model->get_data_all_like_using_where('adverts',"payment_status=1 AND condo_id=".$this->condo_id);
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts',"status=1 AND condo_id=".$this->condo_id." order by id DESC");
		$action = " between '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59') AND condo_id=$this->condo_id  order by id DESC";
		//$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests',"(deliverydatetime".$action);
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests',"(date(deliverydatetime) = CURDATE() || date(deliverydatetime) = CURDATE() + INTERVAL 1 DAY) AND condo_id=".$this->condo_id."  AND status=0 ORDER BY deliverydatetime DESC");
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where('visitor_requests', "(visitdatetime".$action);
		
		$this->data['service_quotes'] = $this->General_model->get_data_all_like_using_where('service_quotes', " status=2 AND service_request_id IN (select id from service_requests where condo_id=$this->condo_id) order by id DESC");
		$this->data['adverts'] = $this->General_model->get_data_all_like_using_where('adverts', " status=0 AND condo_id=".$this->condo_id." order by id DESC");
		
		$this->data['title']='Manager | Dashboard';
		$this->data['view']	='manager/dashboard';
		//$this->load->view('manager/template/main',$this->data);
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function facility_bookings()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "facility")==0){
			  show_404();
		}
		$this->data['facility_bookings']= $this->General_model->get_data_all_like_using_where('facility_booking', "condo_id=".$this->condo_id);
		//id IN(SELECT booking_id  from invoices where manual_receipt!='') AND 
		$this->data['title']			=	'Manager | Facility Bookings';
		$this->data['view']				=	'manager/facility_bookings';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function manager_facilities()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "facility")==0){
			  show_404();
		}
		$this->data['facility_bookings']= $this->General_model->get_data_all_like_using_where('condo_facilities', "condo_id=".$this->condo_id);
		//id IN(SELECT booking_id  from invoices where manual_receipt!='') AND 
		$this->data['title']			=	'Manager | Facilities';
		$this->data['view']				=	'manager/manager_facilities';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function knowledge_base()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "house_rules_froms")==0){
			  show_404();
		}
		$this->data['knowledge_base']= $this->General_model->get_data_all_like_using_where('knowledge_base', "condo_id=".$this->condo_id);
		//id IN(SELECT booking_id  from invoices where manual_receipt!='') AND 
		$this->data['title']			=	'Manager | Knowledge Base';
		$this->data['view']				=	'manager/knowledge_base';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function online_payment()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		$condo_id = $this->condo_id;
		$actions = "condo_id=$condo_id order by id desc";
		$this->data['payments']=$this->General_model->get_data_all_like_using_where('invoices',$actions);
		
		$this->data['title']	=	'Manager | Online Payment';
		$this->data['view']		=	'manager/online_payment';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	
	public function processing_fee()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if(isset($_POST['add_processing_fee'])){
			$value =  $this->input->post('processing_fee');
			
			$check_processing_fee = $this->General_model->get_data_row_using_where("condo_settings", 
			"condo_id='$this->condo_id' and key_id='processing_fee'");
			if($check_processing_fee!=''){
					
					 
			 $this->db->query("UPDATE condo_settings SET value='$value' 
					   where condo_id='$this->condo_id' and key_id='processing_fee'");
			
			} else {
			$data=array(	  
					  'name'          	  =>	'Processing Fee',
					  'key_id'          	=>	'processing_fee',
					  'value'          	 =>	$value,
					  'added_date'		=>	date('Y-m-d H:i:s'),
					  'updated_date'	  =>	date('Y-m-d H:i:s'),
					  'access_level_id'   =>	0,
					  'updated_by'        =>	$this->session->userdata('manager_id'),
					  'condo_id'          =>	$this->condo_id
					  );
			$get_email_data = $this->General_model->addData_array($data, 'condo_settings');
			}
			
			$this->session->set_flashdata('message', 'Processing Fee updated succussfully.');
			redirect("manager/processing_fee");
		}
		
		$this->data['title']	=	'Manager | Processing Fee';
		$this->data['view']		=	'manager/processing_fee';
		$this->load->view('manager/template/main',$this->data);
	}
	
	
	
	public function add_payment_type()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if(isset($_POST['add_payment_type_btn'])){
			$data=array(	  
					  'name'          	  =>	$this->input->post('name'),
					  'condo_id'          =>	$this->condo_id
					  );
			$get_email_data = $this->General_model->addData_array($data, 'payment_for');
			
			$this->session->set_flashdata('message', 'Payment for Added succussfully.');
			redirect("manager/payment_type");
		}
		
		$this->data['title']	=	'Manager | Add Payment Type';
		$this->data['view']		=	'manager/add_payment_type';
		$this->load->view('manager/template/main',$this->data);
	}
	public function edit_payment_type($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		$id=$this->encrypt_model->decode($id);
		if(isset($_POST['edit_payment_type_btn'])){
			$data=array(	  
					  'name'          	  =>	$this->input->post('name'),
					  'condo_id'          =>	$this->condo_id
					  );
			$get_email_data = $this->General_model->updateData_array($data, 'payment_for', $id);
			
			$this->session->set_flashdata('message', 'Payment for updated succussfully.');
			redirect("manager/payment_type");
		}
		$actions = "id=$id"; 
		$this->data['payment_for']=$this->General_model->get_data_row_using_where('payment_for',$actions);
		
		//print_r($this->General_model->get_data_row_using_where('payment_for',$actions));exit;
		
		$this->data['title']	=	'Manager | Edit Payment Type';
		$this->data['view']		=	'manager/edit_payment_type';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function payment_type()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'.'?next='.urlencode(base_url().'manager/incident_categories'));
		}

		$this->data['payment_for']=$this->General_model->get_data_all_like_using_where('payment_for',"condo_id=$this->condo_id");
		
		$this->data['title']	=	'Manager | Payment Type';
		$this->data['view']		=	'manager/payment_type';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function incident_categories()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'.'?next='.urlencode(base_url().'manager/incident_categories'));
		}

		$this->data['condos']=$this->General_model->get_data_all_like_using_where('incident_categories',"condo_id=$this->condo_id");
		$this->data['title']='Manager | Incident Categories';
		$this->data['view']='manager/incident_categories';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	
	public function add_incident_category()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'.'?next='.urlencode(base_url().'manager/edit_service_category'));
		}
		
		if(isset($_POST['add_incident_category_btn'])){
			$data=array(	  
					  'name'          	  =>	$this->input->post('name'),
					  'condo_id'          =>	$this->condo_id,
					  'reports_per_day'   =>	$this->input->post('reports_per_day')
					  );
							$get_email_data = $this->General_model->addData_array($data, 'incident_categories');
					$result['msg']		=	"success";
					redirect("manager/incident_categories");
		}
		
		$this->data['title']='Manager | Add Incident Category ';
		$this->data['view']='manager/add_incident_category';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function edit_incident_category($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'.'?next='.urlencode(base_url().'manager/edit_incident_category'));
		}
		
		if(isset($_POST['edit_incident_category_btn'])){
			$data=array(	  
					  'name'          	  =>	$this->input->post('name'),
					  'condo_id'          =>	$this->condo_id,
					  'reports_per_day'   =>	$this->input->post('reports_per_day')
					  );
							$get_email_data = $this->General_model->updateData_array($data, 'incident_categories', $id);
					$result['msg']		=	"success";
					redirect("manager/incident_categories");
		}
		$this->data['service_cat']= $this->General_model->get_data_by_id($id,'incident_categories');
		$this->data['title']='Manager | Update Incident Category ';
		$this->data['view']='manager/edit_incident_category';
		$this->load->view('manager/template/main',$this->data);
	}
	
	//Add Add Contact
	public function add_knowledge_base()
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_knowledge_base'));
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "house_rules_froms")==0){
			  show_404();
		}
		if(isset($_POST['add_knowledgebase_btn']))
		{
			
			$DbFieldsArray 	= array('condo_id','name', 'description', 'privacy', 'image_url', 'date_uploaded');
			$DataArray 		= array($this->condo_id, $_POST['name'], $_POST['description'], $_POST['privacy'], $_POST['images_names'][0], date('Y-m-d H:i:s'));
			
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'knowledge_base');
			//get record
			if(isset($_POST['images_names'])) 
			{
				foreach($_POST['images_names'] as $image_name)
				{
					$DbFieldsArray 		= array('knowledge_base_id');
					$DataArray = array($id);
					$get_admin = $this->General_model->updateData($image_name, 'file_url', $DbFieldsArray, $DataArray, 'knowledge_base_files' );
				}
			}
			$this->session->set_flashdata('message', 'knowledge_base Added succussfully.');
			redirect('manager/knowledge_base'); 
		}
		$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
		$this->data['contacts'] = $this->General_model->get_data_all_like_using_where('useful_contacts', $action);
		$this->data['title']='Home | Add Knowledge Base';
		$this->data['view']='manager/add_knowledge_base';
		$this->load->view('manager/template/main',$this->data);
	}
	//Add Edit Knowledge Base
	public function edit_knowledge_base($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'edit_knowledge_base'));
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "house_rules_froms")==0){
			  show_404();
		}
		if(isset($_POST['edit_knowledgebase_btn']))
		{
			
			$DbFieldsArray 	= array('condo_id','name', 'description', 'privacy', 'image_url');
			$DataArray 		= array($this->condo_id, $_POST['name'], $_POST['description'], $_POST['privacy'], $_POST['images_names'][0]);
			
			$this->General_model->updateData($id, 'id', $DbFieldsArray, $DataArray ,'knowledge_base');
			//get record
			$images_array = "'0'";
			foreach($_POST['images_names'] as $image_name)
			{
				$images_array .= ",'".$image_name."'";
			}
			$this->General_model->deleteDataGeneral("knowledge_base_id=$id AND file_url NOT IN($images_array)", 'knowledge_base_files' );
			if(isset($_POST['images_names'])) 
			{
				foreach($_POST['images_names'] as $image_name)
				{
					$DbFieldsArray 		= array('knowledge_base_id');
					$DataArray = array($id);
					$get_admin = $this->General_model->updateData($image_name, 'file_url', $DbFieldsArray, $DataArray, 'knowledge_base_files' );
				}
			}
			$this->session->set_flashdata('message', 'knowledge_base edited succussfully.');
			redirect('manager/knowledge_base'); 
		}
		$action="id='$id' ";//AND role='1'//as both manager and security will recive email
		$this->data['knowledge_base'] = $this->General_model->get_data_row_using_where('knowledge_base', $action);
		$this->data['title']='Home | Edit Knowledge Base';
		$this->data['view']='manager/edit_knowledge_base';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function useful_contacts()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "useful_links")==0){
			  show_404();
		}
		$this->data['useful_contacts']= $this->General_model->get_data_all_like_using_where('useful_contacts', "condo_id=".$this->condo_id);
		//id IN(SELECT booking_id  from invoices where manual_receipt!='') AND 
		$this->data['title']			=	'Manager | Useful Contacts';
		$this->data['view']				=	'manager/useful_contacts';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	//Add Add Contact
	public function add_contact()
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_contact'));
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "useful_links")==0){
			  show_404();
		}
		if(isset($_POST['add_contact_btn']))
		{
			
			$DbFieldsArray 	= array('condo_id','name', 'phone', 'email', 'mobile', 'website', 'waze', 'google_map_link', 'address', 'status');
			$DataArray 		= array($this->condo_id, $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['mobile'], $_POST['website'], $_POST['waze'], $_POST['google_map_link'], $_POST['address'], $_POST['status']);
			
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'useful_contacts');
			//get record
			$this->session->set_flashdata('message', 'Contact Added succussfully.');
			redirect('manager/useful_contacts'); 
		}
		$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
		$this->data['contacts'] = $this->General_model->get_data_all_like_using_where('useful_contacts', $action);
		$this->data['title']='Home | Add Useful Contacts';
		$this->data['view']='manager/add_contact';
		$this->load->view('manager/template/main',$this->data);
	}
	//Add Add Contact
	public function edit_contact($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'edit_contact/'.$id));
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "useful_links")==0){
			  show_404();
		}
		if(isset($_POST['edit_contact_btn']))
		{
			
			$DbFieldsArray 	= array('condo_id','name', 'phone', 'email', 'mobile', 'website', 'waze', 'google_map_link',  'address', 'status');
			$DataArray 		= array($this->condo_id, $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['mobile'], $_POST['website'], $_POST['waze'], $_POST['google_map_link'], $_POST['address'], $_POST['status']);
			
			$this->General_model->updateData($id, 'id', $DbFieldsArray, $DataArray ,'useful_contacts');
			//get record
			$this->session->set_flashdata('message', 'Contact Edited succussfully.');
			redirect('manager/useful_contacts'); 
		}
		$action="id='$id' ";//AND role='1'//as both manager and security will recive email
		$this->data['contacts'] = $this->General_model->get_data_row_using_where('useful_contacts', $action);
		$this->data['title']='Home | Edit Contact';
		$this->data['view']='manager/edit_contact';
		$this->load->view('manager/template/main',$this->data);
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
			$whereClouse = "id=$id";
			
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
	
	public function approve_quote()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$service_request_id = $this->General_model->get_value_by_id('service_quotes', $id, 'service_request_id');
		$resident_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'requested_by');
		$condo_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'condo_id');
		$action="id=$id";

		if($status ==='1')
		{	$app ="Approved";
		
			//save in db
			$service_request_id = $this->General_model->get_value_by_id('service_quotes', $id, 'service_request_id');
			$resident_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'requested_by');
			$condo_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'condo_id');

			$DbFieldsArray_noti = array('session_id', 'person_id', 'facility_id', 'code', 'condo_id', 'insertDate', 'msg_time');
			$DataArray_noti     = array($resident_id, 0, 0, 'Vendor Arrival Approved', $condo_id, date('Y-m-d H:i:s'), time());
			$this->General_model->addData($DbFieldsArray_noti,$DataArray_noti,'notifications');
			//send email to vendor
			$get_qoute = $this->General_model->get_data_row_using_where('service_quotes', $action);
			if(sizeof($get_qoute) >0)
			{
				$subject_admin = "You are hired!";
				$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name').", <br /><br />
				
				A customer has accepted your service and your appointment has been approved by the residence management. Details are as follows:<br /><br />
				
				Resident Name: ".$this->General_model->get_value_by_id('residents', $resident_id, 'name')."<br />
				
				Resident Address: ".$this->General_model->get_value_by_id("blocks",$this->General_model->get_value_by_id('residents', $resident_id, 'block'),'name')."- ".$this->General_model->get_value_by_id('residents', $resident_id, 'floor')."- ".$this->General_model->get_value_by_id('residents', $resident_id, 'unit').",  ".$this->General_model->get_value_by_id("condos",$this->General_model->get_value_by_id('residents', $resident_id, 'condo_id'),"name")." condo <br />
				
				Phone: ".$this->General_model->get_value_by_id('service_quotes', $id, 'resident_phone')."<br />
				Appointment Date & Time: ".$this->General_model->get_value_by_id('service_quotes', $id, 'ven_arival_time')."<br />
				Type of Service: ".$this->General_model->get_value_by_id('services',$this->General_model->get_value_by_id('service_requests', $service_request_id, 'service_id'),"name")."<br />
				Description:  ".$this->General_model->get_value_by_id('service_requests', $service_request_id, 'description')."<br /><br />



				You may login to your account at www.als.com.my/vendor to retrieve the details of this service request.
				<br /><br />

				Remember to be punctual and don't forget to leave a review for your customer once the service is done.
				<br /><br />
				
				If you think you have benefited from ALIA and would like to share this platform to your business partners and affiliates, please let us know and we will happy to include them under our service providers list subject to acceptance via our registration process for service professionals.
				<br /><br />
				
				Thank you.
				
				<br /><br /></div>
				";
				$this->email($this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'email'), $this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name'), $subject_admin, $message_admin);
				
			}
			
			//send email to resident
			$get_req = $this->General_model->get_data_row_using_where('service_requests', "id=".$service_request_id);
			if(sizeof($get_req) >0)
			{
				$subject_admin = "Your service appointment has been approved! ";
				$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name').", <br /><br />
				
				Management has approved your service appointment. The details are as follows:<br /><br />
				Appointment Date & Time: ".$this->General_model->get_value_by_id('service_quotes', $id, 'ven_arival_time')."<br />
				Vendor Name: ".$this->General_model->get_value_by_id('vendors', $id, 'name')."<br />
				Type of Service: ".$this->General_model->get_value_by_id('services',$this->General_model->get_value_by_id('service_requests', $service_request_id, 'service_id'),"name")."<br />
				Message:  ".$this->General_model->get_value_by_id('service_quotes', $id, 'message')."<br /><br />

				
				Please ensure someone is in the premise during this time to facilitate the service provider in and out of the premise.
				<br /><br />

				Don't forget to leave a review for your service provider once the service is done.
				<br /><br />
				Reviews are important because it allows your neighbours to identify good quality vendors and this will propel them to maintain good service standards in order to get better ratings and recommendations which will help generate more business.
				<br /><br />
				
				If you feel you have benefited from ALIA and would like to share this amazing platform to your family and friends, please let us know and we will do our best to provide our services to their homes as well.
				<br /><br />
				
				Together we can build a smarter, safer, and sustainable community for everyone.
				<br /><br />
				
				Thank you.


				
				<br /><br /></div>
				";
				$this->email($this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'email'), $this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name'), $subject_admin, $message_admin);
				
			}
		
		
		}
		else
		{  	
			$app ="DisApproved";
			$get_qoute = $this->General_model->get_data_row_using_where('service_quotes', $action);
			if(sizeof($get_qoute) >0)
			{
				$subject_admin = "Qoute $app By Manager";
				$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name').", <br />
				
				Your Qoute has been $app. Please do check. 
				<br />Description:".$get_qoute->description."<br />
				<br />Phone:".$get_qoute->resident_phone."<br />
				Amount:".$get_qoute->amount."<br /><br />
				
				<br /><br /></div>
				";
				$this->email($this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'email'), $this->General_model->get_value_by_id('vendors', $get_qoute->quoted_by,'name'), $subject_admin, $message_admin);
				
			}
				
		}
		$action="id='$id' ";//AND role='1'//as both manager and security will recive email
		
		
		$ver = $this->General_model->get_data_row_using_where('service_quotes',"id='$id'");
		if(sizeof($ver)>0)
		{
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array($status);
			$whereClouse = "id='$id'";
			
				$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'service_quotes');
				if($status =='2')
				{	
					echo "Approved";
				}
				else
				{
					echo "DissApproved";
				}
			
		}
		else
		{
			echo 'Email Not Approved';
		}
	}
	
	public function approve_delivery()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		if($status ==='1')
		{	$app ="Approved";
		
			 //save in db
			$resident_id = $this->General_model->get_value_by_id('delivery_requests', $id, 'delivery_for');
			$facility_id = $this->General_model->get_value_by_id('facility_booking', $id, 'facility_id');

			$DbFieldsArray_noti 		= array('session_id', 'person_id', 'facility_id', 'code', 'condo_id', 'insertDate', 'msg_time');
			$DataArray_noti = array($resident_id, 0, 0, 'Delivery Approved', $this->condo_id, date('Y-m-d H:i:s'), time());
			$this->General_model->addData($DbFieldsArray_noti,$DataArray_noti,'notifications');
		
		
		}
		else
		{  	$app ="DisApproved";}
		$action="id='$id' ";//AND role='1'//as both manager and security will recive email
		$get_qoute = $this->General_model->get_data_row_using_where('delivery_requests', $action);
		if(sizeof($get_qoute) >0)
		{
				$subject_admin = "Delivery Request $app By Manager";
				$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('residents', $get_qoute->delivery_for,'name').", <br />
				
				Your Delivery Request has been $app. Please do check. 
				<br />Description:".$get_qoute->description."<br />
				<br />company name:".$get_qoute->company_name."
				
				<br /><br /></div>
				";
				$this->email($this->General_model->get_value_by_id('residents', $get_qoute->delivery_for,'email'), $this->General_model->get_value_by_id('residents', $get_qoute->delivery_for,'name'), $subject_admin, $message_admin);
			
		}
		
		$ver = $this->General_model->get_data_row_using_where('service_quotes',"id='$id'");
		if(sizeof($ver)>0)
		{
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array($status);
			$whereClouse = "id='$id'";
			
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'delivery_requests');
				if($status =='1')
				{	
					echo "Approved";
				}
				else
				{
					echo "DissApproved";
				}
			
		}
		else
		{
			echo 'Email Not Approved';
		}
	}
	
	public function delete_post()
	{
		 $post_id = $this->input->post('post_id');
		 $this->General_model->delete_data($post_id,'posts');
		 $this->General_model->delete_data_using_where('post_id', $post_id,'posts_comments');
		 $post_images = $this->General_model->get_data_all_like_using_where('posts_images',"post_id=".$post_id);
		 if(sizeof($post_images)>0)
		 {
			 foreach($post_images as $image)
			 {
			   $file = "uploads/post_images/".$image['image_url'];
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
		 $this->General_model->delete_data_using_where('post_id', $post_id,'posts_images');
		 echo true;
	}
	public function facility_booking_form(){
		if($this->session->userdata('manager_id')==""){
			redirect(base_url());
		}
		$this->data['facility']=$this->General_model->get_data_rowusingwhere_empty_array('condo_facilities', "id=2 order by name ASC");
		$this->data['title']='Facility Booking Form';		
		
		
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$this->condo_id",'blocks', 'name', 'ASC');
		//print_r($this->data['blocks']);exit;
		$this->data['view']='manager/facility_booking_form';
		$this->load->view('manager/template/main',$this->data);
	}
	public function edit_facility_booking($id){
		if($this->session->userdata('manager_id')==""){
			redirect(base_url());
		}
		
		if(isset($_POST['facility_booking_edit']))
		{
			$condo_facility 	= $this->input->post('condo_facility');
			$resident 			= $this->input->post('resident');
			$startdate 			= $this->input->post('startdate');
			$starttime 			= $this->input->post('starttime');
			$enddate 			= $this->input->post('startdate');
			//$endtime 			= $this->input->post('endtime');
			
			$starttime_space = explode(' ',$starttime);
			$starttime_colon = explode(':',$starttime);
			if($starttime_space[1]=='AM')
			{
				$start_hour=$starttime_colon[0];
			}
			else
			{
				$start_hour=$starttime_colon[0]+12;
			}
			if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
			{
				$start_hour='12';
			}
			if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
			{
				$start_hour='00';
			}
			$start_minut =explode(':',$starttime_space[0]); 
			$start_minut =$start_minut[1];
			
			
			$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility ");
			$end_hour = date('H',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
			$end_minut = date('i',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
			
		
			
			$DbFieldsArray 	= array('resident_id', 'condo_id', 'facility_id', 'bookedfor_datetime_from', 'bookedfor_datetime_to', 'datetime_booked');
			$DataArray 		= array($resident, $this->condo_id, $condo_facility, "$startdate $start_hour:$start_minut:00", "$enddate $end_hour:$end_minut:00", date('Y-m-d H:i:s'));
			
			
			$this->General_model->updateData($id, 'id', $DbFieldsArray, $DataArray ,'facility_booking');
			//get record
			$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility");
			//prepare arrays
			$DbFieldsArray 	= array('payer_id', 'facility_id', 'condo_id');
			$DataArray 		= array($resident, $condo_facility, $this->condo_id);
			//insert into invice
			$invoice_id = $this->General_model->updateData($id, 'booking_id', $DbFieldsArray, $DataArray ,'invoices');
			$daata = array('invoice_id'=>$invoice_id,
						   'facility_booking_id'=>$id,);
			$this->session->set_userdata($daata);
			
			
			
			$this->session->set_flashdata('message', 'Booking changed succussfully.');
			redirect('manager/facility_bookings'); 
		}
		
		$this->data['facility']=$this->General_model->get_data_rowusingwhere_empty_array('condo_facilities', "id=2 order by name ASC");
		$this->data['title']='Edit Facility Booking';		
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$this->condo_id",'blocks', 'name', 'ASC');
		//print_r($this->data['blocks']);exit;
		$this->data['facility_booking']=$this->General_model->get_data_row_using_where('facility_booking', "id=$id");
		$this->data['view']='manager/edit_facility_booking';
		$this->load->view('manager/template/main',$this->data);
	}
	
	
	public function pending_facility_payments(){
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'manager?next='.urlencode(base_url().'pending_facility_payments'));
		}
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "facility")==0){
			show_404();
		}
		if(isset($_POST['proced_to_payment'])){
			$id 					= $this->input->post('invoice_id');
			$facility_booking_id 	= $this->input->post('facility_booking_id');
			$DbFieldsArray 		= array('datetime_paid','payment_channel','payment_status');
			$DataArray			= array( date('Y-m-d H:i:s'),'Payment Channel','1');
			$id = $this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'invoices');
			$this->session->set_flashdata('message', 'Payment Done');
			$daata = array('invoice_id'=>'',
							'facility_booking_id'=>'');
			$this->session->set_userdata($daata);
			//Send Email to condo Admin
			$invoice_details = $this->General_model->get_data_row_using_where('invoices', "id=$id");
			$facility_booking_details = $this->General_model->get_data_row_using_where('facility_booking', "id=$facility_booking_id");
			
			$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "Facility Payment Succussful";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A Facility has been succussfully booked under you condo. Please do check. The details are as follows:
					<br />
					Facility : ".$this->General_model->get_value_by_id('condo_facilities', $invoice_details->booking_id,'name')."<br>
					Description :".$invoice_details->description."<br>
					Amount Paid :".$invoice_details->amount_paid."<br>
					Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
					Booked To :".$facility_booking_details->bookedfor_datetime_to."<br>
					";
					if($admin["notification_alert"]==2)
					{
						$this->load->library('clickatel');
						$this->clickatel->send_sms($admin["phone"], $message_admin);
					}
					else
					{
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					}
					//Send Welcome Email
				}
			}
			//Send Email to resident
			$resident_details = $this->General_model->get_data_row_using_where('residents', "id=".$this->session->userdata('resident_id'));
			$subject_admin = "Facility Payment Succussful";
			$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$resident_details->name.", <br />
			A Facility has been succussfully booked. Please do check. The details are as follows:
			<br />
			Facility : ".$this->General_model->get_value_by_id('condo_facilities', $invoice_details->booking_id,'name')."<br>
			Description :".$invoice_details->description."<br>
			Amount Paid :".$invoice_details->amount_paid."<br>
			Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
			Booked To :".$facility_booking_details->bookedfor_datetime_to."<br>
			";
			$this->email($resident_details->email, $resident_details->name, $subject_admin, $message_admin);
			redirect('add_facility_booking'); 
			
		}
		
		
		$this->data['title']='Manager | Pending Facility Payment';
		$this->data['view']='manager/pending_facility_payments';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	public function manual_payment(){
		if($this->session->userdata('manager_id')==""){
				redirect(base_url().'manager?next='.urlencode(base_url().'manual_payment'));
		}
		if(isset($_POST['facility_booking_id']) && isset($_POST['invoice_id']) ){
			$daata = array('facility_booking_id'	=>	$_POST['facility_booking_id'],
						   'invoice_id'				=>	$_POST['invoice_id']);
			$this->session->set_userdata($daata);
		}
		
		if($this->session->userdata('invoice_id')==""){
				redirect(base_url().'add_facility_booking');
		}
		if(isset($_POST['proced_to_payment'])){
			$id 					= $this->input->post('invoice_id');
			$facility_booking_id 	= $this->input->post('facility_booking_id');
			
			
			
				$this->load->library('upload');
				$files = $_FILES;
				$cpt = $_FILES['manual_receipt']['name'];
				$original_filename = '';
				if($_FILES['manual_receipt']['name']!= '')
				{
					 $upload_path = "uploads/facilities_images/";
					 $file_type = "gif|jpg|jpeg|png|pdf";
					 $this->upload->initialize(array('upload_path'	=>$upload_path,
													 'allowed_types'=>$file_type,
													 'overwrite'	=>FALSE));
					if($this->upload->do_upload('manual_receipt'))
					{
						$uploaddata = $this->upload->data();
						$result['filename'] = $uploaddata['file_name'];
						$original_filename = $result['filename'];
						
						//resize image if larger than 1000
						list($width, $height) = getimagesize("uploads/facilities_images/".$original_filename);
						if($width > "1000" || $height > "1000") {
							 $config = array('image_library'=>'gd2',
											 'source_image'=>'uploads/facilities_images/'.$original_filename,
											 'maintain_ratio'=>TRUE,
											 'width'=>'1000',
											 'height'=>'1000',);
							 $this->load->library('image_lib', $config); 
							 $this->image_lib->initialize($config);
							 $this->image_lib->resize();
						}
						//resize ends
						
						$DbFieldsArray 		= array('datetime_paid','payment_channel','manual_receipt', 'payment_status');//,'payment_status' admin will approve
						$DataArray			= array( date('Y-m-d H:i:s'),'Manual Payment',$original_filename,'1');//,'1'
						$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'invoices');
					} 
				}
				else 
				{
					$original_filename =  $this->upload->display_errors();
				}
			
			
			
			
			$this->session->set_flashdata('message', 'Payment Done');
			$daata = array('invoice_id'=>'',
							'facility_booking_id'=>'');
			$this->session->set_userdata($daata);
			//Send Email to condo Admin
			$invoice_details = $this->General_model->get_data_row_using_where('invoices', "id=$id");
			$facility_booking_details = $this->General_model->get_data_row_using_where('facility_booking', "id=$facility_booking_id");
			
			//Send Email to resident
			$resident_details = $this->General_model->get_data_row_using_where('residents', "id=".$invoice_details->paid_by);
			$subject_admin = "Manager Uploaded Reciept";
			$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$resident_details->name.", <br />
			A Manual Facility Payment Request has been booked. Please do check. The details are as follows:
			<br />
			Facility : ".$this->General_model->get_value_by_id('condo_facilities', $invoice_details->booking_id,'name')."<br>
			Description :".$invoice_details->description."<br>
			Amount Paid :".$invoice_details->amount_paid."<br>
			Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
			Booked To :".$facility_booking_details->bookedfor_datetime_to."<br>
			Reciept :".base_url()."uploads/facilities_images/".$original_filename."<br>
			";
			$this->email($resident_details->email, $resident_details->name, $subject_admin, $message_admin);
			redirect('manager/dashboard'); 
			
		}
		
		
		
		$this->data['title']='Manager | Manual Payment';
		$this->data['view']='manager/manual_payment';
		$this->load->view('manager/template/main',$this->data);
	}
	public function approve_advert()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		
		
				if($status ==='1')
				{	$app ="Approved";}
				else
				{  	$app ="DisApproved";}
				$action="id='$id' ";//AND role='1'//as both manager and security will recive email
				$get_qoute = $this->General_model->get_data_row_using_where('adverts', $action);
				if(sizeof($get_qoute) >0)
				{
						$subject_admin = "Advertisement $app By Manager";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('residents', $get_qoute->advert_by,'name').", <br />
						
						Your Advertisement has been $app. Please do check. 
						<br />
						
						Title :".$get_qoute->title."<br>
						Link :".$get_qoute->ad_link."<br>";
						if($app ==='Approved')
						{	$message_admin.=" Pay :<form method='POST' action='".base_url()."payment'>
                            			<input type='hidden' name='advert_id' value='".$get_qoute->id."'>
                              			<button type='submit' name='proced_to_payment' class='btn btn-primary'>Proceed to Payment</button>
                            		  </form><br>";} 
						
						$message_admin.="Image :<br><img src=".base_url()."uploads/advertisement_images/".$get_qoute->image_url."><br>
						
						<br /><br /></div>
						
						";
						//Send Welcome Email
						//echo $admin['email'];
						$this->email($this->General_model->get_value_by_id('residents', $get_qoute->advert_by,'email'), $this->General_model->get_value_by_id('residents', $get_qoute->advert_by,'name'), $subject_admin, $message_admin);
					
				}
		
		
		
		
		
		
		$ver = $this->General_model->get_data_row_using_where('adverts',"id='$id'");
		if(sizeof($ver)>0)
		{
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array($status);
			$whereClouse = "id='$id'";
			
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'adverts');
				if($status =='1')
				{	
					echo "Approved";
				}
				else
				{
					echo "DissApproved";
				}
			
		}
		else
		{
			echo 'Email Not Approved';
		}
	}
	public function approve_facility_booking()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$service_request_id = $this->General_model->get_value_by_id('service_quotes', $id, 'service_request_id');
		$resident_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'requested_by');
		$condo_id = $this->General_model->get_value_by_id('service_requests', $service_request_id, 'condo_id');
		$action="id=$id";

		if($status ==='1')
		{	$app ="Approved";
		
			//save in db
			$resident_id = $this->General_model->get_value_by_id('facility_booking', $id, 'resident_id');
			$facility_id = $this->General_model->get_value_by_id('facility_booking', $id, 'facility_id');

			$DbFieldsArray_noti 		= array('session_id', 'person_id', 'facility_id', 'code', 'condo_id', 'insertDate', 'msg_time');
			$DataArray_noti = array($resident_id, 0, $facility_id, 'Facility Approved', $this->condo_id, date('Y-m-d H:i:s'), time());
			$this->General_model->addData($DbFieldsArray_noti,$DataArray_noti,'notifications');
			
			$action="booking_id='$id' ";//AND role='1'//as both manager and security will recive email
			$get_qoute = $this->General_model->get_data_row_using_where('invoices', $action);
				
			if(sizeof($get_qoute) >0)
			{
				$subject_admin = "Facility Booking Approved! ";
				$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'name').", <br /><br />
				
				
				
				Your facility booking has been approved. <br /><br />

				Facility: ".$this->General_model->get_value_by_id('condo_facilities',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'facility_id'),'name')."<br>
				Resident: ".$this->General_model->get_value_by_id('residents',$get_qoute->payer_id,'name')."<br>
				Booking Date: ".$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'datetime_booked')."<br />
				From :".$this->General_model->get_value_by_id('day_slots',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'slot_id'),'start_time')."<br>
				To:".$this->General_model->get_value_by_id('day_slots',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'slot_id'),'end_time')."<br>
				Residence : ".$this->General_model->get_value_by_id('condos',$get_qoute->condo_id,'name')."<br><br />
				
				You can also login to your account at www.als.com.my to refer your booking details under My Bookings.<br /><br />
				
				Thank you.

				
				<br /><br /></div>
				
				";
				//Send Welcome Email
				//echo $admin['email'];
				$this->email($this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'email'), $this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'name'), $subject_admin, $message_admin);
					
			}
		}
		else
		{  	
			$app ="DisApproved";
			
			if(sizeof($get_qoute) >0)
			{
				$subject_admin = "Facility Booking $app By Manager";
				$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'name').", <br />
				
				Your Facility Booking has been $app. Please do check. 
				<br />
				
				Facility :".$this->General_model->get_value_by_id('condo_facilities',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'facility_id'),'name')."<br>
				Resident :".$this->General_model->get_value_by_id('residents',$get_qoute->payer_id,'name')."<br>
				From :".$this->General_model->get_value_by_id('day_slots',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'slot_id'),'start_time')."<br>
				To:".$this->General_model->get_value_by_id('day_slots',$this->General_model->get_value_by_id('facility_booking',$get_qoute->booking_id,'slot_id'),'end_time')."<br>
				Condo :".$this->General_model->get_value_by_id('condos',$get_qoute->condo_id,'name')."<br>
				
				<br /><br /></div>
				
				";
				//Send Welcome Email
				//echo $admin['email'];
				$this->email($this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'email'), $this->General_model->get_value_by_id('residents', $get_qoute->payer_id,'name'), $subject_admin, $message_admin);
				
			}
		
		}
				
		$ver = $this->General_model->get_data_row_using_where('invoices',"booking_id='$id'");
		if(sizeof($ver)>0)
		{
			$updateDbFieldsAry = array('payment_status');
			$updateInfoAry = array($status);
			$whereClouse = "booking_id='$id'";
			
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'invoices');
				if($status =='1')
				{	
					echo "Approved";
				}
				else
				{
					echo "DissApproved";
				}
			
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
	public function change_resident_status()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$reason =  $this->input->post('reason');
		$updateDbFieldsAry = array('status');
		$updateInfoAry = array($status);
		$whereClouse = "id='$id'";
		$upd =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
		$upd =$this->General_model->addData(array('resident_id','ad_date','reason','status'), array($id, date('Y-m-d H:i:s'),$reason,$status), 'resident_activation_log');
		
		if($this->input->post('status')=='0')
		{
			$subject_admin = "Account Suspended";
			$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('residents', $id,'name').", <br /><br />
			We regret to inform you that your account has been temporarily suspended by admin due to misconduct or misuse of the platform. <br /><br />
	
			We treat such misconducts by users very seriously and we hope that all residents can abide by the terms of use of the platform in the best interest of everyone in your community.<br /><br />
			
			Please contact your management office to reactivate your account.
			<br /><br /></div>";
			$this->email($this->General_model->get_value_by_id('residents', $id,'email'), $this->General_model->get_value_by_id('residents', $id,'name'), $subject_admin, $message_admin);
		}
		else
		{
			$subject_admin = "Account Reactivated ";
			$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$this->General_model->get_value_by_id('residents', $id,'name').", <br /><br />
			Your user account has been reactivated. You may now login to www.als.com.my to use your community platform. <br /><br />

			Thank you.

			<br /><br /></div>";
			$this->email($this->General_model->get_value_by_id('residents', $id,'email'), $this->General_model->get_value_by_id('residents', $id,'name'), $subject_admin, $message_admin);
		}
	}
	//Add Add Contact
	public function announcement()
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'announcement'));
		}
		if(isset($_POST['send_resident_email']))
		{
			$block =  $this->input->post('block');
			$subject =  $this->input->post('subject');
			if($this->input->post('images_names')!=''){
				foreach($_POST['images_names'] as $image){
					$attachment =  $_SERVER["DOCUMENT_ROOT"]."/uploads/email_attachement/".$image;
				}
			}
			else
			{
				$attachment =  "";
			}
			//echo $attachment."<br>";
			//Collect Email Data
			
			if($block=='all')
			{
				$residents=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id ");
			}
			else
			{
				$residents=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id AND block=".$block);
			}
			
			if(sizeof($residents>0))
			{
				foreach($residents as $resident)
				{
					//Send Welcome Email
					$message = "<div style='".$this->config->item('style')."'>Hello ".$resident["name"].", <br />".$this->input->post('message');
					$this->email($resident["email"], $resident["name"], $subject, $message, $attachment);
					$this->email->clear(TRUE);
					//echo "loop<br>";
				}
			}
			//exit;
			
			$this->session->set_flashdata('message', 'Email sent succussfully.');
			redirect('manager/announcement'); 
		}
		$this->data['blocks']=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id group by block  order by name ASC");
		$this->data['title']='Manager | Announcement';
		$this->data['view']='manager/announcement';
		$this->load->view('manager/template/main',$this->data);
	}
	public function send_resident_email()
	{
		$id =  $this->input->post('id');
		$subject =  $this->input->post('subject');
		//Collect Email Data
		$message = "<div style='".$this->config->item('style')."'>Hello ".$this->General_model->get_data_value_using_where('residents',"id=".$id,"name").", <br />".$this->input->post('message');
		if($this->input->post('images_names')!=''){
		$attachment =  $_SERVER["DOCUMENT_ROOT"]."/uploads/email_attachement/".$this->input->post('images_names');
		}
		else
		{
			$attachment =  "";
		}
		echo $attachment;
				
		//Send Welcome Email
		$this->email($this->General_model->get_data_value_using_where('residents',"id=".$id,"email"), $this->General_model->get_data_value_using_where('residents',"id=".$id,"name"), $subject, $message, $attachment);
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
	public function add_facility_session()
	{
		$set_Data = array('faility_hidden_id'=>$this->input->post('faility_hidden_id'));
		$this->session->set_userdata($set_Data);
		echo $this->General_model->get_value_by_id("condo_facilities", $this->input->post('faility_hidden_id'), "session_time");
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
	
	
	//Add Facility Booking
	public function add_facility_booking()
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_facility_booking'));
		}
		if(isset($_POST['facility_booking_submit']))
		{
			$condo_facility 	= $this->input->post('condo_facility');
			$resident 			= $this->input->post('resident');
			$startdate 			= $this->input->post('startdate');
			$slot_id 			= $this->input->post('day_slot_val_append');
			/*$starttime 			= $this->input->post('starttime');
			$enddate 			= $this->input->post('startdate');
			//$endtime 			= $this->input->post('endtime');
			
			$starttime_space = explode(' ',$starttime);
			$starttime_colon = explode(':',$starttime);
			if($starttime_space[1]=='AM')
			{
				$start_hour=$starttime_colon[0];
			}
			else
			{
				$start_hour=$starttime_colon[0]+12;
			}
			if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
			{
				$start_hour='12';
			}
			if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
			{
				$start_hour='00';
			}
			$start_minut =explode(':',$starttime_space[0]); 
			$start_minut =$start_minut[1];
			
			
			$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility ");
			$end_hour = date('H',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
			$end_minut = date('i',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
			*/
		
			
			
			
			
			$DbFieldsArray 	= array('resident_id', 'slot_id', 'datetime_booked', 'facility_id', 'bookedfor_datetime_from', 'condo_id');
			$DataArray 		= array($resident, 	$slot_id, 		date('Y-m-d H:i:s'),$condo_facility, $startdate, $this->condo_id);
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'facility_booking');
			
			$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility");
			$facility_name = $this->General_model->get_value_by_id('condo_facilities', $condo_facility, 'name');
			
			//insert into invice
			$DbFieldsArray 	= array('payer_id', 'booking_id', 'payment_for', 'date_created', 'date_paid', 'system_transaction_id', 'transaction_info', 'amount_paid', 'payment_receipt', 'payment_month', 'payment_channel','payment_status', 'condo_id');
			$DataArray 		= array($resident, $id, '1', date('Y-m-d H:i:s'), '', time(), '', 0, '', '', '', 0, $this->condo_id);
			$invoice_id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'invoices');
			
			//Add Transaction
			//1. Add Facilty
			$DbFieldsArray_trans 	= array('invoice_id', 'description', 'amount', 'facility_id');
			$DataArray_trans 		= array($invoice_id, $facility_name, $facility_details->price, $condo_facility);
			$this->General_model->addData_InsertID($DbFieldsArray_trans, $DataArray_trans ,'invoice_items');

			//2. Add GST
			//GST calculation.
			$gst_amount = number_format($facility_details->price * 0.06,2);
			$DbFieldsArray_gst 	= array('invoice_id', 'description', 'amount', 'facility_id');
			$DataArray_gst 		= array($invoice_id, 'GST', $gst_amount, $condo_facility);
			$this->General_model->addData_InsertID($DbFieldsArray_gst, $DataArray_gst ,'invoice_items');
			
			//Update final amount in Invoice Table
			$transaction_sum = $this->db->query("SELECT SUM(amount) as trans_amt FROM invoice_items 
			WHERE invoice_id = $invoice_id");
			$row_transaction_sum = $transaction_sum->row();
			$get_trans_sum = $row_transaction_sum->trans_amt;
			$update_inv_total = $this->db->query("UPDATE invoices SET amount_paid = $get_trans_sum WHERE id=$invoice_id"); 
			
			$daata = array('invoice_id'=>$invoice_id,
						   'facility_booking_id'=>$id,);
			$this->session->set_userdata($daata);
			
			
			 //Collect Email Data
			  $subject_admin = "Facility Payment Succussful";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('residents', $resident, "name").", <br />
					A Facility has been succussfully booked for you . Please do check. The details are as follows:
					<br />
					Facility : ".$this->General_model->get_value_by_id('condo_facilities', $condo_facility,'name')."<br>
					Description :".$this->General_model->get_value_by_id('condo_facilities', $condo_facility,'description')."<br>
					Booked From :".$startdate.' '.$this->General_model->get_value_by_id('day_slots', $slot_id, "start_time")."<br>
					Booked To :".$startdate.' '.$this->General_model->get_value_by_id('day_slots', $slot_id, "end_time")."<br>
					";
						$this->email($this->General_model->get_value_by_id('residents', $resident, "email"), $this->General_model->get_value_by_id('residents', $resident, "name"), $subject_admin, $message_admin);
				
			  //Show Inserted Rows
			
			$this->session->set_flashdata('message', 'Facility booked succussfully.');
			redirect('manager/facility_bookings'); 
		}
		$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
		$this->data['condo_facilities'] = $this->General_model->get_data_all_like_using_where('condo_facilities', $action);
		$this->data['title']='Home | Add Facility Booking';
		$this->data['view']='add_facility_booking';
		$this->load->view('template/main',$this->data);
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
					
					//resize image if larger than 1000
						list($width, $height) = getimagesize("uploads/condos/condo_pictures/".$original_filename);
						if($width > "1000" || $height > "1000") {
							 $config = array('image_library'=>'gd2',
											 'source_image'=>'uploads/condos/condo_pictures/'.$original_filename,
											 'maintain_ratio'=>TRUE,
											 'width'=>'1000',
											 'height'=>'1000',);
							 $this->load->library('image_lib', $config); 
							 $this->image_lib->initialize($config);
							 $this->image_lib->resize();
						}
						//resize ends
					
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
		
		if(isset($_POST['manprofsubmit']))
		{
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			$phone 				= $this->input->post('phone');
			
			$DbFieldsArray 		= array('full_name', 'phone');
			$DataArray 			= array($name, $phone);
			//for image
			$this->load->library('upload');
			$files = $_FILES;
			$original_filename = '';
			if($_FILES['image_url']['name']!= '')
			{
				$upload_path = "uploads/profile_pictures/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				if($this->upload->do_upload('image_url'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					list($width, $height) = getimagesize("uploads/profile_pictures/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'=>'gd2',
										 'source_image'=>'uploads/profile_pictures/'.$original_filename,
										 'maintain_ratio'=>TRUE,
										 'width'=>'1000',
										 'height'=>'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					array_push($DbFieldsArray, 'image_url');
					array_push($DataArray, $original_filename);
				} 
			}
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
	
	public function view_management_post($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		$id=substr($id,6,10);
		$post_condo_id= $this->General_model->get_value_by_id('posts',"$id","condo_id");
		$post_title= $this->General_model->get_value_by_id('posts',"$id","title");
		if($this->condo_id!=$post_condo_id){
			redirect(base_url()."management_posts");
		}
		$this->data['post_details']= $this->General_model->get_data_row_using_where('posts',"id=$id");
		$this->data['title']=$post_title;		
		$this->data['view']='manager/view_management_post';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function show_date_bookings_ajax()
	{
		//calculate wheather this resident have not crossed its limits
		$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=".$this->input->post('facility_id'));
		$action="condo_id='$this->condo_id' AND facility_id=".$this->input->post('facility_id')." AND (datetime_booked between'".date('Y-m-d', strtotime("-".$facility_details->limit_days." days"))." 00:00:00' AND '".date('Y-m-d')." 23:59:59') AND resident_id IN( select id from residents where unit=".$this->General_model->get_value_by_id("residents", $this->input->post('resident_id'), 'unit').")";
		$calculate_hours = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		$booked_hours=0;
		if(sizeof($calculate_hours)>0)
		{
			foreach($calculate_hours as $cal_hrs)
			{
				
				$limit_start=strtotime(date("Y-m-d",strtotime($cal_hrs['bookedfor_datetime_from']."-".$facility_details->limit_days." days")));
				$limit_end   = strtotime($cal_hrs['bookedfor_datetime_from']);
				if(strtotime($this->input->post('date'))>=$limit_start && strtotime($this->input->post('date'))<=$limit_end )
				{
				//$ts1 = strtotime($cal_hrs['bookedfor_datetime_from']) + strtotime("+".$facility_details->session_time." minutes");
				$ts1 = date("Y-m-d H:i:s", strtotime($cal_hrs['bookedfor_datetime_from'] . "+".$facility_details->session_time." minutes"));
				$ts1 = strtotime($ts1);
				$ts2 = strtotime($cal_hrs['bookedfor_datetime_from']);
				$diff = abs($ts1 - $ts2) / 3600;
				$booked_hours+=$diff;
				}
			}
		}
		$booking_limit = $facility_details->booking_limit;
		//echo json_encode(array('day_slot_value'=>" booked_hours = $booked_hours AND booking_limit=$booking_limit $action"));exit;
		//
		$date 		 = $this->input->post('date');
		$facility_id = $this->input->post('facility_id');
		if($this->input->post('facility_id')==''){ $facility_id =0; }
		/*$action = "facility_id =$facility_id AND date(bookedfor_datetime_from)='$date' order by datetime_booked desc ";//AND status=0
		$facility_booking = $this->General_model->get_data_all_like_using_where('facility_booking', $action);*/
		
		//Get Day slots
		$day_slots = $this->General_model->get_data_all_using_Multiwhere("can_book=1 and facility_id=".$facility_id." ORDER BY start_time ASC ", 'day_slots');
		$day_slot_value='';
		
		if($booked_hours>$booking_limit)
		{
			echo json_encode(array('day_slot_value'=>"<label for='day_slot_val_append' class='error'>You Exceed Booking hours limit for your unit.</label> "));exit;
		}
		elseif(sizeof($day_slots)>0){
			$icount = 1;
			foreach($day_slots as $day_slot){
				$day_slot_id = $day_slot['id'];
				$check_slot_match = $this->General_model->get_data_all_using_Multiwhere("date(bookedfor_datetime_from)='$date' and facility_id =$facility_id and slot_id=".$day_slot_id, 'facility_booking');
				$day_slot_value.='
				 
               		<div class="col-md-2" style="margin-bottom:20px;">';
					if(sizeof($check_slot_match)>0){
                  $day_slot_value.='<a href="javascript:;" class="btn default disabled">'.date('H:i',strtotime($day_slot['start_time'])).
				' - '.date('H:i',strtotime($day_slot['end_time'])).'</a>';
					} else {
						$day_slot_value.='<button type="button" onclick="get_slot_value('.$day_slot['id'].')" class="slot_c slot_s_'.$day_slot['id'].' btn blue btn-outline">'.date('H:i',strtotime($day_slot['start_time'])).
				' - '.date('H:i',strtotime($day_slot['end_time'])).'</button>';
					}
                  	$day_slot_value.='</div>'; 
					
                  
				$icount++;
			}
		}
		 echo json_encode(array('day_slot_value'=>$day_slot_value));
		
		
		/*if(sizeof($facility_booking)>0)
		{
			echo '<span style="float:left;margin-right: 5px;">'.date('hA',strtotime($this->General_model->get_value_by_id('condo_facilities',$facility_id,'opening_hour'))).'</span>';
			$opening_hour = strtotime($this->General_model->get_value_by_id('condo_facilities',$facility_id,'opening_hour'));
			$closing_hour = strtotime($this->General_model->get_value_by_id('condo_facilities',$facility_id,'closing_hour'));
			$open_close_diff = ($closing_hour - $opening_hour) / 60;
			echo '<div class="progress" style="width: 80%; float: left;">';
			$n=1;
			$totoal_percentage=0;
			foreach($facility_booking as $booking)
			{
				if($n==1){
					$date1 = strtotime($this->General_model->get_value_by_id('condo_facilities',$facility_id,'opening_hour'));
					$ver = date('H:i:s', strtotime($booking['bookedfor_datetime_from']));
					$date2 = strtotime($ver);
					}
				else{
					$date1 = $date2;
					//echo $date1.'sana';exit;
					$date2 = strtotime($booking['bookedfor_datetime_from']);
					}
				
				
				$mins = ($date2 - $date1) / 60;
				$percentage = $mins/$open_close_diff*100;
				?>
					
                  <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $percentage?>%">
                  </div>
                  <?php 
				  $totoal_percentage +=$percentage; 
				  $date1 = strtotime($booking['bookedfor_datetime_from']);
				  $date2 = strtotime($booking['bookedfor_datetime_to']);
				  $mins = ($date2 - $date1) / 60;
				  $percentage = $mins/$open_close_diff*100;
				  ?>
                    
                  <div class="progress-bar progress-bar-<?php if($n%2==0){?>danger<?php }else{?>success<?php }?>" role="progressbar" style="width:<?php echo $percentage?>%">
                    <?php 
					$totoal_percentage +=$percentage; 
					echo date('hA', strtotime($booking['bookedfor_datetime_from']));
					echo " To ";
					echo date('hA', strtotime($booking['bookedfor_datetime_to']));
					?>
                  </div>
                
				<?php
				$n++;
			}
			echo '<div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.(100-$totoal_percentage).'%"></div>';
			echo '</div>';
			echo '<span style="float:right;">'.date('hA',strtotime($this->General_model->get_value_by_id('condo_facilities',$facility_id,'closing_hour'))).'</span>';
			echo '<span class="irs-grid" style="width: 98.0583%; left: 0.870874%;position:relative;display:block;margin-top: 50px;">
			<span class="irs-grid-pol" style="left: 0%"></span>
			<span class="irs-grid-text js-grid-text-0" style="left: 0%; margin-left: -0.667476%;">0</span>
			<span class="irs-grid-pol small" style="left: 6.666666667%"></span>
			<span class="irs-grid-pol small" style="left: 3.333333333%"></span>
			<span class="irs-grid-pol" style="left: 10%"></span>
			<span class="irs-grid-text js-grid-text-1" style="left: 10%; visibility: visible; margin-left: -0.970874%;">10</span>
			<span class="irs-grid-pol small" style="left: 16.666666667%"></span>
			<span class="irs-grid-pol small" style="left: 13.333333333%"></span>
			<span class="irs-grid-pol" style="left: 20%"></span>
			<span class="irs-grid-text js-grid-text-2" style="left: 20%; visibility: visible; margin-left: -0.970874%;">20</span>
			<span class="irs-grid-pol small" style="left: 26.666666667%"></span>
			<span class="irs-grid-pol small" style="left: 23.333333333%"></span>
			<span class="irs-grid-pol" style="left: 30%"></span>
			<span class="irs-grid-text js-grid-text-3" style="left: 30%; visibility: visible; margin-left: -0.970874%;">30</span>
			</span>';
		}*/
		//print_r($facility_booking);
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
				$subject = "Reset Password Link";
				$message = "Dear ".$condo_alpha_name_admins.", <br />
				You have requested to reset your password.<br/><br/>

				Click on the link below to change your password.<br/>
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
		if($attachment!=''){ $this->email->attach($attachment); 
		}
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
	public function archive_notice()
	{
		$DbFieldsArray = array('post_id','date');
		$DataArray	   = array($_POST['id'], date('Y-m-d H:i:s'));
		$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray, $_POST['table']);
	}
	//Calculate End time base on start time plus session
	public function calculate_end_time(){
		$session_time 		= $this->input->post('session_time');
		$starttime 			= $this->input->post('starttime');
		//
		$starttime_space = explode(' ',$starttime);
		$starttime_colon = explode(':',$starttime);
		if($starttime_space[1]=='AM')
		{
			$start_hour=$starttime_colon[0];
		}
		else
		{
			$start_hour=$starttime_colon[0]+12;
		}
		if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
		{
			$start_hour='12';
		}
		if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
		{
			$start_hour='00';
		}
		$start_minut =explode(':',$starttime_space[0]); 
		$start_minut =$start_minut[1];
		
		$end_time = date('h:i A',strtotime("$start_hour:$start_minut:00" . "+".$session_time." minutes"));
		
		echo $end_time;
	}
	
	//Check Time Range Availability
	public function check_timerange_availability(){
		
		$condo_facility 	= $this->input->post('condo_facility');
		$unit 				= $this->input->post('unit');
		$startdate 			= $this->input->post('startdate');
		$starttime 			= $this->input->post('starttime');
		$enddate 			= $this->input->post('startdate');
		//$endtime 			= $this->input->post('endtime');
		
		$starttime_space = explode(' ',$starttime);
		$starttime_colon = explode(':',$starttime);
		if($starttime_space[1]=='AM')
		{
			$start_hour=$starttime_colon[0];
		}
		else
		{
			$start_hour=$starttime_colon[0]+12;
		}
		if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
		{
			$start_hour='12';
		}
		if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
		{
			$start_hour='00';
		}
		$start_minut =explode(':',$starttime_space[0]); 
		$start_minut =$start_minut[1];
		
		
		$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility ");
		
		//calculate wheather this resident have not crossed its limits
		$action="condo_id='$this->condo_id' AND facility_id=$condo_facility AND datetime_booked between('".date('Y-m-d', strtotime("-".$facility_details->limit_days." days"))." 00:00:00' AND '".date('Y-m-d')." 23:59:59') AND resident_id IN( select id from residents where unit=$unit)";
		$calculate_hours = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		$booked_hours=0;
		if(sizeof($calculate_hours)>0)
		{
			foreach($calculate_hours as $cal_hrs)
			{
				$ts1 = strtotime($cal_hrs['bookedfor_datetime_to']);
				$ts2 = strtotime($cal_hrs['bookedfor_datetime_from']);
				$diff = abs($ts1 - $ts2) / 3600;
				$booked_hours+=$diff;
			}
		}
		
		$booking_limit = $facility_details->booking_limit;
		/*$endtime_space = explode(' ',$endtime);
		$endtime_colon = explode(':',$endtime);
		if($endtime_space[1]=='AM')
		{
			$end_hour=$endtime_colon[0];
		}
		else
		{
			$end_hour=$endtime_colon[0]+12;
		}
		if($endtime_space[1]=='PM' && $endtime_colon[0]=='12')
		{
			$end_hour='12';
		}
		if($endtime_space[1]=='AM' && $endtime_colon[0]=='12')
		{
			$end_hour='00';
		}
		$end_minut =explode(':',$endtime_space[0]); 
		$end_minut =$end_minut[1];*/
		
		
		$end_hour = date('H',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
		$end_minut = date('i',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
		
		// echo json_encode("$end_hour:$end_minut");
		$action="condo_id='$this->condo_id' AND facility_id=$condo_facility 
		AND (bookedfor_datetime_from <= '$enddate $end_hour:$end_minut:00') and (bookedfor_datetime_to >= '$startdate $start_hour:$start_minut:00')";
		
		$end = date("YmdHi", strtotime("$enddate $end_hour:$end_minut:00"));
		$str = date("YmdHi", strtotime("$startdate $start_hour:$start_minut:00"));
		$bookec_facilities = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		
		
		//opening hours
		$user_opening_hour = date("Hi", strtotime("$start_hour:$start_minut:00"));
		$facility_opening_hour = date("Hi", strtotime($facility_details->opening_hour));
		//closing hours
		$user_closing_hour = date("Hi", strtotime("$end_hour:$end_minut:00"));
		$facility_closing_hour = date("Hi", strtotime($facility_details->closing_hour));
		//user number of minuts between start and end time
		$usertimediffernce = round(abs(strtotime("$end_hour:$end_minut:00")-strtotime("$start_hour:$start_minut:00")) / 60,2);
		//facility number of minuts between start and end time
		$facilitytimediffernce = $facility_details->session_time;
		//check
		if($end < $str )
		{
			echo json_encode("Invalid Date."); /*Start date =" .date("M d Y, h:i A", strtotime("$startdate $start_hour:$start_minut:00")). " End date=".date("M d Y, h:i A", strtotime("$enddate $end_hour:$end_minut:00")));*/
		}
		elseif($user_opening_hour < $facility_opening_hour)
		{
			echo json_encode("You can not book this facility before ".date('h:i A',strtotime($facility_details->opening_hour)));
		}
		elseif($user_closing_hour > $facility_closing_hour)
		{
			echo json_encode("You can not book this facility after ".date('h:i A',strtotime($facility_details->closing_hour)));
		}
		elseif($facilitytimediffernce < $usertimediffernce)
		{
			$facilitytimediffernce = $facilitytimediffernce/60;
			echo json_encode(" You Exceed Booking Session time of $facilitytimediffernce hours.");
		}
		elseif($booked_hours>$booking_limit)
		{
			echo json_encode(" You Exceed Booking hours limit for a unit.");
		}
		elseif(sizeof($bookec_facilities)>0)
		{
			//booked
			echo json_encode(FALSE);
		}
		else 
		{
			echo json_encode(TRUE);//"$usertimediffernce  $facilitytimediffernce"
		}
		//echo $str.' '.$end;
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
		
		if(isset($_POST['search_residents_btn']))
		{
			$action="";
			$action .= "condo_id =$this->condo_id ";
			if(isset($_POST['block']) && $_POST['block']!=''){  $action .= " AND block='".$_POST['block']."'"; }
			if(isset($_POST['floors']) && $_POST['floors']!=''){  $action .= " AND floor='".$_POST['floors']."'"; }
			if(isset($_POST['unit']) && $_POST['unit']!=''){  $action .= " AND unit='".$_POST['unit']."'"; }
			$this->data['residents']	=$this->General_model->get_data_all_like_using_where('residents',$action." order by id DESC");
		}
		else
		{
			$this->data['residents']=$this->General_model->get_data_all_like_using_where('residents',"condo_id=".$thismanagerCondo." order by id DESC");
		}
		
		
		$this->data['blocks']=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id group by block  order by name ASC");
		
		//
		$this->data['title']='Manager | Residents';
		$this->data['view']='manager/residents';
		$this->load->view('manager/template/main_copy',$this->data);
	}
		
	public function change_floors_manager()
	{
		$id = $this->input->post('id');
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id =$this->condo_id AND block=$id group by floor  order by name ASC");
		?>
		<select  name="floors" class="form-control valid" aria-invalid="false" onchange="change_unit_manager(this.value)">
        	<option value="">
                Floor
            </option>
        <?php if(sizeof($floors)>0){foreach($floors as $floor){?>
             <option value="<?php echo $floor['floor']?>"><?php echo $floor['floor']?></option>
        <?php }}?>
        </select>
		<?php
	}
	public function change_unit_manager()
	{
		$block_id = $this->input->post('block_id');
		$floor_id = explode('"',$this->input->post('floor_id'));
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id =$this->condo_id AND block='$block_id'  AND floor='".$floor_id[1]."' group by unit  order by name ASC");
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
					  $last_resi_id = $this->General_model->addData_array($data, 'residents');
					
				
				
				
				$email = $this->input->post('email');
				$type = $this->input->post('type');
				$block = $this->input->post('block');
				$floor = $this->input->post('floor');
				$unit = $this->input->post('unit');
				$condo_id = $this->session->userdata('condo_id');
				//
				$subject_second = $this->General_model->get_value_by_id('condo_admins', $this->session->userdata('manager_id'), "full_name")." has invited you to join own community platform!";
				$message_second = "<div style='".$this->config->item('style')."'>Hi ".$this->input->post('name').", <br /><br />

				
				".$this->General_model->get_value_by_id('condo_admins', $this->session->userdata('manager_id'), "full_name")." has invited you to join your own residential community platform for ".$this->General_model->get_value_by_id('condos', $this->condo_id,'name').", powered by ALIA.<br /><br />

				Sign up now to enjoy the online convenience at the comfort of your home:<br /><br />
				•	Online payment to residence management.<br />
				•	Facility Bookings.<br />
				•	Hire qualified service providers.<br />
				•	Get notified of notices the moment it's posted in your portal by your management office.<br />
				•	And many more cool stuff.<br /><br />
				
				All these for absolutely FREE. <br /><br />
				
				<a href='".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")."' >Click here</a> to sign up now!<br /><br />
				
				Or Copy below link into your browser <br />
				".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")." <br /><br />

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
	
	
	public function add_condo_facility()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['add_facility_btn']))
		{
			$starttime 			= $this->input->post('opening_hour');
			$endtime 			= $this->input->post('closing_hour');
			
			$starttime_space = explode(' ',$starttime);
			$starttime_colon = explode(':',$starttime);
			if($starttime_space[1]=='AM')
			{
				$start_hour=$starttime_colon[0];
			}
			else
			{
				$start_hour=$starttime_colon[0]+12;
			}
			if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
			{
				$start_hour='12';
			}
			if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
			{
				$start_hour='00';
			}
			$start_minut =explode(':',$starttime_space[0]); 
			$start_minut =$start_minut[1];
			
			
			
			$endtime_space = explode(' ',$endtime);
			$endtime_colon = explode(':',$endtime);
			if($endtime_space[1]=='AM')
			{
				$end_hour=$endtime_colon[0];
			}
			else
			{
				$end_hour=$endtime_colon[0]+12;
			}
			if($endtime_space[1]=='PM' && $endtime_colon[0]=='12')
			{
				$end_hour='12';
			}
			if($endtime_space[1]=='AM' && $endtime_colon[0]=='12')
			{
				$end_hour='00';
			}
			$end_minut =explode(':',$endtime_space[0]); 
			$end_minut =$end_minut[1];
			
			$end = $end_hour.$end_minut;
			$str = $start_hour.$start_minut;
			if($end < $str )
			{
				//
			}
			
			//for image
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['image_url']['name'];
			$original_filename = '';
			if($_FILES['image_url']['name']!= '')
			{
				$upload_path = "uploads/facilities_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				if($this->upload->do_upload('image_url'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					list($width, $height) = getimagesize("uploads/facilities_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'=>'gd2',
										 'source_image'=>'uploads/facilities_images/'.$original_filename,
										 'maintain_ratio'=>TRUE,
										 'width'=>'1000',
										 'height'=>'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					$size = 262;
					$config = $this->resize_image("uploads/facilities_images/", $original_filename, $size, $size);
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				} 
			}
			
			$data=array(	  
				  'facility_category_id' 	   =>	$this->input->post('facility_category'),
				  'name'           			   =>	$this->input->post('name'),
				  'condo_id'      		 	   =>	$this->condo_id,
				  'description'    			   =>	$this->input->post('description'),
				  'is_booking_required' 	   =>	$this->input->post('is_booking_required'),
				  'is_deposit_required' 	   =>	$this->input->post('is_deposit_required'),
				  'deposit_amount' 	   		   =>	$this->input->post('deposit_amount'),
				  'price'          			   =>	$this->input->post('price'),
				  'opening_hour'   			   =>	"$start_hour:$start_minut:00",
				  'closing_hour'   			   =>	"$end_hour:$end_minut:00",
				  /*'session_time'   		   =>	($this->input->post('session_hour')*60)+$this->input->post('session_minute'),*/
				  'session_time'   		   	   =>	($this->input->post('session_hour')*60),
				  'booking_limit'              =>	$this->input->post('booking_limit'),
				  'limit_days'           	   =>	$this->input->post('per'),
				  'is_day_rang_settings'   	   =>	$this->input->post('is_day_rang_settings'),
				  'is_day_rang_settings_min'   =>	$this->input->post('is_day_rang_settings_min'),
				  'is_day_rang_settings_max'   =>	$this->input->post('is_day_rang_settings_max'),
				  'image_url'   			   =>	$original_filename,
			);
			$get_facility_id = $this->General_model->addData_array($data, 'condo_facilities');
			
			$slot_time_from = $this->input->post('slot_time_from');
			$slot_time_to 	= $this->input->post('slot_time_to');
			$can_book_check = $this->input->post('can_book_check');
			
			//$imp_checkboxes = implode(',', $_POST['can_book_check']);
			if($this->input->post('slot_time_from'))
			{
				$icount = 1;
				foreach($slot_time_from  as $key => $n ){
					/*if(isset($this->input->post('can_book_check'.$icount))){$is_featured.$icount=1;}else{$is_featured.$icount=0;}*/
					$data_day_slots=array(	  
						  'facility_id' 	   		   =>	$get_facility_id,
						  'condo_id'           		   =>	$this->condo_id,
						  'start_time' 	   			   =>	$n,
						  'end_time'          		   =>	$slot_time_to[$key],
						  'can_book'   			   	   =>	$can_book_check[$key]
						  );
					$this->General_model->addData_array($data_day_slots, 'day_slots');
					$icount++;
				}
			}
			
			$this->session->set_flashdata("message", "Facility Added Successfuly.");
			redirect("manager/manager_facilities");
		}
		$this->data['condos']=$this->General_model->get_data_all('condo_facilities');
		$this->data['facility_categories']=$this->General_model->get_data_all_like_using_where('facility_categories',"condo_id=$this->condo_id  order by name ASC");
		$this->data['title']='Manager | Add Condo Facility ';
		$this->data['view']='manager/add_condo_facility';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function edit_resident($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['edit_resident_btn'])){
		$resi_det= $this->General_model->get_data_by_id($id,'residents');
		if($resi_det->type!='11' && $this->input->post('type')=='11')
		{
			$pre_resi_det= $this->General_model->get_data_row_using_where('residents',"condo_id=".$this->session->userdata('condo_id')." AND type='11' AND block='".$this->input->post('block')."' AND floor='".$this->input->post('floor')."' AND unit='".$this->input->post('unit')."'");
			//send email to previous primary owner
			$subject_first = "Unit primary owner changed";
			$message_first = "<div style='".$this->config->item('style')."'>Hello ".$pre_resi_det->name.", <br />
			Previous PO: Condo Management has removed your status as PO for Unit ".$this->input->post('unit')." and the current PO is ".$resi_det->name." ".$resi_det->email.".<br />
If this change is done without your knowledge, please contact your management immediately.<br /><br />
			</div>
			";
			$this->email($pre_resi_det->email, $pre_resi_det->name, $subject_first, $message_first);
			$data=array(	  
					  'type' =>	'2',
					  );
			$upd = $this->General_model->updateData_array($data, 'residents', $pre_resi_det->id);
			
			//send email to This new primary owner
			$subject_first = "Unit primary owner changed";
			$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />
			Current PO:  You have been assigned as the current Primary Owner for Unit ".$this->input->post('unit').". <br />
If this change is done without your knowledge, please contact your management immediately.<br /><br />
			</div>
			";
			$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
		}
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
	
	public function search_resident()
	{
		
		if($this->session->userdata('manager_id')==""){
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
	
	public function calender()
	{
		if($this->session->userdata('manager_id')==""){
			redirect(base_url().'calender?next='.urlencode(base_url().'calender'));
		}
		$facility_id 					= $this->session->userdata('faility_hidden_id');
		$action 						= "facility_id =$facility_id  order by datetime_booked desc ";//AND status=0
		$this->data['facility_booking'] = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		$this->data['title']			='Manager | '.$this->General_model->get_value_by_id('condo_facilities', $facility_id, 'name');;
		$this->data['view']				='manager/calender';
		$this->load->view('manager/template/main',$this->data);
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
		if($this->session->userdata('manager_id')=="" || $this->General_model->get_value_by_id('condo_admins',$this->session->userdata('manager_id'),'is_primary_manager')==0){
			redirect('manager'."?next=".$this->url);
		}
		//
		$this->data['users']=$this->General_model->get_data_all_using_where('condo_id',$this->condo_id,'condo_admins');
		//
		$this->data['title']='Manager | Users';
		$this->data['view']='manager/users';
		$this->load->view('manager/template/main_copy',$this->data);
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
				$subject_first = "New Admin User Account Created – Pending confirmation and login";
				$message_first = "<div style='".$this->config->item('style')."'>Hello ".$this->input->post('name').", <br />

				Thank you for registering with ALIA.<br /><br />
				
				Your Email is ".$this->input->post('email')."<br /><br />
				
				Your password is ".$password.".<br /><br />
				
				<a href='".base_url().$controller."/confirm_user/".md5($this->input->post('email'))."'>Click here</a> to confirm and login to start using your community platform.<br /><br /></div>";
				
				//Send Welcome Email
				$this->email($this->input->post('email'), $this->input->post('name'), $subject_first, $message_first);
				redirect("manager/users");
		}
		$this->data['condos']=$this->General_model->get_data_all('condos');
		$this->data['title']='Manager | Add User ';
		$this->data['view']='manager/add_user';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function incidents()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "incident")==0){
			  show_404();
		}
		
		if(isset($_POST['bulk_incident_sub']))
		{
			if(isset($_POST['incidents']))
			{
				foreach($_POST['incidents'] as $incidents)
				{
					$data=array(	  
					  'status'         =>	$this->input->post('status'),
					  );
					$query = $this->General_model->updateData_array($data, 'incident_reporting', $incidents);
				}
			}
			$this->session->set_flashdata("message", "Bulk Status changed Successfuly.");
			redirect("manager/incidents");
		}
		$action = "condo_id=$this->condo_id";// AND status=0
		if(isset($_POST['incident_category']))
		{
			$action .= " AND incident_category=".$_POST['incident_category'];// AND status=0
		}
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
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "community_wall")==0){
			  show_404();
		}
		//
		$action = "condo_id=$this->condo_id AND status=0";// 
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);
		//
		$this->data['title']='Manager | Community Posts';
		$this->data['view']='manager/posts';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function blacklisted_units()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$action = "condo_id=$this->condo_id ";// AND status=0
		$this->data['blacklisted_units']=$this->General_model->get_data_all_like_using_where('blacklisted_units', $action);
		//
		$this->data['title']='Manager | Blacklisted Units';
		$this->data['view']='manager/blacklisted_units';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	
	
	public function add_blacklisted_unit()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		if(isset($_POST['add_blacklistedunit_btn']))
		{
		$part=explode('-',$_POST['unit']);
		$condos=$this->General_model->get_data_all_like_using_where('blacklisted_units',"block=".$this->input->post('block')." AND floor='".$this->input->post('floors')."' AND unit=".$this->input->post('unit')." AND condo_id=".$this->condo_id);
		if(sizeof($condos)>0)
		{
			foreach($condos as $condo)
			$update_id=$condo['id'];
		}
			$data=array(	  
				  /*'disable_facility' 		=>	$this->input->post('disable_facility'),
				  'disable_service'         =>	$this->input->post('disable_service'),
				  'disable_account_creation'=>	$this->input->post('disable_account_creation'),*/
				  'condo_id'				=>	$this->condo_id,
				  'block'					=>	$this->input->post('block'),
				  'floor'					=>	$this->input->post('floors'),
				  'unit'					=>	$this->input->post('unit'),
				  );
		    if(isset($update_id)){ $query = $this->General_model->updateData_array($data, 'blacklisted_units', $update_id);}
			else
			{ $query = $this->General_model->addData_array($data, 'blacklisted_units');}
			$this->session->set_flashdata("message", "unit blacklisted Successfuly.");
			redirect("manager/blacklisted_units");
		}
		$this->data['blocks']=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id group by block  order by name ASC");
		$this->data['title']='Manager | Add Blacklisted Units ';
		$this->data['view']='manager/add_blacklisted_unit';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function change_floors_blacklist()
	{
		
		$id = $this->input->post('id');
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id AND block=$id group by floor  order by name ASC");
		?>
		<select  name="floors" class="form-control valid" aria-invalid="false" onchange="change_unit_blacklist(this.value)">
        <?php if(sizeof($floors)>0){foreach($floors as $floor){?>
             <option value="<?php echo $floor['floor']?>"><?php echo $floor['floor']?></option>
        <?php }}?>
        </select>
		<?php
	}
	public function change_unit_blacklist()
	{
		
		$block_id = $this->input->post('block_id');
		$floor_id = $this->input->post('floor_id');
		$floors=$this->General_model->get_data_all_like_using_where('residents',"condo_id=$this->condo_id AND block='$block_id'  AND floor='$floor_id' group by unit  order by name ASC");
		?>
		<select  name="unit" class="form-control valid" aria-invalid="false">
        <?php if(sizeof($floors)>0){foreach($floors as $floor){?>
             <option value="<?php echo $floor['unit']?>"><?php echo $floor['unit']?></option>
        <?php }}?>
        </select>
		<?php
	}
	public function manager_advertisements()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$action = "condo_id=$this->condo_id ";// 
		$this->data['adverts']=$this->General_model->get_data_all_like_using_where('adverts', $action);
		//
		$this->data['title']='Manager | Advertisements';
		$this->data['view']='manager/manager_advertisements';
		$this->load->view('manager/template/main_copy',$this->data);
	}
	public function noticeboard_posts()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		//
		$action = "condo_id=$this->condo_id AND is_resident_post=0";// 
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);
		//
		$this->data['title']='Manager | Noticeboard Posts';
		$this->data['view']='manager/noticeboard_posts';
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
					'condo_id'            => $row->condo_id,
					'full_name'   	  => $row->full_name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('manager'."?next=".$this->url);  
		}
		
		$this->data['title']='Manager | Confirm Manager';
		$this->load->view('manager/confirm_user',$this->data);
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
	
	
	public function edit_condo_facility($facility_id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['edit_facility_btn']))
		{
			//echo "success";exit;
			$starttime 			= $this->input->post('opening_hour');
			$endtime 			= $this->input->post('closing_hour');
			
			$starttime_space = explode(' ',$starttime);
			$starttime_colon = explode(':',$starttime);
			if($starttime_space[1]=='AM')
			{
				$start_hour=$starttime_colon[0];
			}
			else
			{
				$start_hour=$starttime_colon[0]+12;
			}
			if($starttime_space[1]=='PM' && $starttime_colon[0]=='12')
			{
				$start_hour='12';
			}
			if($starttime_space[1]=='AM' && $starttime_colon[0]=='12')
			{
				$start_hour='00';
			}
			$start_minut =explode(':',$starttime_space[0]); 
			$start_minut =$start_minut[1];
			
			
			
			$endtime_space = explode(' ',$endtime);
			$endtime_colon = explode(':',$endtime);
			if($endtime_space[1]=='AM')
			{
				$end_hour=$endtime_colon[0];
			}
			else
			{
				$end_hour=$endtime_colon[0]+12;
			}
			if($endtime_space[1]=='PM' && $endtime_colon[0]=='12')
			{
				$end_hour='12';
			}
			if($endtime_space[1]=='AM' && $endtime_colon[0]=='12')
			{
				$end_hour='00';
			}
			$end_minut =explode(':',$endtime_space[0]); 
			$end_minut =$end_minut[1];
			
			$end = $end_hour.$end_minut;
			$str = $start_hour.$start_minut;
			if($end < $str )
			{
				//
			}
			
			$data=array(	  
				  'facility_category_id' 	=>	$this->input->post('facility_category'),
				  'name'           			=>	$this->input->post('name'),
				  'condo_id'      		 	=>	$this->condo_id,
				  'description'    			=>	$this->input->post('description'),
				  'is_booking_required' 	=>	$this->input->post('is_booking_required'),
				  'is_deposit_required' 	=>	$this->input->post('is_deposit_required'),
				  'deposit_amount' 	   		=>	$this->input->post('deposit_amount'),
				  'price'          			=>	$this->input->post('price'),
				  'opening_hour'   			=>	"$start_hour:$start_minut:00",
				  'closing_hour'   			=>	"$end_hour:$end_minut:00",
				  'session_time'   			=>	($this->input->post('session_hour')*60),/*+$this->input->post('session_minute')*/
				  'booking_limit'           =>	$this->input->post('booking_limit'),
				  'limit_days'           	=>	$this->input->post('per'),
				  'is_day_rang_settings'   	=>	$this->input->post('is_day_rang_settings'),
				  'is_day_rang_settings_min'=>	$this->input->post('is_day_rang_settings_min'),
				  'is_day_rang_settings_max'=>	$this->input->post('is_day_rang_settings_max'),
				  );
			$get_email_data = $this->General_model->updateData_array($data, 'condo_facilities', $facility_id);
			$slot_time_from = $this->input->post('slot_time_from');
			$slot_time_to 	= $this->input->post('slot_time_to');
			$can_book_check = $this->input->post('can_book_check');
			
			//$imp_checkboxes = implode(',', $_POST['can_book_check']);
			if($this->input->post('slot_time_from'))
			{
				//frist delete previous entries
				$this->db->query("delete from day_slots where facility_id=$facility_id AND condo_id=$this->condo_id");
				$icount = 1;
				foreach($slot_time_from  as $key => $n ){
					/*if(isset($this->input->post('can_book_check'.$icount))){$is_featured.$icount=1;}else{$is_featured.$icount=0;}*/
					$data_day_slots=array(	  
						  'facility_id' 	   		   =>	$facility_id,
						  'condo_id'           		   =>	$this->condo_id,
						  'start_time' 	   			   =>	$n,
						  'end_time'          		   =>	$slot_time_to[$key],
						  'can_book'   			   	   =>	$can_book_check[$key]
						  );
					$this->General_model->addData_array($data_day_slots, 'day_slots');
					$icount++;
				}
			}
			$this->session->set_flashdata("message", "Facility updated Successfuly.");
			redirect("manager/manager_facilities");
		}
		$this->data['condo_facility']=$this->General_model->get_data_row_using_where('condo_facilities',"id=$facility_id");
		$this->data['facility_categories']=$this->General_model->get_data_all_like_using_where('facility_categories',"condo_id=$this->condo_id  order by name ASC");
		$this->data['title']='Manager | Edit Condo Facility ';
		$this->data['view']='manager/edit_condo_facility';
		$this->load->view('manager/template/main',$this->data);
	}
	
	public function facility_category()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "facility")==0){
			  show_404();
		}
		$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
		$this->data['facility_categories'] = $this->General_model->get_data_all_like_using_where('facility_categories', $action);
		$this->data['title']='Manager | Facility category';
		$this->data['view']='manager/facility_category';
		$this->load->view('manager/template/main',$this->data);
	}
	public function add_facility_category()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['add_category_btn']))
		{
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['image_url']['name'];
			$original_filename = '';
			if($_FILES['image_url']['name']!= '')
			{
				$upload_path = "uploads/facilities_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				if($this->upload->do_upload('image_url'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					list($width, $height) = getimagesize("uploads/facilities_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'=>'gd2',
										 'source_image'=>'uploads/facilities_images/'.$original_filename,
										 'maintain_ratio'=>TRUE,
										 'width'=>'1000',
										 'height'=>'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					$size = 262;
					$config = $this->resize_image("uploads/facilities_images/", $original_filename, $size, $size);
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				} 
			}
			else 
			{
				$original_filename =  $this->upload->display_errors();
			}
			$data=array(	  
				  'name' 	  =>	$this->input->post('name'),
				  'condo_id'  =>	$this->condo_id,
				  'image_url' =>	$original_filename
			);
			if(isset($_POST['info_only']))
			{
				$data['info_only']=1;
			}
			else
			{
				$data['info_only']=0;
			}
			$get_email_data = $this->General_model->addData_array($data, 'facility_categories');
			$this->session->set_flashdata("message", "Facility Category Added Successfuly.");
			redirect("manager/facility_category");
		}
		$this->data['title']='Manager | Add Facility category';
		$this->data['view']='manager/add_facility_category';
		$this->load->view('manager/template/main',$this->data);
	}
	public function edit_facility_category($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		$id=$this->encrypt_model->decode($id);
		if(isset($_POST['edit_category_btn']))
		{
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['image_url']['name'];
			$original_filename = $this->General_model->get_value_by_id('facility_categories', $id, 'image_url');
			if($_FILES['image_url']['name']!= '')
			{
				$upload_path = "uploads/facilities_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				if($this->upload->do_upload('image_url'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					
					list($width, $height) = getimagesize("uploads/facilities_images/".$original_filename);
					if($width > "1000" || $height > "1000") {
						 $config = array('image_library'=>'gd2',
										 'source_image'=>'uploads/facilities_images/'.$original_filename,
										 'maintain_ratio'=>TRUE,
										 'width'=>'1000',
										 'height'=>'1000',);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
					}
					$size = 262;
					$config = $this->resize_image("uploads/facilities_images/", $original_filename, $size, $size);
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				} 
			}
			$data=array(	  
				  'name' 	  =>	$this->input->post('name'),
				  'condo_id'  =>	$this->condo_id,
				  'image_url' =>	$original_filename
			);
			if(isset($_POST['info_only']))
			{
				$data['info_only']=1;
			}
			else
			{
				$data['info_only']=0;
			}
			$get_email_data = $this->General_model->updateData_array($data, 'facility_categories',$id);
			$this->session->set_flashdata("message", "Facility Category updated Successfuly.");
			redirect("manager/facility_category");
		}
		$this->data['title']='Manager | Edit Facility category';
		$action="id='$id' ";//AND role='1'//as both manager and security will recive email
		$this->data['category_details'] = $this->General_model->get_data_row_using_where('facility_categories', $action);
		$this->data['view']='manager/edit_facility_category';
		$this->load->view('manager/template/main',$this->data);
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
	
	public function noticeboard()
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		if(isset($_POST['addadvertisementsub'])){
			$description 		= $this->input->post('description');
			$title 				= $this->input->post('title');
			//$add_link 		= $this->input->post('add_link');
			if(isset($_POST['is_featured'])){$is_featured=1;}else{$is_featured=0;}
			$featured_image='';
			if(isset($_POST['images_names'])) 
			{
				foreach($_POST['images_names'] as $image_name)
				{
					if(pathinfo($image_name, PATHINFO_EXTENSION)!='pdf')
					{
						$featured_image 	= $image_name;
					}
				}
			}
			$DbFieldsArray 		= array('title','description','posted_by','image_url','is_resident_post','is_featured','status','condo_id','post_time');
			$DataArray = array($title, $description, $this->session->userdata('manager_id'), $featured_image, '0', $is_featured,'0', $this->session->userdata('condo_id'), date('Y-m-d H:i:s'));
			$id = $this->General_model->addData_InsertID($DbFieldsArray,$DataArray,'posts');
			
			//Add notification
			//save in db
			$DbFieldsArray_noti 		= array('session_id', 'person_id', 'facility_id', 'code', 'condo_id', 'insertDate', 'msg_time');
			$DataArray_noti = array(0, $this->session->userdata('manager_id'), 0, 'New Notice', $this->condo_id, date('Y-m-d H:i:s'), time());
			$this->General_model->addData($DbFieldsArray_noti,$DataArray_noti,'notifications');
			
			
			//update this advertisment images
			if(isset($_POST['images_names'])) 
			{
				foreach($_POST['images_names'] as $image_name)
				{
					$DbFieldsArray 		= array('post_id');
					$DataArray = array($id);
					$get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
				}
			}
			/*$images_ids 		= explode(',',$this->input->post('images_ids'));
			foreach($images_ids as $image_id)
			{
				$DbFieldsArray 		= array('post_id');
				$DataArray = array($id);
				$get_admin = $this->General_model->updateData($image_id, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
			}*/
			//exit;
			$this->session->set_flashdata('message', 'Post Added.');
			redirect('manager/noticeboard_posts'); 
			
		}
		$this->data['feature_limit']=$this->General_model->get_data_all_like_using_where('posts',"is_featured=1 AND is_resident_post=0 AND condo_id=$this->condo_id");
		$this->data['condos']=$this->General_model->get_data_all('condo_facilities');
		$this->data['title']='Manager | Noticeboard';
		$this->data['view']='manager/noticeboard';
		$this->load->view('manager/template/main',$this->data);
	}
	public function edit_noticeboard_post($id)
	{
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		$post_details=$this->General_model->get_data_row_using_where('posts',"id=$id");
		if(isset($_POST['addadvertisementsub'])){
			$description 		= $this->input->post('description');
			$title 				= $this->input->post('title');
			//$add_link 		= $this->input->post('add_link');
			if(isset($_POST['is_featured'])){$is_featured=1;}else{$is_featured=0;}
			
			$image_names= array();
			if(isset($_POST['images_names'])){$image_names= $_POST['images_names'];}
			
			if(sizeof($image_names)>0) 
			{
				foreach($_POST['images_names'] as $image_name)
				{
					if(pathinfo($image_name, PATHINFO_EXTENSION)=='pdf')
					{
						$featured_image 	= $image_name;
					}
					else
					{
						$featured_image=$post_details->image_url;
					}
				}
			}
			else
			{
				$featured_image=$post_details->image_url;
			}
			$DbFieldsArray=array('title','description','posted_by','image_url','is_resident_post','is_featured','status','condo_id','post_time');
			$DataArray = array($title, $description, $this->session->userdata('manager_id'), $featured_image, '0', $is_featured,'0', $this->session->userdata('condo_id'), date('Y-m-d H:i:s'));
			$this->General_model->updateData($id, 'id', $DbFieldsArray,$DataArray,'posts');
			//update this post images 
			/*$images_ids 		= explode(',',$this->input->post('images_ids'));
			if($_POST['images_ids']!="0")
			{
				$this->General_model->deleteDataGeneral("post_id=$id", 'posts_images' );
				foreach($images_ids as $image_id)
				{
					$DbFieldsArray 		= array('post_id');
					$DataArray = array($id);
					$get_admin = $this->General_model->updateData($image_id, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
				}
			}*/
			$images_array = "'0'";
			if(sizeof($image_names)>0) 
			{
			  foreach($_POST['images_names'] as $image_name)
			  {
				  $images_array .= ",'".$image_name."'";
			  }
			  foreach($_POST['images_names'] as $image_name)
			  {
				  $DbFieldsArray 		= array('post_id');
				  $DataArray = array($id);
				  $get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
			  }
			}
			$this->General_model->deleteDataGeneral("post_id=$id AND image_url NOT IN($images_array)", 'posts_images' );
			  
			
			//exit;
			$this->session->set_flashdata('message', 'Post Updated.');
			redirect('manager/noticeboard_posts'); 
			
		}
		$this->data['feature_limit']=$this->General_model->get_data_all_like_using_where('posts',"is_featured=1 AND is_resident_post=0");
		$this->data['condos']=$this->General_model->get_data_all('condo_facilities');
		$this->data['post_details']=$this->General_model->get_data_row_using_where('posts',"id=$id");
		$this->data['title']='Manager | Edit Noticeboard Post';
		$this->data['view']='manager/edit_noticeboard_post';
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
	public function check_info_only()
	{
		echo $this->General_model->get_value_by_id('facility_categories', $_POST['id'], 'info_only');
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
	
	
	
	public function post_file_upload_old_uploadify()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/post_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				//resize image if larger than 1000
				list($width, $height) = getimagesize("uploads/post_images/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/post_images/'.$original_filename,
									 'maintain_ratio'=>TRUE,
									 'width'=>'1000',
									 'height'=>'1000',);
					 $this->load->library('image_lib', $config); 
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
				}
				//resize ends
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts_images');
				$image_url = $this->General_model->get_value_by_id('posts_images', $id, 'image_url' );
				echo $image_url;
			} 
			
		}
		else 
		{
			echo 'Invalid file type.';
		}
	}
	
	public function post_file_upload()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['files']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['files']['name']!= '' )
		{
			 $upload_path = "uploads/post_images/";
			 $file_type = "gif|jpg|jpeg|png|pdf";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('files'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts_images');
				$image_url = $this->General_model->get_value_by_id('posts_images', $id, 'image_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url, 'extension'=>pathinfo($image_url, PATHINFO_EXTENSION),'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
				//resize image if size much big
				if(pathinfo($image_url, PATHINFO_EXTENSION)!='pdf')
				{
				  list($width, $height) = getimagesize("uploads/post_images/".$original_filename);
				  if($width > "1000" || $height > "1000") 
				  {
					   $config = array('image_library'	=>'gd2',
									   'source_image'	=>'uploads/post_images/'.$original_filename,
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
	
	public function post_featured_image()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/post_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				
				//resize image if larger than 1000
				list($width, $height) = getimagesize("uploads/post_images/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/post_images/'.$original_filename,
									 'maintain_ratio'=>TRUE,
									 'width'=>'1000',
									 'height'=>'1000',);
					 $this->load->library('image_lib', $config); 
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
				}
				//resize ends
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts_images');
				$image_url = $this->General_model->get_value_by_id('posts_images', $id, 'image_url' );
				echo $image_url;
			} 
			
		}
		else 
		{
			echo 'Invalid file type.';
		}
	}
	public function knowledge_base_image()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['files']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['files']['name']!= '' )
		{
			 $upload_path = "uploads/knowledge_base/";
			 $file_type = "pdf";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('files'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('file_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'knowledge_base_files');
				$image_url = $this->General_model->get_value_by_id('knowledge_base_files', $id, 'file_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url,'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
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
	public function email_attachement()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['file_upload']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['file_upload']['name']!= '' )
		{
			 $upload_path = "uploads/email_attachement/";
			 if(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION)=='psd')
			 {
				$file_type = "*";
			 }
			 elseif(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION)=='doc')
			 {
				 $file_type = "*";
			 }
			 elseif(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION)=='docx')
			 {
				 $file_type = "*";
			 }
			 else
			 {
				$file_type = "pdf|png|jpg|gif";
			 }
			 
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('file_upload'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray 	=  array('file_url','email_name');
				$DataArray 		=  array($original_filename,'manager_resident_email');
				$id 			= $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'email_attachment_files');
				$image_url 		= $this->General_model->get_value_by_id('email_attachment_files', $id, 'file_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url,'valid_file'=>'yes','extension'=>pathinfo($original_filename, PATHINFO_EXTENSION));
				echo json_encode(array('files'=>$posts));
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
	
	
	public function visitor_delivery(){
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}
		
		/*$action = " between '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59') 
		AND condo_id=$this->condo_id";
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests',"(date(deliverydatetime) = CURDATE() || date(deliverydatetime) = CURDATE() + INTERVAL 1 DAY) AND condo_id=".$this->condo_id."  AND status=0 ORDER BY deliverydatetime DESC");*/
		
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where("delivery_requests","condo_id='$this->condo_id' ORDER BY deliverydatetime DESC");
		
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where("visitor_requests", "condo_id='$this->condo_id' ORDER BY visitdatetime DESC");
		
		$this->data['title']='Manager | Visitor Delivery';
		$this->data['view']='manager/visitor_delivery';
		$this->load->view('manager/template/main',$this->data);
	}
	
	
	public function hire_service_provider(){
		if($this->session->userdata('manager_id')==""){
			redirect('manager'."?next=".$this->url);
		}

		$this->data['service_quotes'] = $this->General_model->get_data_all_like_using_where('service_quotes', 
		"status=2 AND service_request_id IN (select id from service_requests where condo_id=$this->condo_id)");
		
		$this->data['title']='Manager | Hire Service Provider';
		$this->data['view']='manager/hire_service_provider';
		$this->load->view('manager/template/main',$this->data);
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