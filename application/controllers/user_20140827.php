<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->data['module_id'] = '3';
		$this->load->model('User_model');
		$this->load->model('Privilege_model');
	}
	
	public function index()
	{
		if($this->Privilege_model->get_privilege_list($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->load->view('user_add', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	public function registration()
	{
		if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->load->view('user_add', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	public function detailperusahaan()
	{
		if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->load->view('user_detailperusahaan', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	public function inbox()
	{
		$username = $this->session->userdata('username');
		
		$query = $this->db->query("SELECT * FROM tm_user WHERE user_name ='".$username."';");
		$row = $query->row(); //takes only one result row		
		$idperusahaan = $row->Idperusahaan;		
		
		$this->load->view('user_inbox', $this->data);
		//echo $idperusahaan; 
	}
	public function kirimpesan()
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$id_perusahaanp = $this->input->get('idp');
 
			$query = $this->db->query("SELECT user_name, email_perusahaan,real_name FROM tm_user WHERE Idperusahaan ='".$id_perusahaanp."';");
			$row = $query->row(); //takes only one result row		
			$real_name = $row->real_name;
			$this->data['usernamep'] = $row->user_name;	
			$this->data['subjectp'] = '';
			$this->data['real_namep'] = $real_name; 
			$this->data['idp'] = $id_perusahaanp; 
			//$this->session->set_userdata('username',$this->session->userdata('username'));
			$this->load->view('user_kirim_pesan', $this->data);
		}
		else 
		{
			$reply = $this->input->get('rply');
			$idp = '1';
			$username = $this->session->userdata('username');
			if ($reply <> '')
			{				
				$query = $this->db->query("SELECT a.user_name as username, a.real_name as realname, a.Idperusahaan as idperusahaan, b.message as message, b.subject as subject FROM tm_user as a join t_pesan as b on a.user_name = b.sendby WHERE b.id_pesan = '".$reply."' and b.sendto ='".$username."';");
				$row = $query->row(); //takes only one result row		
				
				$this->data['real_namep'] = $row->realname; 
				$this->data['idp'] = $row->idperusahaan; 
				$this->data['messagep'] = $row->message;
				$this->data['subjectp'] = $row->subject;
				$this->data['usernamep'] = $row->username; 
			}
			else
			{
				
				$query = $this->db->query("SELECT user_name, email_perusahaan,real_name FROM tm_user WHERE Idperusahaan ='".$idp."';");
				$row = $query->row(); //takes only one result row		
				
				$real_name = $row->real_name;
				$this->data['usernamep'] = $row->user_name;	
				$this->data['subjectp'] = '';
				$this->data['real_namep'] = $real_name; 
				$this->data['idp'] = $idp; 
				
			}
			//$this->session->set_userdata('username',$this->session->userdata('username')); 
			$this->load->view('user_kirim_pesan', $this->data);
		}
	}
	public function get_list()
	{
		$this->load->helper('user_helper');
		$this->datatables->select('user_name, real_name, email_perusahaan, last_login, privilege_name, tm_user.active AS active');
		$this->datatables->add_column('action', get_user_action('$1'), 'user_name');
		$this->datatables->from('tm_user');
		$this->datatables->join('tm_privilege', 'tm_user.privilege_id = tm_privilege.privilege_id');
		echo $this->datatables->generate();
	}
	public function get_listinbox()
	{
		$this->load->helper('user_helper');
		$this->datatables->select('sendby, subject, datesend,id_pesan');		
		$this->datatables->from('tm_user as a');
		$this->datatables->join('t_pesan as b', 'a.Idperusahaan = b.Idperusahaan');
		$this->datatables->where('a.user_name',$this->session->userdata('username'));
		echo $this->datatables->generate();
	}
	public function get_listdetailperusahaan()
	{
		$this->load->helper('user_helper');
		$this->datatables->select('real_name, b.tahun,b.submit_step1, b.submit_step2, b.submit_step3, b.submit_step4, b.submit_step5, b.submit_step6, b.submit_step7, b.submit_step8, b.submit_akhir,a.idperusahaan');
		//$this->datatables->add_column('action', get_user_detailPerusahaan('$1'), 'a.idperusahaan');
		
		$this->datatables->from('tm_user as a');
		$this->datatables->join('t_statussubmit as b', 'a.idperusahaan = b.IdPerusahaan');
		echo $this->datatables->generate();
	}
	public function add()
	{
		if($this->Privilege_model->get_privilege_add($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->load->view('user_add', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	
	public function activation()
	{
		$activate =  $_SERVER['QUERY_STRING'];
		
		$data = array ('active' => 1);
		$this->db->trans_start();
		$this->db->where('password', $activate);
		$this->db->update('tm_user', $data);
		$this->db->trans_complete();
		
		redirect('logout');
	}
	public function edit($id)
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->User_model->getbyusername($id);
			$this->load->view('user_edit', $this->data);
			
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	public function bacainbox()
	{
		$id = $this->input->get('id');
		$username = $this->session->userdata('username');
		
		$datapesan = array('isread' => '1');
		
		$this->User_model->updateReadPesan($id,$username,$datapesan);
		
		$query = $this->db->query("SELECT * FROM t_pesan WHERE id_pesan = '".$id."' and sendto ='".$username."';");
		$row = $query->row(); //takes only one result row		
		$this->data['judulpesan'] = $row->subject;
		$this->data['isipesan'] = $row->message;
		$this->data['nopesan'] = $row->id_pesan;
		
		
		$this->load->view('user_bacainbox', $this->data);
	}
	public function add_save()
	{
		$password = substr(md5($this->input->post('user_name')),0,7);
		$nama_perusahaan = $this->input->post('real_name');
		$data_perusahaan = array(
			'TypePerusahaan' => 0,
			'NamaPerusahaan' =>$nama_perusahaan
		);
		$this->db->trans_start();
		$this->db->insert('tm_perusahaan',$data_perusahaan);
		$id_perusahaan = $this->db->insert_id();
		$this->db->trans_complete();
			
		
				
		$data = array(
			'user_name' => $this->input->post('user_name'),
			'Idperusahaan' => $id_perusahaan,
			'password' => md5($password),
			'email_perusahaan' => $this->input->post('email_perusahaan'),
			'privilege_id' => $this->input->post('privilege_id'),
			'real_name' => $nama_perusahaan,
			'active' => 0,
			'create_by' => $this->session->userdata('username'),
			'create_date' => 'NOW()'			
		);
		
		$this->User_model->insert($data);
		
		$activation_code = base_url("activation/?".md5($password));
		$to      = $this->input->post('email_perusahaan');
		$subject = 'Aktivasi user untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM ';
		$message = 'hello'. "\r\n".
			'username : '.$this->input->post('user_name')."\r\n".
			'password : '.$password."\r\n".
			"Activation Link: ".$activation_code;
			//$headers = 'From: info@creativenesia.com' . "\r\n" .
			//'Reply-To: info@creativenesia.com' . "\r\n" .
			$headers = 'From: '.admin_email(). "\r\n" .
			'Reply-To: '.admin_email(). "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		
		redirect('user/registration');
	}
	
	public function reset($id)
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
			{
				$this->data['privilege'] = $this->Privilege_model->get_all();
				$this->data['user'] = $this->User_model->getbyusername($id);
				
				
				
				$query = $this->db->query("SELECT password, email_perusahaan FROM tm_user WHERE user_name ='".$id."';");
				$row = $query->row(); //takes only one result row
				$direset = $row->password;
				$email = $row->email_perusahaan;
				$newpass = substr($direset,0,7);

				$data = array(			
					'password' => md5($newpass)			
				);			
				
				
				$to      = $email;
				$subject = 'Reset password untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM ';
				$message = 'hello'. "\r\n".
				'username : '.$id."\r\n".
				'password : '.$newpass."\r\n";
				//$headers = 'From: info@creativenesia.com' . "\r\n" .
				//'Reply-To: info@creativenesia.com' . "\r\n" .
				$headers = 'From: '.admin_email() . "\r\n" .
				'Reply-To: '.admin_email() . "\r\n" .

				'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				$this->User_model->edit($id,$data);		

				echo '<script>alert("Reset Password Berhasil!"); history.back();</script>';
						


			}
			else
			{
				$this->load->view('no_access', $this->data);
			}
	}
	public function nonactive($id)
	{
	if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->User_model->getbyusername($id);
			
			$query = $this->db->query("SELECT active FROM tm_user WHERE user_name ='".$id."';");
			$row = $query->row(); //takes only one result row
			$activenow = $row->active;
			
			if ($activenow == 1)
			{
				$data = array('active' => 0);	
			}
			else
			{
				$data = array('active' => 1);
			}
			$this->User_model->edit($id,$data);		
	
			redirect('user/registration');
			
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}
	public function change_email($id)
	{
		if($this->Privilege_model->get_privilege_edit($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->User_model->getbyusername($id);

			$query = $this->db->query("SELECT email_perusahaan,real_name FROM tm_user WHERE user_name ='".$id."';");
			$row = $query->row(); //takes only one result row
			$old_email = $row->email_perusahaan;
			$real_name = $row->real_name;
			
			$this->data['user_name'] = $id;
			$this->data['old_email'] = $old_email; 
			$this->data['real_name'] = $real_name; 
			
			$this->load->view('user_change_email_perusahaan', $this->data);

		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
		
	}
	public function printpesan()
	{
		$idpesan = $this->input->get('id');
		$usernameq = $this->session->userdata('username');
		$query = $this->db->query("SELECT message, subject, datesend  FROM t_pesan where id_pesan = '".$idpesan."' and  sendto = '".$usernameq."';");
		$row = $query->row();		
		$html = $row->message;
		$judul = $row->subject;
		$tanggal = $row->datesend;
		
		ini_set('memory_limit','48M'); 
		//$html = $this->load->view('print_lihatlaporan', $this->data, true); // render the view into HTML
		//$this->load->view('print_lihatlaporan', $this->data);
		//ob_clean(); 
		$this->load->helper(array('pdf_lihatlaporan'));   //  Load helper
		create_pdf($html,$judul."_".$tanggal ); //Create pdf
		redirect('user/inbox');
	}
	public function add_kirim_pesan()
	{
		$idp = $this->input->get('idp');
		$judul = $this->input->post('judul_pesan');
		$usernameq = $this->session->userdata('username');
		if ($this->input->post('template')=='template1')
		{
			//no urut
			$query_no_surat = $this->db->query("SELECT MAX(id_pesan) AS id_pesan FROM t_pesan;");
			$row_no_surat = $query_no_surat->row();		
			$maxid = $row_no_surat->id_pesan + 1;		
			$no_urut = $maxid."/EM/".date('m/Y');
			//info perusahaan
			$query_p = $this->db->query("SELECT NamaPerusahaan, AlamatPerusahaan, KotaKab, Prov,user_name FROM tm_perusahaan as a join tm_user as b on a.IdPerusahaan=b.Idperusahaan where a.IdPerusahaan = '".$idp."';");
			$row_p = $query_p->row();		
			$nama_perusahaan = $row_p->NamaPerusahaan;		
			$alamat_perusahaan = $row_p->AlamatPerusahaan." ".$row_p->KotaKab." ".$row_p->Prov;
			$username = $row_p->user_name;
			//isi catatan
			$pesan = $this->input->post('isi_pesan');
			//$emailesdm = 'subdit_dka@yahoo.com';
			$emailesdm = admin_email();
			
			$html = $this->load->view('template_pesan', $this->data, true);
			$html = str_replace('[pathimg]',  base_url(). "img/Logo_ESDM.gif" , $html);
			$html = str_replace('[no_urut]', $no_urut, $html);
			$html = str_replace('[tanggal]', date('d/m/Y'), $html);
			$html = str_replace('[nama_perusahaan]', $nama_perusahaan, $html);
			$html = str_replace('[alamat_perusahaan]', $alamat_perusahaan, $html);
			$html = str_replace('[username]', $username, $html);
			$html = str_replace('[email_esdm]', $emailesdm, $html);
			$html = str_replace('[pesan]', $pesan, $html);
			
		}
		else
		{
			$html = $this->input->post('isi_pesan');
			$no_urut = 'default';
		}
		
		
		$query = $this->User_model->getallbyidperusahaan($this->data,$idp);
		$email = $query['email_perusahaan'];
		
		
		$datapesan = array(
			'IdPerusahaan' => $idp,
			'no_surat' => $no_urut,
			'emailto' => $email,
			'subject' => $judul,
			'message' => $html,
			'sendby' => $usernameq,
			'sendto' => $this->input->post('usernamep'),
			'datesend' => date('Y-m-d H:i:s')
		);
		
		if ($this->session->userdata('privilege_id')=='2' )
		{
			$to      = $email;
			$subject = $judul;
			$message = $html;
			
			//$headers = "From: info@creativenesia.com\r\n";
			//$headers .= "Reply-To: info@creativenesia.com\r\n";
			$headers = "From: ".admin_email()." \r\n";
			$headers .= "Reply-To: ".admin_email()." \r\n";
			$headers .= "CC: ".admin_email()." \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			//$headers = 'From: info@creativenesia.com' . "\r\n" .
			//'Reply-To: info@creativenesia.com' . "\r\n" .
			//'X-Mailer: PHP/' . phpversion();
			
			
			
			//echo $html;
			mail($to, $subject, $message, $headers);
		}	
		$this->User_model->insertpesan($datapesan);		
		//echo $this->input->post('usernamep')."|".$this->input->post('real_namep');
		redirect('user/inbox');
		
		
	}
	public function add_save_change_email()
	{
		$old_email = $this->input->post('old_email');
		$new_email = $this->input->post('new_email_perusahaan');
		$id=$this->input->post('user_name');
		$data = array(
			'email_perusahaan' => $new_email
		);
		//send ke email lama		
		$to      = $old_email;
		$subject = 'Ganti email untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM ';
		$message = 'hello'. "\r\n".
		'email perusahaan telah di ganti menjadi:'. "\r\n".
		$new_email."\r\n".
		'bila tidak merasa mengganti, harap hubungi kami'. "\r\n";
		$headers = 'From: ' .admin_email(). "\r\n" .
		'Reply-To: ' .admin_email(). "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		//send ke email baru
		$to1      = $new_email;
		$subject1 = 'Ganti email untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM ';
		$message1 = 'hello'. "\r\n".
		'email perusahaan telah berhasil di ganti menjadi '.$new_email. "\r\n";
		$headers1 = 'From: ' .admin_email(). "\r\n" .
		'Reply-To: ' .admin_email(). "\r\n" .
		'X-Mailer: PHP/' . phpversion();


		mail($to1, $subject1, $message1, $headers1);
		mail($to, $subject, $message, $headers);
		$this->User_model->edit($id,$data);	
		redirect('user');
		
	}
	public function edit_save()
	{
		if($this->input->post('change_password') == 1)
		{
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'password' => md5($this->input->post('password')),
				'privilege_id' => $this->input->post('privilege_id'),
				'real_name' => $this->input->post('real_name'),
				'active' => 1,
				'create_by' => $this->session->userdata('username'),
				'create_date' => 'NOW()'			
			);
		}
		else
		{
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'privilege_id' => $this->input->post('privilege_id'),
				'real_name' => $this->input->post('real_name'),
				'active' => 1,
				'create_by' => $this->session->userdata('username'),
				'create_date' => 'NOW()'			
			);
		}
		$this->User_model->edit($this->input->post('user_name'),$data);
		redirect('user');
	}
	
	public function view($id)
	{
		if($this->Privilege_model->get_privilege_view($this->session->userdata('privilege_id'), $this->data['module_id']) == 1)
		{
			$this->data['privilege'] = $this->Privilege_model->get_all();
			$this->data['user'] = $this->User_model->getbyusername($id);
			$this->load->view('user_view', $this->data);
		}
		else
		{
			$this->load->view('no_access', $this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */