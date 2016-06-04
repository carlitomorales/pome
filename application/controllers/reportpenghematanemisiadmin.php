<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportpenghematanemisiadmin extends CI_Controller {

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
		$this->load->view('reportpenghematanemisiadmin', $this->data);
	}
	
	public function get_list()
	{
		$nama_perusahaan = $this->input->post("nama_perusahaan");
		$tahun = $this->input->post("tahun");
		$tipe_perusahaan = $this->input->post("tipe_perusahaan");
		$sub_sektor = $this->input->post("sub_sektor");
		
		
		$this->db->select("IdPerusahaan")
		->from("t_statussubmit")
		->where("tahun",$tahun)
		->where("status",2);
		$subQuery = $this->db->get();
		
		if ($tipe_perusahaan==1)
		{$tipe_perusahaan="Industri";}
		if ($tipe_perusahaan==2) {$tipe_perusahaan="Bangunan";}

		if ($nama_perusahaan != "")
		{
			if ($sub_sektor == 0)
			{
				$this->datatables->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`TypePerusahaan` = '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport");
		
				//$this->datatables->select("@s:=@s+1 No,tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi",false)
				//->from("t_kegiatan_konservasi_new AS kon")
				//->join("tm_perusahaan AS tmp", "kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s ")
				//->where("tmp.TypePerusahaan",$tipe_perusahaan)
				//->where("tmp.NamaPerusahaan LIKE '%".$nama_perusahaan."%'")
				//->where("kon.tahun",$tahun)
				//->where("IdPerusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2)")
				//->group_by("tmp.IdPerusahaan, tmp.NamaPerusahaan");
			}
			else {
				$this->datatables->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`ISubektor` = '$sub_sektor' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport");
 
	
				//$this->datatables->select("@s:=@s+1 No,tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi",false)
				//->from("t_kegiatan_konservasi_new AS kon ")
				//->join("tm_perusahaan AS tmp", "kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s ")
				//->where("tmp.IdSubsektor",$sub_sektor)
				//->where("tmp.NamaPerusahaan LIKE '%".$nama_perusahaan."%'")
				//->where("kon.tahun",$tahun)
				//->where("IdPerusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2)")
				//->group_by("tmp.IdPerusahaan, tmp.NamaPerusahaan");
			}
			
		} else {
			if ($sub_sektor == 0)
			{
				$this->datatables->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`TypePerusahaan` = '$tipe_perusahaan'  AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport");
	
				//$this->datatables->select("@s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi",false)
				//->from("t_kegiatan_konservasi_new AS kon ")
				//->join("tm_perusahaan AS tmp", "kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s ")
				//->where("tmp.TypePerusahaan",$tipe_perusahaan)
				//->where("kon.tahun",$tahun)
				//->where("IdPerusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2)")
				//->group_by("tmp.IdPerusahaan, tmp.NamaPerusahaan");
			}
			else
			{
				$this->datatables->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`IdSubsektor` = '$sub_sektor'  AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport");
	
				//$this->datatables->select("@s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi",false)
				//->from("t_kegiatan_konservasi_new AS kon ")
				//->join("tm_perusahaan AS tmp", "kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s ")
				//->where("tmp.IdSubsektor",$sub_sektor)
				//->where("kon.tahun",$tahun)
				//->where("IdPerusahaan IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2)")
				//->group_by("tmp.IdPerusahaan, tmp.NamaPerusahaan");
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
		if ($tipe_perusahaan==2){$tipe_perusahaan="Bangunan";}

		if ($nama_perusahaan != "")
		{
			if ($sub_sektor == 0)
			{				
				$this->db->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`TypePerusahaan` = '$tipe_perusahaan' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport ");

			}
			else {
				$this->db->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`ISubektor` = '$sub_sektor' AND tmp.NamaPerusahaan like '%".$nama_perusahaan."%' AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport ");
 
			}
			
		} else {
			if ($sub_sektor == 0)
			{
				$this->db->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`TypePerusahaan` = '$tipe_perusahaan'  AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport ");
			}
			else
			{
				$this->db->select("No,NamaPerusahaan, energi ,emisi ", false)
					->from("(SELECT @s:=@s+1 No, tmp.NamaPerusahaan, SUM(kon.realisasi_gjoule) AS energi, SUM(kon.realisasi_emisi) AS emisi 
	FROM (t_kegiatan_konservasi_new AS kon) JOIN tm_perusahaan AS tmp ON kon.id_perusahaan=tmp.IdPerusahaan,(SELECT @s:= 0) AS s WHERE `tmp`.`IdSubsektor` = '$sub_sektor'  AND `kon`.`tahun` = $tahun AND `IdPerusahaan` IN (SELECT IdPerusahaan FROM t_statussubmit WHERE tahun=$tahun AND `status`=2) GROUP BY tmp.IdPerusahaan, tmp.NamaPerusahaan) as TblReport ");
			}
		}
		$this->db->order_by("No", "asc");
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'report_penghematan_energi_penurunan_emisi_'.date("YmdHis")); 
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */