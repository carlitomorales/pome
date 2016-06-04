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
        $this->data['data_jabatanmanajerenergi'] = $this->orgenergi_model->Getjabatanmanajerenergi();
		
		$this->thedata['thename'] = $this->session->userdata('username');
		$querydata = $this->orgenergi_model->cekdata($this->data);
		$this->data['msgupload'] = "";
		$this->data['idnya'] = $querydata['Id'];
		$this->data['pathfile'] = $querydata['PathFileOrg'];
		$this->data['pathfilekebijakan'] = $querydata['PathFileKbjk'];
		$this->data['pathfilesertifikat'] = $querydata['PathFileSertifikat'];
		$this->data['emailmanager'] = $querydata['EmailMgrEnergi'];

		$this->data['jabatanmanajerenergi'] = $querydata['JabatanManajerEnergi'];
//		$this->data['namastaffmanager'] = $querydata['NamaStaffEnergi'];
//        $this->data['namaspvmanager'] = $querydata['NamaSpvEnergi'];
        $this->data['namamanager'] = $querydata['NamaMgrEnergi'];
//        $this->data['namagenmanager'] = $querydata['NamaGenEnergi'];
        $this->data['detailjabatan'] = $querydata['DetailJab'];
		$this->data['notelepon'] = $querydata['NoTlpMgrEnergi'];
		$this->data['nosertifikat'] = $querydata['NoSertMgrEnergi'];
		$this->data['kebijakanenergi'] = $querydata['KebijakanEnergi'];
		$this->data['orgmgmntenergi'] = $querydata['OrgMgmntEnergi'];
		
		if($querydata['OrgMgmntEnergi'] == '1'){
			$this->data['adaorganisasi'] = " value=1 checked";
			$this->data['tidakadaorganisasi'] = " value=0 ";
		}else{
			$this->data['adaorganisasi'] = " value=1 ";
			$this->data['tidakadaorganisasi'] = " value=0 checked";
		}		
		
		if($querydata['KebijakanEnergi'] == '1'){
			$this->data['adakebijakan'] = " value=1 checked";
			$this->data['tidakadakebijakan'] = " value=0 ";
		}else{
			$this->data['adakebijakan'] = " value=1 ";
			$this->data['tidakadakebijakan'] = " value=0 checked";
		}	
		
		if($querydata['MgrEnergi'] == '1'){
			$this->data['adamanager'] = " value=1 checked";
			$this->data['tidakadamanager'] = " value=0 ";
		}else{
			$this->data['adamanager'] = " value=1 ";
			$this->data['tidakadamanager'] = " value=0 checked";
		}
		
		$msg = $this->input->get('msg');
		if($msg != ''){
			$this->data['msg'] = $msg;
		}else{
			$this->data['msg'] = '';
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
		
		$FileUploads	       = 'FileOrg';
		$FileUploadsKebijakan  = 'FileKebijakan';
		$FileUploadsSertifikat = 'FileSertifikat';
		
		$fileorgname = $_FILES['FileOrg']['name'];
		$filekebijakanname = $_FILES['FileKebijakan']['name'];
		$filesertiname = $_FILES['FileSertifikat']['name'];
		
		
		if($fileorgname !=''){
			$fileorgname = str_replace("#", "", $fileorgname);
			$fileorgname = str_replace(" ", "_", $fileorgname);
			list($thefilename,$theext) = explode(".", trim($fileorgname));
			//$config['file_name'] = $thefilename."_".date("Ymhhis");
			$filenameorg = $thefilename."_".date("Ymhhis");
		}else{
			$filenameorg = "";
			
		}
		
		
		if($filekebijakanname !=''){
			$filekebijakanname = str_replace("#", "", $filekebijakanname);
			$filekebijakanname = str_replace(" ", "_", $filekebijakanname);
			list($thefilenamekebijakan,$theextkebijakan) = explode(".", trim($filekebijakanname));
			//$config['file_name'] = $thefilename."_".date("Ymhhis");
			$filenamekebijakan = $thefilenamekebijakan."_".date("Ymhhis");
		}else{
			$filenamekebijakan = "";
			
		}
		
		
		if($filesertiname !=''){
			$filesertiname = str_replace("#", "", $filesertiname);
			$filesertiname = str_replace(" ", "_", $filesertiname);
			list($thefilenamesertifikat,$theextsertifikat) = explode(".", trim($filesertiname));
			
			$filenamesertifikat = $thefilenamesertifikat."_".date("Ymhhis");
		}else{
			$filenamesertifikat = "";
		}				
		
		
		$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
				'PathFileOrg' => $filenameorg.".pdf",
				'KebijakanEnergi' => $this->input->post('KebijakanEnergi'),
				'PathFileKbjk' => $filenamekebijakan.".pdf",
				'PathFileSertifikat' => $filenamesertifikat.".pdf",
				'MgrEnergi' => $this->input->post('ManajEnergi'),
				'JabatanManajerEnergi' => $this->input->post('IdJabatanManajerEnergi'),
//				'NamaStaffEnergi' => $this->input->post('NamaStaffManaj'),
//                'NamaSpvEnergi' => $this->input->post('NamaSPVManaj'),
                'NamaMgrEnergi' => $this->input->post('NamaManaj'),
//                'NamaGenEnergi' => $this->input->post('NamaGenManaj'),
                'DetailJab' => $this->input->post('DetailJab'),
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
		
	if($fileorgname !=''){
			$this->upload->initialize($config); 	
			if ( ! $this->upload->do_upload($FileUploads))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_error', $error);
				//redirect('orgenergi/');
			}
			else
			{
			
				$this->orgenergi_model->insertorgenergi($data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				//redirect('orgenergi/');
			}

	}else{
				$this->orgenergi_model->insertorgenergi($data);
				$this->db->trans_complete();
			  	//redirect('orgenergi/');
	}	
		
		//$this->load->view('upload_error', $error);
	
	$config['upload_path'] = './uploads/';
	$config['allowed_types'] = 'pdf';
	$config['max_size']	= '10000';
	
	
	//$config['max_width']  = '1024';
	//$config['max_height']  = '768';

	$this->load->library('upload', $config);	
		
	if($fileorgname !=''){		
		$config['file_name'] = $filenameorg;
		$this->upload->initialize($config); 
		$this->upload->do_upload($FileUploads);
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		//redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}else{
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		//redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}	
	

	$config['upload_path'] = './uploads/';
	$config['allowed_types'] = 'pdf';
	$config['max_size']	= '10000';
	
	
	//$config['max_width']  = '1024';
	//$config['max_height']  = '768';

	$this->load->library('upload', $config);	
		
	if($filekebijakanname !=''){		
		$config['file_name'] = $filenamekebijakan;
		$this->upload->initialize($config); 
		$this->upload->do_upload($FileUploadsKebijakan);
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		//redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}else{
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		//redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}	
	
	
	$config['upload_path'] = './uploads/';
	$config['allowed_types'] = 'pdf';
	$config['max_size']	= '10000';
	
	
	//$config['max_width']  = '1024';
	//$config['max_height']  = '768';

	$this->load->library('upload', $config);	
		
	if($filesertiname !=''){		
		$config['file_name'] = $filenamesertifikat;
		$this->upload->initialize($config); 
		$this->upload->do_upload($FileUploadsSertifikat);
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}else{
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');		
		redirect('orgenergi');
		//$this->load->view('inputorg', $this->data);
	}	

  }

  public function edit()
		{
		
		$FileUploads	       = 'FileOrg';
		$FileUploadsKebijakan  = 'FileKebijakan';
		$FileUploadsSertifikat = 'FileSertifikat';
		
		$fileorgname = $_FILES['FileOrg']['name'];
		$filekebijakanname = $_FILES['FileKebijakan']['name'];
		$filesertiname = $_FILES['FileSertifikat']['name'];
		
		
		if($fileorgname !=''){
			$fileorgname = str_replace("#", "", $fileorgname);
			$fileorgname = str_replace(" ", "_", $fileorgname);
			list($thefilename,$theext) = explode(".", trim($fileorgname));
			$config['file_name'] = $thefilename."_".date("Ymhhis");
			$this->db->trans_start();
			$data = array(
				'id' => $this->input->post('idnya'),
			'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
			'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
			'KebijakanEnergi' => $this->input->post('IdkebijakanEnergi'),
			'PathFileOrg' => $config['file_name'].".".$theext,
			'MgrEnergi' => $this->input->post('ManajEnergi'),
            'JabatanManajerEnergi' => $this->input->post('IdJabatanManajerEnergi'),
//                'NamaStaffEnergi' => $this->input->post('NamaStaffManaj'),
//                'NamaSpvEnergi' => $this->input->post('NamaSPVManaj'),
            'NamaMgrEnergi' => $this->input->post('NamaManaj'),
//                'NamaGenEnergi' => $this->input->post('NamaGenManaj'),
            'DetailJab' => $this->input->post('DetailJab'),
			'EmailMgrEnergi' => $this->input->post('EmailManaj'),
			'NoTlpMgrEnergi' => $this->input->post('NoManaj'),
			'NoSertMgrEnergi' => $this->input->post('NoSertifikat'),
			'CreatedBy' => $this->session->userdata('username'),
			'DateCreated' => date("Y-m-d H:i:s")
			);
		}else{
			$theext = "";
			$config['file_name']=$this->input->post('thefileorg');
			$this->db->trans_start();
			$data = array(
				'id' => $this->input->post('idnya'),
			'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
			'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
			'KebijakanEnergi' => $this->input->post('IdkebijakanEnergi'),
			'PathFileOrg' => $config['file_name'],
			'MgrEnergi' => $this->input->post('ManajEnergi'),
            'JabatanManajerEnergi' => $this->input->post('IdJabatanManajerEnergi'),
//                'NamaStaffEnergi' => $this->input->post('NamaStaffManaj'),
//                'NamaSpvEnergi' => $this->input->post('NamaSPVManaj'),
            'NamaMgrEnergi' => $this->input->post('NamaManaj'),
//                'NamaGenEnergi' => $this->input->post('NamaGenManaj'),
            'DetailJab' => $this->input->post('DetailJab'),
			'EmailMgrEnergi' => $this->input->post('EmailManaj'),
			'NoTlpMgrEnergi' => $this->input->post('NoManaj'),
			'NoSertMgrEnergi' => $this->input->post('NoSertifikat'),
			'CreatedBy' => $this->session->userdata('username'),
			'DateCreated' => date("Y-m-d H:i:s")
			);					
		}		
			
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '10000';
		
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		$id = $this->input->post('idnya');
		
		
	if($fileorgname !=''){
			$this->upload->initialize($config); 	
			if ( ! $this->upload->do_upload($FileUploads))
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_error', $error);
				//redirect('orgenergi/');
			}
			else
			{
			
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				//redirect('orgenergi/');
			}

	}else{
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			 	 //redirect('orgenergi/');
	}	
		
		//$this->load->view('upload_error', $error);
	//////////////////////////////////////////////////////////////////////////////////////////////
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '10000';
		
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		if($filekebijakanname !=''){
			$filekebijakanname = str_replace("#", "", $filekebijakanname);
			$filekebijakanname = str_replace(" ", "_", $filekebijakanname);
			list($thefilenamekebijakan,$theextkebijakan) = explode(".", trim($filekebijakanname));
			$config['file_name'] = $thefilenamekebijakan."_".date("Ymhhis");
			$this->db->trans_start();
			$data = array(
			    'id' => $this->input->post('idnya'),				
				'KebijakanEnergi' => $this->input->post('KebijakanEnergi'),
				'PathFileKbjk' => $config['file_name'].".pdf",
				'DateCreated' => date("Y-m-d H:i:s")
			);		
		}else{
			$thefilenamekebijakan= "";
			$config['file_name']=$this->input->post('thefilenamekebijakan');
			$this->db->trans_start();
			$data = array(
			    'id' => $this->input->post('idnya'),				
				'PathFileKbjk' => $config['file_name'],
				'DateCreated' => date("Y-m-d H:i:s")
			);		
		}
		//echo $config['file_name'];
		
		if($filekebijakanname !=''){ 
			$this->upload->initialize($config); 	
			if ( ! $this->upload->do_upload($FileUploadsKebijakan))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_error', $error);
			}
			else
			{
			
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				//redirect('orgenergi/');
			}

		}else{
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			 	 //redirect('orgenergi/');
		}
	//////////////////////////////////////////////////////////////////////////////////////////////
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';  
		$config['max_size']	= '10000';
		
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		if($filesertiname !=''){
			$filesertiname = str_replace("#", "", $filesertiname);
			$filesertiname = str_replace(" ", "_", $filesertiname);
			list($thefilenamesertifikat,$theextsertifikat) = explode(".", trim($filesertiname));
			$config['file_name'] = $thefilenamesertifikat."_".date("Ymhhis");
			$this->db->trans_start();
			$data = array(
			    'id' => $this->input->post('idnya'),				
				'PathFileSertifikat' => $config['file_name'].".".$theextsertifikat,
				'DateCreated' => date("Y-m-d H:i:s")
			);		
		}else{
			$theextsertifikat= "";
			$config['file_name']=$this->input->post('thefilesertifikat');
			$this->db->trans_start();
			$data = array(
			    'id' => $this->input->post('idnya'),				
				'PathFileSertifikat' => $config['file_name'],
				'DateCreated' => date("Y-m-d H:i:s")
			);		
		}
		
		
		if($filesertiname !=''){ 
			$this->upload->initialize($config); 	
			if ( ! $this->upload->do_upload($FileUploadsSertifikat))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_error', $error);
			}
			else
			{
			
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			
				$data = array('upload_data' => $this->upload->data());

				//$this->load->view('upload_success', $data);
				//redirect('orgenergi/');
			}

		}else{
				$this->orgenergi_model->editorgenergi($id, $data);
				$this->db->trans_complete();
			 	 //redirect('orgenergi/');
		}
		$this->session->set_userdata('msgorgen','Data organisasi manajemen energi berhasil disimpan');			
		redirect('orgenergi/');
		//$this->load->view('inputorg', $this->data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */