<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kegiatanpenghematan extends CI_Controller {

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
		$this->data['menugroup'] = '3';
		$this->data['module_id'] = '6';


		$this->load->model('Privilege_model');
		$this->load->model('typeperusahaan_model');
		$this->load->model('subsektor_model');
		$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		$this->load->model('perusahaan_model');
		
		$this->load->model('kegiatanpenghematan_model');
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
		$this->load->model('jenisproduksi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		
       		
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('inputkegiatanpenghematan', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	function report()
	{	
	
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('reportjenis_kegiatan', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	function save(){
		$status = "";
		$msg = "";
		$id_kegiatan = $this->input->post('id_kegiatan') ;
		$jenis_kegiatan = $this->input->post('jenis_kegiatan');
 		


		$this->db->trans_start();
		if($id_kegiatan != ''){
			$data = array(
				'id_kegiatan' => $id_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
			$this->kegiatanpenghematan_model->edit($id_kegiatan,$data);
		}else{
			$data = array(
				'id_kegiatan' => $id_kegiatan,
				'jenis_kegiatan' => $jenis_kegiatan,
				'Deleted' => '0',
				'Createdby' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
			$newid = $this->kegiatanpenghematan_model->insert($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data jenis kegiatan, silakan coba lagi.";
		}else{
			if($id_kegiatan != ''){
				$status = "success";
				$msg = "Update data jenis kegiatan berhasil.";
			} else {
				$status = "success";
				$msg = "Input data jenis kegiatan berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function savedetail(){
		$status = "";
		$msg = "";
		$id_kegiatan = $this->input->post('id_kegiatan');
		$id_kegiatan_detail = $this->input->post('id_kegiatan_detail') ;
		$detail_jenis_energi = $this->input->post('detail_jenis_energi');
 		$faktor_emisi = $this->input->post('faktor_emisi');
		

		$this->db->trans_start();
		if($id_kegiatan_detail != ''){
			$data = array(
				'id_kegiatan_detail' => $id_kegiatan_detail,
				'id_kegiatan'=> $id_kegiatan,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi
			);
			$this->kegiatanpenghematan_model->editdetail($id_kegiatan_detail,$data);
		}else{
			$data = array(
				'id_kegiatan_detail' => $id_kegiatan_detail,
				'id_kegiatan'=> $id_kegiatan,
				'detail_jenis_energi' => $detail_jenis_energi,
				'faktor_emisi' => $faktor_emisi
			);
			$newid = $this->kegiatanpenghematan_model->insertdetail($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat update data detail jenis kegiatan, silakan coba lagi.";
		}else{
			if($id_kegiatan_detail != ''){
				$status = "success";
				$msg = "Update data detail jenis kegiatan berhasil.";
			} else {
				$status = "success";
				$msg = "Input data detail jenis kegiatan berhasil.";
				}
			
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function hapus($id){
		$data = array(
				'Deleted' => 1,
				'UpdateBy' => $this->session->userdata('username'),
				'DateUpdated' => date("Y-m-d H:i:s")
			);
		$this->kegiatanpenghematan_model->edit($id,$data);
	}
	
	function listkegiatan(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$this->datatables->select('jenis_kegiatan,id_kegiatan,urutan')
			->where('Deleted <> 1')
			->from('tm_kegiatan');
		echo $this->datatables->generate();
	}
	function listdetailjenis_kegiatan(){
		$id_jenis_kegiatan = $this->input->get('id');
		$this->datatables->select('jenis_kegiatan,detail_jenis_energi,faktor_emisi,id_kegiatan_detail')
			->from('tm_jenis_kegiatan as a')
			->join('tm_jenis_kegiatandetail as b','a.id_kegiatan=b.id_kegiatan')
			->where('Deleted <> 1')
			->where('a.id_kegiatan',$id_jenis_kegiatan);
		echo $this->datatables->generate();
	}
	function getDetail($id){
		$rowdata = $this->kegiatanpenghematan_model->getById($id);
		echo json_encode($rowdata);
	}
	function savetocsv()
	{
		
		$this->load->dbutil();
		$this->load->helper('download');
		$query = $this->db->query("SELECT * FROM tm_jenis_kegiatan");
		$data = $this->dbutil->csv_from_result($query, ',');
		force_download('CSV_Report.csv', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */