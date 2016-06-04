<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class berita_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function insert($data)
	{
		$this->db->insert('t_news', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function edit($id, $data)
	{
		$this->db->where('news_id',$id);
		$this->db->update('t_news',$data);		
		return true;
	}
	
	public function del($id)
	{
		$this->db->where('news_id',$id);
		$this->db->delete('t_news');		
		return true;
	}
	
	public  function getById($id){
		$this->db->where('news_id',$id);
		$query = $this->db->get('t_news');
		return $query->result_array();
	}
	
	function getTop10Published(){
		$sql = "SELECT news_id, title, sinopsis, publish_date, thumbnail FROM t_news WHERE publish_date <= NOW() ORDER BY publish_date DESC LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}