<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inputinfolain extends CI_Controller {

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
		$this->load->model('infolain_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->load->view('inputinfolain', $this->data);
	}
	
	function save(){	
		$status = '';
		$msg = '';	
		/*
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
		*/
		if($status != 'error'){
			$id_regulasi= $_POST['id_regulasi'];
			$nama_regulasi= $_POST['nama_regulasi'];
			//$publish_date = $_POST['publish_date'];
			//$sinopsis = $_POST['sinopsis'];
			//$detail = $_POST['detail'];
			$file_element_name = 'thumbnail';
			if($_FILES['thumbnail']['tmp_name'] != ''){
				$config['upload_path'] = './uploads/doc/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = 1024 * 10;
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
					if($id_regulasi == ''){
						$data = array(
							'nama_regulasi' => $nama_regulasi,
							//'publish_date' => $publish_date,
							//'sinopsis' => $sinopsis,
							//'detail' => $detail,
							'file_regulasi' => $datafile['file_name'],
							'create_by' => $this->session->userdata('username'),
							'create_date' => date("Y-m-d H:i:s")
						);
						$id_regulasi = $this->infolain_model->insert($data);
					}else{						
						$data = array(
							'nama_regulasi' => $nama_regulasi,
							//'publish_date' => $publish_date,
							//'sinopsis' => $sinopsis,
							//'detail' => $detail,
							'file_regulasi' => $datafile['file_name'],
							'update_by' => $this->session->userdata('username'),
							'update_date' => date("Y-m-d H:i:s")
						);
						$this->infolain_model->edit($id_regulasi,$data);
					}
					$this->db->trans_complete();
					if($this->db->trans_status() === FALSE)
					{
						unlink($datafile['full_path']);
						$status = "error";
						$msg = "Regulasi gagal disimpan, silakan coba lagi.";
					}
					else
					{
						$status = "success";
						$msg = "Regulasi berhasil disimpan.";
					}
				}
				@unlink($_FILES[$file_element_name]);
			}else{
				$this->db->trans_start();
				if($id_regulasi == ''){
					$data = array(
						'nama_regulasi' => $nama_regulasi,
						//'publish_date' => $publish_date,
						//'sinopsis' => $sinopsis,
						//'detail' => $detail,
						'create_by' => $this->session->userdata('username'),
						'create_date' => date("Y-m-d H:i:s")
					);
					$id_regulasi = $this->infolain_model->insert($data);
				}else{						
					$data = array(
						'nama_regulasi' => $nama_regulasi,
						//'publish_date' => $publish_date,
						//'sinopsis' => $sinopsis,
						//'detail' => $detail,
						'update_by' => $this->session->userdata('username'),
						'update_date' => date("Y-m-d H:i:s")
					);
					$this->infolain_model->edit($id_regulasi,$data);
				}
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$status = "error";
					$msg = "Regulasi gagal disimpan, silakan coba lagi.";
				}else{
					$status = "success";
					$msg = "Regulasi berhasil disimpan.";
				}
			}			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function get_list(){
		$this->datatables->select('nama_regulasi, create_date, create_by, update_date, update_by, id_regulasi', false)
			->from('tm_infolain');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->infolain_model->getById($id);
		echo json_encode($rowdata);
	}
	
	function hapus($id){
		$status = '';
		$msg = '';
		$this->db->trans_start();
		$this->infolain_model->del($id);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE)
		{
			$status = "error";
			$msg = "Regulasi gagal dihapus, silakan coba lagi.";
		}else{
			$status = "success";
			$msg = "Regulasi berhasil dihapus.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */