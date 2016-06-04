<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chainProvKota extends CI_Controller {

	function __construct(){
		parent::Controller();
		$this->load->model('mchain_model');
	}
	

	
	function select_kota(){
            if('IS_AJAX') {
        	$data['option_kota'] = $this->mchain_model->getKotaList();		
		$this->load->view('Perusahaan/kota',$data);
            }
		
	}
        
        function submit(){
            echo "Propinsi ID = ".$this->input->post("provinsi_id");
            echo "<br>";
            echo "Kota ID = ".$this->input->post("kota_id");
        }
}

