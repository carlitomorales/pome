<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege extends CI_Controller {

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
		$this->data['menugroup'] = '6';
		$this->data['module_id'] = '1';
		$this->load->model('Privilege_model');
	}
	
	public function index()
	{
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('privilege_list', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function get_list()
	{
		$this->load->helper('user_helper');
		$this->datatables->select('privilege_id, privilege_name, active as status')
		->unset_column('privilege_id')
		->add_column('action', get_privilege_action('$1'), 'privilege_id')
		->from('tm_privilege');
		echo $this->datatables->generate();
	}
	
	public function add()
	{
		if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('privilege_add', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function edit($id)
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->getbyid($id);
			$this->data['modules'] = $this->Privilege_model->getprivilegemodule($id);
			$this->load->view('privilege_edit', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function view($id)
	{
		if($this->Privilege_model->get_privilege_view($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->getbyid($id);
			$this->data['modules'] = $this->Privilege_model->getprivilegemodule($id);
			$this->load->view('privilege_view', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function add_save()
	{
		$this->db->trans_start();
		$data = array(
			'privilege_name' => $this->input->post('privilege_name'),
			'active' => 1,
			'create_by' => $this->session->userdata('username'),
			'create_date' => date('Y-m-d H:i:s')			
		);
		$this->Privilege_model->insert($data);
		$this->db->trans_complete();
		redirect('privilege');
	}
	
	public function edit_save()
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->db->trans_start();
			$privilege_id = $this->input->post('privilege_id');
			$data = array(
				'privilege_name' => $this->input->post('privilege_name'),
				'update_by' => $this->session->userdata('username'),
				'update_date' => date('Y-m-d H:i:s')	
			);
			$this->Privilege_model->edit($privilege_id, $data);
			$this->Privilege_model->delprivilegemodule($privilege_id);
			$module_id = $this->input->post('module_id');
			for($i=0;$i < count($module_id);$i++){
				$datadetail = array(
					'module_id' => $module_id[$i],
					'privilege_id' => $privilege_id,
					'add' => $this->input->post('add_'.$module_id[$i]),
					'edit' => $this->input->post('edit'.$module_id[$i]),
					'delete' => $this->input->post('delete_'.$module_id[$i]),
					'approve' => $this->input->post('approve_'.$module_id[$i]),
					'list' => $this->input->post('list_'.$module_id[$i]),
					'view' => $this->input->post('view_'.$module_id[$i]),
					'print' => $this->input->post('print_'.$module_id[$i])
				);
				$this->Privilege_model->insertprivilegemodule($datadetail);
			}
			
			$this->db->trans_complete();
			redirect('privilege');
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */