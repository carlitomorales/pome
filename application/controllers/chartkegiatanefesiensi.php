<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartkegiatanefesiensi extends CI_Controller {

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
		$typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['subsektor'] = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$idperusahaan = $this->session->userdata('id_perusahaan');
		$this->data['option_perusahaan'] = $this->perusahaan_model->get_perusahaan($idperusahaan);
		foreach($this->data['option_perusahaan'] as $rowPerusahaan){
			$this->data['option_subsektor'] = $this->perusahaan_model->load_dd_subsek($rowPerusahaan['IdSubsektor']);
			
			
		}
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->load->view('chartkegiatanefesiensi', $this->data);
	}
	
	public function getlinedata(){
		$tahun = $this->input->get('tahun');
		$sql = "SELECT DISTINCT jenis_kegiatan FROM t_kegiatan_konservasi_new WHERE tahun=".$tahun;
		//echo $sql;exit;
		$query = $this->db->query($sql);
		$jeniskegiatan = $query->result_array();
		
		$typeperusahaan = $this->session->userdata('type_perusahaan');
		$subsektor = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
				
		$sql = '';
		
		foreach($jeniskegiatan as $rjeniskegiatan){
			$sql .= "SELECT '".$rjeniskegiatan['jenis_kegiatan']."' AS jenis_kegiatan,";
			foreach($subsektor as $rsubsektor){
				$sql .= "(SELECT IFNULL(AVG(realisasi_gjoule),0) FROM t_kegiatan_konservasi_new AS k INNER JOIN tm_perusahaan AS p
				ON k.id_perusahaan=p.IdPerusahaan WHERE p.IdSubsektor=".$rsubsektor['IdMSubsektor']." AND 
				k.jenis_kegiatan='".$rjeniskegiatan['jenis_kegiatan']."' AND k.tahun=".$tahun.") AS '".$rsubsektor['NamaSubsektor']."',";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ' UNION ';
		}
		$sql = substr($sql,0,-7);
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
	
	public function getpiedata(){
		$jenisperalatan = $this->input->get("jenisperalatan");
		$tahun = $this->input->get('tahun');
		$this->db->select("jenis_kegiatan, COUNT(*) AS frekuensi ", false)
		->from("t_kegiatan_konservasi_new")
		->group_by("jenis_kegiatan")
		->where("JenisPeralatan",$jenisperalatan)
		->where("tahun", $tahun);
		$query = $this->db->get();
		$result = $query->result_array();
		$returnval = array();
		foreach($result as $row){
			$returnval[] = array(
				"jenis_kegiatan" => $row['jenis_kegiatan'],
				"frekuensi" => floatval($row['frekuensi'])
			);
		}
		echo json_encode($returnval);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */