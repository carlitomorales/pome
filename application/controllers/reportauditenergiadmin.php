<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportauditenergiadmin extends CI_Controller {

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
		$this->load->view('reportauditenergiadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		$select = "@s:=@s+1 No,p.NamaPerusahaan,";
		foreach($arrtahun as $i_tahun){
			$select .= "(SELECT IF(((SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun) >=
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun)) AND 
((SELECT COUNT(*) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun) > 0), 'Sudah', CONCAT('Belum (',
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun),'/',
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun),')'))) AS Jumlah".$i_tahun.",";
		}
		$select = substr($select,0,strlen($select)-1);
		//echo $select;exit;
		$selectall = "No,NamaPerusahaan, ";
		foreach($arrtahun as $i_tahun){
			$selectall .= "Jumlah".$i_tahun.",";
			
		}
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		if($sub_sektor==0)
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and p.IdSubsektor=".$sub_sektor.") AS tbl");
		}
		$selectall = substr($selectall,0,strlen($selectall)-1);
		
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
		foreach($arrtahun as $i_tahun){
			$select .= "(SELECT IF(((SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun) >=
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun)) AND 
((SELECT COUNT(*) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun) > 0), 'Sudah', CONCAT('Belum (',
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun),'/',
(SELECT IFNULL(COUNT(*),0) FROM t_peralatan_pemanfaat_energi WHERE id_perusahaan=p.IdPerusahaan AND tahun=$i_tahun and tsb.tahun=$i_tahun),')'))) AS Jumlah".$i_tahun.",";
		}
		$select = substr($select,0,strlen($select)-1);
		//echo $select;exit;
		$selectall = "No,NamaPerusahaan, ";
		foreach($arrtahun as $i_tahun){
			$selectall .= "Jumlah".$i_tahun.",";
			
		}
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}
		if($sub_sektor==0)
		{
			$this->db->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and  p.TypePerusahaan='".$tipe_perusahaan."') AS tbl");
		}
		else
		{
			$this->db->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p JOIN t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2 and  p.IdSubsektor=".$sub_sektor.") AS tbl");
		}
		$selectall = substr($selectall,0,strlen($selectall)-1);
		
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_audit_energi_list_'.date("YmdHis")); 
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
				$sql .= "(SELECT IFNULL(SUM(jumlah),0) FROM t_jenis_produksi WHERE tahun=$rtahun) AS jumlah ";
			}else{
				$sql .= "(SELECT IFNULL(SUM(luas_bangunan),0) FROM t_luas_bangunan WHERE tahun=$rtahun) AS jumlah ";
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