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
		$this->load->view('reportkonsumsienergispesifikadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		$select = "p.NamaPerusahaan,";
		$total = "";
		if($tipe_perusahaan == 1){
			foreach($arrtahun as $i_tahun){
				$select .= "(ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun=$i_tahun) / (SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan=p.IdPerusahaan AND tjp.tahun=$i_tahun)),0)) AS Jumlah".$i_tahun.",";
				//$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(ifnull(((SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan=p.IdPerusahaan AND tjp.tahun IN (".$total.")) / (SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun IN (".$total."))),0)) AS Total,";
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_jenis_produksi WHERE t_jenis_produksi.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			foreach($arrtahun as $i_tahun){
				$select .= "(ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun=$i_tahun) / (SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan=p.IdPerusahaan AND tlb.tahun=$i_tahun)),0)) AS Jumlah".$i_tahun.",";
				//$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(ifnull(((SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan=p.IdPerusahaan AND tlb.tahun IN (".$total.")) / (SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun IN (".$total."))),0)) AS Total,";
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_luas_bangunan WHERE t_luas_bangunan.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}
		//echo $select;
		//echo exit;
		$selectall = "NamaPerusahaan, ";
		foreach($arrtahun as $i_tahun){
			$selectall .= "Jumlah".$i_tahun.",";
		}
		$selectall .= "satuan";
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		else {$tipe_perusahaan="Bangunan";}
		
		if ($sub_sektor == 0)
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p WHERE p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p WHERE p.IdSubsektor=".$sub_sektor.") AS tbl");
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
		$select = "p.NamaPerusahaan,";
		$total = "";
		if($tipe_perusahaan == 1){
			foreach($arrtahun as $i_tahun){
				$select .= "(ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun=$i_tahun) / (SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan=p.IdPerusahaan AND tjp.tahun=$i_tahun)),0)) AS Jumlah".$i_tahun.",";
				//$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(ifnull(((SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan=p.IdPerusahaan AND tjp.tahun IN (".$total.")) / (SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun IN (".$total."))),0)) AS Total,";
			$select .= "(SELECT CONCAT('GJoule/',satuan) FROM t_jenis_produksi WHERE t_jenis_produksi.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			foreach($arrtahun as $i_tahun){
				$select .= "(ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun=$i_tahun) / (SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan=p.IdPerusahaan AND tlb.tahun=$i_tahun)),0)) AS Jumlah".$i_tahun.",";
				//$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(ifnull(((SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan=p.IdPerusahaan AND tlb.tahun IN (".$total.")) / (SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan=p.IdPerusahaan AND tpe.tahun IN (".$total."))),0)) AS Total,";
			$select .= "(SELECT CONCAT('GJoule/', satuan) FROM t_luas_bangunan WHERE t_luas_bangunan.id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		else {$tipe_perusahaan="Bangunan";}
		if ($sub_sektor == 0)
		{
			$this->db->select($select, false)
			->from('tm_perusahaan AS p');
			$this->db->where("p.TypePerusahaan",$tipe_perusahaan);
		}
		else
		{
			$this->db->select($select, false)
			->from('tm_perusahaan AS p');
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
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		$sub_sektor = $this->input->get("sub_sektor");
		$arrtahun = explode(",",$tahun);
		
		$sql = '';
		
		foreach($arrtahun as $rtahun){
			$sql .= "SELECT ".$rtahun." AS tahun,";
			if($tipe_perusahaan == 1){
				if ($sub_sektor == 0)
				{
					$sql .= "(SELECT ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.TypePerusahaan='Industri') AND tpe.tahun=$rtahun ) / (SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.TypePerusahaan='Industri') AND tjp.tahun=$rtahun ) ),0) ) AS jumlah ";
				}
				else
				{
					$sql .= "(SELECT ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.IdSubsektor=$sub_sektor) AND tpe.tahun=$rtahun ) / (SELECT (sum(ifnull(tjp.jumlah, 0)))FROM t_jenis_produksi as tjp WHERE tjp.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.IdSubsektor=$sub_sektor) AND tjp.tahun=$rtahun ) ),0) ) AS jumlah ";
				}
			}else{
				if ($sub_sektor == 0)
				{
					$sql .= "(SELECT ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.TypePerusahaan='Bangunan') AND tpe.tahun=$rtahun ) / (SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.TypePerusahaan='Bangunan') AND tlb.tahun=$rtahun ) ),0) ) AS jumlah ";
				}
				else
				{
					$sql .= "(SELECT ifnull(((SELECT (sum(ifnull(tpe.gjoule, 0)))FROM t_pemakaian_energi as tpe WHERE tpe.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.IdSubsektor=$sub_sektor) AND tpe.tahun=$rtahun ) / (SELECT (sum(ifnull(tlb.luas_bangunan, 0)))FROM t_luas_bangunan as tlb WHERE tlb.id_perusahaan IN(SELECT tm_perusahaan.IdPerusahaan FROM tm_perusahaan WHERE tm_perusahaan.IdSubsektor=$sub_sektor) AND tlb.tahun=$rtahun ) ),0) ) AS jumlah ";
				}
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