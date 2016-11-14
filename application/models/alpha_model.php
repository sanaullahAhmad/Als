<?php 
class Alpha_model extends CI_Model{
	var $alpha_id;
	var $access_level;
	public function __construct(){
		parent::__construct();
		$this->alpha_id=$this->session->userdata('alpha_id');
		$this->access_level=$this->session->userdata('access_level');
	}

	/******************************************************************************************/
	//////////////////////////////////////////// LOGIN /////////////////////////////////////////
	/******************************************************************************************/
	
	//Check Authentication
	public function user_authentication_login($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));		
		$query=$this->db->get('admin');
			if($query->num_rows==1){
				$row = $query->row();
				$data = array(
                    'alpha_id'     => $row->id,
					'email'       => $row->email,
					'full_name'   => $row->full_name
                    );
				 $this->update_last_login($row->id);
                 $this->session->set_userdata($data);
				 return true;
			}else{
            return false;	
	      }
	}
	public function update_last_login($id){
		$data=array(
			"last_login"=>date('Y-m-d H:i:s'),
			"last_login_ip"=>$_SERVER['REMOTE_ADDR']
		);
		$this->db->where('id', $id);
		$this->db->update('admin',$data);			
	}
	//Check for active account
	public function active_account_check($email, $password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('status', '1');
		$query = $this->db->get('admin');
		if($query->num_rows() == 1){
			return true;
		} else {
			$row = $query->row();
			$data = array(
				'alpha_id'     => '',
				'email'       => '',
				'full_name'   => ''
				);
            $this->session->unset_userdata($data);
			return false;
		}
	}
	
	public function email_exists($where_field, $where_data, $table) {
		$this->db->where($where_field, $where_data);
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return FALSE; 
		} else { 
			return TRUE; 
		}
	}
	
	public function data_exists_md5($where_field, $where_data, $table) {
		$this->db->where($where_field, md5($where_data));
		$this->db->where('id', $this->alpha_id);
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