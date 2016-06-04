<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()
	{
		$this->data['message'] = "Please login with your Username and Password.";
		$this->load->view('dashboard', $this->data);
	}
	
	public function getevents()
	{
		$start = $_GET['start'];
		$end = $_GET['end'];
		$this->load->model('kegiatan_model');
		$kegiatan = $this->kegiatan_model->get_kegiatan($start, $end);
		$arrkegiatan = array();
		foreach($kegiatan as $row){
			$arrkegiatan[] = array(
				"id" => $row['events_id'],
				"title" => $row['title'],
				"start" => $row['start_date'],
				"end" => $row['end_date'],
				"allDay" => $row['allday']
			);
		}
		echo json_encode($arrkegiatan);
	}
	
	public function listeventsbydate($tanggal){
		$this->load->model('kegiatan_model');
		$kegiatan = $this->kegiatan_model->get_bydate($tanggal);
		$this->data['kegiatan'] = $kegiatan;
		$this->load->view('kegiatan',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */