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
}