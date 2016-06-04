<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subsektor extends CI_Controller {

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
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        $typeperusahaan = $this->session->userdata('type_perusahaan');
		$idperusahaan = $this->session->userdata('id_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->data['option_perusahaan'] = $this->perusahaan_model->get_perusahaan($idperusahaan);
		$this->data['data_type_perusahaan'] = $this->typeperusahaan_model->get_fordropdown();
		$this->data['data_satuan_produksi'] = $this->subsektor_model->get_fordropdownsatuan();
		foreach($this->data['option_perusahaan'] as $rowPerusahaan){
			$this->data['option_subsektor'] = $this->perusahaan_model->load_dd_subsek($rowPerusahaan['IdSubsektor']);
		}
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('inputsubsektor', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_subsektor = $this->input->post('id_subsektor') ;
		$subsektor = $this->input->post('subsektor');
 		$type_perusahaan = $this->input->post('type_perusahaan');
		$satuan_produksi = $this->input->post('satuan_produksi');

		$this->db->trans_start();
		if($id_subsektor != ''){
			$data = array(
				'IdMSubsektor' => $id_subsektor,
				'NamaSubsektor' => $subsektor,
				'MTypePerusahaan_IdMTypePerusahaan' => $type_perusahaan,
				'id_satuan_produksi'=>$satuan_produksi,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$this->subsektor_model->edit($id_subsektor,$data);
		}else{
			$data = array(
				'IdMSubsektor' => $id_subsektor,
				'NamaSubsektor' => $subsektor,
				'MTypePerusahaan_IdMTypePerusahaan' => $type_perusahaan,
				'id_satuan_produksi'=>$satuan_produksi,
				'Createdby' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$newid = $this->subsektor_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data jenis peralatan, silakan coba lagi.";
		}else{
			if($id_subsektor != ''){
				$status = "success";
				$msg = "Update data subsektor berhasil.";
			} else {
				$status = "success";
				$msg = "Input data subsektor berhasil.";
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
		$this->subsektor_model->edit($id,$data);
	}
	
	function listsubsektor(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$this->datatables->select('NamaSubsektor,c.nama_satuan_produksi,b.TypePerusahaan,IdMSubsektor', false)
			->where('a.Deleted',0)
			->from('tm_subsektor AS a ')
			->join('tm_typeperusahaan AS b', 'a.MTypePerusahaan_IdMTypePerusahaan = b.IdMTypePerusahaan')
			->join('tm_satuan_produksi AS c', 'a.id_satuan_produksi = c.id_satuan_produksi');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->subsektor_model->getById($id);
		echo json_encode($rowdata);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */