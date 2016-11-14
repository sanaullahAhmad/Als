<?php 

class general_model extends CI_Model{

    var $user_id;

	public function __construct(){
		parent::__construct();
	}
    
	public function nicetime2($date)
	{
		return "success";
		if(empty($date)) {
			return "No date provided";
		}
		
		$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths         = array("60","60","24","7","4.35","12","10");
		
		$now             = time();
		$unix_date         = strtotime($date);
		
		   // check validity of date
		if(empty($unix_date)) {    
			return "Bad date";
		}
	
		// is it future date or past date
		if($now > $unix_date) {    
			$difference     = $now - $unix_date;
			$tense         = "ago";
			
		} else {
			$difference     = $unix_date - $now;
			$tense         = "from now";
		}
		
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
		
		$difference = round($difference);
		
		if($difference != 1) {
			$periods[$j].= "s";
		}
		
		return "$difference $periods[$j] {$tense}";
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
	
	public function get_value_by_id_empty($table,$id,$value){
		$this->db->where("id", $id);
		$query = $this->db->get($table);
		if($query->num_rows()>0){
		$row = $query->row();
		return $row->$value;
		}else{
			return "";
		}
	}
	
	public function get_data_value_using_where($table,$action,$value){
		$sql= "SELECT *  from $table where $action"; 
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
		$row = $query->row();
		return $row->$value;
		}else{
			return 0;
		}
	}
	
	public function get_data_row_using_where($table,$action){
		$sql= "SELECT *  from $table where $action"; 
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		if($query->num_rows()>0){
		$row = $query->row();
		return $row;
		}else{
			return "";
		}
	}
	public function get_data_rowusingwhere_empty_array($table,$action){
		$sql= "SELECT *  from $table where $action"; 
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		if($query->num_rows()>0){
		$row = $query->row();
		return $row;
		}else{
			return array();
		}
	}

	public function get_data_all($table){
		$query = $this->db->get($table);
		$result=$query->result_array();
		return $result;
	}
	public function get_data_fields($table,$fields){
		$this->db->select($fields);
		$query = $this->db->get($table);
		$result=$query->result_array();
		return $result;
	}

	public function get_data_all_using_where($where_attr,$where_val,$table){
	    	$this->db->where($where_attr, $where_val);
		$query = $this->db->get($table);
		$result=$query->result_array();
		return $result;
	}
	
	public function get_data_all_like_using_where($table, $action){
		$sql= "SELECT * from $table where $action"; 
		$query = $this->db->query($sql);
		$result=$query->result_array();
		return $result;
	}
	
	public function get_data_all_using_Multiwhere($where,$table){
		  $sql="SELECT *  from $table where $where"; 
		  $query = $this->db->query($sql);
		  $result=$query->result_array();
          return $result;
	}
	
	public function update_data_using_multiwhere($where, $action, $table){
		  $sql="UPDATE $table SET $action where $where"; 
		  $query = $this->db->query($sql);
		  $sql_fetch="SELECT * from $table where $where and $action"; 
		  $query_fetch = $this->db->query($sql_fetch);
		  if($query_fetch->num_rows()>0){
				return true;
		  }else {
			 return false;
		  }
	}

	public function update_data_using_multiwhere_custom($where, $action, $table){
		  $sql="UPDATE $table SET $action where $where"; 
		  $query = $this->db->query($sql);
		  $sql_fetch="SELECT * from $table where $where and forgot_pass_count <=1"; 
		  $query_fetch = $this->db->query($sql_fetch);
		  $row_fetch = $query_fetch->row();
		  if($query_fetch->num_rows()>0){
				return $row_fetch->id;
		  }else {
			 return false;
		  }
	}
	
	public function delete_data($id,$table){
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	public function delete_data_using_where($attr,$attr_val,$table){
		$this->db->where($attr, $attr_val);
		$this->db->delete($table);
	}

	public function get_data_by_id($id,$table){
		$this->db->where("id", $id);
		$query = $this->db->get($table);
		return $row = $query->row();
	}
	
	public function data_exists($where_field, $where_data, $table) {
		$this->db->where($where_field, $where_data);
		$query = $this->db->get($table);
		if( $query->num_rows() > 0 ){ 
			return FALSE; 
		} else { 
			return TRUE; 
		}
	}
	
	public function addData($DbFieldsArray, $DataArray, $table){
		$data = array();
		
		for($i=0; $i<sizeof($DbFieldsArray); $i++){
			$data[$DbFieldsArray[$i]] = $DataArray[$i];	
		}
				
		if($this->db->insert($table, $data)){
			return true;	
		}
		return false;
	}
	
	public function addData_array($data, $table){
		if($this->db->insert($table, $data)){
			return true;	
		}
		return false;
	}
	
	public function addData_InsertID($DbFieldsArray, $DataArray, $table){
		$data = array();
		
		for($i=0; $i<sizeof($DbFieldsArray); $i++){
			$data[$DbFieldsArray[$i]] = $DataArray[$i];	
		}
				
		$this->db->insert($table, $data);
		return $this->db->insert_id();
		
	}
	public function deleteDataGeneral($whereClause, $table){
		$this->db->where($whereClause);
		if($this->db->delete($table)){
			return true;
		}
		return false;		        
    }
	public function updateData_permission($whereClouse, $updateDbFieldsAry, $updateInfoAry, $table){
		
		$data = array();		
		for($i=0; $i<sizeof($updateDbFieldsAry); $i++){			
			$data[$updateDbFieldsAry[$i]] = $updateInfoAry[$i];	
		}
								
		$this->db->where($whereClouse);		
		if($this->db->update($table, $data)){
			return true;
		}		
		return false;
	}
	public function updateData($compareFieldName, $dbFieldName, $updateDbFieldsAry, $updateInfoAry, $table){
		
		$data = array();		
		for($i=0; $i<sizeof($updateDbFieldsAry); $i++){			
			$data[$updateDbFieldsAry[$i]] = $updateInfoAry[$i];	
		}
				
		
		$this->db->where($dbFieldName, $compareFieldName);
		
		if($this->db->update($table, $data)){
			return true;
		}
		
		return false;
	}
	
	
	
	public function updateData_array($data, $table, $id){
		$this->db->where('id', $id);
		if($this->db->update($table, $data)){
			return true;	
		}
		return false;
	}
	

	
	public function check_category_exist($table, $name ) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where('name', $name);
		
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
             return TRUE;			
        } else {
             return FALSE;	
        }
    }
	public function edit_lead_doubleclick($id, $field, $changed_name, $table){
		$data = array(
			$field		     	 =>	$changed_name,
		);
		$this->db->where('id', $id);
		$this->db->update($table,$data);
		return true;
	}
	

	
}







?>