<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class trxindustri_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function inserttrxindustri($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrenergi', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	

	public function inserttrxindustri_step2($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrjenisprod', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	
	
	public function inserttrxindustri_step3($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrjenisenergi', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	

public function inserttrxindustri_step4($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrkonsenerspesifik', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	

}