<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Privilege_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function get_all() {
		$query = $this->db->get('tm_privilege');
		return $query->result_array();
	}
	
	public function getbyid($id){
		$this->db->where('privilege_id',$id);
		$query = $this->db->get('tm_privilege');
		return $query->result_array();
	}
	
	public function insert($data)
	{
		//insert to master
		$this->db->insert('tm_privilege', $data);
		$id = $this->db->insert_id();
		
		//commit
		
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($privilege_id, $data)
	{
		$this->db->where('privilege_id', $privilege_id);
		$this->db->update('tm_privilege', $data);
	}
	
	public function del($privilege_id)
	{
		$this->db->where('privilege_id', $privilege_id);
		$this->db->delete('tm_privilege');
	}
	
	public function delprivilegemodule($privilege_id)
	{
		$this->db->where('privilege_id', $privilege_id);
		$this->db->delete('tm_privilege_module_access');
	}
	
	public function insertprivilegemodule($data)
	{
		$this->db->insert('tm_privilege_module_access', $data);
		
		return true;
	}
	
	public function getprivilegemodule($privilegeid){
		$sql = "SELECT group_name, module_id, module_name, (SELECT `add` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `add`, (SELECT `edit` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `edit`, (SELECT `delete` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `delete`, (SELECT `approve` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `approve`, (SELECT `list` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `list`, (SELECT `view` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `view`, (SELECT `print` FROM tm_privilege_module_access WHERE privilege_id=? AND module_id=m.module_id)
AS `print` 
FROM tm_module AS m
ORDER BY group_id";
		$query = $this->db->query($sql, array($privilegeid, $privilegeid, $privilegeid, $privilegeid, $privilegeid, $privilegeid, $privilegeid));
		return $query->result_array();
	}
	
	function get_privilege_add($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `add` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['add'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_list($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `list` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['list'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_view($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `view` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['view'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_edit($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `edit` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['edit'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_delete($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `delete` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['delete'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_approve($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `approve` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['approve'];
		}
		else
		{
			return 0;
		}
	}
	
	function get_privilege_print($privilege_id, $module_id)
	{
		if($privilege_id == 0)
		{
			return 1;
		}
		$sql = "SELECT `print` FROM tm_privilege_module_access WHERE privilege_id = ? AND module_id = ?";
		$query = $this->db->query($sql, array($privilege_id, $module_id));
		if($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['print'];
		}
		else
		{
			return 0;
		}
	}
	
}