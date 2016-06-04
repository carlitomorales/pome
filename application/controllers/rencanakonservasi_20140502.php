<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencanakonservasi extends CI_Controller {

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

		if ($this->session->userdata('username') == ''){
			redirect('logout');
		}
		$this->data['menugroup'] = '1';
		$this->data['menugroup'] = '2';


		
		$this->load->model('typeperusahaan_model');
		$this->load->model('subsektor_model');
		$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		$this->load->model('perusahaan_model');
		$this->load->model('rencanakonservasi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->load->view('inputrencanakonservasi', $this->data);
	}
	
	function save(){
		$id_rencana_konservasi = $this->input->post('id_rencana_konservasi');
 		$kegiatan = $this->input->post('kegiatan');
		$target_gjoule = $this->input->post('target_gjoule');
		$target_persen = $this->input->post('target_persen');
		$keterangan = $this->input->post('keterangan');
		$this->db->trans_start();
		if($id_rencana_konservasi != ''){
			$data = array(
				'kegiatan' => $kegiatan,
				'target_gjoule' => $target_gjoule,
				'target_persen' => $target_persen,
				'keterangan' => $keterangan,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->rencanakonservasi_model->edit($id_rencana_konservasi,$data);
		}else{
			$data = array(
				'kegiatan' => $kegiatan,
				'target_gjoule' => $target_gjoule,
				'target_persen' => $target_persen,
				'keterangan' => $keterangan,
				'tahun' => date("Y"),
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->rencanakonservasi_model->insert($data);
		}		
		$this->db->trans_complete();
		return $newid;
	}
	
	function hapus($id){
		$this->db->trans_start();
		$this->rencanakonservasi_model->del($id);
		$this->db->trans_complete();
	}
	
	function get_list(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y");
		$this->datatables->select('kegiatan, target_gjoule, target_persen, keterangan, id_rencana_konservasi')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_rencana_konservasi');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->rencanakonservasi_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */