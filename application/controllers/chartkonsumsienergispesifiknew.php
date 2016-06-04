<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartkonsumsienergispesifiknew extends CI_Controller {

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
		$typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['subsektor'] = $this->subsektor_model->getbytypeperusahaan($typeperusahaan);
		$idperusahaan = $this->session->userdata('id_perusahaan');
		$this->data['option_perusahaan'] = $this->perusahaan_model->get_perusahaan($idperusahaan);
		foreach($this->data['option_perusahaan'] as $rowPerusahaan){
			$this->data['option_subsektor'] = $this->perusahaan_model->load_dd_subsek($rowPerusahaan['IdSubsektor']);
			
			
		}
		$this->load->view('chartkonsumsienergispesifiknew', $this->data);
	}
	
	public function getlinedata(){
		$sub_sektor = $this->perusahaan_model->getsubsektor($this->session->userdata("id_perusahaan"));
		$tahun = $this->input->get("tahun");
		
		$tipe_perusahaan = $this->session->userdata("type_perusahaan");
		$id_perusahaan = $this->session->userdata("id_perusahaan");
	
		
		
		
		$sql = '';
		
		if($tipe_perusahaan == 1){
			$sql="
select 'Konsumsi Energi Spesifik Perusahaan' as 'Nilai Konsumsi Energi Spesifik', rpt.konsprs as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi where id_perusahaan=$id_perusahaan),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi where id_perusahaan=$id_perusahaan),0)),0) as decimal(8,2)) as konsprs,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.konsprs<>0
UNION ALL
select 'Paling Efisien' as 'Nilai Konsumsi Energi Spesifik', min(rpt.kons) as nilai from (
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
select 'Tidak Efisien' as 'Nilai Konsumsi Energi Spesifik',max(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`jumlah`,0)) from t_jenis_produksi),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
";
		} else
		{
			$sql="
select 'Konsumsi Energi Spesifik Perusahaan' as 'Nilai Konsumsi Energi Spesifik', rpt.konsprs as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi where id_perusahaan=$id_perusahaan),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan where id_perusahaan=$id_perusahaan),0)),0) as decimal(8,2)) as konsprs,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.konsprs<>0
UNION ALL
select 'Paling Efisien' as 'Nilai Konsumsi Energi Spesifik', min(rpt.kons) as nilai from (
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
select 'Tidak Efisien' as 'Nilai Konsumsi Energi Spesifik',max(rpt.kons) as nilai from (
select cast(IFNULL((IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`gjoule`,0)) from t_pemakaian_energi),0)/IFNULL((select sum(if((`tahun` = $tahun && (id_perusahaan=p.IdPerusahaan)),`luas_bangunan`,0)) from t_luas_bangunan),0)),0) as decimal(8,2)) as kons,p.IdPerusahaan as id_perusahaan from tm_perusahaan as p
where p.IdSubsektor=$sub_sektor 
) as rpt
where rpt.kons<>0
";
		}
		//$sql = substr($sql,0,-7);
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */