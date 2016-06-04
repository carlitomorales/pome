<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportkonsumsienergispesifik extends CI_Controller {

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
		$this->load->view('reportkonsumsienergispesifiknew', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		$select = "@s:=@s+1 No,p.NamaPerusahaan,";
		$total = "";
		if($tipe_perusahaan == 1){

				$select .= "cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as 'KonsumsiEnergiSpesifik', ";
				
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_jenis_produksi WHERE t_jenis_produksi.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			$select .= "cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as 'KonsumsiEnergiSpesifik', ";
				
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_luas_bangunan WHERE t_luas_bangunan.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}
		//echo $select;
		//echo exit;
		$selectall = "No,NamaPerusahaan, KonsumsiEnergiSpesifik, satuan ";
		//foreach($arrtahun as $i_tahun){
			//$selectall .= "Konsumsi Energi Spesifik".$i_tahun.",";
		//}
		//$selectall .= "satuan";
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		
		if ($sub_sektor == 0)
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and tsb.tahun=$tahun and p.IdSubsektor=".$sub_sektor.") AS tbl");
		}
		if($nama_perusahaan != ''){
			$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
		}
		echo $this->datatables->generate();
	}
	
	public function exportexcel()
	{
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		$select = "@s:=@s+1 No,p.NamaPerusahaan,";
		$total = "";
		if($tipe_perusahaan == 1){

				$select .= "cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as 'KonsumsiEnergiSpesifik', ";
				
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_jenis_produksi WHERE t_jenis_produksi.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			$select .= "cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as 'KonsumsiEnergiSpesifik', ";
				
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_luas_bangunan WHERE t_luas_bangunan.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		if ($sub_sektor == 0)
		{
			$this->db->select($select, false)
			->from('tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s');
			$this->db->where("tsb.status","2");
			$this->db->where("tsb.tahun",$tahun);
			$this->db->where("p.TypePerusahaan",$tipe_perusahaan);
		}
		else
		{
			$this->db->select($select, false)
			->from('tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s');
			$this->db->where("tsb.status","2");
			$this->db->where("tsb.tahun",$tahun);
			$this->db->where("p.IdSubsektor",$sub_sektor);
		}
		if($nama_perusahaan != ''){
			$this->db->like("p.NamaPerusahaan",$nama_perusahaan);
		}
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_kons_energi_spesifik_list_'.date("YmdHis")); 
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
	
	public function getlinedata(){
		$sub_sektor = $this->perusahaan_model->getsubsektor($this->session->userdata("id_perusahaan"));
		$tahun = $this->input->get("tahun");
		
		$tipe_perusahaan = $this->session->userdata("type_perusahaan");
		$id_perusahaan = $this->session->userdata("id_perusahaan");
	
		$sql = '';
		
		if($tipe_perusahaan == 1){
			$sql="select 'Tidak Efisien' as 'Nilai Konsumsi Energi Spesifik',max(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
UNION ALL
select 'Rata-Rata' as 'Nilai Konsumsi Energi Spesifik',AVG(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
UNION ALL
select 'Paling Efisien' as 'Nilai Konsumsi Energi Spesifik', min(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0";
		} else
		{
			$sql="select 'Tidak Efisien' as 'Nilai Konsumsi Energi Spesifik',max(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
UNION ALL
select 'Rata-Rata' as 'Nilai Konsumsi Energi Spesifik',AVG(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
UNION ALL
select 'Paling Efisien' as 'Nilai Konsumsi Energi Spesifik', min(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0";
		}
		//$sql = substr($sql,0,-7);
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */