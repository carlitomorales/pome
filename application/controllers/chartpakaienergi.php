<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chartpakaienergi extends CI_Controller {

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
		$this->load->view('chartpakaienergi', $this->data);
	}
	
	public function getcombosubsektor(){
		$typeperusahaan = $this->input->get('_value');
		$subsektor = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$arrsubsektor = array();
		$arrsubsektor[] = array(0 => "- Semua -");
		foreach($subsektor as $rowsubsektor){
			$arrsubsektor[] = array($rowsubsektor['IdMSubsektor'] => $rowsubsektor['NamaSubsektor']);
		}
		echo json_encode($arrsubsektor);
	}
	
	public function getpiedata(){
		$color = array("#FF0033", "#339933", "#3366CC", "#FF9900", "#999966", "#993399", "#FF6666", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25");
		$tahun = $this->input->get("tahun");
		$sub_sektor = $this->input->get("sub_sektor");
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		else {$tipe_perusahaan="Bangunan";}
		if($sub_sektor==0)
		{
			$this->db->select("a.id_jenis_energi as id_jenis_peralatan, b.JenisEnergi AS jenisperalatan, sum(gjoule) AS persen ", false)
			->from("t_pemakaian_energi AS a")
			->join("tm_jenisenergi AS b", "a.id_jenis_energi=b.IdJenisEnergi")	
			->join("tm_jenisenergidetail AS c", "a.id_jenis_energi_detail=c.id_jenis_energi_detail")		
			->join("tm_perusahaan AS tmp", "a.id_perusahaan=tmp.IdPerusahaan")
			->join("(SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND status=2) AS sts", "tmp.IdPerusahaan=sts.IdPerusahaan")
			->group_by("a.id_jenis_energi, b.JenisEnergi")
			->where("a.tahun",$tahun)
			->where("tmp.TypePerusahaan",$tipe_perusahaan);
		}
		else
		{
			$this->db->select("a.id_jenis_energi as id_jenis_peralatan, b.JenisEnergi AS jenisperalatan, sum(gjoule) AS persen ", false)
			->from("t_pemakaian_energi AS a")
			->join("tm_jenisenergi AS b", "a.id_jenis_energi=b.IdJenisEnergi")	
			->join("tm_jenisenergidetail AS c", "a.id_jenis_energi_detail=c.id_jenis_energi_detail")		
			->join("tm_perusahaan AS tmp", "a.id_perusahaan=tmp.IdPerusahaan")
			->join("(SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND status=2) AS sts", "tmp.IdPerusahaan=sts.IdPerusahaan")
			->group_by("a.id_jenis_energi, b.JenisEnergi")
			->where("a.tahun",$tahun)
			->where("tmp.IdSubsektor",$sub_sektor);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		$returnval = array();
		$i = 0;
		foreach($result as $row){
			$id_jenis_peralatan = $row["id_jenis_peralatan"];
			if($sub_sektor==0)
			{
				$this->db->select("c.detail_jenis_energi AS jenisperalatan, sum(gjoule) AS persen ", false)
				->from("t_pemakaian_energi AS a")
				->join("tm_jenisenergi AS b", "a.id_jenis_energi=b.IdJenisEnergi")	
				->join("tm_jenisenergidetail AS c", "a.id_jenis_energi_detail=c.id_jenis_energi_detail")		
				->join("tm_perusahaan AS tmp", "a.id_perusahaan=tmp.IdPerusahaan")
				->join("(SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND status=2) AS sts", "tmp.IdPerusahaan=sts.IdPerusahaan")
				->group_by("c.detail_jenis_energi")
				->where("a.tahun",$tahun)
				->where("tmp.TypePerusahaan",$tipe_perusahaan)
				->where("a.id_jenis_energi",$id_jenis_peralatan);
			}
			else
			{
				$this->db->select("c.detail_jenis_energi AS jenisperalatan, sum(gjoule) AS persen ", false)
				->from("t_pemakaian_energi AS a")
				->join("tm_jenisenergi AS b", "a.id_jenis_energi=b.IdJenisEnergi")	
				->join("tm_jenisenergidetail AS c", "a.id_jenis_energi_detail=c.id_jenis_energi_detail")		
				->join("tm_perusahaan AS tmp", "a.id_perusahaan=tmp.IdPerusahaan")
				->join("(SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=".$tahun." AND status=2) AS sts", "tmp.IdPerusahaan=sts.IdPerusahaan")
				->group_by("c.detail_jenis_energi")
				->where("a.tahun",$tahun)
				->where("tmp.IdSubsektor",$sub_sektor)
				->where("a.id_jenis_energi",$id_jenis_peralatan);
			}
			$query2 = $this->db->get();
			$result2 = $query2->result_array();
			$returnval2 = array();
			foreach($result2 as $row2){
				$returnval2[] = array(
					"jenisperalatan" => $row2['jenisperalatan'],
					"persen" => floatval($row2['persen'])
				);
			}
			$returnval[] = array(
				"jenisperalatan" => $row['jenisperalatan'],
				"persen" => floatval($row['persen']),
				"color" => $color[$i],
				"subs" => $returnval2
			);
			$i++;
		}
		echo json_encode($returnval);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */