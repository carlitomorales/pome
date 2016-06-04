<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class rencanakonservasinew_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_rencana_konservasi_new', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function insertLain($data)
	{
		$this->db->insert('t_rencana_konservasi_lain', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function edit($id, $data)
	{
		$this->db->where('id_rencana_konservasi',$id);
		$this->db->update('t_rencana_konservasi_new',$data);		
		return true;
	}
	public function editLain($id, $data)
	{
		$this->db->where('id_rencana_konservasi_lain',$id);
		$this->db->update('t_rencana_konservasi_lain',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('id_rencana_konservasi',$id);
		$this->db->delete('t_rencana_konservasi_new');		
		return true;
	}
	public function delLain($id)
	{
		$this->db->where('id_rencana_konservasi_lain',$id);
		$this->db->delete('t_rencana_konservasi_lain');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('id_rencana_konservasi',$id);
		$query = $this->db->get('t_rencana_konservasi_new');
		return $query->result();
	}
	public  function getByIdLain($id){
		$this->db->where('id_rencana_konservasi_lain',$id);
		$query = $this->db->get('t_rencana_konservasi_lain');
		return $query->result();
	}
	public function get_fordropdowndetail()
	{
		$this->db->select('id_kegiatan, jenis_kegiatan');
		$this->db->from('tm_kegiatan');// I use aliasing make joins easier 
		$this->db->where('Deleted <> ','1');

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
	public function get_fordropdowndetaillain()
	{
		$this->db->select('id_kegiatan, jenis_kegiatan');
		$this->db->from('tm_kegiatan_lain');// I use aliasing make joins easier 
		$this->db->where('Deleted <> ','1');

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
	
	public  function getFaktorEmisiDetail($id,$idp){
		$this->db->select('b.faktor_emisi');
		$this->db->from('t_peralatan_pemanfaat_energi AS a');
		$this->db->join('tm_jenisenergidetail as b','a.id_jenis_energi_detail = b.id_jenis_energi_detail', 'INNER');
		$this->db->where('a.id_perusahaan',$idp);
		$this->db->where('a.id_peralatan_pemanfaat_energi',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getKonservasiByIdPeralatanPemanfaat($id,$idp){
		$this->db->select('d.JenisEnergi,e.detail_jenis_energi,e.faktor_emisi,b.konversi,c.JenisPeralatan,b.gjoule');

		$this->db->from('t_peralatan_pemanfaat_energi as b');
		$this->db->join('tm_jenisperalatan as c','b.id_jenis_peralatan=c.IdJenisPeralatan','inner');
		$this->db->join('tm_jenisenergi as d','b.id_jenis_energi=d.IdJenisEnergi','inner');
		$this->db->join('tm_jenisenergidetail as e','b.id_jenis_energi_detail=e.id_jenis_energi_detail','inner');
		$this->db->where('b.id_peralatan_pemanfaat_energi',$id);
		$this->db->where('b.id_perusahaan',$idp);
		$query = $this->db->get();
		return $query->result();
	}
}