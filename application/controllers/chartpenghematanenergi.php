<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartpenghematanenergi extends CI_Controller {

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
		$this->load->view('chartpenghematanenergi', $this->data);
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
			$sql .= " SELECT (select NamaSubsektor from tm_subsektor where IdMSubsektor=".$idsubsektor.") as NamaSubsektor, (SELECT SUM(realisasi_gjoule) FROM t_kegiatan_konservasi_new WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE idSubsektor=".$idsubsektor.") AND tahun=".$tahun." AND id_perusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND `status`=2)) AS penghematan UNION";
		}
		$sql = substr($sql,0, strlen($sql)-5);
		//echo $sql;exit;
		
		/*
		$this->db->select("a.NamaSubsektor as NamaSubsektor,
(SELECT SUM(realisasi_gjoule) FROM t_kegiatan_konservasi_new WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE idSubsektor=a.IdMSubsektor) AND tahun=".$tahun." AND id_perusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND `status`=2)) AS penghematan ", false)
		->from("tm_subsektor AS a")
		->where("a.MTypePerusahaan_IdMTypePerusahaan",$tipe_perusahaan)
		->where("a.Deleted",0);
		*/
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		foreach($result as $row){
			$returnval[] = array(
				"subsektor" => $row['NamaSubsektor'],
				"penghematan" => $row['penghematan']
			);
		}
		echo json_encode($returnval);
	}
	
	public function getcombosubsektor(){
		$typeperusahaan = $this->input->get('_value');
		$subsektor = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$arrsubsektor = array();
		$arrsubsektor[] = array();
		foreach($subsektor as $rowsubsektor){
			$arrsubsektor[] = array($rowsubsektor['IdMSubsektor'] => $rowsubsektor['NamaSubsektor']);
		}
		echo json_encode($arrsubsektor);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */