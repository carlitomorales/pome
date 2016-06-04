<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartkonsumsienergispesifik extends CI_Controller {

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
		$this->data['jenisenergi'] = $this->jenisenergi_model->get_all();
		$this->load->view('chartkonsumsienergispesifik', $this->data);
	}
	
	public function getlinedata(){
		$sub_sektor = $this->perusahaan_model->getsubsektor($this->session->userdata("id_perusahaan"));
		$tahun = $this->input->get("tahun");
		$arrtahun = explode(",",$tahun);
		
		$this->db->select("IdJenisEnergi, JenisEnergi")
		->from("tm_jenisenergi");
		$query = $this->db->get();
		$jenisenergi = $query->result_array();
		
		$sql = '';
		
		foreach($arrtahun as $rtahun){
			$sql .= "SELECT ".$rtahun." AS tahun,";
			foreach($jenisenergi as $rjenisenergi){
				$sql .= "(SELECT IFNULL(SUM(gjoule),0) FROM t_pemakaian_energi AS t INNER JOIN tm_perusahaan AS p ON t.id_perusahaan=p.IdPerusahaan WHERE t.tahun=".$rtahun." AND t.id_jenis_energi=".$rjenisenergi['IdJenisEnergi']." AND p.IdSubsektor=".$sub_sektor.") AS '".$rjenisenergi['JenisEnergi']."',";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ' UNION ';
		}
		$sql = substr($sql,0,-7);
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */