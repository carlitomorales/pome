<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inputfaq extends CI_Controller {

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
		$this->load->model('faq_model');
	}
	
	public function index()
	{
		//Dropdown master 
		$this->load->view('inputfaq', $this->data);
	}
	
	function save(){	
		$status = '';
		$msg = '';	
		if($status != 'error'){
			$faq_id = $_POST['faq_id'];
			$question = $_POST['question'];
			$answer = $_POST['answer'];
			
			$this->db->trans_start();
			if($faq_id == ''){
				$data = array(
					'question' => $question,
					'answer' => $answer,
					'create_by' => $this->session->userdata('username'),
					'create_date' => date("Y-m-d H:i:s")
				);
				$news_id = $this->faq_model->insert($data);
			}else{						
				$data = array(
					'question' => $question,
					'answer' => $answer,
					'update_by' => $this->session->userdata('username'),
					'update_date' => date("Y-m-d H:i:s")
				);
				$this->faq_model->edit($faq_id,$data);
			}
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE)
			{
				unlink($datafile['full_path']);
				$status = "error";
				$msg = "FAQ gagal disimpan, silakan coba lagi.";
			}
			else
			{
				$status = "success";
				$msg = "FAQ berhasil disimpan.";
			}	
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
	function get_list(){
		$this->datatables->select('question, answer, create_by, create_date, update_by, update_date, faq_id', false)
			->from('t_faq');
		echo $this->datatables->generate();
	}
	
	function getDetail($id){
		$rowdata = $this->faq_model->getById($id);
		echo json_encode($rowdata);
	}
	
	function hapus($id){
		$status = '';
		$msg = '';
		$this->db->trans_start();
		$this->faq_model->del($id);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE)
		{
			$status = "error";
			$msg = "FAQ gagal dihapus, silakan coba lagi.";
		}else{
			$status = "success";
			$msg = "FAQ berhasil dihapus.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */