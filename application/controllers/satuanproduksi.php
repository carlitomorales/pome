<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class satuanproduksi extends CI_Controller {

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
		$this->load->model('satuanproduksi_model');
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
		
        $typeperusahaan = $this->session->userdata('type_perusahaan');
		$idperusahaan = $this->session->userdata('id_perusahaan');
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('inputsatuanproduksi', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_satuan_produksi = $this->input->post('id_satuan_produksi') ;
		$satuan_produksi = $this->input->post('satuan_produksi');


		$this->db->trans_start();
		if($id_satuan_produksi != ''){
			$data = array(
				'id_satuan_produksi' => $id_satuan_produksi,
				'nama_satuan_produksi' => $satuan_produksi,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$this->satuanproduksi_model->edit($id_satuan_produksi,$data);
		}else{
			$data = array(
				'id_satuan_produksi' => $id_satuan_produksi,
				'nama_satuan_produksi' => $satuan_produksi,
				'Createdby' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$newid = $this->satuanproduksi_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data Satuan Produksi, silakan coba lagi.";
		}else{
			if($id_satuan_produksi != ''){
				$status = "success";
				$msg = "Update data Satuan Produksi berhasil.";
			} else {
				$status = "success";
				$msg = "Input data Satuan Produksi berhasil.";
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
		$this->satuanproduksi_model->edit($id,$data);
	}
	
	function listsatuanproduksi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$this->datatables->select('nama_satuan_produksi,id_satuan_produksi', false)
			->where('a.Deleted',0)
			->from('tm_satuan_produksi AS a ');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->satuanproduksi_model->getById($id);
		echo json_encode($rowdata);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */