<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class activation extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/Aktifasi_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		
		
	}
		
	public function index()
	{
	
	
		$activate =  $_SERVER['QUERY_STRING'];
		
		$data = array ('active' => 1);
		$this->db->trans_start();
		$this->db->where('password', $activate);
		$this->db->update('tm_user', $data);
		$this->db->trans_complete();
		
		$this->data['message'] = "Activation Success, Silahkan Login dan rubah password anda.";
		$this->load->view('login', $this->data);
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */