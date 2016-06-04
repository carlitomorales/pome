<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pemakaianenergi extends CI_Controller {

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
		$this->load->model('pemakaianenergi_model');
		$this->load->model('lihatlaporan_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
        $typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->load->view('inputpemakaianenergi', $this->data);
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_pemakaian_energi = $this->input->post('id_pemakaian_energi');
 		//$id_jenis_peralatan = $this->input->post('id_jenis_peralatan');
		//$jenis_peralatan_lain = $this->input->post('jenis_peralatan_lain');
		$id_jenis_energi = $this->input->post('id_jenis_energi');
		$id_jenis_energi_detail = $this->input->post('jenis_energi_detail');	
		$jenis_energi_lain = $this->input->post('jenis_energi_lain');		
		$original_unit = $this->input->post('original_unit');
		$konversi = $this->input->post('konversi');
		$gjoule = $this->input->post('gjoule');
		$this->db->trans_start();
		if($id_pemakaian_energi != ''){
			$data = array(
				//'id_jenis_peralatan' => $id_jenis_peralatan,
				//'jenis_peralatan_lain' => $jenis_peralatan_lain,
				'id_jenis_energi' => $id_jenis_energi,
				'id_jenis_energi_detail' => $id_jenis_energi_detail,
				'jenis_energi_lain' => $jenis_energi_lain,
				'original_unit' => $original_unit,
				'konversi' => $konversi,
				'gjoule' => $gjoule,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->pemakaianenergi_model->edit($id_pemakaian_energi,$data);
		}else{
			$data = array(
				//'id_jenis_peralatan' => $id_jenis_peralatan,
				//'jenis_peralatan_lain' => $jenis_peralatan_lain,
				'id_jenis_energi' => $id_jenis_energi,
				'id_jenis_energi_detail' => $id_jenis_energi_detail,
				'jenis_energi_lain' => $jenis_energi_lain,
				'original_unit' => $original_unit,
				'konversi' => $konversi,
				'gjoule' => $gjoule,
				'tahun' => date("Y")-1,
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->pemakaianenergi_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data pemakaian energi, silakan coba lagi.";
		}else{
			$this->stepsubmit();
			$status = "success";
			$msg = "Penyimpanan data pemakaian energi berhasil";
		}
		
		$tahun = date("Y")-1;
		$id = $this->session->userdata('id_perusahaan');
		$this->db->trans_start();
		$this->db->from('t_statussubmit');
		$this->db->where('IdPerusahaan',$id);
		$this->db->where('tahun',$tahun);
		$count = $this->db->count_all_results();
		
		
				//echo $tahun.' count :'.$count;
		if($count > 0){
		$datasubmit = array(
				'submit_step5' => '1'
			);
		$this->lihatlaporan_model->edit($id,$datasubmit);		
		}else{		
			$datasubmit = array(
					'IdPerusahaan' => $id,
					'submit_step5' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($datasubmit);		
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
				'submit_step3' => '1'
			);
		$this->lihatlaporan_model->edit($id,$data);		
		}else{		
			$data = array(
					'IdPerusahaan' => $id,
					'submit_step3' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($data);		
		}
		

	
	}
	
	function hapus($id){
		
			$this->db->trans_start();
			$this->pemakaianenergi_model->del($id);
			$this->db->trans_complete();
			
			
			
	}
	
	function listpemakaianenergi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
	
		$this->datatables->select('b.JenisEnergi as JenisEnergi, c.detail_jenis_energi as detail_jenis_energi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_pemakaian_energi as id_pemakaian_energi, b.Satuan AS Satuan, c.faktor_emisi', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_pemakaian_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi','INNER')
			->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail=c.id_jenis_energi_detail','INNER');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->pemakaianenergi_model->getById($id);
		echo json_encode($rowdata);
	}
	function getSatuanJenisEnergi($id){
		$rowdata = $this->jenisenergi_model->getSatuan($id);
		echo json_encode($rowdata);
	}
	public function select_energi_detail(){
            if('IS_AJAX') {
        		$this->data['option_jenis_energi_detail'] = $this->mchain_model->getJenisEnergiDetailList();		
				$this->load->view('jenisenergidetail', $this->data);
            }
		
	}
	function load_dd_energidetail($idenergidetail){
		$rowdd = $this->pemakaianenergi_model->load_dd_energidetail($idenergidetail);
		echo json_encode($rowdd);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */