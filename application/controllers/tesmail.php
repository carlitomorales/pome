<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tesmail extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('encrypt');
	}
	
	public function index()
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'hosting.esdm.go.id',
			'smtp_port' => 25,
			'smtp_user' => 'no-reply@srv.ebtke.esdm.go.id',
			'smtp_pass' => 'no-reply',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->from('debiyulda@gmail.com', 'debi yulda');
		$this->email->to('musopotamia@gmail.com'); 
		$this->email->cc('angkrang111@gmail.com'); 


		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		if( $this->email->send())
        {
            echo "Mail sent!";
        }else{
            echo "Error";
        }


	}
}