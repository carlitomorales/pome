<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class satuanproduksi_model extends CI_Model {
	
	public function get_fordropdown($IdMTYpePerusahaan=0)
	{
		if(!empty($TypePerusahaan)){
			$this->db->where('MTypePerusahaan_IdMTypePerusahaan', $IdMTYpePerusahaan);
		}
		$this->db->select('IdMSubsektor,NamaSubsektor');
		$this->db->where('Deleted','0');
		$this->db->order_by('NamaSubsektor','ASC');
		$query = $this->db->get('msubsektor');
		
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
	public  function getById($id){
		$this->db->select('id_satuan_produksi,nama_satuan_produksi');
		$this->db->where('Deleted','0');
		$this->db->where('id_satuan_produksi',$id);	
		$query = $this->db->get('tm_satuan_produksi');		
		return $query->result();
	}
	public function edit($id, $data)
	{
		$this->db->where('id_satuan_produksi',$id);
		$this->db->update('tm_satuan_produksi',$data);		
		return true;
	}
	public function insert($data)
	{
		$this->db->insert('tm_satuan_produksi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function getbytypeperusahaan($id){
		$this->db->where('MTypePerusahaan_IdMTypePerusahaan', $id);
		$this->db->select('IdMSubsektor,NamaSubsektor');
		$this->db->where('Deleted','0');
		$this->db->order_by('NamaSubsektor','ASC');
		$query = $this->db->get('tm_subsektor');
		
		return $query->result_array();
	}
}