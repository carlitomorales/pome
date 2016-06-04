<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jenisenergi extends CI_Controller {

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
		$this->data['menugroup'] = '3';
		$this->data['module_id'] = '6';
		$this->load->model('User_model');
		$this->load->model('Privilege_model');
			
		
		$this->load->model('typeperusahaan_model');
		$this->load->model('subsektor_model');
		$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		$this->load->model('perusahaan_model');
		$this->load->model('jenisenergi_model');
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
		$this->load->model('jenisproduksi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        	
		
		$this->load->view('viewjenisenergi', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$idjenisenergi = $this->input->post('idjenisenergi') ;
		$JnsEnergi = $this->input->post('jenis_energi');
		$Satuan = $this->input->post('satuan');

		$this->db->trans_start();
		$data = array(
				'idjenisenergi' => $idjenisenergi,
				'jenisenergi' => $JnsEnergi,
				'satuan' => $Satuan,
				'DateCreated' => date("Y-m-d H:i:s"),
				'CreatedBy' => 	$this->session->userdata('username')
			);
			$this->jenisenergi_model->insert($data);
		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data jenis energi, silakan coba lagi.";
		}else{
			if($id_jenis_produksi != ''){
				$status = "success";
				$msg = "Update data jenis energi berhasil.";
			} else {
				$status = "success";
				$msg = "Input data jenis energi berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
		
		
	}
	
	function hapus($id){
		
		$this->db->trans_start();
		$data = array('deleted' => '1');
		$this->db->where('IdJenisEnergi', $id);
		$this->db->update('tm_jenisenergi', $data);
		$this->db->trans_complete();
	}
	
	function listjenisenergi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('JenisEnergi,Satuan,IdJenisEnergi', false)
			->where('deleted <> 1')
			->from('tm_jenisenergi');
		echo $this->datatables->generate();
			
	}
	
	function getDetail($id){
		$rowdata = $this->jenisenergi_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */