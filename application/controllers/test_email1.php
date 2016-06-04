<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_email1 extends CI_Controller {

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
		$this->load->library('encrypt');
	}
	
	public function index()
	{
		ini_set('display_errors',1);
		error_reporting(~0);

		//$urlx = "http://dev.creativenesia.com/cikini/sendmail?from=".$fromx."&to=".$tox."&subject=".$subjectx."&nourut=".$no_urutx."&tanggal=".$tanggalx."&namap=".$nama_perusahaanx."&alamatp=".$alamat_perusahaanx."&username=".$usernamex."&emailesdm=".$email_esdmx."&pesan=".$pesanx;
			
		
		if (!isset($_POST["submit"])) {
				if (! ($this->input->get('nourut') == NULL))
				{
					$key = 'super-secret-cikini';
					$html = $this->load->view('template_pesan', $this->data, true);
					$html = str_replace('[pathimg]',  base_url(). "img/Logo_ESDM.gif" , $html);
					$html = str_replace('[no_urut]', $this->input->get('nourut'), $html);
					$html = str_replace('[tanggal]', date('d/m/Y'), $html);
					$html = str_replace('[nama_perusahaan]', $this->input->get('namap'), $html);
					$html = str_replace('[alamat_perusahaan]', $this->input->get('alamatp'), $html);
					$html = str_replace('[username]', $this->input->get('username'), $html);
					$html = str_replace('[email_esdm]', $this->input->get('emailesdm'), $html);
					$html = str_replace('[pesan]', $this->input->get('pesan'), $html);
				
					$headers = "From: subdit_dka@yahoo.co.id\r\n";
					$headers .= "Reply-To: subdit_dka@yahoo.co.id\r\n";
					$headers .= "CC: subdit_dka@yahoo.co.id\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					$from = $this->input->get('from'); // sender
					$to = $this->input->get('to');
					$subject = $this->input->get('subject');
					//$message = $this->input->get('message');
					$message = $html;
					// message lines should not exceed 70 characters (PHP rule), so wrap it
					//$message = wordwrap($message, 70);
					// send mail
					//mail($to,$subject,$message,$headers);
					sendmail($from,$to,$subject,$message)
					echo "success";
				}
				else{				
					$from = $this->input->get('from'); // sender
					$to = $this->input->get('to');
					$subject = $this->input->get('subject');
					$message = $this->input->get('message');
					
					// message lines should not exceed 70 characters (PHP rule), so wrap it
					//$message = wordwrap($message, 70);
					// send mail
					//mail($to,$subject,$message,"From: $from\n");
					sendmail($from,$to,$subject,$message)
					echo "success";
				}
		  
		} else {    // the user has submitted the form
		  // Check if the "from" input field is filled out
			if (isset($_POST["from"])) {
				$from = $_POST["from"]; // sender
				$to = $_POST["to"];
				$subject = $_POST["subject"];
				$message = $_POST["message"];
				// message lines should not exceed 70 characters (PHP rule), so wrap it
				//$message = wordwrap($message, 70);
				// send mail
				//mail($to,$subject,$message,"From: $from\n");
				sendmail($from,$to,$subject,$message)
				echo "success";
			}
			else{
				echo "failed";
			}
			
		}
	
	}
	
	
	public function sendemail($from,$to,$subject,$message)
    {
        /*$config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'smtp.sendgrid.net',
              'smtp_port' => '587',
              'smtp_user' => 'subdit.dka',
              'smtp_pass' => 'subditdka123',
              'mailtype'  => 'html',
              'charset'   => 'iso-8859-1'
              );*/
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'hosting.esdm.go.id',
            'smtp_port' => 25,
            'smtp_user' => 'no-reply@srv.ebtke.esdm.go.id',
            'smtp_pass' => 'no-reply',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        // Set to, from, message, etc.
        if (is_null($from)==true) {
            $this->email->from('manajemen.energi@ebtke.esdm.go.id', 'Subdit DKA');
            $this->email->cc('musopotamia@gmail.com');
//            $this->email->cc('subdit_dka@yahoo.co.id', 'Subdit DKA');
        }else{
            $this->email->from($from);
            $this->email->cc('musopotamia@gmail.com');
        }
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($message);

        if( $this->email->send())
        {
            echo "Mail sent!";
        }else{
            echo "Error";
        }
    }
}

