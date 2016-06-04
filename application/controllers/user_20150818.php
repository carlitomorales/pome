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
		$this->load->model('perusahaan_model');
		$this->load->library('curl'); 
		$this->load->library('encrypt');
		$this->load->library('upload');
		$this->ci =& get_instance();
        
        $this->configupload =  array(
                  'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/files/",
                  'upload_url'      => base_url()."upload/pesan/",
                  'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
                  'overwrite'       => TRUE,
                  'max_size'        => "5000KB",
                  'max_height'      => "768",
                  'max_width'       => "1024"   
                );
		
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


//			$this->load->view('user_detailperusahaan', $this->data);
            $this->load->view('user_detailperusahaan_new', $this->data);
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
		$this->data['allperusahaan'] = $this->perusahaan_model->get_all();
		//untuk kirim pesan
		
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
		}
		
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
		$this->datatables->where('b.type','0');
		echo $this->datatables->generate();
	}
	public function get_listinbox_notif()
	{
		$this->load->helper('user_helper');
		$this->datatables->select('sendby, subject, datesend,id_pesan');		
		$this->datatables->from('tm_user as a');
		$this->datatables->join('t_pesan as b', 'a.Idperusahaan = b.Idperusahaan');
		$this->datatables->where('a.user_name',$this->session->userdata('username'));
		$this->datatables->where('b.type','1');
		echo $this->datatables->generate();
	}
	public function get_listdetailperusahaan()
	{


        $s0 = $this->config->item('status_0');
        $s1 = $this->config->item('status_1');
        $s2 = $this->config->item('status_2');
        $s3 = $this->config->item('status_3');

		$this->load->helper('user_helper');
		$this->datatables->select("real_name, b.tahun,(CASE b.status WHEN 0 THEN '$s0' WHEN 1 THEN '$s1' WHEN 2 THEN '$s2' WHEN 3 THEN '$s3' END) as submit,a.idperusahaan");
		//$this->datatables->add_column('action', get_user_detailPerusahaan('$1'), 'a.idperusahaan');
		
		$this->datatables->from('tm_user as a');
		$this->datatables->join('t_statussubmit as b', 'a.idperusahaan = b.IdPerusahaan');
        $this->datatables->join('tm_perusahaan as c','a.idperusahaan = c.IdPerusahaan','inner');

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
		
		//$query = $this->db->query("SELECT * FROM t_pesan WHERE id_pesan = '".$id."' and sendto ='".$username."';");
		$query = $this->db->query("SELECT * FROM t_pesan WHERE id_pesan = '".$id."';");
		$row = $query->row(); //takes only one result row		
		$this->data['dari'] = $row->sendby;
		$this->data['judulpesan'] = $row->subject;
		$this->data['isipesan'] = $row->message;
		$this->data['attach'] = $row->attach;
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
		$message = 'silahkan menggunakan username dan password berikut untuk log in'. "\r\n".
			'username : '.$this->input->post('user_name')."\r\n".
			'password : '.$password."\r\n".
			"Activation Link: ".$activation_code;
		$headers = 'From: subdit_dka@yahoo.co.id' . "\r\n" .
			'Reply-To: subdit_dka@yahoo.co.id' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		//mail($to, $subject, $message, $headers);
		
		//$datamail = array (	'from' => 'subdit_dka@yahoo.co.id','to' => $to,'subject' => $subject ,'message' => $message );
		//$result = $this->curl->simple_post('http://dev.creativenesia.com/sendmail.php', //$datamail);
		
		$fromx = urlencode("subdit_dka@yahoo.co.id");
		$tox = urlencode($to);
		$subjectx = urlencode($subject);
		$messagex = urlencode($message);
		
		$urlx = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;

		//$urlx = "http://indodone.com/dev/shop/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;
		//$this->curl->simple_get($urlx);
		file_get_contents($urlx);
			
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
				$message = 'Reset password untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM telah berhasil.'. "\r\n". 
				'silahkan gunakan username dan password berikut' . "\r\n".
				'username : '.$id."\r\n".
				'password : '.$newpass."\r\n";
				$headers = 'From: subdit_dka@yahoo.co.id' . "\r\n" .
				'Reply-To: subdit_dka@yahoo.co.id' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				//mail($to, $subject, $message, $headers);
				
				//$datamail = array (	'from' => 'subdit_dka@yahoo.co.id','to' => $to,'subject' => $subject ,'message' => $message );
				//$result = $this->curl->simple_post('http://dev.creativenesia.com/sendmail.php', //$datamail);

				
				$from = 'subdit_dka@yahoo.co.id';
				$fromx = urlencode("subdit_dka@yahoo.co.id");
				$tox = urlencode($to);
				$subjectx = urlencode($subject);
				$messagex = urlencode($message);
				
				$urlx = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;
				//$urlx = "http://indodone.com/dev/shop/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;

				//echo $urlx;
				////$this->curl->simple_get($urlx);
				file_get_contents($urlx);
				
				$this->User_model->edit($id,$data);		

				
				//echo "<script>window.open(".$urlx."); history.back();</script>";
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
	
		$id = $this->input->get('id');
		$username = $this->session->userdata('username');
		
		$datapesan = array('isread' => '1');
		
		$this->User_model->updateReadPesan($id,$username,$datapesan);
		
		//$query = $this->db->query("SELECT * FROM t_pesan WHERE id_pesan = '".$id."' and sendto ='".$username."';");
		$query = $this->db->query("SELECT * FROM t_pesan WHERE id_pesan = '".$id."';");
		$row = $query->row(); //takes only one result row	
		$this->data['dari'] = $row->sendby;
		$this->data['judulpesan'] = $row->subject;
		$this->data['isipesan'] = $row->message;
		$this->data['attach'] = $row->attach;
		$this->data['nopesan'] = $row->id_pesan;
		

		
		$this->load->view('print_bacainbox', $this->data);
		
		
		
	}
	
	public function add_kirim_pesan()
	{
	
		$judul = $this->input->post('judul_pesan');
		$usernameq = $this->session->userdata('username');
		$attach='';
		$file_element_name = 'fileRingkas';
		if($_FILES['fileRingkas']['tmp_name'] != ''){
			$config['upload_path'] = './uploads/pesan';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|xml';
			$config['max_size'] = 5120;
			
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
 
			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
				$attach=$msg;
			}
			else
			{
				$datafile = $this->upload->data();
				$attach=$datafile['file_name'];
			}
			@unlink($_FILES[$file_element_name]);
			
		}
		
	
			
		
		
		//admin
		if ($this->session->userdata('privilege_id')=='2' ){
			if ($this->input->post('template')=='template1'){
				$idp = $this->input->post('toperusahaansinlge');
				$type = '1';
				
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
				$emailesdm = 'subdit_dka@yahoo.com';
				
				$html = $this->load->view('template_pesan', $this->data, true);
				$html = str_replace('[pathimg]',  base_url(). "img/Logo_ESDM.gif" , $html);
				$html = str_replace('[no_urut]', $no_urut, $html);
				$html = str_replace('[tanggal]', date('d/m/Y'), $html);
				$html = str_replace('[nama_perusahaan]', $nama_perusahaan, $html);
				$html = str_replace('[alamat_perusahaan]', $alamat_perusahaan, $html);
				$html = str_replace('[username]', $username, $html);
				$html = str_replace('[email_esdm]', $emailesdm, $html);
				$html = str_replace('[pesan]', $pesan, $html);
				
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
				'datesend' => date('Y-m-d H:i:s'),
				'type' => $type,
				'attach' => $attach
				);
				
				//send email
				$to      = $email;
				$subject = $judul." - ".date(DATE_RFC2822);;
				$message = $html;
				
				$headers = "From: subdit_dka@yahoo.co.id\r\n";
				$headers .= "Reply-To: subdit_dka@yahoo.co.id\r\n";
				$headers .= "CC: subdit_dka@yahoo.co.id\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				
				$fromx = urlencode("subdit_dka@yahoo.co.id");
				$tox = urlencode($to);
				$subjectx = urlencode($subject);
				$messagex = urlencode($message);
				
				$no_urutx = urlencode($no_urut);
				$tanggalx = urlencode(date('d/m/Y'));
				$nama_perusahaanx = urlencode($nama_perusahaan);
				$alamat_perusahaanx = urlencode($alamat_perusahaan);
				$usernamex = urlencode($username);
				$email_esdmx = urlencode($emailesdm);
				$pesanx = urlencode($pesan);
							
				$urlx = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&nourut=".$no_urutx."&tanggal=".$tanggalx."&namap=".$nama_perusahaanx."&alamatp=".$alamat_perusahaanx."&username=".$usernamex."&emailesdm=".$email_esdmx."&pesan=".$pesanx;
							
				file_get_contents($urlx);
				
				$this->User_model->insertpesan($datapesan);		
				
			
				
			} else if ($this->input->post('template')=='default'){
				
				$type = '0';
				$idparrx = $this->input->post('toperusahaan');
				$type = 'default';
				$html = $this->input->post('isi_pesan');
				$no_urut = 'default';
				foreach($idparrx as $i_idp){
					$query = $this->User_model->getallbyidperusahaan($this->data,$i_idp);
					$email = $query['email_perusahaan'];
					$datapesan = array(
					'IdPerusahaan' => $i_idp,
					'no_surat' => $no_urut,
					'emailto' => $email,
					'subject' => $judul,
					'message' => $html,
					'sendby' => $usernameq,
					'sendto' => $this->input->post('usernamep'),
					'datesend' => date('Y-m-d H:i:s'),
					'type' => $type,
					'attach' => $attach
					);
					
					$this->User_model->insertpesan($datapesan);		
					//echo $this->input->post('usernamep')."|".$this->input->post('real_namep');
				
				}		
			}
			
		} 
		//perusahaan
		else if ($this->session->userdata('privilege_id')=='3' ){
			$idp = $this->input->post('idp');
			$query = $this->User_model->getallbyidperusahaan($this->data,$idp);
			$email = $query['email_perusahaan'];
			$type = '0';
			$html = $this->input->post('isi_pesan');
			$no_urut = 'default';
			
			$datapesan = array(
			'IdPerusahaan' => $idp,
			'no_surat' => $no_urut,
			'emailto' => $email,
			'subject' => $judul,
			'message' => $html,
			'sendby' => $usernameq,
			'sendto' => $this->input->post('usernamep'),
			'datesend' => date('Y-m-d H:i:s'),
			'type' => $type,
			'attach' => $attach
			);
			
			$this->User_model->insertpesan($datapesan);		
			//echo $this->input->post('usernamep')."|".$this->input->post('real_namep');
	
		}
		
		
		
		
		
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
		$message = 'Ganti email untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM telah berhasil.'. "\r\n".
		'email perusahaan telah di ganti menjadi:'. "\r\n".
		$new_email."\r\n".
		'bila tidak merasa mengganti, harap hubungi kami'. "\r\n";
		$headers = 'From: subdit_dka@yahoo.co.id' . "\r\n" .
		'Reply-To: subdit_dka@yahoo.co.id' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		//send ke email baru
		$to1      = $new_email;
		$subject1 = 'Ganti email untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM ';
		$message1 = 'Ganti email untuk pelaporan penggunaan energi tahunan dari Kementrian ESDM telah berhasil.'. "\r\n".
		'email perusahaan telah berhasil di ganti menjadi '.$new_email. "\r\n";
		$headers1 = 'From: subdit_dka@yahoo.co.id' . "\r\n" .
		'Reply-To: subdit_dka@yahoo.co.id' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();


		//mail($to1, $subject1, $message1, $headers1);
		//mail($to, $subject, $message, $headers);
		
		//$datamail = array (		'from' => 'subdit_dka@yahoo.co.id','to' => $to,'subject' => $subject ,'message' => $message);
		//$result = $this->curl->simple_post('http://dev.creativenesia.com/sendmail.php', //$datamail);
		
		//$datamail1 = array (	'from' => 'subdit_dka@yahoo.co.id','to' => $to1,'subject' => $subject1 ,'message' => $message1);
		//$result1 = $this->curl->simple_post('http://dev.creativenesia.com/sendmail.php', //$datamail1);

		$fromx = urlencode("subdit_dka@yahoo.co.id");
		$tox = urlencode($to);
		$subjectx = urlencode($subject);
		$messagex = urlencode($message);
		
		$urlx = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;
		//$urlx = "http://indodone.com/dev/shop/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&message=".$messagex;

		//$this->curl->simple_get($urlx);
		file_get_contents($urlx);
		
		$fromx1 = urlencode("subdit_dka@yahoo.co.id");
		$tox1 = urlencode($to1);
		$subjectx1 = urlencode($subject1);
		$messagex1 = urlencode($message1);
		
		$urlx1 = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx1."&to=".$tox1."&subject=".$subjectx1."&message=".$messagex1;
		//$urlx = "http://indodone.com/dev/shop/sendmail?from=".$fromx1."&to=".$tox1."&subject=".$subjectx1."&message=".$messagex1;

		//$this->curl->simple_get($urlx1);
		file_get_contents($urlx1);
		
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