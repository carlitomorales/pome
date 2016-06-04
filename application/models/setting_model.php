<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class setting_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function get_all() {
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	public function getbyusername($id)
	{
		$this->db->where('user_name',$id);
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	public function getbyemailperusahaan($id)
	{
		$this->db->where('email_perusahaan',$id);
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	function get_login($user_name,$pwd) {
		$this->db->where('user_name', $user_name);
		$this->db->where('password', $pwd);
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	public function insert($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('tm_user', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($user_name, $data)
	{
		$this->db->trans_start();
		$this->db->where('user_name', $user_name);
		$this->db->update('tm_user', $data);
		$this->db->trans_complete();
	}
	
	public function del($user_name)
	{
		$this->db->trans_start();
		$this->db->where('user_name', $user_name);
		$this->db->delete('tm_user');
		$this->db->trans_complete();
	}

}