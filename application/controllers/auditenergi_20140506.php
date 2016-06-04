<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditenergi extends CI_Controller {

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
	}
	
	public function index()
	{
		//Dropdown master 
		 $typeperusahaan = $this->session->userdata('type_perusahaan');
		$this->data['jenisperalatan'] = $this->jenisperalatan_model->get_fordropdown($typeperusahaan);
		$this->data['jenisperalatanlain'] = $this->jenisperalatan_model->getJenisPeralatanLain();
		$this->load->view('inputauditenergi', $this->data);
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
		
		if($status != 'error'){
			$id_peralatan_pemanfaat_energi = $_POST['id_peralatan_pemanfaat_energi'];
			$status_audit = $_POST['status_audit'];
			$keterangan_audit = $_POST['keterangan_audit'];
			$file_element_name = 'fileRingkas';
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
					$data = array(
						'status_audit' => $status_audit,
						'keterangan_audit' => $keterangan_audit,
						'file_audit' => $datafile['file_name'],
						'update_by' => $this->session->userdata('username'),
						'update_date' => date("Y-m-d H:i:s")
					);
					$this->peralatanpemanfaatenergi_model->edit($id_peralatan_pemanfaat_energi,$data);
					$this->db->trans_complete();
					if($this->db->trans_status() === FALSE)
					{
						unlink($datafile['full_path']);
						$status = "error";
						$msg = "Audit energi gagal disimpan, silakan coba lagi.";
					}
					else
					{
						$status = "success";
						$msg = "Audit energi berhasil disimpan.";
					}
				}
				@unlink($_FILES[$file_element_name]);
			}else{
				$this->db->trans_start();
				$data = array(
					'status_audit' => $status_audit,
					'keterangan_audit' => $keterangan_audit,
					'update_by' => $this->session->userdata('username'),
					'update_date' => date("Y-m-d H:i:s")
				);
				$this->peralatanpemanfaatenergi_model->edit($id_peralatan_pemanfaat_energi,$data);
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$status = "error";
					$msg = "Audit energi gagal disimpan, silakan coba lagi.";
				}else{
					$status = "success";
					$msg = "Audit energi berhasil disimpan.";
				}
			}			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function get_list(){
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$tahun = date("Y")-1;
		$this->datatables->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit, a.keterangan_audit, a.file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi', false)
			->where('a.id_perusahaan = '.$id_perusahaan)
			->where('a.tahun = '.$tahun)
			->from('t_peralatan_pemanfaat_energi AS a')
			->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->peralatanpemanfaatenergi_model->getById($id);
		echo json_encode($rowdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */