<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	var $data;
	//var $manager_id;
	public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('Functions_model');
		$this->load->model('General_model');
		$this->load->model('Authentication_model');
		$this->load->model('encrypt_model');
		$this->resident_id = $this->session->userdata('resident_id');
		$this->condo_id = $this->session->userdata('condo_id');
	}
	public function index(){
		if($this->session->userdata('resident_id')!=""){
			redirect("dashboard");
		}
		$this->data['title']='ALIA - Search your Condo';
		$this->load->view('index',$this->data);
	} 
	public function search(){
		
		if($this->session->userdata('resident_id')!=""){
			redirect("dashboard");
		}
		$this->data['search_results']="";
		
		if(isset($_POST['index_btn'])){
			$this->data['search_results']=$this->Functions_model->search();
		} else {
			$this->data['search_results']=$this->Functions_model->search_all();
		}

		$this->data['title']='ALIA - Search Results';		
		$this->load->view('search',$this->data);
	}
	public function upload_progress(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		if(isset($_POST['upload_image_submit']))
		{
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['upload_file']['name'];
			$original_filename = '';
			if($_FILES['upload_file']['name']!= '')
			{
				 $upload_path = "uploads/profile_pictures/";
				 $file_type = "gif|jpg|jpeg|png";
				 $this->upload->initialize(array('upload_path'	=>$upload_path,
				 								 'allowed_types'=>$file_type,
												 'overwrite'	=>FALSE));
				if($this->upload->do_upload('upload_file'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					$this->session->set_flashdata('crop', 'true');
					echo '<img src="'.base_url()."uploads/profile_pictures/".$original_filename.'">';
					$image = $this->General_model->get_value_by_id('residents',$this->session->userdata('resident_id'),'image_url');
					$data = array('image_url'=>$original_filename);
					$this->General_model->updateData_array($data, 'residents', $this->session->userdata('resident_id'));
					
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
					
					$sizes = array(40,100,200);
					foreach($sizes as $size)
					{
					 $config = $this->resize_image("uploads/profile_pictures/", $original_filename, $size, $size);
					 $this->load->library('image_lib', $config); 
					 $this->image_lib->initialize($config);
					 $this->image_lib->resize();
					}
				 //for crop image260*195
				 $config = array('image_library'=>'gd2',
				 'source_image'=>'uploads/profile_pictures/'.$original_filename,
				 'maintain_ratio'=>true,
				 'width'=>'260',
				 //'height'=>'195',
				 'new_image'=>pathinfo($original_filename, PATHINFO_FILENAME).'_260_195.'.pathinfo($original_filename, PATHINFO_EXTENSION),);
						 $this->load->library('image_lib', $config); 
						 $this->image_lib->initialize($config);
						 $this->image_lib->resize();
				} 
			}
			else 
			{
				$original_filename =  $this->upload->display_errors();
			}
		
		}
	}
	
	public function jacrop()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			list($width, $height) = getimagesize('uploads/profile_pictures/'.$_POST['image_url']);
			$width_ratio = $width/260;
			$tepmp_height = (260/$width)*$height;
			$height_ratio = $height/$tepmp_height;
			//$targ_w = $targ_h = 150;
			//$targ_w =$_POST['w']-$_POST['x'];//$targ_h =$_POST['h']-$_POST['y'];
			$targ_w =$_POST['targ_w']*$width_ratio; $targ_h =$_POST['targ_h']*$height_ratio;
			$jpeg_quality = 100;
			$src = 'uploads/profile_pictures/'.$_POST['image_url'];
			
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,intval($_POST['x']*$width_ratio),intval($_POST['y']*$height_ratio), $targ_w,$targ_h, $targ_w,$targ_h);
			//header('Content-type: image/jpeg');
			imagejpeg($dst_r,'uploads/profile_pictures/'.$_POST['image_url'], $jpeg_quality);
			//40*40
			imagejpeg($dst_r,'uploads/profile_pictures/'.pathinfo($_POST['image_url'], PATHINFO_FILENAME).'_40_40.'.pathinfo($_POST['image_url'], PATHINFO_EXTENSION), $jpeg_quality);
			//exit;
			redirect(base_url().'profile');
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
	
	//Add Facility Booking
	public function add_facility_booking()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_facility_booking'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'facility')){
			redirect(base_url().'dashboard');
		}
		
		if(isset($_POST['facility_booking_submit']))
		{
			$condo_facility 	 = $this->input->post('condo_facility');
			$startdate 		  = $this->input->post('startdate');
			$slot_id 			= $this->input->post('day_slot_val_append');
			/*$starttime 			= $this->input->post('starttime');
			$enddate 			= $this->input->post('startdate');//enddate
			$endtime 			= $this->input->post('endtime');
			
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
				$end_hour='00';
			}
			$end_minut =explode(':',$endtime_space[0]); 
			$end_minut =$end_minut[1];
		*/

			$DbFieldsArray 	= array('resident_id', 'slot_id', 'datetime_booked', 'facility_id', 'bookedfor_datetime_from', 'condo_id');
			$DataArray 		= array($this->session->userdata('resident_id'), $slot_id, date('Y-m-d H:i:s'),
			$condo_facility, $startdate, $this->condo_id);
			
			/*$action="condo_id='$this->condo_id' AND facility_id=$condo_facility 
			AND (bookedfor_datetime_from <= '$enddate $end_hour:$end_minut:00') and (bookedfor_datetime_to >= '$startdate $start_hour:$start_minut:00')";*/
			/*AND (bookedfor_datetime_from<'$startdatetime' AND bookedfor_datetime_to>'$startdatetime') 
			AND (bookedfor_datetime_from<'$enddatetime' AND bookedfor_datetime_to>'$enddatetime')*/
			
			/*$bookec_facilities = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
			if(sizeof($bookec_facilities)>0)
			{
				//booked
				$this->session->set_flashdata('message_danger', 'Facility Already booked in this time range.');
				redirect('add_facility_booking'); 
			}
			else
			{*/
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'facility_booking');
				//get record
				$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility");
				//Get name of Condo Facility
				$facility_name = $this->General_model->get_value_by_id('condo_facilities', $condo_facility, 'name');
				//prepare arrays
				$DbFieldsArray 	= array('payer_id', 'booking_id', 'payment_for', 'date_created', 'date_paid', 'system_transaction_id', 'transaction_info', 
				'amount_paid', 'payment_receipt', 'payment_month', 'payment_channel','payment_status', 'condo_id');
				$DataArray 		= array($this->session->userdata('resident_id'), $id, '1', date('Y-m-d H:i:s'), '', time(), '', 
				0, '', '', '', 0, $this->condo_id);
				//insert into invice
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
				
				$daata = array('facility_invoice_id'=>$invoice_id);
				$this->session->set_userdata($daata);
			//}
			//$this->session->set_flashdata('message', 'Facility booked succussfully.');
			redirect('facility_payment'); 
		}
		$action="condo_id='$this->condo_id' order by id ASC LIMIT 3";//AND role='1'//as both manager and security will recive email
		$this->data['facility_categories'] = $this->General_model->get_data_all_like_using_where('facility_categories', $action);
		$this->data['title']='Facility Booking - ALIA';
		$this->data['page_title']='Facility Booking';
		$this->data['view']='add_facility_booking';
		$this->load->view('template/main',$this->data);
	}
	
	public function add_facility_booking_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$facility_categories=$this->General_model->get_data_all_like_using_where('facility_categories',"id>$lastmsg AND condo_id='$this->condo_id' ORDER BY id ASC LIMIT 3");
		$n=1;
		foreach($facility_categories as $report)
		{
			$msg_id=$report['id'];
			
              if($report['image_url']=='')
              {$src=base_url()."assets/front/global/img/no-image-box.png";}
              else{$src=base_url()."uploads/facilities_images/". $this->General_model->get_thumb_of_image($report['image_url'],'_262_262');}
            ?>
                <div class="cbp-item" style="width:232px;margin-right: 22px;">
                    <div class="cbp-caption">
                        <div class="<?php if($report['info_only']==0){?>cbp-caption-defaultWrap<?php }?>">
                        <?php if($report['info_only']==0){?>
                        <a href="<?php echo base_url()?>home/facility_booking_form/<?php echo $this->encrypt_model->encode($report['id']);?>"
                         class="cbp-singlePage" rel="nofollow">
						<?php }else{?>
                        <a href="<?php echo base_url();?>infonlycat_facilities/<?php echo $this->encrypt_model->encode($report['id']);?>" 
                        target="_blank">
                        <?php }?>
                            <img src="<?php echo $src;?>" alt="">
                        </a>
                        </div>
                        <?php if($report['info_only']==0){?>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                 <a href="<?php echo base_url()?>home/facility_booking_form/<?php echo $this->encrypt_model->encode($report['id']);?>"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" 
                                    rel="nofollow"  style="padding:2px; margin:2px;">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                      echo $report['name'];
                      ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                     <?php //echo date('h A',strtotime($report['opening_hour']))?>
                     <?php //echo date('h A',strtotime($report['closing_hour']))?>
                    </div>
                </div>
                <?php
			$n++;
			}
			if(isset($msg_id)){?>
			<div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</div>
			
			<?php
			}else{
			?>
            <div class="morebox_services_requests search-item clearfix">
				<p> No more categories at the moment. </p>
			</div>
			
			<?php
			}
		}
	
	}
	//info only categories facilities
	public function infonlycat_facilities($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_facility_booking'));
		}
		$id=$this->encrypt_model->decode($id);
		$action="condo_id='$this->condo_id' AND facility_category_id=$id";//AND role='1'//as both manager and security will recive email
		$this->data['facilities'] = $this->General_model->get_data_all_like_using_where('condo_facilities', $action);
		$this->data['title']='Facility Booking - ALIA';
		$this->data['page_title']='Info only category facilities';
		$this->data['view']='infonlycat_facilities';
		$this->load->view('template/main',$this->data);
	}
	public function facility_booking_form($id){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['facility_categories']=$this->General_model->get_data_rowusingwhere_empty_array('facility_categories', "id=".$this->encrypt_model->decode($id));
		$this->data['title']='Facility Booking Form - ALIA';	
		$this->data['page_title']='Facility Booking Form';		
		$this->load->view('facility_booking_form',$this->data);
	}
	
	public function add_facility_session()
	{
		echo $this->General_model->get_value_by_id("condo_facilities", $this->input->post('id'), "session_time");
	}
	
	
	public function archive_notice()
	{
		$DbFieldsArray = array('post_id','date');
		$DataArray	   = array($_POST['id'], date('Y-m-d H:i:s'));
		$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray, $_POST['table']);
	}
	
	
	public function load_facility_details(){
		$id = $this->input->post('id');
		$facility=$this->General_model->get_data_rowusingwhere_empty_array('condo_facilities', "id=".$id);
		$manageremail='';$managerphone='';
		$manager=$this->General_model->get_data_rowusingwhere_empty_array('condo_admins', "role=1 and condo_id=".$facility->condo_id);
		
		if(sizeof($manager)>0){$manageremail=$manager->email; $managerphone=$manager->phone;}
		
		$string='';
		
		
		$string.='
		<li>
			<strong>Price</strong>RM '.$facility->price.' per session
		</li>
		<li>
			<strong>Per Session</strong> '.$facility->session_time/60 .' Hrs 
			
		</li> 
		<li>
			<strong>Advance booking required : </strong>'.($facility->is_day_rang_settings==1 ? " Yes Min=".$facility->is_day_rang_settings_min."  days & Max=".$facility->is_day_rang_settings_max." days" :' No').' 
		</li>
		<li>
			<strong>Description</strong>'.$facility->description.'
		</li>
		<li>
			<strong>Opening Hours</strong> '.date("H:i", strtotime($facility->opening_hour)).' - '.date("H:i", strtotime($facility->closing_hour)).'
		</li>
		';
	   $modal_content ='<div class="note note-success">

		  <p>For bookings more than one session, kindly contact management office Email: '.$manageremail.', Phone: '.$managerphone.'.</p>
		 </div>';
		 $modal_button ='<a data-toggle="modal" data-target="#myModal">Need more sessions?</a>';
		 echo json_encode(array('string'=>$string, 'modal_content'=>$modal_content, 
		 		'modal_button'=>$modal_button));
	}
	//Advertisements
	public function advertisements()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_facility_booking'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'advertisement')){
			redirect(base_url().'dashboard');
		}
		
		$action		="condo_id=".$this->condo_id." AND payment_status=1 AND  status=1  AND advert_type=1   order by id desc";
		$action2	="condo_id=".$this->condo_id." AND payment_status=1 AND  status=1 AND advert_type=2  order by id desc";
		//AND role='1'//as both manager and security will recive email
		$this->data['adverts'] 			= $this->General_model->get_data_all_like_using_where('adverts', $action);
		$this->data['featured_adverts'] = $this->General_model->get_data_all_like_using_where('adverts', $action2);
		$this->data['title']			='Offers & Promos - ALIA';
		$this->data['page_title']			='Offers & Promos';
		$this->data['view']	='advertisements';
		$this->load->view('template/main',$this->data);
	}
	//Advertisements
	public function advertisements_viewajax()
	{
		if(isSet($_POST['lastmsg']))
		{
		
		
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = "id<'$lastmsg'  order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('adverts', $action);
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		$src=base_url()."uploads/advertisement_images/".$report['image_url'];
		?>
        <li class="search-item clearfix">
            <a href="javascriptt:;">
                <img src="<?php echo $src;?>" />
            </a>
            <div class="search-content">
                <h2 class="search-title">
                    <a href="javascript:void(0)"> <?php echo $report['title']?></a>
                </h2>
                <p class="search-desc">  <?php echo $report['description']?> </p>
            </div>
        </li>
		<?php
		}
		?>
		
		<?php if(isset($msg_id)){?>
         <li class="search-item clearfix morebox" id="more<?php echo $msg_id; ?>">
            <div class="search-content">
                <h2 class="search-title">
                    <a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
                </h2>
            </div>
        </li>
		
		<?php
		}else{
		?>
         <li class="search-item clearfix morebox" >
            <div class="search-content">
                <h2 class="search-title">
                    No more Advertisements
                </h2>
            </div>
        </li>
        <?php
		}
		}
	}
	//Check select_select_facility_desc_n_img
	public function select_select_facility_desc_n_img()
	{
		 $facility_id = $this->input->post('facility_id');
		 $action='id='.$facility_id;
		 $servies =$this->General_model->get_data_row_using_where('condo_facilities', $action);
		 $image ="<img src='".base_url()."uploads/facilities_images/".$servies->image_url."'>";
		 $description = $servies->description;
		 $data = array('image'=>$image,
		 				'description'=>$description);
		 echo json_encode($data);
	}
	public function set_upload_options($upload_path, $file_type){   
		// upload image options
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $file_type;
		$config['overwrite']     = FALSE;
		return $config;
	}
	public function fetch_condos(){
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
						$condo_city = $this->General_model->get_value_by_id('areas',$condo_list["areas"],'name');
						$condo_state = $this->General_model->get_value_by_id('states',$condo_list["state"],'name');
					    $condo_lists.='<li onclick="add_resident('.$condo_list["id"].')">
						<a onclick="checkalert(\'' .$condo_name. '\')" href="javascript:void(0)">
						<img  src="'.base_url().'uploads/condos/condo_pictures/'.$condo_logo.'" width="75" height="75">
						<span>'.$condo_name.'<br/>'.$condo_address.'<br/>'.$condo_city.'<br/>'.$condo_state.'</span>
						</a>
						<a class="live-here" href="javascript:void(0)" > I live here </a>
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

	public function add_resident(){
		if($this->session->userdata('link_condo_id')==""){
			redirect(base_url());
		}
		$condo_id = $this->session->userdata('link_condo_id');
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
					  'floor'          =>	$this->input->post('floors'),
					  'unit'           =>	$this->input->post('unit'),
					  'date_registered'=>	date('Y-m-d'),
					  'password'       =>	md5($password)
					  );
					  $get_email_data = $this->General_model->addData_array($data, 'residents');
				
				//Send Email to resident
				$subject = "New Resident Account Registration – Pending Approval";
				$message = "<div style='".$this->config->item('style')."'>Hello  ".$this->input->post('name').", <br />
				Thank you for registering with your community platform, powered by ALIA. <br /><br />
				Your Email is  ".$this->input->post('email')."<br /><br />
				You will be notified once your account is approved by your residence management.
				<br /><br />";
				$this->email($this->input->post('email'), $this->input->post('name'), $subject, $message);
				
				
				
				
				
				
				
				
				//Send Email to condo Admin
				$action="condo_id='$condo_id' AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						if($this->input->post('type')==1){ $tyype = "Tenant";} else { $tyype = "Owner";}
						$subject_admin = "A new resident has registered! – Approval needed";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
						A new resident has registered under your residence. Please verify and approve the account. 
						The user details are as follows:<br />
						Name: ".$this->input->post('name')."<br />
						Email: ".$this->input->post('email')."<br />
						Phone:".$this->input->post('phone')."<br />
						Type: ".$tyype."<br />
						Unit:".$this->General_model->get_value_by_id('blocks', $this->input->post('block'), 'name')."
						-".$this->input->post('floors')."-".$this->input->post('unit')."<br />
						<a href='".base_url()."home/approve_resident/".md5($this->input->post('email'))."'>Click here</a> to approve. 
						<br /><br /></div>
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
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
		$this->data['title']='Add Resident';		
		$this->load->view('add_resident',$this->data);
	}



	public function advertisement_details($id){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['adverts']=$this->General_model->get_data_rowusingwhere_empty_array('adverts', "id=".$id);
		$this->data['title']='Advertisement Details';		
		$this->load->view('advertisement_details',$this->data);
	}
	public function show_incident_details($id){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['incidents']=$this->General_model->get_data_rowusingwhere_empty_array('incident_reporting', "id=".$id);
		$this->data['title']='Incident Details';		
		$this->load->view('incident_details',$this->data);
	}
	public function login(){
		if($this->session->userdata('link_condo_id')==""){
			redirect(base_url());
		}
		$condo_id = $this->session->userdata('link_condo_id');
		if(isset($_POST['login_btn']))
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			 if($this->Authentication_model->resident_authentication_login($email, $password)){
				if($this->Authentication_model->resident_active_account_check($email, $password)){
					//echo 'Active';
					//$this->session->set_flashdata('message', 'Active');
					$unsetData = array(
					 	'link_condo_id' => ''
					);
					$this->session->set_userdata($unsetData);
					redirect(base_url().'dashboard');
				} else {
					//echo 'notactive';
					$this->session->set_flashdata('message', 'Account Not Active.');
				}
			} else {
				//echo 'fail';
				$this->session->set_flashdata('message', 'Incorrect Email or Password.');
			}
		}
		$this->data['title']='ALIA - Log In or Sign Up';	
		$condo_id = $this->session->userdata('link_condo_id');
		$this->data['blocks']=$this->General_model->get_data_all_using_where('condo_id',"$condo_id",'blocks');	
		$this->load->view('login',$this->data);
	}
	public function signup(){
		$condo_id = $this->input->post('condo_id');
		if(isset($_POST['add_resident_btn']))
		{
			$this->load->helper('string');
			$password = random_string('alnum', 8);
			$data=array(	  
					  'name'           =>	$this->input->post('name'),
					  'condo_id'       =>	$this->input->post('condo_id'),
					  'email'          =>	$this->input->post('email'),
					  'phone'          =>	$this->input->post('phone'),
					  'status'          =>	'1',
					  'verify_code'    =>	md5($this->input->post('email')),
					  'type'           =>	$this->input->post('type'),
					  'block'          =>	$this->input->post('block'),
					  'floor'          =>	$this->input->post('floors'),
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
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
						A new Resident has been registered under you condo. Please do check and approve. The details are as follows:<br />
						Name: ".$this->input->post('name')."<br />
						Email: ".$this->input->post('email')."<br />
						Phone:".$this->input->post('phone')."<br />
						Type: ".$tyype."<br />
						Unit:".$this->General_model->get_value_by_id('blocks', $this->input->post('block'), 'name')."
						-".$this->input->post('floors')."-".$this->input->post('unit')."<br />
						<a href='".base_url()."home/approve_resident/".md5($this->input->post('email'))."'>Click here</a> to approve. 
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
				redirect("success");
		}
		$this->data['title']='Signup';	
		$this->load->view('signup',$this->data);
	}
	
	
	
	public function po_approve_resident()
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
	
	public function approve_resident($verify_code)
	{
		$ver =$this->General_model->get_data_all_like_using_where('residents',"verify_code='$verify_code'");
		if(sizeof($ver)>0)
		{
			$this->data['message']='Email Approved';
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array('2');
			$whereClouse = "verify_code = '$verify_code'";
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
			//
			//Collect Email Data
				$subject_first = "Resident Account Approved";
				$message_first = "<div style='".$this->config->item('style')."'>Hi ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"name").", <br />

				Thank you for joining the ALIA community, your very own residential community platform.<br /><br />
				
				
				Your Email is ".$this->General_model->get_data_value_using_where('residents',$whereClouse,"email")."<br /><br />
				
				
				<a href='".base_url()."home/confirm_resident/".$verify_code."'>Click here</a> to confirm and login to find out how you can 				benefit from your community platform.<br /><br />

				Start using your account now and experience the convenience of smart living at your comfort.<br /><br />

				</div>
				";
				
				//Send Welcome Email
				$this->email($this->General_model->get_data_value_using_where('residents',$whereClouse,"email"), $this->General_model->get_data_value_using_where('residents',$whereClouse,"name"), $subject_first, $message_first);
			
		}
		else
		{
			$this->data['message']='Email Not Approved';
		}
		 
		
		
		$this->data['title']='Approve Resident';
		$this->load->view('approve_resident',$this->data);
	}
	
	//Check Email existance
	public function select_category_services()
	{
		 $category_id = $this->input->post('category_id');
		 $result ="<select id='service' name='service' class='form-control'>"; 
		 $servies =$this->General_model->get_data_all_using_where('category_id',$category_id,'services','name','ASC');
		 foreach($servies as $service)
		 {
			 $result .="<option value='".$service['id']."'>".$service['name']."</option>"; 
		 }
		 $result .="</select>";
		 echo $result;
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
	public function delete_image_and_section()
	{
		 $imagefolder 		= $this->input->post('imagefolder');
		 $imagename 		= $this->input->post('imagename');
		 $imageextention 	= $this->input->post('imageextention');
		 $table 			= $this->input->post('table');
		 $image=$imagename;if($imageextention!=''){$image.='.'.$imageextention;}
		 $post_images = $this->General_model->get_data_all_like_using_where($table,"image_url='".$image."'");
		 if(sizeof($post_images)>0)
		 {
			 foreach($post_images as $image)
			 {
			   $file = "uploads/".$imagefolder."/".$image;
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
		 $this->General_model->deleteDataGeneral("image_url='".$image."'", $table);
		 //echo true;
	}
	
	public function delete_service_request()
	{
		 $id 			    = $this->input->post('id');
		 $post_images = $this->General_model->get_data_all_like_using_where('service_requests_images',"service_request_id='".$id."'");
		 if(sizeof($post_images)>0)
		 {
			 foreach($post_images as $image)
			 {
			   $file = "uploads/services_requests/".$image['image_url'];
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
		 $this->General_model->deleteDataGeneral("id='".$id."'", 'service_requests');
		 $this->General_model->deleteDataGeneral("service_request_id='".$id."'", 'service_quotes');
		 $this->General_model->deleteDataGeneral("service_qoute_id IN(select id from service_quotes where service_request_id='".$id."')", 'service_quotes_comments');
		 //echo true;
	}
	public function edit_post()
	{
		 $post_id = $this->input->post('post_id');
		 $data = $this->General_model->get_data_row_using_where("posts","id=$post_id");
		 $images = $this->General_model->get_data_all_like_using_where("posts_images","post_id=$data->id");
		 //print_r($data);
		 //print_r($images);
		 ?>
         <form method="post" action="<?php echo base_url();?>dashboard" id="dashboar-post-form-edit" onsubmit="return empty_post_check();">
         <input type="hidden" name="post_id" value="<?php echo $data->id;?>" />
         <textarea class="form-control" name="post" id="post_modal" value=""><?php echo $data->description;?></textarea>
         <div class="post-action">
         <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Select files...</span>
              <input id="file_upload2" type="file" name="file_upload" multiple>
          </span>
          <div id="progress2" class="progress" style="margin-top: 10px;">
            <div class="progress-bar progress-bar-success"></div>
          </div>
         <input type="submit" name="post_edit_btn" id="post_submit_btn2" value="Update Post" class="post-post pull-left">
         </div>
		 <span id="additional_images2">
            <?php 
			if(sizeof($images)>0)
			{
				foreach($images as $image)
				{
					$characters = 'abcdefghijklmnopqrstuvwxyz';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < 5; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
			?>
            <section style="position:relative; float:left" class="<?php echo $randomString?>"><img src="<?php echo base_url()?>uploads/post_images/<?php echo $image['image_url']?>" class="img_responsive" style="width:100px; float:left; height:80px;"/><span onclick="delete_image_section('<?php echo $randomString?>')" class="image_delete_cross">&#120;</span><input type="hidden" name="images_names[]" value="<?php echo $image['image_url']?>" class="images_names"></section>
            
            <?php }
			}?>
            </span>
            <div class="row">
            <div class="col-md-12">&nbsp;</div>
            </div>
            
            </form>
            <?php
	}
	//Check Email existance	
	public function report_post()
	{
		$post_id = $this->input->post('post_id');
		$action="id='$post_id' ";//AND role='1'//as both manager and security will recive email
		$post_detail = $this->General_model->get_data_row_using_where('posts',$action);
		/*$get_admin = $this->General_model->get_data_all('admins');
		if($get_admin >0)
		{
			foreach($get_admin as $admin)
			{*/
				$subject_admin = "Post Reported";
				$message_admin = "<div style='".$this->config->item('style')."'>Hello  Alpha, <br />
				
				A post is reported. Please do check. 
				
				<br> Description: ".$post_detail->description."
				<br> Posted By: ".$this->General_model->get_value_by_id('residents',$post_detail->posted_by,'name');
				
				$posts_images=$this->General_model->get_data_all_using_where('post_id',$post_id,'posts_images');
						  if(sizeof($posts_images)>0)
						  {
							  foreach($posts_images as $posts_image)
							  {
								$message_admin.= '<img src="'.base_url().'uploads/post_images/'.$posts_image['image_url'].'" />';
							  }
						  }	
				
				$message_admin.= "<br /><br /></div>";
				//Send Welcome Email
				//echo $admin['email'];
				$this->email($this->config->item('alpha_email') , "Alpha", $subject_admin, $message_admin);
			/*}
		}*/
		$DbFieldsArray	=	array('post_id', 'reported_by','report_time');
		$DataArray		=	array($post_id, $this->session->userdata('resident_id'), date('Y-m-d H:i:s'));
		$this->General_model->addData($DbFieldsArray, $DataArray ,'reported_posts');
		echo true;
  }

	public function notification_checked()
	{
		$DbFieldsArray 		= array('read_noti');
		$DataArray 			= array('1');
		$get_admin = $this->General_model->updateData($_POST['sess_id'], 'session_id', $DbFieldsArray, $DataArray, 'notifications' );
	}
	

	public function add_service_request()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_service_request'));
		}
		if(isset($_POST['service_request_submit']))
		{
			$original_filename	= "";
			if(isset($_POST['images_names'][0]))
			{
				foreach($_POST['images_names'] as $image_name)
				{$original_filename = $image_name;}
			}
			//echo $original_filename; exit;
			$service_category 	= $this->input->post('service_category');
			$service 			= $this->input->post('service');
			$description 		= $this->input->post('description');
			$duration 			= $this->input->post('duration');
			
			
			$DbFieldsArray 	= array('requested_by', 'condo_id', 'service_id', 'description', 'duration', 'requested_time', 'service_request_file');
			$DataArray 		= array($this->session->userdata('resident_id'), $this->condo_id, $service, $description, $duration, date('Y-m-d H:i:s'),$original_filename);
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'service_requests');
			
			if(isset($_POST['images_names'][0]))
			{
			  foreach($_POST['images_names'] as $image_name)
			  {
				  //echo "success";exit;
				  $DbFieldsArray 		= array('service_request_id');
				  $DataArray 			= array($id);
				  $get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'service_requests_images' );
			  }
			}
			
			
			//get all vendor having this condo
			$this_condo_vendors=array();
			$v_condos =$this->General_model->get_data_all_using_where('condo_id',$this->condo_id,'vendor_condos');
			foreach($v_condos as $vendor)
			{
				array_push($this_condo_vendors,$vendor['vendor_id']);
			}
			
			//get all vendor having this service
			$this_service_vendors=array();
			$v_services =$this->General_model->get_data_all_using_where('service_id',$service,'vendor_services');
			foreach($v_services as $service_v)
			{
				array_push($this_service_vendors,$service_v['vendor_id']);
			}
			
			//Match two arrays to get vendor with this condo and this service
			$result=array_intersect($this_condo_vendors, $this_service_vendors);
			//print_r($result);exit;
			
			//Now email each vendorf
			foreach($result as $res)
			{
				$result_vendors =$this->General_model->get_data_by_id($res,'vendors');
						$subject_admin = "You have a new sales lead - reply with a quote now!";
						$message_admin = "<div style='".$this->config->item('style')."'>Hi  ".$result_vendors->name.", <br />
						Great News! You have received a new service request from ".$this->General_model->get_value_by_id('condos',$this->condo_id,'name').".
						A new Service is Requested from you. Please do check. The details are as follows:<br />
						Description: ".$this->input->post('description')."<br />
						Time remaining before job expires: ".$duration." Days<br />
						Service: ".$this->General_model->get_value_by_id('services', $service, 'name')."<br />
						Category: ".$this->General_model->get_value_by_id('services_categories', $service_category, 'name')."<br />";
						if($original_filename!='')
						{
							$message_admin .=" File: <br><img src='".base_url()."uploads/services_requests/".$original_filename."' style='max-width:200px;'>";
						}
						$message_admin .="<br />
						Please login to your account at www.als.com.my/vendor to view the request and reply with your 
						quotation if the job is relevant to you. <br /><br />

						Your reply should include a personal message and a price estimate.<br /><br />
						
						You may continue to communicate with the customer once you have replied with a quote via ALIA. <br /><br />
						 
						You will be notified once the customer decides to hire you.

						
						<br /><br /></div>
						
						";
						//Send Welcome Email
						$this->email($result_vendors->email, $result_vendors->name, $subject_admin, $message_admin);
			}
			//echo "success";exit;
			$this->session->set_flashdata('message', 'Service request Added. Emails sent to vendors.');
			redirect('service_requests'); 
		}
		$action="";
		$this->data['service_categories'] = $this->General_model->get_data_all('services_categories','name','ASC');
		$this->data['title']='New Service Request - ALIA';
		$this->data['page_title']='New Service Request';		
		$this->data['view']='add_service_request';
		$this->load->view('template/main',$this->data);
	}
	

	
	public function add_advertisement(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_advertisement'));
		}
		if(isset($_POST['addadvertisementsub'])){
			$title 			= $this->input->post('title');
			$description 	= $this->input->post('description');
			//$add_link 		= $this->input->post('add_link');
			$featured_image ='';
			if($this->input->post('featured_image')){
			$featured_image = $this->input->post('featured_image');}
			$DbFieldsArray 		= array('title','description','advert_by','image_url','payment_status','condo_id','advert_type');
			$DataArray = array($title, $description, $this->session->userdata('resident_id'), $featured_image, '0', $this->session->userdata('condo_id'), $this->input->post('advert_type'));
			$id = $this->General_model->addData_InsertID($DbFieldsArray,$DataArray,'adverts');
			if(isset($_POST['images_names']))
			{
				foreach($_POST['images_names'] as $image_name)
				{
					if($this->input->post('featured_image') && $this->input->post('featured_image')==$image_name)
					{$this->General_model->delete_data_using_where('image_url', $image_name, 'adverts_images' );}
					else
					{$DbFieldsArray 	= array('advert_id');
					$DataArray 			= array($id);
					$this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'adverts_images' );}
				}
			}
			//exit;
			$this->session->set_flashdata('message', 'Advertisement Added. You can proceed to payment once approved by admin.');
			//Send Email to condo Admin
			$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "Advertisement Added";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A new Advertisement has been added under you condo. Please do check. The details are as follows:
					<br />
					Category : ".$this->General_model->get_value_by_id('incident_categories', $this->input->post('incident_category'),'name')."<br>
					Title :".$this->input->post('title')."<br>
					Link :".$this->input->post('add_link')."<br>
					Image :<br><img src=".base_url()."uploads/advertisement_images/".$this->input->post('featured_image')."><br>
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
			/*$data=array('adver_id'=>$id);
			$this->session->set_userdata($data);*/
			redirect('add_advertisement'); 
			
		}
		$this->data['title']='Advertisement';
		$this->data['view']='add_advertisement';
		$this->load->view('template/main',$this->data);
	}
	public function approve_quote()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
				if($status ==='2')
				{	$app ="Approved";}
				else
				{  	$app ="DisApproved";}
				$action="condo_id='$this->condo_id' ";//AND role='1'//as both manager and security will recive email
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						$subject_admin = "Qoute $app";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
						
						A new Qoute has been $app under your condo. Please do check. 
						
						<br /><br /></div>
						
						";
						//Send Welcome Email
						//echo $admin['email'];
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					}
				}
		$ver = $this->General_model->get_data_row_using_where('service_quotes',"id='$id'");
		if(sizeof($ver)>0)
		{
			$updateDbFieldsAry = array('status');
			$updateInfoAry = array($status);
			$whereClouse = "id='$id'";
			
					$ver =$this->General_model->updateData($id, 'id', $updateDbFieldsAry, $updateInfoAry, 'service_quotes');
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
	public function service_quotes_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		
		
		$action = "";
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		
		//get all service requests having this condo
		$this_condo_service_requests=array();
		$in="0";
		$service_r_ids = $this->General_model->get_data_all_like_using_where('service_requests', "condo_id=$this->condo_id $action order by id desc");
		foreach($service_r_ids as $id)
		{
			array_push($this_condo_service_requests,$id['id']);
			$in.=",".$id['id'];
		}	
		
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = "id<'$lastmsg' AND service_request_id IN($in) order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('service_quotes', $action);
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
        <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
         <td class="table-title">
			  <?php 
              $service_id = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'service_id');
              $service_name = $this->General_model->get_value_by_id('services', $service_id, 'name');
              echo $service_name;
              ?>
          </td>
          <td class="table-title">
              <?php echo $this->General_model->get_value_by_id('vendors', $report['quoted_by'], 'name');?>
          </td>
          <td class="table-date font-blue">
          
              <?php 
              if($report['ven_arival_time'] != '0000-00-00 00:00:00' && $report['status'] == 1){
                  echo date("d/m/Y h:i a", strtotime($report['ven_arival_time']));
              } else {
                  echo 'N/A';
              }?>
          </td>
          
          <td class="table-desc"><?php echo $report['description']?></td>
          <td  class="table-title" id="<?php echo $report['id']?>"> 
          <a href="<?php echo base_url();?>services_quotes_comments/<?php echo $report['id']?>" data-original-title="Comment"><i class="fa fa-weixin"></i></a>
              <?php if($report['status']=='2')
              { echo '<span class="label label-info">Waiting for Manager</span>';} 
              elseif($report['status']=='3') 
              {echo '<span class="label label-warning">Disapproved</span>';}
              elseif($report['status']=='0') 
              {echo '<span class="label label-default">Vendor Replied</span>';}
              elseif($report['status']=='1') 
              {echo '<span class="label label-success">Approved</span>';}
              else
              { //echo $report['status'];?>
              <?php }?>
          </td>
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="5" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr>
        	<td colspan="5" align="center"  class="morebox">
				No more Services quotes
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function remove_profile_image()
	{
	  $updateDbFieldsAry = array('image_url');
	  $updateInfoAry = array('');
	  $whereClouse = "id =".$_POST['id'];
	  $ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'residents');
	}
	public function service_quotes()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'service_quotes'));
		}
		if(isset($_POST['arival_datetime_btn']))
		{
			$quote_id =  $this->input->post('quote_id');
			$arivaldatetime =  $this->input->post('arivaldatetime');
			$resident_phone =  $this->input->post('phone');
			$message =  $this->input->post('message');
				
			$updateDbFieldsAry = array('ven_arival_time', 'resident_phone', 'status', 'message');
			$updateInfoAry = array($arivaldatetime, $resident_phone, '2', $message);
			$whereClouse = "id='$quote_id'";
			$ver =$this->General_model->updateData($quote_id, 'id', $updateDbFieldsAry, $updateInfoAry, 'service_quotes');
			
			//Send Email to condo Admin
				$action="condo_id='$this->condo_id' AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				$risi_details =$this->General_model->get_data_row_using_where('residents',"id=".$this->session->userdata('resident_id'));
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						//echo "success";exit;
					
						$subject_admin = "Service Appointment Request – Approval needed";
						$message_admin = "<div style='".$this->config->item('style')."'>Hi ".$admin['full_name'].", <br /><br />
						
						A resident has hired a service provider and the details are as follows:<br /><br />
						Resident Name: ".$risi_details->name."<br />
						Email: ".$risi_details->email."<br />
						Phone: ".$risi_details->phone."<br />
						Unit: ".$risi_details->unit."<br />
						Vendor: ".$this->General_model->get_value_by_id("vendors", $this->General_model->get_value_by_id('service_quotes',$quote_id, 'quoted_by'), "name")."<br />
						Appointment Date: ".$this->input->post('arivaldatetime')."<br />

						
						Reason:".$this->input->post('message')."<br /><br />

						Please login to your account at www.als.com.my/manager to approve or reject this service appointment request.

						<br /><br /></div>
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
						
					}
				}
			
			
			$this->session->set_flashdata('message', 'Time added successfully.');
			redirect('service_quotes'); 
		}
		//get all service requests having this condo
		
		$action = "";
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		
		$this_condo_service_requests=array();
		$in="0";
		$service_r_ids = $this->General_model->get_data_all_like_using_where('service_requests', "condo_id=$this->condo_id $action order by id desc");
		foreach($service_r_ids as $id)
		{
			array_push($this_condo_service_requests,$id['id']);
			$in.=",".$id['id'];
		}
		
		$action = "quoted_on>0 AND service_request_id IN($in) order by id desc limit 5";//AND status=0
		$this->data['service_quotes'] = $this->General_model->get_data_all_like_using_where('service_quotes', $action);
		//$this->data['service_quotes'] = $this->General_model->get_data_all('service_quotes');
		$this->data['title']='Service Quotes';
		$this->data['view']='service_quotes';
		$this->load->view('template/main',$this->data);
	}
	
	public function single_request_quotes($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'single_request_quotes'));
		}
		$id=$this->encrypt_model->decode($id);
		$action = "service_request_id=".$id;//AND status=0
		$this->data['service_quotes'] = $this->General_model->get_data_all_like_using_where('service_quotes', $action);
		//$this->data['service_quotes'] = $this->General_model->get_data_all('service_quotes');
		$this->data['title']='Single Service Quotes';
		$this->data['view']='single_request_quotes';
		$this->load->view('template/main',$this->data);
	}
	public function change_sidebar_advertisement(){
		if(isSet($_POST['ad_id']))
		{
		
		
		$ad_id=$_POST['ad_id'];
		$ad_id=mysql_real_escape_string($ad_id);
		
		$action = "id<'$ad_id' AND condo_id = $this->condo_id AND payment_status=1  AND advert_type=3 AND  status=1  AND  is_resident_ad=1 ORDER BY `id` DESC  LIMIT 1";
		$adverts=$this->General_model->get_data_all_like_using_where('adverts', $action);
		if(sizeof($adverts)>0)
		{
			
		}
		else
		{
			$action = "condo_id = $this->condo_id AND payment_status=1  AND advert_type=3 AND  status=1  AND  is_resident_ad=1 ORDER BY `id` DESC  LIMIT 1";
			$adverts=$this->General_model->get_data_all_like_using_where('adverts', $action);
		}
		foreach($adverts as $advert)
		{
		?>
        <div class="right-post-img sidebar_resident_ads" sidebard="<?php echo $advert['id'];?>">
                <a target="_blank" href="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>">
                	<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>" />
                </a>
                <div class="overlay">
				<?php echo $advert['title']?><br /><small><?php echo substr($advert['description'],0,40)?></small>
                </div>
            </div>
		<?php
		}
		}
	
	}
	public function service_requests_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		
		
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$action = "id<'$lastmsg' AND requested_by=".$this->session->userdata('resident_id');//AND status=0
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		$action .= " order by id desc limit 2";
		
		$visitor_requests=$this->General_model->get_data_all_like_using_where('service_requests', $action);
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
        <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
           <td class="table-title font-blue">
              <a href="<?php echo base_url();?>single_request_quotes/<?php echo $this->encrypt_model->encode($report['id'])?>">
              <?php 
              echo $this->General_model->get_value_by_id('services', $report['service_id'], 'name');
              ?>
              </a>
          </td>
          <td class="table-desc"><?php echo $report['description']?></td>
          <td class="table-desc">
          <?php echo sizeof($this->General_model->get_data_all_like_using_where('service_quotes',"service_request_id=".$report['id']));?></td>
          <td class="table-desc"><?php echo $report['duration']?> days</td>
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="4" align="center" id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" class="more_services_requests">Show more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr>
        	<td colspan="4" align="center"  class="morebox">
				No more Services Requests
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function service_requests()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'service_requests'));
		}
		$action = "requested_by=".$this->session->userdata('resident_id');//AND status=0
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		$action .= " order by id desc";// limit 4
		$this->data['service_requests'] = $this->General_model->get_data_all_like_using_where('service_requests', $action);
		
		//services quotes
		$action = "";
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		$this_condo_service_requests=array();
		$in="0";
		$service_r_ids = $this->General_model->get_data_all_like_using_where('service_requests', "condo_id=$this->condo_id $action order by id desc");
		foreach($service_r_ids as $id)
		{
			array_push($this_condo_service_requests,$id['id']);
			$in.=",".$id['id'];
		}
		$action = "quoted_on>0 AND service_request_id IN($in) order by id desc";//AND status=0 limit 5
		$this->data['service_quotes'] = $this->General_model->get_data_all_like_using_where('service_quotes', $action);
		//services quotes
		
		$this->data['title']='Requests & Quotes - ALIA';
		$this->data['page_title']='Requests & Quotes';
		$this->data['view']='service_requests';
		$this->load->view('template/main',$this->data);
	}
	
	public function calculate_end_time(){
		$session_time 	 = $this->input->post('session_time');
		$starttime 		 = $this->input->post('starttime');
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
	public function service_providers()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'service_providers'));
		}
		
		
		$this->data['services_categories']=$this->General_model->get_data_all('services_categories','id','ASC', '9', '0');
		
		
		$this->data['title']='Service Providers - ALIA';
		$this->data['view']='service_providers';
		$this->load->view('template/main',$this->data);
	}
	
	public function service_providers_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$services_categories=$this->General_model->get_data_all_like_using_where('services_categories',"id>$lastmsg limit 3");
		$n=1;
		foreach($services_categories as $condo)
		{
			$msg_id=$condo['id'];
			?>
			<div class="col-md-4"> 
                <!-- Thumbnail -->
                <div class="thumbnail widget-thumbnail" style="height:250px; margin-bottom: 10px; text-align:center">
                  <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a href="<?php echo base_url();?>service_providers_list/<?php echo $this->encrypt_model->encode($condo['id']);?>"> <img src="<?php echo base_url();?>uploads/service_categories/<?php echo $condo['image_url'];?>" alt="<?php echo $condo['name'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                  <div class="caption" style="padding: 0px 0;">
                    <h5 > <a style="color:#000 !important; font-weight:bold !important" href="<?php echo base_url();?>service_providers_list/<?php echo $this->encrypt_model->encode($condo['id']);?>"> <?php echo $condo['name'];
									//$action = "id>0 AND id IN(SELECT vendor_id from vendor_services where service_id IN(SELECT id from services where category_id=".$condo['id'].")) ORDER BY id DESC";
									//echo ' ('.$this->General_model->get_data_all_like_using_where_count('vendors', $action).')';
									?> </a> </h5>
                  </div>
                </div>
                <!-- // Thumbnail END --> 
              </div>
			<?php
			$n++;
			}
			if(isset($msg_id)){?>
			<div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</div>
			
			<?php
			}else{
			?>
            <div class="morebox_services_requests search-item clearfix">
				<p> No more categories at the moment. </p>
			</div>
			
			<?php
			}
		}
	
	}
	
	public function service_providers_list($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'service_providers'));
		}
		$id=$this->encrypt_model->decode($id);	
		if(isset($_GET['page']) && $_GET['page']!='')
		{
			$per_page=($_GET['page']-1)*4;
		}
		else
		{
			$per_page=0;
		}
		
		if(isset($_GET['search']) && $_GET['search']!='')
		{
			$action = " name like '%".$_GET['search']."%' OR  `company_name` LIKE  '%".$_GET['search']."%' ";
			$this->data['vendors']=$this->General_model->get_data_all_like_using_where('vendors', $action." LIMIT $per_page,4");
			//count
			$vendors_count=$this->General_model->get_data_all_like_using_where_count('vendors',  $action);
		}
		else
		{
			$action = "id>0 AND id IN(SELECT vendor_id from vendor_services where service_id IN(SELECT id from services 
						where category_id =$id)) ORDER BY id DESC ";
			$this->data['vendors']=$this->General_model->get_data_all_like_using_where('vendors', $action." LIMIT $per_page,4");
			$vendors_count=$this->General_model->get_data_all_like_using_where_count('vendors', $action);
			//count
		}
		
		
		//Pagination Starts
		$this->load->library('pagination');
		$url = base_url().'service_providers_list/'.$this->encrypt_model->encode($id).'?pg=true';
		if(isset($_GET['search']) && $_GET['search']!='')
		{
			$url .= '&search='.$_GET['search'];
		}
		
		$config['base_url'] 		= $url;
		$config['total_rows'] 		= $vendors_count;
		$config['per_page'] 		= 4; 
		$config['query_string_segment'] = 'page';
		$config['page_query_string']= TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li class="prev">';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li class="next">';
		$config['last_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="page-active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$this->pagination->initialize($config); 
		$this->data['pagination'] 	= $this->pagination->create_links();
		
		
		
		//
		//$this->data['vendors'] = $this->General_model->get_data_all('vendors');
		//services quotes
		
		$this->data['title']=$this->General_model->get_value_by_id('services_categories', $id,'name'). ' Service Providers';
		$this->data['view']='service_providers_list';
		$this->load->view('template/main',$this->data);
	}
	
	public function vendor_list()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'vendor_list'));
		}
		$this->data['vendors'] = $this->General_model->get_data_all('vendors');
		
		//services quotes
		$action = "";
		if(isset($_POST['service']))
		{
			$action .= " AND service_id=".$_POST['service'];
		}
		
		$this->data['title']='Vendor List';
		$this->data['view']='vendor_list';
		$this->load->view('template/main',$this->data);
	}


	public function calender()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'calender'));
		}
		$facility_id = $this->input->post('faility_hidden_id');
		$action = "facility_id =$facility_id  order by datetime_booked desc ";//AND status=0
		//$action = "condo_id =$this->condo_id  order by datetime_booked desc ";//AND status=0
		$this->data['facility_booking'] = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		//$this->data['service_quotes'] = $this->General_model->get_data_all('service_quotes');
		$this->data['title']=$this->General_model->get_value_by_id('condo_facilities', $facility_id, 'name');;
		$this->data['view']='calender';
		$this->load->view('template/main',$this->data);
	}
	
	
	public function my_bookings()
	{
		if($this->session->userdata('resident_id')=="")
		{
			redirect(base_url().'?next='.urlencode(base_url().'my_bookings'));
		}
		if(!$this->check_module_settings($this->condo_id, 'facility')){
			redirect(base_url().'dashboard');
		}
					
		$action = "resident_id =".$this->session->userdata('resident_id')."  order by datetime_booked desc";
		//AND status=0
		$this->data['my_bookings'] = $this->General_model->get_data_all_like_using_where('facility_booking', $action);
		
		$this->data['title']='My Bookings';
		$this->data['view']='my_bookings';
		$this->load->view('template/main',$this->data);
	}
	
	public function facility_invoice($id)
	{
		if($this->session->userdata('resident_id')=="")
		{
			redirect(base_url().'?next='.urlencode(base_url().'facility_invoice'));
		}
		
		$id=$this->encrypt_model->decode($id);		
		$action = "booking_id ='$id'";//AND status=0
		$this->data['facility_invoice'] = $this->General_model->get_data_row_using_where('invoices', $action);
		
		$this->data['title']='Facility Invoice';
		$this->data['view']='facility_invoice';
		$this->load->view('template/main',$this->data);
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
					'condo_id'        => $row->condo_id,
					'name'   	      => $row->name
                    );
                 $this->session->set_userdata($data);
			}
			redirect('dashboard');  
		}
		
		$this->data['title']='Confirm Resident';
		$this->load->view('confirm_resident_change',$this->data);
	}
	public function dashboard()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'dashboard'));
		}
		if(isset($_POST['post_submit_btn']))
		{
			$post 				= $this->input->post('post');
			$images_ids 		= explode(',',$this->input->post('images_ids'));
			$DbFieldsArray	=	array('posted_by', 'is_resident_post', 'is_featured', 'description', 'condo_id', 'post_time');
			$DataArray		=	array($this->session->userdata('resident_id'), '1', '1', $post,$this->condo_id, date('Y-m-d H:i:s'));
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts');
			//Notification
			$DbFieldsArray_posts_noti	=	array('session_id', 'person_id', 'code', 'condo_id', 'insertDate', 
			'msg_time', 'read_noti');
			$DataArray_posts_noti		=	array($this->session->userdata('resident_id'), $this->session->userdata('resident_id'), 'New Post', $this->condo_id, date('Y-m-d H:i:s'), time(), '0');

			$this->General_model->addData_InsertID($DbFieldsArray_posts_noti, $DataArray_posts_noti ,'notifications');
			if(isset($_POST['images_names']))
			{
			  foreach($_POST['images_names'] as $image_name)
			  {
				  $DbFieldsArray 		= array('post_id');
				  $DataArray = array($id);
				  $get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
			  }
			}
			redirect('dashboard'); 
		}
		if(isset($_POST['post_edit_btn']))
		{
			$id				= $this->input->post('post_id');
			$post			= $this->input->post('post');
			$DbFieldsArray	=	array('posted_by', 'is_resident_post', 'is_featured', 'description', 'condo_id', 'edit_time');
			$DataArray		=	array($this->session->userdata('resident_id'), '1', '1', $post,$this->condo_id, date('Y-m-d H:i:s'));
			$this->General_model->updateData($id, 'id',$DbFieldsArray, $DataArray ,'posts');
			
			$images_array = "'0,0'";
			if(isset($_POST['images_names']))
			{
			  foreach($_POST['images_names'] as $image_name)
			  {
				  $images_array .= ",'".$image_name."'";
			  }
			}
			$this->General_model->deleteDataGeneral("post_id=$id AND image_url NOT IN($images_array)", 'posts_images' );
			if(isset($_POST['images_names']))
			{
			  foreach($_POST['images_names'] as $image_name)
			  {
				  $DbFieldsArray 		= array('post_id');
				  $DataArray = array($id);
				  $get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'posts_images' );
			  }
			}
			$this->session->set_userdata('edit_id', $id);
			redirect('dashboard'); 
		}
		$this->data['title']='Home - ALIA';		
		$this->data['view']='home';
		$action = "condo_id=$this->condo_id AND is_resident_post=1 ORDER BY id desc LIMIT 0,5";//AND status=0
		//$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts',"posted_by=".$this->session->userdata('resident_id')." AND status =1");
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);	
		$action2 = "condo_id=$this->condo_id AND is_resident_post=0 ORDER BY id desc";//AND status=0
		$this->data['manager_posts']=$this->General_model->get_data_all_like_using_where('posts', $action2);		
		$this->load->view('template/main',$this->data);
	}
	public function dashboar_more_posts_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		
		
		
		
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$action = "id<'$lastmsg' AND condo_id=$this->condo_id AND is_resident_post=1 ORDER BY id desc LIMIT 2";//AND status=0
		$posts=$this->General_model->get_data_all_like_using_where('posts', $action);	
		
		$n=1;
		foreach($posts as $post)
		{
		$msg_id=$post['id'];
		$post_id=$post['id'];
		
		$prof_pic = $this->General_model->get_value_by_id('residents',$this->resident_id,'image_url');
		if($prof_pic==''){$prof_pic=base_url().'assets/front/images/no-image.jpg';}
		else{$prof_pic=base_url().'uploads/profile_pictures/'.$prof_pic;}
		
		$post_prof_name = $this->General_model->get_value_by_id('residents',$post['posted_by'],'name');
        $post_prof_pic = $this->General_model->get_value_by_id('residents',$post['posted_by'],'image_url');
	    if($post_prof_pic==''){$post_prof_pic=base_url().'assets/front/images/no-image.jpg';}
	    else{$post_prof_pic=base_url().'uploads/profile_pictures/'.$post_prof_pic;}
        $post_comments = $this->db->query("SELECT * FROM posts_comments WHERE post_id='$post_id' ORDER BY  insertDate DESC ");
		?>
        <div class="post-box post_number_<?php echo $post_id;?>">
              <div class="profile-pic"> <img src="<?php echo $post_prof_pic;?>" 
                                  width="41" height="41"/> </div>
              <div class="pic-detail"> <b><?php echo $this->General_model->get_value_by_id('residents', $post['posted_by'], 'name')?></b> <br/>
                <?php 
				   if($post['edit_time']!="0000-00-00 00:00:00") {
					  echo $this->General_model->nicetime2($post['edit_time']);  
					  echo " - Edited "; 
				   }
				   else
				   {
					   echo $this->General_model->nicetime2($post['post_time']);  
				   }
				?>
              </div>
              <div class="actions pull-right">
                <div class="btn-group"> <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                  <ul class="dropdown-menu pull-right report_delete_actions">
                    <?php if( $post['posted_by']!=$this->session->userdata('resident_id')){?>
                    <li> <a title="Report" onclick="report_post('<?php echo $post_id;?>')"  data-toggle="modal"  href="#action_alert"> Report</a><!--href="javascript:;"--> 
                    </li>
                    <?php } ?>
                    <?php if( $post['posted_by']==$this->session->userdata('resident_id')){?>
                    <li class="divider"> </li>
                    <li> <a href="javascript:;"  onclick="edit_post('<?php echo $post_id;?>')" title="Edit">Edit</a> </li>
                    <li class="divider"> </li>
                    <li> <a onclick="delete_post_step1('<?php echo $post_id;?>')" title="Delete" href="#action_alert" data-toggle="modal">Delete</a> </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <p> <?php echo $post['description'];?> </p>
              <div class="post-images">
                <?php $posts_images=$this->General_model->get_data_all_using_where('post_id',$post['id'],'posts_images');
					  if(sizeof($posts_images)>0)
					  {
						  foreach($posts_images as $posts_image)
						  {
						  ?>
                          <a class="fancybox" rel="group_<?php echo $post['id'];?>" 
                          href="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>"> 
                                <img src="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>"  height="132"/> 
                          </a>
					<?php }
                    }?>
              </div>
              <div id="comments-section-<?php echo $post_id?>" class="posted-comments-sec">
                <?php
				$comment_count =1;
				foreach($post_comments->result_array() as $post_comment){
					if($comment_count>5)
					{
						break;
					}
						$post_prof_pic_comment = $this->General_model->get_value_by_id('residents',$post_comment['commented_by'],'image_url');
						if($post_prof_pic_comment==''){$post_prof_pic_comment=base_url().'assets/front/images/no-image.jpg';}
						else{$post_prof_pic_comment=base_url().'uploads/profile_pictures/'.$post_prof_pic_comment;}
						$commenter_name = $this->General_model->get_value_by_id('residents',$post_comment['commented_by'],'name');
				?>
                <div class="posted-comments-row">
                  <div class="small-post-image"> <img src="<?php echo $post_prof_pic_comment;?>"  width="31" height="31" > </div>
                  <div class="posted-comment">
                    <h3> <?php echo $commenter_name;?> : <span><?php echo $this->General_model->nicetime2($post_comment['insertDate']);?>.</span> </h3>
                    <p>
                      <?php $more = substr($post_comment['comment'],90,10000);
						if ($more!='')
						{
							$str =  '<a href="javascript:;" onclick="show_more_text('.$post_comment['id'].')"  
							class="show_more_anchor_'.$post_comment['id'].'"> see more </a>
							<span class="show_more_span_'.$post_comment['id'].'" style="display:none">'.$more.'</span>';
						  }
						  else
						  {
							  $str = '';
						  }
						?>
                      <?php echo substr($post_comment['comment'],0,90).$str;?> </p>
                  </div>
                </div>
                <?php         
				$comment_count++;
				}
				?>
              </div>
              <div id="comments-section" class="posted-comments-sec">
                <div class="posted-comments-row">
                  <div class="small-post-image"> <img width="31" height="31" src="<?php echo $prof_pic;?>" /> </div>
                  <div class="posted-comment">
                    <div class="other-post-comment">
                      <form action="<?php echo base_url();?>chatter/start_poll" method="post" class="formPostChat" id="<?php echo $post['id']?>">
                        <input type="hidden" value="<?php echo $this->resident_id?>" id="postUsername<?php echo $post['id']?>" />
                        <input type="hidden" value="<?php echo $post['id']?>" id="postID<?php echo $post['id']?>" />
                        <input type="hidden" value="<?php echo $this->condo_id?>" id="postCondoid" />
                        <input id="postText<?php echo $post['id']?>" name="" type="text" placeholder="Comment here..." />
                        <input type="submit" value="Post" class="post-post"/>
                        <span class="errorMessage" id="postError<?php echo $post['id']?>"></span>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(sizeof($post_comments->result_array())>4) {?>
              <div class="view-more-comments"> <a href="<?php echo base_url()?>view_all_comments/<?php echo $post['id']?>"> View All Comments <span>(<?php echo sizeof($post_comments->result_array())?>)</span> </a> </div>
              <?php }?>
            </div>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
        <div class="post-box morebox" id="more<?php echo $msg_id; ?>" style="text-align: center; cursor:pointer;">
              		<button type="button" class="btn btn-primary more" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id?>)">
                    	Load More
                    </button>
            		</div>
		<?php
		}else{
		?>
         <div class="post-box morebox" style="text-align: center;">
              		<button type="button" class="btn btn-primary more">
                    	No more posts
                    </button>
            		</div>
        <?php
		}
		}
	
	}
	
	public function dashboard_copy()
	{
		
		$this->data['title']='ALIA | Dashboard';
		$action = "condo_id=44 ";//AND status=0
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);		
		$this->data['view']='dashboard';
		$this->load->view('template/main',$this->data);
		//$this->load->view('home',$this->data);
	}
	
	public function jstree_ajax_data()
	{
		$parent = $_REQUEST["parent"];
		$data = array();
		$months = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
		$states = array(
			"success",
			"info",
			"danger",
			"warning"
		);
		if ($parent == "#") {
			for($i = 2015; $i < 2018; $i++) {
				$data[] = array(
					"id" => $i,  
					"text" => "" . $i, 
					"icon" => "fa fa-folder icon-lg icon-state-" . ($states[rand(0, 3)]),
					"children" => true, 
					"type" => "root"
				);
			}
		} elseif(strlen($parent) == 4) {
		  for($i = 1; $i < 13; $i++) {
			  $rows = $this->General_model->get_data_all_like_using_where("archived_posts", "date between '$parent-".( strlen($i) == 1 ? '0'.$i : $i)."-01 00:00:00' AND  '".date("Y-m-t", strtotime("$parent-".( strlen($i) == 1 ? '0'.$i : $i)."-01"))." 23:59:59' AND post_id IN(select id from posts where condo_id=$this->condo_id)");
			  if(sizeof($rows)>0)
			  { 
				$data[] = array(
					"id" => $parent.'-'.( strlen($i) == 1 ? '0'.$i : $i), 
					"icon" => ( rand(0, 3) == 2 ? "fa fa-file icon-lg" : "fa fa-folder icon-lg")." icon-state-" . ($states[rand(0, 3)]),
					"text" => "" . $months[$i], 
					"children" =>  true
				);
			  }
			  else
			  {
				  $data[] = array(
					"id" => $parent.'-'.( strlen($i) == 1 ? '0'.$i : $i), 
					"icon" => ( rand(0, 3) == 2 ? "fa fa-file icon-lg" : "fa fa-folder icon-lg")." icon-state-" . ($states[rand(0, 3)]),
					"text" => "" . $months[$i], 
					"children" =>  false
				  );
			  }
		  }
			
		}
		elseif(strlen($parent) > 4 && strlen($parent) < 8)
		{
			  $rows = $this->General_model->get_data_all_like_using_where("archived_posts", "date between '$parent-01 00:00:00' AND  '".date("Y-m-t", strtotime("$parent-01"))." 23:59:59' AND post_id IN(select id from posts where condo_id=$this->condo_id)");
			  if(sizeof($rows)>0)
			  { 
				  foreach($rows as $row)
				  {
					  $data[] = array(
						  "id" => "node_final_".$this->encrypt_model->encode($row['post_id']), 
						  "icon" => "fa fa-file fa-large icon-state-default final_node_icon ",
						  "text" => $this->General_model->get_value_by_id('posts', $row['post_id'], 'title'), 
						  "state" => array("disabled" => true),
						  "children" => false
					  );
				  }
			  }
			  else
			  {
				  $data[] = array(
					"id" => "node_" . time() . rand(1, 100000), 
					"icon" => "fa fa-file fa-large icon-state-default",
					"text" => "No childs ", 
					"state" => array("disabled" => true),
					"children" => false
				  );
			  }
			
		}
		else
		{
			  $data[] = array(
				"id" => "node_" . time() . rand(1, 100000), 
				"icon" => "fa fa-file fa-large icon-state-default",
				"text" => "No childs ", 
				"state" => array("disabled" => true),
				"children" => false
			  );
		}
		header('Content-type: text/json');
header('Content-type: application/json');
		echo json_encode($data);
	}
	
	public function post_comments()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'home/post_comments'));
		}
		if(isset($_POST['post_submit_btn']))
		{
			$post 				= $this->input->post('post');
			$images_ids 		= explode(',',$this->input->post('images_ids'));
				$data = array('posted_by'=>$this->session->userdata('resident_id'), 
								'is_resident_post'=>'1',
								'is_featured'=>'1',
								'description'=>$post,
								'condo_id'=>$this->condo_id
								);
				$DbFieldsArray	=	array('posted_by', 'is_resident_post', 'is_featured', 'description', 'condo_id');
				$DataArray		=	array($this->session->userdata('resident_id'), '1', '1', $post,$this->condo_id);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts');
				foreach($images_ids as $image_id)
				{
					$data = array('post_id'=>$id);
					$get_admin = $this->General_model->updateData_array($data, 'posts_images', $image_id);
				}
		    $this->session->set_flashdata('message', 'Post Added.');
			redirect('home/post_comments'); 
		}
		$this->data['title']='Post Comments';		
		$this->data['view']='post_comments';
		$this->data['posts']=$this->General_model->get_data_all_using_where('posted_by',$this->session->userdata('resident_id'),'posts');
		$this->load->view('template/main',$this->data);
	}
	
	public function comment_submit()
	{
		if(isset($_POST['comment']))
		{
			$comment 				= urlencode($this->input->post('comment'));
			$post_id 		= $this->input->post('post_id');
			$DbFieldsArray	=	array('comment', 'commented_by', 'post_id', 'msg_time', 'condo_id');
			$DataArray		=	array($comment, $this->session->userdata('resident_id'), $post_id, time(),$this->condo_id);
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts_comments');
			echo $id;
		}
	}
	public function close_account()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'close_account'));
		}
		
		if(isset($_POST['reason_submit_btn']))
		{
			$reason 				= $this->input->post('reason');
			
			//Send Email to condo Admin
				$action="condo_id='$this->condo_id' AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						//echo "success";exit;
						if($this->session->userdata('type')==1){ $tyype = "Tenant";} else { $tyype = "Owner";}
						$subject_admin = "Account Closing Request";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello ".$admin['full_name'].", <br />
						Following resident want to close his account. Please do check and approve. The details are as follows:<br />
						Name: ".$this->session->userdata('name')."<br />
						Email: ".$this->session->userdata('email')."<br />
						Type:".$tyype."<br />
						Reason of Closing:".$reason."<br />
						
						<a href='".base_url()."manager/close_account/".md5($this->session->userdata('email'))."'>Click here</a> to close his account. 
						<br /><br /></div>
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
						
					}
				}
			
		    $this->session->set_flashdata('message', 'Account Closing request sent.');
			redirect('dashboard'); 
		}
		$this->data['title']='Close Account';		
		$this->data['view']='close_account';
		$this->load->view('template/main',$this->data);
	}
	public function uploadify()
	{
		$targetFolder = '/uploads/post_images'; // Relative to the root
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = dirname(dirname(dirname(__FILE__))) . $targetFolder;
			//echo $targetPath;exit;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				//echo '1';
				$description = $this->General_model->get_data_value_using_where('posts',"posted_by=".$this->session->userdata('resident_id')." order by id DESC","description");
				$id = $this->General_model->get_data_value_using_where('posts',"posted_by=".$this->session->userdata('resident_id')." order by id DESC","id");
				if($description==='')
				{
					//echo "if".$id;
					$data = array('post_id'=>$id, 'image_url'=>$_FILES['Filedata']['name']);
					$this->General_model->addData_array($data ,'posts_images');
				}
				else
				{
					//echo "else".$id;
					//first post empty post
					$data = array('post_id'=>$id, 'image_url'=>$_FILES['Filedata']['name']);
					$DbFieldsArray =  array('posted_by','is_resident_post','is_featured','condo_id');
					$DataArray =  array($this->session->userdata('resident_id'), '1','1',$this->condo_id);
					$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts');
					
					//now post images in this post
					$data = array('post_id'=>$id, 'image_url'=>$_FILES['Filedata']['name']);
					$this->General_model->addData_array($data ,'posts_images');
				}
				echo $id;
				
			} else {
				echo 'Invalid file type.';
			}
		}
	}
	public function upload_home_post_images()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['file_upload']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['file_upload']['name']!= '' )
		{
			 $upload_path = "uploads/post_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('file_upload'))
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
				$posts[] = array('name'=>$image_url,'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
				//resize image if size much big
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
	public function uploadify_new()
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
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'posts_images');
				echo $original_filename;
				
				//resize image if size much big
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
				//resizeimage ends
			} 
			
		}
		else 
		{
			echo 'Invalid file type.';
		}
	}
	
	public function upload_advert_images()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['files']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['files']['name']!= '' )
		{
			 $upload_path = "uploads/advertisement_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('files'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'adverts_images');
				$image_url = $this->General_model->get_value_by_id('adverts_images', $id, 'image_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url,'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
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
				
				$size = 174;
				$config = $this->resize_image("uploads/advertisement_images/", $original_filename, $size, $size);
				$this->load->library('image_lib', $config); 
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
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
	
	public function upload_incidents()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['file_upload']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['file_upload']['name']!= '' )
		{
			 $upload_path = "uploads/incident_images/";
			 $file_type = "gif|jpg|jpeg|png|pdf";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('file_upload'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'incident_images');
				$image_url = $this->General_model->get_value_by_id('incident_images', $id, 'image_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url, 'extension'=>pathinfo($image_url, PATHINFO_EXTENSION),'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
				//resize image if size much big
				if(pathinfo($image_url, PATHINFO_EXTENSION)!='pdf')
				{
				  list($width, $height) = getimagesize("uploads/incident_images/".$original_filename);
				  if($width > "1000" || $height > "1000") 
				  {
					   $config = array('image_library'	=>'gd2',
									   'source_image'	=>'uploads/incident_images/'.$original_filename,
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
	
	public function upload_service_request()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['file_upload']['name'];
		$original_filename = '';
		//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
		if($_FILES['file_upload']['name']!= '' )
		{
			 $upload_path = "uploads/services_requests/";
			 $file_type = "gif|jpg|jpeg|png|pdf";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('file_upload'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'service_requests_images');
				$image_url = $this->General_model->get_value_by_id('service_requests_images', $id, 'image_url' );
				//echo $image_url;
				$posts = array();
				$posts[] = array('name'=>$image_url, 'extension'=>pathinfo($image_url, PATHINFO_EXTENSION),'valid_file'=>'yes');
				echo json_encode(array('files'=>$posts));
				if(pathinfo($image_url, PATHINFO_EXTENSION)!='pdf')
				{
				//resize image if size much big
				list($width, $height) = getimagesize("uploads/services_requests/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/services_requests/'.$original_filename,
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
	public function uploadify_service_request()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/services_requests/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'service_requests_images');
				echo $original_filename;
				
				//resize image if size much big
				list($width, $height) = getimagesize("uploads/services_requests/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/services_requests/'.$original_filename,
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
	
	
	public function uploadify_incidents()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = $_FILES['Filedata']['name'];
		$original_filename = '';
		if($_FILES['Filedata']['name']!= '')
		{
			 $upload_path = "uploads/incident_images/";
			 $file_type = "gif|jpg|jpeg|png";
			 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
			
			if($this->upload->do_upload('Filedata'))
			{
				$uploaddata = $this->upload->data();
				$result['filename'] = $uploaddata['file_name'];
				$original_filename = $result['filename'];
				$DbFieldsArray =  array('image_url');
				$DataArray =  array($original_filename);
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'incident_images');
				echo $original_filename;
				
				
				//resize image if size much big
				list($width, $height) = getimagesize("uploads/incident_images/".$original_filename);
				if($width > "1000" || $height > "1000") {
					 $config = array('image_library'=>'gd2',
									 'source_image'=>'uploads/incident_images/'.$original_filename,
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
	
	
	
	public function profile()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'profile'));
		}
		if(isset($_POST['resiprofsubmit']))
		{
			$id 				= $this->input->post('id');
			$name 				= $this->input->post('name');
			$email 				= $this->input->post('email');
			$phone 				= $this->input->post('phone');
			/*$type 				= $this->input->post('type');*/
			
			$DbFieldsArray 		= array('name','email','phone'/*,'type'*/);
			$DataArray = array($name,$email,$phone/*,$type*/);
			$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'residents');
			
		    $this->session->set_flashdata('message', 'Profile Updated.');
			redirect('profile'); 
		}
		$action = "id =".$this->session->userdata('resident_id');
		$this->data['resident_info']= $this->General_model->get_data_row_using_where('residents', $action);
		$this->data['title']='Profile - ALIA';	
		$this->data['page_title']='Profile';		
		$this->data['view']='profile';
		$this->load->view('template/main',$this->data);
	}
	
	public function vendor_profile($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'vendor_profile/'.$id));
		}
		
		$id=$this->encrypt_model->decode($id);
		$this->data['vendor_details']= $this->General_model->get_data_row_using_where('vendors',"id=$id");
		
		$this->data['vendor_com'] = $this->General_model->get_data_all_like_using_where('service_quotes',"feedback != '' AND quoted_by=$id");
		
		$this->data['title']='Vendor Profile';		
		$this->data['view']='vendor_profile';
		$this->load->view('template/main',$this->data);
	}
	public function profile_copy()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'profile'));
		}
		$this->data['title']='Profile';		
		$this->data['view']='profile_copy';
		$this->load->view('template/main',$this->data);
	}
	
	
	public function posts()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['title']='Post';		
		$this->data['view']='posts';
		$this->load->view('template/main',$this->data);
	}
	public function management_posts()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['managment_posts']= $this->General_model->get_data_all_like_using_where('posts',"is_resident_post=0 AND condo_id=$this->condo_id LIMIT 3");
		$this->data['title']='Noticeboard - ALIA';
		$this->data['page_title']='Noticeboard';		
		$this->data['view']='management_posts';
		$this->load->view('template/main',$this->data);
	}
	
	public function management_posts_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$manager_posts=$this->General_model->get_data_all_like_using_where('posts',"id>$lastmsg AND is_resident_post=0 AND condo_id=$this->condo_id LIMIT 3");
		$n=1;
		foreach($manager_posts as $manager_post)
		{
			$msg_id=$manager_post['id'];
			?>
			<li class="search-item clearfix">
              <div class="search-content">
                    <h3 class="search-title">
                       <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>">
					   <?php echo $manager_post['title'];?>
                       </a>
                    </h3>
                    <div class="blog-post-desc"> 
                    <?php echo substr($manager_post['description'],0,200)?> 
                    </div>
                </div>
            </li>
			<?php
			$n++;
			}
			if(isset($msg_id)){?>
			<li id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</li>
			
			<?php
			}else{
			?>
            <li class="morebox_services_requests search-item clearfix">
				<p> No more Management Posts at the moment. </p>
			</li>
			
			<?php
			}
		}
	
	}
	
	public function archived_posts()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$this->data['managment_posts']= $this->General_model->get_data_all_like_using_where('posts',"is_resident_post=0 AND condo_id=$this->condo_id");
		$this->data['title']='Noticeboard - ALIA';
		$this->data['page_title']='Archived Posts';		
		$this->data['view']='archived_posts';
		$this->load->view('template/main',$this->data);
	}
	public function single_management_post($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$id=$this->encrypt_model->decode($id);
		$post_condo_id= $this->General_model->get_value_by_id('posts',"$id","condo_id");
		$post_title= $this->General_model->get_value_by_id('posts',"$id","title");
		if($this->condo_id!=$post_condo_id){
			redirect(base_url()."management_posts");
		}
		$this->data['post_details']= $this->General_model->get_data_row_using_where('posts',"id=$id");
		$this->data['title']=$post_title;		
		$this->data['view']='single_management_post';
		$this->load->view('template/main',$this->data);
	}
	public function view_management_post($id)
	{
		$id=substr($id,6,10);
		$post_condo_id= $this->General_model->get_value_by_id('posts',"$id","condo_id");
		$post_title= $this->General_model->get_value_by_id('posts',"$id","title");
		if($this->condo_id!=$post_condo_id){
			redirect(base_url()."management_posts");
		}
		$this->data['post_details']= $this->General_model->get_data_row_using_where('posts',"id=$id");
		$this->data['title']=$post_title;		
		$this->data['view']='single_management_post';
		$this->load->view('template/main',$this->data);
	}
	public function single_advertisement($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$id=$this->encrypt_model->decode($id);
		$this->data['post_details']= $this->General_model->get_data_row_using_where('adverts',"id=$id");
		$this->data['title']='Advertisement';		
		$this->data['view']='single_advertisement';
		$this->load->view('template/main',$this->data);
	}
	public function view_all_comments($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		
		//$action = "post_id =".$id;
		$this->data['posts_comments']= $this->General_model->get_data_all_using_where('post_id',"$id",'posts_comments');
		$this->data['title']='View All Comments';		
		$this->data['view']='view_all_comments';
		$this->load->view('template/main',$this->data);
	}
	public function services_quotes_comments($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$action="service_qoute_id='$id' order by insertDate desc";
		$this->data['quotes_comments'] = $this->General_model->get_data_all_like_using_where('service_quotes_comments', $action);
		$service_quotes	= $this->General_model->get_data_row_using_where('service_quotes', "id='$id'");
		$service_id		= $this->General_model->get_value_by_id('service_requests', $service_quotes->service_request_id,'service_id');
		$service_name	= $this->General_model->get_value_by_id('services', $service_id,'name');
		$this->data['title']=$service_name;		
		$this->data['view']='services_quotes_comments';
		$this->load->view('template/main',$this->data);
	}
	public function services_quotes_details($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url());
		}
		$action="id='$id'";
		$this->data['quotes_details'] = $this->General_model->get_data_row_using_where('service_quotes', $action);
		$this->data['title']='Services Quotes Details';		
		$this->data['view']='services_quotes_details';
		$this->load->view('template/main',$this->data);
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
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'change_password'));
		}
		if(isset($_POST['changepasssub'])){
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('new_password');
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'residents');
			$this->session->set_flashdata('message', 'Password Changed.');
			redirect('profile'); 
		}
		$this->data['title']='Change Password';
		$action = "id = '$this->resident_id'";
		$this->data['resident_info']= $this->General_model->get_data_row_using_where('residents', $action);
		$this->data['view']='change_password';
		$this->load->view('template/main',$this->data);
	}
	public function check_office_timings()
	{
		$booking_id = $this->input->post('booking_id');
		$current_time =  date('Y-m-d H:i:s');
		if(date('l')=='Sunday')
		{
			$pre2pm = false;
		}
		elseif(date('l')=='Saturday')
		{
			if (date('H') < 12 && date('H') > 9) {
			   $pre2pm = true;
			}
			else
			{
				$pre2pm = false;
			}
		}
		else
		{
			if (date('H') < 17 && date('H') > 9) {
			   $pre2pm = true;
			}
			else
			{
				$pre2pm = false;
			}
		}
		if($pre2pm){ 
		//Addd Manual payment channel 
			$updateDbFieldsAry = array('payment_channel');
			$updateInfoAry = array('Manual Payment');
			$whereClouse = "booking_id='$booking_id'";
			
			$ver =$this->General_model->updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, 'invoices');
		
		echo "<div class='alert alert-info'>Please proceed to management office now to make payment in order to confirm your booking.</div>";}
		else{echo "<div class='alert alert-danger'>Manual Payments are only allowed for bookings during office hours<br> (Mon-Fri  9am to 5pm   and   Sat 9am to 12pm)</div>";}
	}
	public function pay_online_email()
	{
		$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "New Facility Booking Confirmed! ";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A resident has successfully made a facility booking in your residence. Please do check. The details are as follows: <br />
					".$this->General_model->get_value_by_id('condo_admins', $this->condo_id, "name")."<br />
					Amount Paid (RM): ".$_POST['amount']."<br />
					Booking Date: ".date('Y-m-d')."<br /><br />

					";
					
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					
					//Send Welcome Email
				}
			}
		
	}
	
		public function payment_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = " status=1 AND  payment_status=0 AND advert_by=".$this->session->userdata('resident_id')." AND id<'$lastmsg' order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('adverts', $action);
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
         <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
             <td class="table-title"><?php echo $report['title']?></td>
              <td class="table-title font-blue"><?php echo $report['ad_link']?></td>
              <td class="table-title"><img src="<?php echo base_url()."uploads/advertisement_images/".$report['image_url']?>"  width="100" height="100"/></td>
              <td class="table-title">
              <form method="POST">
                <input type="hidden" name="advert_id" value="<?php echo $report['id']?>" />
                <button type="submit" name="proced_to_payment" class="btn btn-primary">Proceed to Payment</button>
              </form>
              </td>
            
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="4" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr  style="background-color: #fbfcfd;">
        	<td colspan="4" align="center"  class="morebox">
				The End
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function payment(){
		if($this->session->userdata('resident_id')==""){
				redirect(base_url().'?next='.urlencode(base_url().'payment'));
		}
		/*if($this->session->userdata('adver_id')==""){
				redirect(base_url().'add_advertisement');
		}*/
		if(isset($_POST['proced_to_payment'])){
			$id 			= $this->input->post('advert_id');
			$DbFieldsArray 		= array('payment_status','payment_date_time',);
			$DataArray			= array('1', date('Y-m-d H:i:s'));
			$id = $this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'adverts');
			$this->session->set_flashdata('message', 'Payment Done');
			$data=array('adver_id'=>'');
			$this->session->set_userdata($data);
			redirect('add_advertisement'); 
			
		}
		$this->data['adverts'] = $this->General_model->get_data_all_like_using_where('adverts', " status=1 AND  payment_status=0 AND advert_by=".$this->session->userdata('resident_id')." order by id desc limit 3");
		
		$this->data['title']='Payment';
		$this->data['view']='payment';
		$this->load->view('template/main',$this->data);
	}
	public function facility_payment(){
		if($this->session->userdata('resident_id')==""){
				redirect(base_url().'?next='.urlencode(base_url().'facility_payment'));
		}
		if($this->session->userdata('facility_invoice_id')==""){
				redirect(base_url().'add_facility_booking');
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
		$this->data['title']='Facility Payment';
		$this->data['view']='facility_payment';
		$this->load->view('template/main',$this->data);
	}
	public function all_facility_payments(){
		if($this->session->userdata('resident_id')==""){
				redirect(base_url().'?next='.urlencode(base_url().'all_facility_payment'));
		}
		//as this function no more used so redrict to my_bookings
		redirect(base_url().'my_bookings');
		if(isset($_POST['proced_to_payment'])){
			$id 					= $this->input->post('invoice_id');
			$facility_booking_id 	= $this->input->post('facility_booking_id');
			$DbFieldsArray 			= array('datetime_paid','payment_channel','payment_status');
			$DataArray				= array( date('Y-m-d H:i:s'),'Payment Channel','1');
			$id 					= $this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'facility_invoice');
			$this->session->set_flashdata('message', 'Payment Done');
			$daata = array('invoice_id'=>'',
						   'facility_booking_id'=>'');
			$this->session->set_userdata($daata);
			//Send Email to condo Admin
			$invoice_details 		= $this->General_model->get_data_row_using_where('facility_invoice', "id=$id");
			$facility_booking_details = $this->General_model->get_data_row_using_where('facility_booking', "id=$facility_booking_id");
			
			$action					="condo_id='$this->condo_id' AND role='1'";
			$get_admin 				= $this->General_model->get_data_all_like_using_where('condo_admins', $action);
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
		$this->data['title']='Pending Payments';
		$this->data['view']='all_facility_payment';
		$this->load->view('template/main',$this->data);
	}
	public function users_management(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'users_management'));
		}
		if(isset($_POST['moved_date_btn'])){
			$resident_id 	= $this->input->post('resident_id');
			$moved_date 	= $this->input->post('moved_date');
			$DbFieldsArray 			= array('moved_date');
			$DataArray				= array( $moved_date);
			$id 					= $this->General_model->updateData($resident_id,'id',$DbFieldsArray,$DataArray,'residents');
			$this->session->set_flashdata('message', 'Resident Moved Date Added');
			redirect('users_management'); 
		}
		$res_inf = $this->General_model->get_data_row_using_where("residents","id=".$this->session->userdata('resident_id'));
        $this->data['residents']= $this->General_model->get_data_all_like_using_where('residents', " unit='".$res_inf->unit."' AND floor='".$res_inf->floor."' AND block='".$res_inf->block."' AND condo_id='".$res_inf->condo_id."' AND id !=".$res_inf->id." AND status =1");
		$this->data['title']	='Users Management';
		$this->data['view']		='users_management';
		$this->load->view('template/main',$this->data);
	}
	public function all_invitations(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'all_invitations'));
		}
		if(isset($_POST['edit_email_btn'])){
			$email 			= $this->input->post('email');
			$invite_id 		= $this->input->post('resident_invite_id');
			$prvious_email  = $this->General_model->get_value_by_id('residents_invitations', $invite_id, 'email');
			if($prvious_email!=$email)
			{
				$DbFieldsArray 	= array('email');
				$DataArray		= array( $email);
				$id 			= $this->General_model->updateData($invite_id,'id',$DbFieldsArray,$DataArray,'residents_invitations');
				
				//send email
				$action="id=".$this->session->userdata('resident_id')." ";
				$get_resident = $this->General_model->get_data_row_using_where('residents', $action);
				$block = $get_resident->block;
				$floor = $get_resident->floor;
				$unit = $get_resident->unit;
				$condo_id = $get_resident->condo_id;
				
				//Email
				$type = $this->General_model->get_value_by_id('residents_invitations', $invite_id, 'resi_type');
				$subject_admin = "Invitation for residence in condo";
				$message_admin = "<div style='".$this->config->item('style')."'>Hi, <br />
				I would like to invite you to join ALIA, our very own community platform. 
				<br />
				We can do almost everything online such as booking a facility, request for a service, communicate with our neighbours, pre-register our visitors,
				<br />
				pay and manage our condo expenses, all these for absolutely FREE. 
				<br />
				Link : <a href='".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")."' >Click here</a> to sign up
				<br />
				Or Copy below link into your browser
				<br />
				".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")."
				";
				$this->email($email, $email, $subject_admin, $message_admin);
				//Send Welcome Email
			//exit;
				$this->session->set_flashdata('message', '<div class="alert alert-info">Email updated</div>');
				redirect('all_invitations'); 
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Same email entered</div>');
				redirect('all_invitations'); 
			}
			
		}
		$res_inf = $this->General_model->get_data_row_using_where("residents","id=".$this->session->userdata('resident_id'));
		
		if(isset($_GET['page']) && $_GET['page']!='')
		{
			$per_page=($_GET['page']-1)*4;
		}
		else
		{
			$per_page=0;
		}
		
		$action = " sender_id=".$this->session->userdata('resident_id')." ORDER BY id DESC ";
		$this->data['invitations']=$this->General_model->get_data_all_like_using_where('residents_invitations', $action."");//LIMIT $per_page,4
		$invitations_count=$this->General_model->get_data_all_like_using_where_count('residents_invitations', $action);
		//count
		
		
		//Pagination Starts
		$this->load->library('pagination');
		$url = base_url().'all_invitations?pg=true';
		
		$config['base_url'] 		= $url;
		$config['total_rows'] 		= $invitations_count;
		$config['per_page'] 		= 4; 
		$config['query_string_segment'] = 'page';
		$config['page_query_string']= TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li class="prev">';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li class="next">';
		$config['last_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="page-active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$this->pagination->initialize($config); 
		$this->data['pagination'] 	= $this->pagination->create_links();
		
		
        $this->data['residents']= $this->General_model->get_data_all_like_using_where('residents_invitations', "sender_id=".$this->session->userdata('resident_id'));
		$this->data['title']	='All Invitations';
		$this->data['view']		='all_invitations';
		$this->load->view('template/main',$this->data);
	}
	
	public function add_resident_session()
	{
		$set_Data = array('link_condo_id'=>$this->input->post('link_condo_id'));
		$this->session->set_userdata($set_Data);
	}
	
	//////////////////////////////////////////////////////
	/********************CRON JOBS***********************/
	//////////////////////////////////////////////////////
	
	public function delete_expired_payments(){
		$nowtime = date('Y-m-d H:i:s',time() - 1800);
		//echo $nowtime;exit;
		
		
        $payments= $this->General_model->deleteDataGeneral("datetime_booked < '$nowtime' AND id IN(select booking_id from invoices where payment_status=0 AND payment_channel='')","facility_booking");
	}
	
	public function send_email_after_vendor_arival(){
        $quotes= $this->General_model->get_data_all_like_using_where("service_quotes","date(ven_arival_time)='".date('Y-m-d', strtotime("-1 days"))."'");
				//print_r($quotes);
				//echo date('Y-m-d', strtotime("-1 days"));
		if(sizeof($quotes))
		{
			foreach($quotes as $quote)
			{
				//This email goes to vendor
				$subject_admin = "Vendor arrival date is over";
				$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('vendors', $quote['quoted_by'],'name').", <br />
				Vendor arrival date is over. Please give feedback. The details are as follows:
				<br />
				For Feedback :<a href='".base_url()."vendor/service_feedback/".$this->encrypt_model->encode($quote['service_request_id'])."'>Click here</a><br>";
				$this->email($this->General_model->get_value_by_id('vendors', $quote['quoted_by'],'email'), $this->General_model->get_value_by_id('vendors', $quote['quoted_by'],'name'), $subject_admin, $message_admin);
				
				//This email goes to resident
				$request= $this->General_model->get_data_row_using_where("service_requests","id=".$quote['service_request_id']);
				$subject_admin = "Vendor arrival date is over";
				$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$this->General_model->get_value_by_id('residents', $request->requested_by,'name').", <br />
				Vendor arrival date is over. Please give feedback. The details are as follows:
				<br />
				For Feedback :<a href='".base_url()."service_feedback/".$this->encrypt_model->encode($quote['id'])."'>Click here</a><br>";
				$this->email($this->General_model->get_value_by_id('residents', $request->requested_by,'email'), $this->General_model->get_value_by_id('residents', $request->requested_by,'name'), $subject_admin, $message_admin);
			}
		}
	}
	
	public function change_status_on_moved_date(){
        $res= $this->General_model->get_data_all_like_using_where("residents","moved_date!='0000-00-00' AND moved_date='".date('Y-m-d')."'");
		
		if(sizeof($res))
		{
			foreach($res as $quote)
			{
				$DbFieldsArray 	= array('status');
				$DataArray		= array('0');
				$id 			= $this->General_model->updateData($quote['id'],'id',$DbFieldsArray,$DataArray,'residents');
			}
		}
	}
	
	public function service_feedback($qoute_id)
	{
		$this->data['title']='Service Feedback ';
		$this->data['view']='service_feedback';
		$this->load->view('template/main',$this->data);
	}
	
	public function add_rating()
	{
		if(!empty($_POST["rating"]) && !empty($_POST["id"])) {
			$DbFieldsArray	= array('feedback','rating');
			$DataArray		= array($_POST["feedback"], $_POST["rating"]);
			$this->General_model->updateData($_POST["id"], 'id', $DbFieldsArray, $DataArray, 'service_quotes' );
		}
	}
	public function manual_payment(){
		if($this->session->userdata('resident_id')==""){
				redirect(base_url().'?next='.urlencode(base_url().'facility_payment'));
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
						
						$DbFieldsArray 		= array('datetime_paid','payment_channel','manual_receipt');//,'payment_status' admin will approve
						$DataArray			= array( date('Y-m-d H:i:s'),'Manual Payment',$original_filename);//,'1'
						$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'facility_invoice');
						
						//resize image if size much big
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
						//resizeimage ends
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
			$invoice_details = $this->General_model->get_data_row_using_where('facility_invoice', "id=$id");
			$facility_booking_details = $this->General_model->get_data_row_using_where('facility_booking', "id=$facility_booking_id");
			
			$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "Manual Facility Payment Request";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A Manual Facility Payment Request has been booked under you condo. Please do check. The details are as follows:
					<br />
					Facility : ".$this->General_model->get_value_by_id('condo_facilities', $invoice_details->booking_id,'name')."<br>
					Description :".$invoice_details->description."<br>
					Amount Paid :".$invoice_details->amount_paid."<br>
					Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
					Booked To :".$facility_booking_details->bookedfor_datetime_to."<br>
					Reciept :".base_url()."uploads/facilities_images/".$original_filename."<br>
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
			$subject_admin = "Manual Facility Payment Request";
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
			redirect('add_facility_booking'); 
			
		}
		
		
		$this->data['title']='Manual Payment';
		$this->data['view']='manual_payment';
		$this->load->view('template/main',$this->data);
	}
	public function incident_reporting(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'incident_reporting'));
		}
		//
		$action = "condo_id=$this->condo_id ";//AND status=0
		$this->data['reports']=$this->General_model->get_data_all_like_using_where('incident_reporting', $action);
		//
		$this->data['title']='Incidents Reporting';
		$this->data['view']='incident_reporting';
		$this->load->view('template/main',$this->data);
	}
	public function visitor_delivery_request(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'visitor_delivery_request'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'visitors')){
			redirect(base_url().'dashboard');
		}
		
		//
		$action = "condo_id=$this->condo_id ";//AND status=0
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests', $action);
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where('visitor_requests', $action);
		//
		$this->data['title']='Visitor/Delivery Request';
		$this->data['view']='visitor_delivery_request';
		$this->load->view('template/main',$this->data);
		
	}
	public function visitor_request_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = "visitor_for=".$this->session->userdata('resident_id')." AND id<'$lastmsg' order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('visitor_requests', $action);
		$result=mysql_query("select * from programme where id<'$lastmsg' order by id desc limit 2");
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
        <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
            <td class="table-status"><?php echo $report['visitor_name'];?></td>
            <td class="table-status"><?php echo $report['vehicle_no'];?></td>
            <td class="table-date font-blue"><?php echo date("F m, Y h:i A", strtotime($report['visitdatetime']))?></td>
            <td  class="table-desc"><?php echo $report['visitor_reason']?></td>
            <td  class="table-title"><?php if($report['status']==0){ echo "Approved";}else{ echo "NotApproved";}?></td>
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="5" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr  style="background-color: #fbfcfd;">
        	<td colspan="5" align="center"  class="morebox">
				No more Visiter Requests
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function visitor_request(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'visitor_request'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'visitors')){
			redirect(base_url().'dashboard');
		}
		
		/*if(isset($_GET['page']) && $_GET['page']!='')
		{
			$per_page=($_GET['page']-1)*4;
		}
		else
		{
			$per_page=0;
		}*/
		$action = "visitor_for=".$this->session->userdata('resident_id')." ORDER BY id DESC ";//AND status=0 LIMIT $per_page,4
		$this->data['visitor_requests']=$this->General_model->get_data_all_like_using_where('visitor_requests', $action);
		
		//Pagination Starts
		/*$action = "visitor_for=".$this->session->userdata('resident_id')." ORDER BY id DESC ";
		$requests_count=$this->General_model->get_data_all_like_using_where_count('visitor_requests', $action);
		$this->load->library('pagination');
		$url = base_url().'visitor_request?pg=true';
		
		$config['base_url'] 		= $url;
		$config['total_rows'] 		= $requests_count;
		$config['per_page'] 		= 4; 
		$config['query_string_segment'] = 'page';
		$config['page_query_string']= TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li class="prev">';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li class="next">';
		$config['last_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$this->pagination->initialize($config); 
		$this->data['pagination'] 	= $this->pagination->create_links();*/
		//
		$this->data['title']='Visitors - ALIA';
		$this->data['page_title']='Visitors';		
		$this->data['view']='visitor_request';
		$this->load->view('template/main',$this->data);
		
	}
	public function all_incidents_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = "condo_id=$this->condo_id AND id<'$lastmsg' order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('incident_reporting', $action);
		$result=mysql_query("select * from programme where id<'$lastmsg' order by id desc limit 2");
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
        <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
              <td class="table-title">
					  <?php echo $report['description'];?>
                  </td>
                  <td  class="table-title" >
                      <?php
                      if($report['reported_date'] != '0000-00-00 00:00:00'){
                          echo date('d F Y, h:i A',strtotime($report['reported_date']));
                      } else {
                          echo 'N/A';
                      }
                      
                       ?>
                  </td>
                  <td  class="table-title" >
                      <?php 
                      if($report['resolved_date'] != '0000-00-00 00:00:00'){
                          echo date('d F Y, h:i A',strtotime($report['resolved_date']));
                      } else {
                          echo 'N/A';
                      }
                      ?>
                  </td>
                  <td  class="table-title" >
                      <?php echo $report['incident_log'];?>
                  </td>
                  <td  class="table-title">
                  <?php
                  $img = $this->General_model->get_data_rowusingwhere_empty_array('incident_images',"incident_id=".$report['id']);
                  if(sizeof($img)>0)
                  {$src=base_url()."uploads/incident_images/".$img->image_url;}
                  else{$src=base_url()."assets/front/global/img/no-image-box.png";}
                  ?>
                      <a href="<?php echo $src;?>">Click Here</a>
                  </td>
                  <td  class="table-title" >
                      <?php if($report['status'] == 1){
                          echo 'Resolved';
                      } else {
                          echo 'Not Resolved';
                      }?>
                  </td>
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="6" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr  style="background-color: #fbfcfd;">
        	<td colspan="6" align="center"  class="morebox">
				No more Incidents
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function all_incidents(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'all_incidents'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'incident')){
			redirect(base_url().'dashboard');
		}
		
		//
		$action = "condo_id=$this->condo_id ORDER BY id DESC";//AND status=0 LIMIT 5
		$this->data['all_incidents']=$this->General_model->get_data_all_like_using_where('incident_reporting', $action);
		//$this->data['all_incidents']=array();
		//
		$this->data['title']='Reported Incidents';
		$this->data['view']='all_incidents';
		$this->load->view('template/main',$this->data);
	}
	public function delivery_request_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		$action = "delivery_for=".$this->session->userdata('resident_id')." AND id<'$lastmsg' order by id desc limit 2";//AND status=0
		$visitor_requests=$this->General_model->get_data_all_like_using_where('delivery_requests', $action);
		$n=1;
		foreach($visitor_requests as $report)
		{
		$msg_id=$report['id'];
		?>
        <tr class="gradeX" <?php if($n==2){?>style="background-color: #fbfcfd;"<?php }?>>
              <td  class="table-title" >
                  <?php echo $report['company_name'];?>
              </td>
              <td  class="table-title" >
                  <?php echo $this->General_model->get_value_by_id('residents',$report['delivery_for'],'name');?>
              </td>
              <td class="table-desc">
                  <?php echo $report['description'];?>
              </td>
              <td  class="table-title">
                  <?php if($report['status']==0){ echo "Approved";}else{ echo "NotApproved";}?>
              </td>
        </tr>
		<?php
		$n++;
		}
		?>
		
		<?php if(isset($msg_id)){?>
		<tr>
        	<td colspan="4" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">more</a>
            </td>
		</tr>
		<?php
		}else{
		?>
        <tr style="background-color: #fbfcfd;">
        	<td colspan="4" align="center" class="morebox">
				No more Delivery Requests
            </td>
		</tr>
        <?php
		}
		}
	
	}
	public function delivery_request(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'delivery_request'));
		}
		//
		$action = "delivery_for=".$this->session->userdata('resident_id')." ORDER BY id DESC LIMIT 5";//AND status=0
		$this->data['delivery_requests']=$this->General_model->get_data_all_like_using_where('delivery_requests', $action);
		//
		$this->data['title']='Deliveries - ALIA';
		$this->data['page_title']='Deliveries';		
		$this->data['view']='delivery_request';
		$this->load->view('template/main',$this->data);
		
	}
	public function incidents()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'incidents'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'incident')){
			redirect(base_url().'dashboard');
		}
		
		if(isset($_POST['incidentreportingsub'])){
			$incident_report 	= $this->input->post('incident_report');
			$incident_category 	= $this->input->post('incident_category');
			$images_ids 		= explode(',',$this->input->post('images_ids'));
			$DbFieldsArray 		= array('reported_by', 'description', 'condo_id', 'incident_category','reported_date');
			$DataArray = array($this->session->userdata('resident_id'), $incident_report, $this->condo_id, $incident_category, date('Y-m-d H:i:s'));
				$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'incident_reporting');
				/*foreach($images_ids as $image_id)
				{
					
					$data = array('incident_id'=>$id);
					$get_admin = $this->General_model->updateData_array($data, 'incident_images', $image_id);
				}*/
			if(isset($_POST['images_names'])){
				foreach($_POST['images_names'] as $image_name)
				{
					$DbFieldsArray 		= array('incident_id');
					$DataArray 			= array($id);
					$get_admin = $this->General_model->updateData($image_name, 'image_url', $DbFieldsArray, $DataArray, 'incident_images' );
				}
			}
			
			
			//Send Email to condo Admin
				$action="condo_id='$this->condo_id' AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						$subject_admin = "Incident Reported";
						$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
						A new Incident has been reported under you condo. Please do check. The details are as follows:
						<br />
						Category : ".$this->General_model->get_value_by_id('incident_categories', $this->input->post('incident_category'),'name')."<br>
						Description :".$this->input->post('incident_report')."
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
			
			$this->session->set_flashdata('message', '<div class="alert alert-info">Your management has been informed of this incident and they will carry out the necessary actions to resolve this issue.</div>');
			redirect('all_incidents'); 
		}
		$this->data['title']='Report A Case - ALIA';
		$this->data['page_title']='Report A Case';
		$this->data['incident_categories']= $this->General_model->get_data_all_like_using_where('incident_categories',"condo_id=$this->condo_id ORDER BY name ASC");
		$this->data['view']='incidents';
		$this->load->view('template/main',$this->data);
	}
	public function invite_users()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'invite_users'));
		}
		if(isset($_POST['send_email_btn'])){
			$invite_message 	= $this->input->post('invite_message');
			
			//Send Email to condo Admin
				$action="id=".$this->session->userdata('resident_id')." ";
				$get_resident = $this->General_model->get_data_row_using_where('residents', $action);
				$block = $get_resident->block;
				$floor = $get_resident->floor;
				$unit = $get_resident->unit;
				$condo_id = $get_resident->condo_id;
					foreach($_POST['email'] as $key=>$email)
					{
						$type = $_POST['type'][$key];
						//echo "$key=$email<br>";echo $type."<br><br><br><br>";
						$subject_admin = "Invitation for residence in condo";
						$message_admin = "<div style='".$this->config->item('style')."'>Hi, <br />
						I would like to invite you to join ALIA, our very own community platform. 
						<br />
						We can do almost everything online such as booking a facility, request for a service, communicate with our neighbours, pre-register our visitors,
						<br />
						pay and manage our condo expenses, all these for absolutely FREE. 
						<br />
						Link : <a href='".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")."' >Click here</a> to sign up
						<br />
						Or Copy below link into your browser
						<br />
						".base_url()."signup?email=".$this->encrypt_model->encode("$email,$block,$floor,$unit,$condo_id,$type")."
						";
						$this->email($email, $email, $subject_admin, $message_admin);
						//Send Welcome Email
						
						//save in db
						$DbFieldsArray 		= array('sender_id', 'email', 'condo_id', 'block', 'floor', 'unit', 'resi_type');
						$DataArray = array($this->session->userdata('resident_id'), $email,$condo_id,$block,$floor,$unit,$type );
						$this->General_model->addData($DbFieldsArray,$DataArray,'residents_invitations');
					}
					//exit;
			
			$this->session->set_flashdata('message', 'Email Sent.');
			redirect('dashboard'); 
		}
		$this->data['title']='Invite Users';
		$this->data['view']='invite_users';
		$this->load->view('template/main',$this->data);
	}
	
	
	
	//Check Email existance
	public function add_visitor()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_visitor'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'visitors')){
			redirect(base_url().'dashboard');
		}
		
		if(isset($_POST['addvisitersubmit'])){
			$description 	= $this->input->post('description');
			$vehicle_no 	= $this->input->post('vehicle_no');
			$visitor_name 	= $this->input->post('visitor_name');
			$date 			= $this->input->post('date');
			$time 			= $this->delivery_time_format($this->input->post('time'));
			$visitor_names = explode(',',$_POST['visitor_name']);
			$visitor_names_size = sizeof($visitor_names);
			if($visitor_names_size>1)
			{
				$vehicle_nos = explode(',',$_POST['vehicle_no']);
				$vihicle_nos_size = sizeof($vehicle_nos);
				if($vihicle_nos_size!=$visitor_names_size)
				{
					$this->session->set_flashdata('message', '<strong>Error!</strong> Comma seperated Vihicle Nos. should be of the same size of Comma seperated visiters number.');
					redirect('add_visitor'); 
				}
				else
				{		
					for($i=0; $i<$visitor_names_size; $i++)
					{			
						//$data[$visitor_names[$i]] = $vehicle_nos[$i];
						$DbFieldsArray 		= array('visitor_name', 'visitor_for', 'visitor_reason', 'vehicle_no', 'condo_id', 'visitdatetime');
						$DataArray 			= array($visitor_names[$i], $this->session->userdata('resident_id'), $description, $vehicle_nos[$i], $this->condo_id, "$date $time");
						$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'visitor_requests');	
					}
				}
			}
			else
			{
			$DbFieldsArray 		= array('visitor_name', 'visitor_for', 'visitor_reason', 'vehicle_no', 'condo_id', 'visitdatetime');
			$DataArray = array($visitor_name, $this->session->userdata('resident_id'), $description, $vehicle_no, $this->condo_id, "$date $time");
			$id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'visitor_requests');
			}
			
			$this->session->set_flashdata('message', 'Visitor registered.');
			redirect('visitor_request'); 
		}
		$this->data['title']='Visitor Registration - ALIA';
		$this->data['page_title']='Visitor Registration';
		$this->data['view']='add_visitor';
		$this->load->view('template/main',$this->data);
	}
	public function add_delivery()
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'add_delivery'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'visitors')){
			redirect(base_url().'dashboard');
		}
		
		if(isset($_POST['adddeliverysubmit'])){
			
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = $_FILES['file_upload']['name'];
			$original_filename = '';
			//&&  strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION))!='pdf'
			if($_FILES['file_upload']['name']!= '' )
			{
				 $upload_path = "uploads/post_images/";
				 $file_type = "gif|jpg|jpeg|png";
				 $this->upload->initialize($this->set_upload_options($upload_path, $file_type));
				
				if($this->upload->do_upload('file_upload'))
				{
					$uploaddata = $this->upload->data();
					$result['filename'] = $uploaddata['file_name'];
					$original_filename = $result['filename'];
					//resize image if size much big
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
					//resizeimage ends
				} 
				else
				{
					echo "invalid file";
				}
			}
			else 
			{
				echo "no file";
			}
			
			$description 	= $this->input->post('description');
			$company_name 	= $this->input->post('company_name');
			$date 			= $this->input->post('date');
			$time 			= $this->delivery_time_format($this->input->post('time'));
			$DbFieldsArray 	= array('reciept','delivery_for', 'description', 'condo_id', 'deliverydatetime','company_name');
			$DataArray 		= array($original_filename, $this->session->userdata('resident_id'), $description, $this->condo_id, "$date $time",$company_name);
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
						Delivery date:".$this->input->post('date')."<br />
						Delivery time: ".$this->input->post('time')."
						<br /><br /></div>
						";
						//Send Welcome Email
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					}
				}
			$this->session->set_flashdata('message', 'Delivery Record Saved.');
			redirect('delivery_request'); 
		}
		$this->data['title']='Register Delivery';
		$this->data['view']='add_delivery';
		$this->load->view('template/main',$this->data);
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
	
	public function check_primary_owner_exists(){
		if($_POST['type']==11)
		{
			$rows = $this->General_model->get_data_all_like_using_where("residents","type='".$_POST['type']."' AND block='".$_POST['block']."' AND floor='".$_POST['floors']."' AND unit='".$_POST['unit']."' AND condo_id='".$_POST['condo_id']."'" );
			if ( sizeof($rows)>0 ) {
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
	
	public function check_primary_owner_signup(){
		$rows = $this->General_model->get_data_all_like_using_where("residents","type='11' AND block='".$_POST['block']."' AND floor='".$_POST['floors']."' AND unit='".$_POST['unit']."' AND condo_id='".$_POST['condo_id']."'" );
		if ( sizeof($rows)>0 ) {
			echo json_encode(FALSE);
		} else {
			echo json_encode(TRUE);
		}
	}
	
	//Check Email existance
	public function check_time_range($table){
		$admin_id=0;
		$action="condo_id=$this->condo_id AND role='1'";
		$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
		if($get_admin >0)
		{
			foreach($get_admin as $admin)
			{
				$admin_id 			  = $admin['id'];
				$sunrise = $admin['delivery_time_starts'];
				$sunset   = $admin['delivery_time_ends'];
			}
		}
				
				
		$current_time = $this->input->post('time');
		$date1 = date('Hi', strtotime($current_time));
		$date2 = date('Hi', strtotime($sunrise));
		$date3 = date('Hi', strtotime($sunset));
		if ($date1 > $date2 && $date1 < $date3)
		{
		   echo json_encode(TRUE);
		}
		else 
		{
			echo json_encode(FALSE);
		}
	}
	public function check_unit_advance_booking_limit()
	{
		//calculate wheather this resident have not crossed its limits
		$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=".$this->input->post('facility_id'));
		$action="condo_id='$this->condo_id' AND facility_id=".$this->input->post('facility_id')." AND (datetime_booked between'".date('Y-m-d', strtotime("-".$facility_details->limit_days." days"))." 00:00:00' AND '".date('Y-m-d')." 23:59:59') AND resident_id IN( select id from residents where unit=".$this->General_model->get_value_by_id("residents", $this->session->userdata('resident_id'), 'unit').")";
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
		//now check current value
		if(isset($_POST['day_slot_id']))
		{
			$day_slots = $this->General_model->get_data_row_using_where('day_slots', "can_book=1 and id=".$_POST['day_slot_id']);
			$bt_hours = substr($day_slots->end_time,0,2)-substr($day_slots->start_time,0,2);
			$booked_hours+=$bt_hours;
		}
		$booking_limit = $facility_details->booking_limit;
		
		
		if($booked_hours>$booking_limit)
		{
			echo json_encode("<label for='day_slot_val_append' class='error'>You Exceed Booking hours limit for your unit.</label> ");exit;//."booked_hours=$booked_hours AND booking_limit=$booking_limit"
		}
		else 
		{
			echo json_encode(TRUE);//"$usertimediffernce  $facilitytimediffernce"
		}
	}
	
	public function show_date_bookings_ajax()
	{
		//calculate wheather this resident have not crossed its limits
		$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=".$this->input->post('facility_id'));
		$action="condo_id='$this->condo_id' AND facility_id=".$this->input->post('facility_id')." AND (datetime_booked between'".date('Y-m-d', strtotime("-".$facility_details->limit_days." days"))." 00:00:00' AND '".date('Y-m-d')." 23:59:59') AND resident_id IN( select id from residents where unit=".$this->General_model->get_value_by_id("residents", $this->session->userdata('resident_id'), 'unit').")";
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
		$day_slots = $this->General_model->get_data_all_using_Multiwhere("can_book=1 and facility_id=".$facility_id, 'day_slots');
		$day_slot_value='';
		
		$today_date = date('Y-m-d');
		$days_difference = abs(strtotime($today_date)-strtotime($_POST['date']))/86400;
		
		
		
		
		/*if($booked_hours>$booking_limit)
		{
			echo json_encode(array('day_slot_value'=>"<label for='day_slot_val_append' class='error'>You Exceed Booking hours limit for your unit.</label> "));exit;//."booked_hours=$booked_hours AND booking_limit=$booking_limit"
		}
		else*/if($facility_details->is_day_rang_settings==1 && $facility_details->is_day_rang_settings_max<$days_difference)
		{
			echo json_encode(array('day_slot_value'=>" You Exceed Advance Booking limit for this facility.Maximum ".$facility_details->is_day_rang_settings_max." days. Current slection is ".$days_difference." days"));exit;
		}
		elseif($facility_details->is_day_rang_settings==1 && $facility_details->is_day_rang_settings_min>$days_difference)
		{
			echo json_encode(array('day_slot_value'=>" You Can't book this facility.Minimum ".$facility_details->is_day_rang_settings_min." days advance booking is required. Current slection is ".$days_difference." days"));exit;
		}
		elseif(sizeof($day_slots)>0){
			$icount = 1;
			foreach($day_slots as $day_slot){
				$day_slot_id = $day_slot['id'];
				$check_slot_match = $this->General_model->get_data_all_using_Multiwhere("date(bookedfor_datetime_from)='$date' and facility_id =$facility_id and slot_id=".$day_slot_id, 'facility_booking');
				$day_slot_value.='
				 
               		<div class="col-md-3" style="margin-bottom:20px;">';
					if(sizeof($check_slot_match)>0){
                  $day_slot_value.='<a href="javascript:;" class="btn default disabled">'.date('H:i',strtotime($day_slot['start_time'])).
				' - '.date('H:i',strtotime($day_slot['end_time'])).'</a>';
					} else {
						$day_slot_value.='<button type="button" onclick="get_slot_value('.$day_slot['id'].')" class="btn blue btn-outline">'.date('H:i',strtotime($day_slot['start_time'])).
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
	
	//Check time existance
	public function check_timerange_availability(){
		$condo_facility 	= $this->input->post('condo_facility');
		$unit 				= $this->input->post('unit');
		$startdate 			= $this->input->post('startdate');
		$starttime 			= $this->input->post('starttime');
		$enddate 			= $this->input->post('startdate');//enddate
		$endtime 			= $this->input->post('endtime');
		
		
		$facility_details = $this->General_model->get_data_row_using_where('condo_facilities', "id=$condo_facility ");
		
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
			$start_hour='00';
		}
		$start_minut =explode(':',$starttime_space[0]); 
		$start_minut =$start_minut[1];
		
		
		$end_hour = date('H',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
		$end_minut = date('i',strtotime("$start_hour:$start_minut:00" . "+".$facility_details->session_time." minutes"));
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
		$usertimediffernce = round(abs(strtotime("$end_hour:$end_minut:00")-strtotime("$start_hour:$start_minut:00")) / 3600,2);
		//no of days between today and date selected
		$today_date = date('Y-m-d');
		$days_difference = abs(strtotime($today_date)-strtotime("$startdate"))/86400;
		//facility number of minuts between start and end time
		$facilitytimediffernce = $facility_details->session_time;
		//check
		if($end < $str )
		{
			echo json_encode("Invalid Date.");//"Start date = ".date("M d Y, h:i A", strtotime("$startdate $start_hour:$start_minut:00")). " End date=".date("M d Y, h:i A", strtotime("$enddate $end_hour:$end_minut:00"))
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
			echo json_encode(" You Exceed Booking Session time of $facilitytimediffernce hours.");
		}
		elseif($booked_hours>$booking_limit)
		{
			echo json_encode(" You Exceed Booking hours limit for your unit.");
		}
		elseif($facility_details->is_day_rang_settings==1 && $facility_details->is_day_rang_settings_max<$days_difference)
		{
			echo json_encode(" You Exceed Advance Booking limit for this facility.Maximum ".$facility_details->is_day_rang_settings_max." days. Current slection is ".$days_difference." days");
		}
		elseif($facility_details->is_day_rang_settings==1 && $facility_details->is_day_rang_settings_min>$days_difference)
		{
			echo json_encode(" You should book a date which is ".$facility_details->is_day_rang_settings_min." days in advance. Current slection is ".$days_difference." days in advance.");
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
	public function check_time_formate(){
		$time_colon = explode(':',$this->input->post('time'));
		$time_space = explode(' ',$this->input->post('time'));
		$time_minut = explode(' ',$time_colon[1]);
		$timearray = array('AM','PM');
		if ($time_colon[0] > 12 || !in_array($time_space[1],$timearray) || $time_minut[0]>59)
		{
		   echo json_encode(FALSE);
		}
		else 
		{
			echo json_encode(TRUE);
		}
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
				$verification_link = base_url()."home/forgot_password_change/".$verification_code_id."/".$verification_code_email;
				
				//Collect Email Data
				$subject = "Reset Password Link";
				$message = "Dear ".$condo_alpha_name_admins." (Demo), <br />
				You have requested to reset your password.<br/><br/>

				Click on the link below to change your password.<br/>
				".$verification_link."<br/><br/>";

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
		
		if(isset($_POST['forgotpasssubbutton']))
		{
			$id 				= $this->input->post('id');
			$new_password 		= $this->input->post('password');
			
			$DbFieldsArray 		= array('password');
			$DataArray = array(md5($new_password));
			$this->General_model->updateData($id,'id',$DbFieldsArray,$DataArray,'residents');
		
				 $this->db->where('id',$id);	
				 $query=$this->db->get('residents');
				 $row = $query->row();
				 $data = array(
					'resident_id'     => $row->id,
					'email'           => $row->email,
					'type'            => $row->type,
					'condo_id'        => $row->condo_id,
					'name'   	      => $row->name
                    );
                 $this->session->set_userdata($data);
			redirect('dashboard'); 
		}
		//$this->data['view']='forgot_password_change';
		
		$this->data['title']='Forgot Password Change';
		$this->load->view('forgot_password_change',$this->data);
	}
	
	
	public function thank_you(){
		$this->data['title']='Thank You';		
		$this->load->view('thank_you',$this->data);
	}
	
	public function cc(){
		$this->data['title']='ALIA | Dashboard';		
		$this->data['view']='msg_top';
		$action = "condo_id=44 ";//AND status=0
		//$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts',"posted_by=".$this->session->userdata('resident_id')." AND status =1");
		$this->data['posts']=$this->General_model->get_data_all_like_using_where('posts', $action);		
		$this->load->view('template/main',$this->data);
	}
	
	public function useful_contacts(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'useful_contacts'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'useful_links')){
			redirect(base_url().'dashboard');
		}

		$this->data['title']='Useful Contacts - ALIA';
		$this->data['page_title']='Useful Contacts';				
		$this->data['view']='useful_contacts';
		$this->data['useful_contacts']=$this->General_model->get_data_all_like_using_where('useful_contacts',"condo_id=".$this->session->userdata('condo_id')." AND status = 1 LIMIT 3");
		$this->load->view('template/main',$this->data);
	}
	public function useful_contacts_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$useful_contacts=$this->General_model->get_data_all_like_using_where('useful_contacts',"id>$lastmsg AND condo_id=".$this->session->userdata('condo_id')." AND status = 1 LIMIT 3");
		$n=1;
		foreach($useful_contacts as $useful_contact)
		{
			$msg_id=$useful_contact['id'];
			?>
			<div class="col-md-6">
							
							<div class="portlet yellow-crusta box">
								<div class="portlet-title">
									<div class="caption">
										<!--<i class="fa fa-book"></i>--><?php echo $useful_contact['name'];?> </div>
									
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:280px" data-rail-visible="1" data-rail-color="#16A246" data-handle-color="#16A246">
									
									 <?php if($useful_contact['address']!=''){?>
										<div class="row static-info">
											<div class="col-md-2 name"> <i class="fa fa-street-view"></i> </div>
											<div class="col-md-10 value"> <?php echo $useful_contact['address'];?></div>
										</div>
									<?php } ?>
									
									<?php if($useful_contact['phone']!=''){?>
										<div class="row static-info">
											<div class="col-md-2 name"> <i class="fa fa-phone"></i> </div>
											<div class="col-md-10 value"> <?php echo $useful_contact['phone'];?></div>
										</div>
									<?php } ?>
									
									<?php if($useful_contact['mobile']!=''){?>
										<div class="row static-info">
											<div class="col-md-2 name"> <i class="fa fa-mobile"></i> </div>
											<div class="col-md-10 value"> <?php echo $useful_contact['mobile'];?></div>
										</div>
									<?php } ?>
		  
									<?php if($useful_contact['email']!=''){?>
										<div class="row static-info">
											<div class="col-md-2 name"> <i class="fa fa-envelope"></i> </div>
											<div class="col-md-10 value"> <?php echo $useful_contact['email'];?></div>
										</div>
									<?php } ?>
									
									<?php if($useful_contact['website']!=''){?>
										<div class="row static-info">
											<div class="col-md-2 name"> <i class="fa fa-laptop"></i> </div>
											<div class="col-md-10 value"> <?php echo $useful_contact['website'];?></div>
										</div>
									<?php } ?>
		  
								   
									
									</div>
								</div>
							
						</div>
		  </div>
			<?php
			$n++;
			}
			if(isset($msg_id)){?>
			<div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests ">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</div>
			
			<?php
			}else{
			?>
            <div class="morebox_services_requests ">
				<p> No more useful contacts at the moment. </p>
			</div>
			
			<?php
			}
		}
	
	}
	public function download_forms(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'download_forms'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'useful_links')){
			redirect(base_url().'dashboard');
		}

		$this->data['title']='Forms & Downloads - ALIA';
		$this->data['page_title']='Forms & Downloads';				
		$this->data['view']='download_forms';
		$this->data['download_forms']=$this->General_model->get_data_all_like_using_where('knowledge_base',"condo_id=".$this->session->userdata('condo_id')." AND privacy = 1 LIMIT 3");
		$this->load->view('template/main',$this->data);
	}
	public function download_forms_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$useful_contacts=$this->General_model->get_data_all_like_using_where('knowledge_base',"id>$lastmsg AND condo_id=".$this->session->userdata('condo_id')." AND privacy = 1 LIMIT 3");
		$n=1;
		foreach($useful_contacts as $download_form)
		{
			$msg_id=$download_form['id'];
			?>
			<div class="todo-tasklist-item todo-tasklist-item-border-green" style="padding-bottom:20px;">
              <div class="todo-tasklist-item-title"> <?php echo $download_form['name']?> </div>
              <div class="todo-tasklist-item-text"> <?php echo $download_form['description']?> </div>
              <div class="todo-tasklist-controls pull-left"> <!--<span class="todo-tasklist-date"> 
                Uploaded: <?php echo date('jS M y',strtotime($download_form['date_uploaded']))?>
                </span>-->  <span class="todo-tasklist-date">
                <?php
								//Get PDF files.
								$download_forms_files = $this->General_model->get_data_all_like_using_where('knowledge_base_files',"knowledge_base_id=".$download_form['id']);
								if(sizeof($download_forms_files)>0){
									$icount = 1;
									foreach($download_forms_files as $download_forms_file){
										?>
                <a target="_blank" href="<?php echo base_url()?>uploads/knowledge_base/<?php echo $download_forms_file['file_url']?>"><span class="todo-tasklist-badge badge badge-roundless"><i class="fa fa-download"></i>  <?php echo $download_forms_file['file_url']?>
                <?php //echo $icount;?>
                </span> </a>
                <?php	
										$icount++;								
								}}
								?>
                </span> </div>
            </div>
			<?php
			$n++;
			}
			if(isset($msg_id)){?>
			<div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests ">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</div>
			
			<?php
			}else{
			?>
            <div class="morebox_services_requests ">
				<p> No more download forms at the moment. </p>
			</div>
			
			<?php
			}
		}
	
	}
	
	public function notifications(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'notifications'));
		}

		$condo_id = $this->session->userdata('condo_id');
		$actions = "condo_id=$condo_id  and session_id = '".$this->session->userdata('resident_id')."' order by msg_time desc LIMIT 3";

		$this->data['title']='Notifications';		
		$this->data['view']='notifications';
		$this->data['notifications']=$this->General_model->get_data_all_like_using_where('notifications',$actions);
		$this->load->view('template/main',$this->data);
	}
	public function notifications_viewajax(){
		if(isSet($_POST['lastmsg']))
		{
		$lastmsg=$_POST['lastmsg'];
		$lastmsg=mysql_real_escape_string($lastmsg);
		
		$notifications=$this->General_model->get_data_all_like_using_where('notifications',"id>$lastmsg AND condo_id=$this->condo_id  and session_id = '".$this->session->userdata('resident_id')."' order by msg_time desc LIMIT 3");
		$n=1;
		foreach($notifications as $notification)
		{
			$msg_id=$notification['id'];
			
             	
                                $noti_id = $notification['id'];
                                $curr_session_id = $notification['session_id'];
                                $posted_by = $notification['person_id'];
                                $log_content = $notification['code'];
                                $facility_id = $notification['facility_id'];
                                
                                //For comment actor display field
                                $display_field_actor = '';
                                if($curr_session_id == $this->session->userdata('resident_id')){
                                    $display_field_actor = 'your';
                                } else if($curr_session_id == $posted_by){
                                    $display_field_actor = 'his/her';
                                } else {
                                    $display_field_actor = $this->General_model->get_value_by_id('residents', $curr_session_id, 'name').'\'s';
                                }
            
                                $display_field ='';
                                  if($log_content == 'New Comment'){
                                      $display_field = 'commented on '.$display_field_actor.' post';
                                  } else if($log_content == 'New Post'){
                                      $display_field = 'added a new post';
                                  } else if($log_content == 'Facility Approved'){
                                      $display_field = ' has been approved';
                                  } else if($log_content == 'Delivery Approved'){
                                      $display_field = ' has been approved';
                                  } else if($log_content == 'New Quote'){
                                      $display_field = 'service quote';
                                  } else if($log_content == 'Vendor Arrival Approved'){
                                      $display_field = 'has been approved';
                                  }
                    
                                if($posted_by == $this->session->userdata('resident_id')){
                                    
                                    } else {
                                     $actor = '';	
                                 if($posted_by == 0 ){
                                     if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Facility Approved'){
                                     $actor = 'Your booking for Facility <b>'.$this->General_model->get_value_by_id('condo_facilities', $facility_id, 'name').'</b>';
                                     ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                     
                                     } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Delivery Approved'){
                                          $actor = 'Your delivery';
                                     ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'New Quote'){
                                          $actor = 'You have received a new';
                                    ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     }  else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Vendor Arrival Approved'){
                                          $actor = 'Service appointment';
                                    ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     }
                                 } else {
                                    if($log_content == 'New Notice'){
                                        ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> Your Management posted a new Notice </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                        
                                    } else {
                                        $actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
                                        ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
					  <?php	
                                }
                             }
      
                                
                            }
			$n++;
			}
			if(isset($msg_id)){?>
			<div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
				<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
				class="more_services_requests btn btn-primary">Show more</a>
			</div>
			
			<?php
			}else{
			?>
            <div class="morebox_services_requests search-item clearfix">
				<p> No more Notifications at the moment. </p>
			</div>
			
			<?php
			}
		}
	
	}

	public function quick_pay(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'quick_pay'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'quick_pay')){
			redirect(base_url().'dashboard');
		}
		
		$condo_id = $this->session->userdata('condo_id');
		$actions = "condo_id=$condo_id and payer_id = '$this->resident_id' order by id desc";
		
		$this->data['title']='Quick Pay - ALIA';
		$this->data['page_title']='Quick Pay';
		$this->data['view']='quick_pay';
		$this->data['payments']=$this->General_model->get_data_all_like_using_where('invoices',$actions);
		$this->load->view('template/main',$this->data);
	}
	
	public function check_module_settings($condo_id, $module_name){
		$condo_module_count = $this->General_model->get_data_all_like_using_where_count('condo_modules', "condo_id = '$condo_id'");
		
		if($condo_module_count > 0){
		$condo_modules = $this->General_model->get_data_row_using_where('condo_modules', "condo_id = '$condo_id'");
			  if($condo_modules->$module_name==1){
				  return true;
			  } 
		}
		return false;
	}
	
	public function make_payment(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'make_payment'));
		}
		
		if(!$this->check_module_settings($this->condo_id, 'quick_pay')){
			redirect(base_url().'dashboard');
		}
		
		if(isset($_POST['reason_payment_submit'])){
			
			$payment_type = $this->input->post('payment_type');
			$reason = $this->input->post('reason_payment');
			$amount = $this->input->post('amount');
			$DbFieldsArray 	= array('payer_id', 'payment_for', 
			'date_created', 'date_paid', 'system_transaction_id', 'transaction_info', 
				'amount_paid', 'payment_receipt', 'payment_month', 'payment_channel','payment_status', 'condo_id');
				$DataArray 		= array($this->session->userdata('resident_id'), $payment_type, date('Y-m-d H:i:s'), '', 
				time(), '', $amount, '', '', '', 0, $this->condo_id);
				//insert into invice
				$invoice_id = $this->General_model->addData_InsertID($DbFieldsArray, $DataArray ,'invoices');
				
				//Add Transaction
				//1. Add Facilty
				$DbFieldsArray_trans 	= array('invoice_id', 'description', 'amount', 'facility_id');
				$DataArray_trans 		= array($invoice_id, $reason, $amount, 0);
				$this->General_model->addData_InsertID($DbFieldsArray_trans, $DataArray_trans ,'invoice_items');

				//2. Add Processing Fee
				$condo_id = $this->session->userdata('condo_id');
				$action="condo_id='$this->condo_id' and key_id='processing_fee'";
				$get_merchant_row = $this->General_model->get_data_row_using_where('condo_settings', $action);
				$get_processing_fee = $get_merchant_row->value;
				
				
				$DbFieldsArray_pcfee 	= array('invoice_id', 'description', 'amount', 'facility_id');
				$DataArray_pcfee 		= array($invoice_id, 'Processing Fee', $get_processing_fee, 0);
				$this->General_model->addData_InsertID($DbFieldsArray_pcfee, $DataArray_pcfee ,'invoice_items');
				
				//Update final amount in Invoice Table
				$transaction_sum = $this->db->query("SELECT SUM(amount) as trans_amt FROM invoice_items 
				WHERE invoice_id = $invoice_id");
				$row_transaction_sum = $transaction_sum->row();
				$get_trans_sum = $row_transaction_sum->trans_amt;
				$update_inv_total = $this->db->query("UPDATE invoices SET amount_paid = $get_trans_sum WHERE id=$invoice_id"); 
				
				$justpay_data = array('justpay_invoice_id'=>$invoice_id);
				$this->session->set_userdata($justpay_data);
				redirect('make_payment_submit');
				
		}
		$this->data['title']='Make a Payment - ALIA';	
		$this->data['page_title']='Make a Payment';	
		$this->data['payment_types']=$this->General_model->get_data_all_using_Multiwhere("condo_id='$this->condo_id'
		 or condo_id = '-1'",
		"payment_for");
		$this->data['view']='make_payment';
		$this->load->view('template/main',$this->data);
	}
	
	public function make_payment_submit(){
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'make_payment_submit'));
		}
		
		if($this->session->userdata('justpay_invoice_id')==""){
			redirect(base_url().'make_payment');
		}
		$this->data['title']='Make a Payment';		
		$this->data['view']='make_payment_submit';
		$this->load->view('template/main',$this->data);
	}
	
	public function show_popup_ad(){
		$ad_id = $this->input->post('ad_id');
		
		$get_row_value = $this->General_model->get_data_row_using_where("advertisements", "id='$ad_id'");
		
		$ad_data = '';
		$ad_data.='
		<div class="row">
                <div class="col-md-5">
                    <img src="'.base_url().'uploads/advertisement_images/'.$get_row_value->ad_img.'" width="200" height="200">
			
                </div>
                
                <div class="col-md-7 pull-left">
                    <h4>'.$get_row_value->title.'</h4>
                    <p>'.$get_row_value->ad_text.'</p>
                </div>
            </div>

		';
		echo $ad_data;
	}
	
	public function show_prem_popup_ad(){
		$ad_id = $this->input->post('ad_id');
		
		$get_row_value = $this->General_model->get_data_row_using_where("advertisements", "id='$ad_id'");
		
		$ad_data = '';
		$ad_data.='
		<div class="row">
                <div class="col-md-6">
                    <img src="'.base_url().'uploads/advertisement_images/'.$get_row_value->ad_img.'" width="282" height="425">
			
                </div>
                
                <div class="col-md-6 pull-left">
                    <h4>'.$get_row_value->title.'</h4>
                    <p>'.$get_row_value->ad_text.'</p>
                </div>
            </div>

		';
		echo $ad_data;
	}
	
	public function view_invoice($id)
	{
		if($this->session->userdata('resident_id')==""){
			redirect(base_url().'?next='.urlencode(base_url().'view_invoice/'.$id));
		}
		
		$id=$this->encrypt_model->decode($id);		
		$action = "id ='$id'";//AND status=0
		$this->data['invoice_details'] = $this->General_model->get_data_row_using_where('invoices', $action);
		
		$this->data['title']='Invoice';
		//$this->data['view']='view_invoice';
		$this->load->view('view_invoice',$this->data);
	}
	
	public function molpay_response($module,$id){
		if($module == 'facility'){
			$vkey ="e1d4bf3aa8dfd96f7bd89aefdd1e9be6"; //Replace xxxxxxxxxxxx with your MOLPay Verify Key
			$tranID = $_POST['tranID'];
			$orderid = $_POST['orderid'];
			$status = $_POST['status'];
			$domain = $_POST['domain'];
			$amount = $_POST['amount'];
			$currency = $_POST['currency'];
			$appcode = $_POST['appcode'];
			$paydate = $_POST['paydate'];
			$skey = $_POST['skey'];
			//print_r($_REQUEST, true); 

			/***********************************************************
			* To verify the data integrity sending by MOLPay
			************************************************************/
			$key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
			$key1 = md5( $paydate.$domain.$key0.$appcode.$vkey );
			if( $skey != $key1 ) $status= 1;
			// Invalid transaction.
			// Merchant might issue a requery to MOLPay to double check payment status with MOLPay.
			if ( $status == "00" ) {
									
			$id=$this->encrypt_model->decode($id);		
			$DbFieldsArray 		= array('date_paid', 'transaction_info', 'payment_status', 'payment_channel');
			$DataArray = array(date('Y-m-d H:i:s'),$tranID,'1','MOLPAY');
			$get_admin = $this->General_model->updateData($id, 'id', $DbFieldsArray, $DataArray, 'invoices');
			$this->data['view_data'] = 'Your Faclity booking is confirmed.<br/>
			Email has been send with the Payment details.<br/>
			<br/>Page will be redirected in 5 seconds';
			$daata = array('facility_invoice_id'=>'');
			$this->session->set_userdata($daata);
			
			$this->data['title']='Payment Successful';
			$this->data['view']='payment_success';
			$this->load->view('template/main',$this->data);
				 
			//Send Email to condo Admin
			$invoice_details = $this->General_model->get_data_row_using_where('invoices', "id=$id");
			$facility_booking_id = $this->General_model->get_value_by_id('invoices', $id, 'booking_id');
			$facility_booking_details = $this->General_model->get_data_row_using_where('facility_booking', "id=$facility_booking_id");
			
			$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "New Facility Booking Confirmed";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A Facility has been succussfully booked under you condo. Please do check. The details are as follows:
					<br />
					
					Amount Paid :".$invoice_details->amount_paid."<br>
					Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
					";
					/*if($admin["notification_alert"]==2)
					{
						$this->load->library('clickatel');
						$this->clickatel->send_sms($admin["phone"], $message_admin);
					}
					else
					{*/
						$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);
					//}
					//Send Welcome Email
				}
			}
			//Send Email to resident
			$resident_details = $this->General_model->get_data_row_using_where('residents', "id=".$this->session->userdata('resident_id'));
			$subject_admin = "Facility Payment Succussful";
			$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$resident_details->name.", <br />
			A Facility has been succussfully booked. Please do check. The details are as follows:
			<br />
			
			Amount Paid :".$invoice_details->amount_paid."<br>
			Booked From :".$facility_booking_details->bookedfor_datetime_from."<br>
			";
			$file = $this->print_invoice($this->encrypt_model->encode($id),'mail');
			$this->email($resident_details->email, $resident_details->name, $subject_admin, $message_admin, $file);
				
			
			//if ( check_cart_amt($orderid, $amount) ) {
			/*** NOTE : this is a userdefined
			function which should be prepared by merchant ***/
			// action to change cart status or to accept order
			// you can also do further checking on the paydate as well
			// write your script here .....
			//}
			} else {
			// failure action. Write your script here .....
			// Merchant might send query to MOLPay using Merchant requery
			// to double check payment status for that particular order.
			}
			// Merchant is recommended to implement IPN once received the payment status
			// regardless the status to acknowledge MOLPay system
		} else if($module == 'just_pay'){
			$vkey ="e1d4bf3aa8dfd96f7bd89aefdd1e9be6"; //Replace xxxxxxxxxxxx with your MOLPay Verify Key
			$tranID = $_POST['tranID'];
			$orderid = $_POST['orderid'];
			$status = $_POST['status'];
			$domain = $_POST['domain'];
			$amount = $_POST['amount'];
			$currency = $_POST['currency'];
			$appcode = $_POST['appcode'];
			$paydate = $_POST['paydate'];
			$skey = $_POST['skey'];
			//print_r($_REQUEST, true); 

			/***********************************************************
			* To verify the data integrity sending by MOLPay
			************************************************************/
			$key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
			$key1 = md5( $paydate.$domain.$key0.$appcode.$vkey );
			if( $skey != $key1 ) $status= 1;
			// Invalid transaction.
			// Merchant might issue a requery to MOLPay to double check payment status with MOLPay.
			if ( $status == "00" ) {
									
			$id=$this->encrypt_model->decode($id);		
			$DbFieldsArray 		= array('date_paid', 'transaction_info', 'payment_status', 'payment_channel');
			$DataArray = array(date('Y-m-d H:i:s'),$tranID,'1','MOLPAY');
			$get_admin = $this->General_model->updateData($id, 'id', $DbFieldsArray, $DataArray, 'invoices');
			$this->data['view_data'] = 'Your Payment is confirmed.<br/>
			Email has been send with the Payment details.<br/><br/>Page will be
			redirected in 5 seconds';
			$daata = array('justpay_invoice_id'=>'');
			$this->session->set_userdata($daata);
			
			$this->data['title']='Payment Successful';
			$this->data['view']='payment_success';
			$this->load->view('template/main',$this->data);
				 
			//Send Email to condo Admin
			$invoice_details = $this->General_model->get_data_row_using_where('invoices', "id=$id");
			
			$action="condo_id='$this->condo_id' AND role='1'";
			$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
			if($get_admin >0)
			{
				foreach($get_admin as $admin)
				{
					$subject_admin = "New Payment - Quick Pay";
					$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$admin['full_name'].", <br />
					A new payment has been made under you condo. Please do check the details as follows:
					<br />
					Description :".$invoice_details->transaction_info."<br>
					Amount Paid :".$invoice_details->amount_paid."<br>
					";
					$this->email($admin['email'], $admin['full_name'], $subject_admin, $message_admin);			
				}
			}
			//Send Email to resident
			
			$resident_details = $this->General_model->get_data_row_using_where('residents', "id=".$this->session->userdata('resident_id'));
			$subject_admin = "Your Payment is succussful";
			$message_admin = "<div style='".$this->config->item('style')."'>Hello  ".$resident_details->name.", <br />
			Your payment is succussful. Please do check the details as follows:
			<br />
			
					Transaction Info :".$invoice_details->transaction_info."<br>
					Amount Paid :".$invoice_details->amount_paid."<br>
			";
			
			$file = $this->print_invoice($this->encrypt_model->encode($id),'mail');
			$this->email($resident_details->email, $resident_details->name, $subject_admin, $message_admin, $file);
			
			//if ( check_cart_amt($orderid, $amount) ) {
			/*** NOTE : this is a userdefined
			function which should be prepared by merchant ***/
			// action to change cart status or to accept order
			// you can also do further checking on the paydate as well
			// write your script here .....
			//}
			} else {
			// failure action. Write your script here .....
			// Merchant might send query to MOLPay using Merchant requery
			// to double check payment status for that particular order.
			}
			// Merchant is recommended to implement IPN once received the payment status
			// regardless the status to acknowledge MOLPay system
			

		}

			}
			
			
			
	public function print_invoice($id,$mail='') { 
		$id=$this->encrypt_model->decode($id);	
		//Get Invoice Info
		$action_inv = "id = '$id'";
		$invoice_details = $this->General_model->get_data_row_using_where('invoices', $action_inv);
		
		//Get Condo Info
		$action_condo = "id = '$invoice_details->condo_id'";
		$condo_info = $this->General_model->get_data_row_using_where('condos', $action_condo);
				
				
		// load library 
		$this->load->library('pdf'); 
		$pdf = $this->pdf->load(); 
		$stylesheet = file_get_contents(base_url().'assets/front/layouts/layout3/css/invoice_pdf.css'); // Get css content
		// retrieve data from model 
		if($invoice_details->payment_channel == 'MOLPAY'){
			$payment_channel = 'MOLPAY';	
		} else {
			$payment_channel = 'Manual Payment';	
		}
	
		ini_set('memory_limit', '256M'); 
		// boost the memory limit if it's low ;) 
		$html = '
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Official Receipt</title>
		</head>
		<body>';
			
		$action_inv = "id = '$invoice_details->condo_id'";
		$condo_info = $this->General_model->get_data_row_using_where('condos', $action_inv);
			
    $html.='<header class="clearfix">
      <div id="logo">
        <img style="height:70px;" src='.base_url().'uploads/condos/condo_pictures/'.$this->General_model->get_value_by_id('condos',$invoice_details->condo_id,'condo_picture').'>
      </div>
      <div id="company">
        <h2 class="name">'.$condo_info->name.'</h2>
        <div>'.$condo_info->address.'</div>
        <div>'.$this->General_model->get_value_by_id('areas',$condo_info->areas,'name').'-'.$condo_info->postcode.'</div>
        <div><a href="mailto:'.$condo_info->email.'">'.$condo_info->email.'</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">'.$this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'name').'('.$this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'block').'-'
								.$this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'floor').'-'
								.$this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'unit').')</h2>
          <div class="address">'.$this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'phone').'</div>
          <div class="email"><a href="mailto:'.$this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'email').'">'.$this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'email').'</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #'.$invoice_details->id.'</h1>
          <div class="date">Date of Invoice:' .date('j M y',strtotime($invoice_details->date_created)).'</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">&nbsp;</th>
            <th class="qty">&nbsp;</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>';
         
                                $action="invoice_id=".$invoice_details->id;
                                $transactions = $this->General_model->get_data_all_like_using_where('invoice_items', $action);
								$icount = 1;
                                foreach($transactions as $transaction){	
                                
          $html.='<tr>
            <td class="no">'.$icount.'</td>
            <td class="desc">'.$transaction['description'].'
                    </td>
            <td class="unit">&nbsp;</td>
            <td class="qty">&nbsp;</td>
            <td class="total">RM'.number_format($transaction['amount'],2).'</td>
          </tr>'
           
			.$icount++;
				}
		
        $html.='</tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>RM'.number_format($invoice_details->amount_paid,2).'</td>
          </tr>
          <!--<tr>
            <td colspan="2"></td>
            <td colspan="2">Processing Fee</td>
            <td>0</td>
          </tr>-->
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>RM'.number_format($invoice_details->amount_paid,2).'</td>
          </tr>
        </tfoot>
      </table>
      <div id="notices">
        <div class="notice">Powered by ALIA. </div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
   </body>
</html>
'; 
		$pdf->WriteHTML($stylesheet,1); // Writing style to pdf
		// render the view into HTML 
		$pdf->WriteHTML($html); 
		// write the HTML into the PDF 
		$output = 'invoice_' .time().'.pdf';
		if($mail == 'mail'){
			ob_clean();
		    $pdf->Output($this->config->item('file_path')."uploads/invoice_files/".$output, 'F'); // Saving pdf to attach to email 
			$attched_file= $this->config->item('file_path')."uploads/invoice_files/".$output;
			return $attched_file;
		} else{
			$pdf->Output("$output", 'I'); 
		}
		
		// save to file because we can 
		exit(); 
	} 
	
	public function send_contacts_data(){
		if(isset($_POST['contactussub'])){
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
		 	
			$subject = "A new contact received";
			$message_content = "Hi, <br />
			You have received a new contact. Please check the details below:<br/><br/>

			Name: ".$name."<br/>
			Email: ".$email."<br/>
			Phone: ".$phone."<br/>
			Message: ".$message."<br/><br/>
			";

			
				
		 	$this->email($this->config->item('alpha_email'),$to_name, $subject, $message_content);
			echo 'contactsent';
		}
	}

	public function email($to_email, $to_name, $subject, $message, $attachment=''){
		//$this->load->helper('path');
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
		if($attachment != ''){
			//$path = set_realpath('uploads/invoice_files/');
			//$this->email->attach($path . 'invoice_1468213876.pdf');  /* Enables you to send an attachment */
		
			//$this->email->attach($this->config->item('file_path')."uploads/invoice_files/invoice_1468213876.pdf");
			$this->email->attach($attachment);
		}
		$this->email->send();
	}
	
	//////////////////////////////////////////////////////////////
	/********************Footer Menu Pages***********************/
	/////////////////////////////////////////////////////////////
	
	public function contact_us(){				
		$this->data['title']='Contact us - ALIA';
		$this->data['page_title']='Contact us';
		$this->data['view']='contact_us';
		$this->load->view('template/main',$this->data);
	}
	
	public function terms_of_use(){				
		$this->data['title']='Terms of Use - ALIA';
		$this->data['page_title']='Terms of Use';
		$this->load->view('terms_of_use',$this->data);
	}
	
	public function about_us(){				
		$this->data['title']='About Us - ALIA';
		$this->data['page_title']='About Us';
		$this->load->view('about_us',$this->data);
	}
	
	
	public function privacy_policy(){				
		$this->data['title']='Privacy Policy - ALIA';
		$this->data['page_title']='Privacy Policy';
		$this->load->view('privacy_policy',$this->data);
	}
	
	public function do_logout(){
        $this->session->sess_destroy();
		$this->session->unset_userdata('resident_id');    
		redirect(base_url());
    }
	
} 