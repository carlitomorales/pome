<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orgenergi extends CI_Controller {

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
		$this->load->model('orgenergi_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->data['data_jenisenergi'] = $this->jenisenergi_model->get_fordropdown();
		$this->data['data_jenisenergi1'] = $this->jenisenergi_model->getJenisEnergiLain();
		
		
		$this->thedata['thename'] = $this->session->userdata('username');
		$querydata = $this->orgenergi_model->cekdata($this->data);

		$this->data['idnya'] = $querydata['Id'];
		$this->data['pathfile'] = $querydata['PathFileOrg'];
		$this->data['pathfilesertifikat'] = $querydata['PathFileSertifikat'];
		$this->data['emailmanager'] = $querydata['EmailMgrEnergi'];
		$this->data['namamanager'] = $querydata['NamaMgrEnergi'];
		$this->data['notelepon'] = $querydata['NoTlpMgrEnergi'];
		$this->data['nosertifikat'] = $querydata['NoSertMgrEnergi'];
		
		if($querydata['OrgMgmntEnergi'] == '1'){
			$this->data['adaorganisasi'] = " value=1 checked";
			$this->data['tidakadaorganisasi'] = " value=0 ";
		}else{
			$this->data['adaorganisasi'] = " value=1 ";
			$this->data['tidakadaorganisasi'] = " value=0 checked";
		}		
		
		if($querydata['MgrEnergi'] == '1'){
			$this->data['adamanager'] = " value=1 checked";
			$this->data['tidakadamanager'] = " value=0 ";
		}else{
			$this->data['adamanager'] = " value=1 ";
			$this->data['tidakadamanager'] = " value=0 checked";
		}
		
		if ($this->session->userdata('type_perusahaan') == '1' || $this->session->userdata('type_perusahaan') == '2')
		{
			$this->load->view('inputorg', $this->data);
		}else
		{
			redirect('Perusahaan/add');
		}
	}

 public function save()
		{
		$FileUploads = 'FileOrg';
		
				if($_FILES['FileOrg']['name'] !=''){
					list($thefilename,$theext) = explode(".", trim($_FILES['FileOrg']['name']));
					$config['file_name'] = $thefilename."_".date("Ymhhis");
				}else{
					$theext = "";
					$config['file_name']="";
				}
		
		
		$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
				'PathFileOrg' => $config['file_name'].".".$theext,
				'MgrEnergi' => $this->input->post('ManajEnergi'),
				'NamaMgrEnergi' => $this->input->post('NamaManaj'),
				'EmailMgrEnergi' => $this->input->post('EmailManaj'),
				'NoTlpMgrEnergi' => $this->input->post('NoManaj'),
				'NoSertMgrEnergi' => $this->input->post('NoSertifikat'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '10000';
		
		
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		
	if($_FILES['FileOrg']['name'] !=''){

			if ( ! $this->upload->do_upload($FileUploads))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_error', $error);
				redirect('orgenergi/');
			}
			else
			{
			
				$this->orgenergi_model->insertorgenergi($data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				redirect('orgenergi/');
			}

	}else{
				$this->orgenergi_model->insertorgenergi($data);
				$this->db->trans_complete();
			  redirect('orgenergi/');
	}	
		
		//$this->load->view('upload_error', $error);

		}


 public function edit()
		{
		$FileUploads = 'FileOrg';
		
				if($_FILES['FileOrg']['name'] !=''){
					list($thefilename,$theext) = explode(".", trim($_FILES['FileOrg']['name']));
					$config['file_name'] = $thefilename."_".date("Ymhhis");
				}else{
					$theext = "";
					$config['file_name']=$this->input->post('thefileorg');
				}
		
		
		$this->db->trans_start();
			$data = array(
			    'id' => $this->input->post('idnya'),
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
				'PathFileOrg' => $config['file_name'].".".$theext,
				'MgrEnergi' => $this->input->post('ManajEnergi'),
				'NamaMgrEnergi' => $this->input->post('NamaManaj'),
				'EmailMgrEnergi' => $this->input->post('EmailManaj'),
				'NoTlpMgrEnergi' => $this->input->post('NoManaj'),
				'NoSertMgrEnergi' => $this->input->post('NoSertifikat'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		
			
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '10000';
		
		
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		$id = $this->input->post('idnya');
		
	if($_FILES['FileOrg']['name'] !=''){

			if ( ! $this->upload->do_upload($FileUploads))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_error', $error);
				redirect('orgenergi/');
			}
			else
			{
			
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				redirect('orgenergi/');
			}

	}else{
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			 	 redirect('orgenergi/');
	}	
		
		//$this->load->view('upload_error', $error);

		}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */