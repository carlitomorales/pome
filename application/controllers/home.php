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
		
		$this->data['message'] = "Silakan login untuk mengisi laporan.";
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
		$this->data['status'] = NULL;
		$this->load->view('kegiatan',$this->data);
	}
	
	public function save_event(){
		$status = '';
		$msg = '';
		$this->load->model('kegiatan_model');
		$tanggal = $this->input->post('tanggal');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$this->db->trans_start();
		$data = array(
			'title' => $title,
			'start_date' => $tanggal,
			'end_date' => $tanggal,
			'allday' => 0, 
			'description' => $description,
			'create_by' => $this->session->userdata('username'),
			'create_date' => date("Y-m-d H:i:s")
		);
		$newid = $this->kegiatan_model->insert($data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data kalender kegiatan.";
		}else{
			$status = "success";
			$msg = "Penyimpanan data kalender kegiatan berhasil.";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	public function save_edit_event(){
		$status = '';
		$msg = '';
		$this->load->model('kegiatan_model');
		$events_id = $this->input->post('events_id');
		$tanggal = $this->input->post('tanggal');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$this->db->trans_start();
		$data = array(
			'title' => $title,
			'start_date' => $tanggal,
			'end_date' => $tanggal,
			'allday' => 0, 
			'description' => $description,
			'update_by' => $this->session->userdata('username'),
			'update_date' => date("Y-m-d H:i:s")
		);
		$this->kegiatan_model->edit($events_id, $data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data kalender kegiatan.";
		}else{
			$status = "success";
			$msg = "Penyimpanan data kalender kegiatan berhasil.";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	public function add_event(){
		$this->load->view('inputkegiatan');
	}
	
	public function edit_event($id){
		$this->load->model('kegiatan_model');
		$this->data['kegiatan'] = $this->kegiatan_model->getbyid($id);
		$this->load->view('editkegiatan', $this->data);
	}
	
	public function delete_event($id){
		$status = '';
		$msg = '';
		$this->load->model('kegiatan_model');
		$this->db->trans_start();
		$kegiatan = $this->kegiatan_model->getbyid($id);
		foreach($kegiatan as $row){
			$tanggal = $row['start_date'];
		}
		$this->kegiatan_model->del($id);
		$this->data['kegiatan'] = $this->kegiatan_model->get_bydate($tanggal);
		$this->db->trans_complete();if($this->db->trans_status() === FALSE){
			$this->data['status'] = "error";
			$this->data['msg'] = "Terjadi kesalahan saat menghapus data kalender kegiatan.";
		}else{
			$this->data['status'] = "success";
			$this->data['msg'] = "Penghapusan data kalender kegiatan berhasil.";
		}
		$this->load->view('kegiatan',$this->data);
	}
	
	public function berita(){
		$this->load->model('berita_model');
		$this->data['berita'] = $this->berita_model->getTop10Published();
		$this->load->view('berita', $this->data);
	}
	
	public function detailberita($id){
		$this->load->model('berita_model');
		$this->data['berita'] = $this->berita_model->getById($id);
		$this->data['message'] = "Silakan login untuk mengisi laporan.";
		$this->load->view('detailberita', $this->data);
	}
	
	public function faq(){
		$this->load->model('faq_model');
		$this->load->view('faq');
	}
	
	public function faq_list(){
		$this->load->model('faq_model');
		$this->data['faq'] = $this->faq_model->getAll();
		$this->load->view('faq_list', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */