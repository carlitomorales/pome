<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

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
		$this->data['menugroup'] = 1;
		$this->data['menugroup'] = 2;
		$this->load->model('typeperusahaan_model');
		$this->load->model('subsektor_model');
		$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		$this->load->model('perusahaan_model');
	}
	
	public function index()
	{
	
		$this->load->view('Perusahaan', $this->data);
	}
	public function add()
	{
        $username = $this->session->userdata('username');
		//Dropdown master 
		$this->data['data_type_perusahaan'] = $this->typeperusahaan_model->get_fordropdown($username);
		$this->data['data_subsektorlain'] = $this->perusahaan_model->getSubsektorLain();
		
		//$this->data['data_subsektor'] = $this->subsektor_model->get_fordropdown();
		$this->data['option_propinsi'] = $this->mchain_model->getPropinsiList();
		$this->data['cekinfo'] = $this->perusahaan_model->getInfoPerusahaan($username);
		//$idperusahaan=$this->session->userdata('id_perusahaan');
		//$loaddata = $this->perusahaan_model->load_data_perusahaan($idperusahaan);
		
		//$this->data['IdNamaPerusahaan']=$loaddata['NamaPerusahaan'];
		//$this->data['IdTypePerusahaan']=$loaddata['TypePerusahaan'];
		//$this->data['IdSubsektor']=$loaddata['Subsektor'];
		//$this->data['IdAlamat']=$loaddata['AlamatPerusahaan'];
		//$this->data['IdProvinsi']=$loaddata['Prov'];
		//$this->data['IdKota']=$loaddata['KotaKab'];
		//$this->data['IdNoTelepon']=$loaddata['NoTelp'];
		//$this->data['IdNoFax']=$loaddata['NoFax'];
		//$this->data['IdThnAwal']=$loaddata['ThnAwalOp'];
		//$this->data['IdJumKar']=$loaddata['JmlKaryawan'];
			
		$this->load->view('InputPerusahaan', $this->data);

	
	}
	function loadForm($idperusahaan){
		$rowdata = $this->perusahaan_model->load_data_perusahaan($idperusahaan);
		echo json_encode($rowdata);
	}
	function load_dd_prov($namaprov){
		$newnamaprov=urldecode($namaprov);
		$rowdd = $this->perusahaan_model->load_dd_prov($newnamaprov);
		echo json_encode($rowdd);
	}
	function load_dd_subsek($idsubsek){
		$rowdd = $this->perusahaan_model->load_dd_subsek($idsubsek);
		echo json_encode($rowdd);
	}
	function load_dd_kotakab($namakotkab){
		$newnamakotkab=urldecode($namakotkab);
		$rowdd = $this->perusahaan_model->load_dd_kotakab($newnamakotkab);
		echo json_encode($rowdd);
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
	function save(){
		$status = "";
		$msg = "";
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$data = $this->typeperusahaan_model->getTypePerusahaanbyid($this->input->post('IdTypePerusahaan'));
			foreach($data as $row){
				$typeperusahaanrow = $row['TypePerusahaan'];
				$idtypeperusahaanrow = $row['IdMTypePerusahaan'];
			}
			$typeperusahaan=$typeperusahaanrow;
			$idtypeperusahaan=$idtypeperusahaanrow;
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
		
		$nama_perusahaan = $this->input->post('IdNamaPerusahaan');
		$alamat = $this->input->post('IdAlamat');
		$notelp = $this->input->post('IdNoTelepon');
		$kodepos = $this->input->post('IdKodePos');
		$nofax = $this->input->post('IdNoFax');
		$thnawalop = $this->input->post('IdThnAwal');
		$jumkar = $this->input->post('IdJumKar');
		$idsubsektor = $this->input->post('IdSubsektor');
		$idsubsektorlain = $this->input->post('IdSubsektorLain');
		
		
		
		$this->db->trans_start();
		if($id_perusahaan != ''){
			$data = array(
				'NamaPerusahaan' => $nama_perusahaan,
				'TypePerusahaan' => $typeperusahaan,
				'IdSubsektor' => $idsubsektor,
				'SubsektorLain' => $idsubsektorlain,
				'AlamatPerusahaan'  => $alamat,
				'Prov' => $propinsi,
				'KotaKab'  => $kotakab,
				'NoTelp'  => $notelp,
				'KodePos'  => $kodepos,
				'NoFax'  => $nofax,
				'ThnAwalOp' => $thnawalop,
				'JmlKaryawan' => $jumkar,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$this->perusahaan_model->edit($id_perusahaan,$data);
			if ( $idtypeperusahaan !=$this->session->userdata('type_perusahaan'))
			{
				$this->session->unset_userdata('type_perusahaan');
				$this->session->set_userdata('type_perusahaan',$idtypeperusahaan);
			}
		}else{
			$data = array(
				'NamaPerusahaan' => $nama_perusahaan,
				'TypePerusahaan' => $typeperusahaan,
				'IdSubsektor' => $idsubsektor,
				'SubsektorLain' => $idsubsektorlain,
				'AlamatPerusahaan'  => $alamat,
				'Prov' => $propinsi,
				'KotaKab'  => $kotakab,
				'NoTelp'  => $notelp,
				'KodePos'  => $kodepos,
				'NoFax'  => $nofax,
				'ThnAwalOp' => $thnawalop,
				'JmlKaryawan' => $jumkar,
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$newid = $this->perusahaan_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data profile perusahaan, silakan coba lagi.";
		}else{
			if($id_perusahaan != ''){
				$status = "success";
				$msg = "Update data profile perusahaan berhasil.";
			} else {
				$status = "success";
				$msg = "Input data profile perusahaan berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
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
			redirect('Perusahaan/add');
		//}else{
			//$this->load->view('no_access', $this->data);
		//}
	}




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */