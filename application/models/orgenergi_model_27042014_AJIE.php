<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class orgenergi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function insertorgenergi($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrenergi', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	



}