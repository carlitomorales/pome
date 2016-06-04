<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class jenisenergi_model extends CI_Model {
	public function __construct()
	{
		//$this->load->database();
	}

	
	/*public function get_fordropdownind()
	{
		$this->db->select('IdJenisPeralatan,JenisPeralatan');
		$this->db->where('Deleted','0');
		$this->db->where('IdTypePerusahaan','1');
		$this->db->order_by('IdJenisPeralatan','ASC');
		$query = $this->db->get('tm_jenisperalatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function get_fordropdownkom()
	{
		$this->db->select('IdJenisPeralatan,JenisPeralatan');
		$this->db->where('Deleted','0');
		$this->db->where('IdTypePerusahaan','2');
		$this->db->order_by('IdJenisPeralatan','ASC');
		$query = $this->db->get('tm_jenisperalatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function get_fordropdown($typeperusahaan)
	{
		$this->db->select('IdJenisPeralatan,JenisPeralatan');
		$this->db->where('Deleted','0');
		$this->db->where('IdTypePerusahaan',$typeperusahaan);
		$this->db->order_by('IdJenisPeralatan','ASC');
		$query = $this->db->get('tm_jenisperalatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function getTypePerusahaanbyid($id)
	{
		$this->db->where('IdMTypePerusahaan',$id);
		$query = $this->db->get('tm_typeperusahaan');
		return $query->result_array();
	}
	
	public function getJenisPeralatanLain()
	{
		$sql = "SELECT DISTINCT jenis_peralatan_lain FROM t_peralatan_pemanfaat_energi ORDER BY jenis_peralatan_lain";
		$query = $this->db->query($sql);
		return $query->result();
	}*/
	public function get_fordropdown()
	{
		$this->db->select('IdJenisEnergi,JenisEnergi');
		$this->db->where('Deleted','0');
		$this->db->order_by('IdJenisEnergi','ASC');
		$query = $this->db->get('tm_jenisenergi');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	public function getJenisEnergiLain()
	{
		$sql = "SELECT DISTINCT jenis_energi_lain FROM t_peralatan_pemanfaat_energi ORDER BY jenis_energi_lain";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public  function getById($id){
		$this->db->select('IdJenisEnergi,JenisEnergi,Satuan');
		$this->db->where('Deleted','0');
		$this->db->where('IdJenisEnergi',$id);	
		$query = $this->db->get('tm_jenisenergi');		
		return $query->result();
	}
	public function edit($id, $data)
	{
		$this->db->where('IdJenisEnergi',$id);
		$this->db->update('tm_jenisenergi',$data);		
		return true;
	}
	public function insert($data)
	{
		$this->db->insert('tm_jenisenergi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

public function getSatuan($id)
	{
		$this->db->select('Satuan')
		->where('Deleted','0')
		->where('IdJenisEnergi',$id)
		->from('tm_jenisenergi');
		$query = $this->db->get();
		return $query->result();
	}
}