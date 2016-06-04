<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class luasbangunan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_luas_bangunan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_luas_bangunan',$id);
		$this->db->update('t_luas_bangunan',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_luas_bangunan',$id);
		$this->db->delete('t_luas_bangunan');		
		return true;
	}
	
	public  function getById($id){
		$this->db->select('id_luas_bangunan, nama_bangunan, luas_bangunan, tahun, id_perusahaan')
		->from('t_luas_bangunan')
		->where('id_luas_bangunan',$id);
		$query = $this->db->get();
		return $query->result();
	}
}