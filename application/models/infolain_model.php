<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class infolain_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('tm_infolain', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_regulasi',$id);
		$this->db->update('tm_infolain',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_regulasi',$id);
		$this->db->delete('tm_infolain');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('id_regulasi',$id);
		$query = $this->db->get('tm_infolain');
		return $query->result_array();
	}
	
	function getPublished(){
		$sql = "SELECT * FROM tm_infolain ORDER BY nama_regulasi ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}