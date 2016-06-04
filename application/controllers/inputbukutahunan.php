<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inputbukutahunan extends CI_Controller {

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
		$this->load->model('bukutahunan_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->load->view('inputbukutahunan', $this->data);
	}
	
	function save(){	
		$status = '';
		$msg = '';	
		if($status != 'error'){
			$id_bukutahunan= $_POST['id_bukutahunan'];
			$nama_bukutahunan= $_POST['nama_bukutahunan'];
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
					if($id_bukutahunan == ''){
						$data = array(
							'nama_bukutahunan' => $nama_bukutahunan,
							'file_bukutahunan' => $datafile['file_name'],
							'create_by' => $this->session->userdata('username'),
							'create_date' => date("Y-m-d H:i:s")
						);
						$id_bukutahunan = $this->bukutahunan_model->insert($data);
					}else{						
						$data = array(
							'nama_bukutahunan' => $nama_bukutahunan,
							'file_bukutahunan' => $datafile['file_name'],
							'update_by' => $this->session->userdata('username'),
							'update_date' => date("Y-m-d H:i:s")
						);
						$this->bukutahunan_model->edit($id_bukutahunan,$data);
					}
					$this->db->trans_complete();
					if($this->db->trans_status() === FALSE)
					{
						unlink($datafile['full_path']);
						$status = "error";
						$msg = "Buku tahunan gagal disimpan, silakan coba lagi.";
					}
					else
					{
						$status = "success";
						$msg = "Buku tahunan berhasil disimpan.";
					}
				}
				@unlink($_FILES[$file_element_name]);
			}else{
				$this->db->trans_start();
				if($id_bukutahunan == ''){
					$data = array(
						'nama_bukutahunan' => $nama_bukutahunan,
						'create_by' => $this->session->userdata('username'),
						'create_date' => date("Y-m-d H:i:s")
					);
					$id_bukutahunan = $this->bukutahunan_model->insert($data);
				}else{						
					$data = array(
						'nama_bukutahunan' => $nama_bukutahunan,
						'update_by' => $this->session->userdata('username'),
						'update_date' => date("Y-m-d H:i:s")
					);
					$this->bukutahunan_model->edit($id_bukutahunan,$data);
				}
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$status = "error";
					$msg = "Buku tahunan gagal disimpan, silakan coba lagi.";
				}else{
					$status = "success";
					$msg = "Buku tahunan berhasil disimpan.";
				}
			}			
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function get_list(){
		$this->datatables->select('nama_bukutahunan, create_by, create_date, update_by, update_date, id_bukutahunan', false)
			->from('tm_bukutahunan');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->bukutahunan_model->getById($id);
		echo json_encode($rowdata);
	}
	
	function hapus($id){
		$status = '';
		$msg = '';
		$this->db->trans_start();
		$this->bukutahunan_model->del($id);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE)
		{
			$status = "error";
			$msg = "Buku tahunan gagal dihapus, silakan coba lagi.";
		}else{
			$status = "success";
			$msg = "Buku tahunan berhasil dihapus.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */