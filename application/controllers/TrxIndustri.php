<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TrxIndustri extends CI_Controller {

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
		$this->data['menugroup'] = 0;
		//$this->load->model('typeperusahaan_model');
		//$this->load->model('subsektor_model');
		//$this->load->model('mchain_model');
		$this->load->model('privilege_model');
		//$this->load->model('perusahaan_model');
		$this->load->model('trxindustri_model');
	}
	
	public function index()
	{
		
		$this->load->view('contoh', $this->data);
	}

	public function add_save()
	{
		//if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		//{
			
			$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'OrgMgmntEnergi' => $this->input->post('OrgManajEnergi'),
				'PathFileOrg' => $this->input->post('FileOrg'),
				'MgrEnergi' => $this->input->post('ManajEnergi'),
				'NamaMgrEnergi' => $this->input->post('NamaManaj'),
				'EmailMgrEnergi' => $this->input->post('EmailManaj'),
				'NoTlpMgrEnergi' => $this->input->post('NoManaj'),
				'NoSertMgrEnergi' => $this->input->post('NoSertifikat'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		

		$config['upload_path'] = '.\uploads';
		$config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|xls|xlsx';
		$config['max_size']	= '10000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('contoh', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			//$this->load->view('upload_success', $data);
		}

			$this->trxindustri_model->inserttrxindustri($data);	

			$this->db->trans_complete();
			redirect('ManajemenEnergi/step2');

	}

public function add_save2()
	{
			
			$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'JnsProduksi' => $this->input->post('JnsProduksi'),
				'Jumlah' => $this->input->post('Jumlah'),
				'Satuan' => $this->input->post('Satuan'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		
			$this->trxindustri_model->inserttrxindustri_step2($data);	

			$this->db->trans_complete();
			redirect('ManajemenEnergi/step3');

	}

public function add_save3()
	{
			
			$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'JnsEnergi' => $this->input->post('JnsEnergi'),
				'JmlPakaiOriginalUnit' => $this->input->post('JmlhOriginalUnit'),
				'JmlPakaiGJoule' => $this->input->post('JmlhGJoule'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		
			$this->trxindustri_model->inserttrxindustri_step3	($data);	

			$this->db->trans_complete();
			redirect('ManajemenEnergi/step4');

	}

public function add_save4()
	{
			
			$this->db->trans_start();
			$data = array(
				'IdPerusahaan' => $this->session->userdata('id_perusahaan'),
				'JmlPakaiEnergi' => $this->input->post('JmlPemakaianEnergi'),
				'Produksi' => $this->input->post('Produksi'),
				'KonsEnergiSpesifik' => $this->input->post('KonsEnergiSpesifik'),
				'CreatedBy' => $this->session->userdata('username'),
				'DateCreated' => date("Y-m-d H:i:s")
			);
		
			$this->trxindustri_model->inserttrxindustri_step4	($data);	

			$this->db->trans_complete();
			redirect('ManajemenEnergi/step5');

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */