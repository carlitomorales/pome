<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditenerginew extends CI_Controller {

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
		$this->load->model('jenisperalatan_model');
		$this->load->model('peralatanpemanfaatenergi_model');
		$this->load->model('lihatlaporan_model');
		$this->load->model('rekomendasi_model');
	}
	
	public function index()
	{

		//Dropdown master 
		$typeperusahaan = $this->session->userdata('type_perusahaan');
		$idp = $this->session->userdata('id_perusahaan');
        $tahun = date("Y") - 1;
		$this->data['data_peralatan'] = $this->peralatanpemanfaatenergi_model->get_fordropdowndetail($idp);
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();

        $this->data['newjenisperalatan'] = $this->jenisperalatan_model->getPeralatanById($this->session->userdata('id_perusahaan'), $tahun);
        $this->data['newlistjenisperalatan'] = $this->jenisperalatan_model->listperalatanpemanfaatenergi($this->session->userdata('id_perusahaan'), $tahun);

        $this->data['newaudit'] = $this->jenisperalatan_model->getAudit($this->session->userdata('id_perusahaan'), $tahun);

		$this->load->view('inputauditenerginew', $this->data);
	}
	
	function save(){

		$status = '';
		$msg = '';
		if(empty($_POST['id_peralatan_pemanfaat_energi'])){
			$status = 'error';
			$msg = 'Silakan pilih peralatan pemanfaat energi utama yang akan dilaporkan hasil auditnya.';
		}
		if(empty($_POST['status_audit'])){
			$status = 'error';
			$msg = 'Silakan pilih status audit.';
		}
		if(empty($_POST['keterangan_audit'])){
			$status = 'error';
			$msg = 'Silakan isi keterangan hasil audit.';
		}

		if(empty($_POST['bulan_pelaksanaan']) && $_POST['status_audit'] == '1'){
			$status = 'error';
			$msg = 'Silakan isi bulan pelaksanaan auditor.';
		}
		if(empty($_POST['tahun_pelaksanaan'])&& $_POST['status_audit'] == '1'){
			$status = 'error';
			$msg = 'Silakan isi tahun pelaksanaan auditor.';
		}
		if(empty($_POST['nama_auditor'])&& $_POST['status_audit'] == '1'){
			$status = 'error';
			$msg = 'Silakan isi nama auditor.';
		}
		if(empty($_POST['nomor_sertifikat'])&& $_POST['status_audit'] == '1'){
			$status = 'error';
			$msg = 'Silakan isi nomor sertifikat auditor.';
		}
		if(empty($_POST['id_audit'])&& $_POST['id_audit'] == '1'){
			$status = 'error';
			$msg = '';
		}
		
		if($status != 'error'){
            $id_audit = $_POST['id_audit'];
			$id_peralatan_pemanfaat_energi = $_POST['id_peralatan_pemanfaat_energi'];
			$status_audit = $_POST['status_audit'];
			$keterangan_audit = $_POST['keterangan_audit'];
			$file_element_name = 'fileRingkas';

			$bulan_pelaksanaan = $_POST['bulan_pelaksanaan'];
			$tahun_pelaksanaan = $_POST['tahun_pelaksanaan'];
			$nama_auditor = $_POST['nama_auditor'];
			$level_audit = $_POST['level_audit'];
			$no_sertifikat_auditor = $_POST['nomor_sertifikat'];
			
			if($_FILES['fileRingkas']['tmp_name'] != ''){
				$config['upload_path'] = './uploads/audit/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = 1024 * 8;
				$config['encrypt_name'] = TRUE;
				
				$this->load->library('upload', $config);
	 
				if (!$this->upload->do_upload($file_element_name))
				{
					$status = 'error';
					$msg = $this->upload->display_errors('', '');
				}
				else
				{
					$datafile = $this->upload->data();
					$this->db->trans_start();
                    if ($id_audit == 'i'){
					$data = array(
                        'id_perusahaan' => $this->session->userdata('id_perusahaan'),
                        'tahun' => date("Y") - 1,
                        'status_audit' => $status_audit,
                        'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
                        'level_audit' => $level_audit,
                        'bulan_pelaksanaan ' => $bulan_pelaksanaan ,
                        'tahun_pelaksanaan' => $tahun_pelaksanaan,
                        'nama_auditor' => $nama_auditor,
                        'no_sertifikat_auditor' => $no_sertifikat_auditor,
                        'keterangan' => $keterangan_audit,
						'file_audit' => $datafile['file_name'],
                        'create_by' => $this->session->userdata('username'),
						'create_date' => date("Y-m-d H:i:s")
					);
					$this->jenisperalatan_model->insertaudit($data);
                    }else{
                        $data = array(
                            'status_audit' => $status_audit,
                            'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
                            'level_audit' => $level_audit,
                            'bulan_pelaksanaan ' => $bulan_pelaksanaan ,
                            'tahun_pelaksanaan' => $tahun_pelaksanaan,
                            'nama_auditor' => $nama_auditor,
                            'no_sertifikat_auditor' => $no_sertifikat_auditor,
                            'keterangan' => $keterangan_audit,
                            'file_audit' => $datafile['file_name'],
                            'update_by' => $this->session->userdata('username'),
                            'update_date' => date("Y-m-d H:i:s")
                        );
                        $this->jenisperalatan_model->updateaudit($id_audit,$data);
                    }
					$this->db->trans_complete();
					if($this->db->trans_status() === FALSE)
					{
						unlink($datafile['full_path']);
						$status = "error";
						$msg = "Audit energi gagal disimpan, silakan coba lagi.";
					}
					else
					{
						$this->stepsubmit();
						$status = "success";
						$msg = "Audit energi berhasil disimpan.";
					}
				}
				@unlink($_FILES[$file_element_name]);
			}else{
				$this->db->trans_start();
                if ($id_audit == 'i'){
                    $data = array(
                        'id_perusahaan' => $this->session->userdata('id_perusahaan'),
                        'tahun' => date("Y") - 1,
                        'status_audit' => $status_audit,
                        'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
                        'level_audit' => $level_audit,
                        'bulan_pelaksanaan ' => $bulan_pelaksanaan ,
                        'tahun_pelaksanaan' => $tahun_pelaksanaan,
                        'nama_auditor' => $nama_auditor,
                        'no_sertifikat_auditor' => $no_sertifikat_auditor,
                        'keterangan' => $keterangan_audit,
                        'create_by' => $this->session->userdata('username'),
                        'create_date' => date("Y-m-d H:i:s")
                    );
                    $this->jenisperalatan_model->insertaudit($data);
                }else {
                    $data = array(
                        'status_audit' => $status_audit,
                        'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
                        'level_audit' => $level_audit,
                        'bulan_pelaksanaan ' => $bulan_pelaksanaan,
                        'tahun_pelaksanaan' => $tahun_pelaksanaan,
                        'nama_auditor' => $nama_auditor,
                        'no_sertifikat_auditor' => $no_sertifikat_auditor,
                        'keterangan' => $keterangan_audit,
                        'update_by' => $this->session->userdata('username'),
                        'update_date' => date("Y-m-d H:i:s")
                    );
                    $this->jenisperalatan_model->updateaudit($id_audit, $data);
                }
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$status = "error";
					$msg = "Audit energi gagal disimpan, silakan coba lagi.";
				}else{
					$this->stepsubmit();
					$status = "success";
					$msg = "Audit energi berhasil disimpan.";
				}
			}			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function saveRekomendasi(){
		$status = "";
		$msg = "";
		
		
		$id_rekomendasi_audit = $this->input->post('id_rekomendasi_audit');
		$id_peralatan_pemanfaat_energi = $this->input->post('id_peralatan');
 		$rekomendasi= $this->input->post('rekomendasi');
		$potensi_penghematan = $this->input->post('potensi_hemat');
		$jenis_rekomendasi= $this->input->post('jenis_rekomendasi');
		$rencana_implementasi = $this->input->post('rencana_implemen');
		
		$this->db->trans_start();
		if($id_rekomendasi_audit != ''){
			$data = array(
				'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
				'rekomendasi' => $rekomendasi,
				'potensi_penghematan' => $potensi_penghematan,
				'jenis_rekomendasi' => $jenis_rekomendasi,
				'rencana_implementasi ' => $rencana_implementasi,
				'update_by' => $this->session->userdata('username'),
				'update_date' => date("Y-m-d H:i:s")
			);
			$this->rekomendasi_model->editLain($id_rekomendasi_audit,$data);
		}else{
			$data = array(
				'id_peralatan_pemanfaat_energi' => $id_peralatan_pemanfaat_energi,
				'rekomendasi' => $rekomendasi,
				'potensi_penghematan' => $potensi_penghematan,
				'jenis_rekomendasi' => $jenis_rekomendasi,
				'rencana_implementasi ' => $rencana_implementasi,
				'tahun' => date("Y")-1,
				'id_perusahaan' => $this->session->userdata('id_perusahaan'),
				'create_by' => $this->session->userdata('username'),
				'create_date' => date("Y-m-d H:i:s")
			);
			$newid = $this->rekomendasi_model->insertLain($data);
		}		
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$status = "error";
			$msg = "Terjadi kesalahan saat menyimpan data rekomendasi audit, silakan coba lagi.";
		}else{
			//$this->stepsubmit();
			$status = "success";
			$msg = "Penyimpanan data rekomendasi audit berhasil.";
		}
		echo json_encode(array("status"=>$status,"msg"=>$msg));
	}
	
	function hapusRekomendasi($id){
		$this->db->trans_start();
		$this->rekomendasi_model->delLain($id);
		$this->db->trans_complete();
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
				'submit_step8' => '1'
			);
		$this->lihatlaporan_model->edit($id,$data);		
		}else{		
			$data = array(
					'IdPerusahaan' => $id,
					'submit_step8' => '1',
					'tahun' => date("Y")-1
				);
			$this->lihatlaporan_model->insert($data);		
		}
		

	
	}
	
	function get_list(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit, a.keterangan_audit, a.file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, ruang_lingkup, bulan_pelaksanaan, tahun_pelaksanaan, nama_auditor, no_sertifikat_auditor', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		echo $this->datatables->generate();
	}
	
	function get_list_rekomendasi(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.id_peralatan_pemanfaat_energi, rekomendasi, potensi_penghematan, jenis_rekomendasi, rencana_implementasi, p.jenis_peralatan_lain, id_rekomendasi_audit',false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_rekomendasi_audit as a')
			->join('t_peralatan_pemanfaat_energi AS p', 'a.id_peralatan_pemanfaat_energi=p.id_peralatan_pemanfaat_energi')
			->join('tm_jenisperalatan AS c', 'p.id_jenis_peralatan=c.IdJenisPeralatan');
			
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->peralatanpemanfaatenergi_model->getById($id);
		echo json_encode($rowdata);
	}
	function getDetailRekomendasi($id){
		$rowdata = $this->rekomendasi_model->getByIdLain($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */