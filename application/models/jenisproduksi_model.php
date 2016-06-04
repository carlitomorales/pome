<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class jenisproduksi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_jenis_produksi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_jenis_produksi',$id);
		$this->db->update('t_jenis_produksi',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_jenis_produksi',$id);
		$this->db->delete('t_jenis_produksi');		
		return true;
	}
	
	public  function getById($id){
		$this->db->select('id_jenis_produksi, jenis_produksi, jumlah, satuan, tahun, id_perusahaan, status_audit, keterangan_audit')
		->from('t_jenis_produksi')
		->where('id_jenis_produksi',$id);
		$query = $this->db->get();
		return $query->result();
	}
}