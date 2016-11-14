<?php 
class Functions_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
    
	
	public function search(){
		$keyword = $this->input->post('keyword');
		$sql="SELECT * FROM condos where name LIKE '%$keyword%'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function search_all(){
		$sql="SELECT * FROM condos";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	





}

?>