<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function index()
	{
		$this->data['message'] = "Please login with your Username and Password.";
		$this->load->view('login', $this->data);
	}
	
	public function authorize()
	{
		$this->load->model('User_model');
		$this->load->model('perusahaan_model');
		// authenticate
		$uname = $this->input->post('username');
		$pwd = $this->input->post('password');
		$remember = $this->input->post('remember');
		
		if (!empty($uname) && !empty($pwd))  {
			$pwd = md5($pwd);
			$test_data = $this->User_model->get_login($uname,$pwd);
			
			if ($test_data) {
				foreach($test_data as $row)
				 {
					$this->session->set_userdata('username',$uname);
					$this->session->set_userdata('real_name',$row['real_name']);
					$this->session->set_userdata('privilege_id', $row['privilege_id']);
					$this->session->set_userdata('id_perusahaan',$row['Idperusahaan']);
					$getPerusahaan = $this->perusahaan_model->get_perusahaan($row['Idperusahaan']);
					if ($getPerusahaan) {
						foreach($getPerusahaan as $rowPerusahaan)
						{
							if ($rowPerusahaan['TypePerusahaan'] == 'Industri')
							{
								$this->session->set_userdata('type_perusahaan','1');							
							}
							elseif ($rowPerusahaan['TypePerusahaan'] == 'Bangunan')
							{
								$this->session->set_userdata('type_perusahaan','2');
							}
							else{$this->session->set_userdata('type_perusahaan',$rowPerusahaan['TypePerusahaan']);}
							
						}	
					}
				 }	
				redirect('dashboard');
			}else {
				$this->data['message'] = 'User name atau password anda salah, silahkan coba kembali';
				$this->load->view('dashboard', $this->data);
			}
		} else {
			$this->data['message'] = "Please login with your Username and Password.";
			$this->load->view('dashboard', $this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */