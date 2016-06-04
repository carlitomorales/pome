<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jenisproduksi extends CI_Controller {

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
		$this->load->model('jenisenergi_model');
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        $typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->load->view('inputjenisproduksi', $this->data);
	}
	
	function saveperalatanpemanfaatenergi(){
		$id_peralatan_pemanfaat_energi = $this->input->post('id_peralatan_pemanfaat_energi');
 		$id_jenis_peralatan = $this->input->post('id_jenis_peralatan');
		$jenis_peralatan_lain = $this->input->post('jenis_peralatan_lain');
		$id_jenis_energi = $this->input->post('id_jenis_energi');
		$jenis_energi_lain = $this->input->post('jenis_energi_lain');
		$original_unit = $this->input->post('original_unit');
		$konversi = $this->input->post('konversi');
		$gjoule = $this->input->post('gjoule');
		$this->db->trans_start();
		if($id_peralatan_pemanfaat_energi != ''){
			$data = array(
				'id_jenis_peralatan' => $id_jenis_peralatan,
				'jenis_peralatan_lain' => $jenis_peralatan_lain,
				'id_jenis_energi' => $id_jenis_energi,
				'jenis_energi_lain' => $jenis_energi_lain,
				'original_unit' => $original_unit,
				'konversi' => $konversi,
				'gjoule' => $gjoule,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->peralatanpemanfaatenergi_model->edit($id_peralatan_pemanfaat_energi,$data);
		}else{
			$data = array(
				'id_jenis_peralatan' => $id_jenis_peralatan,
				'jenis_peralatan_lain' => $jenis_peralatan_lain,
				'id_jenis_energi' => $id_jenis_energi,
				'jenis_energi_lain' => $jenis_energi_lain,
				'original_unit' => $original_unit,
				'konversi' => $konversi,
				'gjoule' => $gjoule,
				'tahun' => date("Y"),
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->peralatanpemanfaatenergi_model->insert($data);
		}		
		$this->db->trans_complete();
		return $newid;
	}
	
	function hapus($id){
		$this->db->trans_start();
		$this->peralatanpemanfaatenergi_model->del($id);
		$this->db->trans_complete();
	}
	
	function listperalatanpemanfaatenergi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y");
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, b.JenisEnergi as JenisEnergi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, b.Satuan AS Satuan', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
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