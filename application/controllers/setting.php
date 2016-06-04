<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting extends CI_Controller {

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
		$this->data['module_id'] = '2';
		$this->load->model('User_model');
		$this->load->model('Privilege_model');
	}
	
	public function index()
	{
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->session->userdata('username');
			$this->data['message'] = "";
			$this->load->view('change_password', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	
	public function change_password()
	{
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->session->userdata('username');
			$this->data['message'] = "";
			$this->load->view('change_password', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function change_password_save()
	{
		if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$username = $this->input->post('user_name');
			$query = $this->db->query("SELECT password FROM tm_user WHERE user_name ='".$username."';");
			$row = $query->row(); //takes only one result row
			$old_password = $row->password;

			if($old_password==md5($this->input->post('old_password')))
			{
				$data = array(
					'password' => md5($this->input->post('password')),
				);
				
				$this->User_model->edit($username,$data);
				
				$this->data['privilege'] = $this->Privilege_model->get_all();
				$this->data['user'] = $this->session->userdata('username');

				$query = $this->db->query("SELECT email_perusahaan,real_name FROM tm_user WHERE user_name ='".$username."';");
				$row = $query->row(); //takes only one result row
				$old_email = $row->email_perusahaan;
				$real_name = $row->real_name;
				
				$subject = 'Ganti password Sistem Pelaporan Managemen Energi Online Berhasil';
				$message = 'Ganti password Sistem Pelaporan Managemen Energi Online untuk '.$real_name.' Berhasil.' . "\r\n" .
							'harap jaga kerahasiaan password anda. jika tidak merasa mengganti password atau lupa password, harap hubungi admin' . "\r\n" .
							'terima kasih';
				
				$fromx = urlencode("subdit_dka@yahoo.co.id");
				$tox = urlencode($old_email);
				$subjectx = urlencode($subject);
				$messagex = urlencode($message);

                $url_hit=  $this->config->item('api_email');
                $urlx = $url_hit."from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;
				file_get_contents($urlx);
				
				echo '<script>alert("Ganti Password Berhasil!"); history.back();</script>';
			}
			else
			{			
				$message = 'Password salah';
				$this->data['message'] = $message;
				$this->data['privilege'] = $this->Privilege_model->get_all();
				$this->data['user'] = $this->session->userdata('username');

				echo '<script>alert("Ganti Password Gagal! Password lama salah"); history.back();</script>';
				
			}
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */