<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class peralatanpemanfaatenergi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_peralatan_pemanfaat_energi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('id_peralatan_pemanfaat_energi',$id);
		$this->db->update('t_peralatan_pemanfaat_energi',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_peralatan_pemanfaat_energi',$id);
		$this->db->delete('t_peralatan_pemanfaat_energi');		
		return true;
	}
	
	public  function getById($id){
		$this->db->select('id_peralatan_pemanfaat_energi, id_jenis_peralatan, JenisPeralatan, jenis_peralatan_lain, id_jenis_energi, jenis_energi_lain, original_unit, konversi, gjoule, tahun, id_perusahaan, status_audit, keterangan_audit')
		->from('t_peralatan_pemanfaat_energi')
		->join('tm_jenisperalatan', 't_peralatan_pemanfaat_energi.id_jenis_peralatan=tm_jenisperalatan.IdJenisPeralatan')
		->where('id_peralatan_pemanfaat_energi',$id);
		$query = $this->db->get();
		return $query->result();
	}
}