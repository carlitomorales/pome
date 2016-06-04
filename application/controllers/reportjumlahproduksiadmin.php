<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportjumlahproduksiadmin extends CI_Controller {

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
		$this->load->view('reportjumlahproduksiadmin', $this->data);
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
				$select .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun) AS Jumlah".$i_tahun.",";
				$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
			//AND tahun IN (".$total.")) AS Total,";
			$select .= "(SELECT satuan FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			foreach($arrtahun as $i_tahun){
				$select .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun) AS Jumlah".$i_tahun.",";
				$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
			//AND tahun IN (".$total.")) AS Total,";
			$select .= "(SELECT satuan FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}
		//echo $select;exit;
		$selectall = "NamaPerusahaan, ";
		foreach($arrtahun as $i_tahun){
			$selectall .= "Jumlah".$i_tahun.",";
		}
		$selectall .= " satuan";
		
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
				$select .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun) AS Jumlah".$i_tahun.",";
				$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
			//AND tahun IN (".$total.")) AS Total,";
			$select .= "(SELECT satuan FROM t_jenis_produksi WHERE id_perusahaan=p.IdPerusahaan 
			LIMIT 1) AS satuan";
		}else{
			foreach($arrtahun as $i_tahun){
				$select .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun) AS Jumlah".$i_tahun.",";
				$total .= $i_tahun.",";
			}
			//$total = substr($total,0,strlen($total)-1);
			//$select .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
			//AND tahun IN (".$total.")) AS Total,";
			$select .= "(SELECT satuan FROM t_luas_bangunan WHERE id_perusahaan=p.IdPerusahaan 
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
		$this->excel->to_excel($query, 'report_jumlah_produksi_list_'.date("YmdHis")); 
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
		if($tipe_perusahaan == 1){
			$this->db->select('SELECT satuan FROM t_jenis_produksi WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
				LIMIT 1');
		} else
		{
		    		$this->db->select('SELECT satuan FROM t_luas_bangunan WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
				LIMIT 1');
		}
		
		//$querysat = $this->db->get();
		//$this->data['satuan'] = $querysat->result_array();
		
		foreach($arrtahun as $rtahun){
			$sql .= "SELECT ".$rtahun." AS tahun,";
			if($tipe_perusahaan == 1){
				if ($sub_sektor == 0)
				{
					$sql .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE tahun=$rtahun AND id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='Industri')) AS jumlah ";
					$sql .= " ,(SELECT satuan FROM t_jenis_produksi WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
			LIMIT 1) AS satu";
				}
				else
				{
					$sql .= "(SELECT IFNULL(SUMi(jumlah),0) FROM t_jenis_produksi WHERE tahun=$rtahun AND id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor)) AS jumlah ";
					$sql .= " ,(SELECT satuan FROM t_jenis_produksi WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
			LIMIT 1) AS satu";
				}
			}else{
				if ($sub_sektor == 0)
				{
					$sql .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE tahun=$rtahun AND id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='Bangunan')) AS jumlah ";
					$sql .= " ,(SELECT satuan FROM t_luas_bangunan WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
			LIMIT 1) AS satu";
				}
				else
				{
					$sql .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE tahun=$rtahun AND id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor)) AS jumlah ";
					$sql .= " ,(SELECT satuan FROM t_luas_bangunan WHERE id_perusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) 
			LIMIT 1) AS satu";
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