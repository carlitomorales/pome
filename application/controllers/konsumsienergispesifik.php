<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class konsumsienergispesifik extends CI_Controller {

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
		$this->load->model('konsumsienergispesifik_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        $typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->load->view('inputkonsumsienergispesifik', $this->data);
	}
	
	function save(){
		$JmlPemakaianEnergi = $this->input->post('JmlPemakaianEnergi');
 		$Produksi = $this->input->post('Produksi');
		$KonsEnergiSpesifik = $this->input->post('KonsEnergiSpesifik');

		$this->db->trans_start();
		/*if($this->session->userdata('id_perusahaan') != ''){
			$data = array(
				'JmlPemakaianEnergi' => $JmlPemakaianEnergi,
				'Produksi' => $Produksi,
				'KonsEnergiSpesifik' => $KonsEnergiSpesifik,
				'TM_Perusahaan_IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->konsumsienergispesifik_model->edit($IdTKonsmsiEnrgSpsifikInd,$data);
		}else{*/
			$data = array(
				'JmlPemakaianEnergi' => $JmlPemakaianEnergi,
				'Produksi' => $Produksi,
				'JmlhKnsmsiEnrgiSpsfik' => $KonsEnergiSpesifik,
				'TM_Perusahaan_IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$newid = $this->konsumsienergispesifik_model->insert($data);
		//}		
		$this->db->trans_complete();
		redirect('konsumsienergispesifik/');
		return $newid;
	}
	
	function hapus($id){
		$this->db->trans_start();
		$this->konsumsienergispesifik_model->del($id);
		$this->db->trans_complete();
	}
	
	function listkonsumsienergispesifik(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y");
		$this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
			->where('id_perusahaan = '.$id_perusahaan)
			->from('vkons_energi_spesifik');
		echo $this->datatables->generate();
	}
	function listkonsumsienergispesifikbang(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y");
		$this->datatables->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
			->where('id_perusahaan = '.$id_perusahaan)
			->from('vkons_energi_spesifik_bang');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->konsumsienergispesifik_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */