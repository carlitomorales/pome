<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class faq_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_faq', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('faq_id',$id);
		$this->db->update('t_faq',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('faq_id',$id);
		$this->db->delete('t_faq');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('faq_id',$id);
		$query = $this->db->get('t_faq');
		return $query->result_array();
	}
	
	public function getAll(){
		$this->db->order_by('create_date','desc');
		$query = $this->db->get('t_faq');
		return $query->result_array();
	}
}