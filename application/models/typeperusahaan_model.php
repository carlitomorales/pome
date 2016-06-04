<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class typeperusahaan_model extends CI_Model {
	public function __construct()
	{
		//$this->load->database();
	}

	
	public function get_fordropdown()
	{
		$this->db->select('IdMTypePerusahaan,TypePerusahaan');
		$this->db->where('Deleted','0');
		$this->db->order_by('TypePerusahaan','ASC');
		$query = $this->db->get('tm_typeperusahaan');
		
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
}