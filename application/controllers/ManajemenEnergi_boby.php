<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ManajemenEnergi extends CI_Controller {

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
		
	}
	
	public function index()
	{
		
		$this->load->view('Perusahaan', $this->data);
	}
	public function addind()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->get_fordropdown();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('InputTrxIndustri', $this->data);
	
	}
	public function addkom()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->get_fordropdown();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('InputTrxKomersial', $this->data);
	
	}
	public function select_kota(){
            if('IS_AJAX') {
        		$this->data['option_kota'] = $this->mchain_model->getKotaList();		
				$this->load->view('kota', $this->data);
            }
		
	}
	public function select_subsektor(){
            if('IS_AJAX') {
        		$this->data['option_subsektor'] = $this->mchain_model->getSubsektorList();		
				$this->load->view('subsektor', $this->data);
            }
		
	}
	public function get_list()
	{
		$this->datatables->select("IdPerusahaan,TypePerusahaan,NamaPerusahaan,ALamatPerusahaan,Subsektor", false)
			->from('tm_perusahaan')
			->where('deleted','0');
		echo $this->datatables->generate();
	}
	public function add_save()
	{
		//if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		//{
			$data = $this->typeperusahaan_model->getTypePerusahaanbyid($this->input->post('IdTypePerusahaan'));
				foreach($data as $row){
					$typeperusahaanrow = $row['TypePerusahaan'];
				}
				$typeperusahaan=$typeperusahaanrow;
			$data1 = $this->mchain_model->getSubsektorbyid($this->input->post('IdTypePerusahaan'),$this->input->post('IdSubsektor'));
				foreach($data1 as $row1){
					$namasubsektorrow = $row1['NamaSubsektor'];
				}
				$namasubsektor=$namasubsektorrow;
			$data2 = $this->mchain_model->getPropinsibyid($this->input->post('IdProvinsi'));
				foreach($data2 as $row2){
					$propinsirow = $row2['propinsi'];
				}
			$propinsi=$propinsirow;
			$data3 = $this->mchain_model->getKotabyid($this->input->post('IdProvinsi'),$this->input->post('IdKota'));
				foreach($data3 as $row3){
					$kotakabrow = $row3['kota_kabupaten'];
				}			
				$kotakab=$kotakabrow;
			
			$this->db->trans_start();
			$data = array(
				'NamaPerusahaan' => $this->input->post('IdNamaPerusahaan'),
				'TypePerusahaan' => $typeperusahaan,
				'Subsektor' => $namasubsektor,
				'AlamatPerusahaan' => $this->input->post('IdAlamat'),
				'Prov' => $propinsi,
				'KotaKab' => $kotakab,
				'NoTelp' => $this->input->post('IdNoTelepon'),
				'NoFax' => $this->input->post('IdNoFax'),
				'ThnAwalOp' => $this->input->post('IdThnAwal'),
				'JmlKaryawan' => $this->input->post('IdJumKar'),
				//'OrgMgmntEnergi' => $this->input->post('IdOrgManajEnergi'),
				//'PathFileOrg' => $this->input->post('IdFileOrg'),
				//'MgrEnergi' => $this->input->post('IdManajEnergi'),
				//'NamaMgrEnrgi' => $this->input->post('IdNamaManaj'),
				//'EmailMgrEnrgi' => $this->input->post('IdEmailManaj'),
				//'NoTlpMgrEnrgi' => $this->input->post('IdNoManaj'),
				//'NoSrtifikatMgr' => $this->input->post('IdNoSertifikat'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$perusahaanid = $this->perusahaan_model->insert($data);
			if ($this->input->post('IdLainLain') != '') {
				$this->perusahaan_model->deletelainsubsektor($perusahaanid,$this->input->post('IdSubsektor'));
				$lainlainid = $this->input->post('IdLainLain');
				for($i=0;$i < count($lainlainid);$i++){	
					$lain = array(
						'M_Perusahaan_IdPerusahaan' => $perusahaanid,
						'M_Subsektor_IdMSubsektor' => $this->input->post('IdSubsektor'),
						'LainLain' => $this->input->post('IdLainLain'),
						'CreatedBy' => $this->session->userdata('username'),
						'DateCreated' => date("Y-m-d H:i:s")
					);
					$this->Perusahaan_model->insertlainsubsektor($lain);	
				}
			}
			$this->db->trans_complete();
			redirect('Perusahaan');
		//}else{
			//$this->load->view('no_access', $this->data);
		//}
	}

	function step5(){
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('inputperalatanpemanfaatenergi', $this->data);
	}
	
	function step6(){
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('inputkegiatankonservasienergi', $this->data);
	}
	
	function step7(){
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('inputrencanakegiatankonservasienergi', $this->data);
	}
	
	function step8(){
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		//$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->load->view('inputauditenergi', $this->data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */