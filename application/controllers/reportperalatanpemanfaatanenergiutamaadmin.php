<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportperalatanpemanfaatanenergiutamaadmin extends CI_Controller {

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
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_all();
		$this->load->view('reportperalatanpemanfaatanenergiutamaadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		$select = "@s:=@s+1 No,p.NamaPerusahaan, tmr.JenisPeralatan as Peralatan, jenis_peralatan_lain as DetailPeralatan, ";
		$total = "";
		

				$select .= "IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && (id_jenis_peralatan=t.id_jenis_peralatan)),`original_unit`,0)) from t_peralatan_pemanfaat_energi),0) AS 'OriginalUnit', IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && (id_jenis_peralatan=t.id_jenis_peralatan)),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0) AS 'GJoule',cast((IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && id_jenis_peralatan=t.id_jenis_peralatan),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0)),0)*100) as decimal(8,2)) as 'Persentase' ";
				
			
		$selectall = "No,NamaPerusahaan, Peralatan, DetailPeralatan ,OriginalUnit, GJoule, Persentase ";
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		
		if ($sub_sektor == 0)
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN (t_peralatan_pemanfaat_energi AS t) ON t.id_perusahaan=p.IdPerusahaan JOIN tm_jenisperalatan AS tmr on t.id_jenis_peralatan=tmr.IdJenisPeralatan JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN (t_peralatan_pemanfaat_energi AS t) ON t.id_perusahaan=p.IdPerusahaan JOIN tm_jenisperalatan AS tmr on t.id_jenis_peralatan=tmr.IdJenisPeralatan JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.IdSubsektor=".$sub_sektor.") AS tbl");
		}
		if($nama_perusahaan != ''){
			$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
		}
                //end

		
		echo $this->datatables->generate();
	}
	
	public function exportexcel()
	{
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		$select = "@s:=@s+1 No,p.NamaPerusahaan, tmr.JenisPeralatan as Peralatan, jenis_peralatan_lain as DetailPeralatan, ";
		$total = "";
		

				$select .= "IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && (id_jenis_peralatan=t.id_jenis_peralatan)),`original_unit`,0)) from t_peralatan_pemanfaat_energi),0) AS 'OriginalUnit', IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && (id_jenis_peralatan=t.id_jenis_peralatan)),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0) AS 'GJoule',cast((IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan) && id_jenis_peralatan=t.id_jenis_peralatan),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_peralatan_pemanfaat_energi),0)),0)*100) as decimal(8,2)) as 'Persentase' ";
				
			
		$selectall = "No,NamaPerusahaan, Peralatan, DetailPeralatan ,OriginalUnit, GJoule, Persentase ";
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		
		if ($sub_sektor == 0)
		{
			$this->db->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN (t_peralatan_pemanfaat_energi AS t) ON t.id_perusahaan=p.IdPerusahaan JOIN tm_jenisperalatan AS tmr on t.id_jenis_peralatan=tmr.IdJenisPeralatan JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->db->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN (t_peralatan_pemanfaat_energi AS t) ON t.id_perusahaan=p.IdPerusahaan JOIN tm_jenisperalatan AS tmr on t.id_jenis_peralatan=tmr.IdJenisPeralatan JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.IdSubsektor=".$sub_sektor.") AS tbl");
		}
		if($nama_perusahaan != ''){
			$this->db->like("tbl.NamaPerusahaan",$nama_perusahaan);
		}
                //end
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_peralatan_pemanfaat_energi_'.date("YmdHis")); 
	}
	
	public function getcombosubsektor(){
		$typeperusahaan = $this->input->get('_value');
		$subsektor = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$arrsubsektor = array();
		//$arrsubsektor[] = array(0 => "- Semua -");
		foreach($subsektor as $rowsubsektor){
			$arrsubsektor[] = array($rowsubsektor['IdMSubsektor'] => $rowsubsektor['NamaSubsektor']);
		}
		echo json_encode($arrsubsektor);
	}
	
	public function getpiedata(){
		$tahun = $this->input->get("tahun");
		$sub_sektor = $this->input->get("sub_sektor");
		$this->db->select("tm.JenisPeralatan AS jenisperalatan, IFNULL(IFNULL(SUM(t.gjoule),0) / IFNULL((SELECT SUM(gjoule) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=tmp.IdPerusahaan AND tahun=$tahun),0) ,0)  AS gjoule ", false)
		->from("t_peralatan_pemanfaat_energi AS t")
		->join("tm_jenisperalatan AS tm", "t.id_jenis_peralatan=tm.IdJenisPeralatan")
		->join("tm_perusahaan AS tmp", "t.id_perusahaan=tmp.IdPerusahaan")
		->group_by("tm.JenisPeralatan, t.tahun")
		->where("t.tahun",$tahun)
		->where("tmp.IdSubsektor",$sub_sektor)
		->order_by("tm.JenisPeralatan");
		$query = $this->db->get();
		$result = $query->result_array();
		$returnval = array();
		foreach($result as $row){
			$returnval[] = array(
				"jenisperalatan" => $row['jenisperalatan'],
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