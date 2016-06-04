<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mchain_model extends CI_Model {
	public function __construct()
	{
		//$this->load->database();
	}
	
	function getPropinsiList(){
	
		$this->db->select('propinsi_id,propinsi');
		$this->db->order_by('propinsi','ASC');
		$query = $this->db->get('tm_propinsi');
		
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
	public function getPropinsibyid($id)
	{
		$this->db->select('propinsi_id,propinsi');
		$this->db->where('propinsi_id',$id);
		$query = $this->db->get('tm_propinsi');
		return $query->result_array();
	}
	function getJenisEnergiDetailList(){
		
		$IdJenisEnergi = $this->input->post('IdJenisEnergi');
		$this->db->select('id_jenis_energi_detail,detail_jenis_energi');
		$this->db->where('IdJenisEnergi',$IdJenisEnergi);
		$this->db->order_by('detail_jenis_energi','ASC');
		$query = $this->db->get('tm_jenisenergidetail');
		
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

	function getKotaList(){
		
		$propinsi_id = $this->input->post('propinsi_id');
		$this->db->select('kota_id,kota_kabupaten');
		$this->db->where('propinsi_id',$propinsi_id);
		$this->db->order_by('kota_kabupaten','ASC');
		$query = $this->db->get('tm_kota_kabupaten');
		
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
	public function getKotabyid($propid,$kotaid)
	{
		$this->db->select('kota_id,kota_kabupaten');
		$this->db->where('propinsi_id',$propid);
		$this->db->where('kota_id',$kotaid);
		$query = $this->db->get('tm_kota_kabupaten');
		return $query->result_array();
	}
	
	function getSubsektorList(){
		
		$IdMTYpePerusahaan = $this->input->post('IdTypePerusahaan');
		$this->db->select('IdMSubsektor,NamaSubsektor,urutan');
		$this->db->where('MTypePerusahaan_IdMTypePerusahaan', $IdMTYpePerusahaan);
		$this->db->where('Deleted','0');
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get('tm_subsektor');
		
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
	public function getSubsektorbyid($typeid,$subsektorid)
	{
		$this->db->select('IdMSubsektor,NamaSubsektor');
		$this->db->where('MTypePerusahaan_IdMTypePerusahaan',$typeid);
		$this->db->where('IdMSubsektor',$subsektorid);
		$query = $this->db->get('tm_subsektor');
		return $query->result_array();
	}

}
?>
