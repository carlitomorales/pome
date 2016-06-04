<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class subsektor_model extends CI_Model {
	
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
	
	public function get_fordropdownsatuan()
	{
		$this->db->select('id_satuan_produksi,nama_satuan_produksi');
		$this->db->where('Deleted','0');
		$this->db->order_by('id_satuan_produksi','ASC');
		$query = $this->db->get('tm_satuan_produksi');
		
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
	public function get_fordropdownsatuanbysubsektor($idsubsektor)
	{
		$this->db->select('a.id_satuan_produksi,a.nama_satuan_produksi');
		$this->db->from('tm_satuan_produksi as a');
		$this->db->join('tm_subsektor as b','a.id_satuan_produksi=b.id_satuan_produksi');
		$this->db->where('IdMSubsektor',$idsubsektor);
		$this->db->order_by('b.urutan','ASC');
		$query = $this->db->get();
		
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
		$this->db->select('IdMSubsektor,NamaSubsektor,MTypePerusahaan_IdMTypePerusahaan,id_satuan_produksi');
		$this->db->where('Deleted','0');
		$this->db->where('IdMSubsektor',$id);	
		$query = $this->db->get('tm_subsektor');		
		return $query->result();
	}
	public function getSatuanBySubsektor($idsubsektor)
	{
		$this->db->select('b.nama_satuan_produksi');
		$this->db->from('tm_subsektor as a');
		$this->db->join('tm_satuan_produksi as b', 'a.id_satuan_produksi=b.id_satuan_produksi');
		$this->db->where('a.IdMSubsektor', $idsubsektor);		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function edit($id, $data)
	{
		$this->db->where('IdMSubsektor',$id);
		$this->db->update('tm_subsektor',$data);		
		return true;
	}
	public function insert($data)
	{
		$this->db->insert('tm_subsektor', $data);
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