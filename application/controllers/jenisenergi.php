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
			$this->load->view('inputjenisenergi', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	function report()
	{	
	
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('reportjenisenergi', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_jenis_energi = $this->input->post('id_jenis_energi') ;
		$Jnsenergi = $this->input->post('jenis_energi');
 		$satuan = $this->input->post('satuan');


		$this->db->trans_start();
		if($id_jenis_energi != ''){
			$data = array(
				'IdJenisEnergi' => $id_jenis_energi,
				'JenisEnergi' => $Jnsenergi,
				'Satuan' => $satuan,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$this->jenisenergi_model->edit($id_jenis_energi,$data);
		}else{
			$data = array(
				'IdJenisEnergi' => $id_jenis_energi,
				'JenisEnergi' => $Jnsenergi,
				'Satuan' => $satuan,
				'Createdby' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$newid = $this->jenisenergi_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data jenis energi, silakan coba lagi.";
		}else{
			if($id_jenis_energi != ''){
				$status = "success";
				$msg = "Update data jenis energi berhasil.";
			} else {
				$status = "success";
				$msg = "Input data jenis energi berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function savedetail(){
		$status = "";
		$msg = "";
		$IdJenisEnergi = $this->input->post('id_jenis_energi');
		$id_jenis_energi_detail = $this->input->post('id_jenis_energi_detail') ;
		$detail_jenis_energi = $this->input->post('detail_jenis_energi');
 		$faktor_emisi = $this->input->post('faktor_emisi');
		

		$this->db->trans_start();
		if($id_jenis_energi_detail != ''){
			$data = array(
				'id_jenis_energi_detail' => $id_jenis_energi_detail,
				'IdJenisEnergi'=> $IdJenisEnergi,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi
			);
			$this->jenisenergi_model->editdetail($id_jenis_energi_detail,$data);
		}else{
			$data = array(
				'id_jenis_energi_detail' => $id_jenis_energi_detail,
				'IdJenisEnergi'=> $IdJenisEnergi,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi
			);
			$newid = $this->jenisenergi_model->insertdetail($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data detail jenis energi, silakan coba lagi.";
		}else{
			if($id_jenis_energi_detail != ''){
				$status = "success";
				$msg = "Update data detail jenis energi berhasil.";
			} else {
				$status = "success";
				$msg = "Input data detail jenis energi berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function hapus($id){
		$data = array(
				'Deleted' => 1,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
		$this->jenisenergi_model->edit($id,$data);
	}
	function detailjenisenergi(){
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$id_jenisenergi = $this->input->get('id');
			$this->data['id_jenisenergi'] = $id_jenisenergi;
			$this->load->view('inputjenisenergidetail', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function listjenisenergi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$this->datatables->select('JenisEnergi,Satuan,IdJenisEnergi,urutan')
			->where('Deleted <> 1')
			->from('tm_jenisenergi');
		echo $this->datatables->generate();
	}
	function listdetailjenisenergi(){
		$id_jenisenergi = $this->input->get('id');
		$this->datatables->select('JenisEnergi,detail_jenis_energi,faktor_emisi,id_jenis_energi_detail')
			->from('tm_jenisenergi as a')
			->join('tm_jenisenergidetail as b','a.IdJenisEnergi=b.IdJenisEnergi')
			->where('Deleted <> 1')
			->where('a.IdJenisEnergi',$id_jenisenergi);
		echo $this->datatables->generate();
	}
	function getDetail($id){
		$rowdata = $this->jenisenergi_model->getById($id);
		echo json_encode($rowdata);
	}
	function getDetailenergi($id){
		$rowdata = $this->jenisenergi_model->getByIdEnergiDetail($id);
		echo json_encode($rowdata);
	}
	function savetocsv()
	{
		
		$this->load->dbutil();
		$this->load->helper('download');
		$query = $this->db->query("SELECT * FROM tm_jenisenergi");
		$data = $this->dbutil->csv_from_result($query, ',');
		force_download('CSV_Report.csv', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */