<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportbijakenergi extends CI_Controller {

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
		$this->load->view('reportbijakenergi', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		//$tahun = $this->input->post("tahun");
		//$arrtahun = explode(",",$tahun);
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
                if ($tipe_perusahaan==2)
		{$tipe_perusahaan="Bangunan";}
		$sub_sektor = $this->input->post("sub_sektor");
		
		if ($nama_perusahaan != "")
		{
			if ($tipe_perusahaan == '')
                	{
                		if ($sub_sektor == 0)
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2  AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%'  ) as TblReport");
				}
				else {
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2  AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' ) as TblReport");
				}
                	} else {
				if ($sub_sektor == 0)
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s   WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%'  ) as TblReport");
				}
				else {
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s   WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  AND tmp.IdSubsektor = $sub_sektor AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' ) as TblReport");
				}
			}
			
		} else {
			if ($tipe_perusahaan == '')
	                {
	                	if ($sub_sektor == 0)
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2    ) as TblReport");
				}
				else
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  ) as TblReport");
				}
	                }
	                else{
				if ($sub_sektor == 0)
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  ) as TblReport");
				}
				else
				{
					$this->datatables->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  AND tmp.IdSubsektor = $sub_sektor ) as TblReport");
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
		
		if ($nama_perusahaan != "")
		{
			if ($tipe_perusahaan == '')
                	{
                		if ($sub_sektor == 0)
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2  AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%'  ) as TblReport");
				}
				else {
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s  WHERE tsb.status=2  AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' ) as TblReport");
				}
                	} else {
				if ($sub_sektor == 0)
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s   WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%'  ) as TblReport");
				}
				else {
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan=tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s   WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  AND tmp.IdSubsektor = $sub_sektor AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' ) as TblReport");
				}
			}
			
		} else {
			if ($tipe_perusahaan == '')
	                {
	                	if ($sub_sektor == 0)
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2    ) as TblReport");
				}
				else
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  ) as TblReport");
				}
	                }
	                else{
				if ($sub_sektor == 0)
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  ) as TblReport");
				}
				else
				{
					$this->db->select("No,NamaPerusahaan,Status, FileBijak", false)
					->from("(select @s:=@s+1 No,tmp.NamaPerusahaan AS NamaPerusahaan,IF(KebijakanEnergi=1,'Ada','Tidak') as Status, PathFileKbjk as FileBijak FROM (t_orgmgrenergi AS t) JOIN tm_perusahaan AS tmp ON t.IdPerusahaan =tmp.IdPerusahaan JOIN t_statussubmit AS tsb on tmp.idperusahaan=tsb.idperusahaan, (SELECT @s:= 0) AS s WHERE tsb.status=2  AND tmp.TypePerusahaan= '$tipe_perusahaan'  AND tmp.IdSubsektor = $sub_sektor ) as TblReport");
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