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
		$this->db->select('IdJenisEnergi,JenisEnergi,urutan');
		$this->db->where('Deleted','0');
		$this->db->order_by('urutan','ASC');
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
	public function get_fordropdowndetail($idp)
	{
		$this->db->select('b.IdJenisEnergi,b.JenisEnergi,c.id_jenis_energi_detail,c.detail_jenis_energi,a.konversi');
		$this->db->from('t_pemakaian_energi AS a');// I use aliasing make joins easier 
		$this->db->join('tm_jenisenergi AS b', 'a.id_jenis_energi = b.IdJenisEnergi', 'INNER');
		$this->db->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail = c.id_jenis_energi_detail', 'INNER');
		$this->db->where('b.Deleted','0');
		$this->db->where('a.tahun', date("Y") - 1);
		$this->db->where('a.id_perusahaan',$idp);
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
	public function get_jenisenergi($idp)
	{
		$this->db->select('IdJenisEnergi');
		$this->db->from('tm_jenisenergidetail');// I use aliasing make joins easier
		$this->db->where('id_jenis_energi_detail',$idp);
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
	public  function getByIdEnergiDetail($id){
		$this->db->select('id_jenis_energi_detail,detail_jenis_energi,faktor_emisi');
		$this->db->where('id_jenis_energi_detail',$id);	
		$query = $this->db->get('tm_jenisenergidetail');		
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
	public function editdetail($id, $data)
	{
		$this->db->where('id_jenis_energi_detail',$id);
		$this->db->update('tm_jenisenergidetail',$data);		
		return true;
	}
	public function insertdetail($data)
	{
		$this->db->insert('tm_jenisenergidetail', $data);
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
	public function getKonversiDetail($id,$idp)
	{
		$this->db->select('konversi,original_unit')		
		->where('id_jenis_energi_detail',$id)
		->where('id_perusahaan',$idp)
		->where('tahun', date("Y") - 1)
		->from('t_pemakaian_energi');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_all(){
		$this->db->select('IdJenisEnergi,JenisEnergi')
		->where('Deleted','0')
		->from('tm_jenisenergi')
		->order_by('JenisEnergi');
		$query = $this->db->get();
		return $query->result_array();
	}
}