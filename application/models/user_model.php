<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	public function getbyusername($id)
	{
		$this->db->where('user_name',$id);
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	function get_login($user_name,$pwd) {
		$this->db->where('user_name', $user_name);
		$this->db->where('password', $pwd);
		$query = $this->db->get('tm_user');
		return $query->result_array();
	}
	
	public function getpesanbyid($id,$username)
	{
		$this->db->select('message');
		$this->db->from('t_pesan');// I use aliasing make joins easier 
		
		$this->db->where('id_pesan',$id);
		$this->db->where('sendto',$username);
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
	public function getbyid($id)
	{
		$this->db->where('user_name',$id);
		$query = $this->db->get('tm_user');
		if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
	
	public  function getallbyidperusahaan($data,$idp){
		$this->db->select('*')
		->from('tm_user')		
		->where('Idperusahaan',$idp);
		$query = $this->db->get();
		
		 if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
		
		//return $query->result();
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
	public function insertpesan($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_pesan', $data);
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
	public function updateReadPesan($idPesan,$username,$data)
	{
		$this->db->trans_start();
		$this->db->where('id_pesan', $idPesan);
		$this->db->where('sendto', $username);
		$this->db->update('t_pesan', $data);
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