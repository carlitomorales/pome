<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencanakonservasinew extends CI_Controller {

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
		$this->load->model('rencanakonservasinew_model');
		$this->load->model('peralatanpemanfaatenergi_model');
		$this->load->model('lihatlaporan_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$idp = $this->session->userdata('id_perusahaan');
		$this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
		$this->data['data_kegiatan'] = $this->rencanakonservasinew_model->get_fordropdowndetail();
		$this->data['data_kegiatan_lain'] = $this->rencanakonservasinew_model->get_fordropdowndetaillain();
		$this->load->view('inputrencanakonservasinew', $this->data);
	}
	
	function save(){
		$status = "";
		$msg = "";
		
			
		$id_peralatan = $this->input->post('id_peralatan');				
		$id_kegiatan_konservasi = $this->input->post('id_kegiatan_konservasi');
		$jenis_kegiatan = $this->input->post('jenis_kegiatan');
 		$kegiatan = $this->input->post('id_kegiatan');
		$detail_kegiatan = $this->input->post('detail_kegiatan');
		$faktor_emisi = $this->input->post('faktor_emisi');
		$jenis_peralatan = $this->input->post('jenis_peralatan');
		$jenis_energi = $this->input->post('jenis_energi');
		$detail_jenis_energi = $this->input->post('detail_jenis_energi');
		$konversi = $this->input->post('konversi');
		$realisasi_gjoule = $this->input->post('realisasi_gjoule');
		$realisasi_persen = $this->input->post('realisasi_persen');
		$realisasi_emisi = $this->input->post('realisasi_emisi');
		$realisasi_emisi_persen = $this->input->post('realisasi_emisi_persen');
		$keterangan = $this->input->post('keterangan');
		$this->db->trans_start();
		if($id_kegiatan_konservasi != ''){
			$data = array(
				'id_peralatan_pemanfaat_energi' => $id_peralatan,
				'JenisPeralatan' => $jenis_peralatan,
				'JenisEnergi' => $jenis_energi,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi,
				'konversi' => $konversi,
				'kegiatan' => $kegiatan,
				'detail_kegiatan' => $detail_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				'target_gjoule' => $realisasi_gjoule,
				'target_persen' => $realisasi_persen,
				'target_emisi' => $realisasi_emisi,
				'target_emisi_persen' => $realisasi_emisi_persen,
				'keterangan' => $keterangan,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->rencanakonservasinew_model->edit($id_kegiatan_konservasi,$data);
		}else{
			$data = array(
				'id_peralatan_pemanfaat_energi' => $id_peralatan,
				'JenisPeralatan' => $jenis_peralatan,
				'JenisEnergi' => $jenis_energi,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi,
				'konversi' => $konversi,
				'kegiatan' => $kegiatan,
				'detail_kegiatan' => $detail_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				'target_gjoule' => $realisasi_gjoule,
				'target_persen' => $realisasi_persen,
				'target_emisi' => $realisasi_emisi,
				'target_emisi_persen' => $realisasi_emisi_persen,
				'keterangan' => $keterangan,
				'tahun' => date("Y")-1,
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->rencanakonservasinew_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data rencana efesiensi energi, silakan coba lagi.";
		}else{
			$this->stepsubmit();
			$status = "success";
			$msg = "Penyimpanan data rencana efesiensi energi berhasil.";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	function saveLain(){
		$status = "";
		$msg = "";
			
		$id_kegiatan_konservasi_lain = $this->input->post('id_kegiatan_konservasi_lain');
		$jenis_kegiatan = $this->input->post('jenis_kegiatan_lain');
 		$kegiatan = $this->input->post('id_kegiatan_lain');
		$detail_kegiatan = $this->input->post('detail_kegiatan_lain');
		
		$this->db->trans_start();
		if($id_kegiatan_konservasi_lain != ''){
			$data = array(
				'id_rencana_konservasi_lain' => $id_kegiatan_konservasi_lain,
				'kegiatan' => $kegiatan,
				'detail_kegiatan' => $detail_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->rencanakonservasinew_model->editLain($id_kegiatan_konservasi_lain,$data);
		}else{
			$data = array(
				'kegiatan' => $kegiatan,
				'detail_kegiatan' => $detail_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				'tahun' => date("Y")-1,
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->rencanakonservasinew_model->insertLain($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data rencana efesiensi energi lain, silakan coba lagi.";
		}else{
			$this->stepsubmit();
			$status = "success";
			$msg = "Penyimpanan data rencana efesiensi energi lain berhasil.";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	public function stepsubmit()
	{
		$tahun = date("Y")-1;
		$id = $this->session->userdata('id_perusahaan');
		$this->db->trans_start();
		$this->db->from('t_statussubmit');
		$this->db->where('IdPerusahaan',$id);
		$this->db->where('tahun',$tahun);
		$count = $this->db->count_all_results();
		$this->db->trans_complete();
		
		
		if($count > 0){
		$data = array(
				'submit_step7' => '1'
			);
		$this->lihatlaporan_model->edit($id,$data);		
		}else{		
			$data = array(
					'IdPerusahaan' => $id,
					'submit_step7' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($data);		
		}
		

	
	}
	
	function hapus($id){
		$this->db->trans_start();
		$this->rencanakonservasinew_model->del($id);
		$this->db->trans_complete();
	}
	function hapusLain($id){
		$this->db->trans_start();
		$this->rencanakonservasinew_model->delLain($id);
		$this->db->trans_complete();
	}
	function get_list(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		//$this->datatables->select('kegiatan, faktor_emisi, target_gjoule, target_persen, target_emisi, target_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi')
		$this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, target_gjoule, target_persen, target_emisi, keterangan, target_emisi_persen, JenisPeralatan, JenisEnergi, detail_jenis_energi, konversi,  faktor_emisi,  id_rencana_konservasi')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_rencana_konservasi_new as a');
			
		echo $this->datatables->generate();
	}
	function get_list_lain(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi_lain')
			->where('id_perusahaan = '.$id_perusahaan)
			->where('tahun = '.$tahun)
			->from('t_rencana_konservasi_lain');
			
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->rencanakonservasinew_model->getById($id);
		echo json_encode($rowdata);
	}
	function getDetailLain($id){
		$rowdata = $this->rencanakonservasinew_model->getByIdLain($id);
		echo json_encode($rowdata);
	}
	function getFaktorEmisi($id){
		$idp = $this->session->userdata('id_perusahaan');
		$rowdata = $this->rencanakonservasinew_model->getKonservasiByIdPeralatanPemanfaat($id,$idp);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */