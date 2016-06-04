<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rating extends CI_Controller {

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
		$this->data['module_id'] = '1';
		$this->load->model('Privilege_model');
		$this->load->model('rating_model');
	}
	
	public function index()
	{
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('rating', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_perusahaan = $this->input->post('id_perusahaan') ;
		$tahun = $this->input->post('tahun');
		$rating = $this->input->post('rating');


		$this->db->trans_start();
		$data = array(
			'rating' => $rating
		);
		$this->rating_model->edit($id_perusahaan,$tahun,$data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data Rating Perusahaan, silakan coba lagi.";
		}else{
			$status = "success";
			$msg = "Update data Rating Perusahaan berhasil.";			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function listrating($tahun){
		$this->datatables->select('sts.tahun, sts.`tgllapor`, p.NamaPerusahaan, p.KotaKab, subs.NamaSubsektor, 
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS jumlahproduksi,
			(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS pemakaianenergi,
			((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)/
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)) AS konsumsienergispesifik,
			(SELECT SUM(realisasi_gjoule) FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS penghematan,
			org.OrgMgmntEnergi, org.MgrEnergi, org.NamaMgrEnergi, IF(LENGTH(org.NoSertMgrEnergi) > 0, 1, 0) AS MgrSertifikat, org.NoSertMgrEnergi,
			(SELECT 1 FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1) AS programkonservasi,
			(SELECT 1 FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1) AS audit,
			(SELECT 1 FROM t_rekomendasi_audit WHERE id_peralatan_pemanfaat_energi IN (SELECT id_peralatan_pemanfaat_energi FROM 
			t_peralatan_pemanfaat_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) LIMIT 1) AS rekomendasiaudit,
			sts.rating, sts.IdPerusahaan', false)
			->where('sts.`status`',2)
			->where('sts.tahun',$tahun)
			->from('t_statussubmit AS sts ')
			->join('tm_perusahaan AS p','sts.IdPerusahaan=p.IdPerusahaan','inner')
			->join('tm_subsektor AS subs','p.IdSubsektor=subs.IdMSubsektor','inner')
			->join('t_orgmgrenergi AS org','org.IdPerusahaan=sts.`IdPerusahaan` AND org.tahun=sts.`tahun`','left');
		echo $this->datatables->generate();
	}
	
	function exportexcel($tahun){
		$this->db->select("sts.tahun, sts.`tgllapor` AS `Tgl Lapor`, p.NamaPerusahaan AS `Nama Perusahaan`, p.KotaKab AS `Alamat`, subs.NamaSubsektor AS `Sub Sektor`, 
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS `Jumlah Produksi`,
			(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS `Pemakaian Energi`,
			((SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)/
			(SELECT SUM(jumlah) FROM t_jenis_produksi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan)) AS `Konsumsi Energi Spesifik`,
			(SELECT SUM(realisasi_gjoule) FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) AS `Penghematan Energi`,
			IF(org.OrgMgmntEnergi=1,'Ada','Tidak') AS `Organisasi Manajemen Energi`, IF(org.MgrEnergi=1,'Ada','Tidak') AS `Manajer Energi`, org.NamaMgrEnergi AS `Nama Manajer Energi`, IF(LENGTH(org.NoSertMgrEnergi) > 0, 'Ada', 'Tidak') AS `Manajer Energi Bersertifikat`, org.NoSertMgrEnergi AS `No Sertifikat Manajer Energi`,
			IF((SELECT 1 FROM t_kegiatan_konservasi_new WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1)=1,'Ada','Tidak') AS `Program Konservasi Energi`,
			IF((SELECT 1 FROM t_peralatan_pemanfaat_energi WHERE status_audit=1 AND tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan LIMIT 1)=1,'Ada','Tidak') AS `Melaksanakan Audit Energi`,
			IF((SELECT 1 FROM t_rekomendasi_audit WHERE id_peralatan_pemanfaat_energi IN (SELECT id_peralatan_pemanfaat_energi FROM 
			t_peralatan_pemanfaat_energi WHERE tahun=sts.tahun AND id_perusahaan=sts.IdPerusahaan) LIMIT 1)=1,'Ada','Tidak') AS `Melaksanakan Rekomendasi Hasil Audit`,
			IF(sts.rating=0,'Merah',IF(sts.rating=1,'Kuning',IF(sts.rating=2,'Hijau','Merah'))) AS `Rating`", false)
			->where('sts.`status`',2)
			->where('sts.tahun',$tahun)
			->from('t_statussubmit AS sts ')
			->join('tm_perusahaan AS p','sts.IdPerusahaan=p.IdPerusahaan','inner')
			->join('tm_subsektor AS subs','p.IdSubsektor=subs.IdMSubsektor','inner')
			->join('t_orgmgrenergi AS org','org.IdPerusahaan=sts.`IdPerusahaan` AND org.tahun=sts.`tahun`','left');
		$query = $this->db->get();
		$this->load->library('excel');
		$this->excel->to_excel($query, 'rating_list_'.date("YmdHis")); 
	}
	
	function getDetail($idperusahaan,$tahun){
		$rowdata = $this->rating_model->getById($idperusahaan,$tahun);
		echo json_encode($rowdata);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */