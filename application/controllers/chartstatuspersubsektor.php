<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartstatuspersubsektor extends CI_Controller {

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
		$this->load->view('chartstatuspersubsektor', $this->data);
	}
	
	public function getpiedata(){
		$color = array("#FF0033", "#339933", "#3366CC", "#FF9900", "#999966", "#993399", "#FF6666", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25");
		$tahun = $this->input->get("tahun");
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		$sql = "";
		$arrsubsektor = explode(",",$sub_sektor);
		
		foreach($arrsubsektor as $idsubsektor){
			//echo $idsubsektor."<br/>";
			$sql .= " SELECT (select NamaSubsektor from tm_subsektor where IdMSubsektor=".$idsubsektor.") as NamaSubsektor, (SELECT COUNT(1) FROM tm_perusahaan WHERE IdSubsektor=".$idsubsektor.") AS jmlPerusahaan,
(SELECT COUNT(1) FROM t_statussubmit WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE idSubsektor=
".$idsubsektor.") AND tahun=".$tahun." AND STATUS=2) AS jmlLapor UNION";
		}
		$sql = substr($sql,0, strlen($sql)-5);
		
		/*
		$this->db->select("a.NamaSubsektor as NamaSubsektor, (SELECT COUNT(1) FROM tm_perusahaan WHERE IdSubsektor=a.IdMSubsektor) AS jmlPerusahaan,
(SELECT COUNT(1) FROM t_statussubmit WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE idSubsektor=
a.IdMSubsektor) AND tahun=".$tahun." AND STATUS=2) AS jmlLapor ", false)
		->from("tm_subsektor AS a")
		->where("a.MTypePerusahaan_IdMTypePerusahaan",$tipe_perusahaan)
		->where("a.Deleted",0);
		*/
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		foreach($result as $row){
			$returnval[] = array(
				"subsektor" => $row['NamaSubsektor'],
				"jmlperusahaan" => $row['jmlPerusahaan'],
				"jmllapor" => $row['jmlLapor']
			);
		}
		echo json_encode($returnval);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */