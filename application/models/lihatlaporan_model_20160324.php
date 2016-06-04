<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class lihatlaporan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	public function insert($data)
	{
		$this->db->insert('t_statussubmit', $data);

	}
	public function edit($id, $data)
	{
		$this->db->where('IdPerusahaan',$id);
		$this->db->where('tahun',date("Y")-1);
		$this->db->update('t_statussubmit',$data);		
		return true;
	}
	public  function countsubmit($data,$idp,$taun){
		
		$this->db->select('submit_akhir')
		->from('t_statussubmit')		
		->where('IdPerusahaan',$idp)
		->where('tahun',$taun);
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
	public  function cekdata($data,$idp){
		$this->db->select('a.IdPerusahaan, a.TypePerusahaan, a.NamaPerusahaan, a.AlamatPerusahaan, a.KotaKab, a.Prov, a.NoTelp, a.NoFax,b.NamaSubsektor, a.SubsektorLain, a.ThnAwalOp, a.JmlKaryawan')
		->from('tm_perusahaan as a')
		->join('tm_subsektor as b',"a.IdSubsektor=b.IdMSubsektor","INNER")
		->where('IdPerusahaan',$idp);
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
	public  function cekdataOrg($data,$idp){
		$this->db->select('a.Id, a.OrgMgmntEnergi, a.PathFileOrg, a.PathFileSertifikat, a.MgrEnergi, a.NamaMgrEnergi, a.EmailMgrEnergi, a.NoTlpMgrEnergi, a.NoSertMgrEnergi, a.KebijakanEnergi, a.PathFileKbjk, a.DetailJab, b.JabatanManajerEnergi ')
		->from('t_orgmgrenergi as a')
            ->join('tm_jabatanmanajerenergi as b','b.IdMJabatanManajerEnergi = a.JabatanManajerEnergi')
		->where('a.IdPerusahaan',$idp);
		$query = $this->db->get();
		
		 if($query->num_rows() == 0)
 		{
   			return false;
 		}else{
 			return $query->row_array();
			//return $query->num_rows(); 
 		}
	}
	public function jenisproduksiLP($IdPerusahaanP,$tahunP)
	{
        $this->db->select('c.NamaSubsektor,jenis_produksi, jumlah, satuan, id_jenis_produksi, sum(jumlah) as total', false)
            ->from('t_jenis_produksi AS a')
            ->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
            ->join('tm_subsektor AS c', 'b.IdSubsektor=c.IdMSubsektor')
			->where('a.id_perusahaan = '.$IdPerusahaanP)
			->where('tahun = '.$tahunP);
		$query = $this->db->get();
		return $query->result();
	}
	public function luasbangunanLP ($IdPerusahaanP,$tahunP)
	{
		$this->db->select('c.NamaSubsektor,nama_bangunan, luas_bangunan, id_luas_bangunan', false)
			->from('t_luas_bangunan AS a')
			->join('tm_perusahaan AS b', 'a.id_perusahaan=b.IdPerusahaan')
			->join('tm_subsektor AS c','b.IdSubsektor=c.IdMSubsektor')
			->where('a.id_perusahaan = '.$IdPerusahaanP)
			->where('tahun = '.$tahunP);
		$query = $this->db->get();
		return $query->result();
	}
	public function pemakaianenergiLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('b.JenisEnergi as JenisEnergi, c.detail_jenis_energi as detail_jenis_energi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_pemakaian_energi as id_pemakaian_energi, b.Satuan AS Satuan, (c.faktor_emisi * a.gjoule) as emisi', false)
			->where('a.id_perusahaan = '.$IdPerusahaanP)
			->where('a.tahun = '.$tahunP)
			->from('t_pemakaian_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi','INNER')
			->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail=c.id_jenis_energi_detail','INNER');
		$query = $this->db->get();
		return $query->result();
	}
	public function pemakaianenergitotalLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select(' sum(a.gjoule) as totalgjoule, sum(a.gjoule*c.faktor_emisi) as totalemisi', false)
			->where('a.id_perusahaan = '.$IdPerusahaanP)
			->where('a.tahun = '.$tahunP)
			->from('t_pemakaian_energi AS a')
			->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi','INNER')
			->join('tm_jenisenergidetail AS c', 'a.id_jenis_energi_detail=c.id_jenis_energi_detail','INNER');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function peralatanpemanfaatenergiLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, d.detail_jenis_energi as detail_jenis_energi,b.JenisEnergi as JenisEnergi, a.jenis_energi_lain as jenis_energi_lain, a.original_unit as original_unit, a.gjoule as gjoule, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi, b.Satuan AS Satuan, ((a.gjoule/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun='.$tahunP.' AND id_perusahaan='.$IdPerusahaanP.')) * 100) AS persentase', false)
				->where('a.id_perusahaan = '.$IdPerusahaanP)
				->where('a.tahun = '.$tahunP)
				->from('t_peralatan_pemanfaat_energi AS a')
				->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
				->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan')
				->join('tm_jenisenergidetail AS d', 'a.id_jenis_energi_detail=d.id_jenis_energi_detail');
		$query = $this->db->get();
		return $query->result();		
	}

	public function peralatanpemanfaatenergitotalLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('sum(a.gjoule) as totalgjoule, ((sum(a.gjoule)/(SELECT SUM(gjoule) FROM t_pemakaian_energi WHERE tahun='.$tahunP.' AND id_perusahaan='.$IdPerusahaanP.')) * 100) AS totalpersentase', false)
				->where('a.id_perusahaan = '.$IdPerusahaanP)
				->where('a.tahun = '.$tahunP)
				->from('t_peralatan_pemanfaat_energi AS a')
				->join('tm_jenisenergi AS b', 'a.id_jenis_energi=b.IdJenisEnergi')
				->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan')
				->join('tm_jenisenergidetail AS d', 'a.id_jenis_energi_detail=d.id_jenis_energi_detail');
		$query = $this->db->get();
		return $query->result();		
	}
	
	public function kegiatankonservasiLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('kegiatan, faktor_emisi, realisasi_gjoule, realisasi_persen, realisasi_emisi, realisasi_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, a.konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi,b.jenis_peralatan_lain')
				->where('a.id_perusahaan = '.$IdPerusahaanP)
				->where('a.tahun = '.$tahunP)
				->from('t_kegiatan_konservasi_new as a')
				->join('t_peralatan_pemanfaat_energi AS b', 'a.id_peralatan_pemanfaat_energi = b.id_peralatan_pemanfaat_energi', 'INNER');
		$query = $this->db->get();
		return $query->result();
	}
	public function kegiatankonservasilainLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_kegiatan_konservasi_lain')
				->where('id_perusahaan = '.$IdPerusahaanP)
				->where('tahun = '.$tahunP)
				->from('t_kegiatan_konservasi_lain');
		$query = $this->db->get();
		return $query->result();
	}
	public function rencanakonservasiLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('kegiatan, faktor_emisi, target_gjoule, target_persen, target_emisi, target_emisi_persen, keterangan ,JenisEnergi, detail_jenis_energi, konversi, JenisPeralatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi')
				->where('id_perusahaan = '.$IdPerusahaanP)
				->where('tahun = '.$tahunP)
				->from('t_rencana_konservasi_new as a');
		$query = $this->db->get();
		return $query->result();	
	}
	public function rencanakonservasilainLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('kegiatan, jenis_kegiatan, detail_kegiatan, id_rencana_konservasi_lain')
				->where('id_perusahaan = '.$IdPerusahaanP)
				->where('tahun = '.$tahunP)
				->from('t_rencana_konservasi_lain');
		$query = $this->db->get();
		return $query->result();	
	}	
	public function auditLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit as status_audit, a.keterangan_audit as keterangan_audit, a.file_audit as file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi', false)
				->where('a.id_perusahaan = '.$IdPerusahaanP)
				->where('a.tahun = '.$tahunP)
				->from('t_peralatan_pemanfaat_energi AS a')
				->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		$query = $this->db->get();
		return $query->result();
	}
	public function auditLP1($IdPerusahaanP,$tahunP)
	{
		$this->db->select('c.JenisPeralatan as jenis_peralatan, a.jenis_peralatan_lain, a.status_audit as status_audit, a.ruang_lingkup as ruang_lingkup, a.bulan_pelaksanaan as bulan_pelaksanaan, a.tahun_pelaksanaan as tahun_pelaksanaan , a.nama_auditor as nama_auditor, a.no_sertifikat_auditor as no_sertifikat, a.keterangan_audit as keterangan_audit, a.file_audit as file_audit, a.id_peralatan_pemanfaat_energi as id_peralatan_pemanfaat_energi', false)
				->where('a.id_perusahaan = '.$IdPerusahaanP)
				->where('a.tahun = '.$tahunP)
				->from('t_peralatan_pemanfaat_energi AS a')
				->join('tm_jenisperalatan AS c', 'a.id_jenis_peralatan=c.IdJenisPeralatan');
		$query = $this->db->get();
		return $query->result();
	}
    public function rekauditLP($IdPerusahaanP,$tahunP){
        $this->db->select('c.JenisPeralatan as jenis_peralatan, a.id_peralatan_pemanfaat_energi, rekomendasi, potensi_penghematan, jenis_rekomendasi, rencana_implementasi, id_rekomendasi_audit',false)
            ->where('a.id_perusahaan = '.$IdPerusahaanP)
            ->where('a.tahun = '.$tahunP)
            ->from('t_rekomendasi_audit as a')
            ->join('t_peralatan_pemanfaat_energi AS p', 'a.id_peralatan_pemanfaat_energi=p.id_peralatan_pemanfaat_energi')
            ->join('tm_jenisperalatan AS c', 'p.id_jenis_peralatan=c.IdJenisPeralatan');
        $query = $this->db->get();
        return $query->result();
    }

	public function konsumsienergispesifikLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
				->where('id_perusahaan',$IdPerusahaanP)

				->from('vkons_energi_spesifik');
		$query = $this->db->get();
		return $query->result();
	}
	public function konsumsienergispesifikbangLP($IdPerusahaanP,$tahunP)
	{
		$this->db->select('keterangan,satuan,tahun_sebelum,tahun_ini,pertumbuhan,id_perusahaan', false)
				->where('id_perusahaan',$IdPerusahaanP)
				->from('vkons_energi_spesifik_bang');
		$query = $this->db->get();
		return $query->result();
	}
}