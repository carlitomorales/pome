<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class konsumsienergispesifik_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('T_KonsmsiEnrgSpsifikInd', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('IdTKonsmsiEnrgSpsifikInd',$id);
		$this->db->update('T_KonsmsiEnrgSpsifikInd',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('IdTKonsmsiEnrgSpsifikInd',$id);
		$this->db->delete('T_KonsmsiEnrgSpsifikInd');		
		return true;
	}
	
	public  function getById($id){
		$this->db->select('IdTKonsmsiEnrgSpsifikInd, id_jenis_peralatan, JenisPeralatan, jenis_peralatan_lain, id_jenis_energi, jenis_energi_lain, original_unit, konversi, gjoule, tahun, id_perusahaan, status_audit, keterangan_audit')
		->from('T_KonsmsiEnrgSpsifikInd')
		->join('tm_jenisperalatan', 't_pemakaian_energi.id_jenis_peralatan=tm_jenisperalatan.IdJenisPeralatan')
		->where('IdTKonsmsiEnrgSpsifikInd',$id);
		$query = $this->db->get();
		return $query->result();
	}
}