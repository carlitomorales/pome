<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kegiatan_model extends CI_Model {
	
	public function get_kegiatan($start, $end)
	{
		$this->db->where('start_date BETWEEN FROM_UNIXTIME('.$start.') AND FROM_UNIXTIME('.$end.')');
		$query = $this->db->get('t_kegiatan');
		return $query->result_array();
	}
	
	public function get_bydate($tanggal)
	{
		$this->db->where('start_date',$tanggal);
		$query = $this->db->get('t_kegiatan');
		return $query->result_array();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_kegiatan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function getbyid($id){
		$this->db->where('events_id',$id);
		$query = $this->db->get('t_kegiatan');
		return $query->result_array();
	}
	
	public function edit($id, $data){
		$this->db->where('events_id',$id);
		$this->db->update('t_kegiatan',$data);		
		return true;
	}
	
	public function del($id){
		$this->db->where('events_id',$id);
		$this->db->delete('t_kegiatan');		
		return true;
	}
	public function get_all(){
		$this->db->select('id_kegiatan,jenis_kegiatan')
		->from('tm_kegiatan')
		->order_by('jenis_kegiatan');
		$query = $this->db->get();
		return $query->result_array();
	}
}