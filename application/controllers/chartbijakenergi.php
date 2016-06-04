<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chartbijakenergi extends CI_Controller {

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
		$this->load->view('chartbijakenergi', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
                if ($tipe_perusahaan==2)
		{$tipe_perusahaan="Bangunan";}
		
		$sub_sektor = $this->input->post("sub_sektor");
                if ($tipe_perusahaan == '')
                {
                   if ($sub_sektor == 0)
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p inner join t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan where tsb.status=2 ) AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}

		}
		else
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p inner join t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan where tsb.status=2 AND p.IdSubsektor=".$sub_sektor.") AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}
		}
                }
                else {
		if ($sub_sektor == 0)
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS P inner join t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan where tsb.status=2 and p.TypePerusahaan='".$tipe_perusahaan."' ) AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}

		}
		else
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p inner join t_statussubmit AS tsb on p.idperusahaan=tsb.idperusahaan where tsb.status=2 and p.TypePerusahaan='".$tipe_perusahaan."' and p.IdSubsektor=".$sub_sektor.") AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}
		}
                }

		echo $this->datatables->generate();
	}
	
	public function exportexcel()
	{
		$nama_perusahaan = $this->input->get("nama_perusahaan");
		$tahun = $this->input->get("tahun");
		$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->get("tipe_perusahaan");
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
                if ($tipe_perusahaan==2)
		{$tipe_perusahaan="Bangunan";}
		$sub_sektor = $this->input->get("sub_sektor");
		
		if ($tipe_perusahaan == '')
                {
                   if ($sub_sektor == 0)
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p ) AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}

		}
		else
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p WHERE p.IdSubsektor=".$sub_sektor.") AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}
		}
                }
                else {
		if ($sub_sektor == 0)
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p WHERE p.TypePerusahaan='".$tipe_perusahaan."' ) AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}

		}
		else
		{
			$select = "p.NamaPerusahaan,";
			foreach($arrtahun as $i_tahun){
				$select .= "IFNULL((SELECT IF(KebijakanEnergi=1,'Sudah','Belum') FROM t_orgmgrenergi WHERE IdPerusahaan=p.IdPerusahaan 
				AND tahun=$i_tahun),'Tidak') AS Status".$i_tahun.",";
			}
			$select = substr($select,0,-1);
			//echo $select;exit;
			$selectall = "NamaPerusahaan, ";
			foreach($arrtahun as $i_tahun){
				$selectall .= "Status".$i_tahun.",";
			}
			$selectall = substr($selectall,0,-1);
			$this->datatables->select($selectall, false)
			->from("(SELECT ".$select." FROM tm_perusahaan AS p WHERE p.TypePerusahaan='".$tipe_perusahaan."' and p.IdSubsektor=".$sub_sektor.") AS tbl");
			if($nama_perusahaan != ''){
				$this->datatables->like("tbl.NamaPerusahaan",$nama_perusahaan);
			}
		}
                }
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_perusahaan_kebijakan_energi_list_'.date("YmdHis")); 
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
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
                if ($tipe_perusahaan==2)
		{$tipe_perusahaan="Bangunan";}
		$sub_sektor = $this->input->get("sub_sektor");
		$arrtahun = explode(",",$tahun);
		
		$sql = '';
		if ($tipe_perusahaan =='')
		{
				if ($sub_sektor == 0)
		{
			foreach($arrtahun as $rtahun){
				$sql .= "SELECT ".$rtahun." AS tahun,";
				$sql .= "(SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='$tipe_perusahaan') AND KebijakanEnergi=1 AND tahun=$rtahun) AS Sudah, (SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan ) AND KebijakanEnergi=0 AND tahun=$rtahun) AS Belum";
				$sql .= ' UNION ';
			}
		}
		else
		{
			foreach($arrtahun as $rtahun){
				$sql .= "SELECT ".$rtahun." AS tahun,";
				$sql .= "(SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) AND KebijakanEnergi=1 AND tahun=$rtahun) AS Sudah, (SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan ) AND KebijakanEnergi=0 AND tahun=$rtahun) AS Belum";
				$sql .= ' UNION ';
			}
		}
		}
		else
		{
		if ($sub_sektor == 0)
		{
			foreach($arrtahun as $rtahun){
				$sql .= "SELECT ".$rtahun." AS tahun,";
				$sql .= "(SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='$tipe_perusahaan') AND KebijakanEnergi=1 AND tahun=$rtahun) AS Sudah, (SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='$tipe_perusahaan') AND KebijakanEnergi=0 AND tahun=$rtahun) AS Belum";
				$sql .= ' UNION ';
			}
		}
		else
		{
			foreach($arrtahun as $rtahun){
				$sql .= "SELECT ".$rtahun." AS tahun,";
				$sql .= "(SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE IdSubsektor=$sub_sektor) AND KebijakanEnergi=1 AND tahun=$rtahun) AS Sudah, (SELECT IFNULL(COUNT(1),0) FROM t_orgmgrenergi WHERE IdPerusahaan IN (SELECT IdPerusahaan FROM tm_perusahaan WHERE TypePerusahaan='$tipe_perusahaan' AND IdSubsektor=$sub_sektor) AND KebijakanEnergi=0 AND tahun=$rtahun) AS Belum";
				$sql .= ' UNION ';
			}
		}
		}
		$sql = substr($sql,0,-7);
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */