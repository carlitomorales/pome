<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportkonversienergidilakukanadmin extends CI_Controller {

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
		$this->load->model('kegiatan_model');
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
	}
	
	public function index()
	{
		$this->data['jenis_kegiatan'] = $this->kegiatan_model->get_all();
		$this->load->view('reportkonversienergidilakukanadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2) {$tipe_perusahaan="Bangunan";}

		if ($nama_perusahaan != "")
		{
			if ($sub_sektor == 0)
			{
				$this->datatables->select("No,NamaPerusahaan, Peralatan ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.TypePerusahaan= '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			else {
				$this->datatables->select("No,NamaPerusahaan, Peralatan ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.IdSubsektor = $sub_sektor AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			
		} else {
			if ($sub_sektor == 0)
			{
				$this->datatables->select("No,NamaPerusahaan, Peralatan  ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.TypePerusahaan= '$tipe_perusahaan'  group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			else
			{
				$this->datatables->select("No,NamaPerusahaan, Peralatan  ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.IdSubsektor = $sub_sektor group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
		}
		
		echo $this->datatables->generate();
	}
	
	public function exportexcel()
	{
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		else {$tipe_perusahaan="Bangunan";}

		if ($nama_perusahaan != "")
		{
			if ($sub_sektor == 0)
			{
				$this->db->select("No,NamaPerusahaan, Peralatan ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.TypePerusahaan= '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			else {
				$this->db->select("No,NamaPerusahaan, Peralatan ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.IdSubsektor = $sub_sektor AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			
		} else {
			if ($sub_sektor == 0)
			{
				$this->db->select("No,NamaPerusahaan, Peralatan  ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.TypePerusahaan= '$tipe_perusahaan'  group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
			else
			{
				$this->db->select("No,NamaPerusahaan, Peralatan  ,Kegiatan, DetailKegiatan, RealisasiGjoule, RealisasiPersen, RealisasiEmisi", false)
				->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan, t.JenisPeralatan as Peralatan ,t.jenis_kegiatan as Kegiatan, t.detail_kegiatan as DetailKegiatan, SUM(t.Realisasi_gjoule) AS RealisasiGjoule, SUM(t.Realisasi_persen) AS RealisasiPersen, SUM(Realisasi_emisi) AS RealisasiEmisi FROM (t_kegiatan_konservasi_new AS t) JOIN tm_perusahaan AS tmp ON t.id_perusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and t.tahun = $tahun AND tmp.IdSubsektor = $sub_sektor group by tmp.NamaPerusahaan, t.tahun, t.jenis_kegiatan, t.JenisPeralatan, t.detail_kegiatan ) as TblReport");
			}
		}
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_kegiatan_konservasi_energi_'.date("YmdHis")); 
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
                $tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$tahun = $this->input->get("tahun");
		$sub_sektor = $this->input->get("sub_sektor");
                
                if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		else {$tipe_perusahaan="Bangunan";}
                
                 if ($sub_sektor == 0)
                 {
                $this->db->select("t.jenis_kegiatan AS jeniskegiatan, IFNULL(count(*),0) AS gjoule ", false)
		->from("t_kegiatan_konservasi_new AS t")
		->join("tm_perusahaan AS tmp", "t.id_perusahaan=tmp.IdPerusahaan")
		->group_by("t.jenis_kegiatan, t.tahun")
		->where("t.tahun",$tahun)
		->where("tmp.TypePerusahaan",$tipe_perusahaan)
		->order_by("t.jenis_kegiatan");
                 }
                 else
                 {
		$this->db->select("t.jenis_kegiatan AS jeniskegiatan, IFNULL(count(*),0) AS gjoule ", false)
		->from("t_kegiatan_konservasi_new AS t")
		->join("tm_perusahaan AS tmp", "t.id_perusahaan=tmp.IdPerusahaan")
		->group_by("t.jenis_kegiatan, t.tahun")
		->where("t.tahun",$tahun)
		->where("tmp.IdSubsektor",$sub_sektor)
		->order_by("t.jenis_kegiatan");
                }
		$query = $this->db->get();
		$result = $query->result_array();
		$returnval = array();
		foreach($result as $row){
			$returnval[] = array(
				"jenis_kegiatan" => $row['jeniskegiatan'],
				"gjoule" => floatval($row['gjoule'])
			);
		}
		echo json_encode($returnval);
	}
	
	public function getlinedata(){
		$sub_sektor = $this->input->get("sub_sektor");
		$this->db->distinct()
		->select("tahun")
		->from("t_kegiatan_konservasi_new");
		$query = $this->db->get();
		$tahun = $query->result_array();
		
		$this->db->select("id_kegiatan, jenis_kegiatan")
		->from("tm_kegiatan");
		$query = $this->db->get();
		$jenis_kegiatan = $query->result_array();
		
		$sql = '';
		
		foreach($tahun as $rtahun){
			$sql .= "SELECT ".$rtahun['tahun']." AS tahun,";
			foreach($jenis_kegiatan as $rjeniskegiatan){
				$sql .= "(SELECT IFNULL(SUM(realisasi_gjoule),0) FROM t_kegiatan_konservasi_new AS t INNER JOIN tm_perusahaan AS p ON t.id_perusahaan=p.IdPerusahaan WHERE t.tahun=".$rtahun['tahun']." AND t.kegiatan=".$rjeniskegiatan['id_kegiatan']." AND p.IdSubsektor=".$sub_sektor.") AS '".$rjeniskegiatan['jenis_kegiatan']."',";
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