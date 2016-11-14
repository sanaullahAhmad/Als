<?php 
class Authentication_model extends CI_Model{

	var $manager_id;
	var $access_level;

	public function __construct(){
		parent::__construct();
		$this->manager_id=$this->session->userdata('manager_id');
		$this->access_level=$this->session->userdata('access_level');
		
	}

	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	//Check Authentication
	public function user_authentication_login($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',1);		
		$query=$this->db->get('condo_admins');
			if($query->num_rows==1){
				$row = $query->row();
				$data = array(
                    'manager_id'     	  => $row->id,
					'manager_email'       => $row->email,
					'condo_id'       	  => $row->condo_id,
					'manager_full_name'   => $row->full_name
                    );
				 $this->update_last_login($row->id);
                 $this->session->set_userdata($data);
				 return true;
			}else{
            return false;	
	      }
	}
	
	public function resident_authentication_login($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		if($this->session->userdata('link_condo_id')!=""){
			$this->db->where('condo_id',$this->session->userdata('link_condo_id'));
		}	
		$query=$this->db->get('residents');
		
		//echo $this->db->last_query();exit;
			if($query->num_rows==1){
				$row = $query->row();
				$data = array(
					'resident_id'     => $row->id,
					'email'           => $row->email,
					'type'            => $row->type,
					'condo_id'        => $row->condo_id,
					'image_url'       => $row->image_url,
					'name'   	      => $row->name
                    );
				 $this->update_last_login($row->id, 'residents');
                 $this->session->set_userdata($data);
				 return true;
			}else{
            return false;	
	      }
	}
	//Check for active account
	public function resident_active_account_check($email, $password, $table='residents'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));	
		$this->db->where('status', '1');
		if($this->session->userdata('link_condo_id')!=""){
			$this->db->where('condo_id',$this->session->userdata('link_condo_id'));
		}

		$query = $this->db->get($table);
			
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
					'resident_id'     => '',
					'email'           => '',
					'type'            => '',
					'condo_id'        => '',
					'image_url'        => '',
					'name'   	      => ''
				);
				
            $this->session->unset_userdata($data);
			return false;
		}
	}//Check for unit block
	public function resident_unit_block_check($email, $password, $table='residents'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));	
		$this->db->where('status', '1');
		$query = $this->db->get($table);
		$res = $query->row();
		$nqu = $this->db->query("select * from blacklisted_units where condo_id = ".$res->condo_id." AND block = ".$res->block." AND floor = '".$res->floor."' AND unit = ".$res->unit."");
		if($nqu->num_rows() >0){
		$row = $query->row();
			$data = array(
					'resident_id'     => '',
					'email'           => '',
					'type'            => '',
					'condo_id'        => '',
					'image_url'        => '',
					'name'   	      => ''
				);
				
            $this->session->unset_userdata($data);
			return false;
		} else {
			return true;
		}
	}
	//Check for active account
	public function active_account_check($email, $password, $table='condo_admins'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',1);		
		$this->db->where('status', '1');

		$query = $this->db->get($table);
			
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
				'manager_id'     	  => '',
				'manager_email'       => '',
				'condo_id'       	  => '',
				'manager_full_name'   => ''
				);
				
            $this->session->unset_userdata($data);
			return false;
		}
	}
	//Check security_condo_active_check
	public function manager_condo_active_check($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',1);		
		$query=$this->db->get('condo_admins');
			if($query->num_rows==1){
				$row = $query->row();
				$qu = $this->db->query("select status from condos where status='1' AND id =".$row->condo_id);
				if($qu->num_rows>0)
				{
					 return true;
				}
				else
				{
					$row = $query->row();
					$data = array(
						'manager_id'     	  => '',
						'manager_email'       => '',
						'condo_id'       	  => '',
						'manager_full_name'   => ''
					);
					$this->session->unset_userdata($data);
					return false;
				}
			}else{
            return false;	
	      }
	}
	
	
	//Check Sicurity Authentication
	public function security_authentication_login($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',2);		
		$query=$this->db->get('condo_admins');
			if($query->num_rows==1){
				$row = $query->row();
					$data = array(
						'security_id'     	  => $row->id,
						'security_email'       => $row->email,
						'condo_id'       		 => $row->condo_id,
						'security_name'        => $row->full_name
						);
					 $this->update_last_login($row->id);
					 $this->session->set_userdata($data);
					 return true;
			}else{
            return false;	
	      }
	}
	
	//Check for Security active account
	public function security_active_account_check($email, $password, $table='condo_admins'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',2);		
		$this->db->where('status', '1');

		$query = $this->db->get($table);
			
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
				'security_id'     => '',
				'security_email'  => '',
				'condo_id'     	  => '',
				'security_name'   => ''
				);
				
            $this->session->unset_userdata($data);
			return false;
		}
	}
	
	//Check security_condo_active_check
	public function security_condo_active_check($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('role',2);		
		$query=$this->db->get('condo_admins');
			if($query->num_rows==1){
				$row = $query->row();
				$qu = $this->db->query("select status from condos where status='1' AND id =".$row->condo_id);
				if($qu->num_rows>0)
				{
					 return true;
				}
				else
				{
					$row = $query->row();
					$data = array(
						'security_id'     => '',
						'security_email'  => '',
						'condo_id'     	  => '',
						'security_name'   => ''
					);
					$this->session->unset_userdata($data);
					return false;
				}
			}else{
            return false;	
	      }
	}
	
	
	public function vendor_authentication_login($email, $password, $table='vendors'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$query=$this->db->get($table);
			if($query->num_rows==1){
				$row = $query->row();
				$data = array(
                    'vendor_id'   => $row->id,
					'vendor_email'=> $row->email,
					'vendor_name' => $row->name
                    );
				 $this->update_last_login($row->id,'vendors');
                 $this->session->set_userdata($data);
				 return true;
			}else{
            return false;	
	      }
	}
	
	
	//Check for active account
	public function vendor_active_account_check($email, $password, $table='vendors'){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('status', '1');

		$query = $this->db->get($table);
			
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
				 'vendor_id'    => '',
				 'vendor_email' => '',
				 'vendor_name'  => ''
				);
				
            $this->session->unset_userdata($data);
			return false;
		}
	}
	
	//Check for active account
	public function update_last_login($id,$table='condo_admins'){
		$data=array(
			"last_login"=>date('Y-m-d H:i:s'),
			"ip"=>$_SERVER['REMOTE_ADDR']
		);
		$this->db->where('id', $id);
		$this->db->update($table,$data);			
	}
	
	public function data_exists($where_field, $where_data, $table) {
		$this->db->where($where_field, $where_data);
		//this condition in only used in home add_resident function
		if($this->session->userdata('link_condo_id')!=""){
			$this->db->where('condo_id',$this->session->userdata('link_condo_id'));
		}
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return FALSE; 
		} else { 
			return TRUE; 
		}
	}
	
	public function data_exists_md5($where_field, $where_data, $table) {
		$this->db->where($where_field, md5($where_data));
		$this->db->where('id', $this->manager_id);
		$query = $this->db->get($table);
		//$sql= "SELECT * from $table where $where_field = 'md5($where_data)'"; 
		//$query = $this->db->query($sql);
		
		//$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return TRUE; 
		} else { 
			return FALSE; 
		}
	}
	
	public function data_exists_md5_id($where_field, $where_data, $table, $id) {
		$this->db->where($where_field, md5($where_data));
		$this->db->where('id', $id);
		$query = $this->db->get($table);
		//$sql= "SELECT * from $table where $where_field = 'md5($where_data)'"; 
		//$query = $this->db->query($sql);
		
		//$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return TRUE; 
		} else { 
			return FALSE; 
		}
	}
	public function data_exists_md5_security($where_field, $where_data, $table) {
		$this->db->where($where_field, md5($where_data));
		$this->db->where('id', $this->security_id);
		$query = $this->db->get($table);
		//$sql= "SELECT * from $table where $where_field = 'md5($where_data)'"; 
		//$query = $this->db->query($sql);
		
		//$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return TRUE; 
		} else { 
			return FALSE; 
		}
	}
	
	
	public function data_exists_md5_vendor($where_field, $where_data, $table) {
		$this->db->where($where_field, md5($where_data));
		$this->db->where('id', $this->vendor_id);
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return TRUE; 
		} else { 
			return FALSE; 
		}
	}
	
	public function data_exists_forgot_pass($where_field, $where_data, $table) {
		$this->db->where('email', $where_data);
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return TRUE; 
		} else { 
			return FALSE; 
		}
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
	
	
	
	/******************************************************************************************/
	/////////////////////////////////////////// END LOGIN //////////////////////////////////////
	/******************************************************************************************/
	
	/******************************************/
		
}



?>