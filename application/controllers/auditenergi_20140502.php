<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditenergi extends CI_Controller {

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
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		 $typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->load->view('inputauditenergi', $this->data);
	}
	
	function save(){
		$id_peralatan_pemanfaat_energi = $this->input->post('id_peralatan_pemanfaat_energi');
		$status_audit = $this->input->post('status_audit');
		$keterangan_audit = $this->input->post('keterangan_audit');
		$this->db->trans_start();
		$data = array(
			'status_audit' => $status_audit,
			'keterangan_audit' => $keterangan_audit,
			'update_by' => $this->session->userdata('username'),
			'update_date' => date("Y-m-d H:i:s")
		);
		$this->peralatanpemanfaatenergi_model->edit($id_peralatan_pemanfaat_energi,$data);
		$this->db->trans_complete();
		return $newid;
	}
	
	function get_list(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y");
		$this->datatables->select('c.JenisPeralatan as `jenis_peralatan`, a.jenis_peralatan_lain, a.status_audit, a.keterangan_audit, a.id_peralatan_pemanfaat_energi as `id_peralatan_pemanfaat_energi`')
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->peralatanpemanfaatenergi_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */