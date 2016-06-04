<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class luasbangunan extends CI_Controller {

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
		$this->load->model('luasbangunan_model');
		$this->load->model('lihatlaporan_model');
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
		foreach($this->data['option_perusahaan'] as $rowPerusahaan){
			$this->data['option_subsektor'] = $this->perusahaan_model->load_dd_subsek($rowPerusahaan['IdSubsektor']);
			$this->data['data_satuan_produksi'] = $this->subsektor_model->get_fordropdownsatuanbysubsektor($rowPerusahaan['IdSubsektor']);
			
		}
		if($this->session->userdata('type_perusahaan') == "2")
		{ $this->load->view('inputluasbangunan', $this->data); }
		else { $this->load->view('no_access', $this->data); }
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_luas_bangunan = $this->input->post('id_luas_bangunan') ;
		$nama_bangunan = $this->input->post('nama_bangunan');
 		$luas_bangunan = $this->input->post('luas_bangunan');
		

		$this->db->trans_start();
		if($id_luas_bangunan != ''){
			$data = array(
				'id_luas_bangunan' => $id_luas_bangunan,
				'nama_bangunan' => $nama_bangunan,
				'luas_bangunan' => $luas_bangunan,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->luasbangunan_model->edit($id_luas_bangunan,$data);
		}else{
			$data = array(
			'id_luas_bangunan' => $id_luas_bangunan,
			'nama_bangunan' => $nama_bangunan,
			'luas_bangunan' => $luas_bangunan,
			'tahun' => date("Y")-1,
			'id_perusahaan' => $this->session->userdata('id_perusahaan'),
			'create_by' => $this->session->userdata('username'),
			'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->luasbangunan_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data luas bangunan, silakan coba lagi.";
		}else{
			$this->stepsubmit();
			$status = "success";
			$msg = "Penyimpanan data luas bangunan berhasil";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	public function stepsubmit()
	{
		$tahun = date("Y")-1;
		$id = $this->session->userdata('id_perusahaan');
		$this->db->trans_start();
		$this->db->from('t_statussubmit');
		$this->db->where('IdPerusahaan',$id);
		$this->db->where('tahun',$tahun);
		$count = $this->db->count_all_results();
		$this->db->trans_complete();
		
		
		if($count > 0){
		$data = array(
				'submit_step2' => '1'
			);
		$this->lihatlaporan_model->edit($id,$data);		
		}else{		
			$data = array(
					'IdPerusahaan' => $id,
					'submit_step2' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($data);		
		}
		

	
	}
	
	function hapus($id){
		$this->db->trans_start();
		$this->luasbangunan_model->del($id);
		$this->db->trans_complete();
	}
	
	function listluasbangunan(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('c.NamaSubsektor,nama_bangunan, luas_bangunan, id_luas_bangunan', false)
			->from('t_luas_bangunan AS a')
			->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
			->join('tm_subsektor AS c','b.IdSubsektor=c.IdMSubsektor')
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun);

		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->luasbangunan_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */