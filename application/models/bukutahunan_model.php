<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class bukutahunan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('tm_bukutahunan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_bukutahunan',$id);
		$this->db->update('tm_bukutahunan',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_bukutahunan',$id);
		$this->db->delete('tm_bukutahunan');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('id_bukutahunan',$id);
		$query = $this->db->get('tm_bukutahunan');
		return $query->result_array();
	}
	
	function getPublished(){
		$sql = "SELECT * FROM tm_bukutahunan ORDER BY nama_bukutahunan ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}