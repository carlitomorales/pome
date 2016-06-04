<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class orgenergi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function insertorgenergi($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('t_orgmgrenergi', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}	

	public function editorgenergi($id, $data)
	{
		$this->db->where('Id',$id);
		$this->db->update('t_orgmgrenergi',$data);		
		return true;
	}
	

	public  function cekdata($data){
		$this->db->select('Id, OrgMgmntEnergi, PathFileOrg, KebijakanEnergi, PathFileKbjk, PathFileSertifikat, MgrEnergi, NamaMgrEnergi, EmailMgrEnergi, NoTlpMgrEnergi,NoSertMgrEnergi,JabatanManajerEnergi,DetailJab')
		->from('t_orgmgrenergi')
		->where('IdPerusahaan',$this->session->userdata('id_perusahaan'));
		$query = $this->db->get();
		
		 if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
		
		//return $query->result();
	}

    public function Getjabatanmanajerenergi()
    {
        $this->db->select('IdMJabatanManajerEnergi,JabatanManajerEnergi');
        $this->db->where('Deleted','0');
        $this->db->order_by('IdMJabatanManajerEnergi','ASC');
        $query = $this->db->get('tm_jabatanmanajerenergi');

        if ($query->num_rows() > 0) {
            if(!empty($id)){
                return $query->row();
            }else{
                return $query->result();
            }
        }else{
            return '';
        }
    }
}