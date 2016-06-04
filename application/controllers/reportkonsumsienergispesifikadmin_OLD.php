<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportkonsumsienergispesifikadmin extends CI_Controller {

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
		$this->load->view('reportkonsumsienergispesifikadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		$this->datatables->select("NamaPerusahaan, ListrikPLN,ListrikPLNGJoule, BBM, BBMGJoule, Gas, GasGJoule, Batubara, BatubaraGJoule,
		Lainlain, Total", false)
		->from("(SELECT p.NamaPerusahaan, IFNULL((SELECT SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan 
		AND tahun=$tahun AND id_jenis_energi=4),0) AS ListrikPLN, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE 
		id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=4),0) AS ListrikPLNGJoule, IFNULL((SELECT SUM(original_unit) FROM 
		t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=2),0) AS BBM, IFNULL((SELECT SUM(gjoule)
		FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=2),0) AS BBMGJoule, IFNULL((SELECT
		SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=3),0) AS Gas, 
		IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=3),0) AS
		GasGJoule, IFNULL((SELECT SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND 
		id_jenis_energi=1),0) AS Batubara, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND 
		tahun=$tahun AND id_jenis_energi=1),0) AS BatubaraGJoule, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE 
		id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=5),0) AS Lainlain, IFNULL((SELECT SUM(gjoule) FROM 
		t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun),0) AS Total, p.IdSubsektor FROM tm_perusahaan AS p) as 
		tblReport");
		$this->datatables->where("IdSubsektor",$sub_sektor);
		echo $this->datatables->generate();
	}
	
	public function exportexcel()
	{
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		$this->db->select("NamaPerusahaan, ListrikPLN,ListrikPLNGJoule, BBM, BBMGJoule, Gas, GasGJoule, Batubara, BatubaraGJoule,
		Lainlain, Total", false)
		->from("(SELECT p.NamaPerusahaan, IFNULL((SELECT SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan 
		AND tahun=$tahun AND id_jenis_energi=4),0) AS ListrikPLN, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE 
		id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=4),0) AS ListrikPLNGJoule, IFNULL((SELECT SUM(original_unit) FROM 
		t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=2),0) AS BBM, IFNULL((SELECT SUM(gjoule)
		FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=2),0) AS BBMGJoule, IFNULL((SELECT
		SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=3),0) AS Gas, 
		IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=3),0) AS
		GasGJoule, IFNULL((SELECT SUM(original_unit) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND 
		id_jenis_energi=1),0) AS Batubara, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND 
		tahun=$tahun AND id_jenis_energi=1),0) AS BatubaraGJoule, IFNULL((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE 
		id_perusahaan=p.IdPerusahaan AND tahun=$tahun AND id_jenis_energi=5),0) AS Lainlain, IFNULL((SELECT SUM(gjoule) FROM 
		t_pemakaian_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$tahun),0) AS Total, p.IdSubsektor FROM tm_perusahaan AS p) as tblReport",false);
		$this->db->where("IdSubsektor",$sub_sektor);
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_pemakaian_energi_'.date("YmdHis")); 
	}
	
	public function getcombosubsektor(){
		$typeperusahaan = $this->input->get('_value');
		$subsektor = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$arrsubsektor = array();
		foreach($subsektor as $rowsubsektor){
			$arrsubsektor[] = array($rowsubsektor['IdMSubsektor'] => $rowsubsektor['NamaSubsektor']);
		}
		echo json_encode($arrsubsektor);
	}
	
	public function getpiedata(){
		$tahun = $this->input->get("tahun");
		$sub_sektor = $this->input->get("sub_sektor");
		$this->db->select("tm.JenisEnergi AS jenisenergi, IFNULL(SUM(t.gjoule),0) AS gjoule ", false)
		->from("t_pemakaian_energi AS t")
		->join("tm_jenisenergi AS tm", "t.id_jenis_energi=tm.IdJenisEnergi")
		->join("tm_perusahaan AS tmp", "t.id_perusahaan=tmp.IdPerusahaan")
		->group_by("tm.JenisEnergi, t.tahun")
		->where("t.tahun",$tahun)
		->where("tmp.IdSubsektor",$sub_sektor)
		->order_by("tm.JenisEnergi");
		$query = $this->db->get();
		$result = $query->result_array();
		$returnval = array();
		foreach($result as $row){
			$returnval[] = array(
				"jenisenergi" => $row['jenisenergi'],
				"gjoule" => floatval($row['gjoule'])
			);
		}
		echo json_encode($returnval);
	}
	
	public function getlinedata(){
		$sub_sektor = $this->input->get("sub_sektor");
		$this->db->distinct()
		->select("tahun")
		->from("t_pemakaian_energi");
		$query = $this->db->get();
		$tahun = $query->result_array();
		
		$this->db->select("IdJenisEnergi, JenisEnergi")
		->from("tm_jenisenergi");
		$query = $this->db->get();
		$jenisenergi = $query->result_array();
		
		$sql = '';
		
		foreach($tahun as $rtahun){
			$sql .= "SELECT ".$rtahun['tahun']." AS tahun,";
			foreach($jenisenergi as $rjenisenergi){
				$sql .= "(SELECT IFNULL(SUM(gjoule),0) FROM t_pemakaian_energi AS t INNER JOIN tm_perusahaan AS p ON t.id_perusahaan=p.IdPerusahaan WHERE t.tahun=".$rtahun['tahun']." AND t.id_jenis_energi=".$rjenisenergi['IdJenisEnergi']." AND p.IdSubsektor=".$sub_sektor.") AS '".$rjenisenergi['JenisEnergi']."',";
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