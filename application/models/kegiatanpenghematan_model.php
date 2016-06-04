<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kegiatanpenghematan_model extends CI_Model {
	public function __construct()
	{
		//$this->load->database();
	}

	
	public function get_fordropdown()
	{
		$this->db->select('id_kegiatan,jenis_kegiatan,urutan');
		$this->db->where('Deleted','0');
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get('tm_kegiatan');
		
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
		$this->db->select('b.id_kegiatan,b.jenis_kegiatan,c.id_jenis_energi_detail,c.detail_jenis_energi,a.konversi');
		$this->db->from('t_pemakaian_energi AS a');// I use aliasing make joins easier 
		$this->db->join('tm_kegiatan AS b', 'a.id_jenis_energi = b.id_kegiatan', 'INNER');
		$this->db->join('tm_kegiatandetail AS c', 'a.id_jenis_energi_detail = c.id_jenis_energi_detail', 'INNER');
		$this->db->where('b.Deleted','0');
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
	public function get_jenis_kegiatan($idp)
	{
		$this->db->select('id_kegiatan');
		$this->db->from('tm_kegiatandetail');// I use aliasing make joins easier
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
	public function getjenis_kegiatanLain()
	{
		$sql = "SELECT DISTINCT jenis_energi_lain FROM t_peralatan_pemanfaat_energi ORDER BY jenis_energi_lain";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public  function getById($id){
		$this->db->select('id_kegiatan, jenis_kegiatan');
		$this->db->where('Deleted','0');
		$this->db->where('id_kegiatan',$id);	
		$query = $this->db->get('tm_kegiatan');		
		return $query->result();
	}
	public  function getByIdEnergiDetail($id){
		$this->db->select('id_jenis_energi_detail,detail_jenis_energi,faktor_emisi');
		$this->db->where('id_jenis_energi_detail',$id);	
		$query = $this->db->get('tm_kegiatandetail');		
		return $query->result();
	}
	public function edit($id, $data)
	{
		$this->db->where('id_kegiatan',$id);
		$this->db->update('tm_kegiatan',$data);		
		return true;
	}
	public function insert($data)
	{
		$this->db->insert('tm_kegiatan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function editdetail($id, $data)
	{
		$this->db->where('id_jenis_energi_detail',$id);
		$this->db->update('tm_kegiatandetail',$data);		
		return true;
	}
	
	public function getSatuan($id)
	{
		$this->db->select('Satuan')
		->where('Deleted','0')
		->where('id_kegiatan',$id)
		->from('tm_kegiatan');
		$query = $this->db->get();
		return $query->result();
	}
	public function getKonversiDetail($id,$idp)
	{
		$this->db->select('konversi,original_unit')		
		->where('id_jenis_energi_detail',$id)
		->where('id_perusahaan',$idp)
		->from('t_pemakaian_energi');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_all(){
		$this->db->select('id_kegiatan,jenis_kegiatan')
		->where('Deleted','0')
		->from('tm_kegiatan')
		->order_by('jenis_kegiatan');
		$query = $this->db->get();
		return $query->result_array();
	}
}