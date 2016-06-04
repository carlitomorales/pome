<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pemakaianenergi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		
		$this->db->insert('t_pemakaian_energi', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		

		
		$this->db->where('id_pemakaian_energi',$id);
		$this->db->update('t_pemakaian_energi',$data);		
                $this->db->trans_complete();
		return true;
	}
	
	public function del($id)
	{
		$tahun = date("Y")-1;		
		$this->db->trans_start();
		$this->db->from('t_peralatan_pemanfaat_energi as a ');
		$this->db->join('t_pemakaian_energi as b', 'a.id_perusahaan = b.id_perusahaan and a.tahun = b.tahun and a.id_jenis_energi = b.id_jenis_energi and a.id_jenis_energi_detail = b.id_jenis_energi_detail');
		$this->db->where('b.id_pemakaian_energi',$id);
		$this->db->where('a.tahun',$tahun);
		$count = $this->db->count_all_results();
		
		$this->db->trans_complete();
			
		if($count == '0'){
			$this->db->where('id_pemakaian_energi',$id);
			$this->db->delete('t_pemakaian_energi');		
			
			$this->session->set_userdata('msg_del_energi','delete jenis energi, sukses.');		
			return true;
		}else{		
			$msg = 'maaf, jenis energi ini tidak bisa di delete. untuk menghapus jenis energi ini harap delete terlebih dahulu peralatan pemanfaat energi utama yang menggunakan jenis energi ini.';		
			echo json_encode(array("msg"=>$msg));
		}
		
		
		

		
	}
	
	public  function getById($id){
		$this->db->select('id_pemakaian_energi, id_jenis_energi, id_jenis_energi_detail, jenis_energi_lain, original_unit, konversi, gjoule, tahun, id_perusahaan, Satuan')
		->from('t_pemakaian_energi')
		->join('tm_jenisenergi', 't_pemakaian_energi.id_jenis_energi=tm_jenisenergi.IdJenisEnergi')
		->where('tahun', date("Y") - 1)
		->where('id_pemakaian_energi',$id);
		$query = $this->db->get();
		return $query->result();
	}
		function load_dd_energidetail($idenergidetail) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->select('id_jenis_energi_detail,detail_jenis_energi');
		$this->db->where('id_jenis_energi_detail',$idenergidetail);
		$this->db->order_by('detail_jenis_energi','ASC');
		$query = $this->db->get('tm_jenisenergidetail');
		
		if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
}