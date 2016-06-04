<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kegiatankonservasi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_kegiatan_konservasi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_kegiatan_konservasi',$id);
		$this->db->update('t_kegiatan_konservasi',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_kegiatan_konservasi',$id);
		$this->db->delete('t_kegiatan_konservasi');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('id_kegiatan_konservasi',$id);
		$query = $this->db->get('t_kegiatan_konservasi');
		return $query->result();
	}
}