<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class perusahaan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	public function detail_perusahaan() {
		
	
	}
	
	public function get_all() {
		$this->db->select('a.IdPerusahaan,a.NamaPerusahaan,b.user_name');
		$this->db->from('tm_perusahaan as a');
		$this->db->join('tm_user as b','a.IdPerusahaan=b.IdPerusahaan','inner');
		$this->db->order_by('NamaPerusahaan','ASC');
		$query = $this->db->get();

		
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
	
	public function getSubsektorLain()
	{
		$sql = "SELECT DISTINCT SubsektorLain FROM tm_perusahaan ORDER BY SubsektorLain";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_perusahaan($perusahaan_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('IdPerusahaan', $perusahaan_id);
		$query = $this->db->get('tm_perusahaan');

		return $query->result_array();
	}
	function load_data_perusahaan($perusahaan_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('IdPerusahaan', $perusahaan_id);
		$query = $this->db->get('tm_perusahaan');

		 if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
	function load_dd_prov($namaprov) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->select('propinsi_id,propinsi');
		$this->db->where('propinsi',$namaprov);
		$query = $this->db->get('tm_propinsi');
		
		if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
	function load_dd_subsek($idsubsek) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->select('IdMSubsektor,NamaSubsektor');
		$this->db->where('IdMSubsektor',$idsubsek);
		$this->db->where('MTypePerusahaan_IdMTypePerusahaan',$this->session->userdata('type_perusahaan'));
		$query = $this->db->get('tm_subsektor');
		
		if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
	
	function load_dd_kotakab($namakotakab) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->select('kota_id,kota_kabupaten');
		$this->db->where('kota_kabupaten',$namakotakab);
		$query = $this->db->get('tm_kota_kabupaten');
		
		if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}

	function get_pegawai_bynip($nip) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('nip_baru', $nip);
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
	function get_pegawai_by_id($pegawai_id = '') {
		if(!empty($pegawai_id)){
			$this->db->where('a.id', $pegawai_id);
		}
		$this->db->select('*')
				->from('pegawai as a')
				->join('pegawai_jabatan as b','a.nip_baru = b.nip_baru','LEFT')
				->join('pegawai_kepegawaian as c','a.nip_baru = c.nip_baru','LEFT')
				->join('pegawai_tempatkerja as d','a.nip_baru = d.nip_baru','LEFT')
				->join('pegawai_pendidikan as e','a.nip_baru = e.nip_baru','LEFT');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			if(!empty($pegawai_id)){
				return $query->row();
			}else{
				return $query->result_array();
			}	
		}else{
			return '';
		}
		
	}

	function get_pegawai_bynip2($nip) {
		$this->db->select('*')
				->from('pegawai as a')
				->join('pegawai_jabatan as b','a.nip_baru = b.nip_baru','LEFT')
				->join('pegawai_kepegawaian as c','a.nip_baru = c.nip_baru','LEFT')
				->join('pegawai_tempatkerja as d','a.nip_baru = d.nip_baru','LEFT')
				->join('pegawai_pendidikan as e','a.nip_baru = e.nip_baru','LEFT')
				->where('a.nip_baru', $nip);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			if(!empty($nip)){
				return $query->row();
			}else{
				return $query->result_array();
			}	
		}else{
			return '';
		}
	}
	
	public function insert($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('tm_perusahaan', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	public function edit($id, $data)
	{
		$this->db->where('IdPerusahaan',$id);
		$this->db->update('tm_perusahaan',$data);		
		return true;
	}
	public function deletelainsubsektor($perusahaanid,$subsektorid)
	{
		$this->db->where('M_Perusahaan_IdPerusahaan', $perusahaanid);
		$this->db->where('M_Subsektor_IdMSubsektor', $subsektorid);
		$this->db->delete('tm_lainsubsektor');
	}
	public function insertlainsubsektor($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('tm_lainsubsektor', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_pegawai($pegawai_id, $data)
	{
		$this->db->where('id', $pegawai_id);
		$this->db->update('pegawai', $data);
	}
	
	public function del_pegawai($pegawai_id)
	{
		$this->db->where('id', $pegawai_id);
		$this->db->delete('pegawai');
	}
	
	function get_urutkepangkatan() {
		$this->db->select('*')
				->from('pegawai as a')
				->join('pegawai_jabatan as b','a.nip_baru = b.nip_baru')
				->join('pegawai_kepegawaian as c','a.nip_baru = c.nip_baru','left')
				->join('pegawai_kepangkatan as d','a.nip_baru = d.nip_baru','left')
				->join('pegawai_diklat_jabatan as e','a.nip_baru = e.nip_baru','left')
				->join('pegawai_pendidikan as f','a.nip_baru = f.nip_baru','left')
				->order_by('d.golongan desc,b.tmt_jabatan desc');
		$query = $this->db->get();
		
		//$query = $this->db->get('pegawai_kepangkatan');
		return $query->result_array();
	}
	
	public function get_masters($tipe, $id = '')
	{
		if(!empty($id)){
			$this->db->where('id', $id);
		}

		$this->db->where('tipe', $tipe);
		$this->db->where('status','1');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('pegawai_masters');
		
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
	
	function get_suami_istri($nip_baru = '') {
		if(!empty($nip_baru)){
			$this->db->where('nip_baru', $nip_baru);
		}
		$query = $this->db->get('pegawai_suami_istri');
			
		return $query->row();
	}
	
	function get_tempat_kerja($nip_baru = '') {
		if(!empty($nip_baru)){
			$this->db->where('nip_baru', $nip_baru);
		}
		$query = $this->db->get('pegawai_tempatkerja');
			
		return $query->row();
	}
	
	function get_riwayatkepangkatan($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatkepangkatan');
			
			return $query->result();
		}else{
			return '';
		}

	}
	
	function get_riwayatkeluarga($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatkeluarga');
			
			return $query->result();
		}else{
			return '';
		}

	}
	
	function get_riwayatpendidikan($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatpendidikan');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_dokumen($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_dokumen');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatjabatan($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatjabatan');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatpelatihanjabatan($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatpelatihanjabatan');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatpelatihanteknis($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatpelatihanteknis');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatpenghargaan($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatpenghargaan');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatkinerja($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatkinerja');
			
			return $query->result();
		}else{
			return '';
		}
	}
	
	function get_riwayatkompetensi($id_pegawai = '') {
		if(!empty($id_pegawai)){
			$this->db->where('id_pegawai', $id_pegawai);
			$query = $this->db->get('pegawai_riwayatkompetensi');
			
			return $query->result();
		}else{
			return '';
		}
	}
    public function GetIdpByUsername($username){
        $this->db->select("Idperusahaan");
        $this->db->where("user_name",$username);
        $this->db->from("tm_user");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            if(!empty($id)){
                return $query->row();
            }else{
                return $query->result();
            }
        }else {
            return '';
        }
    }
    public function getstatusbyidp($idp){
        $s0 = $this->config->item('status_0');
        $s1 = $this->config->item('status_1');
        $s2 = $this->config->item('status_2');
        $s3 = $this->config->item('status_3');

        $this->db->select("(CASE b.status WHEN 0 THEN '$s0' WHEN 1 THEN '$s1' WHEN 2 THEN '$s2' WHEN 3 THEN '$s3' END) as status");
        $this->db->from('tm_user as a');
        $this->db->join('t_statussubmit as b', 'a.idperusahaan = b.IdPerusahaan');
        $this->db->join('tm_perusahaan as c','a.idperusahaan = c.IdPerusahaan','inner');
        $this->db->where('a.Idperusahaan', $idp);
	$this->db->where('b.tahun', date("Y")-1);
        $query = $this->db->get();

        if($query->num_rows() == 0)
        {
            return false;
        }else{
            return $query->row_array();
            //return $query->num_rows();
        }
    }

    public function UpdateStatusPerusahaan($idperusahaan,$tahun,$status){
        $data = array(
            'status' => $status
        );

        $this->db->where('tahun', $tahun);
        $this->db->where('IdPerusahaan', $idperusahaan);
        $this->db->update('t_statussubmit', $data);
        return true;
    }
	public function getsubsektor($idperusahaan){
		$this->db->where("IdPerusahaan",$idperusahaan);
		$query = $this->db->get('tm_perusahaan');
		$rows = $query->result_array();
		$subsektor = 0;
		foreach($rows as $row){
			$subsektor = $row["IdSubsektor"];
		}
		return $subsektor;
	}

    public function getInfoPerusahaan($username)
    {
        $this->db->select('a.IdPerusahaan as idperusahaan, a.NamaPerusahaan as namaperusahaan, b.IdMTypePerusahaan as idtypeperusahaan, b.TypePerusahaan as typeperusahaan, d.IdMSubsektor as idsubsektor, d.NamaSubsektor as subsektor');
        $this->db->from('tm_perusahaan as a');
        $this->db->join('tm_typeperusahaan as b', 'a.TypePerusahaan = b.TypePerusahaan','left');
        $this->db->join('tm_user as c', 'a.IdPerusahaan= c.IdPerusahaan','left');
        $this->db->join('tm_subsektor as d', 'a.IdSubsektor= d.IdMSubsektor','left');
        $this->db->where('c.user_name',$username);
        $query = $this->db->get();

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